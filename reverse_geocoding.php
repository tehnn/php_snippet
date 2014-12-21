<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://maps.googleapis.com/maps/api/js?sensor=false&language=th"></script>
        <script src="lib/jquery.js"></script>
        <script src="lib/gmap3.min.js"></script>
        <script>
            $(function () {
                $('#btn').click(function () {
                    getLocation();
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
                $(this).gmap3({
                    getaddress: {
                        latLng: new google.maps.LatLng(lt, ln),
                        callback: function (results) {
                            content = results && results[1] ? results && results[1].formatted_address : "no address";
                            $('#addr').val(content);
                        }
                    }
                });
            }
        </script>

    </head>
    <body>
        <div>
            <form>
                <input type="text" id="lat" name="lat" placeholder="ละติจูด" style="width: 300px"><br>        
                <input type="text" id="lng" name="lng" placeholder="ลองจิจูด" style="width: 300px"><br>
                <input type="text" id="addr" name="addr" placeholder="ที่ตั้ง" style="width: 300px"><br>
                <button id="btn" type="button">พิกัด</button>
            </form>

        </div>
    </body>
</html>



