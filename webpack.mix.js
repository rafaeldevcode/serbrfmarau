const Mix = require("laravel-mix");

Mix
    .sass('public/libs/sass/style.scss', 'public/libs/bootstrap/bootstrap.min.css')
    .sass('public/libs/sass/globals.sass', 'public/assets/css/globals.css')

    .css('node_modules/bootstrap-icons/font/bootstrap-icons.min.css', 'public/libs/bootstrap-icons/bootstrap-icons.min.css')
    .copyDirectory('node_modules/bootstrap-icons/font/fonts', 'public/fonts/vendor/bootstrap-icons')

    .scripts('node_modules/jquery/dist/jquery.min.js', 'public/libs/jquery/jquery.js')
    .scripts('node_modules/jquery-mask-plugin/dist/jquery.mask.min.js', 'public/libs/jquery/jquery.mask.min.js')
    
    .css('node_modules/select2/dist/css/select2.min.css', 'public/libs/select2/select2.min.css')
    .scripts('node_modules/select2/dist/js/select2.full.min.js', 'public/libs/select2/select2.full.min.js')

    .scripts('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/libs/bootstrap/bootstrap.js')
    .scripts('node_modules/bootstrap/dist/js/bootstrap.bundle.js.map', 'public/libs/bootstrap/bootstrap.js.map')

    .scripts('vendor/tinymce/tinymce/tinymce.min.js', 'public/libs/tinymce/tinymce.js')
    .scripts('vendor/tinymce/tinymce/themes/silver/theme.min.js', 'public/libs/tinymce/themes/silver/theme.js')
    .scripts('vendor/tinymce/tinymce/models/dom/model.min.js', 'public/libs/tinymce/models/dom/model.js')
    .scripts('vendor/tinymce/tinymce/icons/default/icons.min.js', 'public/libs/tinymce/icons/default/icons.js')

    // Plugins tinynce   
    .scripts('vendor/tinymce/tinymce/plugins/image/plugin.min.js', 'public/libs/tinymce/plugins/image/plugin.min.js')
    .scripts('vendor/tinymce/tinymce/plugins/codesample/plugin.min.js', 'public/libs/tinymce/plugins/codesample/plugin.min.js')
    .scripts('vendor/tinymce/tinymce/plugins/emoticons/plugin.min.js', 'public/libs/tinymce/plugins/emoticons/plugin.min.js')
    .scripts('vendor/tinymce/tinymce/plugins/emoticons/js/emojis.min.js', 'public/libs/tinymce/plugins/emoticons/js/emojis.min.js')
    .scripts('vendor/tinymce/tinymce/plugins/charmap/plugin.min.js', 'public/libs/tinymce/plugins/charmap/plugin.min.js')
    .scripts('vendor/tinymce/tinymce/plugins/autolink/plugin.min.js', 'public/libs/tinymce/plugins/autolink/plugin.min.js')
    .scripts('vendor/tinymce/tinymce/plugins/anchor/plugin.min.js', 'public/libs/tinymce/plugins/anchor/plugin.min.js')
    .scripts('vendor/tinymce/tinymce/plugins/wordcount/plugin.min.js', 'public/libs/tinymce/plugins/wordcount/plugin.min.js')
    .scripts('vendor/tinymce/tinymce/plugins/visualblocks/plugin.min.js', 'public/libs/tinymce/plugins/visualblocks/plugin.min.js')
    .scripts('vendor/tinymce/tinymce/plugins/table/plugin.min.js', 'public/libs/tinymce/plugins/table/plugin.min.js')
    .scripts('vendor/tinymce/tinymce/plugins/searchreplace/plugin.min.js', 'public/libs/tinymce/plugins/searchreplace/plugin.min.js')
    .scripts('vendor/tinymce/tinymce/plugins/media/plugin.min.js', 'public/libs/tinymce/plugins/media/plugin.min.js')
    .scripts('vendor/tinymce/tinymce/plugins/lists/plugin.min.js', 'public/libs/tinymce/plugins/lists/plugin.min.js')
    .scripts('vendor/tinymce/tinymce/plugins/link/plugin.min.js', 'public/libs/tinymce/plugins/link/plugin.min.js')
    .scripts('vendor/tinymce/tinymce/plugins/code/plugin.min.js', 'public/libs/tinymce/plugins/code/plugin.min.js')

   .css('vendor/tinymce/tinymce/skins/ui/oxide/skin.min.css', 'public/libs/tinymce/skins/ui/oxide/skin.min.css')
   .css('vendor/tinymce/tinymce/skins/ui/oxide/content.min.css', 'public/libs/tinymce/skins/ui/oxide/content.min.css')
   .css('vendor/tinymce/tinymce/skins/content/default/content.css', 'public/libs/tinymce/skins/content/default/content.css');
