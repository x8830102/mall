<!DOCTYPE html>
<html>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<body>ss

<iframe id="myframe" width="1003" height="550" scrolling="no" onload="myFunction()" src="http://mall.lifelink.com.tw/"></iframe>

<p>Click the button to change the background color of the document contained in the iframe.</p>

<p id="demo">aaaa</p>
<div id="sd">asdfasf</div>
<button id="bb" onclick="myFunction()">Try it</button>

<script>

function myFunction(){
	//抓 frame select
    var x = document.getElementById("myframe");
    var y = $("#myframe").contents().find("#htab00");
	var h = $("#myframe").contents().find(".sticky-handle");
	var q = $("#myframe").contents().find(".quickview-link");
	var a = $("#myframe").contents().find("a");
    var t = $("#myframe").contents();
	var z = $("#demo");
	var position =y.position();
	a.attr("target","_blank");
	h.css("display","none");
	q.css("display","none");
	t.scrollTop(position.top),function(){
		var s = $("#myframe").contents().find(".scroll-top");
		s.css("display","none !important");
	};
	
}

</script>

</body>
</html>
