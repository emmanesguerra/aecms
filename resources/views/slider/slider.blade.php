<div id='slider'>
    <slider-list v-bind:info='model'>
    </slider-list>
</div>

<script>
    var info = {!! json_encode($data['slider']) !!};
</script>