function AgoraRender() {
    function e(e, n, t, r, o) {
        i.activeTexture(i.TEXTURE0),
            i.bindTexture(i.TEXTURE_2D, u),
            i.texImage2D(i.TEXTURE_2D, 0, i.LUMINANCE, e, n, 0, i.LUMINANCE, i.UNSIGNED_BYTE, t);
        var a = i.getError();
        a != i.NO_ERROR && console.log("upload y plane ", e, n, t.byteLength, " error", a),
            i.activeTexture(i.TEXTURE1),
            i.bindTexture(i.TEXTURE_2D, d),
            i.texImage2D(i.TEXTURE_2D, 0, i.LUMINANCE, e / 2, n / 2, 0, i.LUMINANCE, i.UNSIGNED_BYTE, r);
        var a = i.getError();
        a != i.NO_ERROR && console.log("upload u plane ", e, n, r.byteLength, "  error", a),
            i.activeTexture(i.TEXTURE2),
            i.bindTexture(i.TEXTURE_2D, g),
            i.texImage2D(i.TEXTURE_2D, 0, i.LUMINANCE, e / 2, n / 2, 0, i.LUMINANCE, i.UNSIGNED_BYTE, o);
        var a = i.getError();
        a != i.NO_ERROR && console.log("upload v plane ", e, n, o.byteLength, "  error", a)
    }
    function n(e) {
        e && v.gl && v.gl.deleteBuffer(e)
    }
    function t(e) {
        e && v.gl && v.gl.deleteTexture(e)
    }
    function r(e, n, t, r, a, c) {
        v.clientWidth = e.clientWidth,
            v.clientHeight = e.clientHeight,
            v.view = e,
            v.mirrorView = n,
            v.canvasUpdated = !1,
            v.container = document.createElement("div"),
            v.container.style.width = "100%",
            v.container.style.height = "100%",
            v.container.style.display = "flex",
            v.container.style.justifyContent = "center",
            v.container.style.alignItems = "center",
            v.view.appendChild(v.container),
            v.canvas = document.createElement("canvas"),
            0 == a || 180 == a ? (v.canvas.width = t, v.canvas.height = r) : (v.canvas.width = r, v.canvas.height = t),
            v.initWidth = t,
            v.initHeight = r,
            v.initRotation = a,
        v.mirrorView && (v.canvas.style.transform = "rotateY(180deg)"),
            v.container.appendChild(v.canvas);
        try {
            i = v.canvas.getContext("webgl") || v.canvas.getContext("experimental-webgl")
        } catch(l) {
            console.log(l)
        }
        return i ? (i.clearColor(0, 0, 0, 1), i.enable(i.DEPTH_TEST), i.depthFunc(i.LEQUAL), i.clear(i.COLOR_BUFFER_BIT | i.DEPTH_BUFFER_BIT), s = createProgramFromSources(i, [AgoraRTC.vertexShaderSource, AgoraRTC.yuvShaderSource]), i.useProgram(s), void o()) : (i = void 0, void c({
            error: "Browser not support! No WebGL detected."
        }))
    }
    function o() {
        c = i.getAttribLocation(s, "a_position"),
            l = i.getAttribLocation(s, "a_texCoord"),
            m = i.createBuffer(),
            f = i.createBuffer(),
            i.activeTexture(i.TEXTURE0),
            u = i.createTexture(),
            i.bindTexture(i.TEXTURE_2D, u),
            i.texParameteri(i.TEXTURE_2D, i.TEXTURE_WRAP_S, i.CLAMP_TO_EDGE),
            i.texParameteri(i.TEXTURE_2D, i.TEXTURE_WRAP_T, i.CLAMP_TO_EDGE),
            i.texParameteri(i.TEXTURE_2D, i.TEXTURE_MIN_FILTER, i.NEAREST),
            i.texParameteri(i.TEXTURE_2D, i.TEXTURE_MAG_FILTER, i.NEAREST),
            i.activeTexture(i.TEXTURE1),
            d = i.createTexture(),
            i.bindTexture(i.TEXTURE_2D, d),
            i.texParameteri(i.TEXTURE_2D, i.TEXTURE_WRAP_S, i.CLAMP_TO_EDGE),
            i.texParameteri(i.TEXTURE_2D, i.TEXTURE_WRAP_T, i.CLAMP_TO_EDGE),
            i.texParameteri(i.TEXTURE_2D, i.TEXTURE_MIN_FILTER, i.NEAREST),
            i.texParameteri(i.TEXTURE_2D, i.TEXTURE_MAG_FILTER, i.NEAREST),
            i.activeTexture(i.TEXTURE2),
            g = i.createTexture(),
            i.bindTexture(i.TEXTURE_2D, g),
            i.texParameteri(i.TEXTURE_2D, i.TEXTURE_WRAP_S, i.CLAMP_TO_EDGE),
            i.texParameteri(i.TEXTURE_2D, i.TEXTURE_WRAP_T, i.CLAMP_TO_EDGE),
            i.texParameteri(i.TEXTURE_2D, i.TEXTURE_MIN_FILTER, i.NEAREST),
            i.texParameteri(i.TEXTURE_2D, i.TEXTURE_MAG_FILTER, i.NEAREST);
        var e = i.getUniformLocation(s, "Ytex");
        i.uniform1i(e, 0);
        var n = i.getUniformLocation(s, "Utex");
        i.uniform1i(n, 1);
        var t = i.getUniformLocation(s, "Vtex");
        i.uniform1i(t, 2)
    }
    function a(e, n, t) {
        if (!v.canvasUpdated) {
            v.canvas.style.width = "100%",
                v.canvas.style.height = "100%";
            try {
                0 === e || 180 === e ? v.clientWidth / v.clientHeight > n / t ? v.canvas.style.width = v.clientHeight * n / t + "px": v.clientWidth / v.clientHeight < n / t && (v.canvas.style.height = v.clientWidth * t / n + "px") : v.clientHeight / v.clientWidth > n / t ? v.canvas.style.height = v.clientWidth * n / t + "px": v.clientHeight / v.clientWidth < n / t && (v.canvas.style.width = v.clientHeight * t / n + "px")
            } catch(r) {
                return console.log("updateCanvas 00001 gone " + v.canvas),
                    console.log(v),
                    void console.error(r)
            }
            i.bindBuffer(i.ARRAY_BUFFER, m),
                i.enableVertexAttribArray(c),
                i.vertexAttribPointer(c, 2, i.FLOAT, !1, 0, 0);
            var o = {
                    x: 0,
                    y: 0
                },
                a = {
                    x: n,
                    y: 0
                },
                l = {
                    x: n,
                    y: t
                },
                u = {
                    x: 0,
                    y: t
                },
                d = o,
                g = a,
                f = l,
                E = u;
            switch (e) {
                case 0:
                    break;
                case 90:
                    d = a,
                        g = l,
                        f = u,
                        E = o;
                    break;
                case 180:
                    d = l,
                        g = u,
                        f = o,
                        E = a;
                    break;
                case 270:
                    d = u,
                        g = o,
                        f = a,
                        E = l
            }
            i.bufferData(i.ARRAY_BUFFER, new Float32Array([d.x, d.y, g.x, g.y, E.x, E.y, E.x, E.y, g.x, g.y, f.x, f.y]), i.STATIC_DRAW);
            var A = i.getUniformLocation(s, "u_resolution");
            i.uniform2f(A, n, t),
                v.canvasUpdated = !0
        }
    }
    var i = void 0,
        s = void 0,
        c = void 0,
        l = void 0,
        u = void 0,
        d = void 0,
        g = void 0,
        f = void 0,
        m = void 0,
        v = {
            view: void 0,
            mirrorView: !1,
            container: void 0,
            canvas: void 0,
            renderImageCount: 0,
            initWidth: 0,
            initHeight: 0,
            initRotation: 0,
            canvasUpdated: !1,
            clientWidth: 0,
            clientHeight: 0
        };
    return v.start = function(e, n) {
        r(e, v.mirrorView, e.clientWidth, e.clientHeight, v.initRotation, n)
    },
        v.stop = function() {
            i = void 0,
                s = void 0,
                c = void 0,
                l = void 0,
                t(u),
                t(d),
                t(g),
                u = void 0,
                d = void 0,
                g = void 0,
                n(f),
                n(m),
                f = void 0,
                m = void 0,
            v.container && v.container.removeChild(v.canvas),
            v.view && v.view.removeChild(v.container),
                v.canvas = void 0,
                v.container = void 0,
                v.view = void 0,
                v.mirrorView = !1
        },
        v.renderImage = function(n) {
            if (i) {
                if (n.width != v.initWidth || n.height != v.initHeight || n.rotation != v.initRotation || n.mirror != v.mirrorView) {
                    var t = v.view;
                    v.stop(),
                        console.log("init canvas " + n.width + "*" + n.height + " rotation " + n.rotation),
                        r(t, n.mirror, n.width, n.height, n.rotation,
                            function(e) {
                                console.error("init canvas " + n.width + "*" + n.height + " rotation " + n.rotation + " failed. " + e)
                            })
                }
                i.bindBuffer(i.ARRAY_BUFFER, f);
                var o = n.width + n.left + n.right,
                    s = n.height + n.top + n.bottom;
                i.bufferData(i.ARRAY_BUFFER, new Float32Array([n.left / o, n.bottom / s, 1 - n.right / o, n.bottom / s, n.left / o, 1 - n.top / s, n.left / o, 1 - n.top / s, 1 - n.right / o, n.bottom / s, 1 - n.right / o, 1 - n.top / s]), i.STATIC_DRAW),
                    i.enableVertexAttribArray(l),
                    i.vertexAttribPointer(l, 2, i.FLOAT, !1, 0, 0),
                    e(o, s, n.yplane, n.uplane, n.vplane),
                    a(n.rotation, n.width, n.height),
                    i.drawArrays(i.TRIANGLES, 0, 6),
                    v.renderImageCount += 1
            }
        },
        v
}
var AgoraRTC = function() {
    "use strict";
    var e = {};
    return Object.defineProperties(e, {
        version: {
            get: function() {
                return "<%= pkg.version %>"
            }
        },
        name: {
            get: function() {
                return "<%= pkg.title %>"
            }
        }
    }),
        e
} ();
AgoraRTC.url = "wss://localhost.agora.io:8921/",
    AgoraRTC.macAgentInstallUrl = "http://download.agora.io/AgoraWebAgent-1.6.0.pkg",
    AgoraRTC.winAgentInstallUrl = "http://download.agora.io/AgoraWebAgentSetup-1.6.0.exe",
    AgoraRTC.enAgentInstallGuideUrl = "http://download.agora.io/install-guide-en.html",
    AgoraRTC.cnAgentInstallGuideUrl = "http://download.agora.io/install-guide-cn.html",
    AgoraRTC.vertexShaderSource = "attribute vec2 a_position;attribute vec2 a_texCoord;uniform vec2 u_resolution;varying vec2 v_texCoord;void main() {vec2 zeroToOne = a_position / u_resolution;   vec2 zeroToTwo = zeroToOne * 2.0;   vec2 clipSpace = zeroToTwo - 1.0;   gl_Position = vec4(clipSpace * vec2(1, -1), 0, 1);v_texCoord = a_texCoord;}",
    AgoraRTC.yuvShaderSource = "precision mediump float;uniform sampler2D Ytex;uniform sampler2D Utex,Vtex;varying vec2 v_texCoord;void main(void) {  float nx,ny,r,g,b,y,u,v;  mediump vec4 txl,ux,vx;  nx=v_texCoord[0];  ny=v_texCoord[1];  y=texture2D(Ytex,vec2(nx,ny)).r;  u=texture2D(Utex,vec2(nx,ny)).r;  v=texture2D(Vtex,vec2(nx,ny)).r;  y=1.1643*(y-0.0625);  u=u-0.5;  v=v-0.5;  r=y+1.5958*v;  g=y-0.39173*u-0.81290*v;  b=y+2.017*u;  gl_FragColor=vec4(r,g,b,1.0);}",
    AgoraRTC.videoStreamSource = 'function onSuccess(){postMessage({type:"init",result:!0})}function onFailure(t){postMessage(t)}function sendMessage(t){"videoStat"!=t.command&&console.log(JSON.stringify(t)),that.stream&&that.stream.readyState==WebSocket.OPEN&&that.stream.send(JSON.stringify(t))}var that={};that.stream=void 0,that.init=function(t){return that.stream&&that.stream.readyState===WebSocket.OPEN?(console.warn("stream "+that.getId()+" has been initialized already"),void onSuccess()):(that.local=t.local,that.profile=t.videoProfile,that.stream=new WebSocket(t.url),that.stream.onopen=function(t){console.log((that.local?"local":"remote")+" Stream "),console.log(t),that.profile&&sendMessage({command:"setVideoProfile",profile:that.profile}),that.stream.binaryType="arraybuffer",onSuccess()},that.stream.onclose=function(t){console.log(that.local?"local":"remote"," Stream ",t),that.stream=void 0,onFailure({type:t.type,code:t.code,reason:t.reason})},that.stream.onerror=function(t){console.log(that.local?"local":"remote"," Stream ",t),onFailure({type:t.type,code:t.code,reason:t.reason})},void(that.stream.onmessage=function(t){"string"==typeof t.data?console.log(that.local?"local":"remote"," message from agent ",t.data):t.data instanceof ArrayBuffer?postMessage({type:"message",data:t.data}):t.data instanceof Blob&&console.warn("Blob image data is not supported")}))},that.close=function(){that.stream&&(that.stream.onmessage=void 0,that.stream.close()),that.stream=void 0},that.setVideoProfile=function(t){return"string"==typeof t?(that.stream?sendMessage({command:"setVideoProfile",profile:t}):that.profile=t,!0):!1},self.addEventListener("message",function(t){var e=t.data;switch(e.type){case"init":that.init(e);break;case"send":sendMessage(e.message);break;case"close":that.close()}},!1);';
var AgoraCall = function(e, n) {
        e && e(n)
    },
    L = {
        VideoProfiles: {
            Profile120P: "120P",
            Profile120P_3: "120P_3",
            Profile96P: "96P",
            Profile48P: "48P",
            Profile180P: "180P",
            Profile180P_3: "180P_3",
            Profile180P_4: "180P_4",
            Profile240P: "240P",
            Profile240P_3: "240P_3",
            Profile240P_4: "240P_4",
            Profile360P: "360P",
            Profile360P_3: "360P_3",
            Profile360P_4: "360P_4",
            Profile360P_6: "360P_6",
            Profile360P_7: "360P_7",
            Profile360P_8: "360P_8",
            Profile480P: "480P",
            Profile480P_3: "480P_3",
            Profile480P_4: "480P_4",
            Profile480P_6: "480P_6",
            Profile480P_8: "480P_8",
            Profile480P_9: "480P_9",
            Profile720P: "720P",
            Profile720P_3: "720P_3",
            Profile720P_5: "720P_5",
            Profile720P_6: "720P_6"
        },
        ErrorCode: {
            NO_ERROR: 0,
            FAILED: 1,
            INVALID_ARGUMENT: 2,
            NOT_READY: 3,
            NOT_SUPPORTED: 4,
            REFUSED: 5,
            BUFFER_TOO_SMALL: 6,
            NOT_INITIALIZED: 7,
            INVALID_VIEW: 8,
            NO_PERMISSION: 9,
            TIMEDOUT: 10,
            CANCELED: 11,
            TOO_OFTEN: 12,
            BIND_SOCKET: 13,
            NET_DOWN: 14,
            NET_NOBUFS: 15,
            INIT_VIDEO: 16,
            JOIN_CHANNEL_REJECTED: 17,
            LEAVE_CHANNEL_REJECTED: 18,
            ALREADY_IN_USE: 19,
            INVALID_APP_ID: 101,
            INVALID_CHANNEL_NAME: 102,
            CHANNEL_KEY_EXPIRED: 109,
            INVALID_CHANNEL_KEY: 110,
            CONNECTION_INTERRUPTED: 111,
            CONNECTION_LOST: 112,
            LOAD_MEDIA_ENGINE: 1001,
            START_CALL: 1002,
            START_CAMERA: 1003,
            START_VIDEO_RENDER: 1004,
            ADM_GENERAL_ERROR: 1005,
            ADM_JAVA_RESOURCE: 1006,
            ADM_SAMPLE_RATE: 1007,
            ADM_INIT_PLAYOUT: 1008,
            ADM_START_PLAYOUT: 1009,
            ADM_STOP_PLAYOUT: 1010,
            ADM_INIT_RECORDING: 1011,
            ADM_START_RECORDING: 1012,
            ADM_STOP_RECORDING: 1013,
            ADM_RUNTIME_PLAYOUT_ERROR: 1015,
            ADM_RUNTIME_RECORDING_ERROR: 1017,
            ADM_RECORD_AUDIO_FAILED: 1018,
            ADM_INIT_LOOPBACK: 1022,
            ADM_START_LOOPBACK: 1023,
            VDM_CAMERA_NOT_AUTHORIZED: 1501
        }
    };
AgoraRTC.EventDispatcher = function(e) {
    "use strict";
    var n = {};
    return e.dispatcher = {},
        e.dispatcher.eventListeners = {},
        n.addEventListener = function(n, t) {
            e.dispatcher.eventListeners[n] = t,
            e.dispatcher.eventListeners[n] || delete e.dispatcher.eventListeners[n]
        },
        n.on = n.addEventListener,
        n.dispatchEvent = function(n) {
            e.dispatcher.eventListeners.hasOwnProperty(n.type) && e.dispatcher.eventListeners[n.type](n)
        },
        n
},
    AgoraRTC.BasicEvent = function(e) {
        "use strict";
        var n = {};
        return n.type = e.type,
            n
    },
    AgoraRTC.StreamEvent = function(e) {
        "use strict";
        var n = AgoraRTC.BasicEvent(e);
        return n.stream = e.stream,
            n.msg = e.msg,
            n
    },
    AgoraRTC.ClientEvent = function(e) {
        "use strict";
        var n = AgoraRTC.BasicEvent(e);
        return n.uid = e.uid,
            n.attr = e.attr,
            n.streams = e.streams,
            n
    },
    AgoraRTC.MediaEvent = function(e) {
        "use strict";
        var n = AgoraRTC.BasicEvent(e);
        return n.msg = e.msg,
            n
    },
    AgoraRTC.Signal = function(e) {
        function n(e) {
            console.log(e)
        }
        var t = AgoraRTC.EventDispatcher(e);
        return t.connection = new WebSocket(e.url),
            t.sendMessage = function(e, n) {
                t.connection.readyState == WebSocket.OPEN ? t.connection.send(JSON.stringify(e)) : (console.log("connection to agent lost."), n({
                    error: "not connected"
                }))
            },
            t.close = function() {
                t.onEvent = n,
                    t.connection.onopen = void 0,
                    t.connection.onclose = void 0,
                    t.connection.onerror = void 0,
                    t.connection.onmessage = void 0,
                    t.connection.close()
            },
            t.connection.onopen = function(e) {
                console.log(e),
                    t.dispatchEvent(AgoraRTC.MediaEvent({
                        type: "onopen",
                        event: e
                    }))
            },
            t.connection.onclose = function(n) {
                console.log(n),
                    AgoraCall(e.onFailure, n)
            },
            t.connection.onerror = function(n) {
                console.log(n),
                    AgoraCall(e.onFailure, n)
            },
            t.onEvent = n,
            t.connection.onmessage = function(e) {
                console.log(e);
                var n = JSON.parse(e.data);
                n.hasOwnProperty("command") ? t.dispatchEvent(AgoraRTC.MediaEvent({
                    type: n.command,
                    msg: n
                })) : n.hasOwnProperty("event") && t.onEvent(n)
            },
            t
    },
    AgoraRTC.Stream = function(e) {
        function n() {
            a = void 0,
                i = void 0,
                s = void 0,
                c = void 0
        }
        function t(e, n) {
            return {
                width: e,
                height: n
            }
        }
        function r(e) {
            var n = e.data;
            switch (n.type) {
                case "init":
                    o.oninit(n);
                    break;
                case "close":
                    o.onclose(n);
                    break;
                case "error":
                    o.onerror(n);
                    break;
                case "message":
                    o.onmessage(n.data)
            }
        }
        var o = AgoraRTC.EventDispatcher(e);
        o.stream = void 0,
            o.render = void 0,
            o.interval = void 0,
            o.lastRenderCount = 0,
            o.profile = void 0,
            o.latency = 0;
        var a = void 0,
            i = void 0,
            s = void 0,
            c = void 0;
        o.init = function(n, t) {
            if (o.stream) return console.warn("stream " + o.getId() + " has been initialized already"),
                void n();
            var a = new Blob([AgoraRTC.videoStreamSource], {
                type: "application/javascript"
            });
            o.stream = new Worker(URL.createObjectURL(a)),
                o.oninit = function(r) {
                    console.log((e.local ? "local": "remote") + " Stream "),
                        console.log(r),
                        r.result === !0 ? n() : t()
                },
                o.onclose = function(n) {
                    window.clearInterval(o.interval),
                        console.log(e.local ? "local": "remote", " Stream ", n),
                        o.stream = void 0
                },
                o.onerror = function(n) {
                    window.clearInterval(o.interval),
                        console.log(e.local ? "local": "remote", " Stream ", n),
                        t(n)
                },
                o.onmessage = function(n) {
                    "string" == typeof n ? console.log(e.local ? "local": "remote", " message from agent ", n) : n instanceof ArrayBuffer ? o.render && o.drawImage(n) : n instanceof Blob && console.warn("Blob image data is not supported")
                },
                o.stream.addEventListener("message", r, !1),
                o.stream.postMessage({
                    type: "init",
                    local: e.local,
                    url: AgoraRTC.url,
                    videoProfile: o.profile
                })
        },
            o.close = function() {
                window.clearInterval(o.interval),
                o.stream && (o.stream.removeEventListener("message", r), o.stream.postMessage({
                    type: "close"
                })),
                    o.stream = void 0,
                    o.stop()
            },
            o.play = function(n, t) {
                var r = document.getElementById(n);
                o.stop(),
                    o.render = AgoraRender(),
                    o.render.start(r, t),
                    e.local ? o.stream.postMessage({
                        type: "send",
                        message: {
                            command: "preview",
                            uid: e.streamID,
                            audio: e.audio !== !1,
                            video: e.video !== !1,
                            screen: e.screen === !0
                        }
                    }) : o.stream.postMessage({
                        type: "send",
                        message: {
                            command: "subscribe",
                            uid: e.streamID
                        }
                    }),
                o.interval && window.clearInterval(o.interval),
                    o.interval = window.setInterval(function() {
                            if (o.render) {
                                var n = o.render.renderImageCount - o.lastRenderCount;
                                o.stream.postMessage({
                                    type: "send",
                                    message: {
                                        command: "videoStat",
                                        uid: e.streamID,
                                        fps: n,
                                        frameCount: o.lastRenderCount,
                                        latency: o.latency
                                    }
                                }),
                                    o.lastRenderCount = o.render.renderImageCount,
                                    o.latency = 0
                            }
                        },
                        1e3)
            },
            o.stop = function() {
                o.render && o.render.stop(),
                    o.render = void 0,
                    o.lastRenderCount = 0
            },
            o.bindClient = function(e) {
                o.client = e
            },
            o.enableAudio = function(e) {
                return o.client.enableAudio(o, e)
            },
            o.disableAudio = function(e) {
                return o.client.disableAudio(o, e)
            },
            o.enableVideo = function(e) {
                return o.client.enableVideo(o, e)
            },
            o.disableVideo = function(e) {
                return o.client.disableVideo(o, e)
            },
            o.getId = function() {
                return e.streamID
            },
            o.drawImage = function(e) {
                if (!a) return a = e,
                    void(20 != a.byteLength && (console.error("invalid image header " + e.byteLength), n()));
                if (!i) return i = e,
                    void(20 === i.byteLength && (console.error("invalid image header " + e.byteLength + " " + i.byteLength), n()));
                if (!s) return s = e,
                    void(20 === s.byteLength && (console.error("invalid image header " + e.byteLength + " " + i.byteLength + " " + s.byteLength), n()));
                if (!c) {
                    if (c = e, i.byteLength != 4 * s.byteLength || s.byteLength != c.byteLength) return console.error("invalid image header " + e.byteLength + " " + i.byteLength + " " + s.byteLength + " " + c.byteLength),
                        void n();
                    var t = new DataView(a),
                        r = (t.getUint8(0), t.getUint8(1)),
                        l = t.getUint16(2),
                        u = t.getUint16(4),
                        d = t.getUint16(6),
                        g = t.getUint16(8),
                        f = t.getUint16(10),
                        m = t.getUint16(12),
                        v = t.getUint16(14),
                        E = t.getUint32(16);
                    o.render.renderImage({
                        mirror: r,
                        width: l,
                        height: u,
                        left: d,
                        top: g,
                        right: f,
                        bottom: m,
                        rotation: v,
                        yplane: new Uint8Array(i),
                        uplane: new Uint8Array(s),
                        vplane: new Uint8Array(c)
                    });
                    var A = (4294967295 & Date.now()) >>> 0,
                        T = A - E;
                    T > o.latency && (o.latency = T),
                        n()
                }
            },
            o.setVideoProfile = function(e) {
                return "string" == typeof e && (o.stream ? o.stream.postMessage({
                        type: "send",
                        message: {
                            command: "setVideoProfile",
                            profile: e
                        }
                    }) : o.profile = e, !0)
            }; ({
            "true": !0,
            unspecified: !0,
            "120p": t(160, 120),
            "240p": t(320, 240),
            "360p": t(640, 360),
            "480p": t(640, 480),
            "720p": t(1280, 720),
            "1080p": t(1920, 1080),
            "4k": t(3840, 2160)
        });
        return o
    },
    AgoraRTC.createStream = function(e) {
        return AgoraRTC.Stream(e)
    },
    AgoraRTC.Client = function(e) {
        "use strict";
        function n(e) {
            if (s.signalOpen) {
                console.log("signal connection lost.");
                var n = {
                    reason: "LOST_CONNECTION_TO_AGENT",
                    type: "error",
                    eventType: e.type,
                    code: e.code
                };
                return AgoraCall(s.onFailure, n),
                    void s.dispatchEvent(n)
            }
            if ("close" !== e.type) {
                var n = {
                    reason: "CLOSE_BEFORE_OPEN",
                    type: "error",
                    eventType: e.type,
                    code: e.code,
                    agentInstallUrl: o(),
                    agentInstallGuideUrl: a()
                };
                AgoraCall(s.onFailure, n),
                    s.dispatchEvent(n)
            }
        }
        function t(e) {
            var n = e.msg;
            s.remoteStreams.hasOwnProperty(n.uid) && (s.remoteStreams[n.uid].close(), delete s.remoteStreams[n.uid], console.log("remote streams after peer leave ", s.remoteStreams)),
                s.dispatchEvent(AgoraRTC.ClientEvent({
                    type: "peer-leave",
                    uid: n.uid
                }))
        }
        function r(e) {
            var n = e.msg;
            if (!s.remoteStreams.hasOwnProperty(n.uid)) {
                var t = AgoraRTC.Stream({
                    streamID: n.uid,
                    local: !1,
                    audio: n.audio,
                    video: n.video,
                    screen: n.screen
                });
                t.bindClient(s),
                    s.remoteStreams[n.uid] = t
            }
            s.dispatchEvent(AgoraRTC.StreamEvent({
                type: "stream-added",
                stream: s.remoteStreams[n.uid]
            })),
                console.log("remote streams", s.remoteStreams)
        }
        function o() {
            return navigator.appVersion.indexOf("Mac") != -1 ? AgoraRTC.macAgentInstallUrl: AgoraRTC.winAgentInstallUrl
        }
        function a() {
            var e = navigator.language || navigator.userLanguage;
            return e.indexOf("zh") != -1 ? AgoraRTC.cnAgentInstallGuideUrl: AgoraRTC.enAgentInstallGuideUrl
        }
        function i() {
            s.localStream && s.localStream.close(),
                s.localStream = void 0;
            for (var e in s.remoteStreams) s.remoteStreams.hasOwnProperty(e) && (s.remoteStreams[e].close(), delete s.remoteStreams[e])
        }
        var s = AgoraRTC.EventDispatcher(e);
        return s.signal = void 0,
            s.localStream = void 0,
            s.remoteStreams = {},
            s.signalOpen = !1,
            s.init = function(t, r, o) {
                function a(e) {
                    var n = i(e);
                    return n ? void AgoraCall(o, {
                        reason: n
                    }) : void AgoraCall(o, {
                        reason: "UNKNOWN_ERROR",
                        code: m.code
                    })
                }
                function i(e) {
                    for (var n in L.ErrorCode) if (L.ErrorCode.hasOwnProperty(n) && L.ErrorCode[n] === e) return String(n);
                    return null
                }
                if (e.appId = t, s.onFailure = o, !s.signal) {
                    try {
                        s.signal = AgoraRTC.Signal({
                            url: AgoraRTC.url,
                            onFailure: n
                        })
                    } catch(c) {
                        return console.log("create signal connection failed" + c),
                            void AgoraCall(o, c)
                    }
                    s.signal.on("onopen",
                        function(n) {
                            s.signalOpen = !0,
                                s.signal.onEvent = function(e) {
                                    if ("error" === e.event) {
                                        var n = i(e.code);
                                        n && (e.reason = n)
                                    } else "onUserMuteAudio" === e.event ? e.event = "peer-mute-audio": "onUserMuteVideo" === e.event && (e.event = "peer-mute-video");
                                    s.dispatchEvent(AgoraRTC.MediaEvent({
                                        type: e.event,
                                        msg: e
                                    }))
                                },
                                s.signal.sendMessage({
                                        command: "initialize",
                                        appId: e.appId
                                    },
                                    function(e) {
                                        AgoraCall(o, e)
                                    })
                        })
                }
                s.signalOpen && s.signal.sendMessage({
                        command: "initialize",
                        appId: e.appId
                    },
                    function(e) {
                        AgoraCall(o, e)
                    }),
                    s.signal.on("initialize",
                        function(e) {
                            var n = e.msg;
                            return 1 != n.code ? (s.signal.close(), s.signal = void 0, void a(n.code)) : void AgoraCall(r, n)
                        }),
                    s.signal.on("onError",
                        function(e) {
                            var n = e.msg;
                            a(n.code)
                        }),
                    console.log(s.signal)
            },
            s.renewChannelKey = function(e, n, t) {
                s.signal.sendMessage({
                        command: "renewChannelKey",
                        channelKey: e
                    },
                    function(e) {
                        AgoraCall(t, e)
                    }),
                    s.signal.on("renewChannelKey",
                        function(e) {
                            var r = e.msg;
                            return r.code === !0 ? void AgoraCall(n, r) : void AgoraCall(t, r)
                        })
            },
            s.join = function(e, n, o, a, i) {
                return n.length > 64 ? void i(L.ErrorCode.INVALID_CHANNEL_NAME) : (s.signal.sendMessage({
                        command: "joinChannel",
                        channelKey: e,
                        channelName: n,
                        uid: o
                    },
                    function(e) {
                        AgoraCall(i, {
                            error: e
                        })
                    }), void s.signal.on("joinChannel",
                    function(e) {
                        s.signal.on("onAddVideoStream", r),
                            s.signal.on("onPeerLeave", t);
                        var n = e.msg;
                        return 1 == n.code ? (n.uid || (n.uid = 0), void AgoraCall(a, n.uid)) : n.code == L.ErrorCode.JOIN_CHANNEL_REJECTED ? (console.error("Command joinChannel has been rejected by agent. Is this user joined a channel already?"), void AgoraCall(i, n.code)) : void AgoraCall(i, n.code)
                    }))
            },
            s.leave = function(e, n) {
                i(),
                    s.signal.sendMessage({
                            command: "leaveChannel"
                        },
                        function(e) {
                            console.log("leave channel failed", e)
                        }),
                    s.signal.on("leaveChannel",
                        function(t) {
                            var r = t.msg;
                            return r.code === !0 ? void AgoraCall(e, r) : r.code == L.ErrorCode.LEAVE_CHANNEL_REJECTED ? (console.error("Command leaveChannel has been rejected by agent. Is this user not in a channel?"), void AgoraCall(e, r)) : void AgoraCall(n, {
                                code: r.code
                            })
                        })
            },
            s.publish = function(e, n, t) {
                s.localStream = e,
                    s.signal.sendMessage({
                            command: "unmuteLocal"
                        },
                        function(e) {
                            AgoraCall(t, {
                                error: e
                            })
                        }),
                    s.signal.on("unmuteLocal",
                        function(e) {
                            var r = e.msg;
                            return 1 != r.code ? void AgoraCall(t, {
                                code: r.code
                            }) : void AgoraCall(n, r)
                        }),
                    e.bindClient(s)
            },
            s.unpublish = function(e, n, t) {
                s.signal.sendMessage({
                        command: "muteLocal"
                    },
                    function(e) {
                        AgoraCall(t, {
                            error: e
                        })
                    }),
                    s.signal.on("muteLocal",
                        function(e) {
                            var r = e.msg;
                            return 1 != r.code ? void AgoraCall(t, {
                                code: r.code
                            }) : void AgoraCall(n, r)
                        })
            },
            s.subscribe = function(e, n) {
                e.init(function() {
                        s.dispatchEvent(AgoraRTC.StreamEvent({
                            type: "stream-subscribed",
                            stream: e
                        }))
                    },
                    function(e) {
                        AgoraCall(n, e)
                    })
            },
            s.unsubscribe = function(e, n) {
                return console.log("remote streams", s.remoteStreams),
                    void 0 == s.remoteStreams[e] ? void AgoraCall(n, {
                        error: "no such stream"
                    }) : (s.remoteStreams[e].close(), void delete s.remoteStreams[e])
            },
            s.enableAudio = function(e, n) {
                return s.signal.on("enableAudio",
                    function(e) {
                        var t = e.msg;
                        n && AgoraCall(n, t.code === !0)
                    }),
                    s.signal.sendMessage({
                            command: "enableAudio",
                            streamID: e.getId()
                        },
                        function(e) {
                            e.reason = "CONNECTION_TO_AGENT_ERROR",
                                AgoraCall(n, e)
                        }),
                    !0
            },
            s.disableAudio = function(e, n) {
                return s.signal.on("disableAudio",
                    function(e) {
                        var t = e.msg;
                        n && AgoraCall(n, t.code === !0)
                    }),
                    s.signal.sendMessage({
                            command: "disableAudio",
                            streamID: e.getId()
                        },
                        function(e) {
                            e.reason = "CONNECTION_TO_AGENT_ERROR",
                                AgoraCall(n, e)
                        }),
                    !0
            },
            s.enableVideo = function(e, n) {
                return s.signal.on("enableVideo",
                    function(e) {
                        var t = e.msg;
                        n && AgoraCall(n, t.code === !0)
                    }),
                    s.signal.sendMessage({
                            command: "enableVideo",
                            streamID: e.getId()
                        },
                        function(e) {
                            e.reason = "CONNECTION_TO_AGENT_ERROR",
                                AgoraCall(n, e)
                        }),
                    !0
            },
            s.disableVideo = function(e, n) {
                return s.signal.on("disableVideo",
                    function(e) {
                        var t = e.msg;
                        n && AgoraCall(n, t.code === !0)
                    }),
                    s.signal.sendMessage({
                            command: "disableVideo",
                            streamID: e.getId()
                        },
                        function(e) {
                            e.reason = "CONNECTION_TO_AGENT_ERROR",
                                AgoraCall(n, e)
                        }),
                    !0
            },
            s.getDevices = function(e) {
                s.signal.sendMessage({
                        command: "getDevices"
                    },
                    function(n) {
                        n.reason = "CONNECTION_TO_AGENT_ERROR",
                            AgoraCall(e, n)
                    }),
                    s.signal.on("getDevices",
                        function(n) {
                            var t = n.msg.devices;
                            AgoraCall(e, t)
                        })
            },
            s.selectDevice = function(e, n) {
                s.signal.sendMessage({
                        command: "selectDevice",
                        device: e
                    },
                    function(e) {
                        e.reason = "CONNECTION_TO_AGENT_ERROR",
                            AgoraCall(n, e)
                    }),
                    s.signal.on("selectDevice",
                        function(e) {
                            console.log(e)
                        })
            },
            s.startRecording = function(e, n, t) {
                s.signal.sendMessage({
                        command: "startRecording",
                        recordingKey: e
                    },
                    function(e) {
                        e.reason = "CONNECTION_TO_AGENT_ERROR",
                            AgoraCall(t, e)
                    }),
                    s.signal.on("startRecording",
                        function(e) {
                            var r = e.msg;
                            r.code === !0 ? AgoraCall(n, r) : AgoraCall(t, r)
                        })
            },
            s.stopRecording = function(e, n, t) {
                s.signal.sendMessage({
                        command: "stopRecording",
                        recordingKey: e
                    },
                    function(e) {
                        e.reason = "CONNECTION_TO_AGENT_ERROR",
                            AgoraCall(t, e)
                    }),
                    s.signal.on("stopRecording",
                        function(e) {
                            var r = e.msg;
                            r.code === !0 ? AgoraCall(n, r) : AgoraCall(t, r)
                        })
            },
            s.queryRecordingStatus = function(e) {
                s.signal.sendMessage({
                        command: "queryRecordingStatus"
                    },
                    function(n) {
                        n.reason = "CONNECTION_TO_AGENT_ERROR",
                            AgoraCall(e, n)
                    }),
                    s.signal.on("queryRecordingStatus",
                        function(n) {
                            e(n.msg)
                        })
            },
            s.close = function() {
                i(),
                s.signal && (s.signal.close(), s.signal = void 0)
            },
            s.getVersion = function(e, n) {
                s.signal.sendMessage({
                    command: "getVersion"
                }),
                    s.signal.on("getVersion",
                        function(t) {
                            var r = t.msg;
                            r.code === !0 ? e(r) : n(r)
                        })
            },
            s.setParameters = function(e) {
                s.signal.sendMessage({
                    command: "setParameters",
                    parameters: JSON.stringify(e)
                })
            },
            s.setEncryptionMode = function(e) {
                s.signal.sendMessage({
                    command: "setEncryptionMode",
                    mode: e
                })
            },
            s.setEncryptionSecret = function(e) {
                s.signal.sendMessage({
                    command: "setEncryptionSecret",
                    secret: e
                })
            },
            s.getWindows = function(e) {
                s.signal.sendMessage({
                        command: "getWindows"
                    },
                    function(n) {
                        n.reason = "CONNECTION_TO_AGENT_ERROR",
                            AgoraCall(e, n)
                    }),
                    s.signal.on("getWindows",
                        function(n) {
                            var t = n.msg.windows;
                            AgoraCall(e, t)
                        })
            },
            s.startScreenSharing = function(e, n, t) {
                s.signal.sendMessage({
                        command: "startScreenSharing",
                        window: e
                    },
                    function(e) {
                        e.reason = "CONNECTION_TO_AGENT_ERROR",
                            AgoraCall(t, e)
                    }),
                    s.signal.on("startScreenSharing",
                        function(e) {
                            AgoraCall(n, e)
                        })
            },
            s.setScreenSharingWindow = function(e, n, t) {
                s.signal.sendMessage({
                        command: "setScreenSharingWindow",
                        window: e
                    },
                    function(e) {
                        e.reason = "CONNECTION_TO_AGENT_ERROR",
                            AgoraCall(t, e)
                    }),
                    s.signal.on("setScreenSharingWindow",
                        function(e) {
                            AgoraCall(n, e),
                                console.log(e)
                        })
            },
            s.stopScreenSharing = function(e, n) {
                s.signal.sendMessage({
                        command: "stopScreenSharing"
                    },
                    function(e) {
                        e.reason = "CONNECTION_TO_AGENT_ERROR",
                            AgoraCall(n, e)
                    }),
                    s.signal.on("stopScreenSharing",
                        function(n) {
                            AgoraCall(e, n),
                                console.log(n)
                        })
            },
            s
    },
    AgoraRTC.createRtcClient = function() {
        return AgoraRTC.Client({})
    },
    function(e, n) {
        if ("function" == typeof define && define.amd) define([], n);
        else {
            var t = n.call(e);
            Object.keys(t).forEach(function(n) {
                e[n] = t[n]
            })
        }
    } (this,
        function() {
            function e(e) {
                F.console && (F.console.error ? F.console.error(e) : F.console.log && F.console.log(e))
            }
            function n(e) {
                return e = e || F,
                e !== e.top
            }
            function t(e) {
                return '<table style="background-color: #8CE; width: 100%; height: 100%;"><tr><td align="center"><div style="display: table-cell; vertical-align: middle;"><div style="">' + e + "</div></div></td></tr></table>"
            }
            function r(e, n) {
                for (var t = ["webgl", "experimental-webgl"], r = null, o = 0; o < t.length; ++o) {
                    try {
                        r = e.getContext(t[o], n)
                    } catch(a) {}
                    if (r) break
                }
                return r
            }
            function o(e, n) {
                function o(n) {
                    var r = e.parentNode;
                    r && (r.innerHTML = t(n))
                }
                if (!F.WebGLRenderingContext) return o(B),
                    null;
                var a = r(e, n);
                return a || o(V),
                    a
            }
            function a() {
                n() && (document.body.className = "iframe")
            }
            function i(e, t, r) {
                var i = r || {};
                if (n()) {
                    if (a(), !i.dontResize && i.resize !== !1) {
                        var s = e.clientWidth,
                            c = e.clientHeight;
                        e.width = s,
                            e.height = c
                    }
                } else if (!i.noTitle && i.title !== !1) {
                    var l = document.title,
                        u = document.createElement("h1");
                    u.innerText = l,
                        document.body.insertBefore(u, document.body.children[0])
                }
                var d = o(e, t);
                return d
            }
            function s(n, t, r, o) {
                var a = o || e,
                    i = n.createShader(r);
                n.shaderSource(i, t),
                    n.compileShader(i);
                var s = n.getShaderParameter(i, n.COMPILE_STATUS);
                if (!s) {
                    var c = n.getShaderInfoLog(i);
                    return a("*** Error compiling shader '" + i + "':" + c),
                        n.deleteShader(i),
                        null
                }
                return i
            }
            function c(n, t, r, o, a) {
                var i = a || e,
                    s = n.createProgram();
                t.forEach(function(e) {
                    n.attachShader(s, e)
                }),
                r && obj_attrib.forEach(function(e, t) {
                    n.bindAttribLocation(s, o ? o[t] : t, e)
                }),
                    n.linkProgram(s);
                var c = n.getProgramParameter(s, n.LINK_STATUS);
                if (!c) {
                    var l = n.getProgramInfoLog(s);
                    return i("Error in program linking:" + l),
                        n.deleteProgram(s),
                        null
                }
                return s
            }
            function l(e, n, t, r) {
                var o, a = "",
                    i = document.getElementById(n);
                if (!i) throw "*** Error: unknown script element" + n;
                if (a = i.text, !t) if ("x-shader/x-vertex" === i.type) o = e.VERTEX_SHADER;
                else if ("x-shader/x-fragment" === i.type) o = e.FRAGMENT_SHADER;
                else if (o !== e.VERTEX_SHADER && o !== e.FRAGMENT_SHADER) throw "*** Error: unknown shader type";
                return s(e, a, t ? t: o, r)
            }
            function u(e, n, t, r, o) {
                for (var a = [], i = 0; i < n.length; ++i) a.push(l(e, n[i], e[G[i]], o));
                return c(e, a, t, r, o)
            }
            function d(e, n, t, r, o) {
                for (var a = [], i = 0; i < n.length; ++i) a.push(s(e, n[i], e[G[i]], o));
                return c(e, a, t, r, o)
            }
            function g(e, n) {
                return n === e.SAMPLER_2D ? e.TEXTURE_2D: n === e.SAMPLER_CUBE ? e.TEXTURE_CUBE_MAP: void 0
            }
            function f(e, n) {
                function t(n, t) {
                    var o = e.getUniformLocation(n, t.name),
                        a = t.type,
                        i = t.size > 1 && "[0]" === t.name.substr( - 3);
                    if (a === e.FLOAT && i) return function(n) {
                        e.uniform1fv(o, n)
                    };
                    if (a === e.FLOAT) return function(n) {
                        e.uniform1f(o, n)
                    };
                    if (a === e.FLOAT_VEC2) return function(n) {
                        e.uniform2fv(o, n)
                    };
                    if (a === e.FLOAT_VEC3) return function(n) {
                        e.uniform3fv(o, n)
                    };
                    if (a === e.FLOAT_VEC4) return function(n) {
                        e.uniform4fv(o, n)
                    };
                    if (a === e.INT && i) return function(n) {
                        e.uniform1iv(o, n)
                    };
                    if (a === e.INT) return function(n) {
                        e.uniform1i(o, n)
                    };
                    if (a === e.INT_VEC2) return function(n) {
                        e.uniform2iv(o, n)
                    };
                    if (a === e.INT_VEC3) return function(n) {
                        e.uniform3iv(o, n)
                    };
                    if (a === e.INT_VEC4) return function(n) {
                        e.uniform4iv(o, n)
                    };
                    if (a === e.BOOL) return function(n) {
                        e.uniform1iv(o, n)
                    };
                    if (a === e.BOOL_VEC2) return function(n) {
                        e.uniform2iv(o, n)
                    };
                    if (a === e.BOOL_VEC3) return function(n) {
                        e.uniform3iv(o, n)
                    };
                    if (a === e.BOOL_VEC4) return function(n) {
                        e.uniform4iv(o, n)
                    };
                    if (a === e.FLOAT_MAT2) return function(n) {
                        e.uniformMatrix2fv(o, !1, n)
                    };
                    if (a === e.FLOAT_MAT3) return function(n) {
                        e.uniformMatrix3fv(o, !1, n)
                    };
                    if (a === e.FLOAT_MAT4) return function(n) {
                        e.uniformMatrix4fv(o, !1, n)
                    };
                    if ((a === e.SAMPLER_2D || a === e.SAMPLER_CUBE) && i) {
                        for (var s = [], c = 0; c < info.size; ++c) s.push(r++);
                        return function(n, t) {
                            return function(r) {
                                e.uniform1iv(o, t),
                                    r.forEach(function(r, o) {
                                        e.activeTexture(e.TEXTURE0 + t[o]),
                                            e.bindTexture(n, r)
                                    })
                            }
                        } (g(e, a), s)
                    }
                    if (a === e.SAMPLER_2D || a === e.SAMPLER_CUBE) return function(n, t) {
                        return function(r) {
                            e.uniform1i(o, t),
                                e.activeTexture(e.TEXTURE0 + t),
                                e.bindTexture(n, r)
                        }
                    } (g(e, a), r++);
                    throw "unknown type: 0x" + a.toString(16)
                }
                for (var r = 0,
                         o = {},
                         a = e.getProgramParameter(n, e.ACTIVE_UNIFORMS), i = 0; i < a; ++i) {
                    var s = e.getActiveUniform(n, i);
                    if (!s) break;
                    var c = s.name;
                    "[0]" === c.substr( - 3) && (c = c.substr(0, c.length - 3));
                    var l = t(n, s);
                    o[c] = l
                }
                return o
            }
            function m(e, n) {
                Object.keys(n).forEach(function(t) {
                    var r = e[t];
                    r && r(n[t])
                })
            }
            function v(e, n) {
                function t(n) {
                    return function(t) {
                        e.bindBuffer(e.ARRAY_BUFFER, t.buffer),
                            e.enableVertexAttribArray(n),
                            e.vertexAttribPointer(n, t.numComponents || t.size, t.type || e.FLOAT, t.normalize || !1, t.stride || 0, t.offset || 0)
                    }
                }
                for (var r = {},
                         o = e.getProgramParameter(n, e.ACTIVE_ATTRIBUTES), a = 0; a < o; ++a) {
                    var i = e.getActiveAttrib(n, a);
                    if (!i) break;
                    var s = e.getAttribLocation(n, i.name);
                    r[i.name] = t(s)
                }
                return r
            }
            function E(e, n) {
                Object.keys(n).forEach(function(t) {
                    var r = e[t];
                    r && r(n[t])
                })
            }
            function A(e, n, t, r, o) {
                n = n.map(function(e) {
                    var n = document.getElementById(e);
                    return n ? n.text: e
                });
                var a = d(e, n, t, r, o);
                if (!a) return null;
                var i = f(e, a),
                    s = v(e, a);
                return {
                    program: a,
                    uniformSetters: i,
                    attribSetters: s
                }
            }
            function T(e, n, t) {
                E(n, t.attribs),
                t.indices && e.bindBuffer(e.ELEMENT_ARRAY_BUFFER, t.indices)
            }
            function _(e, n) {
                for (var t = 0; t < W.length; ++t) {
                    var r = W[t] + n,
                        o = e.getExtension(r);
                    if (o) return o
                }
            }
            function R(e, n) {
                n = n || 1;
                var t = e.clientWidth * n,
                    r = e.clientHeight * n;
                return (e.width !== t || e.height !== r) && (e.width = t, e.height = r, !0)
            }
            function h(e, n) {
                var t = 0;
                return e.push = function() {
                    for (var n = 0; n < arguments.length; ++n) {
                        var r = arguments[n];
                        if (r instanceof Array || r.buffer && r.buffer instanceof ArrayBuffer) for (var o = 0; o < r.length; ++o) e[t++] = r[o];
                        else e[t++] = r
                    }
                },
                    e.reset = function(e) {
                        t = e || 0
                    },
                    e.numComponents = n,
                    Object.defineProperty(e, "numElements", {
                        get: function() {
                            return this.length / this.numComponents | 0
                        }
                    }),
                    e
            }
            function C(e, n, t) {
                var r = t || Float32Array;
                return h(new r(e * n), e)
            }
            function p(e, n, t, r) {
                t = t || e.ARRAY_BUFFER;
                var o = e.createBuffer();
                return e.bindBuffer(t, o),
                    e.bufferData(t, n, r || e.STATIC_DRAW),
                    o
            }
            function y(e) {
                return "indices" !== e
            }
            function N(e) {
                var n = {};
                return Object.keys(e).filter(y).forEach(function(e) {
                    n["a_" + e] = e
                }),
                    n
            }
            function O(e, n) {
                if (n instanceof Int8Array) return e.BYTE;
                if (n instanceof Uint8Array) return e.UNSIGNED_BYTE;
                if (n instanceof Int16Array) return e.SHORT;
                if (n instanceof Uint16Array) return e.UNSIGNED_SHORT;
                if (n instanceof Int32Array) return e.INT;
                if (n instanceof Uint32Array) return e.UNSIGNED_INT;
                if (n instanceof Float32Array) return e.FLOAT;
                throw "unsupported typed array type"
            }
            function b(e) {
                return e instanceof Int8Array || e instanceof Uint8Array
            }
            function S(e) {
                return e.buffer && e.buffer instanceof ArrayBuffer
            }
            function I(e, n) {
                var t;
                if (t = e.indexOf("coord") >= 0 ? 2 : e.indexOf("color") >= 0 ? 4 : 3, n % t > 0) throw "can not guess numComponents. You should specify it.";
                return t
            }
            function P(e, n) {
                if (S(e)) return e;
                Array.isArray(e) && (e = {
                    data: e
                }),
                e.numComponents || (e.numComponents = I(n, e.length));
                var t = e.type;
                t || "indices" === n && (t = Uint16Array);
                var r = C(e.numComponents, e.data.length / e.numComponents | 0, t);
                return r.push(e.data),
                    r
            }
            function L(e, n, t) {
                var r = t || N(n),
                    o = {};
                return Object.keys(r).forEach(function(t) {
                    var a = r[t],
                        i = P(n[a], a);
                    o[t] = {
                        buffer: p(e, i),
                        numComponents: i.numComponents || I(a),
                        type: O(e, i),
                        normalize: b(i)
                    }
                }),
                    o
            }
            function U(e) {
                var n = Object.keys(e)[0],
                    t = e[n];
                return S(t) ? t.numElements: t.data.length / t.numComponents
            }
            function D(e, n, t) {
                var r = {
                        attribs: L(e, n, t)
                    },
                    o = n.indices;
                return o ? (o = P(o, "indices"), r.indices = p(e, o, e.ELEMENT_ARRAY_BUFFER), r.numElements = o.length) : r.numElements = U(n),
                    r
            }
            function w(e, n) {
                var t = {};
                return Object.keys(n).forEach(function(r) {
                    var o = "indices" === r ? e.ELEMENT_ARRAY_BUFFER: e.ARRAY_BUFFER,
                        a = P(n[r], name);
                    t[r] = p(e, a, o)
                }),
                    n.indices ? t.numElements = n.indices.length: n.position && (t.numElements = n.position.length / 3),
                    t
            }
            function M(e, n, t, r, o) {
                var a = t.indices,
                    i = void 0 === r ? t.numElements: r;
                o = void 0 === o ? o: 0,
                    a ? e.drawElements(n, i, e.UNSIGNED_SHORT, o) : e.drawArrays(n, o, i)
            }
            function x(e, n) {
                var t = null,
                    r = null;
                n.forEach(function(n) {
                    var o = n.programInfo,
                        a = n.bufferInfo,
                        i = !1;
                    o !== t && (t = o, e.useProgram(o.program), i = !0),
                    (i || a !== r) && (r = a, T(e, o.attribSetters, a)),
                        m(o.uniformSetters, n.uniforms),
                        M(e, e.TRIANGLES, a)
                })
            }
            var F = this,
                B = 'This page requires a browser that supports WebGL.<br/><a href="http://get.webgl.org">Click here to upgrade your browser.</a>',
                V = 'It doesn\'t appear your computer can support WebGL.<br/><a href="http://get.webgl.org/troubleshooting/">Click here for more information.</a>',
                G = ["VERTEX_SHADER", "FRAGMENT_SHADER"],
                W = ["", "MOZ_", "OP_", "WEBKIT_"];
            return {
                createAugmentedTypedArray: C,
                createAttribsFromArrays: L,
                createBuffersFromArrays: w,
                createBufferInfoFromArrays: D,
                createAttributeSetters: v,
                createProgram: c,
                createProgramFromScripts: u,
                createProgramFromSources: d,
                createProgramInfo: A,
                createUniformSetters: f,
                drawBufferInfo: M,
                drawObjectList: x,
                getWebGLContext: i,
                updateCSSIfInIFrame: a,
                getExtensionWithKnownPrefixes: _,
                resizeCanvasToDisplaySize: R,
                setAttributes: E,
                setBuffersAndAttributes: T,
                setUniforms: m,
                setupWebGL: o
            }
        });