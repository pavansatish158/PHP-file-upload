// light box for  images
$(document).ready(function () {
    var time = 400; //set time
    // storing src attribute in empty array
    var arrayImages = [];
    // push all src attribute in array
    $('.img-responsive').each(function () {
        var attrSrc = $(this).attr('src');
        arrayImages.push(attrSrc);
    });
    var firstItem = arrayImages[0]; // taking first item in array
    var lastItem = arrayImages[arrayImages.length - 1]; // taking last item in array
    var htmlImg1 = '<div class="container_img"><div class="closebtn">✕</div><div class="con-ac-ar"><span class="previousImage">❬</span><img class="activePopUpImg" src="'
    var htmlImg2 = '"><span class="nextImage">❭</span></div>'
    //function openPopUpImage
    function openPopUpImage() {
        for (var i = 0; i < arrayImages.length; i++) {
            var attr_src = $(this).attr('src');
            if (arrayImages[i] == attr_src) {
                $('#background_overlay').html(htmlImg1 + arrayImages[i] + htmlImg2);
                $('#background_overlay').fadeIn(time);
            }
        }
    }
    // next Image function
    function nextImage() {
        var currentImage = $('.activePopUpImg').attr('src');
        for (var i = 0; i < arrayImages.length; i++) {
            if (currentImage == arrayImages[i] && currentImage !== lastItem) {
                $('#background_overlay').html(htmlImg1 + arrayImages[i + 1] + htmlImg2);
            }
        }
    }
    // previousImage function
    function previousImage() {
        var currentImage = $('.activePopUpImg').attr('src');
        for (var i = 0; i < arrayImages.length; i++) {
            if (currentImage == arrayImages[i] && currentImage !== firstItem) {
                $('#background_overlay').html(htmlImg1 + arrayImages[i - 1] + htmlImg2);
            }
        }
    }
    // open image
    $('.img-responsive').click(openPopUpImage);
    //close image
    $(document).on('click', '.closebtn', function () {
        $('#background_overlay').fadeOut(time);
    });
    //next Image
    $(document).on('click', '.nextImage', nextImage);
    //previous Image
    $(document).on('click', '.previousImage', previousImage);
    //keyboard  
    $(document).keydown(function (e) {
        e = e || window.event;
        if (e.keyCode == '37') { //arrow left key
            previousImage();
        } else if (e.keyCode == '39') { //arrow right key 
            nextImage();
        } else if (e.keyCode == '27') { // esc key
            $('#background_overlay').fadeOut(time);
        }
    });
});
// showing recaptcha and hiding error
$(document).ready(function () {
    $("#theFileInput").click(function () {
        $("#recaptcha").hide().show('slow').delay(5000);
        $("#empty").hide();
    });
});