$(document).ready(function () {

  $(".navShowHide").on("click", function () {
    var main = $("#mainSectionContainer");
    var nav = $("#sideNavContainer");

    if (main.hasClass("leftPadding")) {
      nav.hide();
    } else {
      nav.show();
    }

    main.toggleClass("leftPadding");
  });
});

function notSignedIn() {
  alert("You must be signed in to do this.");
}

function getJsonResponseObject(response){
  try{
    var object = JSON.parse(response);
    return object.response;
  }catch (e) {
    return {'status': 'bad','message':'invalid response','data':''};
  }

  return false;
}