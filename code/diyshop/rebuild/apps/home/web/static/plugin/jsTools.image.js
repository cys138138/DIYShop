(function(win){
    var JsTools = {
        /**
         * base64字符串转换成ArrayBuffer
         * @param  {[type]} dataURL [description]
         * @return {[type]}         [description]
         */
        parseDataURL : function(dataURL) {
            var map = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';

            // Ignore padding
            var end = -1;
            var flag = map.charAt(64);    //'='
            if (flag) {
                end = dataURL.indexOf(flag);
            }
            var len = end != -1?end:dataURL.length;

            // Convert
            var nBytes = 0;
            var buffer = new ArrayBuffer(len);
            var view = new Uint8Array(buffer);
            for (var i = 0; i < len; i++) {
                if (i % 4) {
                    var bits1 = map.indexOf(dataURL.charAt(i - 1)) << ((i % 4) * 2);
                    var bits2 = map.indexOf(dataURL.charAt(i)) >>> (6 - (i % 4) * 2);
                    view[nBytes] = (bits1 | bits2) & 255;
                    nBytes++;
                }
            }
            return view;
        },
        /**
         * 重设图像尺寸
         * @param  {[type]}   image    [description]
         * @param  {[type]}   w        [description]
         * @param  {[type]}   h        [description]
         * @param  {Function} callback [description]
         * @return {[type]}            [description]
         */
        resizeImage: function(image, w, h, callback) {
            var canvas = document.createElement('canvas');
            if(!canvas.getContext){
                return false;
            }

            var ctx = canvas.getContext('2d');
            var scaleW = image.width / w;
            var scaleH = image.height / h;
            var scale = Math.max(scaleW, scaleH);

            if(image.complete){
                canvas.width = image.width / scale;
                canvas.height = image.height / scale;
                ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
                callback(canvas.toDataURL('image/jpeg', 1));
            }else{
                image.onload = function(){
                    canvas.width = image.width / scale;
                    canvas.height = image.height / scale;
                    ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
                    callback(canvas.toDataURL('image/jpeg', 1));
                }
            }
        },

        /**
         * 裁剪图像
         * @param  {[type]}   image    [description]
         * @param  {[type]}   x        [description]
         * @param  {[type]}   y        [description]
         * @param  {[type]}   w        [description]
         * @param  {[type]}   h        [description]
         * @param  {Function} callback [description]
         * @return {[type]}            [description]
         */
        cutImage: function(image, x, y, w, h, callback) {
            var canvas = document.createElement('canvas');
            if(!canvas.getContext){
                return false;
            }

            var ctx = canvas.getContext('2d');
            canvas.width = w;
            canvas.height = h;

            if(image.complete){
                ctx.drawImage(image, x, y, w, h, 0, 0, w, h);
                callback(canvas.toDataURL('image/jpeg', 1));
            }else{
                image.onload = function(){
                    ctx.drawImage(image, x, y, w, h, 0, 0, image.width, image.height);
                    callback(canvas.toDataURL('image/jpeg', 1));
                }
            }
        }
    };

    win.JsTools = $.extend(win.JsTools, JsTools);
})(window);