<?php

namespace App\Imports;

use App\Models\Area;
use App\Models\AreaLocation;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class LocationImport implements ToCollection
{
    public function __construct()
    {
    }

    public
    function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            if ($index > 0) {
                $location = Location::where('latitude', $row[3])->where('longitude', $row[4])->first();

                if (!$location) {
                    $location = new Location();
                    $location->name = $row[1];
                    $location->type = $row[2];
                    $location->latitude = (double)$row[3];
                    $location->longitude = (double)$row[4];
                    $location->save();

                    $area = Area::select(['id', 'latitude', 'longitude'])->get();

                    $data = [];
                    foreach ($area as $item) {
                        $distance = $this->haversineGreatCircleDistance((double)$item->latitude, (double)$item->longitude, $location->latitude, $location->longitude);

                        if ($distance <= 10000) {
                            $data[] = [
                                'area_id' => $item->id,
                                'location_id' => $location->id,
                                'distance' => $distance / 1000
                            ];
                        }
                    }

                    AreaLocation::insert($data);
                }

            }
        }
    }

    public function haversineGreatCircleDistance(
        $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }
}
