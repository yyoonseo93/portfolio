
const btnSubmit = document.querySelector('input[type=submit]');
btnSubmit.onclick = function(e){
    e.preventDefault();
    submitContents(this);
}

var oEditors = [];

nhn.husky.EZCreator.createInIFrame({
oAppRef: oEditors,
elPlaceHolder: "ir1",
sSkinURI: "smart2/SmartEditor2Skin.html",	
htParams : {
    bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
    bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
    bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
    //bSkipXssFilter : true,		// client-side xss filter 무시 여부 (true:사용하지 않음 / 그외:사용)
    //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
    fOnBeforeUnload : function(){
    }
}, //boolean
fOnAppLoad : function(){
},
fCreator: "createSEditor2"
});

function submitContents(elClickedObj) {
	oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.

	try {
		elClickedObj.form.submit();
	} catch(e) {}
}