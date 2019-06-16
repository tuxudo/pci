<div id="pci-tab"></div>
<h2 data-i18n="pci.clienttab"></h2>

<div id="pci-msg" data-i18n="listing.loading" class="col-lg-12 text-center"></div>

<script>
$(document).on('appReady', function(){
	$.getJSON(appUrl + '/module/pci/get_data/' + serialNumber, function(data){
        
        // Check if we have data
        if( data == "" || ! data){
            $('#pci-msg').text(i18n.t('pci.nopci'));
        } else {

            // Hide
            $('#pci-msg').text('');
            $('#pci-count-view').removeClass('hide');
        
            // Set count of pci devices
            $('#pci-cnt').text(data.length);
            var skipThese = ['id','name'];
            $.each(data, function(i,d){

                // Generate rows from data
                var rows = ''
                for (var prop in d){
                    // Skip skipThese
                    if(skipThese.indexOf(prop) == -1){
                        if (d[prop] == null || d[prop] == ""){
                            // Do nothing for the nulls to blank them
                        } else {
                            rows = rows + '<tr><th>'+i18n.t('pci.'+prop)+'</th><td>'+d[prop]+'</td></tr>';
                        }
                    }
                }
                $('#pci-tab')
                    .append($('<h4>')
                        .append($('<i>')
                            .addClass('fa fa-bolt'))
                        .append(' '+d.name))
                    .append($('<div style="max-width:390px;">')
                        .append($('<table>')
                            .addClass('table table-striped table-condensed')
                            .append($('<tbody>')
                                .append(rows))))
            })
        }
    });
});
</script>
