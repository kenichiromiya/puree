$(document).ready(function () {

	$(function(){
/*
		alert(window.history.next);
		if(window.history.next){
		} else {
			$.jStorage.deleteKey("items");
			$.jStorage.deleteKey("page");
		}
*/
/*
		if ($.jStorage.get("click")){
			$.jStorage.set("click", false);
		} else {
			$.jStorage.deleteKey("items");
			$.jStorage.deleteKey("page");
		}
		var value = $.jStorage.get("items");
		if (value){
			$("#items").children().remove();
			$("#items").html(value);
		}
		var page = $.jStorage.get("page");
		if (page) {
		} else {
			page = 1;
		}

*/
/*
		var $items = $('#items');
		$items.masonry({
			itemSelector : '.item'
		});
*/
/*
		$items.infinitescroll({
			//state: {
			//	currPage: page,
			//},
			navSelector  : '#page-nav',    // ページのナビゲーションを選択 
			nextSelector : '#page-nav a',  // 次ページへのリンク
			itemSelector : '.item',     // 持ってくる要素のclass
			loading: {
				finishedMsg: '', //次のページがない場合に表示するテキスト
				img: '' //ローディング画像のパス
			}
		},

		function( newElements ) {

			//$.jStorage.set("items", $("#items").html());
			//var opts = $('#items').data('infinitescroll').options;
			//$.jStorage.set("page", opts.state.currPage);
			var $newElems = $( newElements ).css({ opacity: 0 });

			$newElems.imagesLoaded(function(){
				$newElems.animate({ opacity: 1 });
				$items.masonry( 'appended', $newElems, true ); 
                                //var state = $items;
                                //history.replaceState(state, "", "");
			});
		});
*/
	})
/*
                $(window).on('popstate', function(jqevent) {
                        if(jqevent.originalEvent.state){
                                $("#items").children().remove();
                                //$("#items").html(jqevent.originalEvent.state);
                                $("#items").append(jqevent.originalEvent.state);
				alert("aaa");
                        }
                });
*/

/*
	var $container = $('#container');
	$container.imagesLoaded(function(){
		$container.masonry({
			itemSelector : '.item',
			columnWidth : 230
		});
	});
*/
    var uploadFiles = function (files) {
        // FormData オブジェクトを用意
        var fd = new FormData();

        // ファイル情報を追加する
        for (var i = 0; i < files.length; i++) {
            fd.append(i, files[i]);
        }

        // XHR で送信
        //url = document.URL.replace(/\/[a-zA-z0-9_]+$/,"/");
        //url = document.URL+"<?=$session['account_id']?>";
	//url = document.URL;
    alert($("#drag").parent().get(0).action);
    url = $("#drag").parent().get(0).action;
	//url = "<?=BASE?>"+"files/"+"<?=$req['id']?>";
	$.ajax({
		url: url,
		type: "POST",
		data: fd,
		processData: false,
		contentType: false,
		success: function(html){
		},
		complete: function(html){
			document.location = url;
		}
	});
    };

   //var value = $.jStorage.get("items");
/*
    $(".lightbox").live("click",function (e) {
	//$.jStorage.set("items", $("#items").html());
	$("iframe").attr("src",$(this).attr("href"));
	 e.preventDefault();
	//$.jStorage.set("click", true);
    });
*/

    $("#multiple").bind("change", function () {
        // 選択されたファイル情報を取得
        var files = this.files;

        // アップロード処理
        uploadFiles(files);
    });


    // ドラッグドロップからの入力
    $("#drag").bind("drop", function (e) {
        // ドラッグされたファイル情報を取得
        var files = e.originalEvent.dataTransfer.files;

        // アップロード処理
        uploadFiles(files);
	e.preventDefault();
    });

    /*
I was able to fix the problem I was having by preventing the default action on a 'dragover' or a 'dragenter' event. This allows the 'drop' event. 

This is not a hack fix it is per the spec. 
More information can be found here: 
https://developer.mozilla.org/en-US/docs/Mozilla_event_reference/dragenter
    */
    $("#drag").bind("dragover", function (e) {
	e.preventDefault();
    });

    $("#drag").bind("dragenter", function (e) {
	e.preventDefault();
    });
});
