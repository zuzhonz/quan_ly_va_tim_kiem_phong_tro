@extends('layouts.admin.main')

@section('title_page',$title)
@section('content')
   <div class="bg-white shadow-lg p-4 rounded-4">
       <div class="w-full overflow-hidden rounded-lg shadow-xs my-2">
           <div class="w-full overflow-x-auto ">
               @if ( Session::has('success') )
                   <div class="alert alert-success alert-dismissible" role="alert">
                       <strong>{{ Session::get('success') }}</strong>
                       <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                           <span class="sr-only">Close</span>
                       </button>
                   </div>
               @endif
               @if ( Session::has('error') )
                   <div class="alert alert-danger alert-dismissible" role="alert">
                       <strong>{{ Session::get('error') }}</strong>
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                           <span class="sr-only">Close</span>
                       </button>
                   </div>
               @endif
               @if ($errors->any())
                   <div class="alert alert-danger alert-dismissible" role="alert">
                       <ul>
                           @foreach ($errors->all() as $error)
                               <li>{{ $error }}</li>
                           @endforeach
                       </ul>
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                           <span class="sr-only">Close</span>
                       </button>
                   </div>
               @endif
           </div>
       </div>

       <form action="" class="mb-4">
           <div class="row col-12">
               <div class="col-3 pl-0 pr-1">
                   <input class="form-control" name="name"
                          value="{{isset($params['name']) && $params['name'] ? $params['name'] : ''}}"
                          placeholder="Tìm kiếm theo tên hoặc email">
               </div>
               <div class="col-2 px-1">
                   <select class="form-control" name="order_by">
                       <option
                           value="desc" {{ isset($params['order_by']) && $params['order_by'] == 'desc' ? 'selected' : ''}}>
                           Sắp xếp mới nhất
                       </option>
                       <option
                           value="asc" {{isset($params['order_by']) && $params['order_by'] == 'asc' ? 'selected' : ''}}>Sắp
                           xếp cũ nhất
                       </option>
                   </select>
               </div>
               <div class="col-3 px-1">
                   <select class="form-control" name="limit">
                       <option value="" {{ !isset($params['limit']) ? 'selected' : ''}}>Số lượng bản ghi hiển thị</option>
                       <option value="10" {{ isset($params['limit']) && $params['limit'] == '10' ? 'selected' : ''}}>10
                       </option>
                       <option value="25" {{ isset($params['limit']) && $params['limit'] == '25' ? 'selected' : ''}}>25
                       </option>
                       <option value="50" {{ isset($params['limit']) && $params['limit'] == '50' ? 'selected' : ''}}>50
                       </option>
                       <option value="100" {{ isset($params['limit']) && $params['limit'] == '100' ? 'selected' : ''}}>
                           100
                       </option>
                   </select>
               </div>
               <div class="col-4 d-flex flex-row">
                   <button class="btn btn-primary">Tìm kiếm</button>
                   <a class="btn btn-danger mx-2" href="{{route('backend_user_getAll')}}">Bỏ chọn</a>
                   <a class="btn btn-secondary" href="{{route('backend_user_getAll')}}"><i class="fa-solid fa-file-export"></i>  Xuất danh sách</i></a>
               </div>
           </div>
       </form>

       <table class="table text-center">
           <thead>
           <tr>
               <th>#</th>
               <th class="">Họ tên</th>
               <th class="">Email</th>
               <th class="">Số điện thoại</th>
               <th class="">Xu</th>
               <th class="">Ảnh đại diện</th>
               <th class="">Quyền</th>
               <th class="">Chức năng</th>
           </tr>
           </thead>
           <tbody>
           @foreach ($users as $user)
               <tr>
                   <td>{{$loop->iteration}}</td>
                   <td class="">{!! isset($params['name']) ? str_replace($params['name'],'<span class="bg-warning">'.$params['name'].'</span>',$user->name) : $user->name!!}</td>
                   <td class="">{!! isset($params['name']) ? str_replace($params['name'],'<span class="bg-warning">'.$params['name'].'</span>',$user->email) : $user->email!!}</td>
                   <td class="">{{$user->phone_number}}</td>
                   <td class=""><span>{{number_format($user->money,0,'','.')}} <i
                               class="fa-brands fa-bitcoin text-warning"></i></span></td>
                   <td class="">
                       <img src="{{$user->avatar}}" alt="" width="50px">
                   </td>
                   <td class="">
                       @if ($user->role_id === 1)
                           {{'Admin'}}
                       @elseif($user->role_id === 2)
                           {{'Chủ trọ'}}
                       @else
                           {{'Thành viên'}}
                       @endif
                   </td>
                   <td class=" d-xl-table-cell d-flex justify-content-around text-center">
                       <a href=" {{route('backend_user_detail',['id'=>$user->id,'used_to'=>'detail'])}} "
                          class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                   </td>
               </tr>
           @endforeach
           </tbody>
       </table>
       {{$users->links()}}

   </div>
@endsection
