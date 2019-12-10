<template>
    <div class="row">
        <div class="col-sm">
            <carousel :data="computeddata"  indicator-type="disc"></carousel>
        </div>
    </div>
</template>

<script>
    import VueCarousel from '@chenfengyuan/vue-carousel';

    export default {
        props: ['info'],
        components: {
            carousel: VueCarousel,
        },
        computed: {
            computeddata () {
                var array = [];
                
                $.each(this.info, function (index, data) {
                    array.push('<div class="example-slide"><img src="'+data.full_path+'" /></div>')
                });
                
                return array;
            }
        }
    };
</script>



<style>
  .example-slide {
    align-items: center;
    background-color: #fff;
    color: #999;
    display: flex;
    font-size: 1.5rem;
    justify-content: center;
    min-height: 10rem;
  }
</style>