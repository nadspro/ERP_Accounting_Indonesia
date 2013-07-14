if (!window.__twttrlr) {
    (function(a, b) {
        function s(a) {
            for (var b = 1, c; c = arguments[b]; b++)
                for (var d in c)
                    a[d] = c[d];
            return a
        }
        function t(a) {
            return Array.prototype.slice.call(a)
        }
        function v(a, b) {
            for (var c = 0, d; d = a[c]; c++)
                if (b == d)
                    return c;
            return-1
        }
        function w() {
            var a = t(arguments), b = [];
            for (var c = 0, d = a.length; c < d; c++)
                a[c].length > 0 && b.push(a[c].replace(/\/$/, ""));
            return b.join("/")
        }
        function x(a, b, c) {
            var d = b.split("/"), e = a;
            while (d.length > 1) {
                var f = d.shift();
                e = e[f] = e[f] || {}
            }
            e[d[0]] = c
        }
        function y() {
        }
        function z(a, b) {
            this.id = this.path = a, this.force = !!b
        }
        function A(a, b) {
            this.id = a, this.body = b, typeof b == "undefined" && (this.path = this.resolvePath(a))
        }
        function B(a, b) {
            this.deps = a, this.collectResults = b, this.deps.length == 0 && this.complete()
        }
        function C(a, b) {
            this.deps = a, this.collectResults = b
        }
        function D() {
            for (var a in d)
                if (d[a].readyState == "interactive")
                    return l[d[a].id]
        }
        function E(a, b) {
            var d;
            return!a && c && (d = k || D()), d ? (delete l[d.scriptId], d.body = b, d.execute()) : (j = d = new A(a, b), i[d.id] = d), d
        }
        function F() {
            var a = t(arguments), b, c;
            return typeof a[0] == "string" && (b = a.shift()), c = a.shift(), E(b, c)
        }
        function G(a, b) {
            var c = b.id || "", d = c.split("/");
            d.pop();
            var e = d.join("/");
            return a.replace(/^\./, e)
        }
        function H(a, b) {
            function d(a) {
                return A.exports[G(a, b)]
            }
            var c = [];
            for (var e = 0, f = a.length; e < f; e++) {
                if (a[e] == "require") {
                    c.push(d);
                    continue
                }
                if (a[e] == "exports") {
                    b.exports = b.exports || {}, c.push(b.exports);
                    continue
                }
                c.push(d(a[e]))
            }
            return c
        }
        function I() {
            var a = t(arguments), b = [], c, d;
            return typeof a[0] == "string" && (c = a.shift()), u(a[0]) && (b = a.shift()), d = a.shift(), E(c, function(a) {
                function f() {
                    var e = H(t(b), c), f;
                    typeof d == "function" ? f = d.apply(c, e) : f = d, typeof f == "undefined" && (f = c.exports), a(f)
                }
                var c = this, e = [];
                for (var g = 0, h = b.length; g < h; g++) {
                    var i = b[g];
                    v(["require", "exports"], i) == -1 && e.push(G(i, c))
                }
                e.length > 0 ? J.apply(this, e.concat(f)) : f()
            })
        }
        function J() {
            var a = t(arguments), b, c;
            typeof a[a.length - 1] == "function" && (b = a.pop()), typeof a[a.length - 1] == "boolean" && (c = a.pop());
            var d = new B(K(a, c), c);
            return b && d.then(b), d
        }
        function K(a, b) {
            var c = [];
            for (var d = 0, e; e = a[d]; d++)
                typeof e == "string" && (e = L(e)), u(e) && (e = new C(K(e, b), b)), c.push(e);
            return c
        }
        function L(a) {
            var b, c;
            for (var d = 0, e; e = J.matchers[d]; d++) {
                var f = e[0], g = e[1];
                if (b = a.match(f))
                    return g(a)
            }
            throw new Error(a + " was not recognised by loader")
        }
        function N() {
            return a.using = m, a.provide = n, a.define = o, a.loadrunner = p, M
        }
        function O(a) {
            for (var b = 0; b < J.bundles.length; b++)
                for (var c in J.bundles[b])
                    if (c != a && v(J.bundles[b][c], a) > -1)
                        return c
        }
        var c = a.attachEvent && !a.opera, d = b.getElementsByTagName("script"), e = 0, f, g = b.createElement("script"), h = {}, i = {}, j, k, l = {}, m = a.using, n = a.provide, o = a.define, p = a.loadrunner;
        for (var q = 0, r; r = d[q]; q++)
            if (r.src.match(/loadrunner\.js(\?|#|$)/)) {
                f = r;
                break
            }
        var u = Array.isArray || function(a) {
            return a.constructor == Array
        };
        y.prototype.then = function(b) {
            var c = this;
            return this.started || (this.started = !0, this.start()), this.completed ? b.apply(a, this.results) : (this.callbacks = this.callbacks || [], this.callbacks.push(b)), this
        }, y.prototype.start = function() {
        }, y.prototype.complete = function() {
            if (!this.completed) {
                this.results = t(arguments), this.completed = !0;
                if (this.callbacks)
                    for (var b = 0, c; c = this.callbacks[b]; b++)
                        c.apply(a, this.results)
            }
        }, z.loaded = [], z.prototype = new y, z.prototype.start = function() {
            var a = this, b, c, d;
            return(d = i[this.id]) ? (d.then(function() {
                a.complete()
            }), this) : ((b = h[this.id]) ? b.then(function() {
                a.loaded()
            }) : !this.force && v(z.loaded, this.id) > -1 ? this.loaded() : (c = O(this.id)) ? J(c, function() {
                a.loaded()
            }) : this.load(), this)
        }, z.prototype.load = function() {
            var b = this;
            h[this.id] = b;
            var c = g.cloneNode(!1);
            this.scriptId = c.id = "LR" + ++e, c.type = "text/javascript", c.async = !0, c.onerror = function() {
                throw new Error(b.path + " not loaded")
            }, c.onreadystatechange = c.onload = function(c) {
                c = a.event || c;
                if (c.type == "load" || v(["loaded", "complete"], this.readyState) > -1)
                    this.onreadystatechange = null, b.loaded()
            }, c.src = this.path, k = this, d[0].parentNode.insertBefore(c, d[0]), k = null, l[c.id] = this
        }, z.prototype.loaded = function() {
            this.complete()
        }, z.prototype.complete = function() {
            v(z.loaded, this.id) == -1 && z.loaded.push(this.id), delete h[this.id], y.prototype.complete.apply(this, arguments)
        }, A.exports = {}, A.prototype = new z, A.prototype.resolvePath = function(a) {
            return w(J.path, a + ".js")
        }, A.prototype.start = function() {
            var a, b, c = this, d;
            this.body ? this.execute() : (a = A.exports[this.id]) ? this.exp(a) : (b = i[this.id]) ? b.then(function(a) {
                c.exp(a)
            }) : (bundle = O(this.id)) ? J(bundle, function() {
                c.start()
            }) : (i[this.id] = this, this.load())
        }, A.prototype.loaded = function() {
            var a, b, d = this;
            c ? (b = A.exports[this.id]) ? this.exp(b) : (a = i[this.id]) && a.then(function(a) {
                d.exp(a)
            }) : (a = j, j = null, a.id = a.id || this.id, a.then(function(a) {
                d.exp(a)
            }))
        }, A.prototype.complete = function() {
            delete i[this.id], z.prototype.complete.apply(this, arguments)
        }, A.prototype.execute = function() {
            var a = this;
            typeof this.body == "object" ? this.exp(this.body) : typeof this.body == "function" && this.body.apply(window, [function(b) {
                    a.exp(b)
                }])
        }, A.prototype.exp = function(a) {
            this.complete(this.exports = A.exports[this.id] = a || {})
        }, B.prototype = new y, B.prototype.start = function() {
            function b() {
                var b = [];
                a.collectResults && (b[0] = {});
                for (var c = 0, d; d = a.deps[c]; c++) {
                    if (!d.completed)
                        return;
                    d.results.length > 0 && (a.collectResults ? d instanceof C ? s(b[0], d.results[0]) : x(b[0], d.id, d.results[0]) : b = b.concat(d.results))
                }
                a.complete.apply(a, b)
            }
            var a = this;
            for (var c = 0, d; d = this.deps[c]; c++)
                d.then(b);
            return this
        }, C.prototype = new y, C.prototype.start = function() {
            var a = this, b = 0, c = [];
            return a.collectResults && (c[0] = {}), function d() {
                var e = a.deps[b++];
                e ? e.then(function(b) {
                    e.results.length > 0 && (a.collectResults ? e instanceof C ? s(c[0], e.results[0]) : x(c[0], e.id, e.results[0]) : c.push(e.results[0])), d()
                }) : a.complete.apply(a, c)
            }(), this
        }, I.amd = {};
        var M = function(a) {
            return a(J, F, M, define)
        };
        M.Script = z, M.Module = A, M.Collection = B, M.Sequence = C, M.Dependency = y, M.noConflict = N, a.loadrunner = M, a.using = J, a.provide = F, a.define = I, J.path = "", J.matchers = [], J.matchers.add = function(a, b) {
            this.unshift([a, b])
        }, J.matchers.add(/(^script!|\.js$)/, function(a) {
            var b = new z(a.replace(/^\$/, J.path.replace(/\/$/, "") + "/").replace(/^script!/, ""), !1);
            return b.id = a, b
        }), J.matchers.add(/^[a-zA-Z0-9_\-\/]+$/, function(a) {
            return new A(a)
        }), J.bundles = [], f && (J.path = f.getAttribute("data-path") || f.src.split(/loadrunner\.js/)[0] || "", (main = f.getAttribute("data-main")) && J.apply(a, main.split(/\s*,\s*/)).then(function() {
        }))
    })(this, document);
    (window.__twttrlr = loadrunner.noConflict());
}
__twttrlr(function(using, provide, loadrunner, define) {
    provide("util/util", function(a) {
        function b(a) {
            var b = 1, c, d;
            for (; c = arguments[b]; b++)
                for (d in c)
                    if (!c.hasOwnProperty || c.hasOwnProperty(d))
                        a[d] = c[d];
            return a
        }
        function c(a) {
            for (var b in a)
                a.hasOwnProperty(b) && (k(a[b]) && (c(a[b]), l(a[b]) && delete a[b]), (a[b] === undefined || a[b] === null || a[b] === "") && delete a[b]);
            return a
        }
        function d(a, b) {
            var c = 0, d;
            for (; d = a[c]; c++)
                if (b == d)
                    return c;
            return-1
        }
        function e(a, b) {
            if (!a)
                return null;
            if (a.filter)
                return a.filter.apply(a, [b]);
            if (!b)
                return a;
            var c = [], d = 0, e;
            for (; e = a[d]; d++)
                b(e) && c.push(e);
            return c
        }
        function f(a, b) {
            if (!a)
                return null;
            if (a.map)
                return a.map.apply(a, [b]);
            if (!b)
                return a;
            var c = [], d = 0, e;
            for (; e = a[d]; d++)
                c.push(b(e));
            return c
        }
        function g(a) {
            return a && a.replace(/(^\s+|\s+$)/g, "")
        }
        function h(a) {
            return{}.toString.call(a).match(/\s([a-zA-Z]+)/)[1].toLowerCase()
        }
        function i(a) {
            return a && String(a).toLowerCase().indexOf("[native code]") > -1
        }
        function j(a, b) {
            if (a.contains)
                return a.contains(b);
            var c = b.parentNode;
            while (c) {
                if (c === a)
                    return!0;
                c = c.parentNode
            }
            return!1
        }
        function k(a) {
            return a === Object(a)
        }
        function l(a) {
            if (!k(a))
                return!1;
            if (Object.keys)
                return!Object.keys(a).length;
            for (var b in a)
                if (a.hasOwnProperty(b))
                    return!1;
            return!0
        }
        a({aug: b, compact: c, containsElement: j, filter: e, map: f, trim: g, indexOf: d, isNative: i, isObject: k, isEmptyObject: l, toType: h})
    });
    provide("util/events", function(a) {
        using("util/util", function(b) {
            function d() {
                this.completed = !1, this.callbacks = []
            }
            var c = {bind: function(a, b) {
                    return this._handlers = this._handlers || {}, this._handlers[a] = this._handlers[a] || [], this._handlers[a].push(b)
                }, unbind: function(a, c) {
                    if (!this._handlers[a])
                        return;
                    if (c) {
                        var d = b.indexOf(this._handlers[a], c);
                        d >= 0 && this._handlers[a].splice(d, 1)
                    } else
                        this._handlers[a] = []
                }, trigger: function(a, b) {
                    var c = this._handlers && this._handlers[a];
                    b.type = a;
                    if (c)
                        for (var d = 0, e; e = c[d]; d++)
                            e.call(this, b)
                }};
            d.prototype.addCallback = function(a) {
                this.completed ? a.apply(this, this.results) : this.callbacks.push(a)
            }, d.prototype.complete = function() {
                this.results = makeArray(arguments), this.completed = !0;
                for (var a = 0, b; b = this.callbacks[a]; a++)
                    b.apply(this, this.results)
            }, a({Emitter: c, Promise: d})
        })
    });
    provide("tfw/util/globals", function(a) {
        function c() {
            var a = document.getElementsByTagName("meta"), c, d, e = 0;
            for (; c = a[e]; e++) {
                if (!/^twitter:/.test(c.name))
                    continue;
                d = c.name.replace(/^twitter:/, ""), b[d] = c.content
            }
        }
        function d(a) {
            return b[a]
        }
        var b = {};
        a({init: c, val: d})
    });
    provide("util/querystring", function(a) {
        function b(a) {
            return encodeURIComponent(a).replace(/\+/g, "%2B")
        }
        function c(a) {
            return decodeURIComponent(a)
        }
        function d(a) {
            var c = [], d;
            for (d in a)
                a[d] !== null && typeof a[d] != "undefined" && c.push(b(d) + "=" + b(a[d]));
            return c.sort().join("&")
        }
        function e(a) {
            var b = {}, d, e, f, g;
            if (a) {
                d = a.split("&");
                for (g = 0; f = d[g]; g++)
                    e = f.split("="), e.length == 2 && (b[c(e[0])] = c(e[1]))
            }
            return b
        }
        function f(a, b) {
            var c = d(b);
            return c.length > 0 ? a.indexOf("?") >= 0 ? a + "&" + d(b) : a + "?" + d(b) : a
        }
        function g(a) {
            var b = a && a.split("?");
            return b.length == 2 ? e(b[1]) : {}
        }
        a({url: f, decodeURL: g, decode: e, encode: d, encodePart: b, decodePart: c})
    });
    provide("util/twitter", function(a) {
        using("util/querystring", function(b) {
            function g(a) {
                return typeof a == "string" && c.test(a) && RegExp.$1.length <= 20
            }
            function h(a) {
                if (g(a))
                    return RegExp.$1
            }
            function i(a) {
                var c = b.decodeURL(a);
                c.screen_name = h(a);
                if (c.screen_name)
                    return b.url("https://twitter.com/intent/user", c)
            }
            function j(a) {
                return typeof a == "string" && f.test(a)
            }
            function k(a, b) {
                b = b === undefined ? !0 : b;
                if (j(a))
                    return(b ? "#" : "") + RegExp.$1
            }
            function l(a) {
                return typeof a == "string" && d.test(a)
            }
            function m(a) {
                return l(a) && RegExp.$1
            }
            function n(a) {
                return e.test(a)
            }
            var c = /(?:^|(?:https?\:)?\/\/(?:www\.)?twitter\.com(?:\:\d+)?(?:\/intent\/(?:follow|user)\/?\?screen_name=|(?:\/#!)?\/))@?([\w]+)(?:\?|&|$)/i, d = /(?:^|(?:https?\:)?\/\/(?:www\.)?twitter\.com(?:\:\d+)?\/(?:#!\/)?[\w_]+\/status(?:es)?\/)(\d+)/i, e = /^http(s?):\/\/((www\.)?)twitter\.com\//, f = /^#?([^.,<>!\s\/#\-\(\)\'\"]+)$/;
            a({isHashTag: j, hashTag: k, isScreenName: g, screenName: h, isStatus: l, status: m, intentForProfileURL: i, isTwitterURL: n, regexen: {profile: c}})
        })
    });
    provide("util/uri", function(a) {
        using("util/querystring", "util/util", "util/twitter", function(b, c, d) {
            function e(a, b) {
                var c, d;
                return b = b || location, /^https?:\/\//.test(a) ? a : /^\/\//.test(a) ? b.protocol + a : (c = b.host + (b.port.length ? ":" + b.port : ""), a.indexOf("/") !== 0 && (d = b.pathname.split("/"), d.pop(), d.push(a), a = "/" + d.join("/")), [b.protocol, "//", c, a].join(""))
            }
            function f() {
                var a = document.getElementsByTagName("link"), b = 0, c;
                for (; c = a[b]; b++)
                    if (c.rel == "canonical")
                        return e(c.href)
            }
            function g() {
                var a = document.getElementsByTagName("a"), b = document.getElementsByTagName("link"), c = [a, b], e, f, g = 0, h = 0, i = /\bme\b/, j;
                for (; e = c[g]; g++)
                    for (h = 0; f = e[h]; h++)
                        if (i.test(f.rel) && (j = d.screenName(f.href)))
                            return j
            }
            a({absolutize: e, getCanonicalURL: f, getScreenNameFromPage: g})
        })
    });
    provide("util/typevalidator", function(a) {
        using("util/util", function(b) {
            function c(a) {
                return a !== undefined && a !== null && a !== ""
            }
            function d(a) {
                return f(a) && a % 1 === 0
            }
            function e(a) {
                return f(a) && !d(a)
            }
            function f(a) {
                return c(a) && !isNaN(a)
            }
            function g(a) {
                return c(a) && b.toType(a) == "array"
            }
            function h(a) {
                if (!c(a))
                    return;
                switch (a) {
                    case"true":
                    case"TRUE":
                        return!0;
                    case"false":
                    case"FALSE":
                        return!1;
                    default:
                        return!!a
                }
            }
            function i(a) {
                if (f(a))
                    return a
            }
            function j(a) {
                if (e(a))
                    return a
            }
            function k(a) {
                if (d(a))
                    return a
            }
            a({hasValue: c, isInt: d, isFloat: e, isNumber: f, isArray: g, asInt: k, asFloat: j, asNumber: i, asBoolean: h})
        })
    });
    provide("util/iframe", function(a) {
        a(function(a) {
            var b = (a.replace && a.replace.ownerDocument || document).createElement("div"), c, d, e;
            b.innerHTML = "<iframe allowtransparency='true' frameBorder='0' scrolling='no'></iframe>", c = b.firstChild, c.src = a.url, c.className = a.className || "";
            if (a.css)
                for (d in a.css)
                    a.css.hasOwnProperty(d) && (c.style[d] = a.css[d]);
            if (a.attributes)
                for (e in a.attributes)
                    a.attributes.hasOwnProperty(e) && c.setAttribute(e, a.attributes[e]);
            return a.replace ? a.replace.parentNode.replaceChild(c, a.replace) : a.insertTarget && a.insertTarget.appendChild(c), c
        })
    });
    provide("dom/get", function(a) {
        using("util/util", function(b) {
            function c(a, c, d, e) {
                var f, g, h = [], i, j, k, l, m, n;
                c = c || document;
                if (b.isNative(c.getElementsByClassName))
                    return h = b.filter(c.getElementsByClassName(a), function(a) {
                        return!d || a.tagName.toLowerCase() == d.toLowerCase()
                    }), [].slice.call(h, 0, e || h.length);
                i = a.split(" "), l = i.length, f = c.getElementsByTagName(d || "*"), n = f.length;
                for (k = 0; k < l && n > 0; k++) {
                    h = [], j = i[k];
                    for (m = 0; m < n; m++) {
                        g = f[m], ~b.indexOf(g.className.split(" "), j) && h.push(g);
                        if (k + 1 == l && h.length === e)
                            break
                    }
                    f = h, n = f.length
                }
                return h
            }
            function d(a, b, d) {
                return c(a, b, d, 1)[0]
            }
            function e(a, c, d) {
                var f = c && c.parentNode, g;
                if (!f || f === d)
                    return;
                return f.tagName == a ? f : (g = f.className.split(" "), 0 === a.indexOf(".") && ~b.indexOf(g, a.slice(1)) ? f : e(a, f, d))
            }
            a({all: c, one: d, ancestor: e})
        })
    });
    provide("util/domready", function(a) {
        function k() {
            b = 1;
            for (var a = 0, d = c.length; a < d; a++)
                c[a]()
        }
        var b = 0, c = [], d, e, f = !1, g = document.createElement("a"), h = "DOMContentLoaded", i = "addEventListener", j = "onreadystatechange";
        /^loade|c/.test(document.readyState) && (b = 1), document[i] && document[i](h, e = function() {
            document.removeEventListener(h, e, f), k()
        }, f), g.doScroll && document.attachEvent(j, d = function() {
            /^c/.test(document.readyState) && (document.detachEvent(j, d), k())
        });
        var l = g.doScroll ? function(a) {
            self != top ? b ? a() : c.push(a) : !function() {
                try {
                    g.doScroll("left")
                } catch (b) {
                    return setTimeout(function() {
                        l(a)
                    }, 50)
                }
                a()
            }()
        } : function(a) {
            b ? a() : c.push(a)
        };
        a(l)
    });
    provide("tfw/widget/base", function(a) {
        using("util/util", "util/domready", "dom/get", "util/querystring", "util/iframe", "util/typevalidator", function(b, c, d, e, f, g) {
            function m(a) {
                var b;
                if (!a)
                    return;
                a.ownerDocument ? (this.srcEl = a, this.classAttr = a.className.split(" ")) : (this.srcOb = a, this.classAttr = []), b = this.params(), this.id = o(), this.setLanguage(), this.related = b.related || this.dataAttr("related"), this.partner = b.partner || this.dataAttr("partner"), this.dnt = b.dnt || this.dataAttr("dnt") || "", this.styleAttr = [], this.targetEl = a.targetEl
            }
            function n() {
                var a = 0, b;
                for (; b = k[a]; a++)
                    b.call()
            }
            function o() {
                return this.srcEl && this.srcEl.id || "twitter-widget-" + h++
            }
            function p(a) {
                if (!a)
                    return;
                return a.lang ? a.lang : p(a.parentNode)
            }
            var h = 0, i, j = {list: [], byId: {}}, k = [], l = {ar: {"%{followers_count} followers": "عدد المتابعين %{followers_count}", "100K+": "+100 ألف", "10k unit": "10 آلاف وحدة", Follow: "تابِع", "Follow %{screen_name}": "تابِع %{screen_name}", K: "ألف", M: "مليون", Tweet: "غرِّد", "Tweet %{hashtag}": "غرِّد %{hashtag}", "Tweet to %{name}": "غرِّد لـ %{name}", "Twitter Stream": "خطّ تويتر الزمنيّ"}, da: {"%{followers_count} followers": "%{followers_count} følgere", "10k unit": "10k enhed", Follow: "Følg", "Follow %{screen_name}": "Følg %{screen_name}", "Tweet to %{name}": "Tweet til %{name}", "Twitter Stream": "Twitter-strøm"}, de: {"%{followers_count} followers": "%{followers_count} Follower", "100K+": "100Tsd+", "10k unit": "10tsd-Einheit", Follow: "Folgen", "Follow %{screen_name}": "%{screen_name} folgen", K: "Tsd", Tweet: "Twittern", "Tweet to %{name}": "Tweet an %{name}"}, es: {"%{followers_count} followers": "%{followers_count} seguidores", "10k unit": "10k unidad", Follow: "Seguir", "Follow %{screen_name}": "Seguir a %{screen_name}", Tweet: "Twittear", "Tweet %{hashtag}": "Twittear %{hashtag}", "Tweet to %{name}": "Twittear a %{name}", "Twitter Stream": "Cronología de Twitter"}, fa: {"%{followers_count} followers": "%{followers_count} دنبال‌کننده", "100K+": ">۱۰۰هزار", "10k unit": "۱۰هزار واحد", Follow: "دنبال کردن", "Follow %{screen_name}": "دنبال کردن %{screen_name}", K: "هزار", M: "میلیون", Tweet: "توییت", "Tweet %{hashtag}": "توییت کردن %{hashtag}", "Tweet to %{name}": "به %{name} توییت کنید", "Twitter Stream": "جریان توییت‌ها"}, fi: {"%{followers_count} followers": "%{followers_count} seuraajaa", "100K+": "100 000+", "10k unit": "10 000 yksikköä", Follow: "Seuraa", "Follow %{screen_name}": "Seuraa käyttäjää %{screen_name}", K: "tuhatta", M: "milj.", Tweet: "Twiittaa", "Tweet %{hashtag}": "Twiittaa %{hashtag}", "Tweet to %{name}": "Twiittaa käyttäjälle %{name}", "Twitter Stream": "Twitter-virta"}, fil: {"%{followers_count} followers": "%{followers_count} mga tagasunod", "10k unit": "10k yunit", Follow: "Sundan", "Follow %{screen_name}": "Sundan si %{screen_name}", Tweet: "I-tweet", "Tweet %{hashtag}": "I-tweet ang %{hashtag}", "Tweet to %{name}": "Mag-Tweet kay %{name}", "Twitter Stream": "Stream ng Twitter"}, fr: {"%{followers_count} followers": "%{followers_count} abonnés", "10k unit": "unité de 10k", Follow: "Suivre", "Follow %{screen_name}": "Suivre %{screen_name}", Tweet: "Tweeter", "Tweet %{hashtag}": "Tweeter %{hashtag}", "Tweet to %{name}": "Tweeter à %{name}", "Twitter Stream": "Flux Twitter"}, he: {"%{followers_count} followers": "%{followers_count} עוקבים", "100K+": "מאות אלפים", "10k unit": "עשרות אלפים", Follow: "מעקב", "Follow %{screen_name}": "לעקוב אחר %{screen_name}", K: "אלף", M: "מיליון", Tweet: "ציוץ", "Tweet %{hashtag}": "צייצו %{hashtag}", "Tweet to %{name}": "ציוץ אל %{name}", "Twitter Stream": "התזרים של טוויטר"}, hi: {"%{followers_count} followers": "%{followers_count} फ़ॉलोअर्स", "100K+": "1 लाख+", "10k unit": "10 हजार इकाईयां", Follow: "फ़ॉलो", "Follow %{screen_name}": "%{screen_name} को फ़ॉलो करें", K: "हजार", M: "मिलियन", Tweet: "ट्वीट", "Tweet %{hashtag}": "ट्वीट %{hashtag}", "Tweet to %{name}": "%{name} को ट्वीट करें", "Twitter Stream": "ट्विटर स्ट्रीम"}, hu: {"%{followers_count} followers": "%{followers_count} követő", "100K+": "100E+", "10k unit": "10E+", Follow: "Követés", "Follow %{screen_name}": "%{screen_name} követése", K: "E", "Tweet %{hashtag}": "%{hashtag} tweetelése", "Tweet to %{name}": "Tweet küldése neki: %{name}", "Twitter Stream": "Twitter Hírfolyam"}, id: {"%{followers_count} followers": "%{followers_count} pengikut", "100K+": "100 ribu+", "10k unit": "10 ribu unit", Follow: "Ikuti", "Follow %{screen_name}": "Ikuti %{screen_name}", K: "&nbsp;ribu", M: "&nbsp;juta", "Tweet to %{name}": "Tweet ke %{name}", "Twitter Stream": "Aliran Twitter"}, it: {"%{followers_count} followers": "%{followers_count} follower", "10k unit": "10k unità", Follow: "Segui", "Follow %{screen_name}": "Segui %{screen_name}", "Tweet %{hashtag}": "Twitta %{hashtag}", "Tweet to %{name}": "Twitta a %{name}"}, ja: {"%{followers_count} followers": "%{followers_count}人のフォロワー", "100K+": "100K以上", "10k unit": "万", Follow: "フォローする", "Follow %{screen_name}": "%{screen_name}さんをフォロー", Tweet: "ツイート", "Tweet %{hashtag}": "%{hashtag} をツイートする", "Tweet to %{name}": "%{name}さんへツイートする", "Twitter Stream": "Twitterストリーム"}, ko: {"%{followers_count} followers": "%{followers_count}명의 팔로워", "100K+": "100만 이상", "10k unit": "만 단위", Follow: "팔로우", "Follow %{screen_name}": "%{screen_name} 팔로우하기", K: "천", M: "백만", Tweet: "트윗", "Tweet %{hashtag}": "%{hashtag} 관련 트윗하기", "Tweet to %{name}": "%{name}님에게 트윗하기", "Twitter Stream": "트위터 스트림"}, msa: {"%{followers_count} followers": "%{followers_count} pengikut", "100K+": "100 ribu+", "10k unit": "10 ribu unit", Follow: "Ikut", "Follow %{screen_name}": "Ikut %{screen_name}", K: "ribu", M: "juta", "Tweet to %{name}": "Tweet kepada %{name}", "Twitter Stream": "Strim Twitter"}, nl: {"%{followers_count} followers": "%{followers_count} volgers", "100K+": "100k+", "10k unit": "10k-eenheid", Follow: "Volgen", "Follow %{screen_name}": "%{screen_name} volgen", K: "k", M: " mln.", Tweet: "Tweeten", "Tweet %{hashtag}": "%{hashtag} tweeten", "Tweet to %{name}": "Tweeten naar %{name}"}, no: {"%{followers_count} followers": "%{followers_count} følgere", "100K+": "100 K+", "10k unit": "10 K-enhet", Follow: "Følg", "Follow %{screen_name}": "Følg %{screen_name}", "Tweet to %{name}": "Send tweet til %{name}", "Twitter Stream": "Twitter-strøm"}, pl: {"%{followers_count} followers": "%{followers_count} obserwujących", "100K+": "100 tys.+", "10k unit": "10 tys.", Follow: "Obserwuj", "Follow %{screen_name}": "Obserwuj %{screen_name}", K: "tys.", M: "mln", Tweet: "Tweetnij", "Tweet %{hashtag}": "Tweetnij %{hashtag}", "Tweet to %{name}": "Tweetnij do %{name}", "Twitter Stream": "Strumień Twittera"}, pt: {"%{followers_count} followers": "%{followers_count} seguidores", "100K+": "+100 mil", "10k unit": "10 mil unidades", Follow: "Seguir", "Follow %{screen_name}": "Seguir %{screen_name}", K: "Mil", Tweet: "Tweetar", "Tweet %{hashtag}": "Tweetar %{hashtag}", "Tweet to %{name}": "Tweetar para %{name}", "Twitter Stream": "Transmissões do Twitter"}, ru: {"%{followers_count} followers": "Читатели: %{followers_count} ", "100K+": "100 тыс.+", "10k unit": "блок 10k", Follow: "Читать", "Follow %{screen_name}": "Читать %{screen_name}", K: "тыс.", M: "млн.", Tweet: "Твитнуть", "Tweet %{hashtag}": "Твитнуть %{hashtag}", "Tweet to %{name}": "Твитнуть %{name}", "Twitter Stream": "Поток в Твиттере"}, sv: {"%{followers_count} followers": "%{followers_count} följare", "10k unit": "10k", Follow: "Följ", "Follow %{screen_name}": "Följ %{screen_name}", Tweet: "Tweeta", "Tweet %{hashtag}": "Tweeta %{hashtag}", "Tweet to %{name}": "Tweeta till %{name}", "Twitter Stream": "Twitterflöde"}, th: {"%{followers_count} followers": "%{followers_count} ผู้ติดตาม", "100K+": "100พัน+", "10k unit": "หน่วย 10พัน", Follow: "ติดตาม", "Follow %{screen_name}": "ติดตาม %{screen_name}", K: "พัน", M: "ล้าน", Tweet: "ทวีต", "Tweet %{hashtag}": "ทวีต %{hashtag}", "Tweet to %{name}": "ทวีตถึง %{name}", "Twitter Stream": "ทวิตเตอร์สตรีม"}, tr: {"%{followers_count} followers": "%{followers_count} takipçi", "100K+": "+100 bin", "10k unit": "10 bin birim", Follow: "Takip et", "Follow %{screen_name}": "Takip et: %{screen_name}", K: "bin", M: "milyon", Tweet: "Tweetle", "Tweet %{hashtag}": "Tweetle: %{hashtag}", "Tweet to %{name}": "Tweetle: %{name}", "Twitter Stream": "Twitter Akışı"}, ur: {"%{followers_count} followers": "%{followers_count} فالورز", "100K+": "ایک لاکھ سے زیادہ", "10k unit": "دس ہزار یونٹ", Follow: "فالو کریں", "Follow %{screen_name}": "%{screen_name} کو فالو کریں", K: "ہزار", M: "ملین", Tweet: "ٹویٹ کریں", "Tweet %{hashtag}": "%{hashtag} ٹویٹ کریں", "Tweet to %{name}": "%{name} کو ٹویٹ کریں", "Twitter Stream": "ٹوئٹر سٹریم"}, "zh-cn": {"%{followers_count} followers": "%{followers_count} 关注者", "100K+": "10万+", "10k unit": "1万单元", Follow: "关注", "Follow %{screen_name}": "关注 %{screen_name}", K: "千", M: "百万", Tweet: "发推", "Tweet %{hashtag}": "以 %{hashtag} 发推", "Tweet to %{name}": "发推给 %{name}", "Twitter Stream": "Twitter 信息流"}, "zh-tw": {"%{followers_count} followers": "%{followers_count} 位跟隨者", "100K+": "超過十萬", "10k unit": "1萬 單位", Follow: "跟隨", "Follow %{screen_name}": "跟隨 %{screen_name}", K: "千", M: "百萬", Tweet: "推文", "Tweet %{hashtag}": "推文%{hashtag}", "Tweet to %{name}": "推文給%{name}", "Twitter Stream": "Twitter 資訊流"}};
            b.aug(m.prototype, {setLanguage: function(a) {
                    var b;
                    a || (a = this.params().lang || this.dataAttr("lang") || p(this.srcEl)), a = a && a.toLowerCase();
                    if (!a)
                        return this.lang = "en";
                    if (l[a])
                        return this.lang = a;
                    b = a.replace(/[\-_].*/, "");
                    if (l[b])
                        return this.lang = b;
                    this.lang = "en"
                }, _: function(a, b) {
                    var c = this.lang;
                    b = b || {};
                    if (!c || !l.hasOwnProperty(c))
                        c = this.lang = "en";
                    return a = l[c] && l[c][a] || a, this.ringo(a, b, /%\{([\w_]+)\}/g)
                }, ringo: function(a, b, c) {
                    return c = c || /\{\{([\w_]+)\}\}/g, a.replace(c, function(a, c) {
                        return b[c] !== undefined ? b[c] : a
                    })
                }, add: function(a) {
                    j.list.push(this), j.byId[this.id] = a
                }, create: function(a, b, c) {
                    return c["data-twttr-rendered"] = !0, f({url: a, css: b, className: this.classAttr.join(" "), id: this.id, attributes: c, replace: this.srcEl, insertTarget: this.targetEl})
                }, params: function() {
                    var a, b;
                    return this.srcOb ? b = this.srcOb : (a = this.srcEl && this.srcEl.href && this.srcEl.href.split("?")[1], b = a ? e.decode(a) : {}), this.params = function() {
                        return b
                    }, b
                }, dataAttr: function(a) {
                    return this.srcEl && this.srcEl.getAttribute("data-" + a)
                }, attr: function(a) {
                    return this.srcEl && this.srcEl.getAttribute(a)
                }, styles: {base: [["font", "normal normal normal 11px/18px 'Helvetica Neue', Arial, sans-serif"], ["margin", "0"], ["padding", "0"], ["whiteSpace", "nowrap"]], button: [["fontWeight", "bold"], ["textShadow", "0 1px 0 rgba(255,255,255,.5)"]], large: [["fontSize", "13px"], ["lineHeight", "26px"]], vbubble: [["fontSize", "16px"]]}, width: function() {
                    throw new Error(name + " not implemented")
                }, height: function() {
                    return this.size == "m" ? 20 : 28
                }, minWidth: function() {
                }, maxWidth: function() {
                }, minHeight: function() {
                }, maxHeight: function() {
                }, dimensions: function() {
                    function a(a) {
                        switch (typeof a) {
                            case"string":
                                return a;
                            case"undefined":
                                return;
                            default:
                                return a + "px"
                        }
                    }
                    var b, c = {width: this.width(), height: this.height()};
                    this.minWidth() && (c["min-width"] = this.minWidth()), this.maxWidth() && (c["max-width"] = this.maxWidth()), this.minHeight() && (c["min-height"] = this.minHeight()), this.maxHeight() && (c["max-height"] = this.maxHeight());
                    for (b in c)
                        c[b] = a(c[b]);
                    return c
                }, generateId: o}), m.afterLoad = function(a) {
                k.push(a)
            }, m.init = function(a) {
                i = a
            }, m.find = function(a) {
                return a && j.byId[a] ? j.byId[a].element : null
            }, m.embed = function(a) {
                var b = i.widgets, c, e, f = 0, h, k, l, m, o;
                g.isArray(a) || (a = [a || document]);
                for (; e = a[f]; f++)
                    for (k in b)
                        if (b.hasOwnProperty(k)) {
                            k.match(/\./) ? (l = k.split("."), c = d.all(l[1], e, l[0])) : c = e.getElementsByTagName(k);
                            for (m = 0; o = c[m]; m++) {
                                if (o.getAttribute("data-twttr-rendered"))
                                    continue;
                                o.setAttribute("data-twttr-rendered", "true"), h = new b[k](o), j.list.push(h), j.byId[h.id] = h, h.render(i)
                            }
                        }
                n()
            }, a(m)
        })
    });
    provide("tfw/widget/intent", function(a) {
        using("tfw/widget/base", "util/util", "util/querystring", "util/uri", function(b, c, d, e) {
            function m(a) {
                var b = Math.round(k / 2 - h / 2), c = 0;
                j > i && (c = Math.round(j / 2 - i / 2)), window.open(a, undefined, [g, "width=" + h, "height=" + i, "left=" + b, "top=" + c].join(","))
            }
            function n(a, b) {
                using("tfw/hub/client", function(c) {
                    c.openIntent(a, b)
                })
            }
            function o(a) {
                var b = "original_referer=" + location.href;
                return[a, b].join(a.indexOf("?") == -1 ? "?" : "&")
            }
            function p(a) {
                var b, d, e, g;
                a = a || window.event, b = a.target || a.srcElement;
                if (a.altKey || a.metaKey || a.shiftKey)
                    return;
                while (b) {
                    if (~c.indexOf(["A", "AREA"], b.nodeName))
                        break;
                    b = b.parentNode
                }
                b && b.href && (d = b.href.match(f), d && (g = o(b.href), g = g.replace(/^http[:]/, "https:"), g = g.replace(/^\/\//, "https://"), q(g, b), a.returnValue = !1, a.preventDefault && a.preventDefault()))
            }
            function q(a, b) {
                if (twttr.events.hub && b) {
                    var c = new r(l.generateId(), b);
                    l.add(c), n(a, b), twttr.events.trigger("click", {target: b, region: "intent", type: "click", data: {}})
                } else
                    m(a)
            }
            function r(a, b) {
                this.id = a, this.element = this.srcEl = b
            }
            function s(a) {
                this.srcEl = [], this.element = a
            }
            var f = /twitter\.com(\:\d{2,4})?\/intent\/(\w+)/, g = "scrollbars=yes,resizable=yes,toolbar=no,location=yes", h = 550, i = 520, j = screen.height, k = screen.width, l;
            s.prototype = new b, c.aug(s.prototype, {render: function(a) {
                    l = this, window.__twitterIntentHandler || (document.addEventListener ? document.addEventListener("click", p, !1) : document.attachEvent && document.attachEvent("onclick", p), window.__twitterIntentHandler = !0)
                }}), s.open = q, a(s)
        })
    });
    provide("dom/classname", function(a) {
        function b(a, b) {
            a.classList ? a.classList.add(b) : f(b).test(a.className) || (a.className += " " + b)
        }
        function c(a, b) {
            a.classList ? a.classList.remove(b) : a.className = a.className.replace(f(b), " ")
        }
        function d(a, d, g) {
            a.classList && e(a, d) ? (c(a, d), b(a, g)) : a.className = a.className.replace(f(d), g)
        }
        function e(a, b) {
            return a.classList ? a.classList.contains(b) : f(b).test(a.className)
        }
        function f(a) {
            return new RegExp("\\b" + a + "\\b", "g")
        }
        a({add: b, remove: c, replace: d, present: e})
    });
    provide("util/env", function(a) {
        var b = window.navigator.userAgent;
        a({retina: function() {
                return(window.devicePixelRatio || 1) > 1
            }, anyIE: function() {
                return/MSIE \d/.test(b)
            }, ie6: function() {
                return/MSIE 6/.test(b)
            }, ie7: function() {
                return/MSIE 7/.test(b)
            }, cspEnabledIE: function() {
                return/MSIE 1\d/.test(b)
            }, touch: function() {
                return"ontouchstart"in window || /Opera Mini/.test(b) || navigator.msMaxTouchPoints > 0
            }, cssTransitions: function() {
                var a = document.body.style;
                return a.transition !== undefined || a.webkitTransition !== undefined || a.mozTransition !== undefined || a.oTransition !== undefined || a.msTransition !== undefined
            }})
    });
    provide("dom/delegate", function(a) {
        using("util/env", function(b) {
            function e(a) {
                var b = a.getAttribute("data-twitter-event-id");
                return b ? b : (a.setAttribute("data-twitter-event-id", ++d), d)
            }
            function f(a, b, c) {
                var d = 0, e = a && a.length || 0;
                for (d = 0; d < e; d++)
                    a[d].call(b, c)
            }
            function g(a, b, c) {
                var d = c || a.target || a.srcElement, e = d.className.split(" "), h = 0, i, j = e.length;
                for (; h < j; h++)
                    f(b["." + e[h]], d, a);
                f(b[d.tagName], d, a);
                if (a.cease)
                    return;
                d !== this && g.call(this, a, b, d.parentElement || d.parentNode)
            }
            function h(a, b, c) {
                if (a.addEventListener) {
                    a.addEventListener(b, function(d) {
                        g.call(a, d, c[b])
                    }, !1);
                    return
                }
                a.attachEvent && a.attachEvent("on" + b, function() {
                    g.call(a, a.ownerDocument.parentWindow.event, c[b])
                })
            }
            function i(a, b, d, f) {
                var g = e(a);
                c[g] = c[g] || {}, c[g][b] || (c[g][b] = {}, h(a, b, c[g])), c[g][b][d] = c[g][b][d] || [], c[g][b][d].push(f)
            }
            function j(a, b, d) {
                var f = e(b), h = c[f] && c[f];
                g.call(b, {target: d}, h[a])
            }
            function k(a) {
                return m(a), l(a), !1
            }
            function l(a) {
                a && a.preventDefault ? a.preventDefault() : a.returnValue = !1
            }
            function m(a) {
                a && (a.cease = !0) && a.stopPropagation ? a.stopPropagation() : a.cancelBubble = !0
            }
            var c = {}, d = -1;
            a({stop: k, stopPropagation: m, preventDefault: l, delegate: i, simulate: j})
        })
    });
    provide("util/throttle", function(a) {
        function b(a, b, c) {
            function g() {
                var c = +(new Date);
                window.clearTimeout(f);
                if (c - e > b) {
                    e = c, a.call(d);
                    return
                }
                f = window.setTimeout(g, b)
            }
            var d = c || this, e = 0, f;
            return g
        }
        a(b)
    });
    provide("util/insert", function(a) {
        a(function(a, b) {
            if (b) {
                if (!b.parentNode)
                    return b;
                b.parentNode.replaceChild(a, b), delete b
            } else
                document.body.insertBefore(a, document.body.firstChild);
            return a
        })
    });
    provide("util/css", function(a) {
        using("util/util", function(b) {
            a({sanitize: function(a, c, d) {
                    var e = /^[\w ,%\/"'\-_#]+$/, f = a && b.map(a.split(";"), function(a) {
                        return b.map(a.split(":").slice(0, 2), function(a) {
                            return b.trim(a)
                        })
                    }), g = 0, h, i = [], j = d ? "!important" : "";
                    c = c || /^(font|text\-|letter\-|color|line\-)[\w\-]*$/;
                    for (; f && (h = f[g]); g++)
                        h[0].match(c) && h[1].match(e) && i.push(h.join(":") + j);
                    return i.join(";")
                }})
        })
    });
    provide("tfw/util/params", function(a) {
        using("util/querystring", "util/twitter", function(b, c) {
            a(function(a, d) {
                return function(e) {
                    var f, g = "data-tw-params", h, i = e.innerHTML;
                    if (!e)
                        return;
                    if (!c.isTwitterURL(e.href))
                        return;
                    if (e.getAttribute(g))
                        return;
                    e.setAttribute(g, !0);
                    if (typeof d == "function") {
                        f = d.call(this, e);
                        for (h in f)
                            f.hasOwnProperty(h) && (a[h] = f[h])
                    }
                    e.href = b.url(e.href, a), e.innerHTML = i
                }
            })
        })
    });
    provide("$xd/json2.js", function(exports) {
        window.JSON || (window.JSON = {}), function() {
            function f(a) {
                return a < 10 ? "0" + a : a
            }
            function quote(a) {
                return escapable.lastIndex = 0, escapable.test(a) ? '"' + a.replace(escapable, function(a) {
                    var b = meta[a];
                    return typeof b == "string" ? b : "\\u" + ("0000" + a.charCodeAt(0).toString(16)).slice(-4)
                }) + '"' : '"' + a + '"'
            }
            function str(a, b) {
                var c, d, e, f, g = gap, h, i = b[a];
                i && typeof i == "object" && typeof i.toJSON == "function" && (i = i.toJSON(a)), typeof rep == "function" && (i = rep.call(b, a, i));
                switch (typeof i) {
                    case"string":
                        return quote(i);
                    case"number":
                        return isFinite(i) ? String(i) : "null";
                    case"boolean":
                    case"null":
                        return String(i);
                    case"object":
                        if (!i)
                            return"null";
                        gap += indent, h = [];
                        if (Object.prototype.toString.apply(i) === "[object Array]") {
                            f = i.length;
                            for (c = 0; c < f; c += 1)
                                h[c] = str(c, i) || "null";
                            return e = h.length === 0 ? "[]" : gap ? "[\n" + gap + h.join(",\n" + gap) + "\n" + g + "]" : "[" + h.join(",") + "]", gap = g, e
                        }
                        if (rep && typeof rep == "object") {
                            f = rep.length;
                            for (c = 0; c < f; c += 1)
                                d = rep[c], typeof d == "string" && (e = str(d, i), e && h.push(quote(d) + (gap ? ": " : ":") + e))
                        } else
                            for (d in i)
                                Object.hasOwnProperty.call(i, d) && (e = str(d, i), e && h.push(quote(d) + (gap ? ": " : ":") + e));
                        return e = h.length === 0 ? "{}" : gap ? "{\n" + gap + h.join(",\n" + gap) + "\n" + g + "}" : "{" + h.join(",") + "}", gap = g, e
                }
            }
            typeof Date.prototype.toJSON != "function" && (Date.prototype.toJSON = function(a) {
                return isFinite(this.valueOf()) ? this.getUTCFullYear() + "-" + f(this.getUTCMonth() + 1) + "-" + f(this.getUTCDate()) + "T" + f(this.getUTCHours()) + ":" + f(this.getUTCMinutes()) + ":" + f(this.getUTCSeconds()) + "Z" : null
            }, String.prototype.toJSON = Number.prototype.toJSON = Boolean.prototype.toJSON = function(a) {
                return this.valueOf()
            });
            var cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g, escapable = /[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g, gap, indent, meta = {"\b": "\\b", "\t": "\\t", "\n": "\\n", "\f": "\\f", "\r": "\\r", '"': '\\"', "\\": "\\\\"}, rep;
            typeof JSON.stringify != "function" && (JSON.stringify = function(a, b, c) {
                var d;
                gap = "", indent = "";
                if (typeof c == "number")
                    for (d = 0; d < c; d += 1)
                        indent += " ";
                else
                    typeof c == "string" && (indent = c);
                rep = b;
                if (!b || typeof b == "function" || typeof b == "object" && typeof b.length == "number")
                    return str("", {"": a});
                throw new Error("JSON.stringify")
            }), typeof JSON.parse != "function" && (JSON.parse = function(text, reviver) {
                function walk(a, b) {
                    var c, d, e = a[b];
                    if (e && typeof e == "object")
                        for (c in e)
                            Object.hasOwnProperty.call(e, c) && (d = walk(e, c), d !== undefined ? e[c] = d : delete e[c]);
                    return reviver.call(a, b, e)
                }
                var j;
                cx.lastIndex = 0, cx.test(text) && (text = text.replace(cx, function(a) {
                    return"\\u" + ("0000" + a.charCodeAt(0).toString(16)).slice(-4)
                }));
                if (/^[\],:{}\s]*$/.test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, "@").replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, "]").replace(/(?:^|:|,)(?:\s*\[)+/g, "")))
                    return j = eval("(" + text + ")"), typeof reviver == "function" ? walk({"": j}, "") : j;
                throw new SyntaxError("JSON.parse")
            })
        }();
        exports();
        loadrunner.Script.loaded.push("$xd/json2.js")
    });
    provide("util/params", function(a) {
        using("util/querystring", function(b) {
            var c = function(a) {
                var c = a.search.substr(1);
                return b.decode(c)
            }, d = function(a) {
                var c = a.href, d = c.indexOf("#"), e = d < 0 ? "" : c.substring(d + 1);
                return b.decode(e)
            }, e = function(a) {
                var b = {}, e = c(a), f = d(a);
                for (var g in e)
                    e.hasOwnProperty(g) && (b[g] = e[g]);
                for (var g in f)
                    f.hasOwnProperty(g) && (b[g] = f[g]);
                return b
            };
            a({combined: e, fromQuery: c, fromFragment: d})
        })
    });
    provide("tfw/util/env", function(a) {
        using("util/params", function(b) {
            function d() {
                var a = 36e5, d = b.combined(document.location)._;
                return c !== undefined ? c : (c = !1, d && /^\d+$/.test(d) && (c = +(new Date) - parseInt(d) < a), c)
            }
            var c;
            a({isDynamicWidget: d})
        })
    });
    provide("util/decider", function(a) {
        function c(a) {
            var c = b[a] || !1;
            if (!c)
                return!1;
            if (c === !0 || c === 100)
                return!0;
            var d = Math.random() * 100, e = c >= d;
            return b[a] = e, e
        }
        var b = {force_new_cookie: 100, rufous_pixel: 100, decider_fixture: 12.34};
        a({isAvailable: c})
    });
    provide("dom/cookie", function(a) {
        using("util/util", function(b) {
            a(function(a, c, d) {
                var e = b.aug({}, d);
                if (arguments.length > 1 && String(c) !== "[object Object]") {
                    if (c === null || c === undefined)
                        e.expires = -1;
                    if (typeof e.expires == "number") {
                        var f = e.expires, g = new Date((new Date).getTime() + f * 60 * 1e3);
                        e.expires = g
                    }
                    return c = String(c), document.cookie = [encodeURIComponent(a), "=", e.raw ? c : encodeURIComponent(c), e.expires ? "; expires=" + e.expires.toUTCString() : "", e.path ? "; path=" + e.path : "", e.domain ? "; domain=" + e.domain : "", e.secure ? "; secure" : ""].join("")
                }
                e = c || {};
                var h, i = e.raw ? function(a) {
                    return a
                } : decodeURIComponent;
                return(h = (new RegExp("(?:^|; )" + encodeURIComponent(a) + "=([^;]*)")).exec(document.cookie)) ? i(h[1]) : null
            })
        })
    });
    provide("util/donottrack", function(a) {
        using("dom/cookie", function(b) {
            a(function(a) {
                var c = /\.(gov|mil)(:\d+)?$/i, d = /https?:\/\/([^\/]+).*/i;
                return a = a || document.referrer, a = d.test(a) && d.exec(a)[1], b("dnt") ? !0 : c.test(document.location.host) ? !0 : a && c.test(a) ? !0 : document.navigator ? document.navigator["doNotTrack"] == 1 : navigator ? navigator["doNotTrack"] == 1 || navigator["msDoNotTrack"] == 1 : !1
            })
        })
    });
    provide("tfw/util/guest_cookie", function(a) {
        using("dom/cookie", "util/donottrack", "util/decider", function(b, c, d) {
            function f() {
                var a = b(e) || !1;
                if (!a)
                    return;
                a.match(/^v3\:/) || g()
            }
            function g() {
                b(e) && b(e, null, {domain: ".twitter.com", path: "/"})
            }
            function h() {
                c() && g()
            }
            var e = "pid";
            a({set: h, destroy: g, forceNewCookie: f, guest_id_cookie: e})
        })
    });
    provide("dom/sandbox", function(a) {
        using("util/domready", "util/env", function(b, c) {
            function e(a, b) {
                var c, d, e;
                if (a.name) {
                    try {
                        e = document.createElement('<iframe name="' + a.name + '"></iframe>')
                    } catch (f) {
                        e = document.createElement("iframe"), e.name = a.name
                    }
                    delete a.name
                } else
                    e = document.createElement("iframe");
                a.id && (e.id = a.id, delete a.id);
                for (c in a)
                    a.hasOwnProperty(c) && e.setAttribute(c, a[c]);
                e.allowtransparency = "true", e.scrolling = "no", e.setAttribute("frameBorder", 0), e.setAttribute("allowTransparency", !0);
                for (d in b || {})
                    b.hasOwnProperty(d) && (e.style[d] = b[d]);
                return e
            }
            function f(a, b, c, d) {
                var f;
                this.attrs = b || {}, this.styles = c || {}, this.appender = d, this.onReady = a, this.sandbox = {}, f = e(this.attrs, this.styles), f.onreadystatechange = f.onload = this.getCallback(this.onLoad), this.sandbox.frame = f, d ? d(f) : document.body.appendChild(f)
            }
            function g(a, c, d, e) {
                b(function() {
                    new f(a, c, d, e)
                })
            }
            var d = 0;
            window.twttr || (window.twttr = {}), window.twttr.sandbox || (window.twttr.sandbox = {}), f.prototype.getCallback = function(a) {
                var b = this, c = !1;
                return function() {
                    c || (c = !0, a.call(b))
                }
            }, f.prototype.registerCallback = function(a) {
                var b = "cb" + d++;
                return window.twttr.sandbox[b] = a, b
            }, f.prototype.onLoad = function() {
                try {
                    this.sandbox.frame.contentWindow.document
                } catch (a) {
                    this.setDocDomain();
                    return
                }
                this.sandbox.win = this.sandbox.frame.contentWindow, this.sandbox.doc = this.sandbox.frame.contentWindow.document, this.writeStandardsDoc(), this.sandbox.body = this.sandbox.frame.contentWindow.document.body, this.onReady(this.sandbox)
            }, f.prototype.setDocDomain = function() {
                var a, b = this.registerCallback(this.getCallback(this.onLoad));
                a = ["javascript:", 'document.write("");', "try { window.parent.document; }", "catch (e) {", 'document.domain="' + document.domain + '";', "}", 'window.parent.twttr.sandbox["' + b + '"]();'].join(""), this.sandbox.frame.parentNode.removeChild(this.sandbox.frame), this.sandbox.frame = null, this.sandbox.frame = e(this.attrs, this.styles), this.sandbox.frame.src = a, this.appender ? this.appender(this.sandbox.frame) : document.body.appendChild(this.sandbox.frame)
            }, f.prototype.writeStandardsDoc = function() {
                if (!c.anyIE() || c.cspEnabledIE())
                    return;
                var a = ["<!DOCTYPE html>", "<html>", "<head>", "<scr", "ipt>", "try { window.parent.document; }", 'catch (e) {document.domain="' + document.domain + '";}', "</scr", "ipt>", "</head>", "<body></body>", "</html>"].join("");
                this.sandbox.doc.write(a), this.sandbox.doc.close()
            }, a(g)
        })
    });
    provide("tfw/util/tracking", function(a) {
        using("dom/cookie", "dom/sandbox", "util/donottrack", "tfw/util/guest_cookie", "tfw/util/env", "util/util", "$xd/json2.js", function(b, c, d, e, f, g) {
            function t() {
                r = document.getElementById("rufous-sandbox");
                if (r) {
                    q = r.contentWindow.document, p = q.body;
                    return
                }
                c(function(a) {
                    r = a.frame, q = a.doc, p = a.doc.body, l = E(), m = F();
                    while (n[0])
                        y.apply(this, n.shift());
                    o && z()
                }, {id: "rufous-sandbox"}, {display: "none"})
            }
            function u(a, b, c, d) {
                var e = !g.isObject(a), f = b ? !g.isObject(b) : !1, h, i;
                if (e || f)
                    return;
                if (/Firefox/.test(navigator.userAgent))
                    return;
                h = B(a), i = C(b, !!c, !!d), x(h, i, !0)
            }
            function v(a, c, h, j) {
                var k = i[c], l, m, n = e.guest_id_cookie;
                if (!k)
                    return;
                a = a || {}, j = !!j, h = !!h, m = a.original_redirect_referrer || document.referrer, j = j || d(m), l = g.aug({}, a), h || (w(l, "referrer", m), w(l, "widget", +f.isDynamicWidget()), w(l, "hask", +!!b("k")), w(l, "li", +!!b("twid")), w(l, n, b(n) || "")), j && (w(l, "dnt", 1), H(l)), G(k + "?" + D(l))
            }
            function w(a, b, c) {
                var d = h + b;
                if (!a)
                    return;
                return a[d] = c, a
            }
            function x(a, b, c) {
                var d, e, f, h, i = "https://r.twimg.com/jot?";
                if (!g.isObject(a) || !g.isObject(b))
                    return;
                if (Math.random() > s)
                    return;
                f = g.aug({}, b, {event_namespace: a}), c ? (i += D({l: I(f)}), G(i)) : (d = l.firstChild, d.value = +d.value || +f.dnt, h = I(f), e = q.createElement("input"), e.type = "hidden", e.name = "l", e.value = h, l.appendChild(e))
            }
            function y(a, b, c, d) {
                var e = !g.isObject(a), f = b ? !g.isObject(b) : !1, h, i;
                if (e || f)
                    return;
                if (!p || !l) {
                    n.push([a, b, c, d]);
                    return
                }
                h = B(a), i = C(b, !!c, !!d), x(h, i)
            }
            function z() {
                var a = A(l, m);
                if (!l) {
                    o = !0;
                    return
                }
                if (l.children.length <= 1)
                    return;
                p.appendChild(l), p.appendChild(m), m.addEventListener && m.addEventListener("load", function() {
                    window.setTimeout(a, 0)
                }), l.submit(), window.setTimeout(a, 6e4), l = E(), m = F()
            }
            function A(a, b) {
                return function() {
                    var c = a.parentNode;
                    if (!c)
                        return;
                    c.removeChild(a), c.removeChild(b)
                }
            }
            function B(a) {
                return g.aug({client: "tfw"}, a || {})
            }
            function C(a, b, c) {
                var e = {_category_: "tfw_client_event"}, f, h;
                return b = !!b, c = !!c, f = g.aug(e, a || {}), h = f.widget_origin || document.referrer, f.format_version = 1, f.dnt = c = c || d(h), f.triggered_on = f.triggered_on || +(new Date), b || (f.widget_origin = h), c && H(f), f
            }
            function D(a) {
                var b = [], c, d, e;
                for (c in a)
                    a.hasOwnProperty(c) && (d = encodeURIComponent(c), e = encodeURIComponent(a[c]), e = e.replace(/'/g, "%27"), b.push(d + "=" + e));
                return b.join("&")
            }
            function E() {
                var a = q.createElement("form"), b = q.createElement("input");
                return k++, a.action = "https://r.twimg.com/jot", a.method = "POST", a.target = "rufous-frame-" + k, a.id = "rufous-form-" + k, b.type = "hidden", b.name = "dnt", b.value = 0, a.appendChild(b), a
            }
            function F() {
                var a, b = "rufous-frame-" + k;
                try {
                    a = q.createElement("<iframe name=" + b + ">")
                } catch (c) {
                    a = q.createElement("iframe"), a.name = b
                }
                return a.id = b, a.style.display = "none", a.width = 0, a.height = 0, a.border = 0, a
            }
            function G(a) {
                var b = document.createElement("img");
                b.src = a, b.alt = "", b.style.position = "absolute", b.style.height = "1px", b.style.width = "1px", b.style.top = "-9999px", b.style.left = "-9999px", document.body.appendChild(b)
            }
            function H(a) {
                var b;
                for (b in a)
                    ~g.indexOf(j, b) && delete a[b]
            }
            function I(a) {
                var b = Array.prototype.toJSON, c;
                return delete Array.prototype.toJSON, c = JSON.stringify(a), b && (Array.prototype.toJSON = b), c
            }
            var h = "twttr_", i = {tweetbutton: "//p.twitter.com/t.gif", followbutton: "//p.twitter.com/f.gif", tweetembed: "//p.twitter.com/e.gif"}, j = ["hask", "li", "logged_in", "pid", "user_id", e.guest_id_cookie, h + "hask", h + "li", h + e.guest_id_cookie], k = 0, l, m, n = [], o, p, q, r, s = 1;
            e.forceNewCookie(), a({enqueue: y, flush: z, initPostLogging: t, addPixel: u, addLegacyPixel: v, addVar: w})
        })
    });
    provide("util/logger", function(a) {
        function c(a) {
            window[b] && window[b].log && window[b].log(a)
        }
        function d(a) {
            window[b] && window[b].warn && window[b].warn(a)
        }
        function e(a) {
            window[b] && window[b].error && window[b].error(a)
        }
        var b = ["con", "sole"].join("");
        a({info: c, warn: d, error: e})
    });
    provide("tfw/util/data", function(a) {
        using("util/logger", "util/util", "util/querystring", function(b, c, d) {
            function l(a, b) {
                return a == {}.toString.call(b).match(/\s([a-zA-Z]+)/)[1].toLowerCase()
            }
            function m(a) {
                return function(c) {
                    c.error ? a.error && a.error(c) : c.headers && c.headers.status != 200 ? (a.error && a.error(c), b.warn(c.headers.message)) : a.success && a.success(c), a.complete && a.complete(c), n(a)
                }
            }
            function n(a) {
                var b = a.script;
                b && (b.onload = b.onreadystatechange = null, b.parentNode && b.parentNode.removeChild(b), a.script = undefined, b = undefined), a.callbackName && twttr.tfw.callbacks[a.callbackName] && delete twttr.tfw.callbacks[a.callbackName]
            }
            function o(a) {
                var b = {};
                return a.success && l("function", a.success) && (b.success = a.success), a.error && l("function", a.error) && (b.error = a.error), a.complete && l("function", a.complete) && (b.complete = a.complete), b
            }
            function p(a, b, c) {
                var d = a.length, e = {}, f = 0;
                return function(g) {
                    var h, i = [], j = [], k = [], l, m;
                    h = c(g), e[h] = g;
                    if (++f === d) {
                        for (l = 0; l < d; l++)
                            m = e[a[l]], i.push(m), m.error ? k.push(m) : j.push(m);
                        b.error && k.length > 0 && b.error(k), b.success && j.length > 0 && b.success(j), b.complete && b.complete(i)
                    }
                }
            }
            twttr = twttr || {}, twttr.tfw = twttr.tfw || {}, twttr.tfw.callbacks = twttr.tfw.callbacks || {};
            var e = "twttr.tfw.callbacks", f = twttr.tfw.callbacks, g = "cb", h = 0, i = !1, j = {}, k = {userLookup: "//api.twitter.com/1/users/lookup.json", userShow: "//cdn.api.twitter.com/1/users/show.json", status: "//cdn.api.twitter.com/1/statuses/show.json", tweets: "//syndication.twimg.com/tweets.json", count: "//cdn.api.twitter.com/1/urls/count.json", friendship: "//cdn.api.twitter.com/1/friendships/exists.json", timeline: "//cdn.syndication.twimg.com/widgets/timelines/", timelinePoll: "//syndication.twimg.com/widgets/timelines/paged/", timelinePreview: "//syndication.twimg.com/widgets/timelines/preview/"};
            twttr.widgets && twttr.widgets.endpoints && c.aug(k, twttr.widgets.endpoints), j.jsonp = function(a, b, c) {
                var j = c || g + h, k = e + "." + j, l = document.createElement("script"), n = {callback: k, suppress_response_codes: !0};
                f[j] = m(b);
                if (i || !/^https?\:$/.test(window.location.protocol))
                    a = a.replace(/^\/\//, "https://");
                l.src = d.url(a, n), l.async = "async", document.body.appendChild(l), b.script = l, b.callbackName = j, c || h++
            }, j.config = function(a) {
                if (a.forceSSL === !0 || a.forceSSL === !1)
                    i = a.forceSSL
            }, j.user = function() {
                var a, b = {}, c, e, f;
                arguments.length === 1 ? (a = arguments[0].screenName, b = o(arguments[0])) : (a = arguments[0], b.success = arguments[1]), c = l("array", a) ? k.userLookup : k.userShow, a = l("array", a) ? a.join(",") : a, e = {screen_name: a}, f = d.url(c, e), this.jsonp(f, b)
            }, j.userById = function(a) {
                var b, c = {}, e, f, g;
                arguments.length === 1 ? (b = a.ids, c = o(a)) : (b = a, c.success = arguments[1]), e = l("array", b) ? k.userLookup : k.userShow, b = l("array", b) ? b.join(",") : b, f = {user_id: b}, g = d.url(e, f), this.jsonp(g, c)
            }, j.status = function() {
                var a, b = {}, c, e, f, g;
                arguments.length === 1 ? (a = arguments[0].id, b = o(arguments[0])) : (a = arguments[0], b.success = arguments[1]);
                if (!l("array", a))
                    c = {id: a, include_entities: !0}, e = d.url(k.status, c), this.jsonp(e, b);
                else {
                    f = p(a, b, function(a) {
                        return a.error ? a.request.split("id=")[1].split("&")[0] : a.id_str
                    });
                    for (g = 0; g < a.length; g++)
                        c = {id: a[g], include_entities: !0}, e = d.url(k.status, c), this.jsonp(e, {success: f, error: f})
                }
            }, j.tweets = function(a) {
                var b = arguments[0], c = o(b), e = {ids: a.ids.join(","), lang: a.lang}, f = d.url(k.tweets, e);
                this.jsonp(f, c)
            }, j.count = function() {
                var a = "", b, c, e = {};
                arguments.length === 1 ? (a = arguments[0].url, e = o(arguments[0])) : arguments.length === 2 && (a = arguments[0], e.success = arguments[1]), c = {url: a}, b = d.url(k.count, c), this.jsonp(b, e)
            }, j.friendshipExists = function(a) {
                var b = o(a), c = {screen_name_a: a.screenNameA, screen_name_b: a.screenNameB}, e = d.url(k.friendship, c);
                this.jsonp(e, b)
            }, j.timeline = function(a) {
                var b = arguments[0], e = o(b), f, g = 9e5, h = Math.floor(+(new Date) / g), i = {lang: a.lang, t: h, domain: window.location.host, dnt: a.dnt, override_type: a.overrideType, override_id: a.overrideId, override_name: a.overrideName, override_owner_id: a.overrideOwnerId, override_owner_name: a.overrideOwnerName, with_replies: a.withReplies};
                c.compact(i), f = d.url(k.timeline + a.id, i), this.jsonp(f, e, "tl_" + a.id)
            }, j.timelinePoll = function(a) {
                var b = arguments[0], e = o(b), f = {lang: a.lang, since_id: a.sinceId, max_id: a.maxId, domain: window.location.host, dnt: a.dnt, override_type: a.overrideType, override_id: a.overrideId, override_name: a.overrideName, override_owner_id: a.overrideOwnerId, override_owner_name: a.overrideOwnerName, with_replies: a.withReplies}, g;
                c.compact(f), g = d.url(k.timelinePoll + a.id, f), this.jsonp(g, e, "tlPoll_" + a.id + "_" + (a.sinceId || a.maxId))
            }, j.timelinePreview = function(a) {
                var b = arguments[0], c = o(b), e = a.params, f = d.url(k.timelinePreview, e);
                this.jsonp(f, c)
            }, a(j)
        })
    });
    provide("anim/transition", function(a) {
        function b(a, b) {
            var c;
            return b = b || window, c = b.requestAnimationFrame || b.webkitRequestAnimationFrame || b.mozRequestAnimationFrame || b.msRequestAnimationFrame || b.oRequestAnimationFrame || function(c) {
                b.setTimeout(function() {
                    a(+(new Date))
                }, 1e3 / 60)
            }, c(a)
        }
        function c(a, b) {
            return Math.sin(Math.PI / 2 * b) * a
        }
        function d(a, c, d, e, f) {
            function i() {
                var h = +(new Date), j = h - g, k = Math.min(j / d, 1), l = e ? e(c, k) : c * k;
                a(l);
                if (k == 1)
                    return;
                b(i, f)
            }
            var g = +(new Date), h;
            b(i)
        }
        a({animate: d, requestAnimationFrame: b, easeOut: c})
    });
    provide("util/datetime", function(a) {
        using("util/util", function(b) {
            function m(a) {
                return a < 10 ? "0" + a : a
            }
            function n(a) {
                function e(a, c) {
                    return b && b[a] && (a = b[a]), a.replace(/%\{([\w_]+)\}/g, function(a, b) {
                        return c[b] !== undefined ? c[b] : a
                    })
                }
                var b = a && a.phrases, c = a && a.months || f, d = a && a.formats || g;
                this.timeAgo = function(a) {
                    var b = n.parseDate(a), f = +(new Date), g = f - b, m;
                    return b ? isNaN(g) || g < h * 2 ? e("now") : g < i ? (m = Math.floor(g / h), e(d.abbr, {number: m, symbol: e(l, {abbr: e("s"), expanded: m > 1 ? e("seconds") : e("second")})})) : g < j ? (m = Math.floor(g / i), e(d.abbr, {number: m, symbol: e(l, {abbr: e("m"), expanded: m > 1 ? e("minutes") : e("minute")})})) : g < k ? (m = Math.floor(g / j), e(d.abbr, {number: m, symbol: e(l, {abbr: e("h"), expanded: m > 1 ? e("hours") : e("hour")})})) : g < k * 365 ? e(d.shortdate, {day: b.getDate(), month: e(c[b.getMonth()])}) : e(d.longdate, {day: b.getDate(), month: e(c[b.getMonth()]), year: b.getFullYear().toString().slice(2)}) : ""
                }, this.localTimeStamp = function(a) {
                    var b = n.parseDate(a), f = b && b.getHours();
                    return b ? e(d.full, {day: b.getDate(), month: e(c[b.getMonth()]), year: b.getFullYear(), hours24: m(f), hours12: f < 13 ? f ? f : "12" : f - 12, minutes: m(b.getMinutes()), seconds: m(b.getSeconds()), amPm: f < 12 ? e("AM") : e("PM")}) : ""
                }
            }
            var c = /(\d{4})-?(\d{2})-?(\d{2})T(\d{2}):?(\d{2}):?(\d{2})(Z|[\+\-]\d{2}:?\d{2})/, d = /[a-z]{3,4} ([a-z]{3}) (\d{1,2}) (\d{1,2}):(\d{2}):(\d{2}) ([\+\-]\d{2}:?\d{2}) (\d{4})/i, e = /^\d+$/, f = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"], g = {abbr: "%{number}%{symbol}", shortdate: "%{day} %{month}", longdate: "%{day} %{month} %{year}", full: "%{hours12}:%{minutes} %{amPm} - %{day} %{month} %{year}"}, h = 1e3, i = h * 60, j = i * 60, k = j * 24, l = '<abbr title="%{expanded}">%{abbr}</abbr>';
            n.parseDate = function(a) {
                var g = a || "", h = g.toString(), i, j;
                return i = function() {
                    var a;
                    if (e.test(h))
                        return parseInt(h, 10);
                    if (a = h.match(d))
                        return Date.UTC(a[7], b.indexOf(f, a[1]), a[2], a[3], a[4], a[5]);
                    if (a = h.match(c))
                        return Date.UTC(a[1], a[2] - 1, a[3], a[4], a[5], a[6])
                }(), i ? (j = new Date(i), !isNaN(j.getTime()) && j) : !1
            }, a(n)
        })
    });
    provide("tfw/util/assets", function(a) {
        using("util/env", function(b) {
            function d(a, d) {
                var e = c[a], f;
                return b.retina() ? f = "2x" : b.ie6() || b.ie7() ? f = "gif" : f = "default", d && (f += ".rtl"), e[f]
            }
            var c = {"embed/timeline.css": {"default": "embed/timeline.567ea07eddcd605b5baec3636ed11d02.default.css", "2x": "embed/timeline.567ea07eddcd605b5baec3636ed11d02.2x.css", gif: "embed/timeline.567ea07eddcd605b5baec3636ed11d02.gif.css", "default.rtl": "embed/timeline.567ea07eddcd605b5baec3636ed11d02.default.rtl.css", "2x.rtl": "embed/timeline.567ea07eddcd605b5baec3636ed11d02.2x.rtl.css", "gif.rtl": "embed/timeline.567ea07eddcd605b5baec3636ed11d02.gif.rtl.css"}};
            a(d)
        })
    });
    provide("tfw/widget/syndicatedbase", function(a) {
        using("tfw/widget/base", "tfw/widget/intent", "tfw/util/assets", "tfw/util/globals", "dom/classname", "dom/delegate", "dom/sandbox", "util/env", "util/twitter", "util/util", function(b, c, d, e, f, g, h, i, j, k) {
            function s() {
                p = v.VALID_COLOR.test(e.val("widgets:link-color")) && RegExp.$1, r = v.VALID_COLOR.test(e.val("widgets:border-color")) && RegExp.$1, q = e.val("widgets:theme")
            }
            function t(a, b, c) {
                var d;
                c = c || document;
                if (c.getElementById(a))
                    return;
                d = c.createElement("link"), d.id = a, d.rel = "stylesheet", d.type = "text/css", d.href = twttr.widgets.config.assetUrl() + "/" + b, c.getElementsByTagName("head")[0].appendChild(d)
            }
            function u(a) {
                t("twitter-widget-css", d("embed/timeline.css"), a)
            }
            function v(a) {
                if (!a)
                    return;
                var c, d, e = this;
                this.sandboxReadyCallbacks = [], b.apply(this, [a]), c = this.params(), this.targetEl = this.srcEl && this.srcEl.parentNode || c.targetEl || document.body, this.containerWidth = this.targetEl && this.targetEl.offsetWidth, d = c.width || this.attr("width") || this.containerWidth || this.dimensions.DEFAULT_WIDTH, this.height = v.VALID_UNIT.test(c.height || this.attr("height")) && RegExp.$1, this.width = Math.max(this.dimensions.MIN_WIDTH, Math.min(v.VALID_UNIT.test(d) ? RegExp.$1 : this.dimensions.DEFAULT_WIDTH, this.dimensions.DEFAULT_WIDTH)), this.narrow = c.narrow || this.width <= this.dimensions.NARROW_WIDTH, this.narrow && this.classAttr.push("var-narrow"), v.VALID_COLOR.test(c.linkColor || this.dataAttr("link-color")) ? this.linkColor = RegExp.$1 : this.linkColor = p, v.VALID_COLOR.test(c.borderColor || this.dataAttr("border-color")) ? this.borderColor = RegExp.$1 : this.borderColor = r, this.theme = c.theme || this.attr("data-theme") || q, this.theme = /(dark|light)/.test(this.theme) ? this.theme : "", this.classAttr.push(i.touch() ? "is-touch" : "not-touch"), h(function(a) {
                    e.sandboxReady = !0, e.setupSandbox.call(e, a)
                }, {"class": this.renderedClassNames, id: this.id}, {width: "1px", height: "1px", border: "none", position: "absolute"}, function(a) {
                    e.srcEl ? e.targetEl.insertBefore(a, e.srcEl) : e.targetEl.appendChild(a)
                })
            }
            var l = [".customisable", ".customisable:link", ".customisable:visited", ".customisable:hover", ".customisable:focus", ".customisable:active", ".customisable-highlight:hover", ".customisable-highlight:focus", "a:hover .customisable-highlight", "a:focus .customisable-highlight"], m = ["a:hover .ic-mask", "a:focus .ic-mask"], n = [".customisable-border"], o = [".timeline-header h1.summary", ".timeline-header h1.summary a:link", ".timeline-header h1.summary a:visited"], p, q, r;
            v.prototype = new b, k.aug(v.prototype, {setupSandbox: function(a) {
                    var b = a.doc, c = b.createElement("base"), d = b.createElement("style"), f = b.getElementsByTagName("head")[0], g = "body{display:none}", h = this, i;
                    this.sandbox = a, a.frame.title = this.a11yTitle, u(a.doc), c.target = "_blank", f.appendChild(c), e.val("widgets:csp") != "on" && (d.type = "text/css", d.styleSheet ? d.styleSheet.cssText = g : d.appendChild(b.createTextNode(g)), f.appendChild(d)), this.handleResize && window.addEventListener ? window.addEventListener("resize", function() {
                        h.handleResize()
                    }, !0) : document.body.attachEvent("onresize", function() {
                        h.handleResize()
                    }), a.win.onresize = function(a) {
                        h.handleResize && h.handleResize()
                    }, this.frameIsReady = !0;
                    for (; i = this.sandboxReadyCallbacks.shift(); )
                        i.fn.apply(i.context, i.args)
                }, callsWhenSandboxReady: function(a) {
                    var b = this;
                    return function() {
                        var c = [], d = arguments.length, e = 0;
                        for (; e < d; e++)
                            c.push(arguments[e]);
                        b.callIfSandboxReady(a, b, c)
                    }
                }, callIfSandboxReady: function(a, b, c) {
                    c = c || [], b.frameIsReady ? a.apply(b, [!1].concat(c)) : b.sandboxReadyCallbacks.push({fn: a, context: b, args: [!0].concat(c)})
                }, contentWidth: function() {
                    var a = this.chromeless ? 0 : this.narrow ? this.dimensions.NARROW_MEDIA_PADDING : this.dimensions.WIDE_MEDIA_PADDING;
                    return this.width - a
                }, addSiteStyles: function() {
                    var a = this, b = this.sandbox.doc, c = this.id + "-styles", d, f = 0, g = function(b) {
                        return(a.theme == "dark" ? ".thm-dark " : "") + b
                    }, h = "", i = "", j = "", p = "";
                    if (e.val("widgets:csp") == "on")
                        return;
                    if (b.getElementById(c))
                        return;
                    this.headingStyle && (j = k.map(o, g).join(",") + "{" + this.headingStyle + "}"), this.linkColor && (h = k.map(l, g).join(",") + "{color:" + this.linkColor + "}", i = k.map(m, g).join(",") + "{background-color:" + this.linkColor + "}"), this.borderColor && (p = k.map(n, g).concat(this.theme == "dark" ? [".thm-dark.customisable-border"] : []).join(",") + "{border-color:" + this.borderColor + "}");
                    if (!h && !i && !j)
                        return;
                    d = b.createElement("style"), d.id = c, d.type = "text/css", d.styleSheet ? d.styleSheet.cssText = h + i + j + p : (d.appendChild(b.createTextNode(h)), d.appendChild(b.createTextNode(i)), d.appendChild(b.createTextNode(j)), d.appendChild(b.createTextNode(p))), b.getElementsByTagName("head")[0].appendChild(d)
                }, bindIntentHandlers: function() {
                    var a = this, b = this.element;
                    g.delegate(b, "click", ".profile", function(b) {
                        var d;
                        a.addUrlParams(this), d = j.intentForProfileURL(this.href);
                        if (b.altKey || b.metaKey || b.shiftKey)
                            return;
                        d && (c.open(d, a.sandbox.frame), g.preventDefault(b))
                    }), g.delegate(b, "click", ".web-intent", function(b) {
                        a.addUrlParams(this);
                        if (b.altKey || b.metaKey || b.shiftKey)
                            return;
                        c.open(this.href, a.sandbox.frame), g.preventDefault(b)
                    })
                }}), v.VALID_UNIT = /^([0-9]+)( ?px)?$/, v.VALID_COLOR = /^(#(?:[0-9a-f]{3}|[0-9a-f]{6}))$/i, v.retinize = function(a) {
                if (!i.retina())
                    return;
                var b = a.getElementsByTagName("IMG"), c, d, e = 0, f = b.length;
                for (; e < f; e++)
                    c = b[e], d = c.getAttribute("data-src-2x"), d && (c.src = d)
            }, v.scaleDimensions = function(a, b, c, d) {
                return b > a && b > d ? (a *= d / b, b = d) : a > c && (b *= c / a, a = c, b > d && (a *= d / b, b = d)), {width: Math.ceil(a), height: Math.ceil(b)}
            }, v.constrainMedia = function(a, b) {
                var c = a.getElementsByTagName("IMG"), d = a.getElementsByTagName("IFRAME"), e, f, g, h = 0, i = 0, j;
                for (; e = [c, d][i]; i++)
                    if (e.length)
                        for (j = 0; f = e[j]; j++)
                            g = v.scaleDimensions(f.getAttribute("width") || f.width, f.getAttribute("height") || f.height, b, 375), g.width > 0 && (f.width = g.width), g.height > 0 && (f.height = g.height), h = g.height > h ? g.height : h;
                return h
            }, s(), a(v)
        })
    });
    provide("tfw/widget/timeline", function(a) {
        using("tfw/widget/syndicatedbase", "util/datetime", "anim/transition", "tfw/util/data", "tfw/util/tracking", "tfw/util/params", "util/css", "util/env", "util/iframe", "util/insert", "util/throttle", "util/twitter", "util/querystring", "util/typevalidator", "util/util", "dom/delegate", "dom/classname", "dom/get", function(b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s) {
            function L(a) {
                if (!a)
                    return;
                var c, d, e, f, g, i, j;
                this.a11yTitle = this._("Twitter Timeline Widget"), b.apply(this, [a]), c = this.params(), d = (c.chrome || this.dataAttr("chrome") || "").split(" "), this.preview = c.previewParams, this.widgetId = c.widgetId || this.dataAttr("widget-id"), (f = c.screenName || this.dataAttr("screen-name")) || (g = c.userId || this.dataAttr("user-id")) ? this.override = {overrideType: "user", overrideId: g, overrideName: f, withReplies: o.asBoolean(c.showReplies || this.dataAttr("show-replies")) ? "true" : "false"} : (f = c.favoritesScreenName || this.dataAttr("favorites-screen-name")) || (g = c.favoritesUserId || this.dataAttr("favorites-user-id")) ? this.override = {overrideType: "favorites", overrideId: g, overrideName: f} : ((f = c.listOwnerScreenName || this.dataAttr("list-owner-screen-name")) || (g = c.listOwnerId || this.dataAttr("list-owner-id"))) && ((i = c.listId || this.dataAttr("list-id")) || (j = c.listSlug || this.dataAttr("list-slug"))) ? this.override = {overrideType: "list", overrideOwnerId: g, overrideOwnerName: f, overrideId: i, overrideName: j} : this.override = {}, this.tweetLimit = o.asInt(c.tweetLimit || this.dataAttr("tweet-limit")), this.staticTimeline = this.tweetLimit > 0, d.length && (e = ~p.indexOf(d, "none"), this.chromeless = e || ~p.indexOf(d, "transparent"), this.headerless = e || ~p.indexOf(d, "noheader"), this.footerless = e || ~p.indexOf(d, "nofooter"), this.borderless = e || ~p.indexOf(d, "noborders"), this.noscrollbar = ~p.indexOf(d, "noscrollbar")), this.headingStyle = h.sanitize(c.headingStyle || this.dataAttr("heading-style"), undefined, !0), this.classAttr.push("twitter-timeline-rendered"), this.ariaPolite = c.ariaPolite || this.dataAttr("aria-polite")
            }
            function M(a, c) {
                var d = a.ownerDocument, e = s.one(D, a, "DIV"), f = e && e.children[0], g = f && f.getAttribute("data-expanded-media"), h, i = 0, j = s.one(E, a, "A"), k = j && j.getElementsByTagName("B")[0], l = k && (k.innerText || k.textContent), m;
                if (!k)
                    return;
                k.innerHTML = j.getAttribute("data-toggled-text"), j.setAttribute("data-toggled-text", l);
                if (r.present(a, C)) {
                    r.remove(a, C);
                    if (!e)
                        return;
                    e.style.cssText = "", f.innerHTML = "";
                    return
                }
                g && (h = d.createElement("DIV"), h.innerHTML = g, b.retinize(h), i = b.constrainMedia(h, c), f.appendChild(h)), e && (m = Math.max(f.offsetHeight, i), e.style.cssText = "height:" + m + "px"), r.add(a, C)
            }
            var t = "1.0", u = {CLIENT_SIDE_USER: 0, CLIENT_SIDE_APP: 2}, v = "timeline", w = "new-tweets-bar", x = "timeline-header", y = "timeline-footer", z = "stream", A = "h-feed", B = "tweet", C = "expanded", D = "detail-expander", E = "expand", F = "permalink", G = "twitter-follow-button", H = "no-more-pane", I = "pending-scroll-in", J = "pending-new-tweet", K = "show-new-tweet";
            L.prototype = new b, p.aug(L.prototype, {renderedClassNames: "twitter-timeline twitter-timeline-rendered", dimensions: {DEFAULT_HEIGHT: "600", DEFAULT_WIDTH: "520", NARROW_WIDTH: "320", MIN_WIDTH: "180", MIN_HEIGHT: "200", WIDE_MEDIA_PADDING: 81, NARROW_MEDIA_PADDING: 16}, create: function(a) {
                    var c = this.sandbox.doc.createElement("div"), d, e = this, g, h, i, j = [], k, l;
                    c.innerHTML = a.body, d = c.children[0] || !1;
                    if (!d)
                        return;
                    this.reconfigure(a.config), this.discardStaticOverflow(d), this.augmentWidgets(d), b.retinize(d), b.constrainMedia(d, this.contentWidth()), this.searchQuery = d.getAttribute("data-search-query"), this.profileId = d.getAttribute("data-profile-id"), k = this.getTweetDetails(c);
                    for (l in k)
                        k.hasOwnProperty(l) && j.push(l);
                    return f.enqueue({page: "timeline", component: "timeline", element: "initial", action: j.length ? "results" : "no_results"}, {widget_id: this.widgetId, widget_origin: document.location.href, item_ids: j, item_details: k, client_version: t, message: this.partner, query: this.searchQuery, profile_id: this.profileId}, !0, this.dnt), f.flush(), this.ariaPolite == "assertive" && (h = s.one(w, d, "DIV"), h.setAttribute("aria-polite", "assertive")), d.id = this.id, d.className += " " + this.classAttr.join(" "), d.lang = this.lang, twttr.widgets.load(d), i = function() {
                        e.sandbox.body.appendChild(d), e.staticTimeline ? e.sandbox.win.setTimeout(function() {
                            e.sandbox.frame.height = e.height = d.offsetHeight
                        }, 500) : e.sandbox.win.setTimeout(function() {
                            var a = s.one(x, d, "DIV"), b = s.one(y, d, "DIV"), c = s.one(z, d, "DIV");
                            b ? g = a.offsetHeight + b.offsetHeight : g = a.offsetHeight, c.style.cssText = "height:" + (e.height - g - 2) + "px", e.noscrollbar && e.hideStreamScrollBar()
                        }, 500), e.sandbox.frame.style.cssText = "", e.sandbox.frame.width = e.width, e.sandbox.frame.height = e.height, e.sandbox.frame.style.border = "none", e.sandbox.frame.style.maxWidth = "100%", e.sandbox.frame.style.minWidth = e.dimensions.MIN_WIDTH + "px"
                    }, this.callsWhenSandboxReady(i)(), this.srcEl && this.srcEl.parentNode && this.srcEl.parentNode.removeChild(this.srcEl), d
                }, render: function(a, b) {
                    function h() {
                        d.success = function(a) {
                            c.element = c.create(a), c.readTranslations(), c.bindInteractions(), b && b(c.sandbox.frame);
                            return
                        }, d.error = function(a) {
                            a && a.headers && b && b(a.headers.status)
                        }, d.params = c.preview, e.timelinePreview(d);
                        return
                    }
                    function i() {
                        f.initPostLogging(), e.timeline(p.aug({id: c.widgetId, dnt: c.dnt, lang: c.lang, success: function(a) {
                                c.element = c.create(a), c.readTranslations(), c.bindInteractions(), a.headers.xPolling && /\d/.test(a.headers.xPolling) && (c.pollInterval = a.headers.xPolling * 1e3), c.updateTimeStamps(), c.staticTimeline || c.schedulePolling(), b && b(c.sandbox.frame);
                                return
                            }, error: function(a) {
                                a && a.headers && b && b(a.headers.status)
                            }}, c.override))
                    }
                    var c = this, d = {}, g;
                    if (!this.preview && !this.widgetId) {
                        b && b(400);
                        return
                    }
                    g = this.preview ? h : i, this.sandboxReady ? g() : window.setTimeout(g, 0)
                }, reconfigure: function(a) {
                    this.lang = a.lang, this.theme || (this.theme = a.theme), this.theme == "dark" && this.classAttr.push("thm-dark"), this.chromeless && this.classAttr.push("var-chromeless"), this.borderless && this.classAttr.push("var-borderless"), this.headerless && this.classAttr.push("var-headerless"), this.footerless && this.classAttr.push("var-footerless"), this.staticTimeline && this.classAttr.push("var-static"), !this.linkColor && a.linkColor && b.VALID_COLOR.test(a.linkColor) && (this.linkColor = RegExp.$1), this.addSiteStyles(), !this.height && b.VALID_UNIT.test(a.height) && (this.height = RegExp.$1), this.height = Math.max(this.dimensions.MIN_HEIGHT, this.height ? this.height : this.dimensions.DEFAULT_HEIGHT), this.preview && this.classAttr.push("var-preview"), this.narrow = this.width <= this.dimensions.NARROW_WIDTH, this.narrow && this.classAttr.push("var-narrow")
                }, getTweetDetails: function(a) {
                    var b = s.all(B, a, "LI"), c = {}, d, e, f, g, h = {TWEET: 0, RETWEET: 10}, i = 0;
                    for (; d = b[i]; i++)
                        e = s.one(F, d, "A"), f = m.status(e.href), g = d.getAttribute("data-tweet-id"), f === g ? c[f] = {item_type: h.TWEET} : c[f] = {item_type: h.RETWEET, target_type: h.TWEET, target_id: g};
                    return c
                }, bindInteractions: function() {
                    var a = this, b = this.element, c = !0;
                    this.bindIntentHandlers(), q.delegate(b, "click", ".load-tweets", function(b) {
                        c && (c = !1, a.forceLoad(), q.stop(b))
                    }), q.delegate(b, "click", ".display-sensitive-image", function(c) {
                        a.showNSFW(s.ancestor("." + B, this, b)), q.stop(c)
                    }), q.delegate(b, "mouseover", "." + v, function() {
                        a.mouseOver = !0
                    }), q.delegate(b, "mouseout", "." + v, function() {
                        a.mouseOver = !1
                    }), q.delegate(b, "mouseover", "." + w, function() {
                        a.mouseOverNotifier = !0
                    }), q.delegate(b, "mouseout", "." + w, function() {
                        a.mouseOverNotifier = !1, window.setTimeout(function() {
                            a.hideNewTweetNotifier()
                        }, 3e3)
                    });
                    if (this.staticTimeline)
                        return;
                    q.delegate(b, "click", "." + E, function(c) {
                        if (c.altKey || c.metaKey || c.shiftKey)
                            return;
                        M(s.ancestor("." + B, this, b), a.contentWidth()), q.stop(c)
                    }), q.delegate(b, "click", "A", function(a) {
                        q.stopPropagation(a)
                    }), q.delegate(b, "click", ".with-expansion", function(b) {
                        M(this, a.contentWidth()), q.stop(b)
                    }), q.delegate(b, "click", ".load-more", function() {
                        a.loadMore()
                    }), q.delegate(b, "click", "." + w, function() {
                        a.scrollToTop(), a.hideNewTweetNotifier(!0)
                    })
                }, scrollToTop: function() {
                    var a = s.one(z, this.element, "DIV");
                    a.scrollTop = 0, a.focus()
                }, update: function() {
                    var a = this, b = s.one(B, this.element, "LI"), c = b && b.getAttribute("data-tweet-id");
                    this.updateTimeStamps(), this.requestTweets(c, !0, function(b) {
                        b.childNodes.length > 0 && a.insertNewTweets(b)
                    })
                }, loadMore: function() {
                    var a = this, b = s.all(B, this.element, "LI").pop(), c = b && b.getAttribute("data-tweet-id");
                    this.requestTweets(c, !1, function(b) {
                        var d = s.one(H, a.element, "P"), e = b.childNodes[0];
                        d.style.cssText = "", e && e.getAttribute("data-tweet-id") == c && b.removeChild(e);
                        if (b.childNodes.length > 0) {
                            a.appendTweets(b);
                            return
                        }
                        r.add(a.element, "no-more"), d.focus()
                    })
                }, forceLoad: function() {
                    var a = this, b = !!s.all(A, this.element, "OL").length;
                    this.requestTweets(1, !0, function(c) {
                        c.childNodes.length && (a[b ? "insertNewTweets" : "appendTweets"](c), r.add(a.element, "has-tweets"))
                    })
                }, schedulePolling: function(a) {
                    var b = this;
                    if (this.pollInterval === null)
                        return;
                    a = twttr.widgets.poll || a || this.pollInterval || 1e4, a > -1 && window.setTimeout(function() {
                        this.isUpdating || b.update(), b.schedulePolling()
                    }, a)
                }, requestTweets: function(a, c, d) {
                    var g = this, h = {id: this.widgetId, screenName: this.widgetScreenName, userId: this.widgetUserId, withReplies: this.widgetShowReplies, dnt: this.dnt, lang: this.lang};
                    h[c ? "sinceId" : "maxId"] = a, h.complete = function() {
                        this.isUpdating = !1
                    }, h.error = function(a) {
                        if (a && a.headers) {
                            if (a.headers.status == "404") {
                                g.pollInterval = null;
                                return
                            }
                            if (a.headers.status == "503") {
                                g.pollInterval *= 1.5;
                                return
                            }
                        }
                    }, h.success = function(a) {
                        var e = g.sandbox.doc.createDocumentFragment(), h = g.sandbox.doc.createElement("div"), i = [], j, k;
                        a && a.headers && a.headers.xPolling && /\d+/.test(a.headers.xPolling) && (g.pollInterval = a.headers.xPolling * 1e3);
                        if (a && a.body !== undefined) {
                            h.innerHTML = a.body;
                            if (h.children[0] && h.children[0].tagName != "LI")
                                return;
                            j = g.getTweetDetails(h);
                            for (k in j)
                                j.hasOwnProperty(k) && i.push(k);
                            i.length && (f.enqueue({page: "timeline", component: "timeline", element: c ? "newer" : "older", action: "results"}, {widget_id: g.widgetId, widget_origin: document.location.href, item_ids: i, item_details: j, client_version: t, message: g.partner, query: g.searchQuery, profile_id: g.profileId, event_initiator: c ? u.CLIENT_SIDE_APP : u.CLIENT_SIDE_USER}, !0, g.dnt), f.flush()), b.retinize(h), b.constrainMedia(h, g.contentWidth());
                            while (h.children[0])
                                e.appendChild(h.children[0]);
                            d(e)
                        }
                    }, e.timelinePoll(p.aug(h, this.override))
                }, insertNewTweets: function(a) {
                    var b = this, c = s.one(z, this.element, "DIV"), e = s.one(A, c, "OL"), f = e.offsetHeight, g;
                    this.updateTimeStamps(), e.insertBefore(a, e.firstChild), g = e.offsetHeight - f;
                    if (c.scrollTop > 40 || this.mouseIsOver()) {
                        c.scrollTop = c.scrollTop + g, this.showNewTweetNotifier();
                        return
                    }
                    r.remove(this.element, I), e.style.cssText = "margin-top: -" + g + "px", window.setTimeout(function() {
                        c.scrollTop = 0, r.add(b.element, I), i.cssTransitions() ? e.style.cssText = "" : d.animate(function(a) {
                            a < g ? e.style.cssText = "margin-top: -" + (g - a) + "px" : e.style.cssText = ""
                        }, g, 500, d.easeOut)
                    }, 500), this.gcTweets(50)
                }, appendTweets: function(a) {
                    var b = s.one(z, this.element, "DIV"), c = s.one(A, b, "OL");
                    this.updateTimeStamps(), c.appendChild(a)
                }, gcTweets: function(a) {
                    var b = s.one(A, this.element, "OL"), c = b.children.length, d;
                    a = a || 50;
                    for (; c > a && (d = b.children[c - 1]); c--)
                        b.removeChild(d)
                }, showNewTweetNotifier: function() {
                    var a = this, b = s.one(w, this.element, "DIV"), c = b.children[0];
                    b.style.cssText = "", r.add(this.element, J), b.removeChild(c), b.appendChild(c), r.replace(this.element, J, K), this.newNoticeDisplayTime = +(new Date), window.setTimeout(function() {
                        a.hideNewTweetNotifier()
                    }, 5e3)
                }, hideNewTweetNotifier: function(a) {
                    var b = this;
                    if (!a && this.mouseOverNotifier)
                        return;
                    r.replace(this.element, K, J), window.setTimeout(function() {
                        r.remove(b.element, J)
                    }, 500)
                }, augmentWidgets: function(a) {
                    var b = s.all(G, a, "A"), c = 0, d;
                    for (; d = b[c]; c++)
                        d.setAttribute("data-related", this.related), d.setAttribute("data-partner", this.partner), d.setAttribute("data-dnt", this.dnt), d.setAttribute("data-search-query", this.searchQuery), d.setAttribute("data-profile-id", this.profileId), this.width < 250 && d.setAttribute("data-show-screen-name", "false")
                }, discardStaticOverflow: function(a) {
                    var b = s.one(A, a, "OL"), c;
                    if (this.staticTimeline) {
                        this.height = 0;
                        while (c = b.children[this.tweetLimit])
                            b.removeChild(c)
                    }
                }, hideStreamScrollBar: function() {
                    var a = s.one(z, this.element, "DIV"), b = s.one(A, this.element, "OL"), c;
                    a.style.width = "", c = this.element.offsetWidth - b.offsetWidth, c > 0 && (a.style.width = this.element.offsetWidth + c + "px")
                }, readTranslations: function() {
                    var a = this.element, b = "data-dt-";
                    this.datetime = new c(p.compact({phrases: {now: a.getAttribute(b + "now"), s: a.getAttribute(b + "s"), m: a.getAttribute(b + "m"), h: a.getAttribute(b + "h"), second: a.getAttribute(b + "second"), seconds: a.getAttribute(b + "seconds"), minute: a.getAttribute(b + "minute"), minutes: a.getAttribute(b + "minutes"), hour: a.getAttribute(b + "hour"), hours: a.getAttribute(b + "hours")}, months: a.getAttribute(b + "months").split("|"), formats: {abbr: a.getAttribute(b + "abbr"), shortdate: a.getAttribute(b + "short"), longdate: a.getAttribute(b + "long")}}))
                }, updateTimeStamps: function() {
                    var a = s.all(F, this.element, "A"), b, c, d = 0, e, f;
                    for (; b = a[d]; d++) {
                        e = b.getAttribute("data-datetime"), f = e && this.datetime.timeAgo(e, this.i18n), c = b.getElementsByTagName("TIME")[0];
                        if (!f)
                            continue;
                        if (c && c.innerHTML) {
                            c.innerHTML = f;
                            continue
                        }
                        b.innerHTML = f
                    }
                }, mouseIsOver: function() {
                    return this.mouseOver
                }, addUrlParams: function(a) {
                    var b = this, c = {tw_w: this.widgetId, related: this.related, partner: this.partner, query: this.searchQuery, profile_id: this.profileId, tw_p: "embeddedtimeline"};
                    return this.addUrlParams = g(c, function(a) {
                        var c = s.ancestor("." + B, a, b.element);
                        return c && {tw_i: c.getAttribute("data-tweet-id")}
                    }), this.addUrlParams(a)
                }, showNSFW: function(a) {
                    var c = s.one("nsfw", a, "DIV"), d, e, f = 0, g, h, j, k;
                    if (!c)
                        return;
                    e = b.scaleDimensions(c.getAttribute("data-width"), c.getAttribute("data-height"), this.contentWidth(), c.getAttribute("data-height")), d = !!(h = c.getAttribute("data-player")), d ? j = this.sandbox.doc.createElement("iframe") : (j = this.sandbox.doc.createElement("img"), h = c.getAttribute(i.retina() ? "data-image-2x" : "data-image"), j.alt = c.getAttribute("data-alt"), k = this.sandbox.doc.createElement("a"), k.href = c.getAttribute("data-href"), k.appendChild(j)), j.title = c.getAttribute("data-title"), j.src = h, j.width = e.width, j.height = e.height, g = s.ancestor("." + D, c, a), f = e.height - c.offsetHeight, c.parentNode.replaceChild(d ? j : k, c), g.style.cssText = "height:" + (g.offsetHeight + f) + "px"
                }, handleResize: function() {
                    this.handleResize = l(function() {
                        var a = Math.min(this.dimensions.DEFAULT_WIDTH, Math.max(this.dimensions.MIN_WIDTH, this.sandbox.frame.offsetWidth));
                        if (!this.element)
                            return;
                        a < this.dimensions.NARROW_WIDTH ? (this.narrow = !0, r.add(this.element, "var-narrow")) : (this.narrow = !1, r.remove(this.element, "var-narrow")), this.noscrollbar && this.hideStreamScrollBar()
                    }, 50, this), this.handleResize()
                }}), a(L)
        })
    });
    provide("tfw/widget/embed", function(a) {
        using("tfw/widget/base", "tfw/widget/syndicatedbase", "util/datetime", "tfw/util/params", "dom/classname", "dom/get", "util/env", "util/util", "util/throttle", "util/twitter", "tfw/util/data", "tfw/util/tracking", function(b, c, d, e, f, g, h, i, j, k, l, m) {
            function q(a, b, c) {
                var d = g.one("subject", a, "BLOCKQUOTE"), e = g.one("reply", a, "BLOCKQUOTE"), f = d && d.getAttribute("data-tweet-id"), h = e && e.getAttribute("data-tweet-id"), i = {}, j = {};
                if (!f)
                    return;
                i[f] = {item_type: 0}, m.enqueue({page: "tweet", section: "subject", component: "tweet", action: "results"}, {client_version: n, widget_origin: document.location.href, message: b, item_ids: [f], item_details: i}, !0, c);
                if (!h)
                    return;
                j[h] = {item_type: 0}, m.enqueue({page: "tweet", section: "conversation", component: "tweet", action: "results"}, {client_version: n, widget_origin: document.location.href, message: b, item_ids: [h], item_details: j, associations: {4: {association_id: f, association_type: 4}}}, !0, c)
            }
            function r(a, b, c) {
                var d = {};
                if (!a)
                    return;
                d[a] = {item_type: 0}, m.enqueue({page: "tweet", section: "subject", component: "rawembedcode", action: "no_results"}, {client_version: n, widget_origin: document.location.href, message: b, item_ids: [a], item_details: d}, !0, c)
            }
            function s(a, b, c, d, e) {
                p[a] = p[a] || [], p[a].push({s: c, f: d, r: e, lang: b})
            }
            function t(a) {
                if (!a)
                    return;
                var b, d, e;
                this.a11yTitle = this._("Embedded Tweet"), c.apply(this, [a]), b = this.params(), d = this.srcEl && this.srcEl.getElementsByTagName("A"), e = d && d[d.length - 1], this.hideThread = (b.conversation || this.dataAttr("conversation")) == "none" || ~i.indexOf(this.classAttr, "tw-hide-thread"), this.hideCard = (b.cards || this.dataAttr("cards")) == "hidden" || ~i.indexOf(this.classAttr, "tw-hide-media");
                if ((b.align || this.attr("align")) == "left" || ~i.indexOf(this.classAttr, "tw-align-left"))
                    this.align = "left";
                else if ((b.align || this.attr("align")) == "right" || ~i.indexOf(this.classAttr, "tw-align-right"))
                    this.align = "right";
                else if ((b.align || this.attr("align")) == "center" || ~i.indexOf(this.classAttr, "tw-align-center"))
                    this.align = "center", this.containerWidth > this.dimensions.MIN_WIDTH * (1 / .7) && this.width > this.containerWidth * .7 && (this.width = this.containerWidth * .7);
                this.narrow = b.narrow || this.width <= this.dimensions.NARROW_WIDTH, this.narrow && this.classAttr.push("var-narrow"), this.tweetId = b.tweetId || e && k.status(e.href)
            }
            var n = "2.0", o = "tweetembed", p = {};
            t.prototype = new c, i.aug(t.prototype, {renderedClassNames: "twitter-tweet twitter-tweet-rendered", dimensions: {DEFAULT_HEIGHT: "0", DEFAULT_WIDTH: "500", NARROW_WIDTH: "350", MIN_WIDTH: "220", MIN_HEIGHT: "0", WIDE_MEDIA_PADDING: 32, NARROW_MEDIA_PADDING: 32}, create: function(a) {
                    var b = this.sandbox.doc.createElement("div"), d, e = this.sandbox.frame, f = e.style;
                    b.innerHTML = a, d = b.children[0] || !1;
                    if (!d)
                        return;
                    return this.theme == "dark" && this.classAttr.push("thm-dark"), this.linkColor && this.addSiteStyles(), this.augmentWidgets(d), c.retinize(d), c.constrainMedia(d, this.contentWidth()), d.id = this.id, d.className += " " + this.classAttr.join(" "), d.lang = this.lang, twttr.widgets.load(d), this.sandbox.body.appendChild(d), f.cssText = "", e.width = this.width, e.height = 0, f.display = "block", f.border = "none", f.maxWidth = "99%", f.minWidth = this.dimensions.MIN_WIDTH + "px", f.padding = "0", q(d, this.partner, this.dnt), d
                }, render: function(a, b) {
                    var c = this, d = "", e = this.tweetId, f, g, h;
                    if (!e)
                        return;
                    this.hideCard && (d += "c"), this.hideThread && (d += "t"), d && (e += "-" + d), h = this.callsWhenSandboxReady(function(a) {
                        function d() {
                            var a = c.sandbox.frame, b = a.style;
                            c.srcEl && c.srcEl.parentNode && c.srcEl.parentNode.removeChild(c.srcEl), b.borderRadius = "5px", b.margin = "10px 0", b.border = "#ddd 1px solid", b.borderTopColor = "#eee", b.borderBottomColor = "#bbb", b.boxShadow = "0 1px 3px rgba(0,0,0,0.15)", c.align == "center" ? (b.margin = "7px auto", b.float = "none") : c.align && (c.width == c.dimensions.DEFAULT_WIDTH && (a.width = c.dimensions.NARROW_WIDTH), b.float = c.align), c.handleResize()
                        }
                        var b;
                        if ((!window.getComputedStyle || c.sandbox.win.getComputedStyle(c.sandbox.body, null).display !== "none") && c.element.offsetHeight)
                            return d();
                        b = window.setInterval(function() {
                            (!window.getComputedStyle || c.sandbox.win.getComputedStyle(c.sandbox.body, null).display !== "none") && c.element.offsetHeight && (window.clearInterval(b), d())
                        }, 100)
                    }), f = this.callsWhenSandboxReady(function(a, d) {
                        c.element = c.create(d), c.readTimestampTranslations(), c.updateTimeStamps(), c.bindIntentHandlers(), b && b(c.sandbox.frame)
                    }), g = this.callsWhenSandboxReady(function(a) {
                        r(c.tweetId, c.partner, c.dnt)
                    }), s(e, this.lang, f, g, h)
                }, augmentWidgets: function(a) {
                    var b = g.all("twitter-follow-button", a, "A"), c, d = 0;
                    for (; c = b[d]; d++)
                        c.setAttribute("data-related", this.related), c.setAttribute("data-partner", this.partner), c.setAttribute("data-dnt", this.dnt), c.setAttribute("data-show-screen-name", "false")
                }, addUrlParams: function(a) {
                    var b = this, c = {related: this.related, partner: this.partner, tw_p: o};
                    return this.addUrlParams = e(c, function(a) {
                        var c = g.ancestor(".tweet", a, b.element);
                        return{tw_i: c.getAttribute("data-tweet-id")}
                    }), this.addUrlParams(a)
                }, handleResize: function() {
                    this.handleResize = j(function() {
                        var a = this, b = Math.min(this.dimensions.DEFAULT_WIDTH, Math.max(this.dimensions.MIN_WIDTH, this.sandbox.frame.offsetWidth));
                        if (!this.element)
                            return;
                        b < this.dimensions.NARROW_WIDTH ? (this.narrow = !0, f.add(this.element, "var-narrow")) : (this.narrow = !1, f.remove(this.element, "var-narrow")), window.setTimeout(function() {
                            a.sandbox.frame.height = a.height = a.element.offsetHeight
                        }, 0)
                    }, 50, this), this.handleResize()
                }, readTimestampTranslations: function() {
                    var a = this.element, b = "data-dt-", c = a.getAttribute(b + "months") || "";
                    this.datetime = new d(i.compact({phrases: {AM: a.getAttribute(b + "am"), PM: a.getAttribute(b + "pm")}, months: c.split("|"), formats: {full: a.getAttribute(b + "full")}}))
                }, updateTimeStamps: function() {
                    var a = g.one("long-permalink", this.element, "A"), b = a.getAttribute("data-datetime"), c = b && this.datetime.localTimeStamp(b), d = a.getElementsByTagName("TIME")[0];
                    if (!c)
                        return;
                    if (d && d.innerHTML) {
                        d.innerHTML = c;
                        return
                    }
                    a.innerHTML = c
                }}), t.fetchAndRender = function() {
                var a = p, b = [], c, d;
                p = {};
                if (a.keys)
                    b = a.keys();
                else
                    for (c in a)
                        a.hasOwnProperty(c) && b.push(c);
                if (!b.length)
                    return;
                m.initPostLogging(), d = a[b[0]][0].lang, l.tweets({ids: b.sort(), lang: d, complete: function(b) {
                        var c, d, e, f, g, h, i = [];
                        for (c in b)
                            if (b.hasOwnProperty(c)) {
                                g = a[c] && a[c];
                                for (e = 0; g.length && (f = g[e]); e++)
                                    f.s && (f.s.call(this, b[c]), f.r && i.push(f.r));
                                delete a[c]
                            }
                        for (e = 0; h = i[e]; e++)
                            h.call(this);
                        for (d in a)
                            if (a.hasOwnProperty(d)) {
                                g = a[d];
                                for (e = 0; g.length && (f = g[e]); e++)
                                    f.f && f.f.call(this, b[c])
                            }
                        m.flush()
                    }})
            }, b.afterLoad(t.fetchAndRender), a(t)
        })
    });
    provide("dom/textsize", function(a) {
        function c(a, b, c) {
            var d = [], e = 0, f;
            for (; f = c[e]; e++)
                d.push(f[0]), d.push(f[1]);
            return a + b + d.join(":")
        }
        function d(a) {
            var b = a || "";
            return b.replace(/([A-Z])/g, function(a) {
                return"-" + a.toLowerCase()
            })
        }
        var b = {};
        a(function(a, e, f) {
            var g = document.createElement("span"), h = {}, i = "", j, k = 0, l = 0, m = [];
            f = f || [], e = e || "", i = c(a, e, f);
            if (b[i])
                return b[i];
            g.className = e + " twitter-measurement";
            try {
                for (; j = f[k]; k++)
                    g.style[j[0]] = j[1]
            } catch (n) {
                for (; j = f[l]; l++)
                    m.push(d(j[0]) + ":" + j[1]);
                g.setAttribute("style", m.join(";") + ";")
            }
            return g.innerHTML = a, document.body.appendChild(g), h.width = g.clientWidth || g.offsetWidth, h.height = g.clientHeight || g.offsetHeight, document.body.removeChild(g), delete g, b[i] = h
        })
    });
    provide("tfw/widget/tweetbase", function(a) {
        using("util/util", "tfw/widget/base", "util/querystring", "util/twitter", "util/uri", function(b, c, d, e, f) {
            function i(a) {
                if (!a)
                    return;
                var b;
                c.apply(this, [a]), b = this.params(), this.text = b.text || this.dataAttr("text"), this.text && /\+/.test(this.text) && !/ /.test(this.text) && (this.text = this.text.replace(/\+/g, " ")), this.align = b.align || this.dataAttr("align") || "", this.via = b.via || this.dataAttr("via"), this.placeid = b.placeid || this.dataAttr("placeid"), this.hashtags = b.hashtags || this.dataAttr("hashtags"), this.screen_name = e.screenName(b.screen_name || b.screenName || this.dataAttr("button-screen-name")), this.url = b.url || this.dataAttr("url")
            }
            var g = document.title, h = encodeURI(location.href);
            i.prototype = new c, b.aug(i.prototype, {parameters: function() {
                    var a = {text: this.text, url: this.url, related: this.related, lang: this.lang, placeid: this.placeid, original_referer: location.href, id: this.id, screen_name: this.screen_name, hashtags: this.hashtags, dnt: this.dnt, _: +(new Date)};
                    return b.compact(a), d.encode(a)
                }}), a(i)
        })
    });
    provide("tfw/widget/tweetbutton", function(a) {
        using("tfw/widget/tweetbase", "util/util", "util/querystring", "util/uri", "util/twitter", "dom/textsize", function(b, c, d, e, f, g) {
            var h = document.title, i = encodeURI(location.href), j = ["vertical", "horizontal", "none"], k = function(a) {
                b.apply(this, [a]);
                var d = this.params(), g = d.count || this.dataAttr("count"), k = d.size || this.dataAttr("size"), l = e.getScreenNameFromPage();
                if (d.type == "hashtag" || ~c.indexOf(this.classAttr, "twitter-hashtag-button"))
                    this.type = "hashtag";
                else if (d.type == "mention" || ~c.indexOf(this.classAttr, "twitter-mention-button"))
                    this.type = "mention";
                this.counturl = d.counturl || this.dataAttr("counturl"), this.searchlink = d.searchlink || this.dataAttr("searchlink"), this.button_hashtag = f.hashTag(d.button_hashtag || d.hashtag || this.dataAttr("button-hashtag"), !1), this.size = k == "large" ? "l" : "m", this.type ? (this.count = "none", l && (this.related = this.related ? l + "," + this.related : l)) : (this.text = this.text || h, this.url = this.url || e.getCanonicalURL() || i, this.count = ~c.indexOf(j, g) ? g : "horizontal", this.count = this.count == "vertical" && this.size == "l" ? "none" : this.count, this.via = this.via || l)
            };
            k.prototype = new b, c.aug(k.prototype, {parameters: function() {
                    var a = {text: this.text, url: this.url, via: this.via, related: this.related, count: this.count, lang: this.lang, counturl: this.counturl, searchlink: this.searchlink, placeid: this.placeid, original_referer: location.href, id: this.id, size: this.size, type: this.type, screen_name: this.screen_name, button_hashtag: this.button_hashtag, hashtags: this.hashtags, align: this.align, dnt: this.dnt, _: +(new Date)};
                    return c.compact(a), d.encode(a)
                }, height: function() {
                    return this.count == "vertical" ? 62 : this.size == "m" ? 20 : 28
                }, width: function() {
                    var a = {ver: 8, cnt: 14, btn: 24, xlcnt: 18, xlbtn: 38}, b = this.count == "vertical", d = this.type == "hashtag" && this.button_hashtag ? "Tweet %{hashtag}" : this.type == "mention" && this.screen_name ? "Tweet to %{name}" : "Tweet", e = this._(d, {name: "@" + this.screen_name, hashtag: "#" + this.button_hashtag}), f = this._("K"), h = this._("100K+"), i = (b ? "8888" : "88888") + f, j = 0, k = 0, l = 0, m = 0, n = this.styles.base, o = n;
                    return~c.indexOf(["ja", "ko"], this.lang) ? i += this._("10k unit") : i = i.length > h.length ? i : h, b ? (o = n.concat(this.styles.vbubble), m = a.ver, l = a.btn) : this.size == "l" ? (n = o = n.concat(this.styles.large), l = a.xlbtn, m = a.xlcnt) : (l = a.btn, m = a.cnt), this.count != "none" && (k = g(i, "", o).width + m), j = g(e, "", n.concat(this.styles.button)).width + l, b ? j > k ? j : k : this.calculatedWidth = j + k
                }, render: function(a, b) {
                    var c = twttr.widgets.config.assetUrl() + "/widgets/tweet_button.1368146021.html#" + this.parameters();
                    this.count && this.classAttr.push("twitter-count-" + this.count), this.element = this.create(c, this.dimensions(), {title: this._("Twitter Tweet Button")}), b && b(this.element)
                }}), a(k)
        })
    });
    provide("tfw/widget/follow", function(a) {
        using("util/util", "tfw/widget/base", "util/querystring", "util/uri", "util/twitter", "dom/textsize", function(b, c, d, e, f, g) {
            function h(a) {
                if (!a)
                    return;
                var b, d, e, g, h;
                c.apply(this, [a]), b = this.params(), d = b.size || this.dataAttr("size"), e = b.showScreenName || this.dataAttr("show-screen-name"), h = b.count || this.dataAttr("count"), this.classAttr.push("twitter-follow-button"), this.showScreenName = e != "false", this.showCount = b.showCount !== !1 && this.dataAttr("show-count") != "false", h == "none" && (this.showCount = !1), this.explicitWidth = b.width || this.dataAttr("width") || "", this.screenName = b.screen_name || b.screenName || f.screenName(this.attr("href")), this.preview = b.preview || this.dataAttr("preview") || "", this.align = b.align || this.dataAttr("align") || "", this.size = d == "large" ? "l" : "m"
            }
            h.prototype = new c, b.aug(h.prototype, {parameters: function() {
                    var a = {screen_name: this.screenName, lang: this.lang, show_count: this.showCount, show_screen_name: this.showScreenName, align: this.align, id: this.id, preview: this.preview, size: this.size, dnt: this.dnt, _: +(new Date)};
                    return b.compact(a), d.encode(a)
                }, render: function(a, b) {
                    if (!this.screenName)
                        return;
                    var c = twttr.widgets.config.assetUrl() + "/widgets/follow_button.1368146021.html#" + this.parameters();
                    this.element = this.create(c, this.dimensions(), {title: this._("Twitter Follow Button")}), b && b(this.element)
                }, width: function() {
                    if (this.calculatedWidth)
                        return this.calculatedWidth;
                    if (this.explicitWidth)
                        return this.explicitWidth;
                    var a = {cnt: 13, btn: 24, xlcnt: 22, xlbtn: 38}, c = this.showScreenName ? "Follow %{screen_name}" : "Follow", d = this._(c, {screen_name: "@" + this.screenName}), e = ~b.indexOf(["ja", "ko"], this.lang) ? this._("10k unit") : this._("M"), f = this._("%{followers_count} followers", {followers_count: "88888" + e}), h = 0, i = 0, j, k, l = this.styles.base;
                    return this.size == "l" ? (l = l.concat(this.styles.large), j = a.xlbtn, k = a.xlcnt) : (j = a.btn, k = a.cnt), this.showCount && (i = g(f, "", l).width + k), h = g(d, "", l.concat(this.styles.button)).width + j, this.calculatedWidth = h + i
                }}), a(h)
        })
    });
    !function() {
        function a(a) {
            return(a || !/^http\:$/.test(window.location.protocol)) && !twttr.ignoreSSL ? "https" : "http"
        }
        window.twttr = window.twttr || {}, twttr.host = twttr.host || "platform.twitter.com";
        if (twttr.widgets && twttr.widgets.loaded)
            return twttr.widgets.load(), !1;
        if (twttr.init)
            return!1;
        twttr.init = !0, twttr._e = twttr._e || [], twttr.ready = twttr.ready || function(a) {
            twttr.widgets && twttr.widgets.loaded ? a(twttr) : twttr._e.push(a)
        }, using.path.length || (using.path = a() + "://" + twttr.host + "/js"), twttr.ignoreSSL = twttr.ignoreSSL || !1;
        var b = [];
        twttr.events = {bind: function(a, c) {
                return b.push([a, c])
            }}, using("util/domready", function(c) {
            c(function() {
                using("tfw/widget/base", "tfw/widget/follow", "tfw/widget/tweetbutton", "tfw/widget/embed", "tfw/widget/timeline", "tfw/widget/intent", "tfw/util/globals", "util/events", "util/util", function(c, d, e, f, g, h, i, j, k) {
                    function q(b) {
                        var c = twttr.host;
                        return a(b) == "https" && twttr.secureHost && (c = twttr.secureHost), a(b) + "://" + c
                    }
                    function r() {
                        using("tfw/hub/client", function(a) {
                            twttr.events.hub = a.init(n), a.init(n, !0)
                        })
                    }
                    var l, m, n = {widgets: {"a.twitter-share-button": e, "a.twitter-mention-button": e, "a.twitter-hashtag-button": e, "a.twitter-follow-button": d, "blockquote.twitter-tweet": f, "a.twitter-timeline": g, body: h}}, o = twttr.events && twttr.events.hub ? twttr.events : {}, p;
                    i.init(), n.assetUrl = q, twttr.widgets = twttr.widgets || {}, k.aug(twttr.widgets, {config: {assetUrl: q}, load: function(a) {
                            c.init(n), c.embed(a), twttr.widgets.loaded = !0
                        }, createShareButton: function(a, b, c, d) {
                            if (!a || !b)
                                return c && c(!1);
                            d = k.aug({}, d || {}, {url: a, targetEl: b}), (new e(d)).render(n, c)
                        }, createHashtagButton: function(a, b, c, d) {
                            if (!a || !b)
                                return d && d(!1);
                            c = k.aug({}, c || {}, {hashtag: a, targetEl: b, type: "hashtag"}), (new e(c)).render(n, d)
                        }, createMentionButton: function(a, b, c, d) {
                            if (!a || !b)
                                return c && c(!1);
                            d = k.aug({}, d || {}, {screenName: a, targetEl: b, type: "mention"}), (new e(d)).render(n, c)
                        }, createFollowButton: function(a, b, c, e) {
                            if (!a || !b)
                                return c && c(!1);
                            e = k.aug({}, e || {}, {screenName: a, targetEl: b}), (new d(e)).render(n, c)
                        }, createTweet: function(a, b, c, d) {
                            if (!a || !b)
                                return c && c(!1);
                            d = k.aug({}, d || {}, {tweetId: a, targetEl: b}), (new f(d)).render(n, c), f.fetchAndRender()
                        }, createTimeline: function(a, b, c, d) {
                            if (!a || !b)
                                return c && c(!1);
                            d = k.aug({}, d || {}, {widgetId: a, targetEl: b}), (new g(d)).render(n, c)
                        }}), k.aug(twttr.events, o, j.Emitter), p = twttr.events.bind, twttr.events.bind = function(a, b) {
                        r(), this.bind = p, this.bind(a, b)
                    };
                    for (l = 0; m = b[l]; l++)
                        twttr.events.bind(m[0], m[1]);
                    for (l = 0; m = twttr._e[l]; l++)
                        m(twttr);
                    twttr.ready = function(a) {
                        a(twttr)
                    }, /twitter\.com(\:\d+)?$/.test(document.location.host) && (twttr.widgets.createTimelinePreview = function(a, b, c) {
                        if (!n || !b)
                            return c && c(!1);
                        (new g({previewParams: a, targetEl: b, linkColor: a.link_color, theme: a.theme, height: a.height})).render(n, c)
                    }), twttr.widgets.createTweetEmbed = twttr.widgets.createTweet, twttr.widgets.load()
                })
            })
        })
    }()
});