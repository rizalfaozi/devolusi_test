@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                  <a href="{{ url('create') }}" class='btn btn-default btn-xs'>Tambah</i></a>
                <div class="panel-body">
                  <table class=" table table-striped table-bordered">
                     <thead>
                         <th>ID</th>
                        <th>Photo</th>
                        <th>Name</th>
                        
                        <th>Email</th>
                        <th colspan="3">Action</th>
                    </thead>
                    <tbody>
    @foreach($user as $user)
        <tr>
            <td>{{ $user->iduser }} </td>
            <?php if($user->picture !=""){?>
            <td> <img width="50" height="50" src="{{  asset('img/'.$user->picture ) }}"></td>
        <?php }else{ ?>
            <td> <img width="50" height="50" src="{{  url('img/image.png') }}"></td>
        <?php } ?>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>
               
                <div class='btn-group'>
                   
                    <a href="{{ url('edit/'.$user->iduser) }}" class='btn btn-default btn-xs'>Edit</i></a>
                     <a href="{{ url('delete/'.$user->iduser) }}" class='btn btn-default btn-xs'>Hapus</i></a> 
                </div>
                
            </td>
        </tr>
    @endforeach
    </tbody>
                  </table>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
