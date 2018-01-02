
$(function() {

	getIndex();
});

// 获取页面内容
function getIndex() {
	$.ajax({
		type: 'GET',
		url: '/index.php?m=wap&f=zxkt_index&v=index',
		dataType: 'json',
		timeout: 3000,
		success: function(res) {
			console.log(res)
			if(res && res.code == 1) {
				var data = res.data;

				solveTemplate('#video-box', '#video-data', data);
				solveTemplate('#gl-box', '#gl-data', data);
				solveTemplate('#story-box', '#story-data', data);
				solveTemplate('#fs-box', '#fs-data', data);
				solveTemplate('#cl-box', '#cl-data', data);


				setStr('.video-title', 46); // 视频讲堂标题
				setStr('.story-h3', 46); // 业主故事描述
				setStr('.same-h3', 24); // 装修攻略、装修风水、家装选材标题
				setStr('.same-p', 58); // 装修攻略、装修风水、家装选材描述
			}
		},
		error: function() {
			console.log('error');
		}
	});
}