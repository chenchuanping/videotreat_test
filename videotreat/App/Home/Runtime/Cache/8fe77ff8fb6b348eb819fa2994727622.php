<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
    <head>
        <title>云医视讯<?php echo ($aaa); ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="__ROOT__/Public/Agora/css/bundle.css?v=1.6.0">
        <script>
            var doctorId="<?php echo ($_SESSION['userMsg']['doctorId']); ?>";
            var app="__APP__";
            var root="__ROOT__";
            var vendorKey = '<?php echo ($vendorKey); ?>';
            var room = '<?php echo ($room); ?>';
            var resolution='<?php echo ($resolution); ?>';
        </script>
        <!-- vertex shader -->
        <script id="2d-vertex-shader" type="x-shader/x-vertex">
                attribute vec2 a_position;
                attribute vec2 a_texCoord;

                uniform vec2 u_resolution;

                varying vec2 v_texCoord;

                void main() {
                    // convert the rectangle from pixels to 0.0 to 1.0
                    vec2 zeroToOne = a_position / u_resolution;

                    // convert from 0->1 to 0->2
                    vec2 zeroToTwo = zeroToOne * 2.0;

                    // convert from 0->2 to -1->+1 (clipspace)
                    vec2 clipSpace = zeroToTwo - 1.0;

                    gl_Position = vec4(clipSpace * vec2(1, -1), 0, 1);

                    // pass the texCoord to the fragment shader
                    // The GPU will interpolate this value between points.
                    v_texCoord = a_texCoord;
                }
            </script>
        <!-- fragment shader -->
        <script id="2d-fragment-shader" type="x-shader/x-fragment">
                precision mediump float;

                // our texture
                uniform sampler2D u_image;

                // the texCoords passed in from the vertex shader.
                varying vec2 v_texCoord;

                void main() {
                    gl_FragColor = texture2D(u_image, v_texCoord);
                }
            </script>
        <script id="2d-yuv-shader" type="x-shader/x-fragment">
                precision mediump float;
                uniform sampler2D Ytex;
                uniform sampler2D Utex,
                Vtex;
                varying vec2 v_texCoord;
                void main(void) {
                    float nx,
                    ny,
                    r,
                    g,
                    b,
                    y,
                    u,
                    v;
                    mediump vec4 txl,
                    ux,
                    vx;
                    nx = v_texCoord[0];
                    ny = v_texCoord[1];
                    y = texture2D(Ytex, vec2(nx, ny)).r;
                    u = texture2D(Utex, vec2(nx, ny)).r;
                    v = texture2D(Vtex, vec2(nx, ny)).r;

                    //"  y = v;\n"+
                    y = 1.1643 * (y - 0.0625);
                    u = u - 0.5;
                    v = v - 0.5;

                    r = y + 1.5958 * v;
                    g = y - 0.39173 * u - 0.81290 * v;
                    b = y + 2.017 * u;
                    gl_FragColor = vec4(r, g, b, 1.0);
                }
            </script>
    </head>
    <body class="is-loading"><div id="wrapper">
        <div class="main-container">
            <div id="whiteboard-container">
            </div>
            <div id="video-container-parent">
                <div id="video-container" class="video-container">
                    <div id="video-container-multiple">
                    </div>
                    <div class="toolbar">
                        <ul>
                            <li>
                                <a class="mute-button" href="#">
                                    <img src="__ROOT__/Public/Agora/images/btn_mute@2x.png" alt="Mute">
                                </a>
                            </li>
                            <li>
                                    <a class="end-call-button" href="#">
                                    <img src="__ROOT__/Public/Agora/images/btn_endcall@2x.png" alt="End">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="video-side-bar">
                <div class="video-operation-bar">
                    <span class="video-operation-btn list-switch-audio-btn">1</span>
                    <span class="video-operation-btn list-hang-up-btn">2</span>
                    <span class="video-operation-btn list-close-btn">3</span>
                </div>
            </div>
            <div class="info"></div>
        </div>

        <!-- Footer -->
        <footer id="footer">
            <ul class="copyright">
                <li>北京信创达科技有限公司</li>
            </ul>
        </footer>
    </div>
    <div id="roomInfoModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p>
                        No remote stream yet&hellip;, :(
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <script src="__ROOT__/Public/js/jquery.js"></script>
    <script src="__ROOT__/Public/Agora/js/AgoraRtcAgentSDK-1.6.0.js"></script>
    <script src="__ROOT__/Public/Agora/js/vendor-bundle.js"></script>
    <script src="__ROOT__/Public/Agora/js/meeting.js"></script>

    <script>
        if ('addEventListener' in window) {
            window.addEventListener('load',
                    function() {
                        document.body.className = document.body.className.replace(/\bis-loading\b/, '');
                    });
            document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie': '');
        }
    </script>

    </body>
</html>