@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit User</div>
                 <div class="panel-body">
                   <form method="post" action="{{ url('update/'.$user->iduser) }}"  enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="form-group">
                        
                        <label >Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" value="{{ $user->name }}">
                      </div>
                      <div class="form-group">
                        <label >Username</label>
                        <input type="text" name="username" class="form-control" value="{{ $user->username }}" disabled="disabled">
                      </div>
                      <div class="form-group">
                        <label >Password</label>
                        <input type="password" name="password" class="form-control" value="{{ $user->password }}" disabled="disabled">
                      </div>
                      <div class="form-group">
                        <label >Konfirmasi Password</label>
                        <input type="password" name="password_new" class="form-control"  value="{{ $user->password }}" disabled="disabled">
                                        <?php
                    if(isset($error)){
                        echo '<p style="color:red;">'.$error.'</P>';
                    }

                  ?>
                      </div>

                      <div class="form-group">
                        <label >Photo</label>
                        <input type="file" name="photo" class="form-control" >
                      </div>
                       <?php if($user->picture !=""){?>
                       <div class="form-group">
                        <label >Photo</label>
                       
                        <img src="{{  asset('img/'.$user->picture ) }}">
                        
                      </div>
                         <?php }?>
                      <div class="form-group">
                        <label >Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" disabled="disabled">

                       
                      </div>

                      <div class="form-group">
                        <label >Jabatan</label>
                        <select class="form-control" name="id_jabatan">
                        <?php 
                              if($user->id_jabatan ="0")
                              {
                                echo"<option value='0' selected>Pilih Jabatan</option>";
                                echo"<option value='1'>HRD</option>";
                                echo"<option value='2'>Direktur</option>";
                                echo"<option value='3'>Manager</option>";
                              }else if($user->id_jabatan ="1"){
                                echo"<option value='0'>Pilih Jabatan</option>";
                                echo"<option value='1' selected>HRD</option>";
                                echo"<option value='2'>Direktur</option>";
                                echo"<option value='3'>Manager</option>"; 

                               }else if($user->id_jabatan ="2"){
                                  echo"<option value='0' >Pilih Jabatan</option>";
                                echo"<option value='1'>HRD</option>";
                                echo"<option value='2' selected>Direktur</option>";
                                echo"<option value='3'>Manager</option>";

                               }else if($user->id_jabatan ="3"){ 
                                   echo"<option value='0' >Pilih Jabatan</option>";
                                echo"<option value='1'>HRD</option>";
                                echo"<option value='2'>Direktur</option>";
                                echo"<option value='3'selected>Manager</option>";

                               } 
                           
                        ?>


                        </select>
                      </div>

                     
                        <div class="form-group">
                        <label >Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" value="{{ $user->placeofbirth }}" >
                      </div>

                        <div class="form-group">
                        <label >Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control datepicker"  value="{{ $user->dateofbirth }}" >
                      </div>

                       <div class="form-group">
                        <?php if($user->gender =="pria"){
                            echo"<input type='radio' name='jk' value='pria' checked='checked'>";
                            echo"<label >Pria</label>";
                            echo"<input type='radio' name='jk' value='wanita' >";
                            echo"<label >Wanita</label>";
                        }else{
                             echo"<input type='radio' name='jk' value='pria' >";
                             echo"<label >Pria</label>";
                             echo"<input type='radio' name='jk' value='wanita' checked='checked'>";
                             echo"<label >Wanita</label>";
                        }

                        ?>
                       
                        
                   
                        <!--  <select name="jk" id="" class="form-control">
                             <option value="pria">Laki laki</option>
                             <option value="wanita">Perempuan</option>
                         </select> -->
                        
                      </div>

                      <div class="form-group">
                        <label >Propinsi</label>
                        <select class="form-control" name="propinsi_id">
                            <option value="0">Pilih Propinsi</option>
                            @foreach($propinsi as $pr)
                              <?php if($user->id_propinsi == $pr->id){
                                echo"<option value='".$pr->id."' selected>".$pr->name." </option>";
                              }else{

                                  echo"<option value='".$pr->id."'>".$pr->name." </option>"; 
                              }
                              ?>
                            @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label >Kecamatan</label>
                        <select class="form-control" name="kecamatan_id">
                            <option value="0">Pilih Kecamatan</option>
                            @foreach($kecamatan as $kc)
                                <?php if($user->id_kecamatan == $kc->id){
                                echo"<option value='".$kc->id."' selected>".$kc->name." </option>";
                              }else{

                                  echo"<option value='".$kc->id."'>".$kc->name." </option>"; 
                              }
                              ?>  
                            @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label >Kabupaten</label>
                        <select class="form-control" name="kabupaten_id">
                         <option value="0">Pilih Kabupaten</option>
                            @foreach($kabupaten as $kab)
                                 <?php if($user->id_kabupaten == $kab->id){
                                echo"<option value='".$kab->id."' selected>".$kab->name." </option>";
                              }else{

                                  echo"<option value='".$kab->id."'>".$kab->name." </option>"; 
                              }
                              ?>  
                            @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label >Kelurahan</label>
                        <select class="form-control" name="kelurahan_id">
                         <option value="0">Pilih Keluarahan</option>
                            @foreach($kelurahan as $kel)
                                 <?php if($user->id_kelurahan == $kel->id){
                                echo"<option value='".$kel->id."' selected>".$kel->name." </option>";
                              }else{

                                  echo"<option value='".$kel->id."'>".$kel->name." </option>"; 
                              }
                              ?>  >  
                            @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label >Alamat</label>
                        <textarea  class="form-control" name="alamat">{{ $user->address }}</textarea>
                      </div>

                      <div class="form-group">
                        <label >Alamat Alternatif</label>
                        <textarea  class="form-control" name="alamat_alt">{{ $user->addressalt }}</textarea>
                      </div>

                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
          
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
