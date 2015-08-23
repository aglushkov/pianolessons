Turbolinks.ProgressBar.disable();
Turbolinks.pagesCached(20);
Turbolinks.enableTransitionCache();

$(function(){
    lessonLink = $("#lessonsLink");
    lessonLists = $("#lessonList");
    lessonLink.hoverIntent({
        over:function(){
            lessonLists.show();
        },
        out:function(){
            lessonLists.hide();
        },
        timeout:100
    });

    $('a').on('focus', function(){
      var elem = $(document.activeElement);
      if (elem.parents('#lessonsLink').length) {
        lessonLists.show();
      } else {
        lessonLists.hide();
      }
    });

    $('a').on('blur', function(){
      // prevent `focus` show triggered faster then `blur` hide on firefox 
      setTimeout(function(){
        var elem = $(document.activeElement);
        if (elem.parents('#lessonsLink').length == 0) {
         lessonLists.hide();
        }
      }, 0)
      
    });
});
