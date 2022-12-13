<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmContactMotel;
use App\Models\ContactMotelHistory;
use App\Models\Motel;
use App\Models\Vote;
use Illuminate\Support\Facades\Mail;

class LiveTogetherController extends Controller
{
    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function detail($id)
    {
        $infoMotel = new Motel();
        $this->v['motel'] = $infoMotel->infoMotelLiveTogether($id);
        $this->v['liveTogetherByArea'] = $infoMotel->getLiveTogethersByAreas($id);
        $this->v['liveTogethersHot'] = $infoMotel->getLiveTogethersHot();

        $vote = new Vote();
        if ($this->v['motel']) {
            $this->v['votes'] = $vote->client_get_list_vote_motel($id);
            return view('client.live-together.detail', $this->v);
        }
        abort(404);

    }

    public function historyContactMotel($motel_id, $area_id)
    {
        $model = new Motel();
        $this->v['history'] = $model->get_list_contact($motel_id, $area_id);
        return view('client.live-together.history_contact_motel', $this->v);
    }

    public function ConfirmContactMotel($motel_id, $area_id, $status, $contact_id)
    {
        $model = new ContactMotelHistory();

        $res = $model->confirmContact($motel_id, $area_id, $status, $contact_id);
        try {
            if ($status === 4) {
                return redirect()->route('get_history_contact_by_user');
            } else {
                Mail::to($res['email'])->send(new ConfirmContactMotel($res['actor']));
                return redirect()->back()->with('success', 'Thay đổi trạng thái thành công');
            }


        } catch (\Exception $err) {
            dd($err->getMessage());
        }

    }
}
