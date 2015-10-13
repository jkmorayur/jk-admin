// convert bytes into friendly format
function bytesToSize(bytes) {
    var sizes = ['Bytes', 'KB', 'MB'];
    if (bytes == 0)
        return 'n/a';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
}
;

// check for selected crop region
function checkForm() {
    if (parseInt($('#w').val()))
        return true;
    $('.error').html('Please select a crop region and then press Upload').show();
    return false;
}
;

// update info by cropping (onChange and onSelect events handler)
//    function updateInfo(e) {
//        console.log(e);
//        $('#x1').val(e.x);
//        $('#y1').val(e.y);
//        $('#x2').val(e.x2);
//        $('#y2').val(e.y2);
//        $('#w').val(e.w);
//        $('#h').val(e.h);
//    }
//    ;

// clear info by cropping (onRelease event handler)
function clearInfo() {
    $('.info #w').val('');
    $('.info #h').val('');
}
;

// Create variables (in this scope) to hold the Jcrop API and image size
var jcrop_api, boundx, boundy;

function fileSelectHandler(id, w, h) {

    // get selected file
    var oFile = $('#image_file' + id)[0].files[0];

    // hide all errors
    $('.error' + id).hide();

    // check for image type (jpg and png are allowed)
    var rFilter = /^(image\/jpeg|image\/png)$/i;
    if (!rFilter.test(oFile.type)) {
        $('.error' + id).html('Please select a valid image file (jpg and png are allowed)').show();
        return;
    }

    // check for file size
//        if (oFile.size > 250 * 1024) {
//            $('.error' + id).html('You have selected too big file, please select a one smaller image file').show();
//            return;
//        }

    // preview element
    var oImage = document.getElementById('preview' + id);

    // prepare HTML5 FileReader
    var oReader = new FileReader();
    oReader.onload = function (e) {

        // e.target.result contains the DataURL which we can use as a source of the image
        oImage.src = e.target.result;
        oImage.onload = function () { // onload event handler

            // display step 2
            $('.step2').fadeIn(500);

            // display some basic image info
            var sResultFileSize = bytesToSize(oFile.size);
            $('#filesize').val(sResultFileSize);
            $('#filetype').val(oFile.type);
            $('#filedim').val(oImage.naturalWidth + ' x ' + oImage.naturalHeight);

            // destroy Jcrop if it is existed
            if (typeof jcrop_api != 'undefined') {
                jcrop_api.destroy();
                jcrop_api = null;
//                $('#preview' + id).width(oImage.naturalWidth);
//                $('#preview' + id).height(oImage.naturalHeight);
            }

            // initialize Jcrop
            $('#preview' + id).Jcrop({
                minSize: [100, 32], // min crop size
                
                bgFade: true, // use fade effect
                bgOpacity: .3, // fade opacity
                boxWidth: 500,
                boxHeight: 500,
                setSelect: [0, 160, 160, 0],
                onChange: function (e) {
                    $('#x1' + id).val(e.x);
                    $('#y1' + id).val(e.y);
                    $('#x2' + id).val(e.x2);
                    $('#y2' + id).val(e.y2);
                    $('#w' + id).val(e.w);
                    $('#h' + id).val(e.h);
                },
                onSelect: function (e) {
                    //$(this).setSelect([x, y, x2, y2]); 
                    //console.log(e);
                },
                onRelease: clearInfo
            });
        };
    };
    // read selected file as DataURL
    oReader.readAsDataURL(oFile);
}