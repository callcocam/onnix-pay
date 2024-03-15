@props(['loading' => 'downLoadMore'])
<div class="h-16 w-full " x-data="{
        observe () {
            let observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        @this.call('{{ $loading }}')
                    }
                })
            }, {
                root: null, 
            })

            observer.observe(this.$el)
        }
        }" x-init="observe"> </div>