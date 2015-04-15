$(function(){
	$("#categoryForm").validation({
		cname: {
			 rule: {
				 maxlen:10,
				 required: true
			 },
			 error: {
				 maxlen: "不能大于10个字符 ",
		         required: "不能为空 "
		     },
		     message: "分类名称长度 1到 10 位 ",
		     success: "分类名称正确"
		 },
		 title: {
			 rule: {
				 maxlen:40,
				 required: true
			 },
			 error: {
				 maxlen: "不能大于40个字符 ",
		         required: "不能为空 "
		     },
		     message: "分类标题长度 1到 40 位 ",
		     success: "分类标题正确"
		 },
		 keywords: {
			 rule: {
				 maxlen:60,
				 required: true
			 },
			 error: {
				 maxlen: "不能大于60个字符 ",
		         required: "不能为空 "
		     },
		     message: "关键字长度 1到 60 位 ",
		     success: "关键字正确"
		 },
		 description: {
			 rule: {
				 maxlen:80,
				 required: true
			 },
			 error: {
				 maxlen: "不能大于80个字符 ",
		         required: "不能为空 "
		     },
		     message: "分类描述长度 1到 80 位 ",
		     success: "分类描述正确"
		 },
		 sort: {
			 rule: {
				 num:"1,100",
				 required: true
			 },
			 error: {
				 num: "排序不能大于100 ",
		         required: "不能为空 "
		     },
		     message: "填写排序1~100之间的数字 ",
		     success: "排序填写正确"
		 }
	})
})
