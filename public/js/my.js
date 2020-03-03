var idToDelete = [];


$(function () {

    $(".checkBoxDelete").click(function () {
        var id = $(this).attr('id');
        var index = idToDelete.indexOf(id);

        if($(this).is(':checked') && index == -1){
            idToDelete.push(id);
        } else idToDelete.splice(index,1);

        console.log(idToDelete);

    });

    $(".btn_delete_selected").click(function () {
        if(idToDelete.length != 0){
            var url = document.location.href;

            if (confirm('Attention! Vous allez définitivement supprimer les élements sélectionnés ')) {
                //console.log(url);
               //idToDelete.forEach(element => console.log("{{ url('delete') }}");
                   $.ajax({
                       url:url ,
                       method: "delete",
                       data:{ "tab" : idToDelete},
                       success: window.location.href= url

                   }
               );
                  /*  $.ajax({
                        url:"/".id,
                        method: "delete",
                    */
                //});


            } else {
                console.log('Annulé !');
            }
        }

    });
});



