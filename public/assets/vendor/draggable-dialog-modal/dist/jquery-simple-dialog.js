!(function (e) {
    var t = {};
    function n(o) {
        if (t[o]) return t[o].exports;
        var a = (t[o] = { i: o, l: !1, exports: {} });
        return e[o].call(a.exports, a, a.exports, n), (a.l = !0), a.exports;
    }
    (n.m = e),
        (n.c = t),
        (n.d = function (e, t, o) {
            n.o(e, t) ||
                Object.defineProperty(e, t, { enumerable: !0, get: o });
        }),
        (n.r = function (e) {
            "undefined" != typeof Symbol &&
                Symbol.toStringTag &&
                Object.defineProperty(e, Symbol.toStringTag, {
                    value: "Module",
                }),
                Object.defineProperty(e, "__esModule", { value: !0 });
        }),
        (n.t = function (e, t) {
            if ((1 & t && (e = n(e)), 8 & t)) return e;
            if (4 & t && "object" == typeof e && e && e.__esModule) return e;
            var o = Object.create(null);
            if (
                (n.r(o),
                Object.defineProperty(o, "default", {
                    enumerable: !0,
                    value: e,
                }),
                2 & t && "string" != typeof e)
            )
                for (var a in e)
                    n.d(
                        o,
                        a,
                        function (t) {
                            return e[t];
                        }.bind(null, a)
                    );
            return o;
        }),
        (n.n = function (e) {
            var t =
                e && e.__esModule
                    ? function () {
                          return e.default;
                      }
                    : function () {
                          return e;
                      };
            return n.d(t, "a", t), t;
        }),
        (n.o = function (e, t) {
            return Object.prototype.hasOwnProperty.call(e, t);
        }),
        (n.p = "/dist"),
        n((n.s = 5));
})([
    function (e, t) {
        e.exports = jQuery;
    },
    function (e, t, n) {
        var o = n(2),
            a = n(3);
        "string" == typeof (a = a.__esModule ? a.default : a) &&
            (a = [[e.i, a, ""]]);
        var i = { insert: "head", singleton: !1 };
        o(a, i);
        e.exports = a.locals || {};
    },
    function (e, t, n) {
        "use strict";
        var o,
            a = function () {
                return (
                    void 0 === o &&
                        (o = Boolean(
                            window && document && document.all && !window.atob
                        )),
                    o
                );
            },
            i = (function () {
                var e = {};
                return function (t) {
                    if (void 0 === e[t]) {
                        var n = document.querySelector(t);
                        if (
                            window.HTMLIFrameElement &&
                            n instanceof window.HTMLIFrameElement
                        )
                            try {
                                n = n.contentDocument.head;
                            } catch (e) {
                                n = null;
                            }
                        e[t] = n;
                    }
                    return e[t];
                };
            })(),
            r = [];
        function s(e) {
            for (var t = -1, n = 0; n < r.length; n++)
                if (r[n].identifier === e) {
                    t = n;
                    break;
                }
            return t;
        }
        function c(e, t) {
            for (var n = {}, o = [], a = 0; a < e.length; a++) {
                var i = e[a],
                    c = t.base ? i[0] + t.base : i[0],
                    u = n[c] || 0,
                    l = "".concat(c, " ").concat(u);
                n[c] = u + 1;
                var d = s(l),
                    f = { css: i[1], media: i[2], sourceMap: i[3] };
                -1 !== d
                    ? (r[d].references++, r[d].updater(f))
                    : r.push({
                          identifier: l,
                          updater: m(f, t),
                          references: 1,
                      }),
                    o.push(l);
            }
            return o;
        }
        function u(e) {
            var t = document.createElement("style"),
                o = e.attributes || {};
            if (void 0 === o.nonce) {
                var a = n.nc;
                a && (o.nonce = a);
            }
            if (
                (Object.keys(o).forEach(function (e) {
                    t.setAttribute(e, o[e]);
                }),
                "function" == typeof e.insert)
            )
                e.insert(t);
            else {
                var r = i(e.insert || "head");
                if (!r)
                    throw new Error(
                        "Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid."
                    );
                r.appendChild(t);
            }
            return t;
        }
        var l,
            d =
                ((l = []),
                function (e, t) {
                    return (l[e] = t), l.filter(Boolean).join("\n");
                });
        function f(e, t, n, o) {
            var a = n
                ? ""
                : o.media
                ? "@media ".concat(o.media, " {").concat(o.css, "}")
                : o.css;
            if (e.styleSheet) e.styleSheet.cssText = d(t, a);
            else {
                var i = document.createTextNode(a),
                    r = e.childNodes;
                r[t] && e.removeChild(r[t]),
                    r.length ? e.insertBefore(i, r[t]) : e.appendChild(i);
            }
        }
        function h(e, t, n) {
            var o = n.css,
                a = n.media,
                i = n.sourceMap;
            if (
                (a ? e.setAttribute("media", a) : e.removeAttribute("media"),
                i &&
                    "undefined" != typeof btoa &&
                    (o +=
                        "\n/*# sourceMappingURL=data:application/json;base64,".concat(
                            btoa(
                                unescape(encodeURIComponent(JSON.stringify(i)))
                            ),
                            " */"
                        )),
                e.styleSheet)
            )
                e.styleSheet.cssText = o;
            else {
                for (; e.firstChild; ) e.removeChild(e.firstChild);
                e.appendChild(document.createTextNode(o));
            }
        }
        var p = null,
            g = 0;
        function m(e, t) {
            var n, o, a;
            if (t.singleton) {
                var i = g++;
                (n = p || (p = u(t))),
                    (o = f.bind(null, n, i, !1)),
                    (a = f.bind(null, n, i, !0));
            } else
                (n = u(t)),
                    (o = h.bind(null, n, t)),
                    (a = function () {
                        !(function (e) {
                            if (null === e.parentNode) return !1;
                            e.parentNode.removeChild(e);
                        })(n);
                    });
            return (
                o(e),
                function (t) {
                    if (t) {
                        if (
                            t.css === e.css &&
                            t.media === e.media &&
                            t.sourceMap === e.sourceMap
                        )
                            return;
                        o((e = t));
                    } else a();
                }
            );
        }
        e.exports = function (e, t) {
            (t = t || {}).singleton ||
                "boolean" == typeof t.singleton ||
                (t.singleton = a());
            var n = c((e = e || []), t);
            return function (e) {
                if (
                    ((e = e || []),
                    "[object Array]" === Object.prototype.toString.call(e))
                ) {
                    for (var o = 0; o < n.length; o++) {
                        var a = s(n[o]);
                        r[a].references--;
                    }
                    for (var i = c(e, t), u = 0; u < n.length; u++) {
                        var l = s(n[u]);
                        0 === r[l].references &&
                            (r[l].updater(), r.splice(l, 1));
                    }
                    n = i;
                }
            };
        };
    },
    function (e, t, n) {
        (t = n(4)(!1)).push([
            e.i,
            ".simple-dialog{display:none;position:fixed;left:50%;top:50%;transform:translate(-50%, -50%);background: rgba(241,243,244);z-index:2000; border-radius:8px;}.simple-dialog-modal{position:fixed;z-index:999;left:0;top:0;right:0;bottom:0;width:100%;height:100%;overflow:auto;background-color:rgba(0,0,0,0.6)}.simple-dialog-disable-scroll{height:100%;overflow:hidden}.simple-dialog-user-select-none{-webkit-touch-callout:none;-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}\n",
            "",
        ]),
            (e.exports = t);
    },
    function (e, t, n) {
        "use strict";
        e.exports = function (e) {
            var t = [];
            return (
                (t.toString = function () {
                    return this.map(function (t) {
                        var n = (function (e, t) {
                            var n = e[1] || "",
                                o = e[3];
                            if (!o) return n;
                            if (t && "function" == typeof btoa) {
                                var a =
                                        ((r = o),
                                        (s = btoa(
                                            unescape(
                                                encodeURIComponent(
                                                    JSON.stringify(r)
                                                )
                                            )
                                        )),
                                        (c =
                                            "sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(
                                                s
                                            )),
                                        "/*# ".concat(c, " */")),
                                    i = o.sources.map(function (e) {
                                        return "/*# sourceURL="
                                            .concat(o.sourceRoot || "")
                                            .concat(e, " */");
                                    });
                                return [n].concat(i).concat([a]).join("\n");
                            }
                            var r, s, c;
                            return [n].join("\n");
                        })(t, e);
                        return t[2]
                            ? "@media ".concat(t[2], " {").concat(n, "}")
                            : n;
                    }).join("");
                }),
                (t.i = function (e, n, o) {
                    "string" == typeof e && (e = [[null, e, ""]]);
                    var a = {};
                    if (o)
                        for (var i = 0; i < this.length; i++) {
                            var r = this[i][0];
                            null != r && (a[r] = !0);
                        }
                    for (var s = 0; s < e.length; s++) {
                        var c = [].concat(e[s]);
                        (o && a[c[0]]) ||
                            (n &&
                                (c[2]
                                    ? (c[2] = ""
                                          .concat(n, " and ")
                                          .concat(c[2]))
                                    : (c[2] = n)),
                            t.push(c));
                    }
                }),
                t
            );
        };
    },
    function (e, t, n) {
        "use strict";
        n.r(t);
        var o = n(0),
            a = n.n(o),
            i = "simple-dialog";
        n(1);
        function r(e, t) {
            for (var n = 0; n < t.length; n++) {
                var o = t[n];
                (o.enumerable = o.enumerable || !1),
                    (o.configurable = !0),
                    "value" in o && (o.writable = !0),
                    Object.defineProperty(e, o.key, o);
            }
        }
        var s = (function () {
            function e(t) {
                !(function (e, t) {
                    if (!(e instanceof t))
                        throw new TypeError(
                            "Cannot call a class as a function"
                        );
                })(this, e),
                    (this.instance = t),
                    (this.options = t.options),
                    (this.$dialog = t.$dialog),
                    (this.uid = new Date().getTime() + Math.random()),
                    (this.namespace = "".concat(i, "-").concat(this.uid)),
                    (this.$opener = a()(this.options.opener)),
                    (this.$closer = a()(this.options.closer));
            }
            var t, n, o;
            return (
                (t = e),
                (n = [
                    {
                        key: "init",
                        value: function () {
                            this.$dialog.addClass("".concat(i)),
                                this.unbind(),
                                this.bind();
                        },
                    },
                    {
                        key: "destroy",
                        value: function () {
                            this.$dialog.removeClass("".concat(i)),
                                this.$dialog.removeData(i),
                                this.unbind();
                        },
                    },
                    {
                        key: "bind",
                        value: function () {
                            var e = this;
                            this.$opener.on(
                                "click.".concat(this.namespace),
                                function (t) {
                                    t.preventDefault(),
                                        e.open(a()(t.currentTarget));
                                }
                            ),
                                this.$closer.on(
                                    "click.".concat(this.namespace),
                                    function (t) {
                                        t.preventDefault(),
                                            e.close(a()(t.currentTarget));
                                    }
                                ),
                                a()(document).on(
                                    "keydown.".concat(this.namespace),
                                    function (t) {
                                        27 == t.keyCode &&
                                            (t.preventDefault(),
                                            e.close(a()(t.currentTarget)));
                                    }
                                );
                        },
                    },
                    {
                        key: "unbind",
                        value: function () {
                            this.$opener.off(".".concat(this.namespace)),
                                this.$closer.off(".".concat(this.namespace)),
                                this.$dialog.off(".".concat(this.namespace)),
                                a()(document).off(".".concat(this.namespace));
                        },
                    },
                    {
                        key: "open",
                        value: function (e) {
                            this.$dialog.is(":visible") ||
                                (this.$dialog.show(),
                                this.options.modal && this.createModal(),
                                this.options.focus &&
                                    this.$dialog
                                        .find(this.options.focus)
                                        .focus(),
                                this.$dialog.trigger("dialog:open", [e]));
                        },
                    },
                    {
                        key: "close",
                        value: function (e) {
                            this.$dialog.is(":hidden") ||
                                (this.$dialog.hide(),
                                this.options.modal && this.removeModal(),
                                this.$dialog.trigger("dialog:close", [e]));
                        },
                    },
                    {
                        key: "createModal",
                        value: function () {
                            var e = this;
                            (this.$modal = a()("<div>").addClass(
                                "".concat(i, "-modal")
                            )),
                                this.$dialog.parent().append(this.$modal),
                                this.$modal.append(this.$dialog),
                                a()(document)
                                    .find("body")
                                    .addClass("".concat(i, "-disable-scroll")),
                                this.$modal.on(
                                    "click.".concat(this.namespace),
                                    function (t) {
                                        t.target == e.$dialog.get(0) ||
                                            a.a.contains(
                                                e.$modal.get(0),
                                                t.target
                                            ) ||
                                            e.close(a()(t.currentTarget));
                                    }
                                );
                        },
                    },
                    {
                        key: "removeModal",
                        value: function () {
                            this.$modal.parent().append(this.$dialog),
                                this.$modal.remove(),
                                a()(document)
                                    .find("body")
                                    .removeClass(
                                        "".concat(i, "-disable-scroll")
                                    );
                        },
                    },
                ]) && r(t.prototype, n),
                o && r(t, o),
                e
            );
        })();
        function c(e, t) {
            for (var n = 0; n < t.length; n++) {
                var o = t[n];
                (o.enumerable = o.enumerable || !1),
                    (o.configurable = !0),
                    "value" in o && (o.writable = !0),
                    Object.defineProperty(e, o.key, o);
            }
        }
        var u = (function () {
            function e(t) {
                !(function (e, t) {
                    if (!(e instanceof t))
                        throw new TypeError(
                            "Cannot call a class as a function"
                        );
                })(this, e),
                    (this.instance = t),
                    (this.options = t.options),
                    (this.$dialog = t.$dialog),
                    (this.uid = new Date().getTime() + Math.random()),
                    (this.namespace = "".concat(i, "-").concat(this.uid)),
                    (this.$dragger = this.$dialog.find(this.options.dragger));
            }
            var t, n, o;
            return (
                (t = e),
                (n = [
                    {
                        key: "init",
                        value: function () {
                            (this.dragging = !1),
                                (this.startPos = [0, 0]),
                                (this.targetPos = [0, 0]),
                                this.unbind(),
                                this.bind();
                        },
                    },
                    {
                        key: "destroy",
                        value: function () {
                            this.unbind();
                        },
                    },
                    {
                        key: "bind",
                        value: function () {
                            var e = this;
                            this.$dragger.length &&
                                (this.$dragger
                                    .on(
                                        "mousedown.".concat(this.namespace),
                                        function (t) {
                                            e.dragStart([t.pageX, t.pageY]);
                                        }
                                    )
                                    .on(
                                        "touchstart.".concat(this.namespace),
                                        function (t) {
                                            var n =
                                                t.originalEvent
                                                    .changedTouches[0];
                                            e.dragStart([n.pageX, n.pageY]);
                                        }
                                    ),
                                a()(document)
                                    .on(
                                        "mousemove.".concat(this.namespace),
                                        function (t) {
                                            e.drag([t.pageX, t.pageY]);
                                        }
                                    )
                                    .on(
                                        "mouseup."
                                            .concat(
                                                this.namespace,
                                                " mouseleave."
                                            )
                                            .concat(this.namespace),
                                        function (t) {
                                            e.dragEnd([t.pageX, t.pageY]);
                                        }
                                    )
                                    .on(
                                        "touchmove.".concat(this.namespace),
                                        function (t) {
                                            e.drag([
                                                t.changedTouches[0].pageX,
                                                t.changedTouches[0].pageY,
                                            ]);
                                        }
                                    )
                                    .on(
                                        "touchend.".concat(this.namespace),
                                        function (t) {
                                            e.dragEnd([t.pageX, t.pageY]);
                                        }
                                    ));
                        },
                    },
                    {
                        key: "unbind",
                        value: function () {
                            a()(document).off(".".concat(this.namespace));
                        },
                    },
                    {
                        key: "dragStart",
                        value: function (e) {
                            (this.dragging = !0),
                                (this.startPos = e),
                                (this.targetPos = this.parseTransform(
                                    this.$dialog.css("transform")
                                )),
                                this.$dragger.addClass(
                                    "".concat(i, "-user-select-none")
                                );
                        },
                    },
                    {
                        key: "drag",
                        value: function (e) {
                            if (this.dragging) {
                                var t = [
                                        e[0] - this.startPos[0],
                                        e[1] - this.startPos[1],
                                    ],
                                    n = [
                                        this.targetPos[0] + t[0],
                                        this.targetPos[1] + t[1],
                                    ];
                                this.$dialog.css(
                                    "transform",
                                    "translate("
                                        .concat(n[0], "px, ")
                                        .concat(n[1], "px)")
                                );
                            }
                        },
                    },
                    {
                        key: "dragEnd",
                        value: function () {
                            (this.dragging = !1),
                                this.$dragger.removeClass(
                                    "".concat(i, "-user-select-none")
                                );
                        },
                    },
                    {
                        key: "parseTransform",
                        value: function (e) {
                            var t = e.match(/matrix\((.+)\)/);
                            if (t) {
                                var n = t[1].split(",");
                                return [parseInt(n[4]), parseInt(n[5])];
                            }
                            return [0, 0];
                        },
                    },
                ]) && c(t.prototype, n),
                o && c(t, o),
                e
            );
        })();
        function l(e, t) {
            if (!(e instanceof t))
                throw new TypeError("Cannot call a class as a function");
        }
        function d(e, t) {
            for (var n = 0; n < t.length; n++) {
                var o = t[n];
                (o.enumerable = o.enumerable || !1),
                    (o.configurable = !0),
                    "value" in o && (o.writable = !0),
                    Object.defineProperty(e, o.key, o);
            }
        }
        var f = {
                opener: null,
                closer: null,
                dragger: null,
                focus: null,
                modal: !1,
            },
            h = (function () {
                function e(t) {
                    var n =
                        arguments.length > 1 && void 0 !== arguments[1]
                            ? arguments[1]
                            : {};
                    l(this, e),
                        (this.options = a.a.extend(!0, {}, f, n)),
                        (this.$dialog = a()(t)),
                        (this.dialog = new s(this)),
                        (this.dragger = new u(this)),
                        this.init();
                }
                var t, n, o;
                return (
                    (t = e),
                    (o = [
                        {
                            key: "getDefaults",
                            value: function () {
                                return f;
                            },
                        },
                        {
                            key: "setDefaults",
                            value: function (e) {
                                return a.a.extend(!0, f, e);
                            },
                        },
                    ]),
                    (n = [
                        {
                            key: "init",
                            value: function () {
                                this.dialog.init(), this.dragger.init();
                            },
                        },
                        {
                            key: "destroy",
                            value: function () {
                                this.dialog.destroy(), this.dragger.destroy();
                            },
                        },
                    ]) && d(t.prototype, n),
                    o && d(t, o),
                    e
                );
            })();
        (a.a.fn.simpleDialog = function (e) {
            return this.each(function (t, n) {
                var o = a()(n);
                o.data(i) && o.data(i).destroy(), o.data(i, new h(o, e));
            });
        }),
            (a.a.SimpleDialog = h);
    },
]);
