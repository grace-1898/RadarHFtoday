<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""/>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <title>Radar HF today!</title>
    <style>
      body{
        font-family: 'Montserrat', sans-serif;
      }
      .logo{
        width: 35px;
      }
      .legend{
        width: 290px;
        margin-left: 25px;
        margin-top: 90px;
      }

      /* LEAFLET MAP */
      #mapid { 
        height: 640px; 
        position: fixed; top: 50px; bottom: 0; left: 0; right: 0;
      }

      /*NAVBAR*/
      nav{
        height: 50px;
        background-color: #15395B; 
        position: absolute;
      }
      .logo{
        width: 35px;
      }

      /*KOTAK JUDUL*/
      .judulkotak{
        background-color: #15395B;
        margin-top: 20px;
        margin-left: 25px;
        width: 370px;
        padding: 9px;
        color: white;
        box-shadow: 3px 3px #3a506b;
      }
      .judulradar{
        text-decoration: underline;
      }
      .maksudradar{
        font-size: 12px;       
      }

      /*KOTAK LIS*/
      .samping{
        position: absolute;
      }
      .liskotak{
        background-color: white;
        margin-top: 10px;
        margin-left: 25px;
        width: 370px;
        height: 145px;
        padding: 9px;
        box-shadow: 3px 3px #F5F5F5;
      }
      .judullis{
        font-size: 12px;
      }
      .lis{
        font-size: 12px;
      }
      .tgl{
        margin-left: 25px;
        margin-top: 10px;
        font-size: 14px;
        background-color: white;
        width: 370px;
        height: 40px;
        padding: 9px;
      }

      /*DATA YG DIPILIH*/
      .dropdown{
        margin-left: 25px;
      }
      .btn{
        background-color: #15395B;
        width: 215px;
        height: 15x;
        font-size: 13px;
        color: white;
      }
      .dropdown-item{
        font-size: 13px;
      }
      .form-group{
        margin-left: 25px;
      }
      .form-control{
        width: 215px;
        font-size: 13px;
      }
      .data2{
        font-size: 13px;
        margin-top: 15px;
      }
      .data3{
        font-size: 13px;
      }
    </style>
  </head>

  <body onload="startFunction()">
    <div id="mapid"></div>

    <script>
      var mymap
      function startFunction(){
        mymap = L.map('mapid').setView([-8.015036, 109.916153], 11);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZ2luYWx5c2FwIiwiYSI6ImNrNm5heWR6ajBzenMzbmxpdWhmbW41M2QifQ.DQtA---_aRIwEkIKNHIzkQ', {
          attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
          maxZoom: 18,
          minZoom: 9,
          id: 'mapbox/streets-v11',
          tileSize: 512,
          zoomOffset: -1,
          zoomControl: true,
          accessToken: 'your.mapbox.access.token'
        }).addTo(mymap);
        mymap.zoomControl.setPosition('topright');
        
        L.marker([-8.023266,110.326769]).addTo(mymap);
        L.marker([-7.855078,109.914967]).addTo(mymap);
      } /* tutup function */

      var popup1 = L.popup();
      function onMapClick(e){
        var jam = $('#sel2').val()
        var hari = $('#datepicker').val()
        hari = formatDate(hari)
        var requestdata = {
          lat : e.latlng.lat.toFixed(5),
          lon : e.latlng.lng.toFixed(5),
        }
        if (jam == "00:00:00"){
          $.get(`/dataradar/getbylatlang/${jam}/${hari}`, requestdata, function(data, status){
            if(!data.dataradar){
              popup1
              .setLatLng([ e.latlng.lat, e.latlng.lng])
              .setContent(`Data tidak ada <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
              .openOn(mymap);
            }
            var dataradar = data.dataradar.value_araharus;
            var dataradar1 = data.dataradar.value_tinggigel;
            var dataradar2 = data.dataradar.value_kecangin;
            var dataradar3 = data.dataradar.value_kecarus;
            popup1
            .setLatLng([ e.latlng.lat, e.latlng.lng])
            .setContent(`Arah Arus : ${dataradar} <br/> Kec Arus : ${dataradar3} cm/s <br/> Tiggi gel : ${dataradar1} m<br/> Kec Angin : ${dataradar2} cm/s <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
            .openOn(mymap);
          })
        } 
        if (jam == "01:00:00"){
          console.log("bsfbsaf");
          $.get('/dataradar/getbylatlang', requestdata, function(data, status){
            if(!data.dataradar){
              popup1
              .setLatLng([ e.latlng.lat, e.latlng.lng])
              .setContent(`Data tidak ada <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
              .openOn(mymap);
            }
            var dataradar = data.dataradar.value_araharus;
            var dataradar1 = data.dataradar.value_tinggigel;
            var dataradar2 = data.dataradar.value_kecangin;
            var dataradar3 = data.dataradar.value_kecarus;
            popup1
            .setLatLng([ e.latlng.lat, e.latlng.lng])
            .setContent(`Arah Arus : ${dataradar} <br/> Kec Arus : ${dataradar3} cm/s <br/> Tiggi gel : ${dataradar1} m<br/> Kec Angin : ${dataradar2} cm/s <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
            .openOn(mymap);
          })
        } 
        if (jam == "02:00:00"){
          console.log("bsfbsaf");
          $.get('/dataradar/getbylatlang', requestdata, function(data, status){
            if(!data.dataradar){
              popup1
              .setLatLng([ e.latlng.lat, e.latlng.lng])
              .setContent(`Data tidak ada <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
              .openOn(mymap);
            }
            var dataradar = data.dataradar.value_araharus;
            var dataradar1 = data.dataradar.value_tinggigel;
            var dataradar2 = data.dataradar.value_kecangin;
            var dataradar3 = data.dataradar.value_kecarus;
            popup1
            .setLatLng([ e.latlng.lat, e.latlng.lng])
            .setContent(`Arah Arus : ${dataradar} <br/> Kec Arus : ${dataradar3} cm/s <br/> Tiggi gel : ${dataradar1} m<br/> Kec Angin : ${dataradar2} cm/s <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
            .openOn(mymap);
          })
        } 
        if (jam == "03:00:00"){
          console.log("bsfbsaf");
          $.get('/dataradar/getbylatlang', requestdata, function(data, status){
            if(!data.dataradar){
              popup1
              .setLatLng([ e.latlng.lat, e.latlng.lng])
              .setContent(`Data tidak ada <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
              .openOn(mymap);
            }
            var dataradar = data.dataradar.value_araharus;
            var dataradar1 = data.dataradar.value_tinggigel;
            var dataradar2 = data.dataradar.value_kecangin;
            var dataradar3 = data.dataradar.value_kecarus;
            popup1
            .setLatLng([ e.latlng.lat, e.latlng.lng])
            .setContent(`Arah Arus : ${dataradar} <br/> Kec Arus : ${dataradar3} cm/s <br/> Tiggi gel : ${dataradar1} m<br/> Kec Angin : ${dataradar2} cm/s <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
            .openOn(mymap);
          })
        } 
        if (jam == "04:00:00"){
          console.log("bsfbsaf");
          $.get('/dataradar/getbylatlang', requestdata, function(data, status){
            if(!data.dataradar){
              popup1
              .setLatLng([ e.latlng.lat, e.latlng.lng])
              .setContent(`Data tidak ada <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
              .openOn(mymap);
            }
            var dataradar = data.dataradar.value_araharus;
            var dataradar1 = data.dataradar.value_tinggigel;
            var dataradar2 = data.dataradar.value_kecangin;
            var dataradar3 = data.dataradar.value_kecarus;
            popup1
            .setLatLng([ e.latlng.lat, e.latlng.lng])
            .setContent(`Arah Arus : ${dataradar} <br/> Kec Arus : ${dataradar3} cm/s <br/> Tiggi gel : ${dataradar1} m<br/> Kec Angin : ${dataradar2} cm/s <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
            .openOn(mymap);
          })
        } 
        if (jam == "05:00:00"){
          console.log("bsfbsaf");
          $.get('/dataradar/getbylatlang', requestdata, function(data, status){
            if(!data.dataradar){
              popup1
              .setLatLng([ e.latlng.lat, e.latlng.lng])
              .setContent(`Data tidak ada <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
              .openOn(mymap);
            }
            var dataradar = data.dataradar.value_araharus;
            var dataradar1 = data.dataradar.value_tinggigel;
            var dataradar2 = data.dataradar.value_kecangin;
            var dataradar3 = data.dataradar.value_kecarus;
            popup1
            .setLatLng([ e.latlng.lat, e.latlng.lng])
            .setContent(`Arah Arus : ${dataradar} <br/> Kec Arus : ${dataradar3} cm/s <br/> Tiggi gel : ${dataradar1} m<br/> Kec Angin : ${dataradar2} cm/s <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
            .openOn(mymap);
          })
        } 
        if (jam == "06:00:00"){
          console.log("bsfbsaf");
          $.get('/dataradar/getbylatlang', requestdata, function(data, status){
            if(!data.dataradar){
              popup1
              .setLatLng([ e.latlng.lat, e.latlng.lng])
              .setContent(`Data tidak ada <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
              .openOn(mymap);
            }
            var dataradar = data.dataradar.value_araharus;
            var dataradar1 = data.dataradar.value_tinggigel;
            var dataradar2 = data.dataradar.value_kecangin;
            var dataradar3 = data.dataradar.value_kecarus;
            popup1
            .setLatLng([ e.latlng.lat, e.latlng.lng])
            .setContent(`Arah Arus : ${dataradar} <br/> Kec Arus : ${dataradar3} cm/s <br/> Tiggi gel : ${dataradar1} m<br/> Kec Angin : ${dataradar2} cm/s <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
            .openOn(mymap);
          })
        } 
        if (jam == "07:00:00"){
          console.log("bsfbsaf");
          $.get('/dataradar/getbylatlang', requestdata, function(data, status){
            if(!data.dataradar){
              popup1
              .setLatLng([ e.latlng.lat, e.latlng.lng])
              .setContent(`Data tidak ada <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
              .openOn(mymap);
            }
            var dataradar = data.dataradar.value_araharus;
            var dataradar1 = data.dataradar.value_tinggigel;
            var dataradar2 = data.dataradar.value_kecangin;
            var dataradar3 = data.dataradar.value_kecarus;
            popup1
            .setLatLng([ e.latlng.lat, e.latlng.lng])
            .setContent(`Arah Arus : ${dataradar} <br/> Kec Arus : ${dataradar3} cm/s <br/> Tiggi gel : ${dataradar1} m<br/> Kec Angin : ${dataradar2} cm/s <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
            .openOn(mymap);
          })
        } 
        if (jam == "08:00:00"){
          console.log("bsfbsaf");
          $.get('/dataradar/getbylatlang', requestdata, function(data, status){
            if(!data.dataradar){
              popup1
              .setLatLng([ e.latlng.lat, e.latlng.lng])
              .setContent(`Data tidak ada <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
              .openOn(mymap);
            }
            var dataradar = data.dataradar.value_araharus;
            var dataradar1 = data.dataradar.value_tinggigel;
            var dataradar2 = data.dataradar.value_kecangin;
            var dataradar3 = data.dataradar.value_kecarus;
            popup1
            .setLatLng([ e.latlng.lat, e.latlng.lng])
            .setContent(`Arah Arus : ${dataradar} <br/> Kec Arus : ${dataradar3} cm/s <br/> Tiggi gel : ${dataradar1} m<br/> Kec Angin : ${dataradar2} cm/s <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
            .openOn(mymap);
          })
        } 
        if (jam == "09:00:00"){
          console.log("bsfbsaf");
          $.get('/dataradar/getbylatlang', requestdata, function(data, status){
            if(!data.dataradar){
              popup1
              .setLatLng([ e.latlng.lat, e.latlng.lng])
              .setContent(`Data tidak ada <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
              .openOn(mymap);
            }
            var dataradar = data.dataradar.value_araharus;
            var dataradar1 = data.dataradar.value_tinggigel;
            var dataradar2 = data.dataradar.value_kecangin;
            var dataradar3 = data.dataradar.value_kecarus;
            popup1
            .setLatLng([ e.latlng.lat, e.latlng.lng])
            .setContent(`Arah Arus : ${dataradar} <br/> Kec Arus : ${dataradar3} cm/s <br/> Tiggi gel : ${dataradar1} m<br/> Kec Angin : ${dataradar2} cm/s <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
            .openOn(mymap);
          })
        } 
        if (jam == "10:00:00"){
          console.log("bsfbsaf");
          $.get('/dataradar/getbylatlang', requestdata, function(data, status){
            if(!data.dataradar){
              popup1
              .setLatLng([ e.latlng.lat, e.latlng.lng])
              .setContent(`Data tidak ada <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
              .openOn(mymap);
            }
            var dataradar = data.dataradar.value_araharus;
            var dataradar1 = data.dataradar.value_tinggigel;
            var dataradar2 = data.dataradar.value_kecangin;
            var dataradar3 = data.dataradar.value_kecarus;
            popup1
            .setLatLng([ e.latlng.lat, e.latlng.lng])
            .setContent(`Arah Arus : ${dataradar} <br/> Kec Arus : ${dataradar3} cm/s <br/> Tiggi gel : ${dataradar1} m<br/> Kec Angin : ${dataradar2} cm/s <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
            .openOn(mymap);
          })
        } 
        if (jam == "11:00:00"){
          console.log("bsfbsaf");
          $.get('/dataradar/getbylatlang', requestdata, function(data, status){
            if(!data.dataradar){
              popup1
              .setLatLng([ e.latlng.lat, e.latlng.lng])
              .setContent(`Data tidak ada <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
              .openOn(mymap);
            }
            var dataradar = data.dataradar.value_araharus;
            var dataradar1 = data.dataradar.value_tinggigel;
            var dataradar2 = data.dataradar.value_kecangin;
            var dataradar3 = data.dataradar.value_kecarus;
            popup1
            .setLatLng([ e.latlng.lat, e.latlng.lng])
            .setContent(`Arah Arus : ${dataradar} <br/> Kec Arus : ${dataradar3} cm/s <br/> Tiggi gel : ${dataradar1} m<br/> Kec Angin : ${dataradar2} cm/s <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
            .openOn(mymap);
          })
        } 
        if (jam == "12:00:00"){
          console.log("bsfbsaf");
          $.get('/dataradar/getbylatlang', requestdata, function(data, status){
            if(!data.dataradar){
              popup1
              .setLatLng([ e.latlng.lat, e.latlng.lng])
              .setContent(`Data tidak ada <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
              .openOn(mymap);
            }
            var dataradar = data.dataradar.value_araharus;
            var dataradar1 = data.dataradar.value_tinggigel;
            var dataradar2 = data.dataradar.value_kecangin;
            var dataradar3 = data.dataradar.value_kecarus;
            popup1
            .setLatLng([ e.latlng.lat, e.latlng.lng])
            .setContent(`Arah Arus : ${dataradar} <br/> Kec Arus : ${dataradar3} cm/s <br/> Tiggi gel : ${dataradar1} m<br/> Kec Angin : ${dataradar2} cm/s <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
            .openOn(mymap);
          })
        } 
        if (jam == "13:00:00"){
          console.log("bsfbsaf");
          $.get('/dataradar/getbylatlang', requestdata, function(data, status){
            if(!data.dataradar){
              popup1
              .setLatLng([ e.latlng.lat, e.latlng.lng])
              .setContent(`Data tidak ada <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
              .openOn(mymap);
            }
            var dataradar = data.dataradar.value_araharus;
            var dataradar1 = data.dataradar.value_tinggigel;
            var dataradar2 = data.dataradar.value_kecangin;
            var dataradar3 = data.dataradar.value_kecarus;
            popup1
            .setLatLng([ e.latlng.lat, e.latlng.lng])
            .setContent(`Arah Arus : ${dataradar} <br/> Kec Arus : ${dataradar3} cm/s <br/> Tiggi gel : ${dataradar1} m<br/> Kec Angin : ${dataradar2} cm/s <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
            .openOn(mymap);
          })
        } 
        if (jam == "14:00:00"){
          console.log("bsfbsaf");
          $.get('/dataradar/getbylatlang', requestdata, function(data, status){
            if(!data.dataradar){
              popup1
              .setLatLng([ e.latlng.lat, e.latlng.lng])
              .setContent(`Data tidak ada <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
              .openOn(mymap);
            }
            var dataradar = data.dataradar.value_araharus;
            var dataradar1 = data.dataradar.value_tinggigel;
            var dataradar2 = data.dataradar.value_kecangin;
            var dataradar3 = data.dataradar.value_kecarus;
            popup1
            .setLatLng([ e.latlng.lat, e.latlng.lng])
            .setContent(`Arah Arus : ${dataradar} <br/> Kec Arus : ${dataradar3} cm/s <br/> Tiggi gel : ${dataradar1} m<br/> Kec Angin : ${dataradar2} cm/s <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
            .openOn(mymap);
          })
        }
        if (jam == "15:00:00"){
          console.log("bsfbsaf");
          $.get('/dataradar/getbylatlang', requestdata, function(data, status){
            if(!data.dataradar){
              popup1
              .setLatLng([ e.latlng.lat, e.latlng.lng])
              .setContent(`Data tidak ada <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
              .openOn(mymap);
            }
            var dataradar = data.dataradar.value_araharus;
            var dataradar1 = data.dataradar.value_tinggigel;
            var dataradar2 = data.dataradar.value_kecangin;
            var dataradar3 = data.dataradar.value_kecarus;
            popup1
            .setLatLng([ e.latlng.lat, e.latlng.lng])
            .setContent(`Arah Arus : ${dataradar} <br/> Kec Arus : ${dataradar3} cm/s <br/> Tiggi gel : ${dataradar1} m<br/> Kec Angin : ${dataradar2} cm/s <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
            .openOn(mymap);
          })
        }
        if (jam == "16:00:00"){
          console.log("bsfbsaf");
          $.get('/dataradar/getbylatlang', requestdata, function(data, status){
            if(!data.dataradar){
              popup1
              .setLatLng([ e.latlng.lat, e.latlng.lng])
              .setContent(`Data tidak ada <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
              .openOn(mymap);
            }
            var dataradar = data.dataradar.value_araharus;
            var dataradar1 = data.dataradar.value_tinggigel;
            var dataradar2 = data.dataradar.value_kecangin;
            var dataradar3 = data.dataradar.value_kecarus;
            popup1
            .setLatLng([ e.latlng.lat, e.latlng.lng])
            .setContent(`Arah Arus : ${dataradar} <br/> Kec Arus : ${dataradar3} cm/s <br/> Tiggi gel : ${dataradar1} m<br/> Kec Angin : ${dataradar2} cm/s <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
            .openOn(mymap);
          })
        }
        if (jam == "17:00:00"){
          console.log("bsfbsaf");
          $.get('/dataradar/getbylatlang', requestdata, function(data, status){
            if(!data.dataradar){
              popup1
              .setLatLng([ e.latlng.lat, e.latlng.lng])
              .setContent(`Data tidak ada <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
              .openOn(mymap);
            }
            var dataradar = data.dataradar.value_araharus;
            var dataradar1 = data.dataradar.value_tinggigel;
            var dataradar2 = data.dataradar.value_kecangin;
            var dataradar3 = data.dataradar.value_kecarus;
            popup1
            .setLatLng([ e.latlng.lat, e.latlng.lng])
            .setContent(`Arah Arus : ${dataradar} <br/> Kec Arus : ${dataradar3} cm/s <br/> Tiggi gel : ${dataradar1} m<br/> Kec Angin : ${dataradar2} cm/s <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
            .openOn(mymap);
          })
        }
        if (jam == "18:00:00"){
          console.log("bsfbsaf");
          $.get('/dataradar/getbylatlang', requestdata, function(data, status){
            if(!data.dataradar){
              popup1
              .setLatLng([ e.latlng.lat, e.latlng.lng])
              .setContent(`Data tidak ada <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
              .openOn(mymap);
            }
            var dataradar = data.dataradar.value_araharus;
            var dataradar1 = data.dataradar.value_tinggigel;
            var dataradar2 = data.dataradar.value_kecangin;
            var dataradar3 = data.dataradar.value_kecarus;
            popup1
            .setLatLng([ e.latlng.lat, e.latlng.lng])
            .setContent(`Arah Arus : ${dataradar} <br/> Kec Arus : ${dataradar3} cm/s <br/> Tiggi gel : ${dataradar1} m<br/> Kec Angin : ${dataradar2} cm/s <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
            .openOn(mymap);
          })
        }
        if (jam == "19:00:00"){
          console.log("bsfbsaf");
          $.get('/dataradar/getbylatlang', requestdata, function(data, status){
            if(!data.dataradar){
              popup1
              .setLatLng([ e.latlng.lat, e.latlng.lng])
              .setContent(`Data tidak ada <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
              .openOn(mymap);
            }
            var dataradar = data.dataradar.value_araharus;
            var dataradar1 = data.dataradar.value_tinggigel;
            var dataradar2 = data.dataradar.value_kecangin;
            var dataradar3 = data.dataradar.value_kecarus;
            popup1
            .setLatLng([ e.latlng.lat, e.latlng.lng])
            .setContent(`Arah Arus : ${dataradar} <br/> Kec Arus : ${dataradar3} cm/s <br/> Tiggi gel : ${dataradar1} m<br/> Kec Angin : ${dataradar2} cm/s <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
            .openOn(mymap);
          })
        }
        if (jam == "20:00:00"){
          console.log("bsfbsaf");
          $.get('/dataradar/getbylatlang', requestdata, function(data, status){
            if(!data.dataradar){
              popup1
              .setLatLng([ e.latlng.lat, e.latlng.lng])
              .setContent(`Data tidak ada <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
              .openOn(mymap);
            }
            var dataradar = data.dataradar.value_araharus;
            var dataradar1 = data.dataradar.value_tinggigel;
            var dataradar2 = data.dataradar.value_kecangin;
            var dataradar3 = data.dataradar.value_kecarus;
            popup1
            .setLatLng([ e.latlng.lat, e.latlng.lng])
            .setContent(`Arah Arus : ${dataradar} <br/> Kec Arus : ${dataradar3} cm/s <br/> Tiggi gel : ${dataradar1} m<br/> Kec Angin : ${dataradar2} cm/s <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
            .openOn(mymap);
          })
        }
        if (jam == "21:00:00"){
          console.log("bsfbsaf");
          $.get('/dataradar/getbylatlang', requestdata, function(data, status){
            if(!data.dataradar){
              popup1
              .setLatLng([ e.latlng.lat, e.latlng.lng])
              .setContent(`Data tidak ada <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
              .openOn(mymap);
            }
            var dataradar = data.dataradar.value_araharus;
            var dataradar1 = data.dataradar.value_tinggigel;
            var dataradar2 = data.dataradar.value_kecangin;
            var dataradar3 = data.dataradar.value_kecarus;
            popup1
            .setLatLng([ e.latlng.lat, e.latlng.lng])
            .setContent(`Arah Arus : ${dataradar} <br/> Kec Arus : ${dataradar3} cm/s <br/> Tiggi gel : ${dataradar1} m<br/> Kec Angin : ${dataradar2} cm/s <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
            .openOn(mymap);
          })
        }
        if (jam == "22:00:00"){
          console.log("bsfbsaf");
          $.get('/dataradar/getbylatlang', requestdata, function(data, status){
            if(!data.dataradar){
              popup1
              .setLatLng([ e.latlng.lat, e.latlng.lng])
              .setContent(`Data tidak ada <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
              .openOn(mymap);
            }
            var dataradar = data.dataradar.value_araharus;
            var dataradar1 = data.dataradar.value_tinggigel;
            var dataradar2 = data.dataradar.value_kecangin;
            var dataradar3 = data.dataradar.value_kecarus;
            popup1
            .setLatLng([ e.latlng.lat, e.latlng.lng])
            .setContent(`Arah Arus : ${dataradar} <br/> Kec Arus : ${dataradar3} cm/s <br/> Tiggi gel : ${dataradar1} m<br/> Kec Angin : ${dataradar2} cm/s <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
            .openOn(mymap);
          })
        }
        if (jam == "23:00:00"){
          console.log("bsfbsaf");
          $.get('/dataradar/getbylatlang', requestdata, function(data, status){
            if(!data.dataradar){
              popup1
              .setLatLng([ e.latlng.lat, e.latlng.lng])
              .setContent(`Data tidak ada <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
              .openOn(mymap);
            }
            var dataradar = data.dataradar.value_araharus;
            var dataradar1 = data.dataradar.value_tinggigel;
            var dataradar2 = data.dataradar.value_kecangin;
            var dataradar3 = data.dataradar.value_kecarus;
            popup1
            .setLatLng([ e.latlng.lat, e.latlng.lng])
            .setContent(`Arah Arus : ${dataradar} <br/> Kec Arus : ${dataradar3} cm/s <br/> Tiggi gel : ${dataradar1} m<br/> Kec Angin : ${dataradar2} cm/s <br/> LangLong: ${e.latlng.lat}, ${e.latlng.lng} <br/>`)
            .openOn(mymap);
          })
        }
      }

      function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) 
            month = '0' + month;
        if (day.length < 2) 
            day = '0' + day;

        return [year, month, day].join('-');
      }

      var listMarker = []
      function ambilData(e) {
        var jam = $('#sel2').val()
        var hari = $('#datepicker').val()
        hari = formatDate(hari)
        var requestdata = {    
          hari : hari,
          jam : jam
        }

        listMarker.map((marker) => {
          mymap.removeLayer(marker)
        })

        listMarker = []

        $.get(`/Tampilpanah/gettampilpanah/${jam}/${hari}`, function(response){
            //konten data disini nanti
            console.log(response);

            /* KOORDINAT */
            for(var z = 0; z < response.tampilpanah.length; z++){
              var tampilpanah = response.tampilpanah[z]
              var arrIcon = L.Icon.extend({
                options: {
                  iconSize: [9, 9],
                }
              });
              var arr1Icon = new arrIcon({iconUrl: '/img/arr1.png'});

              if(tampilpanah.panaharaharus == 0) {
                if(tampilpanah.value_kecarus >= 0 && tampilpanah.value_kecarus <= 5) {
                  arr1Icon = new arrIcon({iconUrl: '/img/0/1.png'})
                } else if(tampilpanah.value_kecarus > 5 && tampilpanah.value_kecarus <= 10) {
                  arr1Icon = new arrIcon({iconUrl: '/img/0/2.png'})
                } else if(tampilpanah.value_kecarus > 10 && tampilpanah.value_kecarus <= 20) {
                  arr1Icon = new arrIcon({iconUrl: '/img/0/3.png'})               
                } else if(tampilpanah.value_kecarus > 20 && tampilpanah.value_kecarus <= 30) {
                  arr1Icon = new arrIcon({iconUrl: '/img/0/4.png'})               
                } else if(tampilpanah.value_kecarus > 30 && tampilpanah.value_kecarus <= 45) {
                  arr1Icon = new arrIcon({iconUrl: '/img/0/5.png'})               
                } else if(tampilpanah.value_kecarus > 45 && tampilpanah.value_kecarus <= 60) {
                  arr1Icon = new arrIcon({iconUrl: '/img/0/6.png'})               
                } else if(tampilpanah.value_kecarus > 60 && tampilpanah.value_kecarus <= 80) {
                  arr1Icon = new arrIcon({iconUrl: '/img/0/7.png'})                
                } else if(tampilpanah.value_kecarus > 80 && tampilpanah.value_kecarus <= 100) {
                  arr1Icon = new arrIcon({iconUrl: '/img/0/8.png'})              
                } else if(tampilpanah.value_kecarus > 100 && tampilpanah.value_kecarus <= 150) {
                  arr1Icon = new arrIcon({iconUrl: '/img/0/9.png'})                
                } else if(tampilpanah.value_kecarus > 150 && tampilpanah.value_kecarus <= 200) {
                  arr1Icon = new arrIcon({iconUrl: '/img/0/10.png'})                
                } else if(tampilpanah.value_kecarus > 200 && tampilpanah.value_kecarus <= 300) {
                  arr1Icon = new arrIcon({iconUrl: '/img/0/11.png'})                
                } else if(tampilpanah.value_kecarus > 300 && tampilpanah.value_kecarus <= 400) {
                  arr1Icon = new arrIcon({iconUrl: '/img/0/12.png'})                
                } else if(tampilpanah.value_kecarus > 400) {
                  arr1Icon = new arrIcon({iconUrl: '/img/0/13.png'})
                }
              }
              else if(tampilpanah.panaharaharus == 45) {
                if(tampilpanah.value_kecarus >= 0 && tampilpanah.value_kecarus <= 5) {
                  arr1Icon = new arrIcon({iconUrl: '/img/45/1.png'})
                } else if(tampilpanah.value_kecarus > 5 && tampilpanah.value_kecarus <= 10) {
                  arr1Icon = new arrIcon({iconUrl: '/img/45/2.png'})
                } else if(tampilpanah.value_kecarus > 10 && tampilpanah.value_kecarus <= 20) {
                  arr1Icon = new arrIcon({iconUrl: '/img/45/3.png'})                
                } else if(tampilpanah.value_kecarus > 20 && tampilpanah.value_kecarus <= 30) {
                  arr1Icon = new arrIcon({iconUrl: '/img/45/4.png'})                
                } else if(tampilpanah.value_kecarus > 30 && tampilpanah.value_kecarus <= 45) {
                  arr1Icon = new arrIcon({iconUrl: '/img/45/5.png'})                
                } else if(tampilpanah.value_kecarus > 45 && tampilpanah.value_kecarus <= 60) {
                  arr1Icon = new arrIcon({iconUrl: '/img/45/6.png'})               
                } else if(tampilpanah.value_kecarus > 60 && tampilpanah.value_kecarus <= 80) {
                  arr1Icon = new arrIcon({iconUrl: '/img/45/7.png'})                
                } else if(tampilpanah.value_kecarus > 80 && tampilpanah.value_kecarus <= 100) {
                  arr1Icon = new arrIcon({iconUrl: '/img/45/8.png'})               
                } else if(tampilpanah.value_kecarus > 100 && tampilpanah.value_kecarus <= 150) {
                  arr1Icon = new arrIcon({iconUrl: '/img/45/9.png'})                
                } else if(tampilpanah.value_kecarus > 150 && tampilpanah.value_kecarus <= 200) {
                  arr1Icon = new arrIcon({iconUrl: '/img/45/10.png'})                
                } else if(tampilpanah.value_kecarus > 200 && tampilpanah.value_kecarus <= 300) {
                  arr1Icon = new arrIcon({iconUrl: '/img/45/11.png'})                
                } else if(tampilpanah.value_kecarus > 300 && tampilpanah.value_kecarus <= 400) {
                  arr1Icon = new arrIcon({iconUrl: '/img/45/12.png'})
                } else if(tampilpanah.value_kecarus > 400) {
                  arr1Icon = new arrIcon({iconUrl: '/img/45/13.png'})
                }
              }
              else if(tampilpanah.panaharaharus  == 90) {
                if(tampilpanah.value_kecarus >= 0 && tampilpanah.value_kecarus <= 5) {
                  arr1Icon = new arrIcon({iconUrl: '/img/90/1.png'})
                } else if(tampilpanah.value_kecarus > 5 && tampilpanah.value_kecarus <= 10) {
                  arr1Icon = new arrIcon({iconUrl: '/img/90/2.png'})
                } else if(tampilpanah.value_kecarus > 10 && tampilpanah.value_kecarus <= 20) {
                  arr1Icon = new arrIcon({iconUrl: '/img/90/3.png'})
                } else if(tampilpanah.value_kecarus > 20 && tampilpanah.value_kecarus <= 30) {
                  arr1Icon = new arrIcon({iconUrl: '/img/90/4.png'})
                } else if(tampilpanah.value_kecarus > 30 && tampilpanah.value_kecarus <= 45) {
                  arr1Icon = new arrIcon({iconUrl: '/img/90/5.png'})
                } else if(tampilpanah.value_kecarus > 45 && tampilpanah.value_kecarus <= 60) {
                  arr1Icon = new arrIcon({iconUrl: '/img/90/6.png'})
                } else if(tampilpanah.value_kecarus > 60 && tampilpanah.value_kecarus <= 80) {
                  arr1Icon = new arrIcon({iconUrl: '/img/90/7.png'})
                } else if(tampilpanah.value_kecarus > 80 && tampilpanah.value_kecarus <= 100) {
                  arr1Icon = new arrIcon({iconUrl: '/img/90/8.png'})
                } else if(tampilpanah.value_kecarus > 100 && tampilpanah.value_kecarus <= 150) {
                  arr1Icon = new arrIcon({iconUrl: '/img/90/9.png'})
                } else if(tampilpanah.value_kecarus > 150 && tampilpanah.value_kecarus <= 200) {
                  arr1Icon = new arrIcon({iconUrl: '/img/90/10.png'})
                } else if(tampilpanah.value_kecarus > 200 && tampilpanah.value_kecarus <= 300) {
                  arr1Icon = new arrIcon({iconUrl: '/img/90/11.png'})                
                } else if(tampilpanah.value_kecarus > 300 && tampilpanah.value_kecarus <= 400) {
                  arr1Icon = new arrIcon({iconUrl: '/img/90/12.png'})
                } else if(tampilpanah.value_kecarus > 400) {
                  arr1Icon = new arrIcon({iconUrl: '/img/90/13.png'})
                }
              }              
              else if(tampilpanah.panaharaharus  == 135) {
                if(tampilpanah.value_kecarus >= 0 && tampilpanah.value_kecarus <= 5) {
                  arr1Icon = new arrIcon({iconUrl: '/img/135/1.png'})
                } else if(tampilpanah.value_kecarus > 5 && tampilpanah.value_kecarus <= 10) {
                  arr1Icon = new arrIcon({iconUrl: '/img/135/2.png'})
                } else if(tampilpanah.value_kecarus > 10 && tampilpanah.value_kecarus <= 20) {
                  arr1Icon = new arrIcon({iconUrl: '/img/135/3.png'})
                } else if(tampilpanah.value_kecarus > 20 && tampilpanah.value_kecarus <= 30) {
                  arr1Icon = new arrIcon({iconUrl: '/img/135/4.png'})                
                } else if(tampilpanah.value_kecarus > 30 && tampilpanah.value_kecarus <= 45) {
                  arr1Icon = new arrIcon({iconUrl: '/img/135/5.png'})               
                } else if(tampilpanah.value_kecarus > 45 && tampilpanah.value_kecarus <= 60) {
                  arr1Icon = new arrIcon({iconUrl: '/img/135/6.png'})                
                } else if(tampilpanah.value_kecarus > 60 && tampilpanah.value_kecarus <= 80) {
                  arr1Icon = new arrIcon({iconUrl: '/img/135/7.png'})               
                } else if(tampilpanah.value_kecarus > 80 && tampilpanah.value_kecarus <= 100) {
                  arr1Icon = new arrIcon({iconUrl: '/img/135/8.png'})                
                } else if(tampilpanah.value_kecarus > 100 && tampilpanah.value_kecarus <= 150) {
                  arr1Icon = new arrIcon({iconUrl: '/img/135/9.png'})                
                } else if(tampilpanah.value_kecarus > 150 && tampilpanah.value_kecarus <= 200) {
                  arr1Icon = new arrIcon({iconUrl: '/img/135/10.png'})                
                } else if(tampilpanah.value_kecarus > 200 && tampilpanah.value_kecarus <= 300) {
                  arr1Icon = new arrIcon({iconUrl: '/img/135/11.png'})                
                } else if(tampilpanah.value_kecarus > 300 && tampilpanah.value_kecarus <= 400) {
                  arr1Icon = new arrIcon({iconUrl: '/img/135/12.png'})                
                } else if(tampilpanah.value_kecarus > 400) {
                  arr1Icon = new arrIcon({iconUrl: '/img/135/13.png'})
                }
              }
              else if(tampilpanah.panaharaharus  == 180) {
                if(tampilpanah.value_kecarus >= 0 && tampilpanah.value_kecarus <= 5) {
                  arr1Icon = new arrIcon({iconUrl: '/img/180/1.png'})
                } else if(tampilpanah.value_kecarus > 5 && tampilpanah.value_kecarus <= 10) {
                  arr1Icon = new arrIcon({iconUrl: '/img/180/2.png'})
                } else if(tampilpanah.value_kecarus > 10 && tampilpanah.value_kecarus <= 20) {
                  arr1Icon = new arrIcon({iconUrl: '/img/180/3.png'})
                } else if(tampilpanah.value_kecarus > 20 && tampilpanah.value_kecarus <= 30) {
                  arr1Icon = new arrIcon({iconUrl: '/img/180/4.png'})                
                } else if(tampilpanah.value_kecarus > 30 && tampilpanah.value_kecarus <= 45) {
                  arr1Icon = new arrIcon({iconUrl: '/img/180/5.png'})                
                } else if(tampilpanah.value_kecarus > 45 && tampilpanah.value_kecarus <= 60) {
                  arr1Icon = new arrIcon({iconUrl: '/img/180/6.png'})               
                } else if(tampilpanah.value_kecarus > 60 && tampilpanah.value_kecarus <= 80) {
                  arr1Icon = new arrIcon({iconUrl: '/img/180/7.png'})                
                } else if(tampilpanah.value_kecarus > 80 && tampilpanah.value_kecarus <= 100) {
                  arr1Icon = new arrIcon({iconUrl: '/img/180/8.png'})                
                } else if(tampilpanah.value_kecarus > 100 && tampilpanah.value_kecarus <= 150) {
                  arr1Icon = new arrIcon({iconUrl: '/img/180/9.png'})                
                } else if(tampilpanah.value_kecarus > 150 && tampilpanah.value_kecarus <= 200) {
                  arr1Icon = new arrIcon({iconUrl: '/img/180/10.png'})                
                } else if(tampilpanah.value_kecarus > 200 && tampilpanah.value_kecarus <= 300) {
                  arr1Icon = new arrIcon({iconUrl: '/img/180/11.png'})                
                } else if(tampilpanah.value_kecarus > 300 && tampilpanah.value_kecarus <= 400) {
                  arr1Icon = new arrIcon({iconUrl: '/img/180/12.png'})                
                } else if(tampilpanah.value_kecarus > 400) {
                  arr1Icon = new arrIcon({iconUrl: '/img/180/13.png'})
                }
              }
              else if(tampilpanah.panaharaharus  == 225) {
                if(tampilpanah.value_kecarus >= 0 && tampilpanah.value_kecarus <= 5) {
                  arr1Icon = new arrIcon({iconUrl: '/img/225/1.png'})
                } else if(tampilpanah.value_kecarus > 5 && tampilpanah.value_kecarus <= 10) {
                  arr1Icon = new arrIcon({iconUrl: '/img/225/2.png'})
                } else if(tampilpanah.value_kecarus > 10 && tampilpanah.value_kecarus <= 20) {
                  arr1Icon = new arrIcon({iconUrl: '/img/225/3.png'})
                } else if(tampilpanah.value_kecarus > 20 && tampilpanah.value_kecarus <= 30) {
                  arr1Icon = new arrIcon({iconUrl: '/img/225/4.png'})                
                } else if(tampilpanah.value_kecarus > 30 && tampilpanah.value_kecarus <= 45) {
                  arr1Icon = new arrIcon({iconUrl: '/img/225/5.png'})                
                } else if(tampilpanah.value_kecarus > 45 && tampilpanah.value_kecarus <= 60) {
                  arr1Icon = new arrIcon({iconUrl: '/img/225/6.png'})                
                } else if(tampilpanah.value_kecarus > 60 && tampilpanah.value_kecarus <= 80) {
                  arr1Icon = new arrIcon({iconUrl: '/img/225/7.png'})                
                } else if(tampilpanah.value_kecarus > 80 && tampilpanah.value_kecarus <= 100) {
                  arr1Icon = new arrIcon({iconUrl: '/img/225/8.png'})                
                } else if(tampilpanah.value_kecarus > 100 && tampilpanah.value_kecarus <= 150) {
                  arr1Icon = new arrIcon({iconUrl: '/img/225/9.png'})                
                } else if(tampilpanah.value_kecarus > 150 && tampilpanah.value_kecarus <= 200) {
                  arr1Icon = new arrIcon({iconUrl: '/img/225/10.png'})                
                } else if(tampilpanah.value_kecarus > 200 && tampilpanah.value_kecarus <= 300) {
                  arr1Icon = new arrIcon({iconUrl: '/img/225/11.png'})               
                } else if(tampilpanah.value_kecarus > 300 && tampilpanah.value_kecarus <= 400) {
                  arr1Icon = new arrIcon({iconUrl: '/img/225/12.png'})                
                } else if(tampilpanah.value_kecarus > 400) {
                  arr1Icon = new arrIcon({iconUrl: '/img/225/13.png'})
                }
              }
              else if(tampilpanah.panaharaharus  == 270) {
                if(tampilpanah.value_kecarus >= 0 && tampilpanah.value_kecarus <= 5) {
                  arr1Icon = new arrIcon({iconUrl: '/img/270/1.png'})
                } else if(tampilpanah.value_kecarus > 5 && tampilpanah.value_kecarus <= 10) {
                  arr1Icon = new arrIcon({iconUrl: '/img/270/2.png'})
                } else if(tampilpanah.value_kecarus > 10 && tampilpanah.value_kecarus <= 20) {
                  arr1Icon = new arrIcon({iconUrl: '/img/270/3.png'})
                } else if(tampilpanah.value_kecarus > 20 && tampilpanah.value_kecarus <= 30) {
                  arr1Icon = new arrIcon({iconUrl: '/img/270/4.png'})                
                } else if(tampilpanah.value_kecarus > 30 && tampilpanah.value_kecarus <= 45) {
                  arr1Icon = new arrIcon({iconUrl: '/img/270/5.png'})                
                } else if(tampilpanah.value_kecarus > 45 && tampilpanah.value_kecarus <= 60) {
                  arr1Icon = new arrIcon({iconUrl: '/img/270/6.png'})                
                } else if(tampilpanah.value_kecarus > 60 && tampilpanah.value_kecarus <= 80) {
                  arr1Icon = new arrIcon({iconUrl: '/img/270/7.png'})                
                } else if(tampilpanah.value_kecarus > 80 && tampilpanah.value_kecarus <= 100) {
                  arr1Icon = new arrIcon({iconUrl: '/img/270/8.png'})                
                } else if(tampilpanah.value_kecarus > 100 && tampilpanah.value_kecarus <= 150) {
                  arr1Icon = new arrIcon({iconUrl: '/img/270/9.png'})                
                } else if(tampilpanah.value_kecarus > 150 && tampilpanah.value_kecarus <= 200) {
                  arr1Icon = new arrIcon({iconUrl: '/img/270/10.png'})                
                } else if(tampilpanah.value_kecarus > 200 && tampilpanah.value_kecarus <= 300) {
                  arr1Icon = new arrIcon({iconUrl: '/img/270/11.png'})                
                } else if(tampilpanah.value_kecarus > 300 && tampilpanah.value_kecarus <= 400) {
                  arr1Icon = new arrIcon({iconUrl: '/img/270/12.png'})                
                } else if(tampilpanah.value_kecarus > 400) {
                  arr1Icon = new arrIcon({iconUrl: '/img/270/13.png'})
                }
              }
              else if(tampilpanah.panaharaharus  == 315) {
                if(tampilpanah.value_kecarus >= 0 && tampilpanah.value_kecarus <= 5) {
                  arr1Icon = new arrIcon({iconUrl: '/img/315/1.png'})
                } else if(tampilpanah.value_kecarus > 5 && tampilpanah.value_kecarus <= 10) {
                  arr1Icon = new arrIcon({iconUrl: '/img/315/2.png'})
                } else if(tampilpanah.value_kecarus > 10 && tampilpanah.value_kecarus <= 20) {
                  arr1Icon = new arrIcon({iconUrl: '/img/315/3.png'})
                } else if(tampilpanah.value_kecarus > 20 && tampilpanah.value_kecarus <= 30) {
                  arr1Icon = new arrIcon({iconUrl: '/img/315/4.png'})                
                } else if(tampilpanah.value_kecarus > 30 && tampilpanah.value_kecarus <= 45) {
                  arr1Icon = new arrIcon({iconUrl: '/img/315/5.png'})                
                } else if(tampilpanah.value_kecarus > 45 && tampilpanah.value_kecarus <= 60) {
                  arr1Icon = new arrIcon({iconUrl: '/img/315/6.png'})                
                } else if(tampilpanah.value_kecarus > 60 && tampilpanah.value_kecarus <= 80) {
                  arr1Icon = new arrIcon({iconUrl: '/img/315/7.png'})                
                } else if(tampilpanah.value_kecarus > 80 && tampilpanah.value_kecarus <= 100) {
                  arr1Icon = new arrIcon({iconUrl: '/img/315/8.png'})                
                } else if(tampilpanah.value_kecarus > 100 && tampilpanah.value_kecarus <= 150) {
                  arr1Icon = new arrIcon({iconUrl: '/img/315/9.png'})                
                } else if(tampilpanah.value_kecarus > 150 && tampilpanah.value_kecarus <= 200) {
                  arr1Icon = new arrIcon({iconUrl: '/img/315/10.png'})                
                } else if(tampilpanah.value_kecarus > 200 && tampilpanah.value_kecarus <= 300) {
                  arr1Icon = new arrIcon({iconUrl: '/img/315/11.png'})                
                } else if(tampilpanah.value_kecarus > 300 && tampilpanah.value_kecarus <= 400) {
                  arr1Icon = new arrIcon({iconUrl: '/img/315/12.png'})
                } else if(tampilpanah.value_kecarus > 400) {
                  arr1Icon = new arrIcon({iconUrl: '/img/315/13.png'})
                }
              }
              //taruh url icon disini               
              var marker = L.marker([tampilpanah.koordinat_x, tampilpanah.koordinat_y], {icon: arr1Icon}).on('mouseover', onMapClick).addTo(mymap);
              listMarker.push(marker)
            } /* tutup for */
          /* }) */
        });// tutup ajax juga
      }//tutup function
    </script>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-sm">
      <a class="navbar-brand" >
        <img class="logo" src="{{ ('img/logo.png') }}" alt="logo">
      </a>
      <a class="navbar-brand2" style="color: white">Universitas Gadjah Mada</a>
    </nav>    

    <!-- FITUR -->
    <div class="samping">
      <!-- JUDUL -->
      <div class="judulkotak">
        <h5 class="judulradar"><a>Radar HF (High Frequency)</a></h5>
        <a class="maksudradar">"Radar pemantauan kondisi laut"</a>
      </div>
      <!-- DATA YANG DITAMPILKAN -->
      <div class="liskotak">
        <a class="judullis">Menampilkan data daerah Parangtritis dan Keburuhan<p>Ngombol:</p>
            <li>Arah arus permukaan</li>
            <li>Kecepatan arus permukaan</li>
            <li>Tinggi gelombang</li>
            <li>Kecepatan angin</li>
        </a>
      </div>
      <form action="/action_page.php"> 
        <div class="form-group">
          <label class="data2" for="sel2">Jam:</label>
            <select class="form-control" id="sel2" name="sellist1">
              <option value="00:00:00">00:00</option>
              <option value="01:00:00">01:00</option>
              <option value="02:00:00">02:00</option>
              <option value="03:00:00">03:00</option>
              <option value="04:00:00">04:00</option> 
              <option value="05:00:00">05:00</option>
              <option value="06:00:00">06:00</option>
              <option value="07:00:00">07:00</option>
              <option value="08:00:00">08:00</option>
              <option value="09:00:00">09:00</option>
              <option value="10:00:00">10:00</option>
              <option value="11:00:00">11:00</option>
              <option value="12:00:00">12:00</option> 
              <option value="13:00:00">13:00</option>
              <option value="14:00:00">14:00</option>
              <option value="15:00:00">15:00</option>
              <option value="16:00:00">16:00</option>
              <option value="17:00:00">17:00</option>
              <option value="18:00:00">18:00</option>
              <option value="19:00:00">19:00</option>
              <option value="20:00:00">20:00</option> 
              <option value="21:00:00">21:00</option>
              <option value="22:00:00">22:00</option>
              <option value="23:00:00">23:00</option>           
            </select>
        </div>     
        <div class="form-group">
          <label class="data2" for="datepicker">Hari:</label>
          <input id="datepicker" width="215" onchange="ambilData()"/>
            <script>
              $('#datepicker').datepicker({
                  uiLibrary: 'bootstrap4'
                });
            </script>
        </div>   
        <img class="legend" src="{{ ('img/legend.png') }}" alt="legend"> 
      </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  </body>
</html>