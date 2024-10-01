<script>
	if (typeof window.parent !== 'undefined' && window.parent) {
		window.parent.alert('오류가 발생했습니다! 새로고침 후 다시 시도해주세요.');
		window.parent.location.reload();
	} else {
		alert('오류가 발생했습니다! 새로고침 후 다시 시도해주세요.');
	}
</script>
