$( window ).on("load",function(){
    $("a.displayImage").hover(function(){
  
      var uimg = $(this).attr("href");
      if( typeof uimg == 'undefined' ){
        uimg = $(this).attr("url");
      }else{
        uimg = $(this).attr("href");
      }
      $(this).append("<img src='"+uimg+"' class='displayImageTd' />");
    },function() {
      $(".displayImageTd").remove();
    });
  
    $(".viewImageBtn").click(function(){
      var uimg = $(this).attr("href");
      if( typeof uimg == 'undefined' ){
        uimg = $(this).attr("url");
      }else{
        uimg = $(this).attr("href");
      }
      if($(".displayImageClick").attr("src") == ""){
        $(".displayImageClick").attr("src",uimg);
      }
      $(".displayImageClick").show();
    });
  
    var hrefbkgrd = $(".bkgrd").attr("url");
    $(".bkgrd").css("background-image", "url("+ hrefbkgrd +")");
  
  
    $('#SearchTable').on( 'click', 'tr:not(a.displayImage)', function () {
      if($(this).find("a").length > 0){
        $(this).toggleClass('selected');
      }
    } );
    $('.selectAll-rows').on( 'click', function () {
      if($("#SearchTable tbody tr").find("a").length > 0){
        if($("#SearchTable tbody tr").hasClass('selected')){
          $("#SearchTable tbody tr").removeClass('selected');
        }else{
          $("#SearchTable tbody tr").addClass('selected');
        }
      }
    } );
  
  
  });
  
  $('body').click( function(e){
    if (!$(e.target).is(".viewImageBtn") || $(".viewImageBtn").has(e.target).length) {
      if( !$(e.target).is(".displayImageClick") || $(".displayImageClick").has(e.target).length ){
        $(".displayImageClick").hide();
      }
    }
  });
  
  
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
  
      reader.onload = function (e) {
          $(".selectImage").html('\
          <a class="btn btn-primary changeImageBtn">طھط؛ظٹظٹط± <i class="fa fa-upload"></i></a>\
          ');
          $(".imagdisplayImageClickeUploadBtn").html("\
          <a class='displayImage prvimage bkgrd' url='"+e.target.result+"'></a>\
          <a class='btn btn-info viewImageBtn' url='"+e.target.result+"'>ط¹ط±ط¶ <i class='fa fa-tv'></i></a>\
          ");
          $(".bkgrd").css("background-image", "url("+ e.target.result +")");
          $(".displayImageClick").attr("src",e.target.result);
      }
  
      reader.readAsDataURL(input.files[0]);
    }
  }
  function printButton(elementForm){
    printJS({
      printable: elementForm,
      type: 'html',
      targetStyles: ['*'],
    })
  }
  $(".fileInput").change(function(){
      readURL(this);
  });
  setTimeout(function(){
    $(".alert").remove();
  }, 5000);
  
  function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
    toastr.success('طھظ… ظ†ط³ط® ط±ط§ط¨ط· ط§ظ„ظپط§طھظˆط±ط© ظ„طھظ‚ظˆظ… ط¨ظ„طµظ‚ظ‡ ظˆظ…ط´ط§ط±ظƒطھظ‡')
  }
  
  function goLink(link){
    location.href = link;
  }