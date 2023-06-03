<style>
    .errorPrint{
        font-size: 12px;
        color: #af2000 !important;
        padding: 5px 5px;
        display: none;
    }
    .eyepassword .fa-eye-slash {
        position: absolute;
        bottom: 13px;
        right: 8px;
        font-size: 15px;
        color: gray;
        cursor:pointer;
    }
    .eyepassword .fa-eye {
        position: absolute;
        bottom: 13px;
        right: 8px;
        font-size: 15px;
        color: gray;
        cursor:pointer;
    }
</style>
<style type="text/css">
    #map {
        height: 330px;
        width: 100%;
    }
    #pac-input {
        display: block;
        width: 100%;
        height: calc(2.25rem + 2px);
        padding: .375rem .75rem;
        margin-right: 10px;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0 .25rem .25rem 0;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    #mapBtn{
        border-radius:0;
        padding: 8px 40px !important;
        font-size: large;
    }
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Add a Driver </h1>
    </div>  
    <?= $this->session->flashdata('response'); ?>
    <div class="content eventdeatil">  
        <div class="card"> 
            <div class="card-body">
                <form method="POST" id="uploadProduct" enctype="multipart/form-data">
                    <div class="eventrow">
                        <div class="row m-t-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Full Name</label>
                                    <input class="form-control regInputs" value="<?php echo set_value('name') ?>" data-title="Full Name" id="name" name="name" type="text" placeholder="">
                                    <p class="errorPrint" id="nameError"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Mobile Number</label>
                                    <div>
                                        <input type="text" id="country_code" class="form-control regInputs" value="+218" style="width:22%;float: left;cursor:no-drop;" readonly="">
                                        <input style="display: inline;width: 77%;" type="text" class="form-control regInputs" data-title="Mobile Number" id="mobile" name="mobile" type="text" placeholder="" onkeypress="return (event.charCode > 47 && event.charCode < 58)">
                                    </div>
                                    <p class="errorPrint" id="mobileError"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email Address</label>
                                    <input class="form-control regInputs" data-title="Email Address" id="email" name="email" type="text" placeholder="">
                                    <p class="errorPrint" id="emailError"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group eyepassword">
                                    <label for="">Password</label>
                                    <input class="form-control regInputs" data-title="Password" id="password" name="password" type="Password" placeholder="">
                                    <i class="fa fa-eye showhide" data-count="1" onclick="showHide(this);"></i>
                                    <p class="errorPrint" id="passwordError"></p>
                                </div>
                            </div>
                        </div> 
                        <div class="row m-t-2" >
                            <div class="col-md-12" >
                                <p class="errorPrint" id="locationError"></p>
                                <input type="hidden" name="location" data-title="Address"  class="form-control regInputs" id="location">
                                <input type="hidden" name="lat" id="lat">
                                <input type="hidden" name="lng" id="lng">
                                <div id="pac-card">
                                    <div class="form-group" >
                                        <!--<label for="">Address</label>-->
                                        <div class="row" style="padding-right: 10px;margin-top: 10px;">
                                            <div class='col-md-4' style="padding-right:0;">
                                                <button id="mapBtn" style="cursor:pointer;" type="button" onclick="setLocation(this);" class="composemail save-length pull-right">Select</button>
                                            </div>
                                            <div class='col-md-8' style="padding-left:0;">
                                                <input class="form-control regInputs" id="pac-input" data-title="Address" name="address" type="text" placeholder="Enter Location">
                                            </div></div>

                                        <input type="hidden" name="latitude" id="latitude">
                                        <input type="hidden" name="longitude" id="longitude">
                                    </div>
                                </div>
                                <div id="map"></div>
                            </div>
                        </div> 
                        <div class="row mt-4">
                            <div class="col-lg-12 col-xs-12">
                                <button style="cursor:pointer;" type="button" onclick="addDriver(this);" class="composemail save-length pull-right"> Create Account</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>    

    <script>
        function showErrorMessage(id, msg) {
            $("#" + id).empty();
            $("#" + id).append(msg);
            $("#" + id).css('display', 'block');
        }
        function addDriver(o) {
            $(".errorPrint").css('display', 'none');
            var idValidate = false;
            $(".regInputs").each(function (index, value) {
                // console.log('div' + index + ':' + $(this).attr('id'));
                if ($(this).val()) {
                    $("#" + $(this).attr('id') + 'Error').css('display', 'none');
                } else {
                    idValidate = true;
                    $("#" + $(this).attr('id') + 'Error').empty();
                    $("#" + $(this).attr('id') + 'Error').append('*' + $(this).attr('data-title') + ' is required field');
                    $("#" + $(this).attr('id') + 'Error').css('display', 'block');
                    //$("html, body").animate({ scrollTop: 0 }, "slow");
                }
            });
            if (idValidate) {
                return false;
            } else {
                var email = $("#email").val();
                var mobile = $("#mobile").val();
                var name = $("#name").val();
                var password = $("#password").val();
                var country_code = '218';
                var address = $("#location").val();
                var latitude = $("#lat").val();
                var longitude = $("#lng").val();
                if (country_code) {
                    var emailPattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
                    if (!emailPattern.test(email)) {
                        showErrorMessage('emailError', '*not a valid e-mail address');
                    } else {
                        if ((mobile.length) < 7) {
                            showErrorMessage('mobileError', '*not a valid Mobile Number');
                        } else {
                            if ((password.length) < 8) {
                                showErrorMessage('passwordError', 'Password should be greater than 7 digits.');
                            } else {
                                var reg_form_data = new FormData();
                                reg_form_data.append("name", name);
                                reg_form_data.append("email", email);
                                reg_form_data.append("mobile", mobile);
                                reg_form_data.append("password", password);
                                reg_form_data.append("country_code", country_code);
                                reg_form_data.append("address", address);
                                reg_form_data.append("latitude", latitude);
                                reg_form_data.append("longitude", longitude);
                                reg_form_data.append("method", 'addDriver');
                                $.ajax({
                                    url: "<?php echo base_url("/admin/Home/ajax") ?>",
                                    type: "POST",
                                    data: reg_form_data,
                                    enctype: 'multipart/form-data',
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    success: function (data) {
                                        returnObject = JSON.parse(data);
                                        //console.log('asasasas' , returnObject);
                                        if (returnObject['error_code'] == 100) {
                                            alert(returnObject['message']);
                                            location.reload();
                                        } else {
                                            alert(returnObject['message']);
                                        }
                                    },
                                    error: function (error) {
                                        alert("error");
                                    }
                                });
                            }
                        }
                    }
                } else {
                    showErrorMessage('country_codeError', '*country_code is required field');
                }
            }
        }

        function showHide(obj) {
            var check = $(obj).attr('data-count');
            if (check == 1) {
                $("#password").attr('type', 'text');
                $(obj).attr('data-count', '0');
                $(obj).removeClass('fa-eye');
                $(obj).addClass('fa-eye-slash');
            } else {
                $("#password").attr('type', 'password');
                $(obj).attr('data-count', '1');
                $(obj).removeClass('fa-eye-slash');
                $(obj).addClass('fa-eye');
            }
        }

        function setLocation(obj) {
            if ($('#pac-input').val()) {
                $("#locationError").html('');
                $("#location").val($('#pac-input').val());
                $("#lat").val($('#latitude').val());
                $("#lng").val($('#longitude').val());
            } else {
                alert('please select a location');
            }
        }
    </script>
    <script type="text/javascript">
        function initMap() {
            var centerCoordinates = new google.maps.LatLng(28.6162944, 77.1457024);
            var map = new google.maps.Map(document.getElementById('map'), {
                center: centerCoordinates,
                zoom: 7
            });
            var card = document.getElementById('pac-card');
            var input = document.getElementById('pac-input');
            var infowindowContent = document.getElementById('infowindow-content');
            map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);
            var autocomplete = new google.maps.places.Autocomplete(input);
            var infowindow = new google.maps.InfoWindow();
            //SHOW ADDRESS ON MARKER
            var geocoder = new google.maps.Geocoder();
            infowindow.setContent(infowindowContent);
            var marker = new google.maps.Marker({
                position: centerCoordinates,
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP,
            });

            google.maps.event.addListener(map, 'click', function (e) {
                updateMarkerPosition(marker, e);
            });

            marker.addListener('click', toggleBounce);
            marker.addListener('dragend', function () {
                var currentlatlng = marker.position;
                var lat = marker.position.lat();
                var lng = marker.position.lng();
                geocoder.geocode({'location': currentlatlng}, function (results, status) {
                    if (status === 'OK') {
                        if (results[1]) {
                            $('#pac-input').val(results[1].formatted_address);
                            marker.setPosition(currentlatlng);
                            map.setCenter(marker.getPosition());
                            infowindow.setContent(results[1].formatted_address);
                            infowindow.open(map, marker);
                        } else {
                            window.alert('No results found');
                        }
                    } else {
                        window.alert('Geocoder failed due to: ' + status);
                    }
                });
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
                console.log("latlng is " + JSON.stringify(currentlatlng));
                map.setCenter(marker.getPosition());
            });
            google.maps.event.addDomListener(input, 'keydown', function (e) {
                if (e.keyCode == 13) {
                    e.preventDefault();
                }
            });
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                document.getElementById('latitude').value = place.geometry.location.lat();
                document.getElementById('longitude').value = place.geometry.location.lng();
                if (!place.geometry) {
                    document.getElementById("location-error").style.display = 'inline-block';
                    document.getElementById("location-error").innerHTML = "Cannot Locate '" + input.value + "' on map";
                    return;
                }
                map.fitBounds(place.geometry.viewport);
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
                marker.setMap(map);
                infowindowContent.children['place-icon'].src = place.icon;
                infowindowContent.children['place-name'].textContent = place.name;
                infowindowContent.children['place-address'].textContent = input.value;
                console.log(input.value + '---' + place.name + '---' + place.icon);
                infowindow.open(map, marker);
            });
        }
        function updateMarkerPosition(marker, e) {
            marker.setPosition(e.latLng);
        }
        function toggleBounce() {
            if (marker.getAnimation() !== null) {
                marker.setAnimation(null);
            } else {
                marker.setAnimation(google.maps.Animation.BOUNCE);
            }
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8Wu_c6k3ab9I7ye6-_O5Z1-BNs76EdqU&libraries=places&callback=initMap"
    async defer></script>