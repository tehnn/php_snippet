<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://maps.googleapis.com/maps/api/js?sensor=false&language=th"></script>
        <script src="lib/jquery.js"></script>
        <script src="lib/gmap3.min.js"></script>
        <script>
            $(function () {
                var mcenter = new google.maps.LatLng(16, 100);
                $('#btn').click(function () {
                    getLocation();
                });
                
                $('#map-canvas').gmap3({
                    map: {
                        options: {
                            center: mcenter,
                            zoom: 6,
                            mapTypeControl: true,
                            mapTypeControlOptions: {
                                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                            },
                            navigationControl: true,
                            scrollwheel: true,
                            streetViewControl: true
                        }
                    },
                });
            });

            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else {
                    $('#lat').val('location error');
                    $('#lng').val('location error');
                }
            }
            function showPosition(position) {
                lt = position.coords.latitude;
                ln = position.coords.longitude;
                $('#lat').val(lt);
                $('#lng').val(ln);
                $('#map-canvas').gmap3({
                    getaddress: {
                        latLng: new google.maps.LatLng(lt, ln),
                        callback: function (results) {
                            content = results && results[1] ? results && results[1].formatted_address : "no address";
                            $('#addr').val(content);
                            var map = this.gmap3("get");
                            map.panTo(new google.maps.LatLng(lt, ln));

                            $(this).gmap3({
                                marker: {
                                    latLng: results[0].geometry.location
                                }
                            });
                            map.setZoom(12);
                        }
                    },
                });
            }
        </script>

    </head>
    <body>
        <div>
            <form>
                <input type="text" id="lat" name="lat" placeholder="ละติจูด" style="width: 300px"><br>        
                <input type="text" id="lng" name="lng" placeholder="ลองจิจูด" style="width: 300px"><br>
                <textarea id="addr" name="addr" placeholder="ที่ตั้ง" style="width: 300px"></textarea><br>
                <button id="btn" type="button">ประมวลผล</button>
                
            </form>

        </div><br>
        <div id="map-canvas" style="width: 500px;height: 400px; border: solid"></div>
    </body>
</html>



