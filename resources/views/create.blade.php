@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tambah User</div>
                 <div class="panel-body">
                   <form method="post" action="{{ url('store') }}"  enctype="multipart/form-data">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="form-group">
                        <label >Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control">
                      </div>
                      <div class="form-group">
                        <label >Username</label>
                        <input type="text" name="username" class="form-control">
                      </div>
                      <div class="form-group">
                        <label >Password</label>
                        <input type="password" name="password" class="form-control" >
                      </div>
                      <div class="form-group">
                        <label >Konfirmasi Password</label>
                        <input type="password" name="password_new" class="form-control" >
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

                      <div class="form-group">
                        <label >Email</label>
                        <input type="email" name="email" class="form-control" >

                          <?php
                    if(isset($error_mail)){
                        echo '<p style="color:red;">'.$error_mail.'</P>';
                    }

                  ?>
                      </div>

                      <div class="form-group">
                        <label >Jabatan</label>
                        <select class="form-control" name="jabatan_id">
                            <option value="0">Pilih Jabatan</option>
                            <option value="1">HRD</option>
                            <option value="2">Direktur</option>
                            <option value="3">Manager</option>
                        </select>
                      </div>

                    
                        <div class="form-group">
                        <label >Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" >
                      </div>

                        <div class="form-group">
                        <label >Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control datepicker" >
                      </div>

                       <div class="form-group">
                        <input type="radio" name="jk" value="pria" >
                        <label >Laki laki</label>
                        
                         <input type="radio" name="jk"  value="wanita" >
                         <label >Perempuan</label>
                         <!-- <select name="jk" id="" class="form-control">
                             <option value="pria">Laki laki</option>
                             <option value="wanita">Perempuan</option>
                         </select> -->
                        
                      </div>

                      <div class="form-group">
                        <label >Propinsi</label>
                        <select class="form-control" name="propinsi_id" id="propinsi">
                            <option value="0">Pilih Propinsi</option>
                            @foreach($propinsi as $pr)
                                <option value="{{ $pr->id }}">{{ $pr->name }}</option>  
                            @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label >Kabupaten</label>
                        <select class="form-control" name="kabupaten_id" id="kabupaten">
                         
                          
                        </select>
                      </div>

                      <div class="form-group">
                        <label >Kecamatan</label>
                        <select class="form-control" name="kecamatan_id" id="kecamatan">
                           
                           
                        </select>
                      </div>

                    

                      <div class="form-group">
                        <label >Kelurahan</label>
                        <select class="form-control" name="kelurahan_id" id="kelurahan">
                         
                           
                        </select>
                      </div>

                      <div class="form-group">
                        <label >Alamat</label>
                        <textarea  class="form-control" name="alamat"></textarea>
                      </div>

                      <div class="form-group">
                        <label >Alamat Alternatif</label>
                        <textarea  class="form-control" name="alamat_alt"></textarea>
                      </div>

                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
          
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){ 
    
    $('#propinsi').on('change', function() {
     kabupaten(this.value)
    });

    $('#kabupaten').on('change', function() {
     kecamatan(this.value)
    });

    $('#kecamatan').on('change', function() {
     kelurahan(this.value)
    });
});

  function kabupaten(id)
  {
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'); 
     $.ajax({
  type:"post",  
    url:"kabupaten",
    data:{id:id,_token: CSRF_TOKEN},
    //dataType: "json",
    cache: false,
    success: function(respons){

        select = "";
         jmlData = respons.length;
         // select += '<option value="0">Pilih Kabupaten</option';
         for(a = 0; a < jmlData; a++)
         {
             select  += "<option value='"+ respons[a]['id'] +"'>";
             select  += ""+ respons[a]['name'] +"";
          // select  += '<option value="'+ respons[a]['id'] +'">'+ respons[a]['name'] +'</option';
              select  += "</option>";
             // kecamatan(respons[a]['id']);

         }   
           
        $('#kabupaten').html(select);

      },
    error: function (respons) {
      alert("Gagal Get katalog");
        
      }
  });

  }

  function kecamatan(id)
  {
   
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'); 
     $.ajax({
  type:"post",  
    url:"kecamatan",
    data:{id:id,_token: CSRF_TOKEN},
    //dataType: "json",
    cache: false,
    success: function(respons){

        select = "";
         jmlData = respons.length;
         // select += '<option value="0">Pilih Kabupaten</option';
         for(a = 0; a < jmlData; a++)
         {
             select  += "<option value='"+ respons[a]['id'] +"'>";
             select  += ""+ respons[a]['name'] +"";
          // select  += '<option value="'+ respons[a]['id'] +'">'+ respons[a]['name'] +'</option';
              select  += "</option>";
             // kelurahan(respons[a]['id']);
         }   
          
        $('#kecamatan').html(select);

      },
    error: function (respons) {
      alert("Gagal Get katalog");
        
      }
  });
  }


  function kelurahan(id)
  {

    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'); 
     $.ajax({
  type:"post",  
    url:"kelurahan",
    data:{id:id,_token: CSRF_TOKEN},
    //dataType: "json",
    cache: false,
    success: function(respons){

        select = "";
         jmlData = respons.length;
         // select += '<option value="0">Pilih Kabupaten</option';
         for(a = 0; a < jmlData; a++)
         {
             select  += "<option value='"+ respons[a]['id'] +"'>";
             select  += ""+ respons[a]['name'] +"";
          // select  += '<option value="'+ respons[a]['id'] +'">'+ respons[a]['name'] +'</option';
              select  += "</option>";

         }   
           //
        $('#kelurahan').html(select);

      },
    error: function (respons) {
      alert("Gagal Get katalog");
        
      }
  });
  }

</script>
