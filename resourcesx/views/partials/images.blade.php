<div class="form-group text-center">
    <label class="form-control-label" for="input-name">{{ $image['label'] }}</label>
    @isset($image['help'])
       <br /> <span class="small">{{ $image['help'] }}</span>
    @endisset
    <div class="text-center">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-preview img-thumbnail" data-trigger="fileinput" style="{{ $image['style'] }}">
                <img src="{{ $image['value'] }}" alt="..."/>
            </div>
            @isset($image['variations'])
                <script>
                    function handleMultipleImages(event){
                        let files = event.target.files;
                        $('.preview-more-images').html('');
                        if(files.length > 1){                                    
                            for(let i = 1; i < files.length; i++){
                                var file = new FileReader();
                                file.onload = function(e){
                                    if(e && e.target && e.target.result){
                                        let image = handleCreateImg(e.target.result);
                                        $('.preview-more-images').append(image);
                                    }
                                }
                                file.readAsDataURL(event.target.files[i]);
                            }
                        }
                    }
                    function handleCreateImg(img){
                        return `<img src='${img}' class='images-generated'/>`;
                    }
                </script>
                <style>
                    .preview-more-images::-webkit-scrollbar {
                        height: 5px;
                        border-radius: 3px;
                    }
                    .preview-more-images{
                        max-width: 22rem;
                        display: flex;
                        gap: .3rem;
                        overflow-x: auto;
                    }
                    .preview-more-images img{
                        width: 3.5rem;
                        height: 3.5rem;
                        object-fit: cover;
                        border-radius: 4px;
                        box-shadow: 0 0 60px rgba(0,0,0,.05);
                    }
                </style>
                <div class="preview-more-images">
                    @foreach($image['variations'] as $variation)
                        <img src='{{$variation}}' class='images-generated'/>
                    @endforeach
                </div>
            @endisset
            <div>
                <span class="btn btn-outline-secondary btn-file">
                    <span class="fileinput-new">{{ __('Select image') }}</span>
                    <span class="fileinput-exists">{{ __('Change') }}</span>
                    @if(isset($image['variations']))
                        <input type="file" name="{{ $image['name'] }}" accept="image/x-png,image/gif,image/jpeg" multiple onchange="handleMultipleImages(event);">
                    @else
                        <input type="file" name="{{ $image['name'] }}" accept="image/x-png,image/gif,image/jpeg">
                    @endif
                </span>
                <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">{{ __('Remove') }}</a>
            </div>
        </div>
    </div>
</div>