function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}   
$(function() {  
    $('#status').on('change',function(){        
        if($.inArray($(this).val(), ['for_sale', 'phase_out', 'obsolete']) >= 0){
            $("#pid").attr("required", true);
            $("#pid-label").html("<b>Pid<b class='star'>*</b></b>");
            $("#hts").attr("required", true);
            $("#hts-label").html("<b>Hts broj<b class='star'>*</b></b>");
            $("#tax").attr("required", true);
            $("#tax-label").html("<b>Taksa<b class='star'>*</b></b>");
            $("#eccn").attr("required", true);
            $("#eccn-label").html("<b>Eccn<b class='star'>*</b></b>");
            $('.star').css('color', 'red');
        } else {
            $("#pid").attr("required", false);
            $('#pid-label').text('Pid');
            $("#hts").attr("required", false);
            $('#hts-label').text('Hts broj');
            $("#tax").attr("required", false);
            $('#tax-label').text('Taksa');
            $("#eccn").attr("required", false);
            $('#eccn-label').text('Eccn');
        }   
    });
});