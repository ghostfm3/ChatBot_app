$(
    function () {
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
            "prompt":prompt
        }
        $.ajax({
            type: "POST",
            url: `http://localhost:8090/test`,
            dataType: 'json',
            data: senddata
        }).done( ( res ) =>
        {
            console.log("呼び出し")
            if( res["status"] == "success" )
            {
                create_id = res["id"]
                console.log(res["response"])
                $('#add_tag').append(`
                <div class="message outgoing">
                <div class="message-body">
                    <p>${prompt}</p>
                </div>
                </div>
                <div class="message incoming">
                <div ><img class="user-photo" src="sozai-rei-yumesaki-hyokkori-1.png"></div>
                <div class="message-body">
                    <p>${res["response"]}</p>
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
    }
);