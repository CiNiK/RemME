
$('#btn').click(function(){ 
	var one = document.getElementById('key').textContent;
	var other = $('#answer').val();

	var diff = JsDiff.diffChars(one, other);
	$('#key').empty();
	diff.forEach(function(part){
		// green for additions, red for deletions
		// grey for common parts
		var color = part.added ? 'grey' : part.removed ? 'red' : 'green';
		var opacity = part.added ? 0.1 : 1;
		var span = document.createElement('span');
		span.style.opacity = opacity;
		span.style.color = color;
		span.appendChild(document
			.createTextNode(part.value));
		$('#key').append(span);
		});
});