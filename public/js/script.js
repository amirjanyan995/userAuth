$(document).ready(function (){
    if(document.getElementById("updateStatus") !== null)
        $('#updateStatus').delay(2000).fadeOut(1000);
});

$(document).ready(function(){
    if(document.getElementById('search')!=null){
        $( "#search" ).keyup(function() {
            var inputSearch=$('#search').val();
            if(inputSearch.length>=2){
                $.ajax({
                    url: '/posts/search/'+inputSearch,
                    type: "post",
                    data: ({
                        '_token': $('input[name=_token]').val()
                    }),
                    success:function(data){
                        $("#block-search-result").show();
                        $("#list-search-result").html(data);
                    },
                });
            }else{
                $("#block-search-result").hide();
            }
        });
    }
});
/*$(document).ready(function () {
    if(document.getElementById('category')!=null){
        var val=$('#category').val();
        $('#category').change(function () {
           alert(val);
        });
    }
});*/
function al(postId) {
    var answer=confirm("delete post?");
    if(answer){
        $.ajax({
            url: "post/destroy",
            type: "POST",
            data: ({
                postID:postId
            }),
            dataType: "html",
            success:function(data) {
                alert(data);
            }
        });
    }
}

function delImg(postId) {
    var answer=confirm("delete Image?");
    if(answer){
        $.ajax({
            url: '/post/removeImg/'+postId,
            type: "post",
            data: ({
                '_token': $('input[name=_token]').val()
            }),
            success:function(data) {
                data=JSON.parse(data);
                if(data.status==1){
                    var parent=document.getElementById('upload');
                    parent.removeChild(document.getElementById('postIMG'));
                    var t=document.getElementById('uloadText').parentElement;
                    t.removeChild(document.getElementById(''));
                    document.getElementById('uploadIMG').style.display="block";
                    var text=document.createTextNode("Upload Images")
                    parent.insertBefore(text,document.getElementById('uploadIMG'));
                }
            }
        });
    }
}

function delPost(postId) {
     var answer=confirm("delete Post?");
    if(answer){
        $.ajax({
            url: '/post/delete/'+postId,
            type: "post",
            data: ({
                '_token': $('input[name=_token]').val()
            }),
            success:function(data) {
                data=JSON.parse(data);
                if(data.status==1){
                    var parent=document.getElementById('post'+postId).parentNode;
                    parent.removeChild(document.getElementById('post'+postId));
                }
            }
        });
    }
}

function delUser(userID) {
    var answer=confirm("delete User?");
    if(answer){
        $.ajax({
            url: '/admin/page/user/'+userID+'/delete',
            type: "post",
            data: ({
                '_token': $('input[name=_token]').val()
            }),
            success:function(data) {
                data=JSON.parse(data);
                if(data.status==1){
                    var parent=document.getElementById('user'+userID).parentNode;
                    parent.removeChild(document.getElementById('user'+userID));
                }else if(data.status==0){
                    alert(data.error);
                }
            }
        });
    }
}
