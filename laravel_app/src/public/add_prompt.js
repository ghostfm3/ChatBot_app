$(function () {
    $("#submit_button").on('click', function (e) {
        console.log("呼び出し");
        $.ajaxSetup( {
          headers: {
            'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]').attr( 'content' )
          }
        });

        e.preventDefault();
        const prompt = $('#text').val();
     
        
        console.log(prompt)

        var senddata = {
            "prompt":prompt,
            "newDeadline":newDeadline,
        }
        $.ajax({
            type: "post",
            url: `http://localhost:8085/todos`,
            dataType: 'json',
            data: senddata
        }).done( ( res ) =>
        {
            console.log("呼び出し")
            if( res["status"] == "success" )
            {
                create_id = res["id"]
                console.log(create_id)
                $('#add_tag').append(`
                <div class="message outgoing">
                <div class="message-body">
                    <p>${$chatres->prompt}</p>
                </div>
                </div>
                `)

                console.log("成功")
            }

        }).fail( function(XMLHttpRequest, textStatus, errorThrown)
        {
        
            console.log(XMLHttpRequest.status);
            console.log(textStatus);
            console.log(errorThrown);
        }
        );
    });
});