$vc=jQuery.noConflict();

$vc(function() {
    var activeItem;
    $vc('#v-nav li.level0').mouseover(function(){
        var classNameArray = $vc(this).attr('class').split(' ');
        var className = classNameArray[1];
        $vc('#v-nav li.level0.'+className+' ul').css('display', 'block');
        $vc(this).addClass('selected');
        if (!activeItem) {
            var activeItemObj = $vc('#v-nav li.active');
            if (activeItemObj)
                activeItem = activeItemObj;
        }
        if (activeItem) {
            activeItem.removeClass('active');
        }

    }).mouseout(function(){
        var classNameArray = $vc(this).attr('class').split(' ');
        var className = classNameArray[1];
        $vc('#v-nav li.level0.'+className+' ul').css('display', 'none');
        $vc(this).removeClass('selected');
        if (activeItem) {
            activeItem.addClass('active');
        }
    });

});