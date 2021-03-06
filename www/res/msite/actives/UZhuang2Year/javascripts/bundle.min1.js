function subject(){

    !function (e, t) {
        "use strict";
        "object" == typeof module && "object" == typeof module.exports ? module.exports = e.document ? t(e, !0) : function (e) {
                    if (!e.document)throw new Error("jQuery requires a window with a document");
                    return t(e)
                } : t(e)
    }("undefined" != typeof window ? window : this, function (e, t) {
        "use strict";
        function n(e, t) {
            t = t || ne;
            var n = t.createElement("script");
            n.text = e, t.head.appendChild(n).parentNode.removeChild(n)
        }

        function r(e) {
            var t = !!e && "length" in e && e.length, n = he.type(e);
            return "function" !== n && !he.isWindow(e) && ("array" === n || 0 === t || "number" == typeof t && t > 0 && t - 1 in e)
        }

        function i(e, t) {
            return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase()
        }

        function a(e, t, n) {
            return he.isFunction(t) ? he.grep(e, function (e, r) {
                    return !!t.call(e, r, e) !== n
                }) : t.nodeType ? he.grep(e, function (e) {
                        return e === t !== n
                    }) : "string" != typeof t ? he.grep(e, function (e) {
                            return se.call(t, e) > -1 !== n
                        }) : Se.test(t) ? he.filter(t, e, n) : (t = he.filter(t, e), he.grep(e, function (e) {
                                return se.call(t, e) > -1 !== n && 1 === e.nodeType
                            }))
        }

        function o(e, t) {
            for (; (e = e[t]) && 1 !== e.nodeType;);
            return e
        }

        function s(e) {
            var t = {};
            return he.each(e.match(Ne) || [], function (e, n) {
                t[n] = !0
            }), t
        }

        function l(e) {
            return e
        }

        function u(e) {
            throw e
        }

        function c(e, t, n, r) {
            var i;
            try {
                e && he.isFunction(i = e.promise) ? i.call(e).done(t).fail(n) : e && he.isFunction(i = e.then) ? i.call(e, t, n) : t.apply(void 0, [e].slice(r))
            } catch (e) {
                n.apply(void 0, [e])
            }
        }

        function p() {
            ne.removeEventListener("DOMContentLoaded", p), e.removeEventListener("load", p), he.ready()
        }

        function d() {
            this.expando = he.expando + d.uid++
        }

        function f(e) {
            return "true" === e || "false" !== e && ("null" === e ? null : e === +e + "" ? +e : He.test(e) ? JSON.parse(e) : e)
        }

        function h(e, t, n) {
            var r;
            if (void 0 === n && 1 === e.nodeType)if (r = "data-" + t.replace(qe, "-$&").toLowerCase(), "string" == typeof(n = e.getAttribute(r))) {
                try {
                    n = f(n)
                } catch (e) {
                }
                je.set(e, t, n)
            } else n = void 0;
            return n
        }

        function m(e, t, n, r) {
            var i, a = 1, o = 20, s = r ? function () {
                    return r.cur()
                } : function () {
                    return he.css(e, t, "")
                }, l = s(), u = n && n[3] || (he.cssNumber[t] ? "" : "px"), c = (he.cssNumber[t] || "px" !== u && +l) && Be.exec(he.css(e, t));
            if (c && c[3] !== u) {
                u = u || c[3], n = n || [], c = +l || 1;
                do {
                    a = a || ".5", c /= a, he.style(e, t, c + u)
                } while (a !== (a = s() / l) && 1 !== a && --o)
            }
            return n && (c = +c || +l || 0, i = n[1] ? c + (n[1] + 1) * n[2] : +n[2], r && (r.unit = u, r.start = c, r.end = i)), i
        }

        function g(e) {
            var t, n = e.ownerDocument, r = e.nodeName, i = Xe[r];
            return i || (t = n.body.appendChild(n.createElement(r)), i = he.css(t, "display"), t.parentNode.removeChild(t), "none" === i && (i = "block"), Xe[r] = i, i)
        }

        function v(e, t) {
            for (var n, r, i = [], a = 0, o = e.length; a < o; a++)r = e[a], r.style && (n = r.style.display, t ? ("none" === n && (i[a] = Ie.get(r, "display") || null, i[a] || (r.style.display = "")), "" === r.style.display && Fe(r) && (i[a] = g(r))) : "none" !== n && (i[a] = "none", Ie.set(r, "display", n)));
            for (a = 0; a < o; a++)null != i[a] && (e[a].style.display = i[a]);
            return e
        }

        function y(e, t) {
            var n;
            return n = void 0 !== e.getElementsByTagName ? e.getElementsByTagName(t || "*") : void 0 !== e.querySelectorAll ? e.querySelectorAll(t || "*") : [], void 0 === t || t && i(e, t) ? he.merge([e], n) : n
        }

        function x(e, t) {
            for (var n = 0, r = e.length; n < r; n++)Ie.set(e[n], "globalEval", !t || Ie.get(t[n], "globalEval"))
        }

        function w(e, t, n, r, i) {
            for (var a, o, s, l, u, c, p = t.createDocumentFragment(), d = [], f = 0, h = e.length; f < h; f++)if ((a = e[f]) || 0 === a)if ("object" === he.type(a)) he.merge(d, a.nodeType ? [a] : a); else if (Ve.test(a)) {
                for (o = o || p.appendChild(t.createElement("div")), s = (Ge.exec(a) || ["", ""])[1].toLowerCase(), l = _e[s] || _e._default, o.innerHTML = l[1] + he.htmlPrefilter(a) + l[2], c = l[0]; c--;)o = o.lastChild;
                he.merge(d, o.childNodes), o = p.firstChild, o.textContent = ""
            } else d.push(t.createTextNode(a));
            for (p.textContent = "", f = 0; a = d[f++];)if (r && he.inArray(a, r) > -1) i && i.push(a); else if (u = he.contains(a.ownerDocument, a), o = y(p.appendChild(a), "script"), u && x(o), n)for (c = 0; a = o[c++];)$e.test(a.type || "") && n.push(a);
            return p
        }

        function b() {
            return !0
        }

        function T() {
            return !1
        }

        function C() {
            try {
                return ne.activeElement
            } catch (e) {
            }
        }

        function S(e, t, n, r, i, a) {
            var o, s;
            if ("object" == typeof t) {
                "string" != typeof n && (r = r || n, n = void 0);
                for (s in t)S(e, s, n, r, t[s], a);
                return e
            }
            if (null == r && null == i ? (i = n, r = n = void 0): null==i && ("string" == typeof n ? (i = r, r = void 0) : (i = r, r = n, n = void 0)), !1 === i
        )
            i = T;
        else
            if (!i)return e;
            return 1 === a && (o = i, i = function (e) {
                return he().off(e), o.apply(this, arguments)
            }, i.guid = o.guid || (o.guid = he.guid++)), e.each(function () {
                he.event.add(this, t, i, r, n)
            })
        }

        function E(e, t) {
            return i(e, "table") && i(11 !== t.nodeType ? t : t.firstChild, "tr") ? he(">tbody", e)[0] || e : e
        }

        function k(e) {
            return e.type = (null !== e.getAttribute("type")) + "/" + e.type, e
        }

        function D(e) {
            var t = nt.exec(e.type);
            return t ? e.type = t[1] : e.removeAttribute("type"), e
        }

        function M(e, t) {
            var n, r, i, a, o, s, l, u;
            if (1 === t.nodeType) {
                if (Ie.hasData(e) && (a = Ie.access(e), o = Ie.set(t, a), u = a.events)) {
                    delete o.handle, o.events = {};
                    for (i in u)for (n = 0, r = u[i].length; n < r; n++)he.event.add(t, i, u[i][n])
                }
                je.hasData(e) && (s = je.access(e), l = he.extend({}, s), je.set(t, l))
            }
        }

        function N(e, t) {
            var n = t.nodeName.toLowerCase();
            "input" === n && Ye.test(e.type) ? t.checked = e.checked : "input" !== n && "textarea" !== n || (t.defaultValue = e.defaultValue)
        }

        function A(e, t, r, i) {
            t = ae.apply([], t);
            var a, o, s, l, u, c, p = 0, d = e.length, f = d - 1, h = t[0], m = he.isFunction(h);
            if (m || d > 1 && "string" == typeof h && !fe.checkClone && tt.test(h))return e.each(function (n) {
                var a = e.eq(n);
                m && (t[0] = h.call(this, n, a.html())), A(a, t, r, i)
            });
            if (d && (a = w(t, e[0].ownerDocument, !1, e, i), o = a.firstChild, 1 === a.childNodes.length && (a = o), o || i)) {
                for (s = he.map(y(a, "script"), k), l = s.length; p < d; p++)u = a, p !== f && (u = he.clone(u, !0, !0), l && he.merge(s, y(u, "script"))), r.call(e[p], u, p);
                if (l)for (c = s[s.length - 1].ownerDocument, he.map(s, D), p = 0; p < l; p++)u = s[p], $e.test(u.type || "") && !Ie.access(u, "globalEval") && he.contains(c, u) && (u.src ? he._evalUrl && he._evalUrl(u.src) : n(u.textContent.replace(rt, ""), c))
            }
            return e
        }

        function L(e, t, n) {
            for (var r, i = t ? he.filter(t, e) : e, a = 0; null != (r = i[a]); a++)n || 1 !== r.nodeType || he.cleanData(y(r)), r.parentNode && (n && he.contains(r.ownerDocument, r) && x(y(r, "script")), r.parentNode.removeChild(r));
            return e
        }

        function P(e, t, n) {
            var r, i, a, o, s = e.style;
            return n = n || ot(e), n && (o = n.getPropertyValue(t) || n[t], "" !== o || he.contains(e.ownerDocument, e) || (o = he.style(e, t)), !fe.pixelMarginRight() && at.test(o) && it.test(t) && (r = s.width, i = s.minWidth, a = s.maxWidth, s.minWidth = s.maxWidth = s.width = o, o = n.width, s.width = r, s.minWidth = i, s.maxWidth = a)), void 0 !== o ? o + "" : o
        }

        function z(e, t) {
            return {
                get: function () {
                    return e() ? void delete this.get : (this.get = t).apply(this, arguments)
                }
            }
        }

        function I(e) {
            if (e in dt)return e;
            for (var t = e[0].toUpperCase() + e.slice(1), n = pt.length; n--;)if ((e = pt[n] + t) in dt)return e
        }

        function j(e) {
            var t = he.cssProps[e];
            return t || (t = he.cssProps[e] = I(e) || e), t
        }

        function H(e, t, n) {
            var r = Be.exec(t);
            return r ? Math.max(0, r[2] - (n || 0)) + (r[3] || "px") : t
        }

        function q(e, t, n, r, i) {
            var a, o = 0;
            for (a = n === (r ? "border" : "content") ? 4 : "width" === t ? 1 : 0; a < 4; a += 2)"margin" === n && (o += he.css(e, n + Re[a], !0, i)), r ? ("content" === n && (o -= he.css(e, "padding" + Re[a], !0, i)), "margin" !== n && (o -= he.css(e, "border" + Re[a] + "Width", !0, i))) : (o += he.css(e, "padding" + Re[a], !0, i), "padding" !== n && (o += he.css(e, "border" + Re[a] + "Width", !0, i)));
            return o
        }

        function O(e, t, n) {
            var r, i = ot(e), a = P(e, t, i), o = "border-box" === he.css(e, "boxSizing", !1, i);
            return at.test(a) ? a : (r = o && (fe.boxSizingReliable() || a === e.style[t]), "auto" === a && (a = e["offset" + t[0].toUpperCase() + t.slice(1)]), (a = parseFloat(a) || 0) + q(e, t, n || (o ? "border" : "content"), r, i) + "px")
        }

        function B(e, t, n, r, i) {
            return new B.prototype.init(e, t, n, r, i)
        }

        function R() {
            ht && (!1 === ne.hidden && e.requestAnimationFrame ? e.requestAnimationFrame(R) : e.setTimeout(R, he.fx.interval), he.fx.tick())
        }

        function F() {
            return e.setTimeout(function () {
                ft = void 0
            }), ft = he.now()
        }

        function W(e, t) {
            var n, r = 0, i = {height: e};
            for (t = t ? 1 : 0; r < 4; r += 2 - t)n = Re[r], i["margin" + n] = i["padding" + n] = e;
            return t && (i.opacity = i.width = e), i
        }

        function X(e, t, n) {
            for (var r, i = ($.tweeners[t] || []).concat($.tweeners["*"]), a = 0, o = i.length; a < o; a++)if (r = i[a].call(n, t, e))return r
        }

        function Y(e, t, n) {
            var r, i, a, o, s, l, u, c, p = "width" in t || "height" in t, d = this, f = {}, h = e.style, m = e.nodeType && Fe(e), g = Ie.get(e, "fxshow");
            n.queue || (o = he._queueHooks(e, "fx"), null == o.unqueued && (o.unqueued = 0, s = o.empty.fire, o.empty.fire = function () {
                o.unqueued || s()
            }), o.unqueued++, d.always(function () {
                d.always(function () {
                    o.unqueued--, he.queue(e, "fx").length || o.empty.fire()
                })
            }));
            for (r in t)if (i = t[r], mt.test(i)) {
                if (delete t[r], a = a || "toggle" === i, i === (m ? "hide" : "show")) {
                    if ("show" !== i || !g || void 0 === g[r])continue;
                    m = !0
                }
                f[r] = g && g[r] || he.style(e, r)
            }
            if ((l = !he.isEmptyObject(t)) || !he.isEmptyObject(f)) {
                p && 1 === e.nodeType && (n.overflow = [h.overflow, h.overflowX, h.overflowY], u = g && g.display, null == u && (u = Ie.get(e, "display")), c = he.css(e, "display"), "none" === c && (u ? c = u : (v([e], !0), u = e.style.display || u, c = he.css(e, "display"), v([e]))), ("inline" === c || "inline-block" === c && null != u) && "none" === he.css(e, "float") && (l || (d.done(function () {
                    h.display = u
                }), null == u && (c = h.display, u = "none" === c ? "" : c)), h.display = "inline-block")), n.overflow && (h.overflow = "hidden", d.always(function () {
                    h.overflow = n.overflow[0], h.overflowX = n.overflow[1], h.overflowY = n.overflow[2]
                })), l = !1;
                for (r in f)l || (g ? "hidden" in g && (m = g.hidden) : g = Ie.access(e, "fxshow", {display: u}), a && (g.hidden = !m), m && v([e], !0), d.done(function () {
                    m || v([e]), Ie.remove(e, "fxshow");
                    for (r in f)he.style(e, r, f[r])
                })), l = X(m ? g[r] : 0, r, d), r in g || (g[r] = l.start, m && (l.end = l.start, l.start = 0))
            }
        }

        function G(e, t) {
            var n, r, i, a, o;
            for (n in e)if (r = he.camelCase(n), i = t[r], a = e[n], Array.isArray(a) && (i = a[1], a = e[n] = a[0]), n !== r && (e[r] = a, delete e[n]), (o = he.cssHooks[r]) && "expand" in o) {
                a = o.expand(a), delete e[r];
                for (n in a)n in e || (e[n] = a[n], t[n] = i)
            } else t[r] = i
        }

        function $(e, t, n) {
            var r, i, a = 0, o = $.prefilters.length, s = he.Deferred().always(function () {
                delete l.elem
            }), l = function () {
                if (i)return !1;
                for (var t = ft || F(), n = Math.max(0, u.startTime + u.duration - t), r = n / u.duration || 0, a = 1 - r, o = 0, l = u.tweens.length; o < l; o++)u.tweens[o].run(a);
                return s.notifyWith(e, [u, a, n]), a < 1 && l ? n : (l || s.notifyWith(e, [u, 1, 0]), s.resolveWith(e, [u]), !1)
            }, u = s.promise({
                elem: e,
                props: he.extend({}, t),
                opts: he.extend(!0, {specialEasing: {}, easing: he.easing._default}, n),
                originalProperties: t,
                originalOptions: n,
                startTime: ft || F(),
                duration: n.duration,
                tweens: [],
                createTween: function (t, n) {
                    var r = he.Tween(e, u.opts, t, n, u.opts.specialEasing[t] || u.opts.easing);
                    return u.tweens.push(r), r
                },
                stop: function (t) {
                    var n = 0, r = t ? u.tweens.length : 0;
                    if (i)return this;
                    for (i = !0; n < r; n++)u.tweens[n].run(1);
                    return t ? (s.notifyWith(e, [u, 1, 0]), s.resolveWith(e, [u, t])) : s.rejectWith(e, [u, t]), this
                }
            }), c = u.props;
            for (G(c, u.opts.specialEasing); a < o; a++)if (r = $.prefilters[a].call(u, e, c, u.opts))return he.isFunction(r.stop) && (he._queueHooks(u.elem, u.opts.queue).stop = he.proxy(r.stop, r)), r;
            return he.map(c, X, u), he.isFunction(u.opts.start) && u.opts.start.call(e, u), u.progress(u.opts.progress).done(u.opts.done, u.opts.complete).fail(u.opts.fail).always(u.opts.always), he.fx.timer(he.extend(l, {
                elem: e,
                anim: u,
                queue: u.opts.queue
            })), u
        }

        function _(e) {
            return (e.match(Ne) || []).join(" ")
        }

        function V(e) {
            return e.getAttribute && e.getAttribute("class") || ""
        }

        function U(e, t, n, r) {
            var i;
            if (Array.isArray(t)) he.each(t, function (t, i) {
                n || kt.test(e) ? r(e, i) : U(e + "[" + ("object" == typeof i && null != i ? t : "") + "]", i, n, r)
            }); else if (n || "object" !== he.type(t)) r(e, t); else for (i in t)U(e + "[" + i + "]", t[i], n, r)
        }

        function K(e) {
            return function (t, n) {
                "string" != typeof t && (n = t, t = "*");
                var r, i = 0, a = t.toLowerCase().match(Ne) || [];
                if (he.isFunction(n))for (; r = a[i++];)"+" === r[0] ? (r = r.slice(1) || "*", (e[r] = e[r] || []).unshift(n)) : (e[r] = e[r] || []).push(n)
            }
        }

        function Q(e, t, n, r) {
            function i(s) {
                var l;
                return a[s] = !0, he.each(e[s] || [], function (e, s) {
                    var u = s(t, n, r);
                    return "string" != typeof u || o || a[u] ? o ? !(l = u) : void 0 : (t.dataTypes.unshift(u), i(u), !1)
                }), l
            }

            var a = {}, o = e === Ot;
            return i(t.dataTypes[0]) || !a["*"] && i("*")
        }

        function J(e, t) {
            var n, r, i = he.ajaxSettings.flatOptions || {};
            for (n in t)void 0 !== t[n] && ((i[n] ? e : r || (r = {}))[n] = t[n]);
            return r && he.extend(!0, e, r), e
        }

        function Z(e, t, n) {
            for (var r, i, a, o, s = e.contents, l = e.dataTypes; "*" === l[0];)l.shift(), void 0 === r && (r = e.mimeType || t.getResponseHeader("Content-Type"));
            if (r)for (i in s)if (s[i] && s[i].test(r)) {
                l.unshift(i);
                break
            }
            if (l[0] in n) a = l[0]; else {
                for (i in n) {
                    if (!l[0] || e.converters[i + " " + l[0]]) {
                        a = i;
                        break
                    }
                    o || (o = i)
                }
                a = a || o
            }
            if (a)return a !== l[0] && l.unshift(a), n[a]
        }

        function ee(e, t, n, r) {
            var i, a, o, s, l, u = {}, c = e.dataTypes.slice();
            if (c[1])for (o in e.converters)u[o.toLowerCase()] = e.converters[o];
            for (a = c.shift(); a;)if (e.responseFields[a] && (n[e.responseFields[a]] = t), !l && r && e.dataFilter && (t = e.dataFilter(t, e.dataType)), l = a, a = c.shift())if ("*" === a) a = l; else if ("*" !== l && l !== a) {
                if (!(o = u[l + " " + a] || u["* " + a]))for (i in u)if (s = i.split(" "), s[1] === a && (o = u[l + " " + s[0]] || u["* " + s[0]])) {
                    !0 === o ? o = u[i] : !0 !== u[i] && (a = s[0], c.unshift(s[1]));
                    break
                }
                if (!0 !== o)if (o && e.throws) t = o(t); else try {
                    t = o(t)
                } catch (e) {
                    return {state: "parsererror", error: o ? e : "No conversion from " + l + " to " + a}
                }
            }
            return {state: "success", data: t}
        }

        var te = [], ne = e.document, re = Object.getPrototypeOf, ie = te.slice, ae = te.concat, oe = te.push, se = te.indexOf, le = {}, ue = le.toString, ce = le.hasOwnProperty, pe = ce.toString, de = pe.call(Object), fe = {}, he = function (e, t) {
            return new he.fn.init(e, t)
        }, me = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, ge = /^-ms-/, ve = /-([a-z])/g, ye = function (e, t) {
            return t.toUpperCase()
        };
        he.fn = he.prototype = {
            jquery: "3.2.1", constructor: he, length: 0, toArray: function () {
                return ie.call(this)
            }, get: function (e) {
                return null == e ? ie.call(this) : e < 0 ? this[e + this.length] : this[e]
            }, pushStack: function (e) {
                var t = he.merge(this.constructor(), e);
                return t.prevObject = this, t
            }, each: function (e) {
                return he.each(this, e)
            }, map: function (e) {
                return this.pushStack(he.map(this, function (t, n) {
                    return e.call(t, n, t)
                }))
            }, slice: function () {
                return this.pushStack(ie.apply(this, arguments))
            }, first: function () {
                return this.eq(0)
            }, last: function () {
                return this.eq(-1)
            }, eq: function (e) {
                var t = this.length, n = +e + (e < 0 ? t : 0);
                return this.pushStack(n >= 0 && n < t ? [this[n]] : [])
            }, end: function () {
                return this.prevObject || this.constructor()
            }, push: oe, sort: te.sort, splice: te.splice
        }, he.extend = he.fn.extend = function () {
            var e, t, n, r, i, a, o = arguments[0] || {}, s = 1, l = arguments.length, u = !1;
            for ("boolean" == typeof o && (u = o, o = arguments[s] || {}, s++), "object" == typeof o || he.isFunction(o) || (o = {}), s === l && (o = this, s--); s < l; s++)if (null != (e = arguments[s]))for (t in e)n = o[t], r = e[t], o !== r && (u && r && (he.isPlainObject(r) || (i = Array.isArray(r))) ? (i ? (i = !1, a = n && Array.isArray(n) ? n : []): a= n && he.isPlainObject(n) ? n : {}, o[t] = he.extend(u, a, r)) : void 0 !== r && (o[t] = r));
            return o
        }, he.extend({
            expando: "jQuery" + ("3.2.1" + Math.random()).replace(/\D/g, ""), isReady: !0, error: function (e) {
                throw new Error(e)
            }, noop: function () {
            }, isFunction: function (e) {
                return "function" === he.type(e)
            }, isWindow: function (e) {
                return null != e && e === e.window
            }, isNumeric: function (e) {
                var t = he.type(e);
                return ("number" === t || "string" === t) && !isNaN(e - parseFloat(e))
            }, isPlainObject: function (e) {
                var t, n;
                return !(!e || "[object Object]" !== ue.call(e)) && (!(t = re(e)) || "function" == typeof(n = ce.call(t, "constructor") && t.constructor) && pe.call(n) === de)
            }, isEmptyObject: function (e) {
                var t;
                for (t in e)return !1;
                return !0
            }, type: function (e) {
                return null == e ? e + "" : "object" == typeof e || "function" == typeof e ? le[ue.call(e)] || "object" : typeof e
            }, globalEval: function (e) {
                n(e)
            }, camelCase: function (e) {
                return e.replace(ge, "ms-").replace(ve, ye)
            }, each: function (e, t) {
                var n, i = 0;
                if (r(e))for (n = e.length; i < n && !1 !== t.call(e[i], i, e[i]); i++); else for (i in e)if (!1 === t.call(e[i], i, e[i]))break;
                return e
            }, trim: function (e) {
                return null == e ? "" : (e + "").replace(me, "")
            }, makeArray: function (e, t) {
                var n = t || [];
                return null != e && (r(Object(e)) ? he.merge(n, "string" == typeof e ? [e] : e) : oe.call(n, e)), n
            }, inArray: function (e, t, n) {
                return null == t ? -1 : se.call(t, e, n)
            }, merge: function (e, t) {
                for (var n = +t.length, r = 0, i = e.length; r < n; r++)e[i++] = t[r];
                return e.length = i, e
            }, grep: function (e, t, n) {
                for (var r = [], i = 0, a = e.length, o = !n; i < a; i++)!t(e[i], i) !== o && r.push(e[i]);
                return r
            }, map: function (e, t, n) {
                var i, a, o = 0, s = [];
                if (r(e))for (i = e.length; o < i; o++)null != (a = t(e[o], o, n)) && s.push(a); else for (o in e)null != (a = t(e[o], o, n)) && s.push(a);
                return ae.apply([], s)
            }, guid: 1, proxy: function (e, t) {
                var n, r, i;
                if ("string" == typeof t && (n = e[t], t = e, e = n), he.isFunction(e))return r = ie.call(arguments, 2), i = function () {
                    return e.apply(t || this, r.concat(ie.call(arguments)))
                }, i.guid = e.guid = e.guid || he.guid++, i
            }, now: Date.now, support: fe
        }), "function" == typeof Symbol && (he.fn[Symbol.iterator] = te[Symbol.iterator]), he.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "), function (e, t) {
            le["[object " + t + "]"] = t.toLowerCase()
        });
        var xe = function (e) {
            function t(e, t, n, r) {
                var i, a, o, s, l, c, d, f = t && t.ownerDocument, h = t ? t.nodeType : 9;
                if (n = n || [], "string" != typeof e || !e || 1 !== h && 9 !== h && 11 !== h)return n;
                if (!r && ((t ? t.ownerDocument || t : B) !== L && A(t), t = t || L, z)) {
                    if (11 !== h && (l = me.exec(e)))if (i = l[1]) {
                        if (9 === h) {
                            if (!(o = t.getElementById(i)))return n;
                            if (o.id === i)return n.push(o), n
                        } else if (f && (o = f.getElementById(i)) && q(t, o) && o.id === i)return n.push(o), n
                    } else {
                        if (l[2])return K.apply(n, t.getElementsByTagName(e)), n;
                        if ((i = l[3]) && w.getElementsByClassName && t.getElementsByClassName)return K.apply(n, t.getElementsByClassName(i)), n
                    }
                    if (w.qsa && !Y[e + " "] && (!I || !I.test(e))) {
                        if (1 !== h) f = t, d = e; else if ("object" !== t.nodeName.toLowerCase()) {
                            for ((s = t.getAttribute("id")) ? s = s.replace(xe, we) : t.setAttribute("id", s = O), c = S(e), a = c.length; a--;)c[a] = "#" + s + " " + p(c[a]);
                            d = c.join(","), f = ge.test(e) && u(t.parentNode) || t
                        }
                        if (d)try {
                            return K.apply(n, f.querySelectorAll(d)), n
                        } catch (e) {
                        } finally {
                            s === O && t.removeAttribute("id")
                        }
                    }
                }
                return k(e.replace(ae, "$1"), t, n, r)
            }

            function n() {
                function e(n, r) {
                    return t.push(n + " ") > b.cacheLength && delete e[t.shift()], e[n + " "] = r
                }

                var t = [];
                return e
            }

            function r(e) {
                return e[O] = !0, e
            }

            function i(e) {
                var t = L.createElement("fieldset");
                try {
                    return !!e(t)
                } catch (e) {
                    return !1
                } finally {
                    t.parentNode && t.parentNode.removeChild(t), t = null
                }
            }

            function a(e, t) {
                for (var n = e.split("|"), r = n.length; r--;)b.attrHandle[n[r]] = t
            }

            function o(e, t) {
                var n = t && e, r = n && 1 === e.nodeType && 1 === t.nodeType && e.sourceIndex - t.sourceIndex;
                if (r)return r;
                if (n)for (; n = n.nextSibling;)if (n === t)return -1;
                return e ? 1 : -1
            }

            function s(e) {
                return function (t) {
                    return "form" in t ? t.parentNode && !1 === t.disabled ? "label" in t ? "label" in t.parentNode ? t.parentNode.disabled === e : t.disabled === e : t.isDisabled === e || t.isDisabled !== !e && Te(t) === e : t.disabled === e : "label" in t && t.disabled === e
                }
            }

            function l(e) {
                return r(function (t) {
                    return t = +t, r(function (n, r) {
                        for (var i, a = e([], n.length, t), o = a.length; o--;)n[i = a[o]] && (n[i] = !(r[i] = n[i]))
                    })
                })
            }

            function u(e) {
                return e && void 0 !== e.getElementsByTagName && e
            }

            function c() {
            }

            function p(e) {
                for (var t = 0, n = e.length, r = ""; t < n; t++)r += e[t].value;
                return r
            }

            function d(e, t, n) {
                var r = t.dir, i = t.next, a = i || r, o = n && "parentNode" === a, s = F++;
                return t.first ? function (t, n, i) {
                        for (; t = t[r];)if (1 === t.nodeType || o)return e(t, n, i);
                        return !1
                    } : function (t, n, l) {
                        var u, c, p, d = [R, s];
                        if (l) {
                            for (; t = t[r];)if ((1 === t.nodeType || o) && e(t, n, l))return !0
                        } else for (; t = t[r];)if (1 === t.nodeType || o)if (p = t[O] || (t[O] = {}), c = p[t.uniqueID] || (p[t.uniqueID] = {}), i && i === t.nodeName.toLowerCase()) t = t[r] || t; else {
                            if ((u = c[a]) && u[0] === R && u[1] === s)return d[2] = u[2];
                            if (c[a] = d, d[2] = e(t, n, l))return !0
                        }
                        return !1
                    }
            }

            function f(e) {
                return e.length > 1 ? function (t, n, r) {
                        for (var i = e.length; i--;)if (!e[i](t, n, r))return !1;
                        return !0
                    } : e[0]
            }

            function h(e, n, r) {
                for (var i = 0, a = n.length; i < a; i++)t(e, n[i], r);
                return r
            }

            function m(e, t, n, r, i) {
                for (var a, o = [], s = 0, l = e.length, u = null != t; s < l; s++)(a = e[s]) && (n && !n(a, r, i) || (o.push(a), u && t.push(s)));
                return o
            }

            function g(e, t, n, i, a, o) {
                return i && !i[O] && (i = g(i)), a && !a[O] && (a = g(a, o)), r(function (r, o, s, l) {
                    var u, c, p, d = [], f = [], g = o.length, v = r || h(t || "*", s.nodeType ? [s] : s, []), y = !e || !r && t ? v : m(v, d, e, s, l), x = n ? a || (r ? e : g || i) ? [] : o : y;
                    if (n && n(y, x, s, l), i)for (u = m(x, f), i(u, [], s, l), c = u.length; c--;)(p = u[c]) && (x[f[c]] = !(y[f[c]] = p));
                    if (r) {
                        if (a || e) {
                            if (a) {
                                for (u = [], c = x.length; c--;)(p = x[c]) && u.push(y[c] = p);
                                a(null, x = [], u, l)
                            }
                            for (c = x.length; c--;)(p = x[c]) && (u = a ? J(r, p) : d[c]) > -1 && (r[u] = !(o[u] = p))
                        }
                    } else x = m(x === o ? x.splice(g, x.length) : x), a ? a(null, o, x, l) : K.apply(o, x)
                })
            }

            function v(e) {
                for (var t, n, r, i = e.length, a = b.relative[e[0].type], o = a || b.relative[" "], s = a ? 1 : 0, l = d(function (e) {
                    return e === t
                }, o, !0), u = d(function (e) {
                    return J(t, e) > -1
                }, o, !0), c = [function (e, n, r) {
                    var i = !a && (r || n !== D) || ((t = n).nodeType ? l(e, n, r) : u(e, n, r));
                    return t = null, i
                }]; s < i; s++)if (n = b.relative[e[s].type]) c = [d(f(c), n)]; else {
                    if (n = b.filter[e[s].type].apply(null, e[s].matches), n[O]) {
                        for (r = ++s; r < i && !b.relative[e[r].type]; r++);
                        return g(s > 1 && f(c), s > 1 && p(e.slice(0, s - 1).concat({value: " " === e[s - 2].type ? "*" : ""})).replace(ae, "$1"), n, s < r && v(e.slice(s, r)), r < i && v(e = e.slice(r)), r < i && p(e))
                    }
                    c.push(n)
                }
                return f(c)
            }

            function y(e, n) {
                var i = n.length > 0, a = e.length > 0, o = function (r, o, s, l, u) {
                    var c, p, d, f = 0, h = "0", g = r && [], v = [], y = D, x = r || a && b.find.TAG("*", u), w = R += null == y ? 1 : Math.random() || .1, T = x.length;
                    for (u && (D = o === L || o || u); h !== T && null != (c = x[h]); h++) {
                        if (a && c) {
                            for (p = 0, o || c.ownerDocument === L || (A(c), s = !z); d = e[p++];)if (d(c, o || L, s)) {
                                l.push(c);
                                break
                            }
                            u && (R = w)
                        }
                        i && ((c = !d && c) && f--, r && g.push(c))
                    }
                    if (f += h, i && h !== f) {
                        for (p = 0; d = n[p++];)d(g, v, o, s);
                        if (r) {
                            if (f > 0)for (; h--;)g[h] || v[h] || (v[h] = V.call(l));
                            v = m(v)
                        }
                        K.apply(l, v), u && !r && v.length > 0 && f + n.length > 1 && t.uniqueSort(l)
                    }
                    return u && (R = w, D = y), g
                };
                return i ? r(o) : o
            }

            var x, w, b, T, C, S, E, k, D, M, N, A, L, P, z, I, j, H, q, O = "sizzle" + 1 * new Date, B = e.document, R = 0, F = 0, W = n(), X = n(), Y = n(), G = function (e, t) {
                return e === t && (N = !0), 0
            }, $ = {}.hasOwnProperty, _ = [], V = _.pop, U = _.push, K = _.push, Q = _.slice, J = function (e, t) {
                for (var n = 0, r = e.length; n < r; n++)if (e[n] === t)return n;
                return -1
            }, Z = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped", ee = "[\\x20\\t\\r\\n\\f]", te = "(?:\\\\.|[\\w-]|[^\0-\\xa0])+", ne = "\\[" + ee + "*(" + te + ")(?:" + ee + "*([*^$|!~]?=)" + ee + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + te + "))|)" + ee + "*\\]", re = ":(" + te + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + ne + ")*)|.*)\\)|)", ie = new RegExp(ee + "+", "g"), ae = new RegExp("^" + ee + "+|((?:^|[^\\\\])(?:\\\\.)*)" + ee + "+$", "g"), oe = new RegExp("^" + ee + "*," + ee + "*"), se = new RegExp("^" + ee + "*([>+~]|" + ee + ")" + ee + "*"), le = new RegExp("=" + ee + "*([^\\]'\"]*?)" + ee + "*\\]", "g"), ue = new RegExp(re), ce = new RegExp("^" + te + "$"), pe = {
                ID: new RegExp("^#(" + te + ")"),
                CLASS: new RegExp("^\\.(" + te + ")"),
                TAG: new RegExp("^(" + te + "|[*])"),
                ATTR: new RegExp("^" + ne),
                PSEUDO: new RegExp("^" + re),
                CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + ee + "*(even|odd|(([+-]|)(\\d*)n|)" + ee + "*(?:([+-]|)" + ee + "*(\\d+)|))" + ee + "*\\)|)", "i"),
                bool: new RegExp("^(?:" + Z + ")$", "i"),
                needsContext: new RegExp("^" + ee + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + ee + "*((?:-\\d)?\\d*)" + ee + "*\\)|)(?=[^-]|$)", "i")
            }, de = /^(?:input|select|textarea|button)$/i, fe = /^h\d$/i, he = /^[^{]+\{\s*\[native \w/, me = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/, ge = /[+~]/, ve = new RegExp("\\\\([\\da-f]{1,6}" + ee + "?|(" + ee + ")|.)", "ig"), ye = function (e, t, n) {
                var r = "0x" + t - 65536;
                return r !== r || n ? t : r < 0 ? String.fromCharCode(r + 65536) : String.fromCharCode(r >> 10 | 55296, 1023 & r | 56320)
            }, xe = /([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g, we = function (e, t) {
                return t ? "\0" === e ? "�" : e.slice(0, -1) + "\\" + e.charCodeAt(e.length - 1).toString(16) + " " : "\\" + e
            }, be = function () {
                A()
            }, Te = d(function (e) {
                return !0 === e.disabled && ("form" in e || "label" in e)
            }, {dir: "parentNode", next: "legend"});
            try {
                K.apply(_ = Q.call(B.childNodes), B.childNodes), _[B.childNodes.length].nodeType
            } catch (e) {
                K = {
                    apply: _.length ? function (e, t) {
                            U.apply(e, Q.call(t))
                        } : function (e, t) {
                            for (var n = e.length, r = 0; e[n++] = t[r++];);
                            e.length = n - 1
                        }
                }
            }
            w = t.support = {}, C = t.isXML = function (e) {
                var t = e && (e.ownerDocument || e).documentElement;
                return !!t && "HTML" !== t.nodeName
            }, A = t.setDocument = function (e) {
                var t, n, r = e ? e.ownerDocument || e : B;
                return r !== L && 9 === r.nodeType && r.documentElement ? (L = r, P = L.documentElement, z = !C(L), B !== L && (n = L.defaultView) && n.top !== n && (n.addEventListener ? n.addEventListener("unload", be, !1) : n.attachEvent && n.attachEvent("onunload", be)), w.attributes = i(function (e) {
                        return e.className = "i", !e.getAttribute("className")
                    }), w.getElementsByTagName = i(function (e) {
                        return e.appendChild(L.createComment("")), !e.getElementsByTagName("*").length
                    }), w.getElementsByClassName = he.test(L.getElementsByClassName), w.getById = i(function (e) {
                        return P.appendChild(e).id = O, !L.getElementsByName || !L.getElementsByName(O).length
                    }), w.getById ? (b.filter.ID = function (e) {
                            var t = e.replace(ve, ye);
                            return function (e) {
                                return e.getAttribute("id") === t
                            }
                        }, b.find.ID = function (e, t) {
                            if (void 0 !== t.getElementById && z) {
                                var n = t.getElementById(e);
                                return n ? [n] : []
                            }
                        }) : (b.filter.ID = function (e) {
                            var t = e.replace(ve, ye);
                            return function (e) {
                                var n = void 0 !== e.getAttributeNode && e.getAttributeNode("id");
                                return n && n.value === t
                            }
                        }, b.find.ID = function (e, t) {
                            if (void 0 !== t.getElementById && z) {
                                var n, r, i, a = t.getElementById(e);
                                if (a) {
                                    if ((n = a.getAttributeNode("id")) && n.value === e)return [a];
                                    for (i = t.getElementsByName(e), r = 0; a = i[r++];)if ((n = a.getAttributeNode("id")) && n.value === e)return [a]
                                }
                                return []
                            }
                        }), b.find.TAG = w.getElementsByTagName ? function (e, t) {
                            return void 0 !== t.getElementsByTagName ? t.getElementsByTagName(e) : w.qsa ? t.querySelectorAll(e) : void 0
                        } : function (e, t) {
                            var n, r = [], i = 0, a = t.getElementsByTagName(e);
                            if ("*" === e) {
                                for (; n = a[i++];)1 === n.nodeType && r.push(n);
                                return r
                            }
                            return a
                        }, b.find.CLASS = w.getElementsByClassName && function (e, t) {
                            if (void 0 !== t.getElementsByClassName && z)return t.getElementsByClassName(e)
                        }, j = [], I = [], (w.qsa = he.test(L.querySelectorAll)) && (i(function (e) {
                        P.appendChild(e).innerHTML = "<a id='" + O + "'></a><select id='" + O + "-\r\\' msallowcapture=''><option selected=''></option></select>", e.querySelectorAll("[msallowcapture^='']").length && I.push("[*^$]=" + ee + "*(?:''|\"\")"), e.querySelectorAll("[selected]").length || I.push("\\[" + ee + "*(?:value|" + Z + ")"), e.querySelectorAll("[id~=" + O + "-]").length || I.push("~="), e.querySelectorAll(":checked").length || I.push(":checked"), e.querySelectorAll("a#" + O + "+*").length || I.push(".#.+[+~]")
                    }), i(function (e) {
                        e.innerHTML = "<a href='' disabled='disabled'></a><select disabled='disabled'><option/></select>";
                        var t = L.createElement("input");
                        t.setAttribute("type", "hidden"), e.appendChild(t).setAttribute("name", "D"), e.querySelectorAll("[name=d]").length && I.push("name" + ee + "*[*^$|!~]?="), 2 !== e.querySelectorAll(":enabled").length && I.push(":enabled", ":disabled"), P.appendChild(e).disabled = !0, 2 !== e.querySelectorAll(":disabled").length && I.push(":enabled", ":disabled"), e.querySelectorAll("*,:x"), I.push(",.*:")
                    })), (w.matchesSelector = he.test(H = P.matches || P.webkitMatchesSelector || P.mozMatchesSelector || P.oMatchesSelector || P.msMatchesSelector)) && i(function (e) {
                        w.disconnectedMatch = H.call(e, "*"), H.call(e, "[s!='']:x"), j.push("!=", re)
                    }), I = I.length && new RegExp(I.join("|")), j = j.length && new RegExp(j.join("|")), t = he.test(P.compareDocumentPosition), q = t || he.test(P.contains) ? function (e, t) {
                            var n = 9 === e.nodeType ? e.documentElement : e, r = t && t.parentNode;
                            return e === r || !(!r || 1 !== r.nodeType || !(n.contains ? n.contains(r) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(r)))
                        } : function (e, t) {
                            if (t)for (; t = t.parentNode;)if (t === e)return !0;
                            return !1
                        }, G = t ? function (e, t) {
                            if (e === t)return N = !0, 0;
                            var n = !e.compareDocumentPosition - !t.compareDocumentPosition;
                            return n || (n = (e.ownerDocument || e) === (t.ownerDocument || t) ? e.compareDocumentPosition(t) : 1, 1 & n || !w.sortDetached && t.compareDocumentPosition(e) === n ? e === L || e.ownerDocument === B && q(B, e) ? -1 : t === L || t.ownerDocument === B && q(B, t) ? 1 : M ? J(M, e) - J(M, t) : 0 : 4 & n ? -1 : 1)
                        } : function (e, t) {
                            if (e === t)return N = !0, 0;
                            var n, r = 0, i = e.parentNode, a = t.parentNode, s = [e], l = [t];
                            if (!i || !a)return e === L ? -1 : t === L ? 1 : i ? -1 : a ? 1 : M ? J(M, e) - J(M, t) : 0;
                            if (i === a)return o(e, t);
                            for (n = e; n = n.parentNode;)s.unshift(n);
                            for (n = t; n = n.parentNode;)l.unshift(n);
                            for (; s[r] === l[r];)r++;
                            return r ? o(s[r], l[r]) : s[r] === B ? -1 : l[r] === B ? 1 : 0
                        }, L) : L
            }, t.matches = function (e, n) {
                return t(e, null, null, n)
            }, t.matchesSelector = function (e, n) {
                if ((e.ownerDocument || e) !== L && A(e), n = n.replace(le, "='$1']"), w.matchesSelector && z && !Y[n + " "] && (!j || !j.test(n)) && (!I || !I.test(n)))try {
                    var r = H.call(e, n);
                    if (r || w.disconnectedMatch || e.document && 11 !== e.document.nodeType)return r
                } catch (e) {
                }
                return t(n, L, null, [e]).length > 0
            }, t.contains = function (e, t) {
                return (e.ownerDocument || e) !== L && A(e), q(e, t)
            }, t.attr = function (e, t) {
                (e.ownerDocument || e) !== L && A(e);
                var n = b.attrHandle[t.toLowerCase()], r = n && $.call(b.attrHandle, t.toLowerCase()) ? n(e, t, !z) : void 0;
                return void 0 !== r ? r : w.attributes || !z ? e.getAttribute(t) : (r = e.getAttributeNode(t)) && r.specified ? r.value : null
            }, t.escape = function (e) {
                return (e + "").replace(xe, we)
            }, t.error = function (e) {
                throw new Error("Syntax error, unrecognized expression: " + e)
            }, t.uniqueSort = function (e) {
                var t, n = [], r = 0, i = 0;
                if (N = !w.detectDuplicates, M = !w.sortStable && e.slice(0), e.sort(G), N) {
                    for (; t = e[i++];)t === e[i] && (r = n.push(i));
                    for (; r--;)e.splice(n[r], 1)
                }
                return M = null, e
            }, T = t.getText = function (e) {
                var t, n = "", r = 0, i = e.nodeType;
                if (i) {
                    if (1 === i || 9 === i || 11 === i) {
                        if ("string" == typeof e.textContent)return e.textContent;
                        for (e = e.firstChild; e; e = e.nextSibling)n += T(e)
                    } else if (3 === i || 4 === i)return e.nodeValue
                } else for (; t = e[r++];)n += T(t);
                return n
            }, b = t.selectors = {
                cacheLength: 50,
                createPseudo: r,
                match: pe,
                attrHandle: {},
                find: {},
                relative: {
                    ">": {dir: "parentNode", first: !0},
                    " ": {dir: "parentNode"},
                    "+": {dir: "previousSibling", first: !0},
                    "~": {dir: "previousSibling"}
                },
                preFilter: {
                    ATTR: function (e) {
                        return e[1] = e[1].replace(ve, ye), e[3] = (e[3] || e[4] || e[5] || "").replace(ve, ye), "~=" === e[2] && (e[3] = " " + e[3] + " "), e.slice(0, 4)
                    }, CHILD: function (e) {
                        return e[1] = e[1].toLowerCase(), "nth" === e[1].slice(0, 3) ? (e[3] || t.error(e[0]), e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])), e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && t.error(e[0]), e
                    }, PSEUDO: function (e) {
                        var t, n = !e[6] && e[2];
                        return pe.CHILD.test(e[0]) ? null : (e[3] ? e[2] = e[4] || e[5] || "" : n && ue.test(n) && (t = S(n, !0)) && (t = n.indexOf(")", n.length - t) - n.length) && (e[0] = e[0].slice(0, t), e[2] = n.slice(0, t)), e.slice(0, 3))
                    }
                },
                filter: {
                    TAG: function (e) {
                        var t = e.replace(ve, ye).toLowerCase();
                        return "*" === e ? function () {
                                return !0
                            } : function (e) {
                                return e.nodeName && e.nodeName.toLowerCase() === t
                            }
                    }, CLASS: function (e) {
                        var t = W[e + " "];
                        return t || (t = new RegExp("(^|" + ee + ")" + e + "(" + ee + "|$)")) && W(e, function (e) {
                                return t.test("string" == typeof e.className && e.className || void 0 !== e.getAttribute && e.getAttribute("class") || "")
                            })
                    }, ATTR: function (e, n, r) {
                        return function (i) {
                            var a = t.attr(i, e);
                            return null == a ? "!=" === n : !n || (a += "", "=" === n ? a === r : "!=" === n ? a !== r : "^=" === n ? r && 0 === a.indexOf(r) : "*=" === n ? r && a.indexOf(r) > -1 : "$=" === n ? r && a.slice(-r.length) === r : "~=" === n ? (" " + a.replace(ie, " ") + " ").indexOf(r) > -1 : "|=" === n && (a === r || a.slice(0, r.length + 1) === r + "-"))
                        }
                    }, CHILD: function (e, t, n, r, i) {
                        var a = "nth" !== e.slice(0, 3), o = "last" !== e.slice(-4), s = "of-type" === t;
                        return 1 === r && 0 === i ? function (e) {
                                return !!e.parentNode
                            } : function (t, n, l) {
                                var u, c, p, d, f, h, m = a !== o ? "nextSibling" : "previousSibling", g = t.parentNode, v = s && t.nodeName.toLowerCase(), y = !l && !s, x = !1;
                                if (g) {
                                    if (a) {
                                        for (; m;) {
                                            for (d = t; d = d[m];)if (s ? d.nodeName.toLowerCase() === v : 1 === d.nodeType)return !1;
                                            h = m = "only" === e && !h && "nextSibling"
                                        }
                                        return !0
                                    }
                                    if (h = [o ? g.firstChild : g.lastChild], o && y) {
                                        for (d = g, p = d[O] || (d[O] = {}), c = p[d.uniqueID] || (p[d.uniqueID] = {}), u = c[e] || [], f = u[0] === R && u[1], x = f && u[2], d = f && g.childNodes[f]; d = ++f && d && d[m] || (x = f = 0) || h.pop();)if (1 === d.nodeType && ++x && d === t) {
                                            c[e] = [R, f, x];
                                            break
                                        }
                                    } else if (y && (d = t, p = d[O] || (d[O] = {}), c = p[d.uniqueID] || (p[d.uniqueID] = {}), u = c[e] || [], f = u[0] === R && u[1], x = f), !1 === x)for (; (d = ++f && d && d[m] || (x = f = 0) || h.pop()) && ((s ? d.nodeName.toLowerCase() !== v : 1 !== d.nodeType) || !++x || (y && (p = d[O] || (d[O] = {}), c = p[d.uniqueID] || (p[d.uniqueID] = {}), c[e] = [R, x]), d !== t)););
                                    return (x -= i) === r || x % r == 0 && x / r >= 0
                                }
                            }
                    }, PSEUDO: function (e, n) {
                        var i, a = b.pseudos[e] || b.setFilters[e.toLowerCase()] || t.error("unsupported pseudo: " + e);
                        return a[O] ? a(n) : a.length > 1 ? (i = [e, e, "", n], b.setFilters.hasOwnProperty(e.toLowerCase()) ? r(function (e, t) {
                                        for (var r, i = a(e, n), o = i.length; o--;)r = J(e, i[o]), e[r] = !(t[r] = i[o])
                                    }) : function (e) {
                                        return a(e, 0, i)
                                    }) : a
                    }
                },
                pseudos: {
                    not: r(function (e) {
                        var t = [], n = [], i = E(e.replace(ae, "$1"));
                        return i[O] ? r(function (e, t, n, r) {
                                for (var a, o = i(e, null, r, []), s = e.length; s--;)(a = o[s]) && (e[s] = !(t[s] = a))
                            }) : function (e, r, a) {
                                return t[0] = e, i(t, null, a, n), t[0] = null, !n.pop()
                            }
                    }), has: r(function (e) {
                        return function (n) {
                            return t(e, n).length > 0
                        }
                    }), contains: r(function (e) {
                        return e = e.replace(ve, ye), function (t) {
                            return (t.textContent || t.innerText || T(t)).indexOf(e) > -1
                        }
                    }), lang: r(function (e) {
                        return ce.test(e || "") || t.error("unsupported lang: " + e), e = e.replace(ve, ye).toLowerCase(), function (t) {
                            var n;
                            do {
                                if (n = z ? t.lang : t.getAttribute("xml:lang") || t.getAttribute("lang"))return (n = n.toLowerCase()) === e || 0 === n.indexOf(e + "-")
                            } while ((t = t.parentNode) && 1 === t.nodeType);
                            return !1
                        }
                    }), target: function (t) {
                        var n = e.location && e.location.hash;
                        return n && n.slice(1) === t.id
                    }, root: function (e) {
                        return e === P
                    }, focus: function (e) {
                        return e === L.activeElement && (!L.hasFocus || L.hasFocus()) && !!(e.type || e.href || ~e.tabIndex)
                    }, enabled: s(!1), disabled: s(!0), checked: function (e) {
                        var t = e.nodeName.toLowerCase()
                            ;
                        return "input" === t && !!e.checked || "option" === t && !!e.selected
                    }, selected: function (e) {
                        return e.parentNode && e.parentNode.selectedIndex, !0 === e.selected
                    }, empty: function (e) {
                        for (e = e.firstChild; e; e = e.nextSibling)if (e.nodeType < 6)return !1;
                        return !0
                    }, parent: function (e) {
                        return !b.pseudos.empty(e)
                    }, header: function (e) {
                        return fe.test(e.nodeName)
                    }, input: function (e) {
                        return de.test(e.nodeName)
                    }, button: function (e) {
                        var t = e.nodeName.toLowerCase();
                        return "input" === t && "button" === e.type || "button" === t
                    }, text: function (e) {
                        var t;
                        return "input" === e.nodeName.toLowerCase() && "text" === e.type && (null == (t = e.getAttribute("type")) || "text" === t.toLowerCase())
                    }, first: l(function () {
                        return [0]
                    }), last: l(function (e, t) {
                        return [t - 1]
                    }), eq: l(function (e, t, n) {
                        return [n < 0 ? n + t : n]
                    }), even: l(function (e, t) {
                        for (var n = 0; n < t; n += 2)e.push(n);
                        return e
                    }), odd: l(function (e, t) {
                        for (var n = 1; n < t; n += 2)e.push(n);
                        return e
                    }), lt: l(function (e, t, n) {
                        for (var r = n < 0 ? n + t : n; --r >= 0;)e.push(r);
                        return e
                    }), gt: l(function (e, t, n) {
                        for (var r = n < 0 ? n + t : n; ++r < t;)e.push(r);
                        return e
                    })
                }
            }, b.pseudos.nth = b.pseudos.eq;
            for (x in{radio: !0, checkbox: !0, file: !0, password: !0, image: !0})b.pseudos[x] = function (e) {
                return function (t) {
                    return "input" === t.nodeName.toLowerCase() && t.type === e
                }
            }(x);
            for (x in{submit: !0, reset: !0})b.pseudos[x] = function (e) {
                return function (t) {
                    var n = t.nodeName.toLowerCase();
                    return ("input" === n || "button" === n) && t.type === e
                }
            }(x);
            return c.prototype = b.filters = b.pseudos, b.setFilters = new c, S = t.tokenize = function (e, n) {
                var r, i, a, o, s, l, u, c = X[e + " "];
                if (c)return n ? 0 : c.slice(0);
                for (s = e, l = [], u = b.preFilter; s;) {
                    r && !(i = oe.exec(s)) || (i && (s = s.slice(i[0].length) || s), l.push(a = [])), r = !1, (i = se.exec(s)) && (r = i.shift(), a.push({
                        value: r,
                        type: i[0].replace(ae, " ")
                    }), s = s.slice(r.length));
                    for (o in b.filter)!(i = pe[o].exec(s)) || u[o] && !(i = u[o](i)) || (r = i.shift(), a.push({
                        value: r,
                        type: o,
                        matches: i
                    }), s = s.slice(r.length));
                    if (!r)break
                }
                return n ? s.length : s ? t.error(e) : X(e, l).slice(0)
            }, E = t.compile = function (e, t) {
                var n, r = [], i = [], a = Y[e + " "];
                if (!a) {
                    for (t || (t = S(e)), n = t.length; n--;)a = v(t[n]), a[O] ? r.push(a) : i.push(a);
                    a = Y(e, y(i, r)), a.selector = e
                }
                return a
            }, k = t.select = function (e, t, n, r) {
                var i, a, o, s, l, c = "function" == typeof e && e, d = !r && S(e = c.selector || e);
                if (n = n || [], 1 === d.length) {
                    if (a = d[0] = d[0].slice(0), a.length > 2 && "ID" === (o = a[0]).type && 9 === t.nodeType && z && b.relative[a[1].type]) {
                        if (!(t = (b.find.ID(o.matches[0].replace(ve, ye), t) || [])[0]))return n;
                        c && (t = t.parentNode), e = e.slice(a.shift().value.length)
                    }
                    for (i = pe.needsContext.test(e) ? 0 : a.length; i-- && (o = a[i], !b.relative[s = o.type]);)if ((l = b.find[s]) && (r = l(o.matches[0].replace(ve, ye), ge.test(a[0].type) && u(t.parentNode) || t))) {
                        if (a.splice(i, 1), !(e = r.length && p(a)))return K.apply(n, r), n;
                        break
                    }
                }
                return (c || E(e, d))(r, t, !z, n, !t || ge.test(e) && u(t.parentNode) || t), n
            }, w.sortStable = O.split("").sort(G).join("") === O, w.detectDuplicates = !!N, A(), w.sortDetached = i(function (e) {
                return 1 & e.compareDocumentPosition(L.createElement("fieldset"))
            }), i(function (e) {
                return e.innerHTML = "<a href='#'></a>", "#" === e.firstChild.getAttribute("href")
            }) || a("type|href|height|width", function (e, t, n) {
                if (!n)return e.getAttribute(t, "type" === t.toLowerCase() ? 1 : 2)
            }), w.attributes && i(function (e) {
                return e.innerHTML = "<input/>", e.firstChild.setAttribute("value", ""), "" === e.firstChild.getAttribute("value")
            }) || a("value", function (e, t, n) {
                if (!n && "input" === e.nodeName.toLowerCase())return e.defaultValue
            }), i(function (e) {
                return null == e.getAttribute("disabled")
            }) || a(Z, function (e, t, n) {
                var r;
                if (!n)return !0 === e[t] ? t.toLowerCase() : (r = e.getAttributeNode(t)) && r.specified ? r.value : null
            }), t
        }(e);
        he.find = xe, he.expr = xe.selectors, he.expr[":"] = he.expr.pseudos, he.uniqueSort = he.unique = xe.uniqueSort, he.text = xe.getText, he.isXMLDoc = xe.isXML, he.contains = xe.contains, he.escapeSelector = xe.escape;
        var we = function (e, t, n) {
            for (var r = [], i = void 0 !== n; (e = e[t]) && 9 !== e.nodeType;)if (1 === e.nodeType) {
                if (i && he(e).is(n))break;
                r.push(e)
            }
            return r
        }, be = function (e, t) {
            for (var n = []; e; e = e.nextSibling)1 === e.nodeType && e !== t && n.push(e);
            return n
        }, Te = he.expr.match.needsContext, Ce = /^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i, Se = /^.[^:#\[\.,]*$/;
        he.filter = function (e, t, n) {
            var r = t[0];
            return n && (e = ":not(" + e + ")"), 1 === t.length && 1 === r.nodeType ? he.find.matchesSelector(r, e) ? [r] : [] : he.find.matches(e, he.grep(t, function (e) {
                    return 1 === e.nodeType
                }))
        }, he.fn.extend({
            find: function (e) {
                var t, n, r = this.length, i = this;
                if ("string" != typeof e)return this.pushStack(he(e).filter(function () {
                    for (t = 0; t < r; t++)if (he.contains(i[t], this))return !0
                }));
                for (n = this.pushStack([]), t = 0; t < r; t++)he.find(e, i[t], n);
                return r > 1 ? he.uniqueSort(n) : n
            }, filter: function (e) {
                return this.pushStack(a(this, e || [], !1))
            }, not: function (e) {
                return this.pushStack(a(this, e || [], !0))
            }, is: function (e) {
                return !!a(this, "string" == typeof e && Te.test(e) ? he(e) : e || [], !1).length
            }
        });
        var Ee, ke = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/;
        (he.fn.init = function (e, t, n) {
            var r, i;
            if (!e)return this;
            if (n = n || Ee, "string" == typeof e) {
                if (!(r = "<" === e[0] && ">" === e[e.length - 1] && e.length >= 3 ? [null, e, null] : ke.exec(e)) || !r[1] && t)return !t || t.jquery ? (t || n).find(e) : this.constructor(t).find(e);
                if (r[1]) {
                    if (t = t instanceof he ? t[0] : t, he.merge(this, he.parseHTML(r[1], t && t.nodeType ? t.ownerDocument || t : ne, !0)), Ce.test(r[1]) && he.isPlainObject(t))for (r in t)he.isFunction(this[r]) ? this[r](t[r]) : this.attr(r, t[r]);
                    return this
                }
                return i = ne.getElementById(r[2]), i && (this[0] = i, this.length = 1), this
            }
            return e.nodeType ? (this[0] = e, this.length = 1, this) : he.isFunction(e) ? void 0 !== n.ready ? n.ready(e) : e(he) : he.makeArray(e, this)
        }).prototype = he.fn, Ee = he(ne);
        var De = /^(?:parents|prev(?:Until|All))/, Me = {children: !0, contents: !0, next: !0, prev: !0};
        he.fn.extend({
            has: function (e) {
                var t = he(e, this), n = t.length;
                return this.filter(function () {
                    for (var e = 0; e < n; e++)if (he.contains(this, t[e]))return !0
                })
            }, closest: function (e, t) {
                var n, r = 0, i = this.length, a = [], o = "string" != typeof e && he(e);
                if (!Te.test(e))for (; r < i; r++)for (n = this[r]; n && n !== t; n = n.parentNode)if (n.nodeType < 11 && (o ? o.index(n) > -1 : 1 === n.nodeType && he.find.matchesSelector(n, e))) {
                    a.push(n);
                    break
                }
                return this.pushStack(a.length > 1 ? he.uniqueSort(a) : a)
            }, index: function (e) {
                return e ? "string" == typeof e ? se.call(he(e), this[0]) : se.call(this, e.jquery ? e[0] : e) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
            }, add: function (e, t) {
                return this.pushStack(he.uniqueSort(he.merge(this.get(), he(e, t))))
            }, addBack: function (e) {
                return this.add(null == e ? this.prevObject : this.prevObject.filter(e))
            }
        }), he.each({
            parent: function (e) {
                var t = e.parentNode;
                return t && 11 !== t.nodeType ? t : null
            }, parents: function (e) {
                return we(e, "parentNode")
            }, parentsUntil: function (e, t, n) {
                return we(e, "parentNode", n)
            }, next: function (e) {
                return o(e, "nextSibling")
            }, prev: function (e) {
                return o(e, "previousSibling")
            }, nextAll: function (e) {
                return we(e, "nextSibling")
            }, prevAll: function (e) {
                return we(e, "previousSibling")
            }, nextUntil: function (e, t, n) {
                return we(e, "nextSibling", n)
            }, prevUntil: function (e, t, n) {
                return we(e, "previousSibling", n)
            }, siblings: function (e) {
                return be((e.parentNode || {}).firstChild, e)
            }, children: function (e) {
                return be(e.firstChild)
            }, contents: function (e) {
                return i(e, "iframe") ? e.contentDocument : (i(e, "template") && (e = e.content || e), he.merge([], e.childNodes))
            }
        }, function (e, t) {
            he.fn[e] = function (n, r) {
                var i = he.map(this, t, n);
                return "Until" !== e.slice(-5) && (r = n), r && "string" == typeof r && (i = he.filter(r, i)), this.length > 1 && (Me[e] || he.uniqueSort(i), De.test(e) && i.reverse()), this.pushStack(i)
            }
        });
        var Ne = /[^\x20\t\r\n\f]+/g;
        he.Callbacks = function (e) {
            e = "string" == typeof e ? s(e) : he.extend({}, e);
            var t, n, r, i, a = [], o = [], l = -1, u = function () {
                for (i = i || e.once, r = t = !0; o.length; l = -1)for (n = o.shift(); ++l < a.length;)!1 === a[l].apply(n[0], n[1]) && e.stopOnFalse && (l = a.length, n = !1);
                e.memory || (n = !1), t = !1, i && (a = n ? [] : "")
            }, c = {
                add: function () {
                    return a && (n && !t && (l = a.length - 1, o.push(n)), function t(n) {
                        he.each(n, function (n, r) {
                            he.isFunction(r) ? e.unique && c.has(r) || a.push(r) : r && r.length && "string" !== he.type(r) && t(r)
                        })
                    }(arguments), n && !t && u()), this
                }, remove: function () {
                    return he.each(arguments, function (e, t) {
                        for (var n; (n = he.inArray(t, a, n)) > -1;)a.splice(n, 1), n <= l && l--
                    }), this
                }, has: function (e) {
                    return e ? he.inArray(e, a) > -1 : a.length > 0
                }, empty: function () {
                    return a && (a = []), this
                }, disable: function () {
                    return i = o = [], a = n = "", this
                }, disabled: function () {
                    return !a
                }, lock: function () {
                    return i = o = [], n || t || (a = n = ""), this
                }, locked: function () {
                    return !!i
                }, fireWith: function (e, n) {
                    return i || (n = n || [], n = [e, n.slice ? n.slice() : n], o.push(n), t || u()), this
                }, fire: function () {
                    return c.fireWith(this, arguments), this
                }, fired: function () {
                    return !!r
                }
            };
            return c
        }, he.extend({
            Deferred: function (t) {
                var n = [["notify", "progress", he.Callbacks("memory"), he.Callbacks("memory"), 2], ["resolve", "done", he.Callbacks("once memory"), he.Callbacks("once memory"), 0, "resolved"], ["reject", "fail", he.Callbacks("once memory"), he.Callbacks("once memory"), 1, "rejected"]], r = "pending", i = {
                    state: function () {
                        return r
                    }, always: function () {
                        return a.done(arguments).fail(arguments), this
                    }, catch: function (e) {
                        return i.then(null, e)
                    }, pipe: function () {
                        var e = arguments;
                        return he.Deferred(function (t) {
                            he.each(n, function (n, r) {
                                var i = he.isFunction(e[r[4]]) && e[r[4]];
                                a[r[1]](function () {
                                    var e = i && i.apply(this, arguments);
                                    e && he.isFunction(e.promise) ? e.promise().progress(t.notify).done(t.resolve).fail(t.reject) : t[r[0] + "With"](this, i ? [e] : arguments)
                                })
                            }), e = null
                        }).promise()
                    }, then: function (t, r, i) {
                        function a(t, n, r, i) {
                            return function () {
                                var s = this, c = arguments, p = function () {
                                    var e, p;
                                    if (!(t < o)) {
                                        if ((e = r.apply(s, c)) === n.promise())throw new TypeError("Thenable self-resolution");
                                        p = e && ("object" == typeof e || "function" == typeof e) && e.then, he.isFunction(p) ? i ? p.call(e, a(o, n, l, i), a(o, n, u, i)) : (o++, p.call(e, a(o, n, l, i), a(o, n, u, i), a(o, n, l, n.notifyWith))) : (r !== l && (s = void 0, c = [e]), (i || n.resolveWith)(s, c))
                                    }
                                }, d = i ? p : function () {
                                        try {
                                            p()
                                        } catch (e) {
                                            he.Deferred.exceptionHook && he.Deferred.exceptionHook(e, d.stackTrace), t + 1 >= o && (r !== u && (s = void 0, c = [e]), n.rejectWith(s, c))
                                        }
                                    };
                                t ? d() : (he.Deferred.getStackHook && (d.stackTrace = he.Deferred.getStackHook()), e.setTimeout(d))
                            }
                        }

                        var o = 0;
                        return he.Deferred(function (e) {
                            n[0][3].add(a(0, e, he.isFunction(i) ? i : l, e.notifyWith)), n[1][3].add(a(0, e, he.isFunction(t) ? t : l)), n[2][3].add(a(0, e, he.isFunction(r) ? r : u))
                        }).promise()
                    }, promise: function (e) {
                        return null != e ? he.extend(e, i) : i
                    }
                }, a = {};
                return he.each(n, function (e, t) {
                    var o = t[2], s = t[5];
                    i[t[1]] = o.add, s && o.add(function () {
                        r = s
                    }, n[3 - e][2].disable, n[0][2].lock), o.add(t[3].fire), a[t[0]] = function () {
                        return a[t[0] + "With"](this === a ? void 0 : this, arguments), this
                    }, a[t[0] + "With"] = o.fireWith
                }), i.promise(a), t && t.call(a, a), a
            }, when: function (e) {
                var t = arguments.length, n = t, r = Array(n), i = ie.call(arguments), a = he.Deferred(), o = function (e) {
                    return function (n) {
                        r[e] = this, i[e] = arguments.length > 1 ? ie.call(arguments) : n, --t || a.resolveWith(r, i)
                    }
                };
                if (t <= 1 && (c(e, a.done(o(n)).resolve, a.reject, !t), "pending" === a.state() || he.isFunction(i[n] && i[n].then)))return a.then();
                for (; n--;)c(i[n], o(n), a.reject);
                return a.promise()
            }
        });
        var Ae = /^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;
        he.Deferred.exceptionHook = function (t, n) {
            e.console && e.console.warn && t && Ae.test(t.name) && e.console.warn("jQuery.Deferred exception: " + t.message, t.stack, n)
        }, he.readyException = function (t) {
            e.setTimeout(function () {
                throw t
            })
        };
        var Le = he.Deferred();
        he.fn.ready = function (e) {
            return Le.then(e).catch(function (e) {
                he.readyException(e)
            }), this
        }, he.extend({
            isReady: !1, readyWait: 1, ready: function (e) {
                (!0 === e ? --he.readyWait : he.isReady) || (he.isReady = !0, !0 !== e && --he.readyWait > 0 || Le.resolveWith(ne, [he]))
            }
        }), he.ready.then = Le.then, "complete" === ne.readyState || "loading" !== ne.readyState && !ne.documentElement.doScroll ? e.setTimeout(he.ready) : (ne.addEventListener("DOMContentLoaded", p), e.addEventListener("load", p));
        var Pe = function (e, t, n, r, i, a, o) {
            var s = 0, l = e.length, u = null == n;
            if ("object" === he.type(n)) {
                i = !0;
                for (s in n)Pe(e, t, s, n[s], !0, a, o)
            } else if (void 0 !== r && (i = !0, he.isFunction(r) || (o = !0), u && (o ? (t.call(e, r), t = null) : (u = t, t = function (e, t, n) {
                        return u.call(he(e), n)
                    })), t))for (; s < l; s++)t(e[s], n, o ? r : r.call(e[s], s, t(e[s], n)));
            return i ? e : u ? t.call(e) : l ? t(e[0], n) : a
        }, ze = function (e) {
            return 1 === e.nodeType || 9 === e.nodeType || !+e.nodeType
        };
        d.uid = 1, d.prototype = {
            cache: function (e) {
                var t = e[this.expando];
                return t || (t = {}, ze(e) && (e.nodeType ? e[this.expando] = t : Object.defineProperty(e, this.expando, {
                        value: t,
                        configurable: !0
                    }))), t
            }, set: function (e, t, n) {
                var r, i = this.cache(e);
                if ("string" == typeof t) i[he.camelCase(t)] = n; else for (r in t)i[he.camelCase(r)] = t[r];
                return i
            }, get: function (e, t) {
                return void 0 === t ? this.cache(e) : e[this.expando] && e[this.expando][he.camelCase(t)]
            }, access: function (e, t, n) {
                return void 0 === t || t && "string" == typeof t && void 0 === n ? this.get(e, t) : (this.set(e, t, n), void 0 !== n ? n : t)
            }, remove: function (e, t) {
                var n, r = e[this.expando];
                if (void 0 !== r) {
                    if (void 0 !== t) {
                        Array.isArray(t) ? t = t.map(he.camelCase) : (t = he.camelCase(t), t = t in r ? [t] : t.match(Ne) || []), n = t.length;
                        for (; n--;)delete r[t[n]]
                    }
                    (void 0 === t || he.isEmptyObject(r)) && (e.nodeType ? e[this.expando] = void 0 : delete e[this.expando])
                }
            }, hasData: function (e) {
                var t = e[this.expando];
                return void 0 !== t && !he.isEmptyObject(t)
            }
        };
        var Ie = new d, je = new d, He = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/, qe = /[A-Z]/g;
        he.extend({
            hasData: function (e) {
                return je.hasData(e) || Ie.hasData(e)
            }, data: function (e, t, n) {
                return je.access(e, t, n)
            }, removeData: function (e, t) {
                je.remove(e, t)
            }, _data: function (e, t, n) {
                return Ie.access(e, t, n)
            }, _removeData: function (e, t) {
                Ie.remove(e, t)
            }
        }), he.fn.extend({
            data: function (e, t) {
                var n, r, i, a = this[0], o = a && a.attributes;
                if (void 0 === e) {
                    if (this.length && (i = je.get(a), 1 === a.nodeType && !Ie.get(a, "hasDataAttrs"))) {
                        for (n = o.length; n--;)o[n] && (r = o[n].name, 0 === r.indexOf("data-") && (r = he.camelCase(r.slice(5)), h(a, r, i[r])));
                        Ie.set(a, "hasDataAttrs", !0)
                    }
                    return i
                }
                return "object" == typeof e ? this.each(function () {
                        je.set(this, e)
                    }) : Pe(this, function (t) {
                        var n;
                        if (a && void 0 === t) {
                            if (void 0 !== (n = je.get(a, e)))return n;
                            if (void 0 !== (n = h(a, e)))return n
                        } else this.each(function () {
                            je.set(this, e, t)
                        })
                    }, null, t, arguments.length > 1, null, !0)
            }, removeData: function (e) {
                return this.each(function () {
                    je.remove(this, e)
                })
            }
        }), he.extend({
            queue: function (e, t, n) {
                var r;
                if (e)return t = (t || "fx") + "queue", r = Ie.get(e, t), n && (!r || Array.isArray(n) ? r = Ie.access(e, t, he.makeArray(n)) : r.push(n)), r || []
            }, dequeue: function (e, t) {
                t = t || "fx";
                var n = he.queue(e, t), r = n.length, i = n.shift(), a = he._queueHooks(e, t), o = function () {
                    he.dequeue(e, t)
                };
                "inprogress" === i && (i = n.shift(), r--), i && ("fx" === t && n.unshift("inprogress"), delete a.stop, i.call(e, o, a)), !r && a && a.empty.fire()
            }, _queueHooks: function (e, t) {
                var n = t + "queueHooks";
                return Ie.get(e, n) || Ie.access(e, n, {
                        empty: he.Callbacks("once memory").add(function () {
                            Ie.remove(e, [t + "queue", n])
                        })
                    })
            }
        }), he.fn.extend({
            queue: function (e, t) {
                var n = 2;
                return "string" != typeof e && (t = e, e = "fx", n--), arguments.length < n ? he.queue(this[0], e) : void 0 === t ? this : this.each(function () {
                            var n = he.queue(this, e, t);
                            he._queueHooks(this, e), "fx" === e && "inprogress" !== n[0] && he.dequeue(this, e)
                        })
            }, dequeue: function (e) {
                return this.each(function () {
                    he.dequeue(this, e)
                })
            }, clearQueue: function (e) {
                return this.queue(e || "fx", [])
            }, promise: function (e, t) {
                var n, r = 1, i = he.Deferred(), a = this, o = this.length, s = function () {
                    --r || i.resolveWith(a, [a])
                };
                for ("string" != typeof e && (t = e, e = void 0), e = e || "fx"; o--;)(n = Ie.get(a[o], e + "queueHooks")) && n.empty && (r++, n.empty.add(s));
                return s(), i.promise(t)
            }
        });
        var Oe = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source, Be = new RegExp("^(?:([+-])=|)(" + Oe + ")([a-z%]*)$", "i"), Re = ["Top", "Right", "Bottom", "Left"], Fe = function (e, t) {
            return e = t || e, "none" === e.style.display || "" === e.style.display && he.contains(e.ownerDocument, e) && "none" === he.css(e, "display")
        }, We = function (e, t, n, r) {
            var i, a, o = {};
            for (a in t)o[a] = e.style[a], e.style[a] = t[a];
            i = n.apply(e, r || []);
            for (a in t)e.style[a] = o[a];
            return i
        }, Xe = {};
        he.fn.extend({
            show: function () {
                return v(this, !0)
            }, hide: function () {
                return v(this)
            }, toggle: function (e) {
                return "boolean" == typeof e ? e ? this.show() : this.hide() : this.each(function () {
                        Fe(this) ? he(this).show() : he(this).hide()
                    })
            }
        });
        var Ye = /^(?:checkbox|radio)$/i, Ge = /<([a-z][^\/\0>\x20\t\r\n\f]+)/i, $e = /^$|\/(?:java|ecma)script/i, _e = {
            option: [1, "<select multiple='multiple'>", "</select>"],
            thead: [1, "<table>", "</table>"],
            col: [2, "<table><colgroup>", "</colgroup></table>"],
            tr: [2, "<table><tbody>", "</tbody></table>"],
            td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
            _default: [0, "", ""]
        };
        _e.optgroup = _e.option, _e.tbody = _e.tfoot = _e.colgroup = _e.caption = _e.thead, _e.th = _e.td;
        var Ve = /<|&#?\w+;/;
        !function () {
            var e = ne.createDocumentFragment(), t = e.appendChild(ne.createElement("div")), n = ne.createElement("input");
            n.setAttribute("type", "radio"), n.setAttribute("checked", "checked"), n.setAttribute("name", "t"), t.appendChild(n), fe.checkClone = t.cloneNode(!0).cloneNode(!0).lastChild.checked, t.innerHTML = "<textarea>x</textarea>", fe.noCloneChecked = !!t.cloneNode(!0).lastChild.defaultValue
        }();
        var Ue = ne.documentElement, Ke = /^key/, Qe = /^(?:mouse|pointer|contextmenu|drag|drop)|click/, Je = /^([^.]*)(?:\.(.+)|)/;
        he.event = {
            global: {}, add: function (e, t, n, r, i) {
                var a, o, s, l, u, c, p, d, f, h, m, g = Ie.get(e);
                if (g)for (n.handler && (a = n, n = a.handler, i = a.selector), i && he.find.matchesSelector(Ue, i), n.guid || (n.guid = he.guid++), (l = g.events) || (l = g.events = {}), (o = g.handle) || (o = g.handle = function (t) {
                    return void 0 !== he && he.event.triggered !== t.type ? he.event.dispatch.apply(e, arguments) : void 0
                }), t = (t || "").match(Ne) || [""], u = t.length; u--;)s = Je.exec(t[u]) || [], f = m = s[1], h = (s[2] || "").split(".").sort(), f && (p = he.event.special[f] || {}, f = (i ? p.delegateType : p.bindType) || f, p = he.event.special[f] || {}, c = he.extend({
                    type: f,
                    origType: m,
                    data: r,
                    handler: n,
                    guid: n.guid,
                    selector: i,
                    needsContext: i && he.expr.match.needsContext.test(i),
                    namespace: h.join(".")
                }, a), (d = l[f]) || (d = l[f] = [], d.delegateCount = 0, p.setup && !1 !== p.setup.call(e, r, h, o) || e.addEventListener && e.addEventListener(f, o)), p.add && (p.add.call(e, c), c.handler.guid || (c.handler.guid = n.guid)), i ? d.splice(d.delegateCount++, 0, c) : d.push(c), he.event.global[f] = !0)
            }, remove: function (e, t, n, r, i) {
                var a, o, s, l, u, c, p, d, f, h, m, g = Ie.hasData(e) && Ie.get(e);
                if (g && (l = g.events)) {
                    for (t = (t || "").match(Ne) || [""], u = t.length; u--;)if (s = Je.exec(t[u]) || [], f = m = s[1], h = (s[2] || "").split(".").sort(), f) {
                        for (p = he.event.special[f] || {}, f = (r ? p.delegateType : p.bindType) || f, d = l[f] || [], s = s[2] && new RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)"), o = a = d.length; a--;)c = d[a], !i && m !== c.origType || n && n.guid !== c.guid || s && !s.test(c.namespace) || r && r !== c.selector && ("**" !== r || !c.selector) || (d.splice(a, 1), c.selector && d.delegateCount--, p.remove && p.remove.call(e, c));
                        o && !d.length && (p.teardown && !1 !== p.teardown.call(e, h, g.handle) || he.removeEvent(e, f, g.handle), delete l[f])
                    } else for (f in l)he.event.remove(e, f + t[u], n, r, !0);
                    he.isEmptyObject(l) && Ie.remove(e, "handle events")
                }
            }, dispatch: function (e) {
                var t, n, r, i, a, o, s = he.event.fix(e), l = new Array(arguments.length), u = (Ie.get(this, "events") || {})[s.type] || [], c = he.event.special[s.type] || {};
                for (l[0] = s, t = 1; t < arguments.length; t++)l[t] = arguments[t];
                if (s.delegateTarget = this, !c.preDispatch || !1 !== c.preDispatch.call(this, s)) {
                    for (o = he.event.handlers.call(this, s, u), t = 0; (i = o[t++]) && !s.isPropagationStopped();)for (s.currentTarget = i.elem, n = 0; (a = i.handlers[n++]) && !s.isImmediatePropagationStopped();)s.rnamespace && !s.rnamespace.test(a.namespace) || (s.handleObj = a, s.data = a.data, void 0 !== (r = ((he.event.special[a.origType] || {}).handle || a.handler).apply(i.elem, l)) && !1 === (s.result = r) && (s.preventDefault(), s.stopPropagation()));
                    return c.postDispatch && c.postDispatch.call(this, s), s.result
                }
            }, handlers: function (e, t) {
                var n, r, i, a, o, s = [], l = t.delegateCount, u = e.target;
                if (l && u.nodeType && !("click" === e.type && e.button >= 1))for (; u !== this; u = u.parentNode || this)if (1 === u.nodeType && ("click" !== e.type || !0 !== u.disabled)) {
                    for (a = [], o = {}, n = 0; n < l; n++)r = t[n], i = r.selector + " ", void 0 === o[i] && (o[i] = r.needsContext ? he(i, this).index(u) > -1 : he.find(i, this, null, [u]).length), o[i] && a.push(r);
                    a.length && s.push({elem: u, handlers: a})
                }
                return u = this, l < t.length && s.push({elem: u, handlers: t.slice(l)}), s
            }, addProp: function (e, t) {
                Object.defineProperty(he.Event.prototype, e, {
                    enumerable: !0,
                    configurable: !0,
                    get: he.isFunction(t) ? function () {
                            if (this.originalEvent)return t(this.originalEvent)
                        } : function () {
                            if (this.originalEvent)return this.originalEvent[e]
                        },
                    set: function (t) {
                        Object.defineProperty(this, e, {enumerable: !0, configurable: !0, writable: !0, value: t})
                    }
                })
            }, fix: function (e) {
                return e[he.expando] ? e : new he.Event(e)
            }, special: {
                load: {noBubble: !0}, focus: {
                    trigger: function () {
                        if (this !== C() && this.focus)return this.focus(), !1
                    }, delegateType: "focusin"
                }, blur: {
                    trigger: function () {
                        if (this === C() && this.blur)return this.blur(), !1
                    }, delegateType: "focusout"
                }, click: {
                    trigger: function () {
                        if ("checkbox" === this.type && this.click && i(this, "input"))return this.click(), !1
                    }, _default: function (e) {
                        return i(e.target, "a")
                    }
                }, beforeunload: {
                    postDispatch: function (e) {
                        void 0 !== e.result && e.originalEvent && (e.originalEvent.returnValue = e.result)
                    }
                }
            }
        }, he.removeEvent = function (e, t, n) {
            e.removeEventListener && e.removeEventListener(t, n)
        }, he.Event = function (e, t) {
            if (!(this instanceof he.Event))return new he.Event(e, t);
            e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || void 0 === e.defaultPrevented && !1 === e.returnValue ? b : T, this.target = e.target && 3 === e.target.nodeType ? e.target.parentNode : e.target, this.currentTarget = e.currentTarget, this.relatedTarget = e.relatedTarget) : this.type = e, t && he.extend(this, t), this.timeStamp = e && e.timeStamp || he.now(), this[he.expando] = !0
        }, he.Event.prototype = {
            constructor: he.Event,
            isDefaultPrevented: T,
            isPropagationStopped: T,
            isImmediatePropagationStopped: T,
            isSimulated: !1,
            preventDefault: function () {
                var e = this.originalEvent;
                this.isDefaultPrevented = b, e && !this.isSimulated && e.preventDefault()
            },
            stopPropagation: function () {
                var e = this.originalEvent;
                this.isPropagationStopped = b, e && !this.isSimulated && e.stopPropagation()
            },
            stopImmediatePropagation: function () {
                var e = this.originalEvent;
                this.isImmediatePropagationStopped = b, e && !this.isSimulated && e.stopImmediatePropagation(), this.stopPropagation()
            }
        }, he.each({
            altKey: !0,
            bubbles: !0,
            cancelable: !0,
            changedTouches: !0,
            ctrlKey: !0,
            detail: !0,
            eventPhase: !0,
            metaKey: !0,
            pageX: !0,
            pageY: !0,
            shiftKey: !0,
            view: !0,
            char: !0,
            charCode: !0,
            key: !0,
            keyCode: !0,
            button: !0,
            buttons: !0,
            clientX: !0,
            clientY: !0,
            offsetX: !0,
            offsetY: !0,
            pointerId: !0,
            pointerType: !0,
            screenX: !0,
            screenY: !0,
            targetTouches: !0,
            toElement: !0,
            touches: !0,
            which: function (e) {
                var t = e.button;
                return null == e.which && Ke.test(e.type) ? null != e.charCode ? e.charCode : e.keyCode : !e.which && void 0 !== t && Qe.test(e.type) ? 1 & t ? 1 : 2 & t ? 3 : 4 & t ? 2 : 0 : e.which
            }
        }, he.event.addProp), he.each({
            mouseenter: "mouseover",
            mouseleave: "mouseout",
            pointerenter: "pointerover",
            pointerleave: "pointerout"
        }, function (e, t) {
            he.event.special[e] = {
                delegateType: t, bindType: t, handle: function (e) {
                    var n, r = this, i = e.relatedTarget, a = e.handleObj;
                    return i && (i === r || he.contains(r, i)) || (e.type = a.origType, n = a.handler.apply(this, arguments), e.type = t), n
                }
            }
        }), he.fn.extend({
            on: function (e, t, n, r) {
                return S(this, e, t, n, r)
            }, one: function (e, t, n, r) {
                return S(this, e, t, n, r, 1)
            }, off: function (e, t, n) {
                var r, i;
                if (e && e.preventDefault && e.handleObj)return r = e.handleObj, he(e.delegateTarget).off(r.namespace ? r.origType + "." + r.namespace : r.origType, r.selector, r.handler), this;
                if ("object" == typeof e) {
                    for (i in e)this.off(i, t, e[i]);
                    return this
                }
                return !1 !== t && "function" != typeof t || (n = t, t = void 0), !1 === n && (n = T), this.each(function () {
                    he.event.remove(this, e, n, t)
                })
            }
        });
        var Ze = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([a-z][^\/\0>\x20\t\r\n\f]*)[^>]*)\/>/gi, et = /<script|<style|<link/i, tt = /checked\s*(?:[^=]|=\s*.checked.)/i, nt = /^true\/(.*)/, rt = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;
        he.extend({
            htmlPrefilter: function (e) {
                return e.replace(Ze, "<$1></$2>")
            }, clone: function (e, t, n) {
                var r, i, a, o, s = e.cloneNode(!0), l = he.contains(e.ownerDocument, e);
                if (!(fe.noCloneChecked || 1 !== e.nodeType && 11 !== e.nodeType || he.isXMLDoc(e)))for (o = y(s), a = y(e), r = 0, i = a.length; r < i; r++)N(a[r], o[r]);
                if (t)if (n)for (a = a || y(e), o = o || y(s), r = 0, i = a.length; r < i; r++)M(a[r], o[r]); else M(e, s);
                return o = y(s, "script"), o.length > 0 && x(o, !l && y(e, "script")), s
            }, cleanData: function (e) {
                for (var t, n, r, i = he.event.special, a = 0; void 0 !== (n = e[a]); a++)if (ze(n)) {
                    if (t = n[Ie.expando]) {
                        if (t.events)for (r in t.events)i[r] ? he.event.remove(n, r) : he.removeEvent(n, r, t.handle);
                        n[Ie.expando] = void 0
                    }
                    n[je.expando] && (n[je.expando] = void 0)
                }
            }
        }), he.fn.extend({
            detach: function (e) {
                return L(this, e, !0)
            }, remove: function (e) {
                return L(this, e)
            }, text: function (e) {
                return Pe(this, function (e) {
                    return void 0 === e ? he.text(this) : this.empty().each(function () {
                            1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || (this.textContent = e)
                        })
                }, null, e, arguments.length)
            }, append: function () {
                return A(this, arguments, function (e) {
                    if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                        E(this, e).appendChild(e)
                    }
                })
            }, prepend: function () {
                return A(this, arguments, function (e) {
                    if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                        var t = E(this, e);
                        t.insertBefore(e, t.firstChild)
                    }
                })
            }, before: function () {
                return A(this, arguments, function (e) {
                    this.parentNode && this.parentNode.insertBefore(e, this)
                })
            }, after: function () {
                return A(this, arguments, function (e) {
                    this.parentNode && this.parentNode.insertBefore(e, this.nextSibling)
                })
            }, empty: function () {
                for (var e, t = 0; null != (e = this[t]); t++)1 === e.nodeType && (he.cleanData(y(e, !1)), e.textContent = "");
                return this
            }, clone: function (e, t) {
                return e = null != e && e, t = null == t ? e : t, this.map(function () {
                    return he.clone(this, e, t)
                })
            }, html: function (e) {
                return Pe(this, function (e) {
                    var t = this[0] || {}, n = 0, r = this.length;
                    if (void 0 === e && 1 === t.nodeType)return t.innerHTML;
                    if ("string" == typeof e && !et.test(e) && !_e[(Ge.exec(e) || ["", ""])[1].toLowerCase()]) {
                        e = he.htmlPrefilter(e);
                        try {
                            for (; n < r; n++)t = this[n] || {}, 1 === t.nodeType && (he.cleanData(y(t, !1)), t.innerHTML = e);
                            t = 0
                        } catch (e) {
                        }
                    }
                    t && this.empty().append(e)
                }, null, e, arguments.length)
            }, replaceWith: function () {
                var e = [];
                return A(this, arguments, function (t) {
                    var n = this.parentNode;
                    he.inArray(this, e) < 0 && (he.cleanData(y(this)), n && n.replaceChild(t, this))
                }, e)
            }
        }), he.each({
            appendTo: "append",
            prependTo: "prepend",
            insertBefore: "before",
            insertAfter: "after",
            replaceAll: "replaceWith"
        }, function (e, t) {
            he.fn[e] = function (e) {
                for (var n, r = [], i = he(e), a = i.length - 1, o = 0; o <= a; o++)n = o === a ? this : this.clone(!0), he(i[o])[t](n), oe.apply(r, n.get());
                return this.pushStack(r)
            }
        });
        var it = /^margin/, at = new RegExp("^(" + Oe + ")(?!px)[a-z%]+$", "i"), ot = function (t) {
            var n = t.ownerDocument.defaultView;
            return n && n.opener || (n = e), n.getComputedStyle(t)
        };
        !function () {
            function t() {
                if (s) {
                    s.style.cssText = "box-sizing:border-box;position:relative;display:block;margin:auto;border:1px;padding:1px;top:1%;width:50%", s.innerHTML = "", Ue.appendChild(o);
                    var t = e.getComputedStyle(s);
                    n = "1%" !== t.top, a = "2px" === t.marginLeft, r = "4px" === t.width, s.style.marginRight = "50%", i = "4px" === t.marginRight, Ue.removeChild(o), s = null
                }
            }

            var n, r, i, a, o = ne.createElement("div"), s = ne.createElement("div");
            s.style && (s.style.backgroundClip = "content-box", s.cloneNode(!0).style.backgroundClip = "", fe.clearCloneStyle = "content-box" === s.style.backgroundClip, o.style.cssText = "border:0;width:8px;height:0;top:0;left:-9999px;padding:0;margin-top:1px;position:absolute", o.appendChild(s), he.extend(fe, {
                pixelPosition: function () {
                    return t(), n
                }, boxSizingReliable: function () {
                    return t(), r
                }, pixelMarginRight: function () {
                    return t(), i
                }, reliableMarginLeft: function () {
                    return t(), a
                }
            }))
        }();
        var st = /^(none|table(?!-c[ea]).+)/, lt = /^--/, ut = {
            position: "absolute",
            visibility: "hidden",
            display: "block"
        }, ct = {letterSpacing: "0", fontWeight: "400"}, pt = ["Webkit", "Moz", "ms"], dt = ne.createElement("div").style;
        he.extend({
            cssHooks: {
                opacity: {
                    get: function (e, t) {
                        if (t) {
                            var n = P(e, "opacity");
                            return "" === n ? "1" : n
                        }
                    }
                }
            },
            cssNumber: {
                animationIterationCount: !0,
                columnCount: !0,
                fillOpacity: !0,
                flexGrow: !0,
                flexShrink: !0,
                fontWeight: !0,
                lineHeight: !0,
                opacity: !0,
                order: !0,
                orphans: !0,
                widows: !0,
                zIndex: !0,
                zoom: !0
            },
            cssProps: {float: "cssFloat"},
            style: function (e, t, n, r) {
                if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
                    var i, a, o, s = he.camelCase(t), l = lt.test(t), u = e.style;
                    if (l || (t = j(s)), o = he.cssHooks[t] || he.cssHooks[s], void 0 === n)return o && "get" in o && void 0 !== (i = o.get(e, !1, r)) ? i : u[t];
                    a = typeof n, "string" === a && (i = Be.exec(n)) && i[1] && (n = m(e, t, i), a = "number"), null != n && n === n && ("number" === a && (n += i && i[3] || (he.cssNumber[s] ? "" : "px")), fe.clearCloneStyle || "" !== n || 0 !== t.indexOf("background") || (u[t] = "inherit"), o && "set" in o && void 0 === (n = o.set(e, n, r)) || (l ? u.setProperty(t, n) : u[t] = n))
                }
            },
            css: function (e, t, n, r) {
                var i, a, o, s = he.camelCase(t);
                return lt.test(t) || (t = j(s)), o = he.cssHooks[t] || he.cssHooks[s], o && "get" in o && (i = o.get(e, !0, n)), void 0 === i && (i = P(e, t, r)), "normal" === i && t in ct && (i = ct[t]), "" === n || n ? (a = parseFloat(i), !0 === n || isFinite(a) ? a || 0 : i) : i
            }
        }), he.each(["height", "width"], function (e, t) {
            he.cssHooks[t] = {
                get: function (e, n, r) {
                    if (n)return !st.test(he.css(e, "display")) || e.getClientRects().length && e.getBoundingClientRect().width ? O(e, t, r) : We(e, ut, function () {
                            return O(e, t, r)
                        })
                }, set: function (e, n, r) {
                    var i, a = r && ot(e), o = r && q(e, t, r, "border-box" === he.css(e, "boxSizing", !1, a), a);
                    return o && (i = Be.exec(n)) && "px" !== (i[3] || "px") && (e.style[t] = n, n = he.css(e, t)), H(e, n, o)
                }
            }
        }), he.cssHooks.marginLeft = z(fe.reliableMarginLeft, function (e, t) {
            if (t)return (parseFloat(P(e, "marginLeft")) || e.getBoundingClientRect().left - We(e, {marginLeft: 0}, function () {
                    return e.getBoundingClientRect().left
                })) + "px"
        }), he.each({margin: "", padding: "", border: "Width"}, function (e, t) {
            he.cssHooks[e + t] = {
                expand: function (n) {
                    for (var r = 0, i = {}, a = "string" == typeof n ? n.split(" ") : [n]; r < 4; r++)i[e + Re[r] + t] = a[r] || a[r - 2] || a[0];
                    return i
                }
            }, it.test(e) || (he.cssHooks[e + t].set = H)
        }), he.fn.extend({
            css: function (e, t) {
                return Pe(this, function (e, t, n) {
                    var r, i, a = {}, o = 0;
                    if (Array.isArray(t)) {
                        for (r = ot(e), i = t.length; o < i; o++)a[t[o]] = he.css(e, t[o], !1, r);
                        return a
                    }
                    return void 0 !== n ? he.style(e, t, n) : he.css(e, t)
                }, e, t, arguments.length > 1)
            }
        }), he.Tween = B, B.prototype = {
            constructor: B, init: function (e, t, n, r, i, a) {
                this.elem = e, this.prop = n, this.easing = i || he.easing._default, this.options = t, this.start = this.now = this.cur(), this.end = r, this.unit = a || (he.cssNumber[n] ? "" : "px")
            }, cur: function () {
                var e = B.propHooks[this.prop];
                return e && e.get ? e.get(this) : B.propHooks._default.get(this)
            }, run: function (e) {
                var t, n = B.propHooks[this.prop];
                return this.options.duration ? this.pos = t = he.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration) : this.pos = t = e, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : B.propHooks._default.set(this), this
            }
        }, B.prototype.init.prototype = B.prototype, B.propHooks = {
            _default: {
                get: function (e) {
                    var t;
                    return 1 !== e.elem.nodeType || null != e.elem[e.prop] && null == e.elem.style[e.prop] ? e.elem[e.prop] : (t = he.css(e.elem, e.prop, ""), t && "auto" !== t ? t : 0)
                }, set: function (e) {
                    he.fx.step[e.prop] ? he.fx.step[e.prop](e) : 1 !== e.elem.nodeType || null == e.elem.style[he.cssProps[e.prop]] && !he.cssHooks[e.prop] ? e.elem[e.prop] = e.now : he.style(e.elem, e.prop, e.now + e.unit)
                }
            }
        }, B.propHooks.scrollTop = B.propHooks.scrollLeft = {
            set: function (e) {
                e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now)
            }
        }, he.easing = {
            linear: function (e) {
                return e
            }, swing: function (e) {
                return .5 - Math.cos(e * Math.PI) / 2
            }, _default: "swing"
        }, he.fx = B.prototype.init, he.fx.step = {};
        var ft, ht, mt = /^(?:toggle|show|hide)$/, gt = /queueHooks$/;
        he.Animation = he.extend($, {
            tweeners: {
                "*": [function (e, t) {
                    var n = this.createTween(e, t);
                    return m(n.elem, e, Be.exec(t), n), n
                }]
            }, tweener: function (e, t) {
                he.isFunction(e) ? (t = e, e = ["*"]): e= e.match(Ne);
                for (var n, r = 0, i = e.length; r < i; r++)n = e[r], $.tweeners[n] = $.tweeners[n] || [], $.tweeners[n].unshift(t)
            }, prefilters: [Y], prefilter: function (e, t) {
                t ? $.prefilters.unshift(e) : $.prefilters.push(e)
            }
        }), he.speed = function (e, t, n) {
            var r = e && "object" == typeof e ? he.extend({}, e) : {
                    complete: n || !n && t || he.isFunction(e) && e,
                    duration: e,
                    easing: n && t || t && !he.isFunction(t) && t
                };
            return he.fx.off ? r.duration = 0 : "number" != typeof r.duration && (r.duration in he.fx.speeds ? r.duration = he.fx.speeds[r.duration] : r.duration = he.fx.speeds._default), null != r.queue && !0 !== r.queue || (r.queue = "fx"), r.old = r.complete, r.complete = function () {
                he.isFunction(r.old) && r.old.call(this), r.queue && he.dequeue(this, r.queue)
            }, r
        }, he.fn.extend({
            fadeTo: function (e, t, n, r) {
                return this.filter(Fe).css("opacity", 0).show().end().animate({opacity: t}, e, n, r)
            }, animate: function (e, t, n, r) {
                var i = he.isEmptyObject(e), a = he.speed(t, n, r), o = function () {
                    var t = $(this, he.extend({}, e), a);
                    (i || Ie.get(this, "finish")) && t.stop(!0)
                };
                return o.finish = o, i || !1 === a.queue ? this.each(o) : this.queue(a.queue, o)
            }, stop: function (e, t, n) {
                var r = function (e) {
                    var t = e.stop;
                    delete e.stop, t(n)
                };
                return "string" != typeof e && (n = t, t = e, e = void 0), t && !1 !== e && this.queue(e || "fx", []), this.each(function () {
                    var t = !0, i = null != e && e + "queueHooks", a = he.timers, o = Ie.get(this);
                    if (i) o[i] && o[i].stop && r(o[i]); else for (i in o)o[i] && o[i].stop && gt.test(i) && r(o[i])
                    ;
                    for (i = a.length; i--;)a[i].elem !== this || null != e && a[i].queue !== e || (a[i].anim.stop(n), t = !1, a.splice(i, 1));
                    !t && n || he.dequeue(this, e)
                })
            }, finish: function (e) {
                return !1 !== e && (e = e || "fx"), this.each(function () {
                    var t, n = Ie.get(this), r = n[e + "queue"], i = n[e + "queueHooks"], a = he.timers, o = r ? r.length : 0;
                    for (n.finish = !0, he.queue(this, e, []), i && i.stop && i.stop.call(this, !0), t = a.length; t--;)a[t].elem === this && a[t].queue === e && (a[t].anim.stop(!0), a.splice(t, 1));
                    for (t = 0; t < o; t++)r[t] && r[t].finish && r[t].finish.call(this);
                    delete n.finish
                })
            }
        }), he.each(["toggle", "show", "hide"], function (e, t) {
            var n = he.fn[t];
            he.fn[t] = function (e, r, i) {
                return null == e || "boolean" == typeof e ? n.apply(this, arguments) : this.animate(W(t, !0), e, r, i)
            }
        }), he.each({
            slideDown: W("show"),
            slideUp: W("hide"),
            slideToggle: W("toggle"),
            fadeIn: {opacity: "show"},
            fadeOut: {opacity: "hide"},
            fadeToggle: {opacity: "toggle"}
        }, function (e, t) {
            he.fn[e] = function (e, n, r) {
                return this.animate(t, e, n, r)
            }
        }), he.timers = [], he.fx.tick = function () {
            var e, t = 0, n = he.timers;
            for (ft = he.now(); t < n.length; t++)(e = n[t])() || n[t] !== e || n.splice(t--, 1);
            n.length || he.fx.stop(), ft = void 0
        }, he.fx.timer = function (e) {
            he.timers.push(e), he.fx.start()
        }, he.fx.interval = 13, he.fx.start = function () {
            ht || (ht = !0, R())
        }, he.fx.stop = function () {
            ht = null
        }, he.fx.speeds = {slow: 600, fast: 200, _default: 400}, he.fn.delay = function (t, n) {
            return t = he.fx ? he.fx.speeds[t] || t : t, n = n || "fx", this.queue(n, function (n, r) {
                var i = e.setTimeout(n, t);
                r.stop = function () {
                    e.clearTimeout(i)
                }
            })
        }, function () {
            var e = ne.createElement("input"), t = ne.createElement("select"), n = t.appendChild(ne.createElement("option"));
            e.type = "checkbox", fe.checkOn = "" !== e.value, fe.optSelected = n.selected, e = ne.createElement("input"), e.value = "t", e.type = "radio", fe.radioValue = "t" === e.value
        }();
        var vt, yt = he.expr.attrHandle;
        he.fn.extend({
            attr: function (e, t) {
                return Pe(this, he.attr, e, t, arguments.length > 1)
            }, removeAttr: function (e) {
                return this.each(function () {
                    he.removeAttr(this, e)
                })
            }
        }), he.extend({
            attr: function (e, t, n) {
                var r, i, a = e.nodeType;
                if (3 !== a && 8 !== a && 2 !== a)return void 0 === e.getAttribute ? he.prop(e, t, n) : (1 === a && he.isXMLDoc(e) || (i = he.attrHooks[t.toLowerCase()] || (he.expr.match.bool.test(t) ? vt : void 0)), void 0 !== n ? null === n ? void he.removeAttr(e, t) : i && "set" in i && void 0 !== (r = i.set(e, n, t)) ? r : (e.setAttribute(t, n + ""), n) : i && "get" in i && null !== (r = i.get(e, t)) ? r : (r = he.find.attr(e, t), null == r ? void 0 : r))
            }, attrHooks: {
                type: {
                    set: function (e, t) {
                        if (!fe.radioValue && "radio" === t && i(e, "input")) {
                            var n = e.value;
                            return e.setAttribute("type", t), n && (e.value = n), t
                        }
                    }
                }
            }, removeAttr: function (e, t) {
                var n, r = 0, i = t && t.match(Ne);
                if (i && 1 === e.nodeType)for (; n = i[r++];)e.removeAttribute(n)
            }
        }), vt = {
            set: function (e, t, n) {
                return !1 === t ? he.removeAttr(e, n) : e.setAttribute(n, n), n
            }
        }, he.each(he.expr.match.bool.source.match(/\w+/g), function (e, t) {
            var n = yt[t] || he.find.attr;
            yt[t] = function (e, t, r) {
                var i, a, o = t.toLowerCase();
                return r || (a = yt[o], yt[o] = i, i = null != n(e, t, r) ? o : null, yt[o] = a), i
            }
        });
        var xt = /^(?:input|select|textarea|button)$/i, wt = /^(?:a|area)$/i;
        he.fn.extend({
            prop: function (e, t) {
                return Pe(this, he.prop, e, t, arguments.length > 1)
            }, removeProp: function (e) {
                return this.each(function () {
                    delete this[he.propFix[e] || e]
                })
            }
        }), he.extend({
            prop: function (e, t, n) {
                var r, i, a = e.nodeType;
                if (3 !== a && 8 !== a && 2 !== a)return 1 === a && he.isXMLDoc(e) || (t = he.propFix[t] || t, i = he.propHooks[t]), void 0 !== n ? i && "set" in i && void 0 !== (r = i.set(e, n, t)) ? r : e[t] = n : i && "get" in i && null !== (r = i.get(e, t)) ? r : e[t]
            }, propHooks: {
                tabIndex: {
                    get: function (e) {
                        var t = he.find.attr(e, "tabindex");
                        return t ? parseInt(t, 10) : xt.test(e.nodeName) || wt.test(e.nodeName) && e.href ? 0 : -1
                    }
                }
            }, propFix: {for: "htmlFor", class: "className"}
        }), fe.optSelected || (he.propHooks.selected = {
            get: function (e) {
                var t = e.parentNode;
                return t && t.parentNode && t.parentNode.selectedIndex, null
            }, set: function (e) {
                var t = e.parentNode;
                t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex)
            }
        }), he.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function () {
            he.propFix[this.toLowerCase()] = this
        }), he.fn.extend({
            addClass: function (e) {
                var t, n, r, i, a, o, s, l = 0;
                if (he.isFunction(e))return this.each(function (t) {
                    he(this).addClass(e.call(this, t, V(this)))
                });
                if ("string" == typeof e && e)for (t = e.match(Ne) || []; n = this[l++];)if (i = V(n), r = 1 === n.nodeType && " " + _(i) + " ") {
                    for (o = 0; a = t[o++];)r.indexOf(" " + a + " ") < 0 && (r += a + " ");
                    s = _(r), i !== s && n.setAttribute("class", s)
                }
                return this
            }, removeClass: function (e) {
                var t, n, r, i, a, o, s, l = 0;
                if (he.isFunction(e))return this.each(function (t) {
                    he(this).removeClass(e.call(this, t, V(this)))
                });
                if (!arguments.length)return this.attr("class", "");
                if ("string" == typeof e && e)for (t = e.match(Ne) || []; n = this[l++];)if (i = V(n), r = 1 === n.nodeType && " " + _(i) + " ") {
                    for (o = 0; a = t[o++];)for (; r.indexOf(" " + a + " ") > -1;)r = r.replace(" " + a + " ", " ");
                    s = _(r), i !== s && n.setAttribute("class", s)
                }
                return this
            }, toggleClass: function (e, t) {
                var n = typeof e;
                return "boolean" == typeof t && "string" === n ? t ? this.addClass(e) : this.removeClass(e) : he.isFunction(e) ? this.each(function (n) {
                            he(this).toggleClass(e.call(this, n, V(this), t), t)
                        }) : this.each(function () {
                            var t, r, i, a;
                            if ("string" === n)for (r = 0, i = he(this), a = e.match(Ne) || []; t = a[r++];)i.hasClass(t) ? i.removeClass(t) : i.addClass(t); else void 0 !== e && "boolean" !== n || (t = V(this), t && Ie.set(this, "__className__", t), this.setAttribute && this.setAttribute("class", t || !1 === e ? "" : Ie.get(this, "__className__") || ""))
                        })
            }, hasClass: function (e) {
                var t, n, r = 0;
                for (t = " " + e + " "; n = this[r++];)if (1 === n.nodeType && (" " + _(V(n)) + " ").indexOf(t) > -1)return !0;
                return !1
            }
        });
        var bt = /\r/g;
        he.fn.extend({
            val: function (e) {
                var t, n, r, i = this[0];
                {
                    if (arguments.length)return r = he.isFunction(e), this.each(function (n) {
                        var i;
                        1 === this.nodeType && (i = r ? e.call(this, n, he(this).val()) : e, null == i ? i = "" : "number" == typeof i ? i += "" : Array.isArray(i) && (i = he.map(i, function (e) {
                                    return null == e ? "" : e + ""
                                })), (t = he.valHooks[this.type] || he.valHooks[this.nodeName.toLowerCase()]) && "set" in t && void 0 !== t.set(this, i, "value") || (this.value = i))
                    });
                    if (i)return (t = he.valHooks[i.type] || he.valHooks[i.nodeName.toLowerCase()]) && "get" in t && void 0 !== (n = t.get(i, "value")) ? n : (n = i.value, "string" == typeof n ? n.replace(bt, "") : null == n ? "" : n)
                }
            }
        }), he.extend({
            valHooks: {
                option: {
                    get: function (e) {
                        var t = he.find.attr(e, "value");
                        return null != t ? t : _(he.text(e))
                    }
                }, select: {
                    get: function (e) {
                        var t, n, r, a = e.options, o = e.selectedIndex, s = "select-one" === e.type, l = s ? null : [], u = s ? o + 1 : a.length;
                        for (r = o < 0 ? u : s ? o : 0; r < u; r++)if (n = a[r], (n.selected || r === o) && !n.disabled && (!n.parentNode.disabled || !i(n.parentNode, "optgroup"))) {
                            if (t = he(n).val(), s)return t;
                            l.push(t)
                        }
                        return l
                    }, set: function (e, t) {
                        for (var n, r, i = e.options, a = he.makeArray(t), o = i.length; o--;)r = i[o], (r.selected = he.inArray(he.valHooks.option.get(r), a) > -1) && (n = !0);
                        return n || (e.selectedIndex = -1), a
                    }
                }
            }
        }), he.each(["radio", "checkbox"], function () {
            he.valHooks[this] = {
                set: function (e, t) {
                    if (Array.isArray(t))return e.checked = he.inArray(he(e).val(), t) > -1
                }
            }, fe.checkOn || (he.valHooks[this].get = function (e) {
                return null === e.getAttribute("value") ? "on" : e.value
            })
        });
        var Tt = /^(?:focusinfocus|focusoutblur)$/;
        he.extend(he.event, {
            trigger: function (t, n, r, i) {
                var a, o, s, l, u, c, p, d = [r || ne], f = ce.call(t, "type") ? t.type : t, h = ce.call(t, "namespace") ? t.namespace.split(".") : [];
                if (o = s = r = r || ne, 3 !== r.nodeType && 8 !== r.nodeType && !Tt.test(f + he.event.triggered) && (f.indexOf(".") > -1 && (h = f.split("."), f = h.shift(), h.sort()), u = f.indexOf(":") < 0 && "on" + f, t = t[he.expando] ? t : new he.Event(f, "object" == typeof t && t), t.isTrigger = i ? 2 : 3, t.namespace = h.join("."), t.rnamespace = t.namespace ? new RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, t.result = void 0, t.target || (t.target = r), n = null == n ? [t] : he.makeArray(n, [t]), p = he.event.special[f] || {}, i || !p.trigger || !1 !== p.trigger.apply(r, n))) {
                    if (!i && !p.noBubble && !he.isWindow(r)) {
                        for (l = p.delegateType || f, Tt.test(l + f) || (o = o.parentNode); o; o = o.parentNode)d.push(o), s = o;
                        s === (r.ownerDocument || ne) && d.push(s.defaultView || s.parentWindow || e)
                    }
                    for (a = 0; (o = d[a++]) && !t.isPropagationStopped();)t.type = a > 1 ? l : p.bindType || f, c = (Ie.get(o, "events") || {})[t.type] && Ie.get(o, "handle"), c && c.apply(o, n), (c = u && o[u]) && c.apply && ze(o) && (t.result = c.apply(o, n), !1 === t.result && t.preventDefault());
                    return t.type = f, i || t.isDefaultPrevented() || p._default && !1 !== p._default.apply(d.pop(), n) || !ze(r) || u && he.isFunction(r[f]) && !he.isWindow(r) && (s = r[u], s && (r[u] = null), he.event.triggered = f, r[f](), he.event.triggered = void 0, s && (r[u] = s)), t.result
                }
            }, simulate: function (e, t, n) {
                var r = he.extend(new he.Event, n, {type: e, isSimulated: !0});
                he.event.trigger(r, null, t)
            }
        }), he.fn.extend({
            trigger: function (e, t) {
                return this.each(function () {
                    he.event.trigger(e, t, this)
                })
            }, triggerHandler: function (e, t) {
                var n = this[0];
                if (n)return he.event.trigger(e, t, n, !0)
            }
        }), he.each("blur focus focusin focusout resize scroll click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup contextmenu".split(" "), function (e, t) {
            he.fn[t] = function (e, n) {
                return arguments.length > 0 ? this.on(t, null, e, n) : this.trigger(t)
            }
        }), he.fn.extend({
            hover: function (e, t) {
                return this.mouseenter(e).mouseleave(t || e)
            }
        }), fe.focusin = "onfocusin" in e, fe.focusin || he.each({focus: "focusin", blur: "focusout"}, function (e, t) {
            var n = function (e) {
                he.event.simulate(t, e.target, he.event.fix(e))
            };
            he.event.special[t] = {
                setup: function () {
                    var r = this.ownerDocument || this, i = Ie.access(r, t);
                    i || r.addEventListener(e, n, !0), Ie.access(r, t, (i || 0) + 1)
                }, teardown: function () {
                    var r = this.ownerDocument || this, i = Ie.access(r, t) - 1;
                    i ? Ie.access(r, t, i) : (r.removeEventListener(e, n, !0), Ie.remove(r, t))
                }
            }
        });
        var Ct = e.location, St = he.now(), Et = /\?/;
        he.parseXML = function (t) {
            var n;
            if (!t || "string" != typeof t)return null;
            try {
                n = (new e.DOMParser).parseFromString(t, "text/xml")
            } catch (e) {
                n = void 0
            }
            return n && !n.getElementsByTagName("parsererror").length || he.error("Invalid XML: " + t), n
        };
        var kt = /\[\]$/, Dt = /\r?\n/g, Mt = /^(?:submit|button|image|reset|file)$/i, Nt = /^(?:input|select|textarea|keygen)/i;
        he.param = function (e, t) {
            var n, r = [], i = function (e, t) {
                var n = he.isFunction(t) ? t() : t;
                r[r.length] = encodeURIComponent(e) + "=" + encodeURIComponent(null == n ? "" : n)
            };
            if (Array.isArray(e) || e.jquery && !he.isPlainObject(e)) he.each(e, function () {
                i(this.name, this.value)
            }); else for (n in e)U(n, e[n], t, i);
            return r.join("&")
        }, he.fn.extend({
            serialize: function () {
                return he.param(this.serializeArray())
            }, serializeArray: function () {
                return this.map(function () {
                    var e = he.prop(this, "elements");
                    return e ? he.makeArray(e) : this
                }).filter(function () {
                    var e = this.type;
                    return this.name && !he(this).is(":disabled") && Nt.test(this.nodeName) && !Mt.test(e) && (this.checked || !Ye.test(e))
                }).map(function (e, t) {
                    var n = he(this).val();
                    return null == n ? null : Array.isArray(n) ? he.map(n, function (e) {
                                return {name: t.name, value: e.replace(Dt, "\r\n")}
                            }) : {name: t.name, value: n.replace(Dt, "\r\n")}
                }).get()
            }
        });
        var At = /%20/g, Lt = /#.*$/, Pt = /([?&])_=[^&]*/, zt = /^(.*?):[ \t]*([^\r\n]*)$/gm, It = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/, jt = /^(?:GET|HEAD)$/, Ht = /^\/\//, qt = {}, Ot = {}, Bt = "*/".concat("*"), Rt = ne.createElement("a");
        Rt.href = Ct.href, he.extend({
            active: 0,
            lastModified: {},
            etag: {},
            ajaxSettings: {
                url: Ct.href,
                type: "GET",
                isLocal: It.test(Ct.protocol),
                global: !0,
                processData: !0,
                async: !0,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                accepts: {
                    "*": Bt,
                    text: "text/plain",
                    html: "text/html",
                    xml: "application/xml, text/xml",
                    json: "application/json, text/javascript"
                },
                contents: {xml: /\bxml\b/, html: /\bhtml/, json: /\bjson\b/},
                responseFields: {xml: "responseXML", text: "responseText", json: "responseJSON"},
                converters: {"* text": String, "text html": !0, "text json": JSON.parse, "text xml": he.parseXML},
                flatOptions: {url: !0, context: !0}
            },
            ajaxSetup: function (e, t) {
                return t ? J(J(e, he.ajaxSettings), t) : J(he.ajaxSettings, e)
            },
            ajaxPrefilter: K(qt),
            ajaxTransport: K(Ot),
            ajax: function (t, n) {
                function r(t, n, r, s) {
                    var u, d, f, w, b, T = n;
                    c || (c = !0, l && e.clearTimeout(l), i = void 0, o = s || "", C.readyState = t > 0 ? 4 : 0, u = t >= 200 && t < 300 || 304 === t, r && (w = Z(h, C, r)), w = ee(h, w, C, u), u ? (h.ifModified && (b = C.getResponseHeader("Last-Modified"), b && (he.lastModified[a] = b), (b = C.getResponseHeader("etag")) && (he.etag[a] = b)), 204 === t || "HEAD" === h.type ? T = "nocontent" : 304 === t ? T = "notmodified" : (T = w.state, d = w.data, f = w.error, u = !f)) : (f = T, !t && T || (T = "error", t < 0 && (t = 0))), C.status = t, C.statusText = (n || T) + "", u ? v.resolveWith(m, [d, T, C]) : v.rejectWith(m, [C, T, f]), C.statusCode(x), x = void 0, p && g.trigger(u ? "ajaxSuccess" : "ajaxError", [C, h, u ? d : f]), y.fireWith(m, [C, T]), p && (g.trigger("ajaxComplete", [C, h]), --he.active || he.event.trigger("ajaxStop")))
                }

                "object" == typeof t && (n = t, t = void 0), n = n || {};
                var i, a, o, s, l, u, c, p, d, f, h = he.ajaxSetup({}, n), m = h.context || h, g = h.context && (m.nodeType || m.jquery) ? he(m) : he.event, v = he.Deferred(), y = he.Callbacks("once memory"), x = h.statusCode || {}, w = {}, b = {}, T = "canceled", C = {
                    readyState: 0,
                    getResponseHeader: function (e) {
                        var t;
                        if (c) {
                            if (!s)for (s = {}; t = zt.exec(o);)s[t[1].toLowerCase()] = t[2];
                            t = s[e.toLowerCase()]
                        }
                        return null == t ? null : t
                    },
                    getAllResponseHeaders: function () {
                        return c ? o : null
                    },
                    setRequestHeader: function (e, t) {
                        return null == c && (e = b[e.toLowerCase()] = b[e.toLowerCase()] || e, w[e] = t), this
                    },
                    overrideMimeType: function (e) {
                        return null == c && (h.mimeType = e), this
                    },
                    statusCode: function (e) {
                        var t;
                        if (e)if (c) C.always(e[C.status]); else for (t in e)x[t] = [x[t], e[t]];
                        return this
                    },
                    abort: function (e) {
                        var t = e || T;
                        return i && i.abort(t), r(0, t), this
                    }
                };
                if (v.promise(C), h.url = ((t || h.url || Ct.href) + "").replace(Ht, Ct.protocol + "//"), h.type = n.method || n.type || h.method || h.type, h.dataTypes = (h.dataType || "*").toLowerCase().match(Ne) || [""], null == h.crossDomain) {
                    u = ne.createElement("a");
                    try {
                        u.href = h.url, u.href = u.href, h.crossDomain = Rt.protocol + "//" + Rt.host != u.protocol + "//" + u.host
                    } catch (e) {
                        h.crossDomain = !0
                    }
                }
                if (h.data && h.processData && "string" != typeof h.data && (h.data = he.param(h.data, h.traditional)), Q(qt, h, n, C), c)return C;
                p = he.event && h.global, p && 0 == he.active++ && he.event.trigger("ajaxStart"), h.type = h.type.toUpperCase(), h.hasContent = !jt.test(h.type), a = h.url.replace(Lt, ""), h.hasContent ? h.data && h.processData && 0 === (h.contentType || "").indexOf("application/x-www-form-urlencoded") && (h.data = h.data.replace(At, "+")) : (f = h.url.slice(a.length), h.data && (a += (Et.test(a) ? "&" : "?") + h.data, delete h.data), !1 === h.cache && (a = a.replace(Pt, "$1"), f = (Et.test(a) ? "&" : "?") + "_=" + St++ + f), h.url = a + f), h.ifModified && (he.lastModified[a] && C.setRequestHeader("If-Modified-Since", he.lastModified[a]), he.etag[a] && C.setRequestHeader("If-None-Match", he.etag[a])), (h.data && h.hasContent && !1 !== h.contentType || n.contentType) && C.setRequestHeader("Content-Type", h.contentType), C.setRequestHeader("Accept", h.dataTypes[0] && h.accepts[h.dataTypes[0]] ? h.accepts[h.dataTypes[0]] + ("*" !== h.dataTypes[0] ? ", " + Bt + "; q=0.01" : "") : h.accepts["*"]);
                for (d in h.headers)C.setRequestHeader(d, h.headers[d]);
                if (h.beforeSend && (!1 === h.beforeSend.call(m, C, h) || c))return C.abort();
                if (T = "abort", y.add(h.complete), C.done(h.success), C.fail(h.error), i = Q(Ot, h, n, C)) {
                    if (C.readyState = 1, p && g.trigger("ajaxSend", [C, h]), c)return C;
                    h.async && h.timeout > 0 && (l = e.setTimeout(function () {
                        C.abort("timeout")
                    }, h.timeout));
                    try {
                        c = !1, i.send(w, r)
                    } catch (e) {
                        if (c)throw e;
                        r(-1, e)
                    }
                } else r(-1, "No Transport");
                return C
            },
            getJSON: function (e, t, n) {
                return he.get(e, t, n, "json")
            },
            getScript: function (e, t) {
                return he.get(e, void 0, t, "script")
            }
        }), he.each(["get", "post"], function (e, t) {
            he[t] = function (e, n, r, i) {
                return he.isFunction(n) && (i = i || r, r = n, n = void 0), he.ajax(he.extend({
                    url: e,
                    type: t,
                    dataType: i,
                    data: n,
                    success: r
                }, he.isPlainObject(e) && e))
            }
        }), he._evalUrl = function (e) {
            return he.ajax({url: e, type: "GET", dataType: "script", cache: !0, async: !1, global: !1, throws: !0})
        }, he.fn.extend({
            wrapAll: function (e) {
                var t;
                return this[0] && (he.isFunction(e) && (e = e.call(this[0])), t = he(e, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && t.insertBefore(this[0]), t.map(function () {
                    for (var e = this; e.firstElementChild;)e = e.firstElementChild;
                    return e
                }).append(this)), this
            }, wrapInner: function (e) {
                return he.isFunction(e) ? this.each(function (t) {
                        he(this).wrapInner(e.call(this, t))
                    }) : this.each(function () {
                        var t = he(this), n = t.contents();
                        n.length ? n.wrapAll(e) : t.append(e)
                    })
            }, wrap: function (e) {
                var t = he.isFunction(e);
                return this.each(function (n) {
                    he(this).wrapAll(t ? e.call(this, n) : e)
                })
            }, unwrap: function (e) {
                return this.parent(e).not("body").each(function () {
                    he(this).replaceWith(this.childNodes)
                }), this
            }
        }), he.expr.pseudos.hidden = function (e) {
            return !he.expr.pseudos.visible(e)
        }, he.expr.pseudos.visible = function (e) {
            return !!(e.offsetWidth || e.offsetHeight || e.getClientRects().length)
        }, he.ajaxSettings.xhr = function () {
            try {
                return new e.XMLHttpRequest
            } catch (e) {
            }
        };
        var Ft = {0: 200, 1223: 204}, Wt = he.ajaxSettings.xhr();
        fe.cors = !!Wt && "withCredentials" in Wt, fe.ajax = Wt = !!Wt, he.ajaxTransport(function (t) {
            var n, r;
            if (fe.cors || Wt && !t.crossDomain)return {
                send: function (i, a) {
                    var o, s = t.xhr();
                    if (s.open(t.type, t.url, t.async, t.username, t.password), t.xhrFields)for (o in t.xhrFields)s[o] = t.xhrFields[o];
                    t.mimeType && s.overrideMimeType && s.overrideMimeType(t.mimeType), t.crossDomain || i["X-Requested-With"] || (i["X-Requested-With"] = "XMLHttpRequest");
                    for (o in i)s.setRequestHeader(o, i[o]);
                    n = function (e) {
                        return function () {
                            n && (n = r = s.onload = s.onerror = s.onabort = s.onreadystatechange = null, "abort" === e ? s.abort() : "error" === e ? "number" != typeof s.status ? a(0, "error") : a(s.status, s.statusText) : a(Ft[s.status] || s.status, s.statusText, "text" !== (s.responseType || "text") || "string" != typeof s.responseText ? {binary: s.response} : {text: s.responseText}, s.getAllResponseHeaders()))
                        }
                    }, s.onload = n(), r = s.onerror = n("error"), void 0 !== s.onabort ? s.onabort = r : s.onreadystatechange = function () {
                            4 === s.readyState && e.setTimeout(function () {
                                n && r()
                            })
                        }, n = n("abort");
                    try {
                        s.send(t.hasContent && t.data || null)
                    } catch (e) {
                        if (n)throw e
                    }
                }, abort: function () {
                    n && n()
                }
            }
        }), he.ajaxPrefilter(function (e) {
            e.crossDomain && (e.contents.script = !1)
        }), he.ajaxSetup({
            accepts: {script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},
            contents: {script: /\b(?:java|ecma)script\b/},
            converters: {
                "text script": function (e) {
                    return he.globalEval(e), e
                }
            }
        }), he.ajaxPrefilter("script", function (e) {
            void 0 === e.cache && (e.cache = !1), e.crossDomain && (e.type = "GET")
        }), he.ajaxTransport("script", function (e) {
            if (e.crossDomain) {
                var t, n;
                return {
                    send: function (r, i) {
                        t = he("<script>").prop({charset: e.scriptCharset, src: e.url}).on("load error", n = function (e) {
                            t.remove(), n = null, e && i("error" === e.type ? 404 : 200, e.type)
                        }), ne.head.appendChild(t[0])
                    }, abort: function () {
                        n && n()
                    }
                }
            }
        });
        var Xt = [], Yt = /(=)\?(?=&|$)|\?\?/;
        he.ajaxSetup({
            jsonp: "callback", jsonpCallback: function () {
                var e = Xt.pop() || he.expando + "_" + St++;
                return this[e] = !0, e
            }
        }), he.ajaxPrefilter("json jsonp", function (t, n, r) {
            var i, a, o, s = !1 !== t.jsonp && (Yt.test(t.url) ? "url" : "string" == typeof t.data && 0 === (t.contentType || "").indexOf("application/x-www-form-urlencoded") && Yt.test(t.data) && "data");
            if (s || "jsonp" === t.dataTypes[0])return i = t.jsonpCallback = he.isFunction(t.jsonpCallback) ? t.jsonpCallback() : t.jsonpCallback, s ? t[s] = t[s].replace(Yt, "$1" + i) : !1 !== t.jsonp && (t.url += (Et.test(t.url) ? "&" : "?") + t.jsonp + "=" + i), t.converters["script json"] = function () {
                return o || he.error(i + " was not called"), o[0]
            }, t.dataTypes[0] = "json", a = e[i], e[i] = function () {
                o = arguments
            }, r.always(function () {
                void 0 === a ? he(e).removeProp(i) : e[i] = a, t[i] && (t.jsonpCallback = n.jsonpCallback, Xt.push(i)), o && he.isFunction(a) && a(o[0]), o = a = void 0
            }), "script"
        }), fe.createHTMLDocument = function () {
            var e = ne.implementation.createHTMLDocument("").body;
            return e.innerHTML = "<form></form><form></form>", 2 === e.childNodes.length
        }(), he.parseHTML = function (e, t, n) {
            if ("string" != typeof e)return [];
            "boolean" == typeof t && (n = t, t = !1);
            var r, i, a;
            return t || (fe.createHTMLDocument ? (t = ne.implementation.createHTMLDocument(""), r = t.createElement("base"), r.href = ne.location.href, t.head.appendChild(r)) : t = ne), i = Ce.exec(e), a = !n && [], i ? [t.createElement(i[1])] : (i = w([e], t, a), a && a.length && he(a).remove(), he.merge([], i.childNodes))
        }, he.fn.load = function (e, t, n) {
            var r, i, a, o = this, s = e.indexOf(" ");
            return s > -1 && (r = _(e.slice(s)), e = e.slice(0, s)), he.isFunction(t) ? (n = t, t = void 0): t
            &&
            "object" == typeof t && (i = "POST"), o.length > 0 && he.ajax({
                url: e,
                type: i || "GET",
                dataType: "html",
                data: t
            }).done(function (e) {
                a = arguments, o.html(r ? he("<div>").append(he.parseHTML(e)).find(r) : e)
            }).always(n && function (e, t) {
                    o.each(function () {
                        n.apply(this, a || [e.responseText, t, e])
                    })
                }), this
        }, he.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function (e, t) {
            he.fn[t] = function (e) {
                return this.on(t, e)
            }
        }), he.expr.pseudos.animated = function (e) {
            return he.grep(he.timers, function (t) {
                return e === t.elem
            }).length
        }, he.offset = {
            setOffset: function (e, t, n) {
                var r, i, a, o, s, l, u, c = he.css(e, "position"), p = he(e), d = {};
                "static" === c && (e.style.position = "relative"), s = p.offset(), a = he.css(e, "top"), l = he.css(e, "left"), u = ("absolute" === c || "fixed" === c) && (a + l).indexOf("auto") > -1, u ? (r = p.position(), o = r.top, i = r.left) : (o = parseFloat(a) || 0, i = parseFloat(l) || 0), he.isFunction(t) && (t = t.call(e, n, he.extend({}, s))), null != t.top && (d.top = t.top - s.top + o), null != t.left && (d.left = t.left - s.left + i), "using" in t ? t.using.call(e, d) : p.css(d)
            }
        }, he.fn.extend({
            offset: function (e) {
                if (arguments.length)return void 0 === e ? this : this.each(function (t) {
                        he.offset.setOffset(this, e, t)
                    });
                var t, n, r, i, a = this[0];
                if (a)return a.getClientRects().length ? (r = a.getBoundingClientRect(), t = a.ownerDocument, n = t.documentElement, i = t.defaultView, {
                        top: r.top + i.pageYOffset - n.clientTop,
                        left: r.left + i.pageXOffset - n.clientLeft
                    }) : {top: 0, left: 0}
            }, position: function () {
                if (this[0]) {
                    var e, t, n = this[0], r = {top: 0, left: 0};
                    return "fixed" === he.css(n, "position") ? t = n.getBoundingClientRect() : (e = this.offsetParent(), t = this.offset(), i(e[0], "html") || (r = e.offset()), r = {
                            top: r.top + he.css(e[0], "borderTopWidth", !0),
                            left: r.left + he.css(e[0], "borderLeftWidth", !0)
                        }), {
                        top: t.top - r.top - he.css(n, "marginTop", !0),
                        left: t.left - r.left - he.css(n, "marginLeft", !0)
                    }
                }
            }, offsetParent: function () {
                return this.map(function () {
                    for (var e = this.offsetParent; e && "static" === he.css(e, "position");)e = e.offsetParent;
                    return e || Ue
                })
            }
        }), he.each({scrollLeft: "pageXOffset", scrollTop: "pageYOffset"}, function (e, t) {
            var n = "pageYOffset" === t;
            he.fn[e] = function (r) {
                return Pe(this, function (e, r, i) {
                    var a;
                    if (he.isWindow(e) ? a = e : 9 === e.nodeType && (a = e.defaultView), void 0 === i)return a ? a[t] : e[r];
                    a ? a.scrollTo(n ? a.pageXOffset : i, n ? i : a.pageYOffset) : e[r] = i
                }, e, r, arguments.length)
            }
        }), he.each(["top", "left"], function (e, t) {
            he.cssHooks[t] = z(fe.pixelPosition, function (e, n) {
                if (n)return n = P(e, t), at.test(n) ? he(e).position()[t] + "px" : n
            })
        }), he.each({Height: "height", Width: "width"}, function (e, t) {
            he.each({padding: "inner" + e, content: t, "": "outer" + e}, function (n, r) {
                he.fn[r] = function (i, a) {
                    var o = arguments.length && (n || "boolean" != typeof i), s = n || (!0 === i || !0 === a ? "margin" : "border");
                    return Pe(this, function (t, n, i) {
                        var a;
                        return he.isWindow(t) ? 0 === r.indexOf("outer") ? t["inner" + e] : t.document.documentElement["client" + e] : 9 === t.nodeType ? (a = t.documentElement, Math.max(t.body["scroll" + e], a["scroll" + e], t.body["offset" + e], a["offset" + e], a["client" + e])) : void 0 === i ? he.css(t, n, s) : he.style(t, n, i, s)
                    }, t, o ? i : void 0, o)
                }
            })
        }), he.fn.extend({
            bind: function (e, t, n) {
                return this.on(e, null, t, n)
            }, unbind: function (e, t) {
                return this.off(e, null, t)
            }, delegate: function (e, t, n, r) {
                return this.on(t, e, n, r)
            }, undelegate: function (e, t, n) {
                return 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", n)
            }
        }), he.holdReady = function (e) {
            e ? he.readyWait++ : he.ready(!0)
        }, he.isArray = Array.isArray, he.parseJSON = JSON.parse, he.nodeName = i, "function" == typeof define && define.amd && define("jquery", [], function () {
            return he
        });
        var Gt = e.jQuery, $t = e.$;
        return he.noConflict = function (t) {
            return e.$ === he && (e.$ = $t), t && e.jQuery === he && (e.jQuery = Gt), he
        }, t || (e.jQuery = e.$ = he), he
    }), function (e, t) {
        "use strict";
        "function" == typeof define && define.amd ? define(["jquery"], t) : "object" == typeof exports ? module.exports = t(require("jquery")) : e.Swiper = t(e.jQuery)
    }(this, function (e) {
        "use strict";
        var t = function (n, r) {
            function i(e) {
                return Math.floor(e)
            }

            function a() {
                var e = w.params.autoplay, t = w.slides.eq(w.activeIndex);
                t.attr("data-swiper-autoplay") && (e = t.attr("data-swiper-autoplay") || w.params.autoplay), w.autoplayTimeoutId = setTimeout(function () {
                    w.params.loop ? (w.fixLoop(), w._slideNext(), w.emit("onAutoplay", w)) : w.isEnd ? r.autoplayStopOnLast ? w.stopAutoplay() : (w._slideTo(0), w.emit("onAutoplay", w)) : (w._slideNext(), w.emit("onAutoplay", w))
                }, e)
            }

            function o(t, n) {
                var r = e(t.target);
                if (!r.is(n))if ("string" == typeof n) r = r.parents(n); else if (n.nodeType) {
                    var i;
                    return r.parents().each(function (e, t) {
                        t === n && (i = n)
                    }), i ? n : void 0
                }
                if (0 !== r.length)return r[0]
            }

            function s(e, t) {
                t = t || {};
                var n = window.MutationObserver || window.WebkitMutationObserver, r = new n(function (e) {
                    e.forEach(function (e) {
                        w.onResize(!0), w.emit("onObserverUpdate", w, e)
                    })
                });
                r.observe(e, {
                    attributes: void 0 === t.attributes || t.attributes,
                    childList: void 0 === t.childList || t.childList,
                    characterData: void 0 === t.characterData || t.characterData
                }), w.observers.push(r)
            }

            function l(e) {
                e.originalEvent && (e = e.originalEvent);
                var t = e.keyCode || e.charCode;
                if (!w.params.allowSwipeToNext && (w.isHorizontal() && 39 === t || !w.isHorizontal() && 40 === t))return !1;
                if (!w.params.allowSwipeToPrev && (w.isHorizontal() && 37 === t || !w.isHorizontal() && 38 === t))return !1;
                if (!(e.shiftKey || e.altKey || e.ctrlKey || e.metaKey || document.activeElement && document.activeElement.nodeName && ("input" === document.activeElement.nodeName.toLowerCase() || "textarea" === document.activeElement.nodeName.toLowerCase()))) {
                    if (37 === t || 39 === t || 38 === t || 40 === t) {
                        var n = !1;
                        if (w.container.parents("." + w.params.slideClass).length > 0 && 0 === w.container.parents("." + w.params.slideActiveClass).length)return;
                        var r = {
                            left: window.pageXOffset,
                            top: window.pageYOffset
                        }, i = window.innerWidth, a = window.innerHeight, o = w.container.offset();
                        w.rtl && (o.left = o.left - w.container[0].scrollLeft);
                        for (var s = [[o.left, o.top], [o.left + w.width, o.top], [o.left, o.top + w.height], [o.left + w.width, o.top + w.height]], l = 0; l < s.length; l++) {
                            var u = s[l];
                            u[0] >= r.left && u[0] <= r.left + i && u[1] >= r.top && u[1] <= r.top + a && (n = !0)
                        }
                        if (!n)return
                    }
                    w.isHorizontal() ? (37 !== t && 39 !== t || (e.preventDefault ? e.preventDefault() : e.returnValue = !1), (39 === t && !w.rtl || 37 === t && w.rtl) && w.slideNext(), (37 === t && !w.rtl || 39 === t && w.rtl) && w.slidePrev()) : (38 !== t && 40 !== t || (e.preventDefault ? e.preventDefault() : e.returnValue = !1), 40 === t && w.slideNext(), 38 === t && w.slidePrev()), w.emit("onKeyPress", w, t)
                }
            }

            function u(e) {
                var t = 0, n = 0, r = 0, i = 0;
                return "detail" in e && (n = e.detail), "wheelDelta" in e && (n = -e.wheelDelta / 120), "wheelDeltaY" in e && (n = -e.wheelDeltaY / 120), "wheelDeltaX" in e && (t = -e.wheelDeltaX / 120), "axis" in e && e.axis === e.HORIZONTAL_AXIS && (t = n, n = 0), r = 10 * t, i = 10 * n, "deltaY" in e && (i = e.deltaY), "deltaX" in e && (r = e.deltaX), (r || i) && e.deltaMode && (1 === e.deltaMode ? (r *= 40, i *= 40) : (r *= 800, i *= 800)), r && !t && (t = r < 1 ? -1 : 1), i && !n && (n = i < 1 ? -1 : 1), {
                    spinX: t,
                    spinY: n,
                    pixelX: r,
                    pixelY: i
                }
            }

            function c(e) {
                e.originalEvent && (e = e.originalEvent);
                var t = 0, n = w.rtl ? -1 : 1, r = u(e);
                if (w.params.mousewheelForceToAxis)if (w.isHorizontal()) {
                    if (!(Math.abs(r.pixelX) > Math.abs(r.pixelY)))return;
                    t = r.pixelX * n
                } else {
                    if (!(Math.abs(r.pixelY) > Math.abs(r.pixelX)))return;
                    t = r.pixelY
                } else t = Math.abs(r.pixelX) > Math.abs(r.pixelY) ? -r.pixelX * n : -r.pixelY;
                if (0 !== t) {
                    if (w.params.mousewheelInvert && (t = -t), w.params.freeMode) {
                        var i = w.getWrapperTranslate() + t * w.params.mousewheelSensitivity, a = w.isBeginning, o = w.isEnd;
                        if (i >= w.minTranslate() && (i = w.minTranslate()), i <= w.maxTranslate() && (i = w.maxTranslate()), w.setWrapperTransition(0), w.setWrapperTranslate(i), w.updateProgress(), w.updateActiveIndex(), (!a && w.isBeginning || !o && w.isEnd) && w.updateClasses(), w.params.freeModeSticky ? (clearTimeout(w.mousewheel.timeout), w.mousewheel.timeout = setTimeout(function () {
                                    w.slideReset()
                                }, 300)) : w.params.lazyLoading && w.lazy && w.lazy.load(), w.emit("onScroll", w, e), w.params.autoplay && w.params.autoplayDisableOnInteraction && w.stopAutoplay(), 0 === i || i === w.maxTranslate())return
                    } else {
                        if ((new window.Date).getTime() - w.mousewheel.lastScrollTime > 60)if (t < 0)if (w.isEnd && !w.params.loop || w.animating) {
                            if (w.params.mousewheelReleaseOnEdges)return !0
                        } else w.slideNext(), w.emit("onScroll", w, e); else if (w.isBeginning && !w.params.loop || w.animating) {
                            if (w.params.mousewheelReleaseOnEdges)return !0
                        } else w.slidePrev(), w.emit("onScroll", w, e);
                        w.mousewheel.lastScrollTime = (new window.Date).getTime()
                    }
                    return e.preventDefault ? e.preventDefault() : e.returnValue = !1, !1
                }
            }

            function p(t, n) {
                t = e(t);
                var r, i, a, o = w.rtl ? -1 : 1;
                r = t.attr("data-swiper-parallax") || "0", i = t.attr("data-swiper-parallax-x"), a = t.attr("data-swiper-parallax-y"), i || a ? (i = i || "0", a = a || "0"): w.isHorizontal() ? (i = r, a = "0") : (a = r, i = "0"), i = i.indexOf("%") >= 0 ? parseInt(i, 10) * n * o + "%" : i * n * o + "px", a = a.indexOf("%") >= 0 ? parseInt(a, 10) * n + "%" : a * n + "px", t.transform("translate3d(" + i + ", " + a + ",0px)")
            }

            function d(e) {
                return 0 !== e.indexOf("on") && (e = e[0] !== e[0].toUpperCase() ? "on" + e[0].toUpperCase() + e.substring(1) : "on" + e), e
            }

            if (!(this instanceof t))return new t(n, r);
            var f = {
                direction: "horizontal",
                touchEventsTarget: "container",
                initialSlide: 0,
                speed: 300,
                autoplay: !1,
                autoplayDisableOnInteraction: !0,
                autoplayStopOnLast: !1,
                iOSEdgeSwipeDetection: !1,
                iOSEdgeSwipeThreshold: 20,
                freeMode: !1,
                freeModeMomentum: !0,
                freeModeMomentumRatio: 1,
                freeModeMomentumBounce: !0,
                freeModeMomentumBounceRatio: 1,
                freeModeMomentumVelocityRatio: 1,
                freeModeSticky: !1,
                freeModeMinimumVelocity: .02,
                autoHeight: !1,
                setWrapperSize: !1,
                virtualTranslate: !1,
                effect: "slide",
                coverflow: {rotate: 50, stretch: 0, depth: 100, modifier: 1, slideShadows: !0},
                flip: {slideShadows: !0, limitRotation: !0},
                cube: {slideShadows: !0, shadow: !0, shadowOffset: 20, shadowScale: .94},
                fade: {crossFade: !1},
                parallax: !1,
                zoom: !1,
                zoomMax: 3,
                zoomMin: 1,
                zoomToggle: !0,
                scrollbar: null,
                scrollbarHide: !0,
                scrollbarDraggable: !1,
                scrollbarSnapOnRelease: !1,
                keyboardControl: !1,
                mousewheelControl: !1,
                mousewheelReleaseOnEdges: !1,
                mousewheelInvert: !1,
                mousewheelForceToAxis: !1,
                mousewheelSensitivity: 1,
                mousewheelEventsTarged: "container",
                hashnav: !1,
                hashnavWatchState: !1,
                history: !1,
                replaceState: !1,
                breakpoints: void 0,
                spaceBetween: 0,
                slidesPerView: 1,
                slidesPerColumn: 1,
                slidesPerColumnFill: "column",
                slidesPerGroup: 1,
                centeredSlides: !1,
                slidesOffsetBefore: 0,
                slidesOffsetAfter: 0,
                roundLengths: !1,
                touchRatio: 1,
                touchAngle: 45,
                simulateTouch: !0,
                shortSwipes: !0,
                longSwipes: !0,
                longSwipesRatio: .5,
                longSwipesMs: 300,
                followFinger: !0,
                onlyExternal: !1,
                threshold: 0,
                touchMoveStopPropagation: !0,
                touchReleaseOnEdges: !1,
                uniqueNavElements: !0,
                pagination: null,
                paginationElement: "span",
                paginationClickable: !1,
                paginationHide: !1,
                paginationBulletRender: null,
                paginationProgressRender: null,
                paginationFractionRender: null,
                paginationCustomRender: null,
                paginationType: "bullets",
                resistance: !0,
                resistanceRatio: .85,
                nextButton: null,
                prevButton: null,
                watchSlidesProgress: !1,
                watchSlidesVisibility: !1,
                grabCursor: !1,
                preventClicks: !0,
                preventClicksPropagation: !0,
                slideToClickedSlide: !1,
                lazyLoading: !1,
                lazyLoadingInPrevNext: !1,
                lazyLoadingInPrevNextAmount: 1,
                lazyLoadingOnTransitionStart: !1,
                preloadImages: !0,
                updateOnImagesReady: !0,
                loop: !1,
                loopAdditionalSlides: 0,
                loopedSlides: null,
                control: void 0,
                controlInverse: !1,
                controlBy: "slide",
                normalizeSlideIndex: !0,
                allowSwipeToPrev: !0,
                allowSwipeToNext: !0,
                swipeHandler: null,
                noSwiping: !0,
                noSwipingClass: "swiper-no-swiping",
                passiveListeners: !0,
                containerModifierClass: "swiper-container-",
                slideClass: "swiper-slide",
                slideActiveClass: "swiper-slide-active",
                slideDuplicateActiveClass: "swiper-slide-duplicate-active",
                slideVisibleClass: "swiper-slide-visible",
                slideDuplicateClass: "swiper-slide-duplicate",
                slideNextClass: "swiper-slide-next",
                slideDuplicateNextClass: "swiper-slide-duplicate-next",
                slidePrevClass: "swiper-slide-prev",
                slideDuplicatePrevClass: "swiper-slide-duplicate-prev",
                wrapperClass: "swiper-wrapper",
                bulletClass: "swiper-pagination-bullet",
                bulletActiveClass: "swiper-pagination-bullet-active",
                buttonDisabledClass: "swiper-button-disabled",
                paginationCurrentClass: "swiper-pagination-current",
                paginationTotalClass: "swiper-pagination-total",
                paginationHiddenClass: "swiper-pagination-hidden",
                paginationProgressbarClass: "swiper-pagination-progressbar",
                paginationClickableClass: "swiper-pagination-clickable",
                paginationModifierClass: "swiper-pagination-",
                lazyLoadingClass: "swiper-lazy",
                lazyStatusLoadingClass: "swiper-lazy-loading",
                lazyStatusLoadedClass: "swiper-lazy-loaded",
                lazyPreloaderClass: "swiper-lazy-preloader",
                notificationClass: "swiper-notification",
                preloaderClass: "preloader",
                zoomContainerClass: "swiper-zoom-container",
                observer: !1,
                observeParents: !1,
                a11y: !1,
                prevSlideMessage: "Previous slide",
                nextSlideMessage: "Next slide",
                firstSlideMessage: "This is the first slide",
                lastSlideMessage: "This is the last slide",
                paginationBulletMessage: "Go to slide {{index}}",
                runCallbacksOnInit: !0
            }, h = r && r.virtualTranslate;
            r = r || {};
            var m = {};
            for (var g in r)if ("object" != typeof r[g] || null === r[g] || (r[g].nodeType || r[g] === window || r[g] === document || "undefined" != typeof Dom7 && r[g] instanceof Dom7 || "undefined" != typeof jQuery && r[g] instanceof jQuery)) m[g] = r[g]; else {
                m[g] = {}
                ;
                for (var v in r[g])m[g][v] = r[g][v]
            }
            for (var y in f)if (void 0 === r[y]) r[y] = f[y]; else if ("object" == typeof r[y])for (var x in f[y])void 0 === r[y][x] && (r[y][x] = f[y][x]);
            var w = this;
            if (w.params = r, w.originalParams = m, w.classNames = [], void 0 !== e && "undefined" != typeof Dom7 && (e = Dom7), (void 0 !== e || (e = "undefined" == typeof Dom7 ? window.Dom7 || window.Zepto || window.jQuery : Dom7)) && (w.$ = e, w.currentBreakpoint = void 0, w.getActiveBreakpoint = function () {
                    if (!w.params.breakpoints)return !1;
                    var e, t = !1, n = [];
                    for (e in w.params.breakpoints)w.params.breakpoints.hasOwnProperty(e) && n.push(e);
                    n.sort(function (e, t) {
                        return parseInt(e, 10) > parseInt(t, 10)
                    });
                    for (var r = 0; r < n.length; r++)(e = n[r]) >= window.innerWidth && !t && (t = e);
                    return t || "max"
                }, w.setBreakpoint = function () {
                    var e = w.getActiveBreakpoint();
                    if (e && w.currentBreakpoint !== e) {
                        var t = e in w.params.breakpoints ? w.params.breakpoints[e] : w.originalParams, n = w.params.loop && t.slidesPerView !== w.params.slidesPerView;
                        for (var r in t)w.params[r] = t[r];
                        w.currentBreakpoint = e, n && w.destroyLoop && w.reLoop(!0)
                    }
                }, w.params.breakpoints && w.setBreakpoint(), w.container = e(n), 0 !== w.container.length)) {
                if (w.container.length > 1) {
                    var b = [];
                    return w.container.each(function () {
                        b.push(new t(this, r))
                    }), b
                }
                w.container[0].swiper = w, w.container.data("swiper", w), w.classNames.push(w.params.containerModifierClass + w.params.direction), w.params.freeMode && w.classNames.push(w.params.containerModifierClass + "free-mode"), w.support.flexbox || (w.classNames.push(w.params.containerModifierClass + "no-flexbox"), w.params.slidesPerColumn = 1), w.params.autoHeight && w.classNames.push(w.params.containerModifierClass + "autoheight"), (w.params.parallax || w.params.watchSlidesVisibility) && (w.params.watchSlidesProgress = !0), w.params.touchReleaseOnEdges && (w.params.resistanceRatio = 0), ["cube", "coverflow", "flip"].indexOf(w.params.effect) >= 0 && (w.support.transforms3d ? (w.params.watchSlidesProgress = !0, w.classNames.push(w.params.containerModifierClass + "3d")) : w.params.effect = "slide"), "slide" !== w.params.effect && w.classNames.push(w.params.containerModifierClass + w.params.effect), "cube" === w.params.effect && (w.params.resistanceRatio = 0, w.params.slidesPerView = 1, w.params.slidesPerColumn = 1, w.params.slidesPerGroup = 1, w.params.centeredSlides = !1, w.params.spaceBetween = 0, w.params.virtualTranslate = !0), "fade" !== w.params.effect && "flip" !== w.params.effect || (w.params.slidesPerView = 1, w.params.slidesPerColumn = 1, w.params.slidesPerGroup = 1, w.params.watchSlidesProgress = !0, w.params.spaceBetween = 0, void 0 === h && (w.params.virtualTranslate = !0)), w.params.grabCursor && w.support.touch && (w.params.grabCursor = !1), w.wrapper = w.container.children("." + w.params.wrapperClass), w.params.pagination && (w.paginationContainer = e(w.params.pagination), w.params.uniqueNavElements && "string" == typeof w.params.pagination && w.paginationContainer.length > 1 && 1 === w.container.find(w.params.pagination).length && (w.paginationContainer = w.container.find(w.params.pagination)), "bullets" === w.params.paginationType && w.params.paginationClickable ? w.paginationContainer.addClass(w.params.paginationModifierClass + "clickable") : w.params.paginationClickable = !1, w.paginationContainer.addClass(w.params.paginationModifierClass + w.params.paginationType)), (w.params.nextButton || w.params.prevButton) && (w.params.nextButton && (w.nextButton = e(w.params.nextButton), w.params.uniqueNavElements && "string" == typeof w.params.nextButton && w.nextButton.length > 1 && 1 === w.container.find(w.params.nextButton).length && (w.nextButton = w.container.find(w.params.nextButton))), w.params.prevButton && (w.prevButton = e(w.params.prevButton), w.params.uniqueNavElements && "string" == typeof w.params.prevButton && w.prevButton.length > 1 && 1 === w.container.find(w.params.prevButton).length && (w.prevButton = w.container.find(w.params.prevButton)))), w.isHorizontal = function () {
                    return "horizontal" === w.params.direction
                }, w.rtl = w.isHorizontal() && ("rtl" === w.container[0].dir.toLowerCase() || "rtl" === w.container.css("direction")), w.rtl && w.classNames.push(w.params.containerModifierClass + "rtl"), w.rtl && (w.wrongRTL = "-webkit-box" === w.wrapper.css("display")), w.params.slidesPerColumn > 1 && w.classNames.push(w.params.containerModifierClass + "multirow"), w.device.android && w.classNames.push(w.params.containerModifierClass + "android"), w.container.addClass(w.classNames.join(" ")), w.translate = 0, w.progress = 0, w.velocity = 0, w.lockSwipeToNext = function () {
                    w.params.allowSwipeToNext = !1, !1 === w.params.allowSwipeToPrev && w.params.grabCursor && w.unsetGrabCursor()
                }, w.lockSwipeToPrev = function () {
                    w.params.allowSwipeToPrev = !1, !1 === w.params.allowSwipeToNext && w.params.grabCursor && w.unsetGrabCursor()
                }, w.lockSwipes = function () {
                    w.params.allowSwipeToNext = w.params.allowSwipeToPrev = !1, w.params.grabCursor && w.unsetGrabCursor()
                }, w.unlockSwipeToNext = function () {
                    w.params.allowSwipeToNext = !0, !0 === w.params.allowSwipeToPrev && w.params.grabCursor && w.setGrabCursor()
                }, w.unlockSwipeToPrev = function () {
                    w.params.allowSwipeToPrev = !0, !0 === w.params.allowSwipeToNext && w.params.grabCursor && w.setGrabCursor()
                }, w.unlockSwipes = function () {
                    w.params.allowSwipeToNext = w.params.allowSwipeToPrev = !0, w.params.grabCursor && w.setGrabCursor()
                }, w.setGrabCursor = function (e) {
                    w.container[0].style.cursor = "move", w.container[0].style.cursor = e ? "-webkit-grabbing" : "-webkit-grab", w.container[0].style.cursor = e ? "-moz-grabbin" : "-moz-grab", w.container[0].style.cursor = e ? "grabbing" : "grab"
                }, w.unsetGrabCursor = function () {
                    w.container[0].style.cursor = ""
                }, w.params.grabCursor && w.setGrabCursor(), w.imagesToLoad = [], w.imagesLoaded = 0, w.loadImage = function (e, t, n, r, i, a) {
                    function o() {
                        a && a()
                    }

                    var s;
                    e.complete && i ? o() : t ? (s = new window.Image, s.onload = o, s.onerror = o, r && (s.sizes = r), n && (s.srcset = n), t && (s.src = t)) : o()
                }, w.preloadImages = function () {
                    function e() {
                        void 0 !== w && null !== w && w && (void 0 !== w.imagesLoaded && w.imagesLoaded++, w.imagesLoaded === w.imagesToLoad.length && (w.params.updateOnImagesReady && w.update(), w.emit("onImagesReady", w)))
                    }

                    w.imagesToLoad = w.container.find("img");
                    for (var t = 0; t < w.imagesToLoad.length; t++)w.loadImage(w.imagesToLoad[t], w.imagesToLoad[t].currentSrc || w.imagesToLoad[t].getAttribute("src"), w.imagesToLoad[t].srcset || w.imagesToLoad[t].getAttribute("srcset"), w.imagesToLoad[t].sizes || w.imagesToLoad[t].getAttribute("sizes"), !0, e)
                }, w.autoplayTimeoutId = void 0, w.autoplaying = !1, w.autoplayPaused = !1, w.startAutoplay = function () {
                    return void 0 === w.autoplayTimeoutId && (!!w.params.autoplay && (!w.autoplaying && (w.autoplaying = !0, w.emit("onAutoplayStart", w), void a())))
                }, w.stopAutoplay = function (e) {
                    w.autoplayTimeoutId && (w.autoplayTimeoutId && clearTimeout(w.autoplayTimeoutId), w.autoplaying = !1, w.autoplayTimeoutId = void 0, w.emit("onAutoplayStop", w))
                }, w.pauseAutoplay = function (e) {
                    w.autoplayPaused || (w.autoplayTimeoutId && clearTimeout(w.autoplayTimeoutId), w.autoplayPaused = !0, 0 === e ? (w.autoplayPaused = !1, a()) : w.wrapper.transitionEnd(function () {
                            w && (w.autoplayPaused = !1, w.autoplaying ? a() : w.stopAutoplay())
                        }))
                }, w.minTranslate = function () {
                    return -w.snapGrid[0]
                }, w.maxTranslate = function () {
                    return -w.snapGrid[w.snapGrid.length - 1]
                }, w.updateAutoHeight = function () {
                    var e, t = [], n = 0;
                    if ("auto" !== w.params.slidesPerView && w.params.slidesPerView > 1)for (e = 0; e < Math.ceil(w.params.slidesPerView); e++) {
                        var r = w.activeIndex + e;
                        if (r > w.slides.length)break;
                        t.push(w.slides.eq(r)[0])
                    } else t.push(w.slides.eq(w.activeIndex)[0]);
                    for (e = 0; e < t.length; e++)if (void 0 !== t[e]) {
                        var i = t[e].offsetHeight;
                        n = i > n ? i : n
                    }
                    n && w.wrapper.css("height", n + "px")
                }, w.updateContainerSize = function () {
                    var e, t;
                    e = void 0 !== w.params.width ? w.params.width : w.container[0].clientWidth, t = void 0 !== w.params.height ? w.params.height : w.container[0].clientHeight, 0 === e && w.isHorizontal() || 0 === t && !w.isHorizontal() || (e = e - parseInt(w.container.css("padding-left"), 10) - parseInt(w.container.css("padding-right"), 10), t = t - parseInt(w.container.css("padding-top"), 10) - parseInt(w.container.css("padding-bottom"), 10), w.width = e, w.height = t, w.size = w.isHorizontal() ? w.width : w.height)
                }, w.updateSlidesSize = function () {
                    w.slides = w.wrapper.children("." + w.params.slideClass), w.snapGrid = [], w.slidesGrid = [], w.slidesSizesGrid = [];
                    var e, t = w.params.spaceBetween, n = -w.params.slidesOffsetBefore, r = 0, a = 0;
                    if (void 0 !== w.size) {
                        "string" == typeof t && t.indexOf("%") >= 0 && (t = parseFloat(t.replace("%", "")) / 100 * w.size), w.virtualSize = -t, w.rtl ? w.slides.css({
                                marginLeft: "",
                                marginTop: ""
                            }) : w.slides.css({marginRight: "", marginBottom: ""});
                        var o;
                        w.params.slidesPerColumn > 1 && (o = Math.floor(w.slides.length / w.params.slidesPerColumn) === w.slides.length / w.params.slidesPerColumn ? w.slides.length : Math.ceil(w.slides.length / w.params.slidesPerColumn) * w.params.slidesPerColumn, "auto" !== w.params.slidesPerView && "row" === w.params.slidesPerColumnFill && (o = Math.max(o, w.params.slidesPerView * w.params.slidesPerColumn)));
                        var s, l = w.params.slidesPerColumn, u = o / l, c = u - (w.params.slidesPerColumn * u - w.slides.length);
                        for (e = 0; e < w.slides.length; e++) {
                            s = 0;
                            var p = w.slides.eq(e);
                            if (w.params.slidesPerColumn > 1) {
                                var d, f, h;
                                "column" === w.params.slidesPerColumnFill ? (f = Math.floor(e / l), h = e - f * l, (f > c || f === c && h === l - 1) && ++h >= l && (h = 0, f++), d = f + h * o / l, p.css({
                                        "-webkit-box-ordinal-group": d,
                                        "-moz-box-ordinal-group": d,
                                        "-ms-flex-order": d,
                                        "-webkit-order": d,
                                        order: d
                                    })) : (h = Math.floor(e / u), f = e - h * u), p.css("margin-" + (w.isHorizontal() ? "top" : "left"), 0 !== h && w.params.spaceBetween && w.params.spaceBetween + "px").attr("data-swiper-column", f).attr("data-swiper-row", h)
                            }
                            "none" !== p.css("display") && ("auto" === w.params.slidesPerView ? (s = w.isHorizontal() ? p.outerWidth(!0) : p.outerHeight(!0), w.params.roundLengths && (s = i(s))) : (s = (w.size - (w.params.slidesPerView - 1) * t) / w.params.slidesPerView, w.params.roundLengths && (s = i(s)), w.isHorizontal() ? w.slides[e].style.width = s + "px" : w.slides[e].style.height = s + "px"), w.slides[e].swiperSlideSize = s, w.slidesSizesGrid.push(s), w.params.centeredSlides ? (n = n + s / 2 + r / 2 + t, 0 === r && 0 !== e && (n = n - w.size / 2 - t), 0 === e && (n = n - w.size / 2 - t), Math.abs(n) < .001 && (n = 0), a % w.params.slidesPerGroup == 0 && w.snapGrid.push(n), w.slidesGrid.push(n)) : (a % w.params.slidesPerGroup == 0 && w.snapGrid.push(n), w.slidesGrid.push(n), n = n + s + t), w.virtualSize += s + t, r = s, a++)
                        }
                        w.virtualSize = Math.max(w.virtualSize, w.size) + w.params.slidesOffsetAfter;
                        var m;
                        if (w.rtl && w.wrongRTL && ("slide" === w.params.effect || "coverflow" === w.params.effect) && w.wrapper.css({width: w.virtualSize + w.params.spaceBetween + "px"}), w.support.flexbox && !w.params.setWrapperSize || (w.isHorizontal() ? w.wrapper.css({width: w.virtualSize + w.params.spaceBetween + "px"}) : w.wrapper.css({height: w.virtualSize + w.params.spaceBetween + "px"})), w.params.slidesPerColumn > 1 && (w.virtualSize = (s + w.params.spaceBetween) * o, w.virtualSize = Math.ceil(w.virtualSize / w.params.slidesPerColumn) - w.params.spaceBetween, w.isHorizontal() ? w.wrapper.css({width: w.virtualSize + w.params.spaceBetween + "px"}) : w.wrapper.css({height: w.virtualSize + w.params.spaceBetween + "px"}), w.params.centeredSlides)) {
                            for (m = [], e = 0; e < w.snapGrid.length; e++)w.snapGrid[e] < w.virtualSize + w.snapGrid[0] && m.push(w.snapGrid[e]);
                            w.snapGrid = m
                        }
                        if (!w.params.centeredSlides) {
                            for (m = [], e = 0; e < w.snapGrid.length; e++)w.snapGrid[e] <= w.virtualSize - w.size && m.push(w.snapGrid[e]);
                            w.snapGrid = m, Math.floor(w.virtualSize - w.size) - Math.floor(w.snapGrid[w.snapGrid.length - 1]) > 1 && w.snapGrid.push(w.virtualSize - w.size)
                        }
                        0 === w.snapGrid.length && (w.snapGrid = [0]), 0 !== w.params.spaceBetween && (w.isHorizontal() ? w.rtl ? w.slides.css({marginLeft: t + "px"}) : w.slides.css({marginRight: t + "px"}) : w.slides.css({marginBottom: t + "px"})), w.params.watchSlidesProgress && w.updateSlidesOffset()
                    }
                }, w.updateSlidesOffset = function () {
                    for (var e = 0; e < w.slides.length; e++)w.slides[e].swiperSlideOffset = w.isHorizontal() ? w.slides[e].offsetLeft : w.slides[e].offsetTop
                }, w.currentSlidesPerView = function () {
                    var e, t, n = 1;
                    if (w.params.centeredSlides) {
                        var r, i = w.slides[w.activeIndex].swiperSlideSize;
                        for (e = w.activeIndex + 1; e < w.slides.length; e++)w.slides[e] && !r && (i += w.slides[e].swiperSlideSize, n++, i > w.size && (r = !0));
                        for (t = w.activeIndex - 1; t >= 0; t--)w.slides[t] && !r && (i += w.slides[t].swiperSlideSize, n++, i > w.size && (r = !0))
                    } else for (e = w.activeIndex + 1; e < w.slides.length; e++)w.slidesGrid[e] - w.slidesGrid[w.activeIndex] < w.size && n++;
                    return n
                }, w.updateSlidesProgress = function (e) {
                    if (void 0 === e && (e = w.translate || 0), 0 !== w.slides.length) {
                        void 0 === w.slides[0].swiperSlideOffset && w.updateSlidesOffset();
                        var t = -e;
                        w.rtl && (t = e), w.slides.removeClass(w.params.slideVisibleClass);
                        for (var n = 0; n < w.slides.length; n++) {
                            var r = w.slides[n], i = (t + (w.params.centeredSlides ? w.minTranslate() : 0) - r.swiperSlideOffset) / (r.swiperSlideSize + w.params.spaceBetween);
                            if (w.params.watchSlidesVisibility) {
                                var a = -(t - r.swiperSlideOffset), o = a + w.slidesSizesGrid[n];
                                (a >= 0 && a < w.size || o > 0 && o <= w.size || a <= 0 && o >= w.size) && w.slides.eq(n).addClass(w.params.slideVisibleClass)
                            }
                            r.progress = w.rtl ? -i : i
                        }
                    }
                }, w.updateProgress = function (e) {
                    void 0 === e && (e = w.translate || 0);
                    var t = w.maxTranslate() - w.minTranslate(), n = w.isBeginning, r = w.isEnd;
                    0 === t ? (w.progress = 0, w.isBeginning = w.isEnd = !0) : (w.progress = (e - w.minTranslate()) / t, w.isBeginning = w.progress <= 0, w.isEnd = w.progress >= 1), w.isBeginning && !n && w.emit("onReachBeginning", w), w.isEnd && !r && w.emit("onReachEnd", w), w.params.watchSlidesProgress && w.updateSlidesProgress(e), w.emit("onProgress", w, w.progress)
                }, w.updateActiveIndex = function () {
                    var e, t, n, r = w.rtl ? w.translate : -w.translate;
                    for (t = 0; t < w.slidesGrid.length; t++)void 0 !== w.slidesGrid[t + 1] ? r >= w.slidesGrid[t] && r < w.slidesGrid[t + 1] - (w.slidesGrid[t + 1] - w.slidesGrid[t]) / 2 ? e = t : r >= w.slidesGrid[t] && r < w.slidesGrid[t + 1] && (e = t + 1) : r >= w.slidesGrid[t] && (e = t);
                    w.params.normalizeSlideIndex && (e < 0 || void 0 === e) && (e = 0), n = Math.floor(e / w.params.slidesPerGroup), n >= w.snapGrid.length && (n = w.snapGrid.length - 1), e !== w.activeIndex && (w.snapIndex = n, w.previousIndex = w.activeIndex, w.activeIndex = e, w.updateClasses(), w.updateRealIndex())
                }, w.updateRealIndex = function () {
                    w.realIndex = parseInt(w.slides.eq(w.activeIndex).attr("data-swiper-slide-index") || w.activeIndex, 10)
                }, w.updateClasses = function () {
                    w.slides.removeClass(w.params.slideActiveClass + " " + w.params.slideNextClass + " " + w.params.slidePrevClass + " " + w.params.slideDuplicateActiveClass + " " + w.params.slideDuplicateNextClass + " " + w.params.slideDuplicatePrevClass);
                    var t = w.slides.eq(w.activeIndex);
                    t.addClass(w.params.slideActiveClass), r.loop && (t.hasClass(w.params.slideDuplicateClass) ? w.wrapper.children("." + w.params.slideClass + ":not(." + w.params.slideDuplicateClass + ')[data-swiper-slide-index="' + w.realIndex + '"]').addClass(w.params.slideDuplicateActiveClass) : w.wrapper.children("." + w.params.slideClass + "." + w.params.slideDuplicateClass + '[data-swiper-slide-index="' + w.realIndex + '"]').addClass(w.params.slideDuplicateActiveClass));
                    var n = t.next("." + w.params.slideClass).addClass(w.params.slideNextClass);
                    w.params.loop && 0 === n.length && (n = w.slides.eq(0), n.addClass(w.params.slideNextClass));
                    var i = t.prev("." + w.params.slideClass).addClass(w.params.slidePrevClass);
                    if (w.params.loop && 0 === i.length && (i = w.slides.eq(-1), i.addClass(w.params.slidePrevClass)), r.loop && (n.hasClass(w.params.slideDuplicateClass) ? w.wrapper.children("." + w.params.slideClass + ":not(." + w.params.slideDuplicateClass + ')[data-swiper-slide-index="' + n.attr("data-swiper-slide-index") + '"]').addClass(w.params.slideDuplicateNextClass) : w.wrapper.children("." + w.params.slideClass + "." + w.params.slideDuplicateClass + '[data-swiper-slide-index="' + n.attr("data-swiper-slide-index") + '"]').addClass(w.params.slideDuplicateNextClass), i.hasClass(w.params.slideDuplicateClass) ? w.wrapper.children("." + w.params.slideClass + ":not(." + w.params.slideDuplicateClass + ')[data-swiper-slide-index="' + i.attr("data-swiper-slide-index") + '"]').addClass(w.params.slideDuplicatePrevClass) : w.wrapper.children("." + w.params.slideClass + "." + w.params.slideDuplicateClass + '[data-swiper-slide-index="' + i.attr("data-swiper-slide-index") + '"]').addClass(w.params.slideDuplicatePrevClass)), w.paginationContainer && w.paginationContainer.length > 0) {
                        var a, o = w.params.loop ? Math.ceil((w.slides.length - 2 * w.loopedSlides) / w.params.slidesPerGroup) : w.snapGrid.length;
                        if (w.params.loop ? (a = Math.ceil((w.activeIndex - w.loopedSlides) / w.params.slidesPerGroup), a > w.slides.length - 1 - 2 * w.loopedSlides && (a -= w.slides.length - 2 * w.loopedSlides), a > o - 1 && (a -= o), a < 0 && "bullets" !== w.params.paginationType && (a = o + a)) : a = void 0 !== w.snapIndex ? w.snapIndex : w.activeIndex || 0, "bullets" === w.params.paginationType && w.bullets && w.bullets.length > 0 && (w.bullets.removeClass(w.params.bulletActiveClass), w.paginationContainer.length > 1 ? w.bullets.each(function () {
                                    e(this).index() === a && e(this).addClass(w.params.bulletActiveClass)
                                }) : w.bullets.eq(a).addClass(w.params.bulletActiveClass)), "fraction" === w.params.paginationType && (w.paginationContainer.find("." + w.params.paginationCurrentClass).text(a + 1), w.paginationContainer.find("." + w.params.paginationTotalClass).text(o)), "progress" === w.params.paginationType) {
                            var s = (a + 1) / o, l = s, u = 1;
                            w.isHorizontal() || (u = s, l = 1), w.paginationContainer.find("." + w.params.paginationProgressbarClass).transform("translate3d(0,0,0) scaleX(" + l + ") scaleY(" + u + ")").transition(w.params.speed)
                        }
                        "custom" === w.params.paginationType && w.params.paginationCustomRender && (w.paginationContainer.html(w.params.paginationCustomRender(w, a + 1, o)), w.emit("onPaginationRendered", w, w.paginationContainer[0]))
                    }
                    w.params.loop || (w.params.prevButton && w.prevButton && w.prevButton.length > 0 && (w.isBeginning ? (w.prevButton.addClass(w.params.buttonDisabledClass), w.params.a11y && w.a11y && w.a11y.disable(w.prevButton)) : (w.prevButton.removeClass(w.params.buttonDisabledClass), w.params.a11y && w.a11y && w.a11y.enable(w.prevButton))), w.params.nextButton && w.nextButton && w.nextButton.length > 0 && (w.isEnd ? (w.nextButton.addClass(w.params.buttonDisabledClass), w.params.a11y && w.a11y && w.a11y.disable(w.nextButton)) : (w.nextButton.removeClass(w.params.buttonDisabledClass), w.params.a11y && w.a11y && w.a11y.enable(w.nextButton))))
                }, w.updatePagination = function () {
                    if (w.params.pagination && w.paginationContainer && w.paginationContainer.length > 0) {
                        var e = "";
                        if ("bullets" === w.params.paginationType) {
                            for (var t = w.params.loop ? Math.ceil((w.slides.length - 2 * w.loopedSlides) / w.params.slidesPerGroup) : w.snapGrid.length, n = 0; n < t; n++)w.params.paginationBulletRender ? e += w.params.paginationBulletRender(w, n, w.params.bulletClass) : e += "<" + w.params.paginationElement + ' class="' + w.params.bulletClass + '"></' + w.params.paginationElement + ">";
                            w.paginationContainer.html(e), w.bullets = w.paginationContainer.find("." + w.params.bulletClass), w.params.paginationClickable && w.params.a11y && w.a11y && w.a11y.initPagination()
                        }
                        "fraction" === w.params.paginationType && (e = w.params.paginationFractionRender ? w.params.paginationFractionRender(w, w.params.paginationCurrentClass, w.params.paginationTotalClass) : '<span class="' + w.params.paginationCurrentClass + '"></span> / <span class="' + w.params.paginationTotalClass + '"></span>', w.paginationContainer.html(e)), "progress" === w.params.paginationType && (e = w.params.paginationProgressRender ? w.params.paginationProgressRender(w, w.params.paginationProgressbarClass) : '<span class="' + w.params.paginationProgressbarClass + '"></span>', w.paginationContainer.html(e)), "custom" !== w.params.paginationType && w.emit("onPaginationRendered", w, w.paginationContainer[0])
                    }
                }, w.update = function (e) {
                    function t() {
                        w.rtl, w.translate;
                        n = Math.min(Math.max(w.translate, w.maxTranslate()), w.minTranslate()), w.setWrapperTranslate(n), w.updateActiveIndex(), w.updateClasses()
                    }

                    if (w) {
                        w.updateContainerSize(), w.updateSlidesSize(), w.updateProgress(), w.updatePagination(), w.updateClasses(), w.params.scrollbar && w.scrollbar && w.scrollbar.set();
                        var n;
                        if (e) {
                            w.controller && w.controller.spline && (w.controller.spline = void 0), w.params.freeMode ? (t(), w.params.autoHeight && w.updateAutoHeight()) : (("auto" === w.params.slidesPerView || w.params.slidesPerView > 1) && w.isEnd && !w.params.centeredSlides ? w.slideTo(w.slides.length - 1, 0, !1, !0) : w.slideTo(w.activeIndex, 0, !1, !0)) || t()
                        } else w.params.autoHeight && w.updateAutoHeight()
                    }
                }, w.onResize = function (e) {
                    w.params.onBeforeResize && w.params.onBeforeResize(w), w.params.breakpoints && w.setBreakpoint();
                    var t = w.params.allowSwipeToPrev, n = w.params.allowSwipeToNext;
                    w.params.allowSwipeToPrev = w.params.allowSwipeToNext = !0, w.updateContainerSize(), w.updateSlidesSize(), ("auto" === w.params.slidesPerView || w.params.freeMode || e) && w.updatePagination(), w.params.scrollbar && w.scrollbar && w.scrollbar.set(), w.controller && w.controller.spline && (w.controller.spline = void 0);
                    var r = !1;
                    if (w.params.freeMode) {
                        var i = Math.min(Math.max(w.translate, w.maxTranslate()), w.minTranslate());
                        w.setWrapperTranslate(i), w.updateActiveIndex(), w.updateClasses(), w.params.autoHeight && w.updateAutoHeight()
                    } else w.updateClasses(), r = ("auto" === w.params.slidesPerView || w.params.slidesPerView > 1) && w.isEnd && !w.params.centeredSlides ? w.slideTo(w.slides.length - 1, 0, !1, !0) : w.slideTo(w.activeIndex, 0, !1, !0);
                    w.params.lazyLoading && !r && w.lazy && w.lazy.load(), w.params.allowSwipeToPrev = t, w.params.allowSwipeToNext = n, w.params.onAfterResize && w.params.onAfterResize(w)
                }, w.touchEventsDesktop = {
                    start: "mousedown",
                    move: "mousemove",
                    end: "mouseup"
                }, window.navigator.pointerEnabled ? w.touchEventsDesktop = {
                        start: "pointerdown",
                        move: "pointermove",
                        end: "pointerup"
                    } : window.navigator.msPointerEnabled && (w.touchEventsDesktop = {
                        start: "MSPointerDown",
                        move: "MSPointerMove",
                        end: "MSPointerUp"
                    }), w.touchEvents = {
                    start: w.support.touch || !w.params.simulateTouch ? "touchstart" : w.touchEventsDesktop.start,
                    move: w.support.touch || !w.params.simulateTouch ? "touchmove" : w.touchEventsDesktop.move,
                    end: w.support.touch || !w.params.simulateTouch ? "touchend" : w.touchEventsDesktop.end
                }, (window.navigator.pointerEnabled || window.navigator.msPointerEnabled) && ("container" === w.params.touchEventsTarget ? w.container : w.wrapper).addClass("swiper-wp8-" + w.params.direction), w.initEvents = function (e) {
                    var t = e ? "off" : "on", n = e ? "removeEventListener" : "addEventListener", i = "container" === w.params.touchEventsTarget ? w.container[0] : w.wrapper[0], a = w.support.touch ? i : document, o = !!w.params.nested;
                    if (w.browser.ie) i[n](w.touchEvents.start, w.onTouchStart, !1), a[n](w.touchEvents.move, w.onTouchMove, o), a[n](w.touchEvents.end, w.onTouchEnd, !1); else {
                        if (w.support.touch) {
                            var s = !("touchstart" !== w.touchEvents.start || !w.support.passiveListener || !w.params.passiveListeners) && {
                                    passive: !0,
                                    capture: !1
                                };
                            i[n](w.touchEvents.start, w.onTouchStart, s), i[n](w.touchEvents.move, w.onTouchMove, o), i[n](w.touchEvents.end, w.onTouchEnd, s)
                        }
                        (r.simulateTouch && !w.device.ios && !w.device.android || r.simulateTouch && !w.support.touch && w.device.ios) && (i[n]("mousedown", w.onTouchStart, !1), document[n]("mousemove", w.onTouchMove, o), document[n]("mouseup", w.onTouchEnd, !1))
                    }
                    window[n]("resize", w.onResize), w.params.nextButton && w.nextButton && w.nextButton.length > 0 && (w.nextButton[t]("click", w.onClickNext), w.params.a11y && w.a11y && w.nextButton[t]("keydown", w.a11y.onEnterKey)), w.params.prevButton && w.prevButton && w.prevButton.length > 0 && (w.prevButton[t]("click", w.onClickPrev), w.params.a11y && w.a11y && w.prevButton[t]("keydown", w.a11y.onEnterKey)), w.params.pagination && w.params.paginationClickable && (w.paginationContainer[t]("click", "." + w.params.bulletClass, w.onClickIndex), w.params.a11y && w.a11y && w.paginationContainer[t]("keydown", "." + w.params.bulletClass, w.a11y.onEnterKey)), (w.params.preventClicks || w.params.preventClicksPropagation) && i[n]("click", w.preventClicks, !0)
                }, w.attachEvents = function () {
                    w.initEvents()
                }, w.detachEvents = function () {
                    w.initEvents(!0)
                }, w.allowClick = !0, w.preventClicks = function (e) {
                    w.allowClick || (w.params.preventClicks && e.preventDefault(), w.params.preventClicksPropagation && w.animating && (e.stopPropagation(), e.stopImmediatePropagation()))
                }, w.onClickNext = function (e) {
                    e.preventDefault(), w.isEnd && !w.params.loop || w.slideNext()
                }, w.onClickPrev = function (e) {
                    e.preventDefault(), w.isBeginning && !w.params.loop || w.slidePrev()
                }, w.onClickIndex = function (t) {
                    t.preventDefault();
                    var n = e(this).index() * w.params.slidesPerGroup;
                    w.params.loop && (n += w.loopedSlides), w.slideTo(n)
                }, w.updateClickedSlide = function (t) {
                    var n = o(t, "." + w.params.slideClass), r = !1;
                    if (n)for (var i = 0; i < w.slides.length; i++)w.slides[i] === n && (r = !0);
                    if (!n || !r)return w.clickedSlide = void 0, void(w.clickedIndex = void 0);
                    if (w.clickedSlide = n, w.clickedIndex = e(n).index(), w.params.slideToClickedSlide && void 0 !== w.clickedIndex && w.clickedIndex !== w.activeIndex) {
                        var a, s = w.clickedIndex, l = "auto" === w.params.slidesPerView ? w.currentSlidesPerView() : w.params.slidesPerView;
                        if (w.params.loop) {
                            if (w.animating)return;
                            a = parseInt(e(w.clickedSlide).attr("data-swiper-slide-index"), 10), w.params.centeredSlides ? s < w.loopedSlides - l / 2 || s > w.slides.length - w.loopedSlides + l / 2 ? (w.fixLoop(), s = w.wrapper.children("." + w.params.slideClass + '[data-swiper-slide-index="' + a + '"]:not(.' + w.params.slideDuplicateClass + ")").eq(0).index(), setTimeout(function () {
                                        w.slideTo(s)
                                    }, 0)) : w.slideTo(s) : s > w.slides.length - l ? (w.fixLoop(), s = w.wrapper.children("." + w.params.slideClass + '[data-swiper-slide-index="' + a + '"]:not(.' + w.params.slideDuplicateClass + ")").eq(0).index(), setTimeout(function () {
                                        w.slideTo(s)
                                    }, 0)) : w.slideTo(s)
                        } else w.slideTo(s)
                    }
                };
                var T, C, S, E, k, D, M, N, A, L, P = "input, select, textarea, button, video", z = Date.now(), I = [];
                w.animating = !1, w.touches = {startX: 0, startY: 0, currentX: 0, currentY: 0, diff: 0};
                var j, H;
                w.onTouchStart = function (t) {
                    if (t.originalEvent && (t = t.originalEvent), (j = "touchstart" === t.type) || !("which" in t) || 3 !== t.which) {
                        if (w.params.noSwiping && o(t, "." + w.params.noSwipingClass))return void(w.allowClick = !0);
                        if (!w.params.swipeHandler || o(t, w.params.swipeHandler)) {
                            var n = w.touches.currentX = "touchstart" === t.type ? t.targetTouches[0].pageX : t.pageX, r = w.touches.currentY = "touchstart" === t.type ? t.targetTouches[0].pageY : t.pageY;
                            if (!(w.device.ios && w.params.iOSEdgeSwipeDetection && n <= w.params.iOSEdgeSwipeThreshold)) {
                                if (T = !0, C = !1, S = !0, k = void 0, H = void 0, w.touches.startX = n, w.touches.startY = r, E = Date.now(), w.allowClick = !0, w.updateContainerSize(), w.swipeDirection = void 0, w.params.threshold > 0 && (N = !1), "touchstart" !== t.type) {
                                    var i = !0;
                                    e(t.target).is(P) && (i = !1), document.activeElement && e(document.activeElement).is(P) && document.activeElement.blur(), i && t.preventDefault()
                                }
                                w.emit("onTouchStart", w, t)
                            }
                        }
                    }
                }, w.onTouchMove = function (t) {
                    if (t.originalEvent && (t = t.originalEvent), !j || "mousemove" !== t.type) {
                        if (t.preventedByNestedSwiper)return w.touches.startX = "touchmove" === t.type ? t.targetTouches[0].pageX : t.pageX, void(w.touches.startY = "touchmove" === t.type ? t.targetTouches[0].pageY : t.pageY);
                        if (w.params.onlyExternal)return w.allowClick = !1, void(T && (w.touches.startX = w.touches.currentX = "touchmove" === t.type ? t.targetTouches[0].pageX : t.pageX, w.touches.startY = w.touches.currentY = "touchmove" === t.type ? t.targetTouches[0].pageY : t.pageY, E = Date.now()));
                        if (j && w.params.touchReleaseOnEdges && !w.params.loop)if (w.isHorizontal()) {
                            if (w.touches.currentX < w.touches.startX && w.translate <= w.maxTranslate() || w.touches.currentX > w.touches.startX && w.translate >= w.minTranslate())return
                        } else if (w.touches.currentY < w.touches.startY && w.translate <= w.maxTranslate() || w.touches.currentY > w.touches.startY && w.translate >= w.minTranslate())return;
                        if (j && document.activeElement && t.target === document.activeElement && e(t.target).is(P))return C = !0, void(w.allowClick = !1);
                        if (S && w.emit("onTouchMove", w, t), !(t.targetTouches && t.targetTouches.length > 1)) {
                            if (w.touches.currentX = "touchmove" === t.type ? t.targetTouches[0].pageX : t.pageX, w.touches.currentY = "touchmove" === t.type ? t.targetTouches[0].pageY : t.pageY, void 0 === k) {
                                var n;
                                w.isHorizontal() && w.touches.currentY === w.touches.startY || !w.isHorizontal() && w.touches.currentX === w.touches.startX ? k = !1 : (n = 180 * Math.atan2(Math.abs(w.touches.currentY - w.touches.startY), Math.abs(w.touches.currentX - w.touches.startX)) / Math.PI, k = w.isHorizontal() ? n > w.params.touchAngle : 90 - n > w.params.touchAngle)
                            }
                            if (k && w.emit("onTouchMoveOpposite", w, t), void 0 === H && (w.touches.currentX === w.touches.startX && w.touches.currentY === w.touches.startY || (H = !0)), T) {
                                if (k)return void(T = !1);
                                if (H) {
                                    w.allowClick = !1, w.emit("onSliderMove", w, t), t.preventDefault(), w.params.touchMoveStopPropagation && !w.params.nested && t.stopPropagation(), C || (r.loop && w.fixLoop(), M = w.getWrapperTranslate(), w.setWrapperTransition(0), w.animating && w.wrapper.trigger("webkitTransitionEnd transitionend oTransitionEnd MSTransitionEnd msTransitionEnd"), w.params.autoplay && w.autoplaying && (w.params.autoplayDisableOnInteraction ? w.stopAutoplay() : w.pauseAutoplay()), L = !1, !w.params.grabCursor || !0 !== w.params.allowSwipeToNext && !0 !== w.params.allowSwipeToPrev || w.setGrabCursor(!0)), C = !0;
                                    var i = w.touches.diff = w.isHorizontal() ? w.touches.currentX - w.touches.startX : w.touches.currentY - w.touches.startY;
                                    i *= w.params.touchRatio, w.rtl && (i = -i), w.swipeDirection = i > 0 ? "prev" : "next", D = i + M;
                                    var a = !0;
                                    if (i > 0 && D > w.minTranslate() ? (a = !1, w.params.resistance && (D = w.minTranslate() - 1 + Math.pow(-w.minTranslate() + M + i, w.params.resistanceRatio))) : i < 0 && D < w.maxTranslate() && (a = !1, w.params.resistance && (D = w.maxTranslate() + 1 - Math.pow(w.maxTranslate() - M - i, w.params.resistanceRatio))), a && (t.preventedByNestedSwiper = !0), !w.params.allowSwipeToNext && "next" === w.swipeDirection && D < M && (D = M), !w.params.allowSwipeToPrev && "prev" === w.swipeDirection && D > M && (D = M), w.params.threshold > 0) {
                                        if (!(Math.abs(i) > w.params.threshold || N))return void(D = M);
                                        if (!N)return N = !0, w.touches.startX = w.touches.currentX, w.touches.startY = w.touches.currentY, D = M, void(w.touches.diff = w.isHorizontal() ? w.touches.currentX - w.touches.startX : w.touches.currentY - w.touches.startY)
                                    }
                                    w.params.followFinger && ((w.params.freeMode || w.params.watchSlidesProgress) && w.updateActiveIndex(), w.params.freeMode && (0 === I.length && I.push({
                                        position: w.touches[w.isHorizontal() ? "startX" : "startY"],
                                        time: E
                                    }), I.push({
                                        position: w.touches[w.isHorizontal() ? "currentX" : "currentY"],
                                        time: (new window.Date).getTime()
                                    })), w.updateProgress(D), w.setWrapperTranslate(D))
                                }
                            }
                        }
                    }
                }, w.onTouchEnd = function (t) {
                    if (t.originalEvent && (t = t.originalEvent), S && w.emit("onTouchEnd", w, t), S = !1, T) {
                        w.params.grabCursor && C && T && (!0 === w.params.allowSwipeToNext || !0 === w.params.allowSwipeToPrev) && w.setGrabCursor(!1);
                        var n = Date.now(), r = n - E;
                        if (w.allowClick && (w.updateClickedSlide(t), w.emit("onTap", w, t), r < 300 && n - z > 300 && (A && clearTimeout(A), A = setTimeout(function () {
                                w && (w.params.paginationHide && w.paginationContainer.length > 0 && !e(t.target).hasClass(w.params.bulletClass) && w.paginationContainer.toggleClass(w.params.paginationHiddenClass), w.emit("onClick", w, t))
                            }, 300)), r < 300 && n - z < 300 && (A && clearTimeout(A), w.emit("onDoubleTap", w, t))), z = Date.now(), setTimeout(function () {
                                w && (w.allowClick = !0)
                            }, 0), !T || !C || !w.swipeDirection || 0 === w.touches.diff || D === M)return void(T = C = !1);
                        T = C = !1;
                        var i;
                        if (i = w.params.followFinger ? w.rtl ? w.translate : -w.translate : -D, w.params.freeMode) {
                            if (i < -w.minTranslate())return void w.slideTo(w.activeIndex);
                            if (i > -w.maxTranslate())return void(w.slides.length < w.snapGrid.length ? w.slideTo(w.snapGrid.length - 1) : w.slideTo(w.slides.length - 1));
                            if (w.params.freeModeMomentum) {
                                if (I.length > 1) {
                                    var a = I.pop(), o = I.pop(), s = a.position - o.position, l = a.time - o.time;
                                    w.velocity = s / l, w.velocity = w.velocity / 2, Math.abs(w.velocity) < w.params.freeModeMinimumVelocity && (w.velocity = 0), (l > 150 || (new window.Date).getTime() - a.time > 300) && (w.velocity = 0)
                                } else w.velocity = 0;
                                w.velocity = w.velocity * w.params.freeModeMomentumVelocityRatio, I.length = 0;
                                var u = 1e3 * w.params.freeModeMomentumRatio, c = w.velocity * u, p = w.translate + c;
                                w.rtl && (p = -p);
                                var d, f = !1, h = 20 * Math.abs(w.velocity) * w.params.freeModeMomentumBounceRatio;
                                if (p < w.maxTranslate()) w.params.freeModeMomentumBounce ? (p + w.maxTranslate() < -h && (p = w.maxTranslate() - h), d = w.maxTranslate(), f = !0, L = !0) : p = w.maxTranslate(); else if (p > w.minTranslate()) w.params.freeModeMomentumBounce ? (p - w.minTranslate() > h && (p = w.minTranslate() + h), d = w.minTranslate(), f = !0, L = !0) : p = w.minTranslate(); else if (w.params.freeModeSticky) {
                                    var m, g = 0;
                                    for (g = 0; g < w.snapGrid.length; g += 1)if (w.snapGrid[g] > -p) {
                                        m = g;
                                        break
                                    }
                                    p = Math.abs(w.snapGrid[m] - p) < Math.abs(w.snapGrid[m - 1] - p) || "next" === w.swipeDirection ? w.snapGrid[m] : w.snapGrid[m - 1], w.rtl || (p = -p)
                                }
                                if (0 !== w.velocity) u = w.rtl ? Math.abs((-p - w.translate) / w.velocity) : Math.abs((p - w.translate) / w.velocity); else if (w.params.freeModeSticky)return void w.slideReset();
                                w.params.freeModeMomentumBounce && f ? (w.updateProgress(d), w.setWrapperTransition(u), w.setWrapperTranslate(p), w.onTransitionStart(), w.animating = !0, w.wrapper.transitionEnd(function () {
                                        w && L && (w.emit("onMomentumBounce", w), w.setWrapperTransition(w.params.speed), w.setWrapperTranslate(d), w.wrapper.transitionEnd(function () {
                                            w && w.onTransitionEnd()
                                        }))
                                    })) : w.velocity ? (w.updateProgress(p), w.setWrapperTransition(u), w.setWrapperTranslate(p), w.onTransitionStart(), w.animating || (w.animating = !0, w.wrapper.transitionEnd(function () {
                                            w && w.onTransitionEnd()
                                        }))) : w.updateProgress(p), w.updateActiveIndex()
                            }
                            return void((!w.params.freeModeMomentum || r >= w.params.longSwipesMs) && (w.updateProgress(), w.updateActiveIndex()))
                        }
                        var v, y = 0, x = w.slidesSizesGrid[0]
                            ;
                        for (v = 0; v < w.slidesGrid.length; v += w.params.slidesPerGroup)void 0 !== w.slidesGrid[v + w.params.slidesPerGroup] ? i >= w.slidesGrid[v] && i < w.slidesGrid[v + w.params.slidesPerGroup] && (y = v, x = w.slidesGrid[v + w.params.slidesPerGroup] - w.slidesGrid[v]) : i >= w.slidesGrid[v] && (y = v, x = w.slidesGrid[w.slidesGrid.length - 1] - w.slidesGrid[w.slidesGrid.length - 2]);
                        var b = (i - w.slidesGrid[y]) / x;
                        if (r > w.params.longSwipesMs) {
                            if (!w.params.longSwipes)return void w.slideTo(w.activeIndex);
                            "next" === w.swipeDirection && (b >= w.params.longSwipesRatio ? w.slideTo(y + w.params.slidesPerGroup) : w.slideTo(y)), "prev" === w.swipeDirection && (b > 1 - w.params.longSwipesRatio ? w.slideTo(y + w.params.slidesPerGroup) : w.slideTo(y))
                        } else {
                            if (!w.params.shortSwipes)return void w.slideTo(w.activeIndex);
                            "next" === w.swipeDirection && w.slideTo(y + w.params.slidesPerGroup), "prev" === w.swipeDirection && w.slideTo(y)
                        }
                    }
                }, w._slideTo = function (e, t) {
                    return w.slideTo(e, t, !0, !0)
                }, w.slideTo = function (e, t, n, r) {
                    void 0 === n && (n = !0), void 0 === e && (e = 0), e < 0 && (e = 0), w.snapIndex = Math.floor(e / w.params.slidesPerGroup), w.snapIndex >= w.snapGrid.length && (w.snapIndex = w.snapGrid.length - 1);
                    var i = -w.snapGrid[w.snapIndex];
                    if (w.params.autoplay && w.autoplaying && (r || !w.params.autoplayDisableOnInteraction ? w.pauseAutoplay(t) : w.stopAutoplay()), w.updateProgress(i), w.params.normalizeSlideIndex)for (var a = 0; a < w.slidesGrid.length; a++)-Math.floor(100 * i) >= Math.floor(100 * w.slidesGrid[a]) && (e = a);
                    return !(!w.params.allowSwipeToNext && i < w.translate && i < w.minTranslate()) && (!(!w.params.allowSwipeToPrev && i > w.translate && i > w.maxTranslate() && (w.activeIndex || 0) !== e) && (void 0 === t && (t = w.params.speed), w.previousIndex = w.activeIndex || 0, w.activeIndex = e, w.updateRealIndex(), w.rtl && -i === w.translate || !w.rtl && i === w.translate ? (w.params.autoHeight && w.updateAutoHeight(), w.updateClasses(), "slide" !== w.params.effect && w.setWrapperTranslate(i), !1) : (w.updateClasses(), w.onTransitionStart(n), 0 === t || w.browser.lteIE9 ? (w.setWrapperTranslate(i), w.setWrapperTransition(0), w.onTransitionEnd(n)) : (w.setWrapperTranslate(i), w.setWrapperTransition(t), w.animating || (w.animating = !0, w.wrapper.transitionEnd(function () {
                                    w && w.onTransitionEnd(n)
                                }))), !0)))
                }, w.onTransitionStart = function (e) {
                    void 0 === e && (e = !0), w.params.autoHeight && w.updateAutoHeight(), w.lazy && w.lazy.onTransitionStart(), e && (w.emit("onTransitionStart", w), w.activeIndex !== w.previousIndex && (w.emit("onSlideChangeStart", w), w.activeIndex > w.previousIndex ? w.emit("onSlideNextStart", w) : w.emit("onSlidePrevStart", w)))
                }, w.onTransitionEnd = function (e) {
                    w.animating = !1, w.setWrapperTransition(0), void 0 === e && (e = !0), w.lazy && w.lazy.onTransitionEnd(), e && (w.emit("onTransitionEnd", w), w.activeIndex !== w.previousIndex && (w.emit("onSlideChangeEnd", w), w.activeIndex > w.previousIndex ? w.emit("onSlideNextEnd", w) : w.emit("onSlidePrevEnd", w))), w.params.history && w.history && w.history.setHistory(w.params.history, w.activeIndex), w.params.hashnav && w.hashnav && w.hashnav.setHash()
                }, w.slideNext = function (e, t, n) {
                    if (w.params.loop) {
                        if (w.animating)return !1;
                        w.fixLoop();
                        w.container[0].clientLeft;
                        return w.slideTo(w.activeIndex + w.params.slidesPerGroup, t, e, n)
                    }
                    return w.slideTo(w.activeIndex + w.params.slidesPerGroup, t, e, n)
                }, w._slideNext = function (e) {
                    return w.slideNext(!0, e, !0)
                }, w.slidePrev = function (e, t, n) {
                    if (w.params.loop) {
                        if (w.animating)return !1;
                        w.fixLoop();
                        w.container[0].clientLeft;
                        return w.slideTo(w.activeIndex - 1, t, e, n)
                    }
                    return w.slideTo(w.activeIndex - 1, t, e, n)
                }, w._slidePrev = function (e) {
                    return w.slidePrev(!0, e, !0)
                }, w.slideReset = function (e, t, n) {
                    return w.slideTo(w.activeIndex, t, e)
                }, w.disableTouchControl = function () {
                    return w.params.onlyExternal = !0, !0
                }, w.enableTouchControl = function () {
                    return w.params.onlyExternal = !1, !0
                }, w.setWrapperTransition = function (e, t) {
                    w.wrapper.transition(e), "slide" !== w.params.effect && w.effects[w.params.effect] && w.effects[w.params.effect].setTransition(e), w.params.parallax && w.parallax && w.parallax.setTransition(e), w.params.scrollbar && w.scrollbar && w.scrollbar.setTransition(e), w.params.control && w.controller && w.controller.setTransition(e, t), w.emit("onSetTransition", w, e)
                }, w.setWrapperTranslate = function (e, t, n) {
                    var r = 0, a = 0;
                    w.isHorizontal() ? r = w.rtl ? -e : e : a = e, w.params.roundLengths && (r = i(r), a = i(a)), w.params.virtualTranslate || (w.support.transforms3d ? w.wrapper.transform("translate3d(" + r + "px, " + a + "px, 0px)") : w.wrapper.transform("translate(" + r + "px, " + a + "px)")), w.translate = w.isHorizontal() ? r : a;
                    var o, s = w.maxTranslate() - w.minTranslate();
                    o = 0 === s ? 0 : (e - w.minTranslate()) / s, o !== w.progress && w.updateProgress(e), t && w.updateActiveIndex(), "slide" !== w.params.effect && w.effects[w.params.effect] && w.effects[w.params.effect].setTranslate(w.translate), w.params.parallax && w.parallax && w.parallax.setTranslate(w.translate), w.params.scrollbar && w.scrollbar && w.scrollbar.setTranslate(w.translate), w.params.control && w.controller && w.controller.setTranslate(w.translate, n), w.emit("onSetTranslate", w, w.translate)
                }, w.getTranslate = function (e, t) {
                    var n, r, i, a;
                    return void 0 === t && (t = "x"), w.params.virtualTranslate ? w.rtl ? -w.translate : w.translate : (i = window.getComputedStyle(e, null), window.WebKitCSSMatrix ? (r = i.transform || i.webkitTransform, r.split(",").length > 6 && (r = r.split(", ").map(function (e) {
                                return e.replace(",", ".")
                            }).join(", ")), a = new window.WebKitCSSMatrix("none" === r ? "" : r)) : (a = i.MozTransform || i.OTransform || i.MsTransform || i.msTransform || i.transform || i.getPropertyValue("transform").replace("translate(", "matrix(1, 0, 0, 1,"), n = a.toString().split(",")), "x" === t && (r = window.WebKitCSSMatrix ? a.m41 : 16 === n.length ? parseFloat(n[12]) : parseFloat(n[4])), "y" === t && (r = window.WebKitCSSMatrix ? a.m42 : 16 === n.length ? parseFloat(n[13]) : parseFloat(n[5])), w.rtl && r && (r = -r), r || 0)
                }, w.getWrapperTranslate = function (e) {
                    return void 0 === e && (e = w.isHorizontal() ? "x" : "y"), w.getTranslate(w.wrapper[0], e)
                }, w.observers = [], w.initObservers = function () {
                    if (w.params.observeParents)for (var e = w.container.parents(), t = 0; t < e.length; t++)s(e[t]);
                    s(w.container[0], {childList: !1}), s(w.wrapper[0], {attributes: !1})
                }, w.disconnectObservers = function () {
                    for (var e = 0; e < w.observers.length; e++)w.observers[e].disconnect();
                    w.observers = []
                }, w.createLoop = function () {
                    w.wrapper.children("." + w.params.slideClass + "." + w.params.slideDuplicateClass).remove();
                    var t = w.wrapper.children("." + w.params.slideClass);
                    "auto" !== w.params.slidesPerView || w.params.loopedSlides || (w.params.loopedSlides = t.length), w.loopedSlides = parseInt(w.params.loopedSlides || w.params.slidesPerView, 10), w.loopedSlides = w.loopedSlides + w.params.loopAdditionalSlides, w.loopedSlides > t.length && (w.loopedSlides = t.length);
                    var n, r = [], i = [];
                    for (t.each(function (n, a) {
                        var o = e(this);
                        n < w.loopedSlides && i.push(a), n < t.length && n >= t.length - w.loopedSlides && r.push(a), o.attr("data-swiper-slide-index", n)
                    }), n = 0; n < i.length; n++)w.wrapper.append(e(i[n].cloneNode(!0)).addClass(w.params.slideDuplicateClass));
                    for (n = r.length - 1; n >= 0; n--)w.wrapper.prepend(e(r[n].cloneNode(!0)).addClass(w.params.slideDuplicateClass))
                }, w.destroyLoop = function () {
                    w.wrapper.children("." + w.params.slideClass + "." + w.params.slideDuplicateClass).remove(), w.slides.removeAttr("data-swiper-slide-index")
                }, w.reLoop = function (e) {
                    var t = w.activeIndex - w.loopedSlides;
                    w.destroyLoop(), w.createLoop(), w.updateSlidesSize(), e && w.slideTo(t + w.loopedSlides, 0, !1)
                }, w.fixLoop = function () {
                    var e;
                    w.activeIndex < w.loopedSlides ? (e = w.slides.length - 3 * w.loopedSlides + w.activeIndex, e += w.loopedSlides, w.slideTo(e, 0, !1, !0)) : ("auto" === w.params.slidesPerView && w.activeIndex >= 2 * w.loopedSlides || w.activeIndex > w.slides.length - 2 * w.params.slidesPerView) && (e = -w.slides.length + w.activeIndex + w.loopedSlides, e += w.loopedSlides, w.slideTo(e, 0, !1, !0))
                }, w.appendSlide = function (e) {
                    if (w.params.loop && w.destroyLoop(), "object" == typeof e && e.length)for (var t = 0; t < e.length; t++)e[t] && w.wrapper.append(e[t]); else w.wrapper.append(e);
                    w.params.loop && w.createLoop(), w.params.observer && w.support.observer || w.update(!0)
                }, w.prependSlide = function (e) {
                    w.params.loop && w.destroyLoop();
                    var t = w.activeIndex + 1;
                    if ("object" == typeof e && e.length) {
                        for (var n = 0; n < e.length; n++)e[n] && w.wrapper.prepend(e[n]);
                        t = w.activeIndex + e.length
                    } else w.wrapper.prepend(e);
                    w.params.loop && w.createLoop(), w.params.observer && w.support.observer || w.update(!0), w.slideTo(t, 0, !1)
                }, w.removeSlide = function (e) {
                    w.params.loop && (w.destroyLoop(), w.slides = w.wrapper.children("." + w.params.slideClass));
                    var t, n = w.activeIndex;
                    if ("object" == typeof e && e.length) {
                        for (var r = 0; r < e.length; r++)t = e[r], w.slides[t] && w.slides.eq(t).remove(), t < n && n--;
                        n = Math.max(n, 0)
                    } else t = e, w.slides[t] && w.slides.eq(t).remove(), t < n && n--, n = Math.max(n, 0);
                    w.params.loop && w.createLoop(), w.params.observer && w.support.observer || w.update(!0), w.params.loop ? w.slideTo(n + w.loopedSlides, 0, !1) : w.slideTo(n, 0, !1)
                }, w.removeAllSlides = function () {
                    for (var e = [], t = 0; t < w.slides.length; t++)e.push(t);
                    w.removeSlide(e)
                }, w.effects = {
                    fade: {
                        setTranslate: function () {
                            for (var e = 0; e < w.slides.length; e++) {
                                var t = w.slides.eq(e), n = t[0].swiperSlideOffset, r = -n;
                                w.params.virtualTranslate || (r -= w.translate);
                                var i = 0;
                                w.isHorizontal() || (i = r, r = 0);
                                var a = w.params.fade.crossFade ? Math.max(1 - Math.abs(t[0].progress), 0) : 1 + Math.min(Math.max(t[0].progress, -1), 0);
                                t.css({opacity: a}).transform("translate3d(" + r + "px, " + i + "px, 0px)")
                            }
                        }, setTransition: function (e) {
                            if (w.slides.transition(e), w.params.virtualTranslate && 0 !== e) {
                                var t = !1;
                                w.slides.transitionEnd(function () {
                                    if (!t && w) {
                                        t = !0, w.animating = !1;
                                        for (var e = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"], n = 0; n < e.length; n++)w.wrapper.trigger(e[n])
                                    }
                                })
                            }
                        }
                    }, flip: {
                        setTranslate: function () {
                            for (var t = 0; t < w.slides.length; t++) {
                                var n = w.slides.eq(t), r = n[0].progress;
                                w.params.flip.limitRotation && (r = Math.max(Math.min(n[0].progress, 1), -1));
                                var i = n[0].swiperSlideOffset, a = -180 * r, o = a, s = 0, l = -i, u = 0;
                                if (w.isHorizontal() ? w.rtl && (o = -o) : (u = l, l = 0, s = -o, o = 0), n[0].style.zIndex = -Math.abs(Math.round(r)) + w.slides.length, w.params.flip.slideShadows) {
                                    var c = w.isHorizontal() ? n.find(".swiper-slide-shadow-left") : n.find(".swiper-slide-shadow-top"), p = w.isHorizontal() ? n.find(".swiper-slide-shadow-right") : n.find(".swiper-slide-shadow-bottom");
                                    0 === c.length && (c = e('<div class="swiper-slide-shadow-' + (w.isHorizontal() ? "left" : "top") + '"></div>'), n.append(c)), 0 === p.length && (p = e('<div class="swiper-slide-shadow-' + (w.isHorizontal() ? "right" : "bottom") + '"></div>'), n.append(p)), c.length && (c[0].style.opacity = Math.max(-r, 0)), p.length && (p[0].style.opacity = Math.max(r, 0))
                                }
                                n.transform("translate3d(" + l + "px, " + u + "px, 0px) rotateX(" + s + "deg) rotateY(" + o + "deg)")
                            }
                        }, setTransition: function (t) {
                            if (w.slides.transition(t).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(t), w.params.virtualTranslate && 0 !== t) {
                                var n = !1;
                                w.slides.eq(w.activeIndex).transitionEnd(function () {
                                    if (!n && w && e(this).hasClass(w.params.slideActiveClass)) {
                                        n = !0, w.animating = !1;
                                        for (var t = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"], r = 0; r < t.length; r++)w.wrapper.trigger(t[r])
                                    }
                                })
                            }
                        }
                    }, cube: {
                        setTranslate: function () {
                            var t, n = 0;
                            w.params.cube.shadow && (w.isHorizontal() ? (t = w.wrapper.find(".swiper-cube-shadow"), 0 === t.length && (t = e('<div class="swiper-cube-shadow"></div>'), w.wrapper.append(t)), t.css({height: w.width + "px"})) : (t = w.container.find(".swiper-cube-shadow"), 0 === t.length && (t = e('<div class="swiper-cube-shadow"></div>'), w.container.append(t))));
                            for (var r = 0; r < w.slides.length; r++) {
                                var i = w.slides.eq(r), a = 90 * r, o = Math.floor(a / 360);
                                w.rtl && (a = -a, o = Math.floor(-a / 360));
                                var s = Math.max(Math.min(i[0].progress, 1), -1), l = 0, u = 0, c = 0;
                                r % 4 == 0 ? (l = 4 * -o * w.size, c = 0) : (r - 1) % 4 == 0 ? (l = 0, c = 4 * -o * w.size) : (r - 2) % 4 == 0 ? (l = w.size + 4 * o * w.size, c = w.size) : (r - 3) % 4 == 0 && (l = -w.size, c = 3 * w.size + 4 * w.size * o), w.rtl && (l = -l), w.isHorizontal() || (u = l, l = 0);
                                var p = "rotateX(" + (w.isHorizontal() ? 0 : -a) + "deg) rotateY(" + (w.isHorizontal() ? a : 0) + "deg) translate3d(" + l + "px, " + u + "px, " + c + "px)";
                                if (s <= 1 && s > -1 && (n = 90 * r + 90 * s, w.rtl && (n = 90 * -r - 90 * s)), i.transform(p), w.params.cube.slideShadows) {
                                    var d = w.isHorizontal() ? i.find(".swiper-slide-shadow-left") : i.find(".swiper-slide-shadow-top"), f = w.isHorizontal() ? i.find(".swiper-slide-shadow-right") : i.find(".swiper-slide-shadow-bottom");
                                    0 === d.length && (d = e('<div class="swiper-slide-shadow-' + (w.isHorizontal() ? "left" : "top") + '"></div>'), i.append(d)), 0 === f.length && (f = e('<div class="swiper-slide-shadow-' + (w.isHorizontal() ? "right" : "bottom") + '"></div>'), i.append(f)), d.length && (d[0].style.opacity = Math.max(-s, 0)), f.length && (f[0].style.opacity = Math.max(s, 0))
                                }
                            }
                            if (w.wrapper.css({
                                    "-webkit-transform-origin": "50% 50% -" + w.size / 2 + "px",
                                    "-moz-transform-origin": "50% 50% -" + w.size / 2 + "px",
                                    "-ms-transform-origin": "50% 50% -" + w.size / 2 + "px",
                                    "transform-origin": "50% 50% -" + w.size / 2 + "px"
                                }), w.params.cube.shadow)if (w.isHorizontal()) t.transform("translate3d(0px, " + (w.width / 2 + w.params.cube.shadowOffset) + "px, " + -w.width / 2 + "px) rotateX(90deg) rotateZ(0deg) scale(" + w.params.cube.shadowScale + ")"); else {
                                var h = Math.abs(n) - 90 * Math.floor(Math.abs(n) / 90), m = 1.5 - (Math.sin(2 * h * Math.PI / 360) / 2 + Math.cos(2 * h * Math.PI / 360) / 2), g = w.params.cube.shadowScale, v = w.params.cube.shadowScale / m, y = w.params.cube.shadowOffset;
                                t.transform("scale3d(" + g + ", 1, " + v + ") translate3d(0px, " + (w.height / 2 + y) + "px, " + -w.height / 2 / v + "px) rotateX(-90deg)")
                            }
                            var x = w.isSafari || w.isUiWebView ? -w.size / 2 : 0;
                            w.wrapper.transform("translate3d(0px,0," + x + "px) rotateX(" + (w.isHorizontal() ? 0 : n) + "deg) rotateY(" + (w.isHorizontal() ? -n : 0) + "deg)")
                        }, setTransition: function (e) {
                            w.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e), w.params.cube.shadow && !w.isHorizontal() && w.container.find(".swiper-cube-shadow").transition(e)
                        }
                    }, coverflow: {
                        setTranslate: function () {
                            for (var t = w.translate, n = w.isHorizontal() ? -t + w.width / 2 : -t + w.height / 2, r = w.isHorizontal() ? w.params.coverflow.rotate : -w.params.coverflow.rotate, i = w.params.coverflow.depth, a = 0, o = w.slides.length; a < o; a++) {
                                var s = w.slides.eq(a), l = w.slidesSizesGrid[a], u = s[0].swiperSlideOffset, c = (n - u - l / 2) / l * w.params.coverflow.modifier, p = w.isHorizontal() ? r * c : 0, d = w.isHorizontal() ? 0 : r * c, f = -i * Math.abs(c), h = w.isHorizontal() ? 0 : w.params.coverflow.stretch * c, m = w.isHorizontal() ? w.params.coverflow.stretch * c : 0;
                                Math.abs(m) < .001 && (m = 0), Math.abs(h) < .001 && (h = 0), Math.abs(f) < .001 && (f = 0), Math.abs(p) < .001 && (p = 0), Math.abs(d) < .001 && (d = 0);
                                var g = "translate3d(" + m + "px," + h + "px," + f + "px)  rotateX(" + d + "deg) rotateY(" + p + "deg)";
                                if (s.transform(g), s[0].style.zIndex = 1 - Math.abs(Math.round(c)), w.params.coverflow.slideShadows) {
                                    var v = w.isHorizontal() ? s.find(".swiper-slide-shadow-left") : s.find(".swiper-slide-shadow-top"), y = w.isHorizontal() ? s.find(".swiper-slide-shadow-right") : s.find(".swiper-slide-shadow-bottom");
                                    0 === v.length && (v = e('<div class="swiper-slide-shadow-' + (w.isHorizontal() ? "left" : "top") + '"></div>'), s.append(v)), 0 === y.length && (y = e('<div class="swiper-slide-shadow-' + (w.isHorizontal() ? "right" : "bottom") + '"></div>'), s.append(y)), v.length && (v[0].style.opacity = c > 0 ? c : 0), y.length && (y[0].style.opacity = -c > 0 ? -c : 0)
                                }
                            }
                            if (w.browser.ie) {
                                w.wrapper[0].style.perspectiveOrigin = n + "px 50%"
                            }
                        }, setTransition: function (e) {
                            w.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e)
                        }
                    }
                }, w.lazy = {
                    initialImageLoaded: !1, loadImageInSlide: function (t, n) {
                        if (void 0 !== t && (void 0 === n && (n = !0), 0 !== w.slides.length)) {
                            var r = w.slides.eq(t), i = r.find("." + w.params.lazyLoadingClass + ":not(." + w.params.lazyStatusLoadedClass + "):not(." + w.params.lazyStatusLoadingClass + ")");
                            !r.hasClass(w.params.lazyLoadingClass) || r.hasClass(w.params.lazyStatusLoadedClass) || r.hasClass(w.params.lazyStatusLoadingClass) || (i = i.add(r[0])), 0 !== i.length && i.each(function () {
                                var t = e(this);
                                t.addClass(w.params.lazyStatusLoadingClass);
                                var i = t.attr("data-background"), a = t.attr("data-src"), o = t.attr("data-srcset"), s = t.attr("data-sizes");
                                w.loadImage(t[0], a || i, o, s, !1, function () {
                                    if (void 0 !== w && null !== w && w) {
                                        if (i ? (t.css("background-image", 'url("' + i + '")'), t.removeAttr("data-background")) : (o && (t.attr("srcset", o), t.removeAttr("data-srcset")), s && (t.attr("sizes", s), t.removeAttr("data-sizes")), a && (t.attr("src", a), t.removeAttr("data-src"))), t.addClass(w.params.lazyStatusLoadedClass).removeClass(w.params.lazyStatusLoadingClass), r.find("." + w.params.lazyPreloaderClass + ", ." + w.params.preloaderClass).remove(), w.params.loop && n) {
                                            var e = r.attr("data-swiper-slide-index");
                                            if (r.hasClass(w.params.slideDuplicateClass)) {
                                                var l = w.wrapper.children('[data-swiper-slide-index="' + e + '"]:not(.' + w.params.slideDuplicateClass + ")");
                                                w.lazy.loadImageInSlide(l.index(), !1)
                                            } else {
                                                var u = w.wrapper.children("." + w.params.slideDuplicateClass + '[data-swiper-slide-index="' + e + '"]');
                                                w.lazy.loadImageInSlide(u.index(), !1)
                                            }
                                        }
                                        w.emit("onLazyImageReady", w, r[0], t[0])
                                    }
                                }), w.emit("onLazyImageLoad", w, r[0], t[0])
                            })
                        }
                    }, load: function () {
                        var t, n = w.params.slidesPerView;
                        if ("auto" === n && (n = 0), w.lazy.initialImageLoaded || (w.lazy.initialImageLoaded = !0), w.params.watchSlidesVisibility) w.wrapper.children("." + w.params.slideVisibleClass).each(function () {
                            w.lazy.loadImageInSlide(e(this).index())
                        }); else if (n > 1)for (t = w.activeIndex; t < w.activeIndex + n; t++)w.slides[t] && w.lazy.loadImageInSlide(t); else w.lazy.loadImageInSlide(w.activeIndex);
                        if (w.params.lazyLoadingInPrevNext)if (n > 1 || w.params.lazyLoadingInPrevNextAmount && w.params.lazyLoadingInPrevNextAmount > 1) {
                            var r = w.params.lazyLoadingInPrevNextAmount, i = n, a = Math.min(w.activeIndex + i + Math.max(r, i), w.slides.length), o = Math.max(w.activeIndex - Math.max(i, r), 0);
                            for (t = w.activeIndex + n; t < a; t++)w.slides[t] && w.lazy.loadImageInSlide(t);
                            for (t = o; t < w.activeIndex; t++)w.slides[t] && w.lazy.loadImageInSlide(t)
                        } else {
                            var s = w.wrapper.children("." + w.params.slideNextClass);
                            s.length > 0 && w.lazy.loadImageInSlide(s.index());
                            var l = w.wrapper.children("." + w.params.slidePrevClass);
                            l.length > 0 && w.lazy.loadImageInSlide(l.index())
                        }
                    }, onTransitionStart: function () {
                        w.params.lazyLoading && (w.params.lazyLoadingOnTransitionStart || !w.params.lazyLoadingOnTransitionStart && !w.lazy.initialImageLoaded) && w.lazy.load()
                    }, onTransitionEnd: function () {
                        w.params.lazyLoading && !w.params.lazyLoadingOnTransitionStart && w.lazy.load()
                    }
                }, w.scrollbar = {
                    isTouched: !1, setDragPosition: function (e) {
                        var t = w.scrollbar, n = w.isHorizontal() ? "touchstart" === e.type || "touchmove" === e.type ? e.targetTouches[0].pageX : e.pageX || e.clientX : "touchstart" === e.type || "touchmove" === e.type ? e.targetTouches[0].pageY : e.pageY || e.clientY, r = n - t.track.offset()[w.isHorizontal() ? "left" : "top"] - t.dragSize / 2, i = -w.minTranslate() * t.moveDivider, a = -w.maxTranslate() * t.moveDivider;
                        r < i ? r = i : r > a && (r = a), r = -r / t.moveDivider, w.updateProgress(r), w.setWrapperTranslate(r, !0)
                    }, dragStart: function (e) {
                        var t = w.scrollbar;
                        t.isTouched = !0, e.preventDefault(), e.stopPropagation(), t.setDragPosition(e), clearTimeout(t.dragTimeout), t.track.transition(0), w.params.scrollbarHide && t.track.css("opacity", 1), w.wrapper.transition(100), t.drag.transition(100), w.emit("onScrollbarDragStart", w)
                    }, dragMove: function (e) {
                        var t = w.scrollbar;
                        t.isTouched && (e.preventDefault ? e.preventDefault() : e.returnValue = !1, t.setDragPosition(e), w.wrapper.transition(0), t.track.transition(0), t.drag.transition(0), w.emit("onScrollbarDragMove", w))
                    }, dragEnd: function (e) {
                        var t = w.scrollbar;
                        t.isTouched && (t.isTouched = !1, w.params.scrollbarHide && (clearTimeout(t.dragTimeout), t.dragTimeout = setTimeout(function () {
                            t.track.css("opacity", 0), t.track.transition(400)
                        }, 1e3)), w.emit("onScrollbarDragEnd", w), w.params.scrollbarSnapOnRelease && w.slideReset())
                    }, draggableEvents: function () {
                        return !1 !== w.params.simulateTouch || w.support.touch ? w.touchEvents : w.touchEventsDesktop
                    }(), enableDraggable: function () {
                        var t = w.scrollbar, n = w.support.touch ? t.track : document;
                        e(t.track).on(t.draggableEvents.start, t.dragStart), e(n).on(t.draggableEvents.move, t.dragMove), e(n).on(t.draggableEvents.end, t.dragEnd)
                    }, disableDraggable: function () {
                        var t = w.scrollbar, n = w.support.touch ? t.track : document;
                        e(t.track).off(t.draggableEvents.start, t.dragStart), e(n).off(t.draggableEvents.move, t.dragMove), e(n).off(t.draggableEvents.end, t.dragEnd)
                    }, set: function () {
                        if (w.params.scrollbar) {
                            var t = w.scrollbar;
                            t.track = e(w.params.scrollbar), w.params.uniqueNavElements && "string" == typeof w.params.scrollbar && t.track.length > 1 && 1 === w.container.find(w.params.scrollbar).length && (t.track = w.container.find(w.params.scrollbar)), t.drag = t.track.find(".swiper-scrollbar-drag"), 0 === t.drag.length && (t.drag = e('<div class="swiper-scrollbar-drag"></div>'), t.track.append(t.drag)), t.drag[0].style.width = "", t.drag[0].style.height = "", t.trackSize = w.isHorizontal() ? t.track[0].offsetWidth : t.track[0].offsetHeight, t.divider = w.size / w.virtualSize, t.moveDivider = t.divider * (t.trackSize / w.size), t.dragSize = t.trackSize * t.divider, w.isHorizontal() ? t.drag[0].style.width = t.dragSize + "px" : t.drag[0].style.height = t.dragSize + "px", t.divider >= 1 ? t.track[0].style.display = "none" : t.track[0].style.display = "", w.params.scrollbarHide && (t.track[0].style.opacity = 0)
                        }
                    }, setTranslate: function () {
                        if (w.params.scrollbar) {
                            var e, t = w.scrollbar, n = (w.translate, t.dragSize);
                            e = (t.trackSize - t.dragSize) * w.progress, w.rtl && w.isHorizontal() ? (e = -e, e > 0 ? (n = t.dragSize - e, e = 0) : -e + t.dragSize > t.trackSize && (n = t.trackSize + e)) : e < 0 ? (n = t.dragSize + e, e = 0): e+t.dragSize > t.trackSize && (n = t.trackSize - e), w.isHorizontal() ? (w.support.transforms3d ? t.drag.transform("translate3d(" + e + "px, 0, 0)") : t.drag.transform("translateX(" + e + "px)"), t.drag[0].style.width = n + "px") : (w.support.transforms3d ? t.drag.transform("translate3d(0px, " + e + "px, 0)") : t.drag.transform("translateY(" + e + "px)"), t.drag[0].style.height = n + "px"), w.params.scrollbarHide && (clearTimeout(t.timeout), t.track[0].style.opacity = 1, t.timeout = setTimeout(function () {
                                t.track[0].style.opacity = 0, t.track.transition(400)
                            }, 1e3))
                        }
                    }, setTransition: function (e) {
                        w.params.scrollbar && w.scrollbar.drag.transition(e)
                    }
                }, w.controller = {
                    LinearSpline: function (e, t) {
                        var n = function () {
                            var e, t, n;
                            return function (r, i) {
                                for (t = -1, e = r.length; e - t > 1;)r[n = e + t >> 1] <= i ? t = n : e = n;
                                return e
                            }
                        }();
                        this.x = e, this.y = t, this.lastIndex = e.length - 1;
                        var r, i;
                        this.x.length;
                        this.interpolate = function (e) {
                            return e ? (i = n(this.x, e), r = i - 1, (e - this.x[r]) * (this.y[i] - this.y[r]) / (this.x[i] - this.x[r]) + this.y[r]) : 0
                        }
                    }, getInterpolateFunction: function (e) {
                        w.controller.spline || (w.controller.spline = w.params.loop ? new w.controller.LinearSpline(w.slidesGrid, e.slidesGrid) : new w.controller.LinearSpline(w.snapGrid, e.snapGrid))
                    }, setTranslate: function (e, n) {
                        function r(t) {
                            e = t.rtl && "horizontal" === t.params.direction ? -w.translate : w.translate, "slide" === w.params.controlBy && (w.controller.getInterpolateFunction(t), a = -w.controller.spline.interpolate(-e)), a && "container" !== w.params.controlBy || (i = (t.maxTranslate() - t.minTranslate()) / (w.maxTranslate() - w.minTranslate()), a = (e - w.minTranslate()) * i + t.minTranslate()), w.params.controlInverse && (a = t.maxTranslate() - a), t.updateProgress(a), t.setWrapperTranslate(a, !1, w), t.updateActiveIndex()
                        }

                        var i, a, o = w.params.control;
                        if (Array.isArray(o))for (var s = 0; s < o.length; s++)o[s] !== n && o[s] instanceof t && r(o[s]); else o instanceof t && n !== o && r(o)
                    }, setTransition: function (e, n) {
                        function r(t) {
                            t.setWrapperTransition(e, w), 0 !== e && (t.onTransitionStart(), t.wrapper.transitionEnd(function () {
                                a && (t.params.loop && "slide" === w.params.controlBy && t.fixLoop(), t.onTransitionEnd())
                            }))
                        }

                        var i, a = w.params.control;
                        if (Array.isArray(a))for (i = 0; i < a.length; i++)a[i] !== n && a[i] instanceof t && r(a[i]); else a instanceof t && n !== a && r(a)
                    }
                }, w.hashnav = {
                    onHashCange: function (e, t) {
                        var n = document.location.hash.replace("#", "");
                        n !== w.slides.eq(w.activeIndex).attr("data-hash") && w.slideTo(w.wrapper.children("." + w.params.slideClass + '[data-hash="' + n + '"]').index())
                    }, attachEvents: function (t) {
                        var n = t ? "off" : "on";
                        e(window)[n]("hashchange", w.hashnav.onHashCange)
                    }, setHash: function () {
                        if (w.hashnav.initialized && w.params.hashnav)if (w.params.replaceState && window.history && window.history.replaceState) window.history.replaceState(null, null, "#" + w.slides.eq(w.activeIndex).attr("data-hash") || ""); else {
                            var e = w.slides.eq(w.activeIndex), t = e.attr("data-hash") || e.attr("data-history");
                            document.location.hash = t || ""
                        }
                    }, init: function () {
                        if (w.params.hashnav && !w.params.history) {
                            w.hashnav.initialized = !0;
                            var e = document.location.hash.replace("#", "");
                            if (e)for (var t = 0, n = w.slides.length; t < n; t++) {
                                var r = w.slides.eq(t), i = r.attr("data-hash") || r.attr("data-history");
                                if (i === e && !r.hasClass(w.params.slideDuplicateClass)) {
                                    var a = r.index();
                                    w.slideTo(a, 0, w.params.runCallbacksOnInit, !0)
                                }
                            }
                            w.params.hashnavWatchState && w.hashnav.attachEvents()
                        }
                    }, destroy: function () {
                        w.params.hashnavWatchState && w.hashnav.attachEvents(!0)
                    }
                }, w.history = {
                    init: function () {
                        if (w.params.history) {
                            if (!window.history || !window.history.pushState)return w.params.history = !1, void(w.params.hashnav = !0);
                            w.history.initialized = !0, this.paths = this.getPathValues(), (this.paths.key || this.paths.value) && (this.scrollToSlide(0, this.paths.value, w.params.runCallbacksOnInit), w.params.replaceState || window.addEventListener("popstate", this.setHistoryPopState))
                        }
                    }, setHistoryPopState: function () {
                        w.history.paths = w.history.getPathValues(), w.history.scrollToSlide(w.params.speed, w.history.paths.value, !1)
                    }, getPathValues: function () {
                        var e = window.location.pathname.slice(1).split("/"), t = e.length;
                        return {key: e[t - 2], value: e[t - 1]}
                    }, setHistory: function (e, t) {
                        if (w.history.initialized && w.params.history) {
                            var n = w.slides.eq(t), r = this.slugify(n.attr("data-history"));
                            window.location.pathname.includes(e) || (r = e + "/" + r), w.params.replaceState ? window.history.replaceState(null, null, r) : window.history.pushState(null, null, r)
                        }
                    }, slugify: function (e) {
                        return e.toString().toLowerCase().replace(/\s+/g, "-").replace(/[^\w\-]+/g, "").replace(/\-\-+/g, "-").replace(/^-+/, "").replace(/-+$/, "")
                    }, scrollToSlide: function (e, t, n) {
                        if (t)for (var r = 0, i = w.slides.length; r < i; r++) {
                            var a = w.slides.eq(r), o = this.slugify(a.attr("data-history"));
                            if (o === t && !a.hasClass(w.params.slideDuplicateClass)) {
                                var s = a.index();
                                w.slideTo(s, e, n)
                            }
                        } else w.slideTo(0, e, n)
                    }
                }, w.disableKeyboardControl = function () {
                    w.params.keyboardControl = !1, e(document).off("keydown", l)
                }, w.enableKeyboardControl = function () {
                    w.params.keyboardControl = !0, e(document).on("keydown", l)
                }, w.mousewheel = {
                    event: !1,
                    lastScrollTime: (new window.Date).getTime()
                }, w.params.mousewheelControl && (w.mousewheel.event = navigator.userAgent.indexOf("firefox") > -1 ? "DOMMouseScroll" : function () {
                        var e = "onwheel" in document;
                        if (!e) {
                            var t = document.createElement("div");
                            t.setAttribute("onwheel", "return;"), e = "function" == typeof t.onwheel
                        }
                        return !e && document.implementation && document.implementation.hasFeature && !0 !== document.implementation.hasFeature("", "") && (e = document.implementation.hasFeature("Events.wheel", "3.0")), e
                    }() ? "wheel" : "mousewheel"), w.disableMousewheelControl = function () {
                    if (!w.mousewheel.event)return !1;
                    var t = w.container;
                    return "container" !== w.params.mousewheelEventsTarged && (t = e(w.params.mousewheelEventsTarged)), t.off(w.mousewheel.event, c), w.params.mousewheelControl = !1, !0
                }, w.enableMousewheelControl = function () {
                    if (!w.mousewheel.event)return !1;
                    var t = w.container;
                    return "container" !== w.params.mousewheelEventsTarged && (t = e(w.params.mousewheelEventsTarged)), t.on(w.mousewheel.event, c), w.params.mousewheelControl = !0, !0
                }, w.parallax = {
                    setTranslate: function () {
                        w.container.children("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function () {
                            p(this, w.progress)
                        }), w.slides.each(function () {
                            var t = e(this);
                            t.find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function () {
                                p(this, Math.min(Math.max(t[0].progress, -1), 1))
                            })
                        })
                    }, setTransition: function (t) {
                        void 0 === t && (t = w.params.speed), w.container.find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function () {
                            var n = e(this), r = parseInt(n.attr("data-swiper-parallax-duration"), 10) || t;
                            0 === t && (r = 0), n.transition(r)
                        })
                    }
                }, w.zoom = {
                    scale: 1,
                    currentScale: 1,
                    isScaling: !1,
                    gesture: {
                        slide: void 0,
                        slideWidth: void 0,
                        slideHeight: void 0,
                        image: void 0,
                        imageWrap: void 0,
                        zoomMax: w.params.zoomMax
                    },
                    image: {
                        isTouched: void 0,
                        isMoved: void 0,
                        currentX: void 0,
                        currentY: void 0,
                        minX: void 0,
                        minY: void 0,
                        maxX: void 0,
                        maxY: void 0,
                        width: void 0,
                        height: void 0,
                        startX: void 0,
                        startY: void 0,
                        touchesStart: {},
                        touchesCurrent: {}
                    },
                    velocity: {x: void 0, y: void 0, prevPositionX: void 0, prevPositionY: void 0, prevTime: void 0},
                    getDistanceBetweenTouches: function (e) {
                        if (e.targetTouches.length < 2)return 1;
                        var t = e.targetTouches[0].pageX, n = e.targetTouches[0].pageY, r = e.targetTouches[1].pageX, i = e.targetTouches[1].pageY;
                        return Math.sqrt(Math.pow(r - t, 2) + Math.pow(i - n, 2))
                    },
                    onGestureStart: function (t) {
                        var n = w.zoom;
                        if (!w.support.gestures) {
                            if ("touchstart" !== t.type || "touchstart" === t.type && t.targetTouches.length < 2)return;
                            n.gesture.scaleStart = n.getDistanceBetweenTouches(t)
                        }
                        if (!(n.gesture.slide && n.gesture.slide.length || (n.gesture.slide = e(this), 0 === n.gesture.slide.length && (n.gesture.slide = w.slides.eq(w.activeIndex)), n.gesture.image = n.gesture.slide.find("img, svg, canvas"), n.gesture.imageWrap = n.gesture.image.parent("." + w.params.zoomContainerClass), n.gesture.zoomMax = n.gesture.imageWrap.attr("data-swiper-zoom") || w.params.zoomMax, 0 !== n.gesture.imageWrap.length)))return void(n.gesture.image = void 0);
                        n.gesture.image.transition(0), n.isScaling = !0
                    },
                    onGestureChange: function (e) {
                        var t = w.zoom;
                        if (!w.support.gestures) {
                            if ("touchmove" !== e.type || "touchmove" === e.type && e.targetTouches.length < 2)return;
                            t.gesture.scaleMove = t.getDistanceBetweenTouches(e)
                        }
                        t.gesture.image && 0 !== t.gesture.image.length && (w.support.gestures ? t.scale = e.scale * t.currentScale : t.scale = t.gesture.scaleMove / t.gesture.scaleStart * t.currentScale, t.scale > t.gesture.zoomMax && (t.scale = t.gesture.zoomMax - 1 + Math.pow(t.scale - t.gesture.zoomMax + 1, .5)), t.scale < w.params.zoomMin && (t.scale = w.params.zoomMin + 1 - Math.pow(w.params.zoomMin - t.scale + 1, .5)), t.gesture.image.transform("translate3d(0,0,0) scale(" + t.scale + ")"))
                    },
                    onGestureEnd: function (e) {
                        var t = w.zoom;
                        !w.support.gestures && ("touchend" !== e.type || "touchend" === e.type && e.changedTouches.length < 2) || t.gesture.image && 0 !== t.gesture.image.length && (t.scale = Math.max(Math.min(t.scale, t.gesture.zoomMax), w.params.zoomMin), t.gesture.image.transition(w.params.speed).transform("translate3d(0,0,0) scale(" + t.scale + ")"), t.currentScale = t.scale, t.isScaling = !1, 1 === t.scale && (t.gesture.slide = void 0))
                    },
                    onTouchStart: function (e, t) {
                        var n = e.zoom;
                        n.gesture.image && 0 !== n.gesture.image.length && (n.image.isTouched || ("android" === e.device.os && t.preventDefault(), n.image.isTouched = !0, n.image.touchesStart.x = "touchstart" === t.type ? t.targetTouches[0].pageX : t.pageX, n.image.touchesStart.y = "touchstart" === t.type ? t.targetTouches[0].pageY : t.pageY))
                    },
                    onTouchMove: function (e) {
                        var t = w.zoom;
                        if (t.gesture.image && 0 !== t.gesture.image.length && (w.allowClick = !1, t.image.isTouched && t.gesture.slide)) {
                            t.image.isMoved || (t.image.width = t.gesture.image[0].offsetWidth, t.image.height = t.gesture.image[0].offsetHeight, t.image.startX = w.getTranslate(t.gesture.imageWrap[0], "x") || 0, t.image.startY = w.getTranslate(t.gesture.imageWrap[0], "y") || 0, t.gesture.slideWidth = t.gesture.slide[0].offsetWidth, t.gesture.slideHeight = t.gesture.slide[0].offsetHeight, t.gesture.imageWrap.transition(0), w.rtl && (t.image.startX = -t.image.startX), w.rtl && (t.image.startY = -t.image.startY));
                            var n = t.image.width * t.scale, r = t.image.height * t.scale;
                            if (!(n < t.gesture.slideWidth && r < t.gesture.slideHeight)) {
                                if (t.image.minX = Math.min(t.gesture.slideWidth / 2 - n / 2, 0), t.image.maxX = -t.image.minX, t.image.minY = Math.min(t.gesture.slideHeight / 2 - r / 2, 0), t.image.maxY = -t.image.minY, t.image.touchesCurrent.x = "touchmove" === e.type ? e.targetTouches[0].pageX : e.pageX, t.image.touchesCurrent.y = "touchmove" === e.type ? e.targetTouches[0].pageY : e.pageY, !t.image.isMoved && !t.isScaling) {
                                    if (w.isHorizontal() && Math.floor(t.image.minX) === Math.floor(t.image.startX) && t.image.touchesCurrent.x < t.image.touchesStart.x || Math.floor(t.image.maxX) === Math.floor(t.image.startX) && t.image.touchesCurrent.x > t.image.touchesStart.x)return void(t.image.isTouched = !1);
                                    if (!w.isHorizontal() && Math.floor(t.image.minY) === Math.floor(t.image.startY) && t.image.touchesCurrent.y < t.image.touchesStart.y || Math.floor(t.image.maxY) === Math.floor(t.image.startY) && t.image.touchesCurrent.y > t.image.touchesStart.y)return void(t.image.isTouched = !1)
                                }
                                e.preventDefault(), e.stopPropagation(), t.image.isMoved = !0, t.image.currentX = t.image.touchesCurrent.x - t.image.touchesStart.x + t.image.startX, t.image.currentY = t.image.touchesCurrent.y - t.image.touchesStart.y + t.image.startY, t.image.currentX < t.image.minX && (t.image.currentX = t.image.minX + 1 - Math.pow(t.image.minX - t.image.currentX + 1, .8)), t.image.currentX > t.image.maxX && (t.image.currentX = t.image.maxX - 1 + Math.pow(t.image.currentX - t.image.maxX + 1, .8)),
                                t.image.currentY < t.image.minY && (t.image.currentY = t.image.minY + 1 - Math.pow(t.image.minY - t.image.currentY + 1, .8)), t.image.currentY > t.image.maxY && (t.image.currentY = t.image.maxY - 1 + Math.pow(t.image.currentY - t.image.maxY + 1, .8)), t.velocity.prevPositionX || (t.velocity.prevPositionX = t.image.touchesCurrent.x), t.velocity.prevPositionY || (t.velocity.prevPositionY = t.image.touchesCurrent.y), t.velocity.prevTime || (t.velocity.prevTime = Date.now()), t.velocity.x = (t.image.touchesCurrent.x - t.velocity.prevPositionX) / (Date.now() - t.velocity.prevTime) / 2, t.velocity.y = (t.image.touchesCurrent.y - t.velocity.prevPositionY) / (Date.now() - t.velocity.prevTime) / 2, Math.abs(t.image.touchesCurrent.x - t.velocity.prevPositionX) < 2 && (t.velocity.x = 0), Math.abs(t.image.touchesCurrent.y - t.velocity.prevPositionY) < 2 && (t.velocity.y = 0), t.velocity.prevPositionX = t.image.touchesCurrent.x, t.velocity.prevPositionY = t.image.touchesCurrent.y, t.velocity.prevTime = Date.now(), t.gesture.imageWrap.transform("translate3d(" + t.image.currentX + "px, " + t.image.currentY + "px,0)")
                            }
                        }
                    },
                    onTouchEnd: function (e, t) {
                        var n = e.zoom;
                        if (n.gesture.image && 0 !== n.gesture.image.length) {
                            if (!n.image.isTouched || !n.image.isMoved)return n.image.isTouched = !1, void(n.image.isMoved = !1);
                            n.image.isTouched = !1, n.image.isMoved = !1;
                            var r = 300, i = 300, a = n.velocity.x * r, o = n.image.currentX + a, s = n.velocity.y * i, l = n.image.currentY + s;
                            0 !== n.velocity.x && (r = Math.abs((o - n.image.currentX) / n.velocity.x)), 0 !== n.velocity.y && (i = Math.abs((l - n.image.currentY) / n.velocity.y));
                            var u = Math.max(r, i);
                            n.image.currentX = o, n.image.currentY = l;
                            var c = n.image.width * n.scale, p = n.image.height * n.scale;
                            n.image.minX = Math.min(n.gesture.slideWidth / 2 - c / 2, 0), n.image.maxX = -n.image.minX, n.image.minY = Math.min(n.gesture.slideHeight / 2 - p / 2, 0), n.image.maxY = -n.image.minY, n.image.currentX = Math.max(Math.min(n.image.currentX, n.image.maxX), n.image.minX), n.image.currentY = Math.max(Math.min(n.image.currentY, n.image.maxY), n.image.minY), n.gesture.imageWrap.transition(u).transform("translate3d(" + n.image.currentX + "px, " + n.image.currentY + "px,0)")
                        }
                    },
                    onTransitionEnd: function (e) {
                        var t = e.zoom;
                        t.gesture.slide && e.previousIndex !== e.activeIndex && (t.gesture.image.transform("translate3d(0,0,0) scale(1)"), t.gesture.imageWrap.transform("translate3d(0,0,0)"), t.gesture.slide = t.gesture.image = t.gesture.imageWrap = void 0, t.scale = t.currentScale = 1)
                    },
                    toggleZoom: function (t, n) {
                        var r = t.zoom;
                        if (r.gesture.slide || (r.gesture.slide = t.clickedSlide ? e(t.clickedSlide) : t.slides.eq(t.activeIndex), r.gesture.image = r.gesture.slide.find("img, svg, canvas"), r.gesture.imageWrap = r.gesture.image.parent("." + t.params.zoomContainerClass)), r.gesture.image && 0 !== r.gesture.image.length) {
                            var i, a, o, s, l, u, c, p, d, f, h, m, g, v, y, x, w, b;
                            void 0 === r.image.touchesStart.x && n ? (i = "touchend" === n.type ? n.changedTouches[0].pageX : n.pageX, a = "touchend" === n.type ? n.changedTouches[0].pageY : n.pageY) : (i = r.image.touchesStart.x, a = r.image.touchesStart.y), r.scale && 1 !== r.scale ? (r.scale = r.currentScale = 1, r.gesture.imageWrap.transition(300).transform("translate3d(0,0,0)"), r.gesture.image.transition(300).transform("translate3d(0,0,0) scale(1)"), r.gesture.slide = void 0) : (r.scale = r.currentScale = r.gesture.imageWrap.attr("data-swiper-zoom") || t.params.zoomMax, n ? (w = r.gesture.slide[0].offsetWidth, b = r.gesture.slide[0].offsetHeight, o = r.gesture.slide.offset().left, s = r.gesture.slide.offset().top, l = o + w / 2 - i, u = s + b / 2 - a, d = r.gesture.image[0].offsetWidth, f = r.gesture.image[0].offsetHeight, h = d * r.scale, m = f * r.scale, g = Math.min(w / 2 - h / 2, 0), v = Math.min(b / 2 - m / 2, 0), y = -g, x = -v, c = l * r.scale, p = u * r.scale, c < g && (c = g), c > y && (c = y), p < v && (p = v), p > x && (p = x)) : (c = 0, p = 0), r.gesture.imageWrap.transition(300).transform("translate3d(" + c + "px, " + p + "px,0)"), r.gesture.image.transition(300).transform("translate3d(0,0,0) scale(" + r.scale + ")"))
                        }
                    },
                    attachEvents: function (t) {
                        var n = t ? "off" : "on";
                        if (w.params.zoom) {
                            var r = (w.slides, !("touchstart" !== w.touchEvents.start || !w.support.passiveListener || !w.params.passiveListeners) && {
                                passive: !0,
                                capture: !1
                            });
                            w.support.gestures ? (w.slides[n]("gesturestart", w.zoom.onGestureStart, r), w.slides[n]("gesturechange", w.zoom.onGestureChange, r), w.slides[n]("gestureend", w.zoom.onGestureEnd, r)) : "touchstart" === w.touchEvents.start && (w.slides[n](w.touchEvents.start, w.zoom.onGestureStart, r), w.slides[n](w.touchEvents.move, w.zoom.onGestureChange, r), w.slides[n](w.touchEvents.end, w.zoom.onGestureEnd, r)), w[n]("touchStart", w.zoom.onTouchStart), w.slides.each(function (t, r) {
                                e(r).find("." + w.params.zoomContainerClass).length > 0 && e(r)[n](w.touchEvents.move, w.zoom.onTouchMove)
                            }), w[n]("touchEnd", w.zoom.onTouchEnd), w[n]("transitionEnd", w.zoom.onTransitionEnd), w.params.zoomToggle && w.on("doubleTap", w.zoom.toggleZoom)
                        }
                    },
                    init: function () {
                        w.zoom.attachEvents()
                    },
                    destroy: function () {
                        w.zoom.attachEvents(!0)
                    }
                }, w._plugins = [];
                for (var q in w.plugins) {
                    var O = w.plugins[q](w, w.params[q]);
                    O && w._plugins.push(O)
                }
                return w.callPlugins = function (e) {
                    for (var t = 0; t < w._plugins.length; t++)e in w._plugins[t] && w._plugins[t][e](arguments[1], arguments[2], arguments[3], arguments[4], arguments[5])
                }, w.emitterEventListeners = {}, w.emit = function (e) {
                    w.params[e] && w.params[e](arguments[1], arguments[2], arguments[3], arguments[4], arguments[5]);
                    var t;
                    if (w.emitterEventListeners[e])for (t = 0; t < w.emitterEventListeners[e].length; t++)w.emitterEventListeners[e][t](arguments[1], arguments[2], arguments[3], arguments[4], arguments[5]);
                    w.callPlugins && w.callPlugins(e, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5])
                }, w.on = function (e, t) {
                    return e = d(e), w.emitterEventListeners[e] || (w.emitterEventListeners[e] = []), w.emitterEventListeners[e].push(t), w
                }, w.off = function (e, t) {
                    var n;
                    if (e = d(e), void 0 === t)return w.emitterEventListeners[e] = [], w;
                    if (w.emitterEventListeners[e] && 0 !== w.emitterEventListeners[e].length) {
                        for (n = 0; n < w.emitterEventListeners[e].length; n++)w.emitterEventListeners[e][n] === t && w.emitterEventListeners[e].splice(n, 1);
                        return w
                    }
                }, w.once = function (e, t) {
                    e = d(e);
                    var n = function () {
                        t(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4]), w.off(e, n)
                    };
                    return w.on(e, n), w
                }, w.a11y = {
                    makeFocusable: function (e) {
                        return e.attr("tabIndex", "0"), e
                    },
                    addRole: function (e, t) {
                        return e.attr("role", t), e
                    },
                    addLabel: function (e, t) {
                        return e.attr("aria-label", t), e
                    },
                    disable: function (e) {
                        return e.attr("aria-disabled", !0), e
                    },
                    enable: function (e) {
                        return e.attr("aria-disabled", !1), e
                    },
                    onEnterKey: function (t) {
                        13 === t.keyCode && (e(t.target).is(w.params.nextButton) ? (w.onClickNext(t), w.isEnd ? w.a11y.notify(w.params.lastSlideMessage) : w.a11y.notify(w.params.nextSlideMessage)) : e(t.target).is(w.params.prevButton) && (w.onClickPrev(t), w.isBeginning ? w.a11y.notify(w.params.firstSlideMessage) : w.a11y.notify(w.params.prevSlideMessage)), e(t.target).is("." + w.params.bulletClass) && e(t.target)[0].click())
                    },
                    liveRegion: e('<span class="' + w.params.notificationClass + '" aria-live="assertive" aria-atomic="true"></span>'),
                    notify: function (e) {
                        var t = w.a11y.liveRegion;
                        0 !== t.length && (t.html(""), t.html(e))
                    },
                    init: function () {
                        w.params.nextButton && w.nextButton && w.nextButton.length > 0 && (w.a11y.makeFocusable(w.nextButton), w.a11y.addRole(w.nextButton, "button"), w.a11y.addLabel(w.nextButton, w.params.nextSlideMessage)), w.params.prevButton && w.prevButton && w.prevButton.length > 0 && (w.a11y.makeFocusable(w.prevButton), w.a11y.addRole(w.prevButton, "button"), w.a11y.addLabel(w.prevButton, w.params.prevSlideMessage)), e(w.container).append(w.a11y.liveRegion)
                    },
                    initPagination: function () {
                        w.params.pagination && w.params.paginationClickable && w.bullets && w.bullets.length && w.bullets.each(function () {
                            var t = e(this);
                            w.a11y.makeFocusable(t), w.a11y.addRole(t, "button"), w.a11y.addLabel(t, w.params.paginationBulletMessage.replace(/{{index}}/, t.index() + 1))
                        })
                    },
                    destroy: function () {
                        w.a11y.liveRegion && w.a11y.liveRegion.length > 0 && w.a11y.liveRegion.remove()
                    }
                }, w.init = function () {
                    w.params.loop && w.createLoop(), w.updateContainerSize(), w.updateSlidesSize(), w.updatePagination(), w.params.scrollbar && w.scrollbar && (w.scrollbar.set(), w.params.scrollbarDraggable && w.scrollbar.enableDraggable()), "slide" !== w.params.effect && w.effects[w.params.effect] && (w.params.loop || w.updateProgress(), w.effects[w.params.effect].setTranslate()), w.params.loop ? w.slideTo(w.params.initialSlide + w.loopedSlides, 0, w.params.runCallbacksOnInit) : (w.slideTo(w.params.initialSlide, 0, w.params.runCallbacksOnInit), 0 === w.params.initialSlide && (w.parallax && w.params.parallax && w.parallax.setTranslate(), w.lazy && w.params.lazyLoading && (w.lazy.load(), w.lazy.initialImageLoaded = !0))), w.attachEvents(), w.params.observer && w.support.observer && w.initObservers(), w.params.preloadImages && !w.params.lazyLoading && w.preloadImages(), w.params.zoom && w.zoom && w.zoom.init(), w.params.autoplay && w.startAutoplay(), w.params.keyboardControl && w.enableKeyboardControl && w.enableKeyboardControl(), w.params.mousewheelControl && w.enableMousewheelControl && w.enableMousewheelControl(), w.params.hashnavReplaceState && (w.params.replaceState = w.params.hashnavReplaceState), w.params.history && w.history && w.history.init(), w.params.hashnav && w.hashnav && w.hashnav.init(), w.params.a11y && w.a11y && w.a11y.init(), w.emit("onInit", w)
                }, w.cleanupStyles = function () {
                    w.container.removeClass(w.classNames.join(" ")).removeAttr("style"), w.wrapper.removeAttr("style"), w.slides && w.slides.length && w.slides.removeClass([w.params.slideVisibleClass, w.params.slideActiveClass, w.params.slideNextClass, w.params.slidePrevClass].join(" ")).removeAttr("style").removeAttr("data-swiper-column").removeAttr("data-swiper-row"), w.paginationContainer && w.paginationContainer.length && w.paginationContainer.removeClass(w.params.paginationHiddenClass), w.bullets && w.bullets.length && w.bullets.removeClass(w.params.bulletActiveClass), w.params.prevButton && e(w.params.prevButton).removeClass(w.params.buttonDisabledClass), w.params.nextButton && e(w.params.nextButton).removeClass(w.params.buttonDisabledClass), w.params.scrollbar && w.scrollbar && (w.scrollbar.track && w.scrollbar.track.length && w.scrollbar.track.removeAttr("style"), w.scrollbar.drag && w.scrollbar.drag.length && w.scrollbar.drag.removeAttr("style"))
                }, w.destroy = function (e, t) {
                    w.detachEvents(), w.stopAutoplay(), w.params.scrollbar && w.scrollbar && w.params.scrollbarDraggable && w.scrollbar.disableDraggable(), w.params.loop && w.destroyLoop(), t && w.cleanupStyles(), w.disconnectObservers(), w.params.zoom && w.zoom && w.zoom.destroy(), w.params.keyboardControl && w.disableKeyboardControl && w.disableKeyboardControl(), w.params.mousewheelControl && w.disableMousewheelControl && w.disableMousewheelControl(), w.params.a11y && w.a11y && w.a11y.destroy(), w.params.history && !w.params.replaceState && window.removeEventListener("popstate", w.history.setHistoryPopState), w.params.hashnav && w.hashnav && w.hashnav.destroy(), w.emit("onDestroy"), !1 !== e && (w = null)
                }, w.init(), w
            }
        };
        t.prototype = {
            isSafari: function () {
                var e = window.navigator.userAgent.toLowerCase();
                return e.indexOf("safari") >= 0 && e.indexOf("chrome") < 0 && e.indexOf("android") < 0
            }(),
            isUiWebView: /(iPhone|iPod|iPad).*AppleWebKit(?!.*Safari)/i.test(window.navigator.userAgent),
            isArray: function (e) {
                return "[object Array]" === Object.prototype.toString.apply(e)
            },
            browser: {
                ie: window.navigator.pointerEnabled || window.navigator.msPointerEnabled,
                ieTouch: window.navigator.msPointerEnabled && window.navigator.msMaxTouchPoints > 1 || window.navigator.pointerEnabled && window.navigator.maxTouchPoints > 1,
                lteIE9: function () {
                    var e = document.createElement("div");
                    return e.innerHTML = "\x3c!--[if lte IE 9]><i></i><![endif]--\x3e", 1 === e.getElementsByTagName("i").length
                }()
            },
            device: function () {
                var e = window.navigator.userAgent, t = e.match(/(Android);?[\s\/]+([\d.]+)?/), n = e.match(/(iPad).*OS\s([\d_]+)/), r = e.match(/(iPod)(.*OS\s([\d_]+))?/), i = !n && e.match(/(iPhone\sOS|iOS)\s([\d_]+)/);
                return {ios: n || i || r, android: t}
            }(),
            support: {
                touch: window.Modernizr && !0 === Modernizr.touch || function () {
                    return !!("ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch)
                }(), transforms3d: window.Modernizr && !0 === Modernizr.csstransforms3d || function () {
                    var e = document.createElement("div").style;
                    return "webkitPerspective" in e || "MozPerspective" in e || "OPerspective" in e || "MsPerspective" in e || "perspective" in e
                }(), flexbox: function () {
                    for (var e = document.createElement("div").style, t = "alignItems webkitAlignItems webkitBoxAlign msFlexAlign mozBoxAlign webkitFlexDirection msFlexDirection mozBoxDirection mozBoxOrient webkitBoxDirection webkitBoxOrient".split(" "), n = 0; n < t.length; n++)if (t[n] in e)return !0
                }(), observer: function () {
                    return "MutationObserver" in window || "WebkitMutationObserver" in window
                }(), passiveListener: function () {
                    var e = !1;
                    try {
                        var t = Object.defineProperty({}, "passive", {
                            get: function () {
                                e = !0
                            }
                        });
                        window.addEventListener("testPassiveListener", null, t)
                    } catch (e) {
                    }
                    return e
                }(), gestures: function () {
                    return "ongesturestart" in window
                }()
            },
            plugins: {}
        }, function (e) {
            e.fn.swiper = function (n) {
                var r;
                return e(this).each(function () {
                    var e = new t(this, n);
                    r || (r = e)
                }), r
            }
        }(e);
        var n = e;
        return n && ("transitionEnd" in n.fn || (n.fn.transitionEnd = function (e) {
            function t(a) {
                if (a.target === this)for (e.call(this, a), n = 0; n < r.length; n++)i.off(r[n], t)
            }

            var n, r = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"], i = this;
            if (e)for (n = 0; n < r.length; n++)i.on(r[n], t);
            return this
        }), "transform" in n.fn || (n.fn.transform = function (e) {
            for (var t = 0; t < this.length; t++) {
                var n = this[t].style;
                n.webkitTransform = n.MsTransform = n.msTransform = n.MozTransform = n.OTransform = n.transform = e
            }
            return this
        }), "transition" in n.fn || (n.fn.transition = function (e) {
            "string" != typeof e && (e += "ms");
            for (var t = 0; t < this.length; t++) {
                var n = this[t].style;
                n.webkitTransitionDuration = n.MsTransitionDuration = n.msTransitionDuration = n.MozTransitionDuration = n.OTransitionDuration = n.transitionDuration = e
            }
            return this
        }), "outerWidth" in n.fn || (n.fn.outerWidth = function (e) {
            return this.length > 0 ? e ? this[0].offsetWidth + parseFloat(this.css("margin-right")) + parseFloat(this.css("margin-left")) : this[0].offsetWidth : null
        })), t
    }), function e(t, n, r) {
        function i(o, s) {
            if (!n[o]) {
                if (!t[o]) {
                    var l = "function" == typeof require && require;
                    if (!s && l)return l(o, !0);
                    if (a)return a(o, !0);
                    throw new Error("Cannot find module '" + o + "'")
                }
                var u = n[o] = {exports: {}};
                t[o][0].call(u.exports, function (e) {
                    var n = t[o][1][e];
                    return i(n || e)
                }, u, u.exports, e, t, n, r)
            }
            return n[o].exports
        }

        for (var a = "function" == typeof require && require, o = 0; o < r.length; o++)i(r[o]);
        return i
    }({
        1: [function (e, t, n) {
            var r = e("jquery");
            t.exports = {
                initAnimationItems: function () {
                    r(".animated").each(function () {
                        var e, t;
                        r(this).attr("data-origin-class", r(this).attr("class")), e = r(this).data("ani-duration"), t = r(this).data("ani-delay"), r(this).css({
                            visibility: "hidden",
                            "animation-duration": e,
                            "-webkit-animation-duration": e,
                            "animation-delay": t,
                            "-webkit-animation-delay": t
                        })
                    })
                }, playAnimation: function (e) {
                    this.clearAnimation();
                    var t = e.slides[e.activeIndex].querySelectorAll(".animated");
                    r(t).each(function () {
                        var e;
                        r(this).css({visibility: "visible"}), e = r(this).data("ani-name"), r(this).addClass(e)
                    })
                }, clearAnimation: function () {
                    r(".animated").each(function () {
                        r(this).css({visibility: "hidden"}), r(this).attr("class", r(this).data("origin-class"))
                    })
                }
            }
        }, {jquery: 4}], 2: [function (e, t, n) {
            !function () {
                !function (e) {
                    e.fn.barrager = function (t) {
                        t = e.extend({
                            close: !0,
                            bottom: 0,
                            max: 10,
                            speed: 8,
                            color: "#fff",
                            old_ie_color: "#000000"
                        }, t || {});
                        var n = (new Date).getTime(), r = "barrage_" + n, i = "#" + r, a = e("<div class='barrage' id='" + r + "'></div>").appendTo(e(this)), o = e(window).height() - 100, s = o > this.height() ? this.height() : o, l = e(window).width() + 500, u = l > this.width() ? this.width() : l, c = 0 == t.bottom ? Math.floor(Math.random() * s + 40) : t.bottom;
                        if (a.css("top", c + "px"), div_barrager_box = e("<div class='barrage_box cl'></div>").appendTo(a), t.img) {
                            div_barrager_box.append("<a class='portrait z' href='javascript:;'></a>");
                            e("<img src='' >").appendTo(i + " .barrage_box .portrait").attr("src", t.img)
                        }
                        div_barrager_box.append(" <div class='z p'></div>"), t.close && div_barrager_box.append(" <div class='close z'></div>");
                        var p = e("<a title='' href='' target='_blank'></a>").appendTo(i + " .barrage_box .p");
                        p.attr({
                            href: t.href,
                            id: t.id
                        }).empty().append(t.info), navigator.userAgent.indexOf("MSIE 6.0") > 0 || navigator.userAgent.indexOf("MSIE 7.0") > 0 || navigator.userAgent.indexOf("MSIE 8.0") > 0 ? p.css("color", t.old_ie_color) : p.css("color", t.color);
                        a.css("margin-right", 0), e(i).animate({right: u}, 1e3 * t.speed, "linear", function () {
                            e(i).remove()
                        })
                    }, e.fn.barrager.removeAll = function () {
                        e(".barrage").remove()
                    }
                }(jQuery)
            }(), function () {
                "use strict";
                e("fastclick")(document.body);
                var t = e("./animation-control.js"), n = "http://m.uzhuang.com", r = function (e) {
                    //console.log(e)
                    $(".slide-6 .item-i-2").barrager(e)
                };
                window.danmu = r;
                var i = !1, a = $("audio").get(0), o = $(".btn-music"), s = function () {
                    a.play(), o.removeClass("paused")
                }, l = function () {
                    a.pause(), o.addClass("paused")
                }, u = function (e) {
                    !o.hasClass("paused") && a.paused && s()
                };
                window.playaudio = function () {
                    u()
                }, a.oncanplay = function () {
                    s()
                };
                var c, p, d = function () {
                    var e = $(".down-arrow");
                    o.click(function () {
                        a.paused ? s() : l()
                    }), c = new Swiper(".swiper-container-1", {
                        mousewheelControl: !0,
                        initialSlide: 0,
                        effect: "fade",
                        speed: 400,
                        direction: "vertical",
                        fade: {crossFade: !1},
                        coverflow: {rotate: 100, stretch: 0, depth: 300, modifier: 1, slideShadows: !1},
                        flip: {limitRotation: !0, slideShadows: !1},
                        onInit: function (e) {
                            t.initAnimationItems(), t.playAnimation(e)
                        },
                        onTransitionStart: function (t) {
                            u();
                            var n = t.activeIndex;
                            n === t.slides.length - 1 || 4 === n ? e.hide() : e.show(), n === t.slides.length - 1 ? (o.hide(), $(".slide-7 .item-i-3").css({display: "block"})) : o.show(), n >= 0 && $(".slide-" + n + ",.slide-" + (n + 1) + ",.slide-" + (n + 2)).filter(".lazy").removeClass("lazy"), i = 6 === n
                        },
                        onTransitionEnd: function (e) {
                            t.playAnimation(e)
                        },
                        onTouchStart: function (e, t) {
                            u()
                        },
                        onSlideChangeStart: function (e) {
                        },
                        onSlideChangeEnd: function (e) {
                        }
                    });
                    var n = $(".slide-1");
                    n.hasClass("lazy") && setTimeout(function () {
                        n.removeClass("lazy")
                    }, 1e3)
                }, f = function () {
                    $(".slide-0").find(".item-i-10").on("touchStart touchMove", function () {
                        u()
                    })
                }, h = function () {
                    var e = $(".slide-4");
                    e.find("input").on("keydown", function (e) {
                        13 === e.keyCode && e.target.value && ("myName" === e.target.id ? $("#myMobile").val() || $("#myMobile").trigger("focus") : "myMobile" === e.target.id && ($("#myName").val() || $("#myName").trigger("focus")))
                    }), e.find(".item-text-4").on("click", function () {

                        /*var t = e.find("#myMobile").val(), r = e.find("#myName").val();
                         t ? $.ajax({
                         type: "get",
                         dataType: "json",
                         url: n + "/GetUserInfo.aspx",
                         cache: !1,
                         data: {phone: t, nickname: r}
                         }).done(function (e) {
                         "1" === e.Success && (p = e.Message, window.localStorage && window.localStorage.setItem("userInfo", JSON.stringify(p)), i(p))
                         }) : (r ? (e.find(".userName").html(r), e.find(".div-member .item-i-2-2").css({display: "none"}), window.globalUserName = r, window.wechatshare()) : (e.find(".userName").html(""), e.find(".div-member .item-i-2-2").css({display: "block"})), i())*/
                        $(".userName").html(r);
                        $(".div-member .item-i-2-2").css({display: "none"});
                        i();
                    });
                    var t = window.localStorage && window.localStorage.getItem("userInfo");
                    if (t) {
                        var r = JSON.parse(t);
                        e.find("#myMobile").val(r.UserPhone), e.find("#myName").val(r.UserName)
                    }
                    var i = function (e) {
                        c.slideTo(5);
                        var t = $(".slide-5"), n = !1, r = $(".slide-4").find("#myName").val();
                        if (e && (n = 1 === e.IsEmployee, r = e.NickName), t.find(".div-vip").toggleClass("hide", !n), t.find(".div-member").toggleClass("hide", n), n) {
                            t.find(".userName").html(e.UserName || e.NickName), window.globalUserName = e.UserName || e.NickName; //window.wechatshare();
                            var i = e.EntryDate;
                            i && (t.find(".year").html(i.replace(/-\d+-\d+$/, "")), t.find(".month").html(i.replace(/^\d+-/, "").replace(/-\d+$/, "")), t.find(".date").html(i.replace(/^\d+-\d+-/, ""))), t.find(".days").html(e.EntryDay)
                        } else {
                            r ? (t.find(".userName").html(r), t.find(".div-member .item-i-2-2").css({display: "none"})) : (!1, t.find(".userName").html(""), t.find(".div-member .item-i-2-2").css({display: "block"}))
                        }
                    }
                };

                (function () {

                })();
                function getDanMuNum() {
                    $.ajax({
                        type:'post',
                        dataType:'json',
                        url:'/index.php?m=wap&f=count&v=index',
                        success:function (res) {
                            //console.log(res);
                            var t = $(".slide-6");
                            t.find(".item-i-3").css({display: "block"}).addClass("animated"), t.find(".item-t-3-3").html(res.data.count_num), window.globalCount = e;// window.wechatshare()
                        },
                        error:function (err) {
                            //console.log(err)
                        }
                    })
                }
                getDanMuNum();
                //  $.ajax({type: "get", dataType: "json", url: n + "/GetCounter.aspx", cache: !1}).done(function (e) {
                //     var t = $(".slide-6");
                //     t.find(".item-i-3").css({display: "block"}).addClass("animated"), t.find(".item-t-3-3").html(11111), window.globalCount = e;// window.wechatshare()
                // });
                var m = function () {
                    var e = $(".slide-6");
                    e.find(".item-btn-6").on("click", function () {
                        var t = $("#myMobile").val(), i = e.find("#blessword").val();
                        getDanMuNum();
                        r({
                            img: "",
                            info: i,
                            href: "",
                            close: !1,
                            speed: 12,
                            color: "#ffd8b1",
                            old_ie_color: "#000000"
                        }), e.find("#blessword").val("");

                    });
                    var t = [], a = 0, o = 0;
                    window.arrarr = [], window.logarr = [];
                    var s = function () {
                        window.arrarr.length <= 1 && (window.arrarr.length && window.arrarr.splice(0, 1), window.arrarr.push(1, 2, 3, 4, 5, 6, 7, 8, 9));
                        var e = function () {
                            var t = parseInt(Math.random() * window.arrarr.length), n = window.arrarr[t];
                            return n === o ? n = e() : (o = n, window.arrarr.splice(t, 1)), n
                        };
                        return e()
                    }, l = function () {
                        var e = t[a];
                        if (e && e.BlessWord) {
                            var n = {
                                info: e.BlessWord, close: !1, speed: 12, bottom: function () {
                                    return 32 * s()
                                }(), color: "#f5b87a", old_ie_color: "#000000"
                            };
                            r(n), a++
                        } else a = 0
                    }, u = function () {
                        i && l(), setTimeout(function () {
                            u()
                        }, 1500)
                    };
                    !function () {
                        ["今天是个特殊的日子，祝优装美家生日快乐！","以家为名 以心相约","祝优装美家生日快乐！","祝生日快乐！","祝生日快乐！","祝生日快乐！","祝生日快乐！","感谢优装管家的专业服务","祝优装美家越来越好","靠谱！","快来个大红包啊~","祝优装美家未来蒸蒸日上","福利！福利！福利！","背景音乐好","祝优装美家越办越好","我要红包","生日快乐！生日快乐！","靠谱的装修平台，值得信赖。","感谢优装美家，给我们派个很敬业的管家","加油！","如果感到幸福你就拍拍手","优装美家2周年，我愿与公司共成长！","继往开来，勇攀高峰~","今天是个好日子","不一样的平台 不一样的家装","哇！好多祝福啊，我的能看到么，祝生快！","忆往昔，峥嵘岁月两载","很棒的平台，祝越来越好。","祝生日快乐！"].forEach(function (e, n) {
                            t.push({UserName: "", BlessWord: e})
                        })
                    }(), u()
                }, g = function () {
                    var e = $(".slide-7");
                    // e.find(".item-i-3").on("click", function () {
                    //     e.find(".item-i-3").css({display: "none"})
                    // })
                };
                $(document).ready(function () {
                    d(), $(".loading-overlay").slideUp(), f(), h(), m(), g(), window.mmySwiper = c
                });
                setInterval(function () {
                    document.body.scrollTop = document.body.scrollHeight
                }, 100);
                // document.addEventListener("DOMContentLoaded", function () {
                //     console.log(1)
                //     $('.audo_bgm')[0].play(), document.addEventListener("WeixinJSBridgeReady", function () {
                //         console.log(2)
                //         $('.audo_bgm')[0].play();
                //     }, !1)
                // }), document.addEventListener("touchstart", function () {
                //     console.log(3)
                //     $('.audo_bgm')[0].play();
                // })
            }()
        }, {"./animation-control.js": 1, fastclick: 3}], 3: [function (e, t, n) {
            !function () {
                "use strict";
                function e(t, n) {
                    var i;
                    if (n = n || {}, this.trackingClick = !1, this.trackingClickStart = 0, this.targetElement = null, this.touchStartX = 0, this.touchStartY = 0, this.lastTouchIdentifier = 0, this.touchBoundary = n.touchBoundary || 10, this.layer = t, this.tapDelay = n.tapDelay || 200, this.tapTimeout = n.tapTimeout || 700, !e.notNeeded(t)) {
                        for (var a = ["onMouse", "onClick", "onTouchStart", "onTouchMove", "onTouchEnd", "onTouchCancel"], o = this, s = 0, l = a.length; s < l; s++)o[a[s]] = function (e, t) {
                            return function () {
                                return e.apply(t, arguments)
                            }
                        }(o[a[s]], o);
                        r && (t.addEventListener("mouseover", this.onMouse, !0), t.addEventListener("mousedown", this.onMouse, !0), t.addEventListener("mouseup", this.onMouse, !0)), t.addEventListener("click", this.onClick, !0), t.addEventListener("touchstart", this.onTouchStart, !1), t.addEventListener("touchmove", this.onTouchMove, !1), t.addEventListener("touchend", this.onTouchEnd, !1), t.addEventListener("touchcancel", this.onTouchCancel, !1), Event.prototype.stopImmediatePropagation || (t.removeEventListener = function (e, n, r) {
                            var i = Node.prototype.removeEventListener;
                            "click" === e ? i.call(t, e, n.hijacked || n, r) : i.call(t, e, n, r)
                        }, t.addEventListener = function (e, n, r) {
                            var i = Node.prototype.addEventListener;
                            "click" === e ? i.call(t, e, n.hijacked || (n.hijacked = function (e) {
                                        e.propagationStopped || n(e)
                                    }), r) : i.call(t, e, n, r)
                        }), "function" == typeof t.onclick && (i = t.onclick, t.addEventListener("click", function (e) {
                            i(e)
                        }, !1), t.onclick = null)
                    }
                }

                var n = navigator.userAgent.indexOf("Windows Phone") >= 0, r = navigator.userAgent.indexOf("Android") > 0 && !n, i = /iP(ad|hone|od)/.test(navigator.userAgent) && !n, a = i && /OS 4_\d(_\d)?/.test(navigator.userAgent), o = i && /OS [6-7]_\d/.test(navigator.userAgent), s = navigator.userAgent.indexOf("BB10") > 0;
                e.prototype.needsClick = function (e) {
                    switch (e.nodeName.toLowerCase()) {
                        case"button":
                        case"select":
                        case"textarea":
                            if (e.disabled)return !0;
                            break;
                        case"input":
                            if (i && "file" === e.type || e.disabled)return !0;
                            break;
                        case"label":
                        case"iframe":
                        case"video":
                            return !0
                    }
                    return /\bneedsclick\b/.test(e.className)
                }, e.prototype.needsFocus = function (e) {
                    switch (e.nodeName.toLowerCase()) {
                        case"textarea":
                            return !0;
                        case"select":
                            return !r;
                        case"input":
                            switch (e.type) {
                                case"button":
                                case"checkbox":
                                case"file":
                                case"image":
                                case"radio":
                                case"submit":
                                    return !1
                            }
                            return !e.disabled && !e.readOnly;
                        default:
                            return /\bneedsfocus\b/.test(e.className)
                    }
                }, e.prototype.sendClick = function (e, t) {
                    var n, r;
                    document.activeElement && document.activeElement !== e && document.activeElement.blur(), r = t.changedTouches[0], n = document.createEvent("MouseEvents"), n.initMouseEvent(this.determineEventType(e), !0, !0, window, 1, r.screenX, r.screenY, r.clientX, r.clientY, !1, !1, !1, !1, 0, null), n.forwardedTouchEvent = !0, e.dispatchEvent(n)
                }, e.prototype.determineEventType = function (e) {
                    return r && "select" === e.tagName.toLowerCase() ? "mousedown" : "click"
                }, e.prototype.focus = function (e) {
                    var t;
                    i && e.setSelectionRange && 0 !== e.type.indexOf("date") && "time" !== e.type && "month" !== e.type ? (t = e.value.length, e.setSelectionRange(t, t)) : e.focus()
                }, e.prototype.updateScrollParent = function (e) {
                    var t, n;
                    if (!(t = e.fastClickScrollParent) || !t.contains(e)) {
                        n = e;
                        do {
                            if (n.scrollHeight > n.offsetHeight) {
                                t = n, e.fastClickScrollParent = n;
                                break
                            }
                            n = n.parentElement
                        } while (n)
                    }
                    t && (t.fastClickLastScrollTop = t.scrollTop)
                }, e.prototype.getTargetElementFromEventTarget = function (e) {
                    return e.nodeType === Node.TEXT_NODE ? e.parentNode : e
                }, e.prototype.onTouchStart = function (e) {
                    var t, n, r;
                    if (e.targetTouches.length > 1)return !0;
                    if (t = this.getTargetElementFromEventTarget(e.target), n = e.targetTouches[0], i) {
                        if (r = window.getSelection(), r.rangeCount && !r.isCollapsed)return !0;
                        if (!a) {
                            if (n.identifier && n.identifier === this.lastTouchIdentifier)return e.preventDefault(), !1;
                            this.lastTouchIdentifier = n.identifier, this.updateScrollParent(t)
                        }
                    }
                    return this.trackingClick = !0, this.trackingClickStart = e.timeStamp, this.targetElement = t, this.touchStartX = n.pageX, this.touchStartY = n.pageY, e.timeStamp - this.lastClickTime < this.tapDelay && e.preventDefault(), !0
                }, e.prototype.touchHasMoved = function (e) {
                    var t = e.changedTouches[0], n = this.touchBoundary;
                    return Math.abs(t.pageX - this.touchStartX) > n || Math.abs(t.pageY - this.touchStartY) > n
                }, e.prototype.onTouchMove = function (e) {
                    return !this.trackingClick || ((this.targetElement !== this.getTargetElementFromEventTarget(e.target) || this.touchHasMoved(e)) && (this.trackingClick = !1, this.targetElement = null), !0)
                }, e.prototype.findControl = function (e) {
                    return void 0 !== e.control ? e.control : e.htmlFor ? document.getElementById(e.htmlFor) : e.querySelector("button, input:not([type=hidden]), keygen, meter, output, progress, select, textarea")
                }, e.prototype.onTouchEnd = function (e) {
                    var t, n, s, l, u, c = this.targetElement;
                    if (!this.trackingClick)return !0;
                    if (e.timeStamp - this.lastClickTime < this.tapDelay)return this.cancelNextClick = !0, !0;
                    if (e.timeStamp - this.trackingClickStart > this.tapTimeout)return !0;
                    if (this.cancelNextClick = !1, this.lastClickTime = e.timeStamp, n = this.trackingClickStart, this.trackingClick = !1, this.trackingClickStart = 0, o && (u = e.changedTouches[0], c = document.elementFromPoint(u.pageX - window.pageXOffset, u.pageY - window.pageYOffset) || c, c.fastClickScrollParent = this.targetElement.fastClickScrollParent), "label" === (s = c.tagName.toLowerCase())) {
                        if (t = this.findControl(c)) {
                            if (this.focus(c), r)return !1;
                            c = t
                        }
                    } else if (this.needsFocus(c))return e.timeStamp - n > 100 || i && window.top !== window && "input" === s ? (this.targetElement = null, !1) : (this.focus(c), this.sendClick(c, e), i && "select" === s || (this.targetElement = null, e.preventDefault()), !1);
                    return !(!i || a || !(l = c.fastClickScrollParent) || l.fastClickLastScrollTop === l.scrollTop) || (this.needsClick(c) || (e.preventDefault(), this.sendClick(c, e)), !1)
                }, e.prototype.onTouchCancel = function () {
                    this.trackingClick = !1, this.targetElement = null
                }, e.prototype.onMouse = function (e) {
                    return !this.targetElement || (!!e.forwardedTouchEvent || (!e.cancelable || (!(!this.needsClick(this.targetElement) || this.cancelNextClick) || (e.stopImmediatePropagation ? e.stopImmediatePropagation() : e.propagationStopped = !0, e.stopPropagation(), e.preventDefault(), !1))))
                }, e.prototype.onClick = function (e) {
                    var t;
                    return this.trackingClick ? (this.targetElement = null, this.trackingClick = !1, !0) : "submit" === e.target.type && 0 === e.detail || (t = this.onMouse(e), t || (this.targetElement = null), t)
                }, e.prototype.destroy = function () {
                    var e = this.layer;
                    r && (e.removeEventListener("mouseover", this.onMouse, !0), e.removeEventListener("mousedown", this.onMouse, !0), e.removeEventListener("mouseup", this.onMouse, !0)), e.removeEventListener("click", this.onClick, !0), e.removeEventListener("touchstart", this.onTouchStart, !1), e.removeEventListener("touchmove", this.onTouchMove, !1), e.removeEventListener("touchend", this.onTouchEnd, !1), e.removeEventListener("touchcancel", this.onTouchCancel, !1)
                }, e.notNeeded = function (e) {
                    var t, n, i;
                    if (void 0 === window.ontouchstart)return !0;
                    if (n = +(/Chrome\/([0-9]+)/.exec(navigator.userAgent) || [, 0])[1]) {
                        if (!r)return !0;
                        if (t = document.querySelector("meta[name=viewport]")) {
                            if (-1 !== t.content.indexOf("user-scalable=no"))return !0;
                            if (n > 31 && document.documentElement.scrollWidth <= window.outerWidth)return !0
                        }
                    }
                    if (s && (i = navigator.userAgent.match(/Version\/([0-9]*)\.([0-9]*)/), i[1] >= 10 && i[2] >= 3 && (t = document.querySelector("meta[name=viewport]")))) {
                        if (-1 !== t.content.indexOf("user-scalable=no"))return !0;
                        if (document.documentElement.scrollWidth <= window.outerWidth)return !0
                    }
                    return "none" === e.style.msTouchAction || "manipulation" === e.style.touchAction || (!!(+(/Firefox\/([0-9]+)/.exec(navigator.userAgent) || [, 0])[1] >= 27 && (t = document.querySelector("meta[name=viewport]")) && (-1 !== t.content.indexOf("user-scalable=no") || document.documentElement.scrollWidth <= window.outerWidth)) || ("none" === e.style.touchAction || "manipulation" === e.style.touchAction))
                }, e.attach = function (t, n) {
                    return new e(t, n)
                }, "function" == typeof define && "object" == typeof define.amd && define.amd ? define(function () {
                        return e
                    }) : void 0 !== t && t.exports ? (t.exports = e.attach, t.exports.FastClick = e) : window.FastClick = e
            }()
        }, {}], 4: [function (e, t, n) {
            !function (e, n) {
                "use strict";
                "object" == typeof t && "object" == typeof t.exports ? t.exports = e.document ? n(e, !0) : function (e) {
                            if (!e.document)throw new Error("jQuery requires a window with a document");
                            return n(e)
                        } : n(e)
            }("undefined" != typeof window ? window : this, function (e, t) {
                "use strict";
                function n(e, t) {
                    t = t || ne;
                    var n = t.createElement("script");
                    n.text = e, t.head.appendChild(n).parentNode.removeChild(n)
                }

                function r(e) {
                    var t = !!e && "length" in e && e.length, n = he.type(e);
                    return "function" !== n && !he.isWindow(e) && ("array" === n || 0 === t || "number" == typeof t && t > 0 && t - 1 in e)
                }

                function i(e, t) {
                    return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase()
                }

                function a(e, t, n) {
                    return he.isFunction(t) ? he.grep(e, function (e, r) {
                            return !!t.call(e, r, e) !== n
                        }) : t.nodeType ? he.grep(e, function (e) {
                                return e === t !== n
                            }) : "string" != typeof t ? he.grep(e, function (e) {
                                    return se.call(t, e) > -1 !== n
                                }) : Se.test(t) ? he.filter(t, e, n) : (t = he.filter(t, e), he.grep(e, function (e) {
                                        return se.call(t, e) > -1 !== n && 1 === e.nodeType
                                    }))
                }

                function o(e, t) {
                    for (; (e = e[t]) && 1 !== e.nodeType;);
                    return e
                }

                function s(e) {
                    var t = {};
                    return he.each(e.match(Ne) || [], function (e, n) {
                        t[n] = !0
                    }), t
                }

                function l(e) {
                    return e
                }

                function u(e) {
                    throw e
                }

                function c(e, t, n, r) {
                    var i;
                    try {
                        e && he.isFunction(i = e.promise) ? i.call(e).done(t).fail(n) : e && he.isFunction(i = e.then) ? i.call(e, t, n) : t.apply(void 0, [e].slice(r))
                    } catch (e) {
                        n.apply(void 0, [e])
                    }
                }

                function p() {
                    ne.removeEventListener("DOMContentLoaded", p), e.removeEventListener("load", p), he.ready()
                }

                function d() {
                    this.expando = he.expando + d.uid++
                }

                function f(e) {
                    return "true" === e || "false" !== e && ("null" === e ? null : e === +e + "" ? +e : He.test(e) ? JSON.parse(e) : e)
                }

                function h(e, t, n) {
                    var r;
                    if (void 0 === n && 1 === e.nodeType)if (r = "data-" + t.replace(qe, "-$&").toLowerCase(), "string" == typeof(n = e.getAttribute(r))) {
                        try {
                            n = f(n)
                        } catch (e) {
                        }
                        je.set(e, t, n)
                    } else n = void 0;
                    return n
                }

                function m(e, t, n, r) {
                    var i, a = 1, o = 20, s = r ? function () {
                            return r.cur()
                        } : function () {
                            return he.css(e, t, "")
                        }, l = s(), u = n && n[3] || (he.cssNumber[t] ? "" : "px"), c = (he.cssNumber[t] || "px" !== u && +l) && Be.exec(he.css(e, t));
                    if (c && c[3] !== u) {
                        u = u || c[3], n = n || [], c = +l || 1;
                        do {
                            a = a || ".5", c /= a, he.style(e, t, c + u)
                        } while (a !== (a = s() / l) && 1 !== a && --o)
                    }
                    return n && (c = +c || +l || 0, i = n[1] ? c + (n[1] + 1) * n[2] : +n[2], r && (r.unit = u, r.start = c, r.end = i)), i
                }

                function g(e) {
                    var t, n = e.ownerDocument, r = e.nodeName, i = Xe[r];
                    return i || (t = n.body.appendChild(n.createElement(r)), i = he.css(t, "display"), t.parentNode.removeChild(t), "none" === i && (i = "block"), Xe[r] = i, i)
                }

                function v(e, t) {
                    for (var n, r, i = [], a = 0, o = e.length; a < o; a++)r = e[a], r.style && (n = r.style.display, t ? ("none" === n && (i[a] = Ie.get(r, "display") || null, i[a] || (r.style.display = "")), "" === r.style.display && Fe(r) && (i[a] = g(r))) : "none" !== n && (i[a] = "none", Ie.set(r, "display", n)));
                    for (a = 0; a < o; a++)null != i[a] && (e[a].style.display = i[a]);
                    return e
                }

                function y(e, t) {
                    var n;
                    return n = void 0 !== e.getElementsByTagName ? e.getElementsByTagName(t || "*") : void 0 !== e.querySelectorAll ? e.querySelectorAll(t || "*") : [], void 0 === t || t && i(e, t) ? he.merge([e], n) : n
                }

                function x(e, t) {
                    for (var n = 0, r = e.length; n < r; n++)Ie.set(e[n], "globalEval", !t || Ie.get(t[n], "globalEval"))
                }

                function w(e, t, n, r, i) {
                    for (var a, o, s, l, u, c, p = t.createDocumentFragment(), d = [], f = 0, h = e.length; f < h; f++)if ((a = e[f]) || 0 === a)if ("object" === he.type(a)) he.merge(d, a.nodeType ? [a] : a); else if (Ve.test(a)) {
                        for (o = o || p.appendChild(t.createElement("div")), s = (Ge.exec(a) || ["", ""])[1].toLowerCase(), l = _e[s] || _e._default, o.innerHTML = l[1] + he.htmlPrefilter(a) + l[2], c = l[0]; c--;)o = o.lastChild;
                        he.merge(d, o.childNodes), o = p.firstChild, o.textContent = ""
                    } else d.push(t.createTextNode(a));
                    for (p.textContent = "", f = 0; a = d[f++];)if (r && he.inArray(a, r) > -1) i && i.push(a); else if (u = he.contains(a.ownerDocument, a), o = y(p.appendChild(a), "script"), u && x(o), n)for (c = 0; a = o[c++];)$e.test(a.type || "") && n.push(a);
                    return p
                }

                function b() {
                    return !0
                }

                function T() {
                    return !1
                }

                function C() {
                    try {
                        return ne.activeElement
                    } catch (e) {
                    }
                }

                function S(e, t, n, r, i, a) {
                    var o, s;
                    if ("object" == typeof t) {
                        "string" != typeof n && (r = r || n, n = void 0);
                        for (s in t)S(e, s, n, r, t[s], a);
                        return e
                    }
                    if (null == r && null == i ? (i = n, r = n = void 0): null==i && ("string" == typeof n ? (i = r, r = void 0) : (i = r, r = n, n = void 0)), !1 === i
                )
                    i = T;
                else
                    if (!i)return e;
                    return 1 === a && (o = i, i = function (e) {
                        return he().off(e), o.apply(this, arguments)
                    }, i.guid = o.guid || (o.guid = he.guid++)), e.each(function () {
                        he.event.add(this, t, i, r, n)
                    })
                }

                function E(e, t) {
                    return i(e, "table") && i(11 !== t.nodeType ? t : t.firstChild, "tr") ? he(">tbody", e)[0] || e : e
                }

                function k(e) {
                    return e.type = (null !== e.getAttribute("type")) + "/" + e.type, e
                }

                function D(e) {
                    var t = nt.exec(e.type);
                    return t ? e.type = t[1] : e.removeAttribute("type"), e
                }

                function M(e, t) {
                    var n, r, i, a, o, s, l, u;
                    if (1 === t.nodeType) {
                        if (Ie.hasData(e) && (a = Ie.access(e), o = Ie.set(t, a), u = a.events)) {
                            delete o.handle, o.events = {};
                            for (i in u)for (n = 0, r = u[i].length; n < r; n++)he.event.add(t, i, u[i][n])
                        }
                        je.hasData(e) && (s = je.access(e), l = he.extend({}, s), je.set(t, l))
                    }
                }

                function N(e, t) {
                    var n = t.nodeName.toLowerCase();
                    "input" === n && Ye.test(e.type) ? t.checked = e.checked : "input" !== n && "textarea" !== n || (t.defaultValue = e.defaultValue)
                }

                function A(e, t, r, i) {
                    t = ae.apply([], t);
                    var a, o, s, l, u, c, p = 0, d = e.length, f = d - 1, h = t[0], m = he.isFunction(h);
                    if (m || d > 1 && "string" == typeof h && !fe.checkClone && tt.test(h))return e.each(function (n) {
                        var a = e.eq(n);
                        m && (t[0] = h.call(this, n, a.html())), A(a, t, r, i)
                    });
                    if (d && (a = w(t, e[0].ownerDocument, !1, e, i), o = a.firstChild, 1 === a.childNodes.length && (a = o), o || i)) {
                        for (s = he.map(y(a, "script"), k), l = s.length; p < d; p++)u = a, p !== f && (u = he.clone(u, !0, !0), l && he.merge(s, y(u, "script"))), r.call(e[p], u, p);
                        if (l)for (c = s[s.length - 1].ownerDocument, he.map(s, D), p = 0; p < l; p++)u = s[p], $e.test(u.type || "") && !Ie.access(u, "globalEval") && he.contains(c, u) && (u.src ? he._evalUrl && he._evalUrl(u.src) : n(u.textContent.replace(rt, ""), c))
                    }
                    return e
                }

                function L(e, t, n) {
                    for (var r, i = t ? he.filter(t, e) : e, a = 0; null != (r = i[a]); a++)n || 1 !== r.nodeType || he.cleanData(y(r)), r.parentNode && (n && he.contains(r.ownerDocument, r) && x(y(r, "script")), r.parentNode.removeChild(r));
                    return e
                }

                function P(e, t, n) {
                    var r, i, a, o, s = e.style;
                    return n = n || ot(e), n && (o = n.getPropertyValue(t) || n[t], "" !== o || he.contains(e.ownerDocument, e) || (o = he.style(e, t)), !fe.pixelMarginRight() && at.test(o) && it.test(t) && (r = s.width, i = s.minWidth, a = s.maxWidth, s.minWidth = s.maxWidth = s.width = o, o = n.width, s.width = r, s.minWidth = i, s.maxWidth = a)), void 0 !== o ? o + "" : o
                }

                function z(e, t) {
                    return {
                        get: function () {
                            return e() ? void delete this.get : (this.get = t).apply(this, arguments)
                        }
                    }
                }

                function I(e) {
                    if (e in dt)return e;
                    for (var t = e[0].toUpperCase() + e.slice(1), n = pt.length; n--;)if ((e = pt[n] + t) in dt)return e
                }

                function j(e) {
                    var t = he.cssProps[e];
                    return t || (t = he.cssProps[e] = I(e) || e), t
                }

                function H(e, t, n) {
                    var r = Be.exec(t);
                    return r ? Math.max(0, r[2] - (n || 0)) + (r[3] || "px") : t
                }

                function q(e, t, n, r, i) {
                    var a, o = 0;
                    for (a = n === (r ? "border" : "content") ? 4 : "width" === t ? 1 : 0; a < 4; a += 2)"margin" === n && (o += he.css(e, n + Re[a], !0, i)), r ? ("content" === n && (o -= he.css(e, "padding" + Re[a], !0, i)), "margin" !== n && (o -= he.css(e, "border" + Re[a] + "Width", !0, i))) : (o += he.css(e, "padding" + Re[a], !0, i), "padding" !== n && (o += he.css(e, "border" + Re[a] + "Width", !0, i)));
                    return o
                }

                function O(e, t, n) {
                    var r, i = ot(e), a = P(e, t, i), o = "border-box" === he.css(e, "boxSizing", !1, i);
                    return at.test(a) ? a : (r = o && (fe.boxSizingReliable() || a === e.style[t]), "auto" === a && (a = e["offset" + t[0].toUpperCase() + t.slice(1)]), (a = parseFloat(a) || 0) + q(e, t, n || (o ? "border" : "content"), r, i) + "px")
                }

                function B(e, t, n, r, i) {
                    return new B.prototype.init(e, t, n, r, i)
                }

                function R() {
                    ht && (!1 === ne.hidden && e.requestAnimationFrame ? e.requestAnimationFrame(R) : e.setTimeout(R, he.fx.interval), he.fx.tick())
                }

                function F() {
                    return e.setTimeout(function () {
                        ft = void 0
                    }), ft = he.now()
                }

                function W(e, t) {
                    var n, r = 0, i = {height: e};
                    for (t = t ? 1 : 0; r < 4; r += 2 - t)n = Re[r], i["margin" + n] = i["padding" + n] = e;
                    return t && (i.opacity = i.width = e), i
                }

                function X(e, t, n) {
                    for (var r, i = ($.tweeners[t] || []).concat($.tweeners["*"]), a = 0, o = i.length; a < o; a++)if (r = i[a].call(n, t, e))return r
                }

                function Y(e, t, n) {
                    var r, i, a, o, s, l, u, c, p = "width" in t || "height" in t, d = this, f = {}, h = e.style, m = e.nodeType && Fe(e), g = Ie.get(e, "fxshow");
                    n.queue || (o = he._queueHooks(e, "fx"), null == o.unqueued && (o.unqueued = 0, s = o.empty.fire, o.empty.fire = function () {
                        o.unqueued || s()
                    }), o.unqueued++, d.always(function () {
                        d.always(function () {
                            o.unqueued--, he.queue(e, "fx").length || o.empty.fire()
                        })
                    }));
                    for (r in t)if (i = t[r], mt.test(i)) {
                        if (delete t[r], a = a || "toggle" === i, i === (m ? "hide" : "show")) {
                            if ("show" !== i || !g || void 0 === g[r])continue;
                            m = !0
                        }
                        f[r] = g && g[r] || he.style(e, r)
                    }
                    if ((l = !he.isEmptyObject(t)) || !he.isEmptyObject(f)) {
                        p && 1 === e.nodeType && (n.overflow = [h.overflow, h.overflowX, h.overflowY], u = g && g.display, null == u && (u = Ie.get(e, "display")), c = he.css(e, "display"), "none" === c && (u ? c = u : (v([e], !0), u = e.style.display || u, c = he.css(e, "display"), v([e]))), ("inline" === c || "inline-block" === c && null != u) && "none" === he.css(e, "float") && (l || (d.done(function () {
                            h.display = u
                        }), null == u && (c = h.display, u = "none" === c ? "" : c)), h.display = "inline-block")), n.overflow && (h.overflow = "hidden", d.always(function () {
                            h.overflow = n.overflow[0], h.overflowX = n.overflow[1], h.overflowY = n.overflow[2]
                        })), l = !1;
                        for (r in f)l || (g ? "hidden" in g && (m = g.hidden) : g = Ie.access(e, "fxshow", {display: u}), a && (g.hidden = !m), m && v([e], !0), d.done(function () {
                            m || v([e]), Ie.remove(e, "fxshow");
                            for (r in f)he.style(e, r, f[r])
                        })), l = X(m ? g[r] : 0, r, d), r in g || (g[r] = l.start, m && (l.end = l.start, l.start = 0))
                    }
                }

                function G(e, t) {
                    var n, r, i, a, o;
                    for (n in e)if (r = he.camelCase(n), i = t[r], a = e[n], Array.isArray(a) && (i = a[1], a = e[n] = a[0]), n !== r && (e[r] = a, delete e[n]), (o = he.cssHooks[r]) && "expand" in o) {
                        a = o.expand(a), delete e[r];
                        for (n in a)n in e || (e[n] = a[n], t[n] = i)
                    } else t[r] = i
                }

                function $(e, t, n) {
                    var r, i, a = 0, o = $.prefilters.length, s = he.Deferred().always(function () {
                        delete l.elem
                    }), l = function () {
                        if (i)return !1;
                        for (var t = ft || F(), n = Math.max(0, u.startTime + u.duration - t), r = n / u.duration || 0, a = 1 - r, o = 0, l = u.tweens.length; o < l; o++)u.tweens[o].run(a);
                        return s.notifyWith(e, [u, a, n]), a < 1 && l ? n : (l || s.notifyWith(e, [u, 1, 0]), s.resolveWith(e, [u]), !1)
                    }, u = s.promise({
                        elem: e,
                        props: he.extend({}, t),
                        opts: he.extend(!0, {specialEasing: {}, easing: he.easing._default}, n),
                        originalProperties: t,
                        originalOptions: n,
                        startTime: ft || F(),
                        duration: n.duration,
                        tweens: [],
                        createTween: function (t, n) {
                            var r = he.Tween(e, u.opts, t, n, u.opts.specialEasing[t] || u.opts.easing);
                            return u.tweens.push(r), r
                        },
                        stop: function (t) {
                            var n = 0, r = t ? u.tweens.length : 0;
                            if (i)return this;
                            for (i = !0; n < r; n++)u.tweens[n].run(1);
                            return t ? (s.notifyWith(e, [u, 1, 0]), s.resolveWith(e, [u, t])) : s.rejectWith(e, [u, t]), this
                        }
                    }), c = u.props;
                    for (G(c, u.opts.specialEasing); a < o; a++)if (r = $.prefilters[a].call(u, e, c, u.opts))return he.isFunction(r.stop) && (he._queueHooks(u.elem, u.opts.queue).stop = he.proxy(r.stop, r)), r;
                    return he.map(c, X, u), he.isFunction(u.opts.start) && u.opts.start.call(e, u), u.progress(u.opts.progress).done(u.opts.done, u.opts.complete).fail(u.opts.fail).always(u.opts.always), he.fx.timer(he.extend(l, {
                        elem: e,
                        anim: u,
                        queue: u.opts.queue
                    })), u
                }

                function _(e) {
                    return (e.match(Ne) || []).join(" ")
                }

                function V(e) {
                    return e.getAttribute && e.getAttribute("class") || ""
                }

                function U(e, t, n, r) {
                    var i;
                    if (Array.isArray(t)) he.each(t, function (t, i) {
                        n || kt.test(e) ? r(e, i) : U(e + "[" + ("object" == typeof i && null != i ? t : "") + "]", i, n, r)
                    }); else if (n || "object" !== he.type(t)) r(e, t); else for (i in t)U(e + "[" + i + "]", t[i], n, r)
                }

                function K(e) {
                    return function (t, n) {
                        "string" != typeof t && (n = t, t = "*");
                        var r, i = 0, a = t.toLowerCase().match(Ne) || [];
                        if (he.isFunction(n))for (; r = a[i++];)"+" === r[0] ? (r = r.slice(1) || "*", (e[r] = e[r] || []).unshift(n)) : (e[r] = e[r] || []).push(n)
                    }
                }

                function Q(e, t, n, r) {
                    function i(s) {
                        var l;
                        return a[s] = !0, he.each(e[s] || [], function (e, s) {
                            var u = s(t, n, r);
                            return "string" != typeof u || o || a[u] ? o ? !(l = u) : void 0 : (t.dataTypes.unshift(u), i(u), !1)
                        }), l
                    }

                    var a = {}, o = e === Ot;
                    return i(t.dataTypes[0]) || !a["*"] && i("*")
                }

                function J(e, t) {
                    var n, r, i = he.ajaxSettings.flatOptions || {};
                    for (n in t)void 0 !== t[n] && ((i[n] ? e : r || (r = {}))[n] = t[n]);
                    return r && he.extend(!0, e, r), e
                }

                function Z(e, t, n) {
                    for (var r, i, a, o, s = e.contents, l = e.dataTypes; "*" === l[0];)l.shift(), void 0 === r && (r = e.mimeType || t.getResponseHeader("Content-Type"));
                    if (r)for (i in s)if (s[i] && s[i].test(r)) {
                        l.unshift(i);
                        break
                    }
                    if (l[0] in n) a = l[0]; else {
                        for (i in n) {
                            if (!l[0] || e.converters[i + " " + l[0]]) {
                                a = i;
                                break
                            }
                            o || (o = i)
                        }
                        a = a || o
                    }
                    if (a)return a !== l[0] && l.unshift(a), n[a]
                }

                function ee(e, t, n, r) {
                    var i, a, o, s, l, u = {}, c = e.dataTypes.slice();
                    if (c[1])for (o in e.converters)u[o.toLowerCase()] = e.converters[o];
                    for (a = c.shift(); a;)if (e.responseFields[a] && (n[e.responseFields[a]] = t), !l && r && e.dataFilter && (t = e.dataFilter(t, e.dataType)), l = a, a = c.shift())if ("*" === a) a = l; else if ("*" !== l && l !== a) {
                        if (!(o = u[l + " " + a] || u["* " + a]))for (i in u)if (s = i.split(" "), s[1] === a && (o = u[l + " " + s[0]] || u["* " + s[0]])) {
                            !0 === o ? o = u[i] : !0 !== u[i] && (a = s[0], c.unshift(s[1]));
                            break
                        }
                        if (!0 !== o)if (o && e.throws) t = o(t); else try {
                            t = o(t)
                        } catch (e) {
                            return {state: "parsererror", error: o ? e : "No conversion from " + l + " to " + a}
                        }
                    }
                    return {state: "success", data: t}
                }

                var te = [], ne = e.document, re = Object.getPrototypeOf, ie = te.slice, ae = te.concat, oe = te.push, se = te.indexOf, le = {}, ue = le.toString, ce = le.hasOwnProperty, pe = ce.toString, de = pe.call(Object), fe = {}, he = function (e, t) {
                    return new he.fn.init(e, t)
                }, me = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, ge = /^-ms-/, ve = /-([a-z])/g, ye = function (e, t) {
                    return t.toUpperCase()
                };
                he.fn = he.prototype = {
                    jquery: "3.2.1", constructor: he, length: 0, toArray: function () {
                        return ie.call(this)
                    }, get: function (e) {
                        return null == e ? ie.call(this) : e < 0 ? this[e + this.length] : this[e]
                    }, pushStack: function (e) {
                        var t = he.merge(this.constructor(), e);
                        return t.prevObject = this, t
                    }, each: function (e) {
                        return he.each(this, e)
                    }, map: function (e) {
                        return this.pushStack(he.map(this, function (t, n) {
                            return e.call(t, n, t)
                        }))
                    }, slice: function () {
                        return this.pushStack(ie.apply(this, arguments))
                    }, first: function () {
                        return this.eq(0)
                    }, last: function () {
                        return this.eq(-1)
                    }, eq: function (e) {
                        var t = this.length, n = +e + (e < 0 ? t : 0);
                        return this.pushStack(n >= 0 && n < t ? [this[n]] : [])
                    }, end: function () {
                        return this.prevObject || this.constructor()
                    }, push: oe, sort: te.sort, splice: te.splice
                }, he.extend = he.fn.extend = function () {
                    var e, t, n, r, i, a, o = arguments[0] || {}, s = 1, l = arguments.length, u = !1;
                    for ("boolean" == typeof o && (u = o, o = arguments[s] || {}, s++), "object" == typeof o || he.isFunction(o) || (o = {}), s === l && (o = this, s--); s < l; s++)if (null != (e = arguments[s]))for (t in e)n = o[t], r = e[t], o !== r && (u && r && (he.isPlainObject(r) || (i = Array.isArray(r))) ? (i ? (i = !1, a = n && Array.isArray(n) ? n : []): a= n && he.isPlainObject(n) ? n : {}, o[t] = he.extend(u, a, r)) : void 0 !== r && (o[t] = r));
                    return o
                }, he.extend({
                    expando: "jQuery" + ("3.2.1" + Math.random()).replace(/\D/g, ""),
                    isReady: !0,
                    error: function (e) {
                        throw new Error(e)
                    },
                    noop: function () {
                    },
                    isFunction: function (e) {
                        return "function" === he.type(e)
                    },
                    isWindow: function (e) {
                        return null != e && e === e.window
                    },
                    isNumeric: function (e) {
                        var t = he.type(e);
                        return ("number" === t || "string" === t) && !isNaN(e - parseFloat(e))
                    },
                    isPlainObject: function (e) {
                        var t, n;
                        return !(!e || "[object Object]" !== ue.call(e)) && (!(t = re(e)) || "function" == typeof(n = ce.call(t, "constructor") && t.constructor) && pe.call(n) === de)
                    },
                    isEmptyObject: function (e) {
                        var t;
                        for (t in e)return !1;
                        return !0
                    },
                    type: function (e) {
                        return null == e ? e + "" : "object" == typeof e || "function" == typeof e ? le[ue.call(e)] || "object" : typeof e
                    },
                    globalEval: function (e) {
                        n(e)
                    },
                    camelCase: function (e) {
                        return e.replace(ge, "ms-").replace(ve, ye)
                    },
                    each: function (e, t) {
                        var n, i = 0;
                        if (r(e))for (n = e.length; i < n && !1 !== t.call(e[i], i, e[i]); i++); else for (i in e)if (!1 === t.call(e[i], i, e[i]))break;
                        return e
                    },
                    trim: function (e) {
                        return null == e ? "" : (e + "").replace(me, "")
                    },
                    makeArray: function (e, t) {
                        var n = t || [];
                        return null != e && (r(Object(e)) ? he.merge(n, "string" == typeof e ? [e] : e) : oe.call(n, e)), n
                    },
                    inArray: function (e, t, n) {
                        return null == t ? -1 : se.call(t, e, n)
                    },
                    merge: function (e, t) {
                        for (var n = +t.length, r = 0, i = e.length; r < n; r++)e[i++] = t[r];
                        return e.length = i, e
                    },
                    grep: function (e, t, n) {
                        for (var r = [], i = 0, a = e.length, o = !n; i < a; i++)!t(e[i], i) !== o && r.push(e[i]);
                        return r
                    },
                    map: function (e, t, n) {
                        var i, a, o = 0, s = [];
                        if (r(e))for (i = e.length; o < i; o++)null != (a = t(e[o], o, n)) && s.push(a); else for (o in e)null != (a = t(e[o], o, n)) && s.push(a);
                        return ae.apply([], s)
                    },
                    guid: 1,
                    proxy: function (e, t) {
                        var n, r, i;
                        if ("string" == typeof t && (n = e[t], t = e, e = n), he.isFunction(e))return r = ie.call(arguments, 2), i = function () {
                            return e.apply(t || this, r.concat(ie.call(arguments)))
                        }, i.guid = e.guid = e.guid || he.guid++, i
                    },
                    now: Date.now,
                    support: fe
                }), "function" == typeof Symbol && (he.fn[Symbol.iterator] = te[Symbol.iterator]), he.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "), function (e, t) {
                    le["[object " + t + "]"] = t.toLowerCase()
                });
                var xe = function (e) {
                    function t(e, t, n, r) {
                        var i, a, o, s, l, c, d, f = t && t.ownerDocument, h = t ? t.nodeType : 9;
                        if (n = n || [], "string" != typeof e || !e || 1 !== h && 9 !== h && 11 !== h)return n;
                        if (!r && ((t ? t.ownerDocument || t : B) !== L && A(t), t = t || L, z)) {
                            if (11 !== h && (l = me.exec(e)))if (i = l[1]) {
                                if (9 === h) {
                                    if (!(o = t.getElementById(i)))return n;
                                    if (o.id === i)return n.push(o), n
                                } else if (f && (o = f.getElementById(i)) && q(t, o) && o.id === i)return n.push(o), n
                            } else {
                                if (l[2])return K.apply(n, t.getElementsByTagName(e)), n;
                                if ((i = l[3]) && w.getElementsByClassName && t.getElementsByClassName)return K.apply(n, t.getElementsByClassName(i)), n
                            }
                            if (w.qsa && !Y[e + " "] && (!I || !I.test(e))) {
                                if (1 !== h) f = t, d = e; else if ("object" !== t.nodeName.toLowerCase()) {
                                    for ((s = t.getAttribute("id")) ? s = s.replace(xe, we) : t.setAttribute("id", s = O), c = S(e), a = c.length; a--;)c[a] = "#" + s + " " + p(c[a]);
                                    d = c.join(","), f = ge.test(e) && u(t.parentNode) || t
                                }
                                if (d)try {
                                    return K.apply(n, f.querySelectorAll(d)), n
                                } catch (e) {
                                } finally {
                                    s === O && t.removeAttribute("id")
                                }
                            }
                        }
                        return k(e.replace(ae, "$1"), t, n, r)
                    }

                    function n() {
                        function e(n, r) {
                            return t.push(n + " ") > b.cacheLength && delete e[t.shift()], e[n + " "] = r
                        }

                        var t = [];
                        return e
                    }

                    function r(e) {
                        return e[O] = !0, e
                    }

                    function i(e) {
                        var t = L.createElement("fieldset");
                        try {
                            return !!e(t)
                        } catch (e) {
                            return !1
                        } finally {
                            t.parentNode && t.parentNode.removeChild(t), t = null
                        }
                    }

                    function a(e, t) {
                        for (var n = e.split("|"), r = n.length; r--;)b.attrHandle[n[r]] = t
                    }

                    function o(e, t) {
                        var n = t && e, r = n && 1 === e.nodeType && 1 === t.nodeType && e.sourceIndex - t.sourceIndex;
                        if (r)return r;
                        if (n)for (; n = n.nextSibling;)if (n === t)return -1;
                        return e ? 1 : -1
                    }

                    function s(e) {
                        return function (t) {
                            return "form" in t ? t.parentNode && !1 === t.disabled ? "label" in t ? "label" in t.parentNode ? t.parentNode.disabled === e : t.disabled === e : t.isDisabled === e || t.isDisabled !== !e && Te(t) === e : t.disabled === e : "label" in t && t.disabled === e
                        }
                    }

                    function l(e) {
                        return r(function (t) {
                            return t = +t, r(function (n, r) {
                                for (var i, a = e([], n.length, t), o = a.length; o--;)n[i = a[o]] && (n[i] = !(r[i] = n[i]))
                            })
                        })
                    }

                    function u(e) {
                        return e && void 0 !== e.getElementsByTagName && e
                    }

                    function c() {
                    }

                    function p(e) {
                        for (var t = 0, n = e.length, r = ""; t < n; t++)r += e[t].value;
                        return r
                    }

                    function d(e, t, n) {
                        var r = t.dir, i = t.next, a = i || r, o = n && "parentNode" === a, s = F++;
                        return t.first ? function (t, n, i) {
                                for (; t = t[r];)if (1 === t.nodeType || o)return e(t, n, i);
                                return !1
                            } : function (t, n, l) {
                                var u, c, p, d = [R, s];
                                if (l) {
                                    for (; t = t[r];)if ((1 === t.nodeType || o) && e(t, n, l))return !0
                                } else for (; t = t[r];)if (1 === t.nodeType || o)if (p = t[O] || (t[O] = {}), c = p[t.uniqueID] || (p[t.uniqueID] = {}), i && i === t.nodeName.toLowerCase()) t = t[r] || t; else {
                                    if ((u = c[a]) && u[0] === R && u[1] === s)return d[2] = u[2];
                                    if (c[a] = d, d[2] = e(t, n, l))return !0
                                }
                                return !1
                            }
                    }

                    function f(e) {
                        return e.length > 1 ? function (t, n, r) {
                                for (var i = e.length; i--;)if (!e[i](t, n, r))return !1;
                                return !0
                            } : e[0]
                    }

                    function h(e, n, r) {
                        for (var i = 0, a = n.length; i < a; i++)t(e, n[i], r);
                        return r
                    }

                    function m(e, t, n, r, i) {
                        for (var a, o = [], s = 0, l = e.length, u = null != t; s < l; s++)(a = e[s]) && (n && !n(a, r, i) || (o.push(a), u && t.push(s)));
                        return o
                    }

                    function g(e, t, n, i, a, o) {
                        return i && !i[O] && (i = g(i)), a && !a[O] && (a = g(a, o)), r(function (r, o, s, l) {
                            var u, c, p, d = [], f = [], g = o.length, v = r || h(t || "*", s.nodeType ? [s] : s, []), y = !e || !r && t ? v : m(v, d, e, s, l), x = n ? a || (r ? e : g || i) ? [] : o : y;
                            if (n && n(y, x, s, l), i)for (u = m(x, f), i(u, [], s, l), c = u.length; c--;)(p = u[c]) && (x[f[c]] = !(y[f[c]] = p));
                            if (r) {
                                if (a || e) {
                                    if (a) {
                                        for (u = [], c = x.length; c--;)(p = x[c]) && u.push(y[c] = p);
                                        a(null, x = [], u, l)
                                    }
                                    for (c = x.length; c--;)(p = x[c]) && (u = a ? J(r, p) : d[c]) > -1 && (r[u] = !(o[u] = p))
                                }
                            } else x = m(x === o ? x.splice(g, x.length) : x), a ? a(null, o, x, l) : K.apply(o, x)
                        })
                    }

                    function v(e) {
                        for (var t, n, r, i = e.length, a = b.relative[e[0].type], o = a || b.relative[" "], s = a ? 1 : 0, l = d(function (e) {
                            return e === t
                        }, o, !0), u = d(function (e) {
                            return J(t, e) > -1
                        }, o, !0), c = [function (e, n, r) {
                            var i = !a && (r || n !== D) || ((t = n).nodeType ? l(e, n, r) : u(e, n, r));
                            return t = null, i
                        }]; s < i; s++)if (n = b.relative[e[s].type]) c = [d(f(c), n)]; else {
                            if (n = b.filter[e[s].type].apply(null, e[s].matches), n[O]) {
                                for (r = ++s; r < i && !b.relative[e[r].type]; r++);
                                return g(s > 1 && f(c), s > 1 && p(e.slice(0, s - 1).concat({value: " " === e[s - 2].type ? "*" : ""})).replace(ae, "$1"), n, s < r && v(e.slice(s, r)), r < i && v(e = e.slice(r)), r < i && p(e))
                            }
                            c.push(n)
                        }
                        return f(c)
                    }

                    function y(e, n) {
                        var i = n.length > 0, a = e.length > 0, o = function (r, o, s, l, u) {
                            var c, p, d, f = 0, h = "0", g = r && [], v = [], y = D, x = r || a && b.find.TAG("*", u), w = R += null == y ? 1 : Math.random() || .1, T = x.length;
                            for (u && (D = o === L || o || u); h !== T && null != (c = x[h]); h++) {
                                if (a && c) {
                                    for (p = 0, o || c.ownerDocument === L || (A(c), s = !z); d = e[p++];)if (d(c, o || L, s)) {
                                        l.push(c);
                                        break
                                    }
                                    u && (R = w)
                                }
                                i && ((c = !d && c) && f--, r && g.push(c))
                            }
                            if (f += h, i && h !== f) {
                                for (p = 0; d = n[p++];)d(g, v, o, s);
                                if (r) {
                                    if (f > 0)for (; h--;)g[h] || v[h] || (v[h] = V.call(l));
                                    v = m(v)
                                }
                                K.apply(l, v), u && !r && v.length > 0 && f + n.length > 1 && t.uniqueSort(l)
                            }
                            return u && (R = w, D = y), g
                        };
                        return i ? r(o) : o
                    }

                    var x, w, b, T, C, S, E, k, D, M, N, A, L, P, z, I, j, H, q, O = "sizzle" + 1 * new Date, B = e.document, R = 0, F = 0, W = n(), X = n(), Y = n(), G = function (e, t) {
                        return e === t && (N = !0), 0
                    }, $ = {}.hasOwnProperty, _ = [], V = _.pop, U = _.push, K = _.push, Q = _.slice, J = function (e, t) {
                        for (var n = 0, r = e.length; n < r; n++)if (e[n] === t)return n;
                        return -1
                    }, Z = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped", ee = "[\\x20\\t\\r\\n\\f]", te = "(?:\\\\.|[\\w-]|[^\0-\\xa0])+", ne = "\\[" + ee + "*(" + te + ")(?:" + ee + "*([*^$|!~]?=)" + ee + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + te + "))|)" + ee + "*\\]", re = ":(" + te + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + ne + ")*)|.*)\\)|)", ie = new RegExp(ee + "+", "g"), ae = new RegExp("^" + ee + "+|((?:^|[^\\\\])(?:\\\\.)*)" + ee + "+$", "g"), oe = new RegExp("^" + ee + "*," + ee + "*"), se = new RegExp("^" + ee + "*([>+~]|" + ee + ")" + ee + "*"), le = new RegExp("=" + ee + "*([^\\]'\"]*?)" + ee + "*\\]", "g"), ue = new RegExp(re), ce = new RegExp("^" + te + "$"), pe = {
                        ID: new RegExp("^#(" + te + ")"),
                        CLASS: new RegExp("^\\.(" + te + ")"),
                        TAG: new RegExp("^(" + te + "|[*])"),
                        ATTR: new RegExp("^" + ne),
                        PSEUDO: new RegExp("^" + re),
                        CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + ee + "*(even|odd|(([+-]|)(\\d*)n|)" + ee + "*(?:([+-]|)" + ee + "*(\\d+)|))" + ee + "*\\)|)", "i"),
                        bool: new RegExp("^(?:" + Z + ")$", "i"),
                        needsContext: new RegExp("^" + ee + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + ee + "*((?:-\\d)?\\d*)" + ee + "*\\)|)(?=[^-]|$)", "i")
                    }, de = /^(?:input|select|textarea|button)$/i, fe = /^h\d$/i, he = /^[^{]+\{\s*\[native \w/, me = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/, ge = /[+~]/, ve = new RegExp("\\\\([\\da-f]{1,6}" + ee + "?|(" + ee + ")|.)", "ig"), ye = function (e, t, n) {
                        var r = "0x" + t - 65536;
                        return r !== r || n ? t : r < 0 ? String.fromCharCode(r + 65536) : String.fromCharCode(r >> 10 | 55296, 1023 & r | 56320)
                    }, xe = /([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g, we = function (e, t) {
                        return t ? "\0" === e ? "�" : e.slice(0, -1) + "\\" + e.charCodeAt(e.length - 1).toString(16) + " " : "\\" + e
                    }, be = function () {
                        A()
                    }, Te = d(function (e) {
                        return !0 === e.disabled && ("form" in e || "label" in e)
                    }, {dir: "parentNode", next: "legend"});
                    try {
                        K.apply(_ = Q.call(B.childNodes), B.childNodes), _[B.childNodes.length].nodeType
                    } catch (e) {
                        K = {
                            apply: _.length ? function (e, t) {
                                    U.apply(e, Q.call(t))
                                } : function (e, t) {
                                    for (var n = e.length, r = 0; e[n++] = t[r++];);
                                    e.length = n - 1
                                }
                        }
                    }
                    w = t.support = {}, C = t.isXML = function (e) {
                        var t = e && (e.ownerDocument || e).documentElement;
                        return !!t && "HTML" !== t.nodeName
                    }, A = t.setDocument = function (e) {
                        var t, n, r = e ? e.ownerDocument || e : B;
                        return r !== L && 9 === r.nodeType && r.documentElement ? (L = r, P = L.documentElement, z = !C(L), B !== L && (n = L.defaultView) && n.top !== n && (n.addEventListener ? n.addEventListener("unload", be, !1) : n.attachEvent && n.attachEvent("onunload", be)), w.attributes = i(function (e) {
                                return e.className = "i", !e.getAttribute("className")
                            }), w.getElementsByTagName = i(function (e) {
                                return e.appendChild(L.createComment("")), !e.getElementsByTagName("*").length
                            }), w.getElementsByClassName = he.test(L.getElementsByClassName), w.getById = i(function (e) {
                                return P.appendChild(e).id = O, !L.getElementsByName || !L.getElementsByName(O).length
                            }), w.getById ? (b.filter.ID = function (e) {
                                    var t = e.replace(ve, ye);
                                    return function (e) {
                                        return e.getAttribute("id") === t
                                    }
                                }, b.find.ID = function (e, t) {
                                    if (void 0 !== t.getElementById && z) {
                                        var n = t.getElementById(e);
                                        return n ? [n] : []
                                    }
                                }) : (b.filter.ID = function (e) {
                                    var t = e.replace(ve, ye);
                                    return function (e) {
                                        var n = void 0 !== e.getAttributeNode && e.getAttributeNode("id");
                                        return n && n.value === t
                                    }
                                }, b.find.ID = function (e, t) {
                                    if (void 0 !== t.getElementById && z) {
                                        var n, r, i, a = t.getElementById(e);
                                        if (a) {
                                            if ((n = a.getAttributeNode("id")) && n.value === e)return [a];
                                            for (i = t.getElementsByName(e), r = 0; a = i[r++];)if ((n = a.getAttributeNode("id")) && n.value === e)return [a]
                                        }
                                        return []
                                    }
                                }), b.find.TAG = w.getElementsByTagName ? function (e, t) {
                                    return void 0 !== t.getElementsByTagName ? t.getElementsByTagName(e) : w.qsa ? t.querySelectorAll(e) : void 0
                                } : function (e, t) {
                                    var n, r = [], i = 0, a = t.getElementsByTagName(e);
                                    if ("*" === e) {
                                        for (; n = a[i++];)1 === n.nodeType && r.push(n);
                                        return r
                                    }
                                    return a
                                }, b.find.CLASS = w.getElementsByClassName && function (e, t) {
                                    if (void 0 !== t.getElementsByClassName && z)return t.getElementsByClassName(e)
                                }, j = [], I = [], (w.qsa = he.test(L.querySelectorAll)) && (i(function (e) {
                                P.appendChild(e).innerHTML = "<a id='" + O + "'></a><select id='" + O + "-\r\\' msallowcapture=''><option selected=''></option></select>", e.querySelectorAll("[msallowcapture^='']").length && I.push("[*^$]=" + ee + "*(?:''|\"\")"), e.querySelectorAll("[selected]").length || I.push("\\[" + ee + "*(?:value|" + Z + ")"), e.querySelectorAll("[id~=" + O + "-]").length || I.push("~="), e.querySelectorAll(":checked").length || I.push(":checked"), e.querySelectorAll("a#" + O + "+*").length || I.push(".#.+[+~]")
                            }), i(function (e) {
                                e.innerHTML = "<a href='' disabled='disabled'></a><select disabled='disabled'><option/></select>";
                                var t = L.createElement("input");
                                t.setAttribute("type", "hidden"), e.appendChild(t).setAttribute("name", "D"), e.querySelectorAll("[name=d]").length && I.push("name" + ee + "*[*^$|!~]?="), 2 !== e.querySelectorAll(":enabled").length && I.push(":enabled", ":disabled"), P.appendChild(e).disabled = !0, 2 !== e.querySelectorAll(":disabled").length && I.push(":enabled", ":disabled"), e.querySelectorAll("*,:x"), I.push(",.*:")
                            })), (w.matchesSelector = he.test(H = P.matches || P.webkitMatchesSelector || P.mozMatchesSelector || P.oMatchesSelector || P.msMatchesSelector)) && i(function (e) {
                                w.disconnectedMatch = H.call(e, "*"), H.call(e, "[s!='']:x"), j.push("!=", re)
                            }), I = I.length && new RegExp(I.join("|")), j = j.length && new RegExp(j.join("|")), t = he.test(P.compareDocumentPosition), q = t || he.test(P.contains) ? function (e, t) {
                                    var n = 9 === e.nodeType ? e.documentElement : e, r = t && t.parentNode;
                                    return e === r || !(!r || 1 !== r.nodeType || !(n.contains ? n.contains(r) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(r)))
                                } : function (e, t) {
                                    if (t)for (; t = t.parentNode;)if (t === e)return !0;
                                    return !1
                                }, G = t ? function (e, t) {
                                    if (e === t)return N = !0, 0;
                                    var n = !e.compareDocumentPosition - !t.compareDocumentPosition;
                                    return n || (n = (e.ownerDocument || e) === (t.ownerDocument || t) ? e.compareDocumentPosition(t) : 1, 1 & n || !w.sortDetached && t.compareDocumentPosition(e) === n ? e === L || e.ownerDocument === B && q(B, e) ? -1 : t === L || t.ownerDocument === B && q(B, t) ? 1 : M ? J(M, e) - J(M, t) : 0 : 4 & n ? -1 : 1)
                                } : function (e, t) {
                                    if (e === t)return N = !0, 0;
                                    var n, r = 0, i = e.parentNode, a = t.parentNode, s = [e], l = [t];
                                    if (!i || !a)return e === L ? -1 : t === L ? 1 : i ? -1 : a ? 1 : M ? J(M, e) - J(M, t) : 0;
                                    if (i === a)return o(e, t);
                                    for (n = e; n = n.parentNode;)s.unshift(n);
                                    for (n = t; n = n.parentNode;)l.unshift(n);
                                    for (; s[r] === l[r];)r++;
                                    return r ? o(s[r], l[r]) : s[r] === B ? -1 : l[r] === B ? 1 : 0
                                }, L) : L
                    }, t.matches = function (e, n) {
                        return t(e, null, null, n)
                    }, t.matchesSelector = function (e, n) {
                        if ((e.ownerDocument || e) !== L && A(e), n = n.replace(le, "='$1']"), w.matchesSelector && z && !Y[n + " "] && (!j || !j.test(n)) && (!I || !I.test(n)))try {
                            var r = H.call(e, n);
                            if (r || w.disconnectedMatch || e.document && 11 !== e.document.nodeType)return r
                        } catch (e) {
                        }
                        return t(n, L, null, [e]).length > 0
                    }, t.contains = function (e, t) {
                        return (e.ownerDocument || e) !== L && A(e), q(e, t)
                    }, t.attr = function (e, t) {
                        (e.ownerDocument || e) !== L && A(e);
                        var n = b.attrHandle[t.toLowerCase()], r = n && $.call(b.attrHandle, t.toLowerCase()) ? n(e, t, !z) : void 0;
                        return void 0 !== r ? r : w.attributes || !z ? e.getAttribute(t) : (r = e.getAttributeNode(t)) && r.specified ? r.value : null
                    }, t.escape = function (e) {
                        return (e + "").replace(xe, we)
                    }, t.error = function (e) {
                        throw new Error("Syntax error, unrecognized expression: " + e)
                    }, t.uniqueSort = function (e) {
                        var t, n = [], r = 0, i = 0;
                        if (N = !w.detectDuplicates, M = !w.sortStable && e.slice(0), e.sort(G), N) {
                            for (; t = e[i++];)t === e[i] && (r = n.push(i));
                            for (; r--;)e.splice(n[r], 1)
                        }
                        return M = null, e
                    }, T = t.getText = function (e) {
                        var t, n = "", r = 0, i = e.nodeType;
                        if (i) {
                            if (1 === i || 9 === i || 11 === i) {
                                if ("string" == typeof e.textContent)return e.textContent;
                                for (e = e.firstChild; e; e = e.nextSibling)n += T(e)
                            } else if (3 === i || 4 === i)return e.nodeValue
                        } else for (; t = e[r++];)n += T(t);
                        return n
                    }, b = t.selectors = {
                        cacheLength: 50,
                        createPseudo: r,
                        match: pe,
                        attrHandle: {},
                        find: {},
                        relative: {
                            ">": {dir: "parentNode", first: !0},
                            " ": {dir: "parentNode"},
                            "+": {dir: "previousSibling", first: !0},
                            "~": {dir: "previousSibling"}
                        },
                        preFilter: {
                            ATTR: function (e) {
                                return e[1] = e[1].replace(ve, ye), e[3] = (e[3] || e[4] || e[5] || "").replace(ve, ye), "~=" === e[2] && (e[3] = " " + e[3] + " "), e.slice(0, 4)
                            }, CHILD: function (e) {
                                return e[1] = e[1].toLowerCase(), "nth" === e[1].slice(0, 3) ? (e[3] || t.error(e[0]), e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])), e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && t.error(e[0]), e
                            }, PSEUDO: function (e) {
                                var t, n = !e[6] && e[2];
                                return pe.CHILD.test(e[0]) ? null : (e[3] ? e[2] = e[4] || e[5] || "" : n && ue.test(n) && (t = S(n, !0)) && (t = n.indexOf(")", n.length - t) - n.length) && (e[0] = e[0].slice(0, t), e[2] = n.slice(0, t)), e.slice(0, 3))
                            }
                        },
                        filter: {
                            TAG: function (e) {
                                var t = e.replace(ve, ye).toLowerCase();
                                return "*" === e ? function () {
                                        return !0
                                    } : function (e) {
                                        return e.nodeName && e.nodeName.toLowerCase() === t
                                    }
                            }, CLASS: function (e) {
                                var t = W[e + " "];
                                return t || (t = new RegExp("(^|" + ee + ")" + e + "(" + ee + "|$)")) && W(e, function (e) {
                                        return t.test("string" == typeof e.className && e.className || void 0 !== e.getAttribute && e.getAttribute("class") || "")
                                    })
                            }, ATTR: function (e, n, r) {
                                return function (i) {
                                    var a = t.attr(i, e);
                                    return null == a ? "!=" === n : !n || (a += "", "=" === n ? a === r : "!=" === n ? a !== r : "^=" === n ? r && 0 === a.indexOf(r) : "*=" === n ? r && a.indexOf(r) > -1 : "$=" === n ? r && a.slice(-r.length) === r : "~=" === n ? (" " + a.replace(ie, " ") + " ").indexOf(r) > -1 : "|=" === n && (a === r || a.slice(0, r.length + 1) === r + "-"))
                                }
                            }, CHILD: function (e, t, n, r, i) {
                                var a = "nth" !== e.slice(0, 3), o = "last" !== e.slice(-4), s = "of-type" === t;
                                return 1 === r && 0 === i ? function (e) {
                                        return !!e.parentNode
                                    } : function (t, n, l) {
                                        var u, c, p, d, f, h, m = a !== o ? "nextSibling" : "previousSibling", g = t.parentNode, v = s && t.nodeName.toLowerCase(), y = !l && !s, x = !1;
                                        if (g) {
                                            if (a) {
                                                for (; m;) {
                                                    for (d = t; d = d[m];)if (s ? d.nodeName.toLowerCase() === v : 1 === d.nodeType)return !1;
                                                    h = m = "only" === e && !h && "nextSibling"
                                                }
                                                return !0
                                            }
                                            if (h = [o ? g.firstChild : g.lastChild], o && y) {
                                                for (d = g, p = d[O] || (d[O] = {}), c = p[d.uniqueID] || (p[d.uniqueID] = {}), u = c[e] || [], f = u[0] === R && u[1], x = f && u[2], d = f && g.childNodes[f]; d = ++f && d && d[m] || (x = f = 0) || h.pop();)if (1 === d.nodeType && ++x && d === t) {
                                                    c[e] = [R, f, x];
                                                    break
                                                }
                                            } else if (y && (d = t, p = d[O] || (d[O] = {}), c = p[d.uniqueID] || (p[d.uniqueID] = {}), u = c[e] || [], f = u[0] === R && u[1], x = f), !1 === x)for (; (d = ++f && d && d[m] || (x = f = 0) || h.pop()) && ((s ? d.nodeName.toLowerCase() !== v : 1 !== d.nodeType) || !++x || (y && (p = d[O] || (d[O] = {}), c = p[d.uniqueID] || (p[d.uniqueID] = {}), c[e] = [R, x]), d !== t)););
                                            return (x -= i) === r || x % r == 0 && x / r >= 0
                                        }
                                    }
                            }, PSEUDO: function (e, n) {
                                var i, a = b.pseudos[e] || b.setFilters[e.toLowerCase()] || t.error("unsupported pseudo: " + e);
                                return a[O] ? a(n) : a.length > 1 ? (i = [e, e, "", n], b.setFilters.hasOwnProperty(e.toLowerCase()) ? r(function (e, t) {
                                                for (var r, i = a(e, n), o = i.length; o--;)r = J(e, i[o]), e[r] = !(t[r] = i[o])
                                            }) : function (e) {
                                                return a(e, 0, i)
                                            }) : a
                            }
                        },
                        pseudos: {
                            not: r(function (e) {
                                var t = [], n = [], i = E(e.replace(ae, "$1"));
                                return i[O] ? r(function (e, t, n, r) {
                                        for (var a, o = i(e, null, r, []), s = e.length; s--;)(a = o[s]) && (e[s] = !(t[s] = a))
                                    }) : function (e, r, a) {
                                        return t[0] = e, i(t, null, a, n), t[0] = null, !n.pop()
                                    }
                            }), has: r(function (e) {
                                return function (n) {
                                    return t(e, n).length > 0
                                }
                            }), contains: r(function (e) {
                                return e = e.replace(ve, ye), function (t) {
                                    return (t.textContent || t.innerText || T(t)).indexOf(e) > -1
                                }
                            }), lang: r(function (e) {
                                return ce.test(e || "") || t.error("unsupported lang: " + e), e = e.replace(ve, ye).toLowerCase(), function (t) {
                                    var n;
                                    do {
                                        if (n = z ? t.lang : t.getAttribute("xml:lang") || t.getAttribute("lang"))return (n = n.toLowerCase()) === e || 0 === n.indexOf(e + "-")
                                    } while ((t = t.parentNode) && 1 === t.nodeType);
                                    return !1
                                }
                            }), target: function (t) {
                                var n = e.location && e.location.hash;
                                return n && n.slice(1) === t.id
                            }, root: function (e) {
                                return e === P
                            }, focus: function (e) {
                                return e === L.activeElement && (!L.hasFocus || L.hasFocus()) && !!(e.type || e.href || ~e.tabIndex)
                            }, enabled: s(!1), disabled: s(!0), checked: function (e) {
                                var t = e.nodeName.toLowerCase();
                                return "input" === t && !!e.checked || "option" === t && !!e.selected
                            }, selected: function (e) {
                                return e.parentNode && e.parentNode.selectedIndex, !0 === e.selected
                            }, empty: function (e) {
                                for (e = e.firstChild; e; e = e.nextSibling)if (e.nodeType < 6)return !1;
                                return !0
                            }, parent: function (e) {
                                return !b.pseudos.empty(e)
                            }, header: function (e) {
                                return fe.test(e.nodeName)
                            }, input: function (e) {
                                return de.test(e.nodeName)
                            }, button: function (e) {
                                var t = e.nodeName.toLowerCase();
                                return "input" === t && "button" === e.type || "button" === t
                            }, text: function (e) {
                                var t;
                                return "input" === e.nodeName.toLowerCase() && "text" === e.type && (null == (t = e.getAttribute("type")) || "text" === t.toLowerCase())
                            }, first: l(function () {
                                return [0]
                            }), last: l(function (e, t) {
                                return [t - 1]
                            }), eq: l(function (e, t, n) {
                                return [n < 0 ? n + t : n]
                            }), even: l(function (e, t) {
                                for (var n = 0; n < t; n += 2)e.push(n);
                                return e
                            }), odd: l(function (e, t) {
                                for (var n = 1; n < t; n += 2)e.push(n);
                                return e
                            }), lt: l(function (e, t, n) {
                                for (var r = n < 0 ? n + t : n; --r >= 0;)e.push(r);
                                return e
                            }), gt: l(function (e, t, n) {
                                for (var r = n < 0 ? n + t : n; ++r < t;)e.push(r);
                                return e
                            })
                        }
                    }, b.pseudos.nth = b.pseudos.eq;
                    for (x in{radio: !0, checkbox: !0, file: !0, password: !0, image: !0})b.pseudos[x] = function (e) {
                        return function (t) {
                            return "input" === t.nodeName.toLowerCase() && t.type === e
                        }
                    }(x);
                    for (x in{
                        submit: !0,
                        reset: !0
                    })b.pseudos[x] = function (e) {
                        return function (t) {
                            var n = t.nodeName.toLowerCase();
                            return ("input" === n || "button" === n) && t.type === e
                        }
                    }(x);
                    return c.prototype = b.filters = b.pseudos, b.setFilters = new c, S = t.tokenize = function (e, n) {
                        var r, i, a, o, s, l, u, c = X[e + " "];
                        if (c)return n ? 0 : c.slice(0);
                        for (s = e, l = [], u = b.preFilter; s;) {
                            r && !(i = oe.exec(s)) || (i && (s = s.slice(i[0].length) || s), l.push(a = [])), r = !1, (i = se.exec(s)) && (r = i.shift(), a.push({
                                value: r,
                                type: i[0].replace(ae, " ")
                            }), s = s.slice(r.length));
                            for (o in b.filter)!(i = pe[o].exec(s)) || u[o] && !(i = u[o](i)) || (r = i.shift(), a.push({
                                value: r,
                                type: o,
                                matches: i
                            }), s = s.slice(r.length));
                            if (!r)break
                        }
                        return n ? s.length : s ? t.error(e) : X(e, l).slice(0)
                    }, E = t.compile = function (e, t) {
                        var n, r = [], i = [], a = Y[e + " "];
                        if (!a) {
                            for (t || (t = S(e)), n = t.length; n--;)a = v(t[n]), a[O] ? r.push(a) : i.push(a);
                            a = Y(e, y(i, r)), a.selector = e
                        }
                        return a
                    }, k = t.select = function (e, t, n, r) {
                        var i, a, o, s, l, c = "function" == typeof e && e, d = !r && S(e = c.selector || e);
                        if (n = n || [], 1 === d.length) {
                            if (a = d[0] = d[0].slice(0), a.length > 2 && "ID" === (o = a[0]).type && 9 === t.nodeType && z && b.relative[a[1].type]) {
                                if (!(t = (b.find.ID(o.matches[0].replace(ve, ye), t) || [])[0]))return n;
                                c && (t = t.parentNode), e = e.slice(a.shift().value.length)
                            }
                            for (i = pe.needsContext.test(e) ? 0 : a.length; i-- && (o = a[i], !b.relative[s = o.type]);)if ((l = b.find[s]) && (r = l(o.matches[0].replace(ve, ye), ge.test(a[0].type) && u(t.parentNode) || t))) {
                                if (a.splice(i, 1), !(e = r.length && p(a)))return K.apply(n, r), n;
                                break
                            }
                        }
                        return (c || E(e, d))(r, t, !z, n, !t || ge.test(e) && u(t.parentNode) || t), n
                    }, w.sortStable = O.split("").sort(G).join("") === O, w.detectDuplicates = !!N, A(), w.sortDetached = i(function (e) {
                        return 1 & e.compareDocumentPosition(L.createElement("fieldset"))
                    }), i(function (e) {
                        return e.innerHTML = "<a href='#'></a>", "#" === e.firstChild.getAttribute("href")
                    }) || a("type|href|height|width", function (e, t, n) {
                        if (!n)return e.getAttribute(t, "type" === t.toLowerCase() ? 1 : 2)
                    }), w.attributes && i(function (e) {
                        return e.innerHTML = "<input/>", e.firstChild.setAttribute("value", ""), "" === e.firstChild.getAttribute("value")
                    }) || a("value", function (e, t, n) {
                        if (!n && "input" === e.nodeName.toLowerCase())return e.defaultValue
                    }), i(function (e) {
                        return null == e.getAttribute("disabled")
                    }) || a(Z, function (e, t, n) {
                        var r;
                        if (!n)return !0 === e[t] ? t.toLowerCase() : (r = e.getAttributeNode(t)) && r.specified ? r.value : null
                    }), t
                }(e);
                he.find = xe, he.expr = xe.selectors, he.expr[":"] = he.expr.pseudos, he.uniqueSort = he.unique = xe.uniqueSort, he.text = xe.getText, he.isXMLDoc = xe.isXML, he.contains = xe.contains, he.escapeSelector = xe.escape;
                var we = function (e, t, n) {
                    for (var r = [], i = void 0 !== n; (e = e[t]) && 9 !== e.nodeType;)if (1 === e.nodeType) {
                        if (i && he(e).is(n))break;
                        r.push(e)
                    }
                    return r
                }, be = function (e, t) {
                    for (var n = []; e; e = e.nextSibling)1 === e.nodeType && e !== t && n.push(e);
                    return n
                }, Te = he.expr.match.needsContext, Ce = /^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i, Se = /^.[^:#\[\.,]*$/;
                he.filter = function (e, t, n) {
                    var r = t[0];
                    return n && (e = ":not(" + e + ")"), 1 === t.length && 1 === r.nodeType ? he.find.matchesSelector(r, e) ? [r] : [] : he.find.matches(e, he.grep(t, function (e) {
                            return 1 === e.nodeType
                        }))
                }, he.fn.extend({
                    find: function (e) {
                        var t, n, r = this.length, i = this;
                        if ("string" != typeof e)return this.pushStack(he(e).filter(function () {
                            for (t = 0; t < r; t++)if (he.contains(i[t], this))return !0
                        }));
                        for (n = this.pushStack([]), t = 0; t < r; t++)he.find(e, i[t], n);
                        return r > 1 ? he.uniqueSort(n) : n
                    }, filter: function (e) {
                        return this.pushStack(a(this, e || [], !1))
                    }, not: function (e) {
                        return this.pushStack(a(this, e || [], !0))
                    }, is: function (e) {
                        return !!a(this, "string" == typeof e && Te.test(e) ? he(e) : e || [], !1).length
                    }
                });
                var Ee, ke = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/;
                (he.fn.init = function (e, t, n) {
                    var r, i;
                    if (!e)return this;
                    if (n = n || Ee, "string" == typeof e) {
                        if (!(r = "<" === e[0] && ">" === e[e.length - 1] && e.length >= 3 ? [null, e, null] : ke.exec(e)) || !r[1] && t)return !t || t.jquery ? (t || n).find(e) : this.constructor(t).find(e);
                        if (r[1]) {
                            if (t = t instanceof he ? t[0] : t, he.merge(this, he.parseHTML(r[1], t && t.nodeType ? t.ownerDocument || t : ne, !0)), Ce.test(r[1]) && he.isPlainObject(t))for (r in t)he.isFunction(this[r]) ? this[r](t[r]) : this.attr(r, t[r]);
                            return this
                        }
                        return i = ne.getElementById(r[2]), i && (this[0] = i, this.length = 1), this
                    }
                    return e.nodeType ? (this[0] = e, this.length = 1, this) : he.isFunction(e) ? void 0 !== n.ready ? n.ready(e) : e(he) : he.makeArray(e, this)
                }).prototype = he.fn, Ee = he(ne);
                var De = /^(?:parents|prev(?:Until|All))/, Me = {children: !0, contents: !0, next: !0, prev: !0};
                he.fn.extend({
                    has: function (e) {
                        var t = he(e, this), n = t.length;
                        return this.filter(function () {
                            for (var e = 0; e < n; e++)if (he.contains(this, t[e]))return !0
                        })
                    }, closest: function (e, t) {
                        var n, r = 0, i = this.length, a = [], o = "string" != typeof e && he(e);
                        if (!Te.test(e))for (; r < i; r++)for (n = this[r]; n && n !== t; n = n.parentNode)if (n.nodeType < 11 && (o ? o.index(n) > -1 : 1 === n.nodeType && he.find.matchesSelector(n, e))) {
                            a.push(n);
                            break
                        }
                        return this.pushStack(a.length > 1 ? he.uniqueSort(a) : a)
                    }, index: function (e) {
                        return e ? "string" == typeof e ? se.call(he(e), this[0]) : se.call(this, e.jquery ? e[0] : e) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
                    }, add: function (e, t) {
                        return this.pushStack(he.uniqueSort(he.merge(this.get(), he(e, t))))
                    }, addBack: function (e) {
                        return this.add(null == e ? this.prevObject : this.prevObject.filter(e))
                    }
                }), he.each({
                    parent: function (e) {
                        var t = e.parentNode;
                        return t && 11 !== t.nodeType ? t : null
                    }, parents: function (e) {
                        return we(e, "parentNode")
                    }, parentsUntil: function (e, t, n) {
                        return we(e, "parentNode", n)
                    }, next: function (e) {
                        return o(e, "nextSibling")
                    }, prev: function (e) {
                        return o(e, "previousSibling")
                    }, nextAll: function (e) {
                        return we(e, "nextSibling")
                    }, prevAll: function (e) {
                        return we(e, "previousSibling")
                    }, nextUntil: function (e, t, n) {
                        return we(e, "nextSibling", n)
                    }, prevUntil: function (e, t, n) {
                        return we(e, "previousSibling", n)
                    }, siblings: function (e) {
                        return be((e.parentNode || {}).firstChild, e)
                    }, children: function (e) {
                        return be(e.firstChild)
                    }, contents: function (e) {
                        return i(e, "iframe") ? e.contentDocument : (i(e, "template") && (e = e.content || e), he.merge([], e.childNodes))
                    }
                }, function (e, t) {
                    he.fn[e] = function (n, r) {
                        var i = he.map(this, t, n);
                        return "Until" !== e.slice(-5) && (r = n), r && "string" == typeof r && (i = he.filter(r, i)), this.length > 1 && (Me[e] || he.uniqueSort(i), De.test(e) && i.reverse()), this.pushStack(i)
                    }
                });
                var Ne = /[^\x20\t\r\n\f]+/g;
                he.Callbacks = function (e) {
                    e = "string" == typeof e ? s(e) : he.extend({}, e);
                    var t, n, r, i, a = [], o = [], l = -1, u = function () {
                        for (i = i || e.once, r = t = !0; o.length; l = -1)for (n = o.shift(); ++l < a.length;)!1 === a[l].apply(n[0], n[1]) && e.stopOnFalse && (l = a.length, n = !1);
                        e.memory || (n = !1), t = !1, i && (a = n ? [] : "")
                    }, c = {
                        add: function () {
                            return a && (n && !t && (l = a.length - 1, o.push(n)), function t(n) {
                                he.each(n, function (n, r) {
                                    he.isFunction(r) ? e.unique && c.has(r) || a.push(r) : r && r.length && "string" !== he.type(r) && t(r)
                                })
                            }(arguments), n && !t && u()), this
                        }, remove: function () {
                            return he.each(arguments, function (e, t) {
                                for (var n; (n = he.inArray(t, a, n)) > -1;)a.splice(n, 1), n <= l && l--
                            }), this
                        }, has: function (e) {
                            return e ? he.inArray(e, a) > -1 : a.length > 0
                        }, empty: function () {
                            return a && (a = []), this
                        }, disable: function () {
                            return i = o = [], a = n = "", this
                        }, disabled: function () {
                            return !a
                        }, lock: function () {
                            return i = o = [], n || t || (a = n = ""), this
                        }, locked: function () {
                            return !!i
                        }, fireWith: function (e, n) {
                            return i || (n = n || [], n = [e, n.slice ? n.slice() : n], o.push(n), t || u()), this
                        }, fire: function () {
                            return c.fireWith(this, arguments), this
                        }, fired: function () {
                            return !!r
                        }
                    };
                    return c
                }, he.extend({
                    Deferred: function (t) {
                        var n = [["notify", "progress", he.Callbacks("memory"), he.Callbacks("memory"), 2], ["resolve", "done", he.Callbacks("once memory"), he.Callbacks("once memory"), 0, "resolved"], ["reject", "fail", he.Callbacks("once memory"), he.Callbacks("once memory"), 1, "rejected"]], r = "pending", i = {
                            state: function () {
                                return r
                            }, always: function () {
                                return a.done(arguments).fail(arguments), this
                            }, catch: function (e) {
                                return i.then(null, e)
                            }, pipe: function () {
                                var e = arguments;
                                return he.Deferred(function (t) {
                                    he.each(n, function (n, r) {
                                        var i = he.isFunction(e[r[4]]) && e[r[4]];
                                        a[r[1]](function () {
                                            var e = i && i.apply(this, arguments);
                                            e && he.isFunction(e.promise) ? e.promise().progress(t.notify).done(t.resolve).fail(t.reject) : t[r[0] + "With"](this, i ? [e] : arguments)
                                        })
                                    }), e = null
                                }).promise()
                            }, then: function (t, r, i) {
                                function a(t, n, r, i) {
                                    return function () {
                                        var s = this, c = arguments, p = function () {
                                            var e, p;
                                            if (!(t < o)) {
                                                if ((e = r.apply(s, c)) === n.promise())throw new TypeError("Thenable self-resolution");
                                                p = e && ("object" == typeof e || "function" == typeof e) && e.then, he.isFunction(p) ? i ? p.call(e, a(o, n, l, i), a(o, n, u, i)) : (o++, p.call(e, a(o, n, l, i), a(o, n, u, i), a(o, n, l, n.notifyWith))) : (r !== l && (s = void 0, c = [e]), (i || n.resolveWith)(s, c))
                                            }
                                        }, d = i ? p : function () {
                                                try {
                                                    p()
                                                } catch (e) {
                                                    he.Deferred.exceptionHook && he.Deferred.exceptionHook(e, d.stackTrace), t + 1 >= o && (r !== u && (s = void 0, c = [e]), n.rejectWith(s, c))
                                                }
                                            };
                                        t ? d() : (he.Deferred.getStackHook && (d.stackTrace = he.Deferred.getStackHook()), e.setTimeout(d))
                                    }
                                }

                                var o = 0;
                                return he.Deferred(function (e) {
                                    n[0][3].add(a(0, e, he.isFunction(i) ? i : l, e.notifyWith)), n[1][3].add(a(0, e, he.isFunction(t) ? t : l)), n[2][3].add(a(0, e, he.isFunction(r) ? r : u))
                                }).promise()
                            }, promise: function (e) {
                                return null != e ? he.extend(e, i) : i
                            }
                        }, a = {};
                        return he.each(n, function (e, t) {
                            var o = t[2], s = t[5];
                            i[t[1]] = o.add, s && o.add(function () {
                                r = s
                            }, n[3 - e][2].disable, n[0][2].lock), o.add(t[3].fire), a[t[0]] = function () {
                                return a[t[0] + "With"](this === a ? void 0 : this, arguments), this
                            }, a[t[0] + "With"] = o.fireWith
                        }), i.promise(a), t && t.call(a, a), a
                    }, when: function (e) {
                        var t = arguments.length, n = t, r = Array(n), i = ie.call(arguments), a = he.Deferred(), o = function (e) {
                            return function (n) {
                                r[e] = this, i[e] = arguments.length > 1 ? ie.call(arguments) : n, --t || a.resolveWith(r, i)
                            }
                        };
                        if (t <= 1 && (c(e, a.done(o(n)).resolve, a.reject, !t), "pending" === a.state() || he.isFunction(i[n] && i[n].then)))return a.then();
                        for (; n--;)c(i[n], o(n), a.reject);
                        return a.promise()
                    }
                });
                var Ae = /^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;
                he.Deferred.exceptionHook = function (t, n) {
                    e.console && e.console.warn && t && Ae.test(t.name) && e.console.warn("jQuery.Deferred exception: " + t.message, t.stack, n)
                }, he.readyException = function (t) {
                    e.setTimeout(function () {
                        throw t
                    })
                };
                var Le = he.Deferred();
                he.fn.ready = function (e) {
                    return Le.then(e).catch(function (e) {
                        he.readyException(e)
                    }), this
                }, he.extend({
                    isReady: !1, readyWait: 1, ready: function (e) {
                        (!0 === e ? --he.readyWait : he.isReady) || (he.isReady = !0, !0 !== e && --he.readyWait > 0 || Le.resolveWith(ne, [he]))
                    }
                }), he.ready.then = Le.then, "complete" === ne.readyState || "loading" !== ne.readyState && !ne.documentElement.doScroll ? e.setTimeout(he.ready) : (ne.addEventListener("DOMContentLoaded", p), e.addEventListener("load", p));
                var Pe = function (e, t, n, r, i, a, o) {
                    var s = 0, l = e.length, u = null == n;
                    if ("object" === he.type(n)) {
                        i = !0;
                        for (s in n)Pe(e, t, s, n[s], !0, a, o)
                    } else if (void 0 !== r && (i = !0, he.isFunction(r) || (o = !0), u && (o ? (t.call(e, r), t = null) : (u = t, t = function (e, t, n) {
                                return u.call(he(e), n)
                            })), t))for (; s < l; s++)t(e[s], n, o ? r : r.call(e[s], s, t(e[s], n)));
                    return i ? e : u ? t.call(e) : l ? t(e[0], n) : a
                }, ze = function (e) {
                    return 1 === e.nodeType || 9 === e.nodeType || !+e.nodeType
                };
                d.uid = 1, d.prototype = {
                    cache: function (e) {
                        var t = e[this.expando];
                        return t || (t = {}, ze(e) && (e.nodeType ? e[this.expando] = t : Object.defineProperty(e, this.expando, {
                                value: t,
                                configurable: !0
                            }))), t
                    }, set: function (e, t, n) {
                        var r, i = this.cache(e);
                        if ("string" == typeof t) i[he.camelCase(t)] = n; else for (r in t)i[he.camelCase(r)] = t[r];
                        return i
                    }, get: function (e, t) {
                        return void 0 === t ? this.cache(e) : e[this.expando] && e[this.expando][he.camelCase(t)]
                    }, access: function (e, t, n) {
                        return void 0 === t || t && "string" == typeof t && void 0 === n ? this.get(e, t) : (this.set(e, t, n), void 0 !== n ? n : t)
                    }, remove: function (e, t) {
                        var n, r = e[this.expando];
                        if (void 0 !== r) {
                            if (void 0 !== t) {
                                Array.isArray(t) ? t = t.map(he.camelCase) : (t = he.camelCase(t), t = t in r ? [t] : t.match(Ne) || []), n = t.length;
                                for (; n--;)delete r[t[n]]
                            }
                            (void 0 === t || he.isEmptyObject(r)) && (e.nodeType ? e[this.expando] = void 0 : delete e[this.expando])
                        }
                    }, hasData: function (e) {
                        var t = e[this.expando];
                        return void 0 !== t && !he.isEmptyObject(t)
                    }
                };
                var Ie = new d, je = new d, He = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/, qe = /[A-Z]/g;
                he.extend({
                    hasData: function (e) {
                        return je.hasData(e) || Ie.hasData(e)
                    }, data: function (e, t, n) {
                        return je.access(e, t, n)
                    }, removeData: function (e, t) {
                        je.remove(e, t)
                    }, _data: function (e, t, n) {
                        return Ie.access(e, t, n)
                    }, _removeData: function (e, t) {
                        Ie.remove(e, t)
                    }
                }), he.fn.extend({
                    data: function (e, t) {
                        var n, r, i, a = this[0], o = a && a.attributes;
                        if (void 0 === e) {
                            if (this.length && (i = je.get(a), 1 === a.nodeType && !Ie.get(a, "hasDataAttrs"))) {
                                for (n = o.length; n--;)o[n] && (r = o[n].name, 0 === r.indexOf("data-") && (r = he.camelCase(r.slice(5)), h(a, r, i[r])));
                                Ie.set(a, "hasDataAttrs", !0)
                            }
                            return i
                        }
                        return "object" == typeof e ? this.each(function () {
                                je.set(this, e)
                            }) : Pe(this, function (t) {
                                var n;
                                if (a && void 0 === t) {
                                    if (void 0 !== (n = je.get(a, e)))return n;
                                    if (void 0 !== (n = h(a, e)))return n
                                } else this.each(function () {
                                    je.set(this, e, t)
                                })
                            }, null, t, arguments.length > 1, null, !0)
                    }, removeData: function (e) {
                        return this.each(function () {
                            je.remove(this, e)
                        })
                    }
                }), he.extend({
                    queue: function (e, t, n) {
                        var r;
                        if (e)return t = (t || "fx") + "queue", r = Ie.get(e, t), n && (!r || Array.isArray(n) ? r = Ie.access(e, t, he.makeArray(n)) : r.push(n)), r || []
                    }, dequeue: function (e, t) {
                        t = t || "fx";
                        var n = he.queue(e, t), r = n.length, i = n.shift(), a = he._queueHooks(e, t), o = function () {
                            he.dequeue(e, t)
                        };
                        "inprogress" === i && (i = n.shift(), r--), i && ("fx" === t && n.unshift("inprogress"), delete a.stop, i.call(e, o, a)), !r && a && a.empty.fire()
                    }, _queueHooks: function (e, t) {
                        var n = t + "queueHooks";
                        return Ie.get(e, n) || Ie.access(e, n, {
                                empty: he.Callbacks("once memory").add(function () {
                                    Ie.remove(e, [t + "queue", n])
                                })
                            })
                    }
                }), he.fn.extend({
                    queue: function (e, t) {
                        var n = 2;
                        return "string" != typeof e && (t = e, e = "fx", n--), arguments.length < n ? he.queue(this[0], e) : void 0 === t ? this : this.each(function () {
                                    var n = he.queue(this, e, t);
                                    he._queueHooks(this, e), "fx" === e && "inprogress" !== n[0] && he.dequeue(this, e)
                                })
                    }, dequeue: function (e) {
                        return this.each(function () {
                            he.dequeue(this, e)
                        })
                    }, clearQueue: function (e) {
                        return this.queue(e || "fx", [])
                    }, promise: function (e, t) {
                        var n, r = 1, i = he.Deferred(), a = this, o = this.length, s = function () {
                            --r || i.resolveWith(a, [a])
                        };
                        for ("string" != typeof e && (t = e, e = void 0), e = e || "fx"; o--;)(n = Ie.get(a[o], e + "queueHooks")) && n.empty && (r++, n.empty.add(s));
                        return s(), i.promise(t)
                    }
                });
                var Oe = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source, Be = new RegExp("^(?:([+-])=|)(" + Oe + ")([a-z%]*)$", "i"), Re = ["Top", "Right", "Bottom", "Left"], Fe = function (e, t) {
                    return e = t || e, "none" === e.style.display || "" === e.style.display && he.contains(e.ownerDocument, e) && "none" === he.css(e, "display")
                }, We = function (e, t, n, r) {
                    var i, a, o = {};
                    for (a in t)o[a] = e.style[a], e.style[a] = t[a];
                    i = n.apply(e, r || []);
                    for (a in t)e.style[a] = o[a];
                    return i
                }, Xe = {};
                he.fn.extend({
                    show: function () {
                        return v(this, !0)
                    }, hide: function () {
                        return v(this)
                    }, toggle: function (e) {
                        return "boolean" == typeof e ? e ? this.show() : this.hide() : this.each(function () {
                                Fe(this) ? he(this).show() : he(this).hide()
                            })
                    }
                });
                var Ye = /^(?:checkbox|radio)$/i, Ge = /<([a-z][^\/\0>\x20\t\r\n\f]+)/i, $e = /^$|\/(?:java|ecma)script/i, _e = {
                    option: [1, "<select multiple='multiple'>", "</select>"],
                    thead: [1, "<table>", "</table>"],
                    col: [2, "<table><colgroup>", "</colgroup></table>"],
                    tr: [2, "<table><tbody>", "</tbody></table>"],
                    td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
                    _default: [0, "", ""]
                };
                _e.optgroup = _e.option, _e.tbody = _e.tfoot = _e.colgroup = _e.caption = _e.thead, _e.th = _e.td;
                var Ve = /<|&#?\w+;/;
                !function () {
                    var e = ne.createDocumentFragment(), t = e.appendChild(ne.createElement("div")), n = ne.createElement("input");
                    n.setAttribute("type", "radio"), n.setAttribute("checked", "checked"), n.setAttribute("name", "t"), t.appendChild(n), fe.checkClone = t.cloneNode(!0).cloneNode(!0).lastChild.checked, t.innerHTML = "<textarea>x</textarea>", fe.noCloneChecked = !!t.cloneNode(!0).lastChild.defaultValue
                }();
                var Ue = ne.documentElement, Ke = /^key/, Qe = /^(?:mouse|pointer|contextmenu|drag|drop)|click/, Je = /^([^.]*)(?:\.(.+)|)/;
                he.event = {
                    global: {}, add: function (e, t, n, r, i) {
                        var a, o, s, l, u, c, p, d, f, h, m, g = Ie.get(e);
                        if (g)for (n.handler && (a = n, n = a.handler, i = a.selector), i && he.find.matchesSelector(Ue, i), n.guid || (n.guid = he.guid++), (l = g.events) || (l = g.events = {}), (o = g.handle) || (o = g.handle = function (t) {
                            return void 0 !== he && he.event.triggered !== t.type ? he.event.dispatch.apply(e, arguments) : void 0
                        }), t = (t || "").match(Ne) || [""], u = t.length; u--;)s = Je.exec(t[u]) || [], f = m = s[1], h = (s[2] || "").split(".").sort(), f && (p = he.event.special[f] || {}, f = (i ? p.delegateType : p.bindType) || f, p = he.event.special[f] || {}, c = he.extend({
                            type: f,
                            origType: m,
                            data: r,
                            handler: n,
                            guid: n.guid,
                            selector: i,
                            needsContext: i && he.expr.match.needsContext.test(i),
                            namespace: h.join(".")
                        }, a), (d = l[f]) || (d = l[f] = [], d.delegateCount = 0, p.setup && !1 !== p.setup.call(e, r, h, o) || e.addEventListener && e.addEventListener(f, o)), p.add && (p.add.call(e, c), c.handler.guid || (c.handler.guid = n.guid)), i ? d.splice(d.delegateCount++, 0, c) : d.push(c), he.event.global[f] = !0)
                    }, remove: function (e, t, n, r, i) {
                        var a, o, s, l, u, c, p, d, f, h, m, g = Ie.hasData(e) && Ie.get(e);
                        if (g && (l = g.events)) {
                            for (t = (t || "").match(Ne) || [""], u = t.length; u--;)if (s = Je.exec(t[u]) || [], f = m = s[1], h = (s[2] || "").split(".").sort(), f) {
                                for (p = he.event.special[f] || {}, f = (r ? p.delegateType : p.bindType) || f, d = l[f] || [], s = s[2] && new RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)"), o = a = d.length; a--;)c = d[a], !i && m !== c.origType || n && n.guid !== c.guid || s && !s.test(c.namespace) || r && r !== c.selector && ("**" !== r || !c.selector) || (d.splice(a, 1), c.selector && d.delegateCount--, p.remove && p.remove.call(e, c));
                                o && !d.length && (p.teardown && !1 !== p.teardown.call(e, h, g.handle) || he.removeEvent(e, f, g.handle), delete l[f])
                            } else for (f in l)he.event.remove(e, f + t[u], n, r, !0);
                            he.isEmptyObject(l) && Ie.remove(e, "handle events")
                        }
                    }, dispatch: function (e) {
                        var t, n, r, i, a, o, s = he.event.fix(e), l = new Array(arguments.length), u = (Ie.get(this, "events") || {})[s.type] || [], c = he.event.special[s.type] || {};
                        for (l[0] = s, t = 1; t < arguments.length; t++)l[t] = arguments[t];
                        if (s.delegateTarget = this, !c.preDispatch || !1 !== c.preDispatch.call(this, s)) {
                            for (o = he.event.handlers.call(this, s, u), t = 0; (i = o[t++]) && !s.isPropagationStopped();)for (s.currentTarget = i.elem, n = 0; (a = i.handlers[n++]) && !s.isImmediatePropagationStopped();)s.rnamespace && !s.rnamespace.test(a.namespace) || (s.handleObj = a, s.data = a.data, void 0 !== (r = ((he.event.special[a.origType] || {}).handle || a.handler).apply(i.elem, l)) && !1 === (s.result = r) && (s.preventDefault(), s.stopPropagation()));
                            return c.postDispatch && c.postDispatch.call(this, s), s.result
                        }
                    }, handlers: function (e, t) {
                        var n, r, i, a, o, s = [], l = t.delegateCount, u = e.target;
                        if (l && u.nodeType && !("click" === e.type && e.button >= 1))for (; u !== this; u = u.parentNode || this)if (1 === u.nodeType && ("click" !== e.type || !0 !== u.disabled)) {
                            for (a = [], o = {}, n = 0; n < l; n++)r = t[n], i = r.selector + " ", void 0 === o[i] && (o[i] = r.needsContext ? he(i, this).index(u) > -1 : he.find(i, this, null, [u]).length), o[i] && a.push(r);
                            a.length && s.push({elem: u, handlers: a})
                        }
                        return u = this, l < t.length && s.push({elem: u, handlers: t.slice(l)}), s
                    }, addProp: function (e, t) {
                        Object.defineProperty(he.Event.prototype, e, {
                            enumerable: !0,
                            configurable: !0,
                            get: he.isFunction(t) ? function () {
                                    if (this.originalEvent)return t(this.originalEvent)
                                } : function () {
                                    if (this.originalEvent)return this.originalEvent[e]
                                },
                            set: function (t) {
                                Object.defineProperty(this, e, {enumerable: !0, configurable: !0, writable: !0, value: t})
                            }
                        })
                    }, fix: function (e) {
                        return e[he.expando] ? e : new he.Event(e)
                    }, special: {
                        load: {noBubble: !0}, focus: {
                            trigger: function () {
                                if (this !== C() && this.focus)return this.focus(), !1
                            }, delegateType: "focusin"
                        }, blur: {
                            trigger: function () {
                                if (this === C() && this.blur)return this.blur(), !1
                            }, delegateType: "focusout"
                        }, click: {
                            trigger: function () {
                                if ("checkbox" === this.type && this.click && i(this, "input"))return this.click(), !1
                            }, _default: function (e) {
                                return i(e.target, "a")
                            }
                        }, beforeunload: {
                            postDispatch: function (e) {
                                void 0 !== e.result && e.originalEvent && (e.originalEvent.returnValue = e.result)
                            }
                        }
                    }
                }, he.removeEvent = function (e, t, n) {
                    e.removeEventListener && e.removeEventListener(t, n)
                }, he.Event = function (e, t) {
                    if (!(this instanceof he.Event))return new he.Event(e, t);
                    e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || void 0 === e.defaultPrevented && !1 === e.returnValue ? b : T, this.target = e.target && 3 === e.target.nodeType ? e.target.parentNode : e.target, this.currentTarget = e.currentTarget, this.relatedTarget = e.relatedTarget) : this.type = e, t && he.extend(this, t), this.timeStamp = e && e.timeStamp || he.now(), this[he.expando] = !0
                }, he.Event.prototype = {
                    constructor: he.Event,
                    isDefaultPrevented: T,
                    isPropagationStopped: T,
                    isImmediatePropagationStopped: T,
                    isSimulated: !1,
                    preventDefault: function () {
                        var e = this.originalEvent;
                        this.isDefaultPrevented = b, e && !this.isSimulated && e.preventDefault()
                    },
                    stopPropagation: function () {
                        var e = this.originalEvent;
                        this.isPropagationStopped = b, e && !this.isSimulated && e.stopPropagation()
                    },
                    stopImmediatePropagation: function () {
                        var e = this.originalEvent;
                        this.isImmediatePropagationStopped = b, e && !this.isSimulated && e.stopImmediatePropagation(), this.stopPropagation()
                    }
                }, he.each({
                    altKey: !0,
                    bubbles: !0,
                    cancelable: !0,
                    changedTouches: !0,
                    ctrlKey: !0,
                    detail: !0,
                    eventPhase: !0,
                    metaKey: !0,
                    pageX: !0,
                    pageY: !0,
                    shiftKey: !0,
                    view: !0,
                    char: !0,
                    charCode: !0,
                    key: !0,
                    keyCode: !0,
                    button: !0,
                    buttons: !0,
                    clientX: !0,
                    clientY: !0,
                    offsetX: !0,
                    offsetY: !0,
                    pointerId: !0,
                    pointerType: !0,
                    screenX: !0,
                    screenY: !0,
                    targetTouches: !0,
                    toElement: !0,
                    touches: !0,
                    which: function (e) {
                        var t = e.button;
                        return null == e.which && Ke.test(e.type) ? null != e.charCode ? e.charCode : e.keyCode : !e.which && void 0 !== t && Qe.test(e.type) ? 1 & t ? 1 : 2 & t ? 3 : 4 & t ? 2 : 0 : e.which
                    }
                }, he.event.addProp), he.each({
                    mouseenter: "mouseover",
                    mouseleave: "mouseout",
                    pointerenter: "pointerover",
                    pointerleave: "pointerout"
                }, function (e, t) {
                    he.event.special[e] = {
                        delegateType: t, bindType: t, handle: function (e) {
                            var n, r = this, i = e.relatedTarget, a = e.handleObj;
                            return i && (i === r || he.contains(r, i)) || (e.type = a.origType, n = a.handler.apply(this, arguments), e.type = t), n
                        }
                    }
                }), he.fn.extend({
                    on: function (e, t, n, r) {
                        return S(this, e, t, n, r)
                    }, one: function (e, t, n, r) {
                        return S(this, e, t, n, r, 1)
                    }, off: function (e, t, n) {
                        var r, i;
                        if (e && e.preventDefault && e.handleObj)return r = e.handleObj, he(e.delegateTarget).off(r.namespace ? r.origType + "." + r.namespace : r.origType, r.selector, r.handler), this;
                        if ("object" == typeof e) {
                            for (i in e)this.off(i, t, e[i]);
                            return this
                        }
                        return !1 !== t && "function" != typeof t || (n = t, t = void 0), !1 === n && (n = T), this.each(function () {
                            he.event.remove(this, e, n, t)
                        })
                    }
                });
                var Ze = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([a-z][^\/\0>\x20\t\r\n\f]*)[^>]*)\/>/gi, et = /<script|<style|<link/i, tt = /checked\s*(?:[^=]|=\s*.checked.)/i, nt = /^true\/(.*)/, rt = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;
                he.extend({
                    htmlPrefilter: function (e) {
                        return e.replace(Ze, "<$1></$2>")
                    }, clone: function (e, t, n) {
                        var r, i, a, o, s = e.cloneNode(!0), l = he.contains(e.ownerDocument, e);
                        if (!(fe.noCloneChecked || 1 !== e.nodeType && 11 !== e.nodeType || he.isXMLDoc(e)))for (o = y(s), a = y(e), r = 0, i = a.length; r < i; r++)N(a[r], o[r]);
                        if (t)if (n)for (a = a || y(e), o = o || y(s), r = 0, i = a.length; r < i; r++)M(a[r], o[r]); else M(e, s);
                        return o = y(s, "script"), o.length > 0 && x(o, !l && y(e, "script")), s
                    }, cleanData: function (e) {
                        for (var t, n, r, i = he.event.special, a = 0; void 0 !== (n = e[a]); a++)if (ze(n)) {
                            if (t = n[Ie.expando]) {
                                if (t.events)for (r in t.events)i[r] ? he.event.remove(n, r) : he.removeEvent(n, r, t.handle);
                                n[Ie.expando] = void 0
                            }
                            n[je.expando] && (n[je.expando] = void 0)
                        }
                    }
                }), he.fn.extend({
                    detach: function (e) {
                        return L(this, e, !0)
                    }, remove: function (e) {
                        return L(this, e)
                    }, text: function (e) {
                        return Pe(this, function (e) {
                            return void 0 === e ? he.text(this) : this.empty().each(function () {
                                    1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || (this.textContent = e)
                                })
                        }, null, e, arguments.length)
                    }, append: function () {
                        return A(this, arguments, function (e) {
                            if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                                E(this, e).appendChild(e)
                            }
                        })
                    }, prepend: function () {
                        return A(this, arguments, function (e) {
                            if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                                var t = E(this, e);
                                t.insertBefore(e, t.firstChild)
                            }
                        })
                    }, before: function () {
                        return A(this, arguments, function (e) {
                            this.parentNode && this.parentNode.insertBefore(e, this)
                        })
                    }, after: function () {
                        return A(this, arguments, function (e) {
                            this.parentNode && this.parentNode.insertBefore(e, this.nextSibling)
                        })
                    }, empty: function () {
                        for (var e, t = 0; null != (e = this[t]); t++)1 === e.nodeType && (he.cleanData(y(e, !1)), e.textContent = "");
                        return this
                    }, clone: function (e, t) {
                        return e = null != e && e, t = null == t ? e : t, this.map(function () {
                            return he.clone(this, e, t)
                        })
                    }, html: function (e) {
                        return Pe(this, function (e) {
                            var t = this[0] || {}, n = 0, r = this.length;
                            if (void 0 === e && 1 === t.nodeType)return t.innerHTML;
                            if ("string" == typeof e && !et.test(e) && !_e[(Ge.exec(e) || ["", ""])[1].toLowerCase()]) {
                                e = he.htmlPrefilter(e);
                                try {
                                    for (; n < r; n++)t = this[n] || {}, 1 === t.nodeType && (he.cleanData(y(t, !1)), t.innerHTML = e);
                                    t = 0
                                } catch (e) {
                                }
                            }
                            t && this.empty().append(e)
                        }, null, e, arguments.length)
                    }, replaceWith: function () {
                        var e = [];
                        return A(this, arguments, function (t) {
                            var n = this.parentNode;
                            he.inArray(this, e) < 0 && (he.cleanData(y(this)), n && n.replaceChild(t, this))
                        }, e)
                    }
                }), he.each({
                    appendTo: "append",
                    prependTo: "prepend",
                    insertBefore: "before",
                    insertAfter: "after",
                    replaceAll: "replaceWith"
                }, function (e, t) {
                    he.fn[e] = function (e) {
                        for (var n, r = [], i = he(e), a = i.length - 1, o = 0; o <= a; o++)n = o === a ? this : this.clone(!0), he(i[o])[t](n), oe.apply(r, n.get());
                        return this.pushStack(r)
                    }
                });
                var it = /^margin/, at = new RegExp("^(" + Oe + ")(?!px)[a-z%]+$", "i"), ot = function (t) {
                    var n = t.ownerDocument.defaultView;
                    return n && n.opener || (n = e), n.getComputedStyle(t)
                };
                !function () {
                    function t() {
                        if (s) {
                            s.style.cssText = "box-sizing:border-box;position:relative;display:block;margin:auto;border:1px;padding:1px;top:1%;width:50%", s.innerHTML = "", Ue.appendChild(o);
                            var t = e.getComputedStyle(s);
                            n = "1%" !== t.top, a = "2px" === t.marginLeft, r = "4px" === t.width, s.style.marginRight = "50%", i = "4px" === t.marginRight, Ue.removeChild(o), s = null
                        }
                    }

                    var n, r, i, a, o = ne.createElement("div"), s = ne.createElement("div");
                    s.style && (s.style.backgroundClip = "content-box", s.cloneNode(!0).style.backgroundClip = "", fe.clearCloneStyle = "content-box" === s.style.backgroundClip, o.style.cssText = "border:0;width:8px;height:0;top:0;left:-9999px;padding:0;margin-top:1px;position:absolute", o.appendChild(s), he.extend(fe, {
                        pixelPosition: function () {
                            return t(), n
                        }, boxSizingReliable: function () {
                            return t(), r
                        }, pixelMarginRight: function () {
                            return t(), i
                        }, reliableMarginLeft: function () {
                            return t(), a
                        }
                    }))
                }();
                var st = /^(none|table(?!-c[ea]).+)/, lt = /^--/, ut = {
                    position: "absolute",
                    visibility: "hidden",
                    display: "block"
                }, ct = {
                    letterSpacing: "0",
                    fontWeight: "400"
                }, pt = ["Webkit", "Moz", "ms"], dt = ne.createElement("div").style;
                he.extend({
                    cssHooks: {
                        opacity: {
                            get: function (e, t) {
                                if (t) {
                                    var n = P(e, "opacity");
                                    return "" === n ? "1" : n
                                }
                            }
                        }
                    },
                    cssNumber: {
                        animationIterationCount: !0,
                        columnCount: !0,
                        fillOpacity: !0,
                        flexGrow: !0,
                        flexShrink: !0,
                        fontWeight: !0,
                        lineHeight: !0,
                        opacity: !0,
                        order: !0,
                        orphans: !0,
                        widows: !0,
                        zIndex: !0,
                        zoom: !0
                    },
                    cssProps: {float: "cssFloat"},
                    style: function (e, t, n, r) {
                        if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
                            var i, a, o, s = he.camelCase(t), l = lt.test(t), u = e.style;
                            if (l || (t = j(s)), o = he.cssHooks[t] || he.cssHooks[s], void 0 === n)return o && "get" in o && void 0 !== (i = o.get(e, !1, r)) ? i : u[t];
                            a = typeof n, "string" === a && (i = Be.exec(n)) && i[1] && (n = m(e, t, i), a = "number"), null != n && n === n && ("number" === a && (n += i && i[3] || (he.cssNumber[s] ? "" : "px")), fe.clearCloneStyle || "" !== n || 0 !== t.indexOf("background") || (u[t] = "inherit"), o && "set" in o && void 0 === (n = o.set(e, n, r)) || (l ? u.setProperty(t, n) : u[t] = n))
                        }
                    },
                    css: function (e, t, n, r) {
                        var i, a, o, s = he.camelCase(t);
                        return lt.test(t) || (t = j(s)), o = he.cssHooks[t] || he.cssHooks[s], o && "get" in o && (i = o.get(e, !0, n)), void 0 === i && (i = P(e, t, r)), "normal" === i && t in ct && (i = ct[t]), "" === n || n ? (a = parseFloat(i), !0 === n || isFinite(a) ? a || 0 : i) : i
                    }
                }), he.each(["height", "width"], function (e, t) {
                    he.cssHooks[t] = {
                        get: function (e, n, r) {
                            if (n)return !st.test(he.css(e, "display")) || e.getClientRects().length && e.getBoundingClientRect().width ? O(e, t, r) : We(e, ut, function () {
                                    return O(e, t, r)
                                })
                        }, set: function (e, n, r) {
                            var i, a = r && ot(e), o = r && q(e, t, r, "border-box" === he.css(e, "boxSizing", !1, a), a);
                            return o && (i = Be.exec(n)) && "px" !== (i[3] || "px") && (e.style[t] = n, n = he.css(e, t)), H(e, n, o)
                        }
                    }
                }), he.cssHooks.marginLeft = z(fe.reliableMarginLeft, function (e, t) {
                    if (t)return (parseFloat(P(e, "marginLeft")) || e.getBoundingClientRect().left - We(e, {marginLeft: 0}, function () {
                            return e.getBoundingClientRect().left
                        })) + "px"
                }), he.each({margin: "", padding: "", border: "Width"}, function (e, t) {
                    he.cssHooks[e + t] = {
                        expand: function (n) {
                            for (var r = 0, i = {}, a = "string" == typeof n ? n.split(" ") : [n]; r < 4; r++)i[e + Re[r] + t] = a[r] || a[r - 2] || a[0];
                            return i
                        }
                    }, it.test(e) || (he.cssHooks[e + t].set = H)
                }), he.fn.extend({
                    css: function (e, t) {
                        return Pe(this, function (e, t, n) {
                            var r, i, a = {}, o = 0;
                            if (Array.isArray(t)) {
                                for (r = ot(e), i = t.length; o < i; o++)a[t[o]] = he.css(e, t[o], !1, r);
                                return a
                            }
                            return void 0 !== n ? he.style(e, t, n) : he.css(e, t)
                        }, e, t, arguments.length > 1)
                    }
                }), he.Tween = B, B.prototype = {
                    constructor: B, init: function (e, t, n, r, i, a) {
                        this.elem = e, this.prop = n, this.easing = i || he.easing._default, this.options = t, this.start = this.now = this.cur(), this.end = r, this.unit = a || (he.cssNumber[n] ? "" : "px")
                    }, cur: function () {
                        var e = B.propHooks[this.prop];
                        return e && e.get ? e.get(this) : B.propHooks._default.get(this)
                    }, run: function (e) {
                        var t, n = B.propHooks[this.prop];
                        return this.options.duration ? this.pos = t = he.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration) : this.pos = t = e, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : B.propHooks._default.set(this), this
                    }
                }, B.prototype.init.prototype = B.prototype, B.propHooks = {
                    _default: {
                        get: function (e) {
                            var t;
                            return 1 !== e.elem.nodeType || null != e.elem[e.prop] && null == e.elem.style[e.prop] ? e.elem[e.prop] : (t = he.css(e.elem, e.prop, ""), t && "auto" !== t ? t : 0)
                        }, set: function (e) {
                            he.fx.step[e.prop] ? he.fx.step[e.prop](e) : 1 !== e.elem.nodeType || null == e.elem.style[he.cssProps[e.prop]] && !he.cssHooks[e.prop] ? e.elem[e.prop] = e.now : he.style(e.elem, e.prop, e.now + e.unit)
                        }
                    }
                }, B.propHooks.scrollTop = B.propHooks.scrollLeft = {
                    set: function (e) {
                        e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now)
                    }
                }, he.easing = {
                    linear: function (e) {
                        return e
                    }, swing: function (e) {
                        return .5 - Math.cos(e * Math.PI) / 2
                    }, _default: "swing"
                }, he.fx = B.prototype.init, he.fx.step = {};
                var ft, ht, mt = /^(?:toggle|show|hide)$/, gt = /queueHooks$/;
                he.Animation = he.extend($, {
                    tweeners: {
                        "*": [function (e, t) {
                            var n = this.createTween(e, t);
                            return m(n.elem, e, Be.exec(t), n), n
                        }]
                    }, tweener: function (e, t) {
                        he.isFunction(e) ? (t = e, e = ["*"]): e= e.match(Ne);
                        for (var n, r = 0, i = e.length; r < i; r++)n = e[r], $.tweeners[n] = $.tweeners[n] || [], $.tweeners[n].unshift(t)
                    }, prefilters: [Y], prefilter: function (e, t) {
                        t ? $.prefilters.unshift(e) : $.prefilters.push(e)
                    }
                }), he.speed = function (e, t, n) {
                    var r = e && "object" == typeof e ? he.extend({}, e) : {
                            complete: n || !n && t || he.isFunction(e) && e,
                            duration: e,
                            easing: n && t || t && !he.isFunction(t) && t
                        };
                    return he.fx.off ? r.duration = 0 : "number" != typeof r.duration && (r.duration in he.fx.speeds ? r.duration = he.fx.speeds[r.duration] : r.duration = he.fx.speeds._default), null != r.queue && !0 !== r.queue || (r.queue = "fx"), r.old = r.complete, r.complete = function () {
                        he.isFunction(r.old) && r.old.call(this), r.queue && he.dequeue(this, r.queue)
                    }, r
                }, he.fn.extend({
                    fadeTo: function (e, t, n, r) {
                        return this.filter(Fe).css("opacity", 0).show().end().animate({opacity: t}, e, n, r)
                    }, animate: function (e, t, n, r) {
                        var i = he.isEmptyObject(e), a = he.speed(t, n, r), o = function () {
                            var t = $(this, he.extend({}, e), a);
                            (i || Ie.get(this, "finish")) && t.stop(!0)
                        };
                        return o.finish = o, i || !1 === a.queue ? this.each(o) : this.queue(a.queue, o)
                    }, stop: function (e, t, n) {
                        var r = function (e) {
                            var t = e.stop;
                            delete e.stop, t(n)
                        };
                        return "string" != typeof e && (n = t, t = e, e = void 0), t && !1 !== e && this.queue(e || "fx", []), this.each(function () {
                            var t = !0, i = null != e && e + "queueHooks", a = he.timers, o = Ie.get(this);
                            if (i) o[i] && o[i].stop && r(o[i]); else for (i in o)o[i] && o[i].stop && gt.test(i) && r(o[i]);
                            for (i = a.length; i--;)a[i].elem !== this || null != e && a[i].queue !== e || (a[i].anim.stop(n), t = !1, a.splice(i, 1));
                            !t && n || he.dequeue(this, e)
                        })
                    }, finish: function (e) {
                        return !1 !== e && (e = e || "fx"), this.each(function () {
                            var t, n = Ie.get(this), r = n[e + "queue"], i = n[e + "queueHooks"], a = he.timers, o = r ? r.length : 0;
                            for (n.finish = !0, he.queue(this, e, []), i && i.stop && i.stop.call(this, !0), t = a.length; t--;)a[t].elem === this && a[t].queue === e && (a[t].anim.stop(!0), a.splice(t, 1));
                            for (t = 0; t < o; t++)r[t] && r[t].finish && r[t].finish.call(this);
                            delete n.finish
                        })
                    }
                }), he.each(["toggle", "show", "hide"], function (e, t) {
                    var n = he.fn[t];
                    he.fn[t] = function (e, r, i) {
                        return null == e || "boolean" == typeof e ? n.apply(this, arguments) : this.animate(W(t, !0), e, r, i)
                    }
                }), he.each({
                    slideDown: W("show"),
                    slideUp: W("hide"),
                    slideToggle: W("toggle"),
                    fadeIn: {opacity: "show"},
                    fadeOut: {opacity: "hide"},
                    fadeToggle: {opacity: "toggle"}
                }, function (e, t) {
                    he.fn[e] = function (e, n, r) {
                        return this.animate(t, e, n, r)
                    }
                }), he.timers = [], he.fx.tick = function () {
                    var e, t = 0, n = he.timers;
                    for (ft = he.now(); t < n.length; t++)(e = n[t])() || n[t] !== e || n.splice(t--, 1);
                    n.length || he.fx.stop(), ft = void 0
                }, he.fx.timer = function (e) {
                    he.timers.push(e), he.fx.start()
                }, he.fx.interval = 13, he.fx.start = function () {
                    ht || (ht = !0, R())
                }, he.fx.stop = function () {
                    ht = null
                }, he.fx.speeds = {slow: 600, fast: 200, _default: 400},
                    he.fn.delay = function (t, n) {
                        return t = he.fx ? he.fx.speeds[t] || t : t, n = n || "fx", this.queue(n, function (n, r) {
                            var i = e.setTimeout(n, t);
                            r.stop = function () {
                                e.clearTimeout(i)
                            }
                        })
                    }, function () {
                    var e = ne.createElement("input"), t = ne.createElement("select"), n = t.appendChild(ne.createElement("option"));
                    e.type = "checkbox", fe.checkOn = "" !== e.value, fe.optSelected = n.selected, e = ne.createElement("input"), e.value = "t", e.type = "radio", fe.radioValue = "t" === e.value
                }();
                var vt, yt = he.expr.attrHandle;
                he.fn.extend({
                    attr: function (e, t) {
                        return Pe(this, he.attr, e, t, arguments.length > 1)
                    }, removeAttr: function (e) {
                        return this.each(function () {
                            he.removeAttr(this, e)
                        })
                    }
                }), he.extend({
                    attr: function (e, t, n) {
                        var r, i, a = e.nodeType;
                        if (3 !== a && 8 !== a && 2 !== a)return void 0 === e.getAttribute ? he.prop(e, t, n) : (1 === a && he.isXMLDoc(e) || (i = he.attrHooks[t.toLowerCase()] || (he.expr.match.bool.test(t) ? vt : void 0)), void 0 !== n ? null === n ? void he.removeAttr(e, t) : i && "set" in i && void 0 !== (r = i.set(e, n, t)) ? r : (e.setAttribute(t, n + ""), n) : i && "get" in i && null !== (r = i.get(e, t)) ? r : (r = he.find.attr(e, t), null == r ? void 0 : r))
                    }, attrHooks: {
                        type: {
                            set: function (e, t) {
                                if (!fe.radioValue && "radio" === t && i(e, "input")) {
                                    var n = e.value;
                                    return e.setAttribute("type", t), n && (e.value = n), t
                                }
                            }
                        }
                    }, removeAttr: function (e, t) {
                        var n, r = 0, i = t && t.match(Ne);
                        if (i && 1 === e.nodeType)for (; n = i[r++];)e.removeAttribute(n)
                    }
                }), vt = {
                    set: function (e, t, n) {
                        return !1 === t ? he.removeAttr(e, n) : e.setAttribute(n, n), n
                    }
                }, he.each(he.expr.match.bool.source.match(/\w+/g), function (e, t) {
                    var n = yt[t] || he.find.attr;
                    yt[t] = function (e, t, r) {
                        var i, a, o = t.toLowerCase();
                        return r || (a = yt[o], yt[o] = i, i = null != n(e, t, r) ? o : null, yt[o] = a), i
                    }
                });
                var xt = /^(?:input|select|textarea|button)$/i, wt = /^(?:a|area)$/i;
                he.fn.extend({
                    prop: function (e, t) {
                        return Pe(this, he.prop, e, t, arguments.length > 1)
                    }, removeProp: function (e) {
                        return this.each(function () {
                            delete this[he.propFix[e] || e]
                        })
                    }
                }), he.extend({
                    prop: function (e, t, n) {
                        var r, i, a = e.nodeType;
                        if (3 !== a && 8 !== a && 2 !== a)return 1 === a && he.isXMLDoc(e) || (t = he.propFix[t] || t, i = he.propHooks[t]), void 0 !== n ? i && "set" in i && void 0 !== (r = i.set(e, n, t)) ? r : e[t] = n : i && "get" in i && null !== (r = i.get(e, t)) ? r : e[t]
                    }, propHooks: {
                        tabIndex: {
                            get: function (e) {
                                var t = he.find.attr(e, "tabindex");
                                return t ? parseInt(t, 10) : xt.test(e.nodeName) || wt.test(e.nodeName) && e.href ? 0 : -1
                            }
                        }
                    }, propFix: {for: "htmlFor", class: "className"}
                }), fe.optSelected || (he.propHooks.selected = {
                    get: function (e) {
                        var t = e.parentNode;
                        return t && t.parentNode && t.parentNode.selectedIndex, null
                    }, set: function (e) {
                        var t = e.parentNode;
                        t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex)
                    }
                }), he.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function () {
                    he.propFix[this.toLowerCase()] = this
                }), he.fn.extend({
                    addClass: function (e) {
                        var t, n, r, i, a, o, s, l = 0;
                        if (he.isFunction(e))return this.each(function (t) {
                            he(this).addClass(e.call(this, t, V(this)))
                        });
                        if ("string" == typeof e && e)for (t = e.match(Ne) || []; n = this[l++];)if (i = V(n), r = 1 === n.nodeType && " " + _(i) + " ") {
                            for (o = 0; a = t[o++];)r.indexOf(" " + a + " ") < 0 && (r += a + " ");
                            s = _(r), i !== s && n.setAttribute("class", s)
                        }
                        return this
                    }, removeClass: function (e) {
                        var t, n, r, i, a, o, s, l = 0;
                        if (he.isFunction(e))return this.each(function (t) {
                            he(this).removeClass(e.call(this, t, V(this)))
                        });
                        if (!arguments.length)return this.attr("class", "");
                        if ("string" == typeof e && e)for (t = e.match(Ne) || []; n = this[l++];)if (i = V(n), r = 1 === n.nodeType && " " + _(i) + " ") {
                            for (o = 0; a = t[o++];)for (; r.indexOf(" " + a + " ") > -1;)r = r.replace(" " + a + " ", " ");
                            s = _(r), i !== s && n.setAttribute("class", s)
                        }
                        return this
                    }, toggleClass: function (e, t) {
                        var n = typeof e;
                        return "boolean" == typeof t && "string" === n ? t ? this.addClass(e) : this.removeClass(e) : he.isFunction(e) ? this.each(function (n) {
                                    he(this).toggleClass(e.call(this, n, V(this), t), t)
                                }) : this.each(function () {
                                    var t, r, i, a;
                                    if ("string" === n)for (r = 0, i = he(this), a = e.match(Ne) || []; t = a[r++];)i.hasClass(t) ? i.removeClass(t) : i.addClass(t); else void 0 !== e && "boolean" !== n || (t = V(this), t && Ie.set(this, "__className__", t), this.setAttribute && this.setAttribute("class", t || !1 === e ? "" : Ie.get(this, "__className__") || ""))
                                })
                    }, hasClass: function (e) {
                        var t, n, r = 0;
                        for (t = " " + e + " "; n = this[r++];)if (1 === n.nodeType && (" " + _(V(n)) + " ").indexOf(t) > -1)return !0;
                        return !1
                    }
                });
                var bt = /\r/g;
                he.fn.extend({
                    val: function (e) {
                        var t, n, r, i = this[0];
                        {
                            if (arguments.length)return r = he.isFunction(e), this.each(function (n) {
                                var i;
                                1 === this.nodeType && (i = r ? e.call(this, n, he(this).val()) : e, null == i ? i = "" : "number" == typeof i ? i += "" : Array.isArray(i) && (i = he.map(i, function (e) {
                                            return null == e ? "" : e + ""
                                        })), (t = he.valHooks[this.type] || he.valHooks[this.nodeName.toLowerCase()]) && "set" in t && void 0 !== t.set(this, i, "value") || (this.value = i))
                            });
                            if (i)return (t = he.valHooks[i.type] || he.valHooks[i.nodeName.toLowerCase()]) && "get" in t && void 0 !== (n = t.get(i, "value")) ? n : (n = i.value, "string" == typeof n ? n.replace(bt, "") : null == n ? "" : n)
                        }
                    }
                }), he.extend({
                    valHooks: {
                        option: {
                            get: function (e) {
                                var t = he.find.attr(e, "value");
                                return null != t ? t : _(he.text(e))
                            }
                        }, select: {
                            get: function (e) {
                                var t, n, r, a = e.options, o = e.selectedIndex, s = "select-one" === e.type, l = s ? null : [], u = s ? o + 1 : a.length;
                                for (r = o < 0 ? u : s ? o : 0; r < u; r++)if (n = a[r], (n.selected || r === o) && !n.disabled && (!n.parentNode.disabled || !i(n.parentNode, "optgroup"))) {
                                    if (t = he(n).val(), s)return t;
                                    l.push(t)
                                }
                                return l
                            }, set: function (e, t) {
                                for (var n, r, i = e.options, a = he.makeArray(t), o = i.length; o--;)r = i[o], (r.selected = he.inArray(he.valHooks.option.get(r), a) > -1) && (n = !0);
                                return n || (e.selectedIndex = -1), a
                            }
                        }
                    }
                }), he.each(["radio", "checkbox"], function () {
                    he.valHooks[this] = {
                        set: function (e, t) {
                            if (Array.isArray(t))return e.checked = he.inArray(he(e).val(), t) > -1
                        }
                    }, fe.checkOn || (he.valHooks[this].get = function (e) {
                        return null === e.getAttribute("value") ? "on" : e.value
                    })
                });
                var Tt = /^(?:focusinfocus|focusoutblur)$/;
                he.extend(he.event, {
                    trigger: function (t, n, r, i) {
                        var a, o, s, l, u, c, p, d = [r || ne], f = ce.call(t, "type") ? t.type : t, h = ce.call(t, "namespace") ? t.namespace.split(".") : [];
                        if (o = s = r = r || ne, 3 !== r.nodeType && 8 !== r.nodeType && !Tt.test(f + he.event.triggered) && (f.indexOf(".") > -1 && (h = f.split("."), f = h.shift(), h.sort()), u = f.indexOf(":") < 0 && "on" + f, t = t[he.expando] ? t : new he.Event(f, "object" == typeof t && t), t.isTrigger = i ? 2 : 3, t.namespace = h.join("."), t.rnamespace = t.namespace ? new RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, t.result = void 0, t.target || (t.target = r), n = null == n ? [t] : he.makeArray(n, [t]), p = he.event.special[f] || {}, i || !p.trigger || !1 !== p.trigger.apply(r, n))) {
                            if (!i && !p.noBubble && !he.isWindow(r)) {
                                for (l = p.delegateType || f, Tt.test(l + f) || (o = o.parentNode); o; o = o.parentNode)d.push(o), s = o;
                                s === (r.ownerDocument || ne) && d.push(s.defaultView || s.parentWindow || e)
                            }
                            for (a = 0; (o = d[a++]) && !t.isPropagationStopped();)t.type = a > 1 ? l : p.bindType || f, c = (Ie.get(o, "events") || {})[t.type] && Ie.get(o, "handle"), c && c.apply(o, n), (c = u && o[u]) && c.apply && ze(o) && (t.result = c.apply(o, n), !1 === t.result && t.preventDefault());
                            return t.type = f, i || t.isDefaultPrevented() || p._default && !1 !== p._default.apply(d.pop(), n) || !ze(r) || u && he.isFunction(r[f]) && !he.isWindow(r) && (s = r[u], s && (r[u] = null), he.event.triggered = f, r[f](), he.event.triggered = void 0, s && (r[u] = s)), t.result
                        }
                    }, simulate: function (e, t, n) {
                        var r = he.extend(new he.Event, n, {type: e, isSimulated: !0});
                        he.event.trigger(r, null, t)
                    }
                }), he.fn.extend({
                    trigger: function (e, t) {
                        return this.each(function () {
                            he.event.trigger(e, t, this)
                        })
                    }, triggerHandler: function (e, t) {
                        var n = this[0];
                        if (n)return he.event.trigger(e, t, n, !0)
                    }
                }), he.each("blur focus focusin focusout resize scroll click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup contextmenu".split(" "), function (e, t) {
                    he.fn[t] = function (e, n) {
                        return arguments.length > 0 ? this.on(t, null, e, n) : this.trigger(t)
                    }
                }), he.fn.extend({
                    hover: function (e, t) {
                        return this.mouseenter(e).mouseleave(t || e)
                    }
                }), fe.focusin = "onfocusin" in e, fe.focusin || he.each({
                    focus: "focusin",
                    blur: "focusout"
                }, function (e, t) {
                    var n = function (e) {
                        he.event.simulate(t, e.target, he.event.fix(e))
                    };
                    he.event.special[t] = {
                        setup: function () {
                            var r = this.ownerDocument || this, i = Ie.access(r, t);
                            i || r.addEventListener(e, n, !0), Ie.access(r, t, (i || 0) + 1)
                        }, teardown: function () {
                            var r = this.ownerDocument || this, i = Ie.access(r, t) - 1;
                            i ? Ie.access(r, t, i) : (r.removeEventListener(e, n, !0), Ie.remove(r, t))
                        }
                    }
                });
                var Ct = e.location, St = he.now(), Et = /\?/;
                he.parseXML = function (t) {
                    var n;
                    if (!t || "string" != typeof t)return null;
                    try {
                        n = (new e.DOMParser).parseFromString(t, "text/xml")
                    } catch (e) {
                        n = void 0
                    }
                    return n && !n.getElementsByTagName("parsererror").length || he.error("Invalid XML: " + t), n
                };
                var kt = /\[\]$/, Dt = /\r?\n/g, Mt = /^(?:submit|button|image|reset|file)$/i, Nt = /^(?:input|select|textarea|keygen)/i;
                he.param = function (e, t) {
                    var n, r = [], i = function (e, t) {
                        var n = he.isFunction(t) ? t() : t;
                        r[r.length] = encodeURIComponent(e) + "=" + encodeURIComponent(null == n ? "" : n)
                    };
                    if (Array.isArray(e) || e.jquery && !he.isPlainObject(e)) he.each(e, function () {
                        i(this.name, this.value)
                    }); else for (n in e)U(n, e[n], t, i);
                    return r.join("&")
                }, he.fn.extend({
                    serialize: function () {
                        return he.param(this.serializeArray())
                    }, serializeArray: function () {
                        return this.map(function () {
                            var e = he.prop(this, "elements");
                            return e ? he.makeArray(e) : this
                        }).filter(function () {
                            var e = this.type;
                            return this.name && !he(this).is(":disabled") && Nt.test(this.nodeName) && !Mt.test(e) && (this.checked || !Ye.test(e))
                        }).map(function (e, t) {
                            var n = he(this).val();
                            return null == n ? null : Array.isArray(n) ? he.map(n, function (e) {
                                        return {name: t.name, value: e.replace(Dt, "\r\n")}
                                    }) : {name: t.name, value: n.replace(Dt, "\r\n")}
                        }).get()
                    }
                });
                var At = /%20/g, Lt = /#.*$/, Pt = /([?&])_=[^&]*/, zt = /^(.*?):[ \t]*([^\r\n]*)$/gm, It = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/, jt = /^(?:GET|HEAD)$/, Ht = /^\/\//, qt = {}, Ot = {}, Bt = "*/".concat("*"), Rt = ne.createElement("a");
                Rt.href = Ct.href, he.extend({
                    active: 0,
                    lastModified: {},
                    etag: {},
                    ajaxSettings: {
                        url: Ct.href,
                        type: "GET",
                        isLocal: It.test(Ct.protocol),
                        global: !0,
                        processData: !0,
                        async: !0,
                        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                        accepts: {
                            "*": Bt,
                            text: "text/plain",
                            html: "text/html",
                            xml: "application/xml, text/xml",
                            json: "application/json, text/javascript"
                        },
                        contents: {xml: /\bxml\b/, html: /\bhtml/, json: /\bjson\b/},
                        responseFields: {xml: "responseXML", text: "responseText", json: "responseJSON"},
                        converters: {"* text": String, "text html": !0, "text json": JSON.parse, "text xml": he.parseXML},
                        flatOptions: {url: !0, context: !0}
                    },
                    ajaxSetup: function (e, t) {
                        return t ? J(J(e, he.ajaxSettings), t) : J(he.ajaxSettings, e)
                    },
                    ajaxPrefilter: K(qt),
                    ajaxTransport: K(Ot),
                    ajax: function (t, n) {
                        function r(t, n, r, s) {
                            var u, d, f, w, b, T = n;
                            c || (c = !0, l && e.clearTimeout(l), i = void 0, o = s || "", C.readyState = t > 0 ? 4 : 0, u = t >= 200 && t < 300 || 304 === t, r && (w = Z(h, C, r)), w = ee(h, w, C, u), u ? (h.ifModified && (b = C.getResponseHeader("Last-Modified"), b && (he.lastModified[a] = b), (b = C.getResponseHeader("etag")) && (he.etag[a] = b)), 204 === t || "HEAD" === h.type ? T = "nocontent" : 304 === t ? T = "notmodified" : (T = w.state, d = w.data, f = w.error, u = !f)) : (f = T, !t && T || (T = "error", t < 0 && (t = 0))), C.status = t, C.statusText = (n || T) + "", u ? v.resolveWith(m, [d, T, C]) : v.rejectWith(m, [C, T, f]), C.statusCode(x), x = void 0, p && g.trigger(u ? "ajaxSuccess" : "ajaxError", [C, h, u ? d : f]), y.fireWith(m, [C, T]), p && (g.trigger("ajaxComplete", [C, h]), --he.active || he.event.trigger("ajaxStop")))
                        }

                        "object" == typeof t && (n = t, t = void 0), n = n || {};
                        var i, a, o, s, l, u, c, p, d, f, h = he.ajaxSetup({}, n), m = h.context || h, g = h.context && (m.nodeType || m.jquery) ? he(m) : he.event, v = he.Deferred(), y = he.Callbacks("once memory"), x = h.statusCode || {}, w = {}, b = {}, T = "canceled", C = {
                            readyState: 0,
                            getResponseHeader: function (e) {
                                var t;
                                if (c) {
                                    if (!s)for (s = {}; t = zt.exec(o);)s[t[1].toLowerCase()] = t[2];
                                    t = s[e.toLowerCase()]
                                }
                                return null == t ? null : t
                            },
                            getAllResponseHeaders: function () {
                                return c ? o : null
                            },
                            setRequestHeader: function (e, t) {
                                return null == c && (e = b[e.toLowerCase()] = b[e.toLowerCase()] || e, w[e] = t), this
                            },
                            overrideMimeType: function (e) {
                                return null == c && (h.mimeType = e), this
                            },
                            statusCode: function (e) {
                                var t;
                                if (e)if (c) C.always(e[C.status]); else for (t in e)x[t] = [x[t], e[t]];
                                return this
                            },
                            abort: function (e) {
                                var t = e || T;
                                return i && i.abort(t), r(0, t), this
                            }
                        };
                        if (v.promise(C), h.url = ((t || h.url || Ct.href) + "").replace(Ht, Ct.protocol + "//"), h.type = n.method || n.type || h.method || h.type, h.dataTypes = (h.dataType || "*").toLowerCase().match(Ne) || [""], null == h.crossDomain) {
                            u = ne.createElement("a");
                            try {
                                u.href = h.url, u.href = u.href, h.crossDomain = Rt.protocol + "//" + Rt.host != u.protocol + "//" + u.host
                            } catch (e) {
                                h.crossDomain = !0
                            }
                        }
                        if (h.data && h.processData && "string" != typeof h.data && (h.data = he.param(h.data, h.traditional)), Q(qt, h, n, C), c)return C;
                        p = he.event && h.global, p && 0 == he.active++ && he.event.trigger("ajaxStart"), h.type = h.type.toUpperCase(), h.hasContent = !jt.test(h.type), a = h.url.replace(Lt, ""), h.hasContent ? h.data && h.processData && 0 === (h.contentType || "").indexOf("application/x-www-form-urlencoded") && (h.data = h.data.replace(At, "+")) : (f = h.url.slice(a.length), h.data && (a += (Et.test(a) ? "&" : "?") + h.data, delete h.data), !1 === h.cache && (a = a.replace(Pt, "$1"), f = (Et.test(a) ? "&" : "?") + "_=" + St++ + f), h.url = a + f), h.ifModified && (he.lastModified[a] && C.setRequestHeader("If-Modified-Since", he.lastModified[a]), he.etag[a] && C.setRequestHeader("If-None-Match", he.etag[a])), (h.data && h.hasContent && !1 !== h.contentType || n.contentType) && C.setRequestHeader("Content-Type", h.contentType), C.setRequestHeader("Accept", h.dataTypes[0] && h.accepts[h.dataTypes[0]] ? h.accepts[h.dataTypes[0]] + ("*" !== h.dataTypes[0] ? ", " + Bt + "; q=0.01" : "") : h.accepts["*"]);
                        for (d in h.headers)C.setRequestHeader(d, h.headers[d]);
                        if (h.beforeSend && (!1 === h.beforeSend.call(m, C, h) || c))return C.abort();
                        if (T = "abort", y.add(h.complete), C.done(h.success), C.fail(h.error), i = Q(Ot, h, n, C)) {
                            if (C.readyState = 1, p && g.trigger("ajaxSend", [C, h]), c)return C;
                            h.async && h.timeout > 0 && (l = e.setTimeout(function () {
                                C.abort("timeout")
                            }, h.timeout));
                            try {
                                c = !1, i.send(w, r)
                            } catch (e) {
                                if (c)throw e;
                                r(-1, e)
                            }
                        } else r(-1, "No Transport");
                        return C
                    },
                    getJSON: function (e, t, n) {
                        return he.get(e, t, n, "json")
                    },
                    getScript: function (e, t) {
                        return he.get(e, void 0, t, "script")
                    }
                }), he.each(["get", "post"], function (e, t) {
                    he[t] = function (e, n, r, i) {
                        return he.isFunction(n) && (i = i || r, r = n, n = void 0), he.ajax(he.extend({
                            url: e,
                            type: t,
                            dataType: i,
                            data: n,
                            success: r
                        }, he.isPlainObject(e) && e))
                    }
                }), he._evalUrl = function (e) {
                    return he.ajax({url: e, type: "GET", dataType: "script", cache: !0, async: !1, global: !1, throws: !0})
                }, he.fn.extend({
                    wrapAll: function (e) {
                        var t;
                        return this[0] && (he.isFunction(e) && (e = e.call(this[0])), t = he(e, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && t.insertBefore(this[0]), t.map(function () {
                            for (var e = this; e.firstElementChild;)e = e.firstElementChild;
                            return e
                        }).append(this)), this
                    }, wrapInner: function (e) {
                        return he.isFunction(e) ? this.each(function (t) {
                                he(this).wrapInner(e.call(this, t))
                            }) : this.each(function () {
                                var t = he(this), n = t.contents();
                                n.length ? n.wrapAll(e) : t.append(e)
                            })
                    }, wrap: function (e) {
                        var t = he.isFunction(e);
                        return this.each(function (n) {
                            he(this).wrapAll(t ? e.call(this, n) : e)
                        })
                    }, unwrap: function (e) {
                        return this.parent(e).not("body").each(function () {
                            he(this).replaceWith(this.childNodes)
                        }), this
                    }
                }), he.expr.pseudos.hidden = function (e) {
                    return !he.expr.pseudos.visible(e)
                }, he.expr.pseudos.visible = function (e) {
                    return !!(e.offsetWidth || e.offsetHeight || e.getClientRects().length)
                }, he.ajaxSettings.xhr = function () {
                    try {
                        return new e.XMLHttpRequest
                    } catch (e) {
                    }
                };
                var Ft = {0: 200, 1223: 204}, Wt = he.ajaxSettings.xhr();
                fe.cors = !!Wt && "withCredentials" in Wt, fe.ajax = Wt = !!Wt, he.ajaxTransport(function (t) {
                    var n, r;
                    if (fe.cors || Wt && !t.crossDomain)return {
                        send: function (i, a) {
                            var o, s = t.xhr();
                            if (s.open(t.type, t.url, t.async, t.username, t.password), t.xhrFields)for (o in t.xhrFields)s[o] = t.xhrFields[o];
                            t.mimeType && s.overrideMimeType && s.overrideMimeType(t.mimeType), t.crossDomain || i["X-Requested-With"] || (i["X-Requested-With"] = "XMLHttpRequest");
                            for (o in i)s.setRequestHeader(o, i[o]);
                            n = function (e) {
                                return function () {
                                    n && (n = r = s.onload = s.onerror = s.onabort = s.onreadystatechange = null, "abort" === e ? s.abort() : "error" === e ? "number" != typeof s.status ? a(0, "error") : a(s.status, s.statusText) : a(Ft[s.status] || s.status, s.statusText, "text" !== (s.responseType || "text") || "string" != typeof s.responseText ? {binary: s.response} : {text: s.responseText}, s.getAllResponseHeaders()))
                                }
                            }, s.onload = n(), r = s.onerror = n("error"), void 0 !== s.onabort ? s.onabort = r : s.onreadystatechange = function () {
                                    4 === s.readyState && e.setTimeout(function () {
                                        n && r()
                                    })
                                }, n = n("abort");
                            try {
                                s.send(t.hasContent && t.data || null)
                            } catch (e) {
                                if (n)throw e
                            }
                        }, abort: function () {
                            n && n()
                        }
                    }
                }), he.ajaxPrefilter(function (e) {
                    e.crossDomain && (e.contents.script = !1)
                }), he.ajaxSetup({
                    accepts: {script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},
                    contents: {script: /\b(?:java|ecma)script\b/},
                    converters: {
                        "text script": function (e) {
                            return he.globalEval(e), e
                        }
                    }
                }), he.ajaxPrefilter("script", function (e) {
                    void 0 === e.cache && (e.cache = !1), e.crossDomain && (e.type = "GET")
                }), he.ajaxTransport("script", function (e) {
                    if (e.crossDomain) {
                        var t, n;
                        return {
                            send: function (r, i) {
                                t = he("<script>").prop({
                                    charset: e.scriptCharset,
                                    src: e.url
                                }).on("load error", n = function (e) {
                                    t.remove(), n = null, e && i("error" === e.type ? 404 : 200, e.type)
                                }), ne.head.appendChild(t[0])
                            }, abort: function () {
                                n && n()
                            }
                        }
                    }
                });
                var Xt = [], Yt = /(=)\?(?=&|$)|\?\?/;
                he.ajaxSetup({
                    jsonp: "callback", jsonpCallback: function () {
                        var e = Xt.pop() || he.expando + "_" + St++;
                        return this[e] = !0, e
                    }
                }), he.ajaxPrefilter("json jsonp", function (t, n, r) {
                    var i, a, o, s = !1 !== t.jsonp && (Yt.test(t.url) ? "url" : "string" == typeof t.data && 0 === (t.contentType || "").indexOf("application/x-www-form-urlencoded") && Yt.test(t.data) && "data");
                    if (s || "jsonp" === t.dataTypes[0])return i = t.jsonpCallback = he.isFunction(t.jsonpCallback) ? t.jsonpCallback() : t.jsonpCallback, s ? t[s] = t[s].replace(Yt, "$1" + i) : !1 !== t.jsonp && (t.url += (Et.test(t.url) ? "&" : "?") + t.jsonp + "=" + i), t.converters["script json"] = function () {
                        return o || he.error(i + " was not called"), o[0]
                    }, t.dataTypes[0] = "json", a = e[i], e[i] = function () {
                        o = arguments
                    }, r.always(function () {
                        void 0 === a ? he(e).removeProp(i) : e[i] = a, t[i] && (t.jsonpCallback = n.jsonpCallback, Xt.push(i)), o && he.isFunction(a) && a(o[0]), o = a = void 0
                    }), "script"
                }), fe.createHTMLDocument = function () {
                    var e = ne.implementation.createHTMLDocument("").body;
                    return e.innerHTML = "<form></form><form></form>", 2 === e.childNodes.length
                }(), he.parseHTML = function (e, t, n) {
                    if ("string" != typeof e)return [];
                    "boolean" == typeof t && (n = t, t = !1);
                    var r, i, a;
                    return t || (fe.createHTMLDocument ? (t = ne.implementation.createHTMLDocument(""), r = t.createElement("base"), r.href = ne.location.href, t.head.appendChild(r)) : t = ne), i = Ce.exec(e), a = !n && [], i ? [t.createElement(i[1])] : (i = w([e], t, a), a && a.length && he(a).remove(), he.merge([], i.childNodes))
                }, he.fn.load = function (e, t, n) {
                    var r, i, a, o = this, s = e.indexOf(" ");
                    return s > -1 && (r = _(e.slice(s)), e = e.slice(0, s)), he.isFunction(t) ? (n = t, t = void 0): t
                    &&
                    "object" == typeof t && (i = "POST"), o.length > 0 && he.ajax({
                        url: e,
                        type: i || "GET",
                        dataType: "html",
                        data: t
                    }).done(function (e) {
                        a = arguments, o.html(r ? he("<div>").append(he.parseHTML(e)).find(r) : e)
                    }).always(n && function (e, t) {
                            o.each(function () {
                                n.apply(this, a || [e.responseText, t, e])
                            })
                        }), this
                }, he.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function (e, t) {
                    he.fn[t] = function (e) {
                        return this.on(t, e)
                    }
                }), he.expr.pseudos.animated = function (e) {
                    return he.grep(he.timers, function (t) {
                        return e === t.elem
                    }).length
                }, he.offset = {
                    setOffset: function (e, t, n) {
                        var r, i, a, o, s, l, u, c = he.css(e, "position"), p = he(e), d = {};
                        "static" === c && (e.style.position = "relative"), s = p.offset(), a = he.css(e, "top"), l = he.css(e, "left"), u = ("absolute" === c || "fixed" === c) && (a + l).indexOf("auto") > -1, u ? (r = p.position(), o = r.top, i = r.left) : (o = parseFloat(a) || 0, i = parseFloat(l) || 0), he.isFunction(t) && (t = t.call(e, n, he.extend({}, s))), null != t.top && (d.top = t.top - s.top + o), null != t.left && (d.left = t.left - s.left + i), "using" in t ? t.using.call(e, d) : p.css(d)
                    }
                }, he.fn.extend({
                    offset: function (e) {
                        if (arguments.length)return void 0 === e ? this : this.each(function (t) {
                                he.offset.setOffset(this, e, t)
                            });
                        var t, n, r, i, a = this[0];
                        if (a)return a.getClientRects().length ? (r = a.getBoundingClientRect(), t = a.ownerDocument, n = t.documentElement, i = t.defaultView, {
                                top: r.top + i.pageYOffset - n.clientTop,
                                left: r.left + i.pageXOffset - n.clientLeft
                            }) : {top: 0, left: 0}
                    }, position: function () {
                        if (this[0]) {
                            var e, t, n = this[0], r = {top: 0, left: 0};
                            return "fixed" === he.css(n, "position") ? t = n.getBoundingClientRect() : (e = this.offsetParent(), t = this.offset(), i(e[0], "html") || (r = e.offset()), r = {
                                    top: r.top + he.css(e[0], "borderTopWidth", !0),
                                    left: r.left + he.css(e[0], "borderLeftWidth", !0)
                                }), {
                                top: t.top - r.top - he.css(n, "marginTop", !0),
                                left: t.left - r.left - he.css(n, "marginLeft", !0)
                            }
                        }
                    }, offsetParent: function () {
                        return this.map(function () {
                            for (var e = this.offsetParent; e && "static" === he.css(e, "position");)e = e.offsetParent;
                            return e || Ue
                        })
                    }
                }), he.each({scrollLeft: "pageXOffset", scrollTop: "pageYOffset"}, function (e, t) {
                    var n = "pageYOffset" === t;
                    he.fn[e] = function (r) {
                        return Pe(this, function (e, r, i) {
                            var a;
                            if (he.isWindow(e) ? a = e : 9 === e.nodeType && (a = e.defaultView), void 0 === i)return a ? a[t] : e[r];
                            a ? a.scrollTo(n ? a.pageXOffset : i, n ? i : a.pageYOffset) : e[r] = i
                        }, e, r, arguments.length)
                    }
                }), he.each(["top", "left"], function (e, t) {
                    he.cssHooks[t] = z(fe.pixelPosition, function (e, n) {
                        if (n)return n = P(e, t), at.test(n) ? he(e).position()[t] + "px" : n
                    })
                }), he.each({Height: "height", Width: "width"}, function (e, t) {
                    he.each({padding: "inner" + e, content: t, "": "outer" + e}, function (n, r) {
                        he.fn[r] = function (i, a) {
                            var o = arguments.length && (n || "boolean" != typeof i), s = n || (!0 === i || !0 === a ? "margin" : "border");
                            return Pe(this, function (t, n, i) {
                                var a;
                                return he.isWindow(t) ? 0 === r.indexOf("outer") ? t["inner" + e] : t.document.documentElement["client" + e] : 9 === t.nodeType ? (a = t.documentElement, Math.max(t.body["scroll" + e], a["scroll" + e], t.body["offset" + e], a["offset" + e], a["client" + e])) : void 0 === i ? he.css(t, n, s) : he.style(t, n, i, s)
                            }, t, o ? i : void 0, o)
                        }
                    })
                }), he.fn.extend({
                    bind: function (e, t, n) {
                        return this.on(e, null, t, n)
                    }, unbind: function (e, t) {
                        return this.off(e, null, t)
                    }, delegate: function (e, t, n, r) {
                        return this.on(t, e, n, r)
                    }, undelegate: function (e, t, n) {
                        return 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", n)
                    }
                }), he.holdReady = function (e) {
                    e ? he.readyWait++ : he.ready(!0)
                }, he.isArray = Array.isArray, he.parseJSON = JSON.parse, he.nodeName = i, "function" == typeof define && define.amd && define("jquery", [], function () {
                    return he
                });
                var Gt = e.jQuery, $t = e.$;
                return he.noConflict = function (t) {
                    return e.$ === he && (e.$ = $t), t && e.jQuery === he && (e.jQuery = Gt), he
                }, t || (e.jQuery = e.$ = he), he
            })
        }, {}]
    }, {}, [2]);
}

(function (root, factory) {
    if (typeof define === 'function' && define.amd) {
        //AMD
        define(factory);
    } else if (typeof exports === 'object') {
        //Node, CommonJS之类的
        module.exports = factory();
    } else {
        //浏览器全局变量(root 即 window)
        root.resLoader = factory(root);
    }
}(this, function () {
    var isFunc = function(f){
        return typeof f === 'function';
    }
    //构造器函数
    function resLoader(config){
        this.option = {
            resourceType : 'image', //资源类型，默认为图片
            baseUrl : './', //基准url
            resources : [], //资源路径数组
            onStart : null, //加载开始回调函数，传入参数total
            onProgress : null, //正在加载回调函数，传入参数currentIndex, total
            onComplete : null //加载完毕回调函数，传入参数total
        }
        if(config){
            for(i in config){
                this.option[i] = config[i];
            }
        }
        else{
            alert('参数错误！');
            return;
        }
        this.status = 0; //加载器的状态，0：未启动   1：正在加载   2：加载完毕
        this.total = this.option.resources.length || 0; //资源总数
        this.currentIndex = 0; //当前正在加载的资源索引
    };

    resLoader.prototype.start = function(){
        this.status = 1;
        var _this = this;
        var baseUrl = this.option.baseUrl;
        for(var i=0,l=this.option.resources.length; i<l; i++){
            var r = this.option.resources[i], url = '';
            if(r.indexOf('http://')===0 || r.indexOf('https://')===0){
                url = r;
            }
            else{
                url = baseUrl + r;
            }

            var image = new Image();
            image.onload = function(){_this.loaded();};
            image.onerror = function(){_this.loaded();};
            image.src = url;
        }
        if(isFunc(this.option.onStart)){
            this.option.onStart(this.total);
        }
    }

    resLoader.prototype.loaded = function(){
        if(isFunc(this.option.onProgress)){
            this.option.onProgress(++this.currentIndex, this.total);
        }
        //加载完毕
        if(this.currentIndex===this.total){
            if(isFunc(this.option.onComplete)){
                this.option.onComplete(this.total);
            }
        }
    }

    //暴露公共方法
    return resLoader;
}));
// window.addEventListener("DOMContentLoaded", function () {
//     $('.audo_bgm')[0].play();
//     alert(1)
// });


$(function(){
    var loadList = [];
    $('.looding_list em').each(function () {
        loadList.push($(this).attr('data-src'));
    });
    var loader = new resLoader({
        resources : loadList,
        onStart : function(total){
            //console.log('start:'+total);
        },
        onProgress : function(current, total){
            //console.log(current+'/'+total);
            $('.looding_num').html(parseInt(current/total*100)+'%')
        },
        onComplete : function(total){
            subject();
            $('.looding').hide();
            $('.audo_bgm')[0].play();
            document.addEventListener("WeixinJSBridgeReady", function () {
                $('.audo_bgm')[0].play();
            }, false);

        }
    });

    loader.start();
    var wxShearUrl = encodeURIComponent(window.location.href.split("#")[0]);
    wxShare(wxShearUrl, "uzhuang",0)
});



