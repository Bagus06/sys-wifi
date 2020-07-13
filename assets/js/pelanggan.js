function set_option(select,data)
{
    if(select[0]!= undefined){
        while (select[0].options.length) {
        select[0].remove(0);
    }
        var selectbox = select[0].options;
        for(var i = 0, l = data.length; i < l; i++){
            var option = data[i];
            select[0].options.add( new Option(option.text, option.value, option.selected,option.selected) );
        }
    }
}
$(document).ready(function(){
    var api_provinces = _URL+"/pelanggan/get_provinces/";
    var api_regencies = _URL+"/pelanggan/get_regencies/";
    var api_districts = _URL+"/pelanggan/get_districts/";
    var api_villages = _URL+"/pelanggan/get_villages/";
    $.getJSON(api_provinces,function(result){
        var option = result;
        var tmp = [{'text':'None','value':'0','selected':'true'}];
        for(var i =0; i< option.length;i++){
            tmp[i+1] = [];
            
            tmp[i+1].text = option[i].name;
            tmp[i+1].value = option[i].id;
        }
        set_option($('select[name="prov_id"]'),tmp);
    });
    $.getJSON(api_regencies,function(result){
        $('select[name="prov_id"]').on('change',function(){
            var prov_id = $(this).val();
            $('select[name="prov_id"] option:selected').each(function(){
                var name = $(this).text();
                $('input[name="prov"]').val(name);
            });
            if(result[prov_id] === undefined){
                var tmp = [{'text':'None','value':'0','selected':'true'}];
            }else{
                var option = result[prov_id];
                var tmp = [{'text':'None','value':'0','selected':'true'}];
                for(var i =0; i< option.length;i++){
                    tmp[i+1] = [];
                    
                    tmp[i+1].text = option[i].name;
                    tmp[i+1].value = option[i].id;
                }
            }
            set_option($('select[name="kab_id"]'),tmp);
        });
    });
    $.getJSON(api_districts,function(result){
        $('select[name="kab_id"]').on('change',function(){
            var kab_id = $(this).val();
            $('select[name="kab_id"] option:selected').each(function(){
                var name = $(this).text();
                $('input[name="kab"]').val(name);
            });
            if(result[kab_id] === undefined){
                var tmp = [{'text':'None','value':'0','selected':'true'}];
            }else{
                var option = result[kab_id];
                var tmp = [{'text':'None','value':'0','selected':'true'}];
                for(var i =0; i< option.length;i++){
                    tmp[i+1] = [];
                    
                    tmp[i+1].text = option[i].name;
                    tmp[i+1].value = option[i].id;
                }
            }
            set_option($('select[name="kec_id"]'),tmp);
        });
    });

    $('select[name="kec_id"]').on('change',function(){
        var kec_id = $(this).val();
        $('select[name="kec_id"] option:selected').each(function(){
            var name = $(this).text();
            $('input[name="kec"]').val(name);
        });
        $.getJSON(api_villages+kec_id,function(result){
            if(result[kec_id] === undefined){
                var tmp = [{'text':'None','value':'0','selected':'true'}];
            }else{
                var option = result[kec_id];
                var tmp = [{'text':'None','value':'0','selected':'true'}];
                for(var i =0; i< option.length;i++){
                    tmp[i+1] = [];
                    
                    tmp[i+1].text = option[i].name;
                    tmp[i+1].value = option[i].id;
                }
            }
            set_option($('select[name="desa_id"]'),tmp);
        });
    });
    $('select[name="desa_id"]').on('change',function(){
        var desa_id = $(this).val();
        $('select[name="desa_id"] option:selected').each(function(){
            var name = $(this).text();
            $('input[name="desa"]').val(name);
        });
    });

    function getLocation() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(showPosition);
        } else { 
          alert("browser anda tidak mendukung untuk menangkap lokasi anda");
        }
      }
  
      function showPosition(position) {
          $("#form_pelanggan").find(".panel-body").append("<label>LOKASI</label><br>Latitude: " + position.coords.latitude + 
        "<br>Longitude: " + position.coords.longitude+"<input type='hidden' name='koordinat' value='long:"+position.coords.longitude+",lat:"+position.coords.latitude+"'>");
      }

      getLocation();
});