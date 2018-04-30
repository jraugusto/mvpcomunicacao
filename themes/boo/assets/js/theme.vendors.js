/*!
* Themerella
*
* (c) Copyright themerella.com
*
* @version 1.0.0
* @author  Themerella
*/



(function(t) {
    "function" == typeof define && define.amd ? define([ "jquery" ], t) : t(jQuery);
})(function(t) {
    function e(t) {
        for (var e, i; t.length && t[0] !== document; ) {
            if (e = t.css("position"), ("absolute" === e || "relative" === e || "fixed" === e) && (i = parseInt(t.css("zIndex"), 10), 
            !isNaN(i) && 0 !== i)) return i;
            t = t.parent();
        }
        return 0;
    }
    function i() {
        this._curInst = null, this._keyEvent = !1, this._disabledInputs = [], this._datepickerShowing = !1, 
        this._inDialog = !1, this._mainDivId = "ui-datepicker-div", this._inlineClass = "ui-datepicker-inline", 
        this._appendClass = "ui-datepicker-append", this._triggerClass = "ui-datepicker-trigger", 
        this._dialogClass = "ui-datepicker-dialog", this._disableClass = "ui-datepicker-disabled", 
        this._unselectableClass = "ui-datepicker-unselectable", this._currentClass = "ui-datepicker-current-day", 
        this._dayOverClass = "ui-datepicker-days-cell-over", this.regional = [], this.regional[""] = {
            closeText: "Done",
            prevText: "Prev",
            nextText: "Next",
            currentText: "Today",
            monthNames: [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ],
            monthNamesShort: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ],
            dayNames: [ "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday" ],
            dayNamesShort: [ "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat" ],
            dayNamesMin: [ "Su", "Mo", "Tu", "We", "Th", "Fr", "Sa" ],
            weekHeader: "Wk",
            dateFormat: "mm/dd/yy",
            firstDay: 0,
            isRTL: !1,
            showMonthAfterYear: !1,
            yearSuffix: ""
        }, this._defaults = {
            showOn: "focus",
            showAnim: "fadeIn",
            showOptions: {},
            defaultDate: null,
            appendText: "",
            buttonText: "...",
            buttonImage: "",
            buttonImageOnly: !1,
            hideIfNoPrevNext: !1,
            navigationAsDateFormat: !1,
            gotoCurrent: !1,
            changeMonth: !1,
            changeYear: !1,
            yearRange: "c-10:c+10",
            showOtherMonths: !1,
            selectOtherMonths: !1,
            showWeek: !1,
            calculateWeek: this.iso8601Week,
            shortYearCutoff: "+10",
            minDate: null,
            maxDate: null,
            duration: "fast",
            beforeShowDay: null,
            beforeShow: null,
            onSelect: null,
            onChangeMonthYear: null,
            onClose: null,
            numberOfMonths: 1,
            showCurrentAtPos: 0,
            stepMonths: 1,
            stepBigMonths: 12,
            altField: "",
            altFormat: "",
            constrainInput: !0,
            showButtonPanel: !1,
            autoSize: !1,
            disabled: !1
        }, t.extend(this._defaults, this.regional[""]), this.regional.en = t.extend(!0, {}, this.regional[""]), 
        this.regional["en-US"] = t.extend(!0, {}, this.regional.en), this.dpDiv = s(t("<div id='" + this._mainDivId + "' class='ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>"));
    }
    function s(e) {
        var i = "button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a";
        return e.on("mouseout", i, function() {
            t(this).removeClass("ui-state-hover"), -1 !== this.className.indexOf("ui-datepicker-prev") && t(this).removeClass("ui-datepicker-prev-hover"), 
            -1 !== this.className.indexOf("ui-datepicker-next") && t(this).removeClass("ui-datepicker-next-hover");
        }).on("mouseover", i, n);
    }
    function n() {
        t.datepicker._isDisabledDatepicker(d.inline ? d.dpDiv.parent()[0] : d.input[0]) || (t(this).parents(".ui-datepicker-calendar").find("a").removeClass("ui-state-hover"), 
        t(this).addClass("ui-state-hover"), -1 !== this.className.indexOf("ui-datepicker-prev") && t(this).addClass("ui-datepicker-prev-hover"), 
        -1 !== this.className.indexOf("ui-datepicker-next") && t(this).addClass("ui-datepicker-next-hover"));
    }
    function o(e, i) {
        t.extend(e, i);
        for (var s in i) null == i[s] && (e[s] = i[s]);
        return e;
    }
    function a(t) {
        return function() {
            var e = this.element.val();
            t.apply(this, arguments), this._refresh(), e !== this.element.val() && this._trigger("change");
        };
    }
    t.ui = t.ui || {}, t.ui.version = "1.12.1";
    var r = 0, l = Array.prototype.slice;
    t.cleanData = function(e) {
        return function(i) {
            var s, n, o;
            for (o = 0; null != (n = i[o]); o++) try {
                s = t._data(n, "events"), s && s.remove && t(n).triggerHandler("remove");
            } catch (a) {}
            e(i);
        };
    }(t.cleanData), t.widget = function(e, i, s) {
        var n, o, a, r = {}, l = e.split(".")[0];
        e = e.split(".")[1];
        var h = l + "-" + e;
        return s || (s = i, i = t.Widget), t.isArray(s) && (s = t.extend.apply(null, [ {} ].concat(s))), 
        t.expr[":"][h.toLowerCase()] = function(e) {
            return !!t.data(e, h);
        }, t[l] = t[l] || {}, n = t[l][e], o = t[l][e] = function(t, e) {
            return this._createWidget ? (arguments.length && this._createWidget(t, e), void 0) : new o(t, e);
        }, t.extend(o, n, {
            version: s.version,
            _proto: t.extend({}, s),
            _childConstructors: []
        }), a = new i(), a.options = t.widget.extend({}, a.options), t.each(s, function(e, s) {
            return t.isFunction(s) ? (r[e] = function() {
                function t() {
                    return i.prototype[e].apply(this, arguments);
                }
                function n(t) {
                    return i.prototype[e].apply(this, t);
                }
                return function() {
                    var e, i = this._super, o = this._superApply;
                    return this._super = t, this._superApply = n, e = s.apply(this, arguments), this._super = i, 
                    this._superApply = o, e;
                };
            }(), void 0) : (r[e] = s, void 0);
        }), o.prototype = t.widget.extend(a, {
            widgetEventPrefix: n ? a.widgetEventPrefix || e : e
        }, r, {
            constructor: o,
            namespace: l,
            widgetName: e,
            widgetFullName: h
        }), n ? (t.each(n._childConstructors, function(e, i) {
            var s = i.prototype;
            t.widget(s.namespace + "." + s.widgetName, o, i._proto);
        }), delete n._childConstructors) : i._childConstructors.push(o), t.widget.bridge(e, o), 
        o;
    }, t.widget.extend = function(e) {
        for (var i, s, n = l.call(arguments, 1), o = 0, a = n.length; a > o; o++) for (i in n[o]) s = n[o][i], 
        n[o].hasOwnProperty(i) && void 0 !== s && (e[i] = t.isPlainObject(s) ? t.isPlainObject(e[i]) ? t.widget.extend({}, e[i], s) : t.widget.extend({}, s) : s);
        return e;
    }, t.widget.bridge = function(e, i) {
        var s = i.prototype.widgetFullName || e;
        t.fn[e] = function(n) {
            var o = "string" == typeof n, a = l.call(arguments, 1), r = this;
            return o ? this.length || "instance" !== n ? this.each(function() {
                var i, o = t.data(this, s);
                return "instance" === n ? (r = o, !1) : o ? t.isFunction(o[n]) && "_" !== n.charAt(0) ? (i = o[n].apply(o, a), 
                i !== o && void 0 !== i ? (r = i && i.jquery ? r.pushStack(i.get()) : i, !1) : void 0) : t.error("no such method '" + n + "' for " + e + " widget instance") : t.error("cannot call methods on " + e + " prior to initialization; " + "attempted to call method '" + n + "'");
            }) : r = void 0 : (a.length && (n = t.widget.extend.apply(null, [ n ].concat(a))), 
            this.each(function() {
                var e = t.data(this, s);
                e ? (e.option(n || {}), e._init && e._init()) : t.data(this, s, new i(n, this));
            })), r;
        };
    }, t.Widget = function() {}, t.Widget._childConstructors = [], t.Widget.prototype = {
        widgetName: "widget",
        widgetEventPrefix: "",
        defaultElement: "<div>",
        options: {
            classes: {},
            disabled: !1,
            create: null
        },
        _createWidget: function(e, i) {
            i = t(i || this.defaultElement || this)[0], this.element = t(i), this.uuid = r++, 
            this.eventNamespace = "." + this.widgetName + this.uuid, this.bindings = t(), this.hoverable = t(), 
            this.focusable = t(), this.classesElementLookup = {}, i !== this && (t.data(i, this.widgetFullName, this), 
            this._on(!0, this.element, {
                remove: function(t) {
                    t.target === i && this.destroy();
                }
            }), this.document = t(i.style ? i.ownerDocument : i.document || i), this.window = t(this.document[0].defaultView || this.document[0].parentWindow)), 
            this.options = t.widget.extend({}, this.options, this._getCreateOptions(), e), this._create(), 
            this.options.disabled && this._setOptionDisabled(this.options.disabled), this._trigger("create", null, this._getCreateEventData()), 
            this._init();
        },
        _getCreateOptions: function() {
            return {};
        },
        _getCreateEventData: t.noop,
        _create: t.noop,
        _init: t.noop,
        destroy: function() {
            var e = this;
            this._destroy(), t.each(this.classesElementLookup, function(t, i) {
                e._removeClass(i, t);
            }), this.element.off(this.eventNamespace).removeData(this.widgetFullName), this.widget().off(this.eventNamespace).removeAttr("aria-disabled"), 
            this.bindings.off(this.eventNamespace);
        },
        _destroy: t.noop,
        widget: function() {
            return this.element;
        },
        option: function(e, i) {
            var s, n, o, a = e;
            if (0 === arguments.length) return t.widget.extend({}, this.options);
            if ("string" == typeof e) if (a = {}, s = e.split("."), e = s.shift(), s.length) {
                for (n = a[e] = t.widget.extend({}, this.options[e]), o = 0; s.length - 1 > o; o++) n[s[o]] = n[s[o]] || {}, 
                n = n[s[o]];
                if (e = s.pop(), 1 === arguments.length) return void 0 === n[e] ? null : n[e];
                n[e] = i;
            } else {
                if (1 === arguments.length) return void 0 === this.options[e] ? null : this.options[e];
                a[e] = i;
            }
            return this._setOptions(a), this;
        },
        _setOptions: function(t) {
            var e;
            for (e in t) this._setOption(e, t[e]);
            return this;
        },
        _setOption: function(t, e) {
            return "classes" === t && this._setOptionClasses(e), this.options[t] = e, "disabled" === t && this._setOptionDisabled(e), 
            this;
        },
        _setOptionClasses: function(e) {
            var i, s, n;
            for (i in e) n = this.classesElementLookup[i], e[i] !== this.options.classes[i] && n && n.length && (s = t(n.get()), 
            this._removeClass(n, i), s.addClass(this._classes({
                element: s,
                keys: i,
                classes: e,
                add: !0
            })));
        },
        _setOptionDisabled: function(t) {
            this._toggleClass(this.widget(), this.widgetFullName + "-disabled", null, !!t), 
            t && (this._removeClass(this.hoverable, null, "ui-state-hover"), this._removeClass(this.focusable, null, "ui-state-focus"));
        },
        enable: function() {
            return this._setOptions({
                disabled: !1
            });
        },
        disable: function() {
            return this._setOptions({
                disabled: !0
            });
        },
        _classes: function(e) {
            function i(i, o) {
                var a, r;
                for (r = 0; i.length > r; r++) a = n.classesElementLookup[i[r]] || t(), a = e.add ? t(t.unique(a.get().concat(e.element.get()))) : t(a.not(e.element).get()), 
                n.classesElementLookup[i[r]] = a, s.push(i[r]), o && e.classes[i[r]] && s.push(e.classes[i[r]]);
            }
            var s = [], n = this;
            return e = t.extend({
                element: this.element,
                classes: this.options.classes || {}
            }, e), this._on(e.element, {
                remove: "_untrackClassesElement"
            }), e.keys && i(e.keys.match(/\S+/g) || [], !0), e.extra && i(e.extra.match(/\S+/g) || []), 
            s.join(" ");
        },
        _untrackClassesElement: function(e) {
            var i = this;
            t.each(i.classesElementLookup, function(s, n) {
                -1 !== t.inArray(e.target, n) && (i.classesElementLookup[s] = t(n.not(e.target).get()));
            });
        },
        _removeClass: function(t, e, i) {
            return this._toggleClass(t, e, i, !1);
        },
        _addClass: function(t, e, i) {
            return this._toggleClass(t, e, i, !0);
        },
        _toggleClass: function(t, e, i, s) {
            s = "boolean" == typeof s ? s : i;
            var n = "string" == typeof t || null === t, o = {
                extra: n ? e : i,
                keys: n ? t : e,
                element: n ? this.element : t,
                add: s
            };
            return o.element.toggleClass(this._classes(o), s), this;
        },
        _on: function(e, i, s) {
            var n, o = this;
            "boolean" != typeof e && (s = i, i = e, e = !1), s ? (i = n = t(i), this.bindings = this.bindings.add(i)) : (s = i, 
            i = this.element, n = this.widget()), t.each(s, function(s, a) {
                function r() {
                    return e || o.options.disabled !== !0 && !t(this).hasClass("ui-state-disabled") ? ("string" == typeof a ? o[a] : a).apply(o, arguments) : void 0;
                }
                "string" != typeof a && (r.guid = a.guid = a.guid || r.guid || t.guid++);
                var l = s.match(/^([\w:-]*)\s*(.*)$/), h = l[1] + o.eventNamespace, c = l[2];
                c ? n.on(h, c, r) : i.on(h, r);
            });
        },
        _off: function(e, i) {
            i = (i || "").split(" ").join(this.eventNamespace + " ") + this.eventNamespace, 
            e.off(i).off(i), this.bindings = t(this.bindings.not(e).get()), this.focusable = t(this.focusable.not(e).get()), 
            this.hoverable = t(this.hoverable.not(e).get());
        },
        _delay: function(t, e) {
            function i() {
                return ("string" == typeof t ? s[t] : t).apply(s, arguments);
            }
            var s = this;
            return setTimeout(i, e || 0);
        },
        _hoverable: function(e) {
            this.hoverable = this.hoverable.add(e), this._on(e, {
                mouseenter: function(e) {
                    this._addClass(t(e.currentTarget), null, "ui-state-hover");
                },
                mouseleave: function(e) {
                    this._removeClass(t(e.currentTarget), null, "ui-state-hover");
                }
            });
        },
        _focusable: function(e) {
            this.focusable = this.focusable.add(e), this._on(e, {
                focusin: function(e) {
                    this._addClass(t(e.currentTarget), null, "ui-state-focus");
                },
                focusout: function(e) {
                    this._removeClass(t(e.currentTarget), null, "ui-state-focus");
                }
            });
        },
        _trigger: function(e, i, s) {
            var n, o, a = this.options[e];
            if (s = s || {}, i = t.Event(i), i.type = (e === this.widgetEventPrefix ? e : this.widgetEventPrefix + e).toLowerCase(), 
            i.target = this.element[0], o = i.originalEvent) for (n in o) n in i || (i[n] = o[n]);
            return this.element.trigger(i, s), !(t.isFunction(a) && a.apply(this.element[0], [ i ].concat(s)) === !1 || i.isDefaultPrevented());
        }
    }, t.each({
        show: "fadeIn",
        hide: "fadeOut"
    }, function(e, i) {
        t.Widget.prototype["_" + e] = function(s, n, o) {
            "string" == typeof n && (n = {
                effect: n
            });
            var a, r = n ? n === !0 || "number" == typeof n ? i : n.effect || i : e;
            n = n || {}, "number" == typeof n && (n = {
                duration: n
            }), a = !t.isEmptyObject(n), n.complete = o, n.delay && s.delay(n.delay), a && t.effects && t.effects.effect[r] ? s[e](n) : r !== e && s[r] ? s[r](n.duration, n.easing, o) : s.queue(function(i) {
                t(this)[e](), o && o.call(s[0]), i();
            });
        };
    }), t.widget, function() {
        function e(t, e, i) {
            return [ parseFloat(t[0]) * (u.test(t[0]) ? e / 100 : 1), parseFloat(t[1]) * (u.test(t[1]) ? i / 100 : 1) ];
        }
        function i(e, i) {
            return parseInt(t.css(e, i), 10) || 0;
        }
        function s(e) {
            var i = e[0];
            return 9 === i.nodeType ? {
                width: e.width(),
                height: e.height(),
                offset: {
                    top: 0,
                    left: 0
                }
            } : t.isWindow(i) ? {
                width: e.width(),
                height: e.height(),
                offset: {
                    top: e.scrollTop(),
                    left: e.scrollLeft()
                }
            } : i.preventDefault ? {
                width: 0,
                height: 0,
                offset: {
                    top: i.pageY,
                    left: i.pageX
                }
            } : {
                width: e.outerWidth(),
                height: e.outerHeight(),
                offset: e.offset()
            };
        }
        var n, o = Math.max, a = Math.abs, r = /left|center|right/, l = /top|center|bottom/, h = /[\+\-]\d+(\.[\d]+)?%?/, c = /^\w+/, u = /%$/, d = t.fn.position;
        t.position = {
            scrollbarWidth: function() {
                if (void 0 !== n) return n;
                var e, i, s = t("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"), o = s.children()[0];
                return t("body").append(s), e = o.offsetWidth, s.css("overflow", "scroll"), i = o.offsetWidth, 
                e === i && (i = s[0].clientWidth), s.remove(), n = e - i;
            },
            getScrollInfo: function(e) {
                var i = e.isWindow || e.isDocument ? "" : e.element.css("overflow-x"), s = e.isWindow || e.isDocument ? "" : e.element.css("overflow-y"), n = "scroll" === i || "auto" === i && e.width < e.element[0].scrollWidth, o = "scroll" === s || "auto" === s && e.height < e.element[0].scrollHeight;
                return {
                    width: o ? t.position.scrollbarWidth() : 0,
                    height: n ? t.position.scrollbarWidth() : 0
                };
            },
            getWithinInfo: function(e) {
                var i = t(e || window), s = t.isWindow(i[0]), n = !!i[0] && 9 === i[0].nodeType, o = !s && !n;
                return {
                    element: i,
                    isWindow: s,
                    isDocument: n,
                    offset: o ? t(e).offset() : {
                        left: 0,
                        top: 0
                    },
                    scrollLeft: i.scrollLeft(),
                    scrollTop: i.scrollTop(),
                    width: i.outerWidth(),
                    height: i.outerHeight()
                };
            }
        }, t.fn.position = function(n) {
            if (!n || !n.of) return d.apply(this, arguments);
            n = t.extend({}, n);
            var u, p, f, g, m, _, v = t(n.of), b = t.position.getWithinInfo(n.within), y = t.position.getScrollInfo(b), w = (n.collision || "flip").split(" "), k = {};
            return _ = s(v), v[0].preventDefault && (n.at = "left top"), p = _.width, f = _.height, 
            g = _.offset, m = t.extend({}, g), t.each([ "my", "at" ], function() {
                var t, e, i = (n[this] || "").split(" ");
                1 === i.length && (i = r.test(i[0]) ? i.concat([ "center" ]) : l.test(i[0]) ? [ "center" ].concat(i) : [ "center", "center" ]), 
                i[0] = r.test(i[0]) ? i[0] : "center", i[1] = l.test(i[1]) ? i[1] : "center", t = h.exec(i[0]), 
                e = h.exec(i[1]), k[this] = [ t ? t[0] : 0, e ? e[0] : 0 ], n[this] = [ c.exec(i[0])[0], c.exec(i[1])[0] ];
            }), 1 === w.length && (w[1] = w[0]), "right" === n.at[0] ? m.left += p : "center" === n.at[0] && (m.left += p / 2), 
            "bottom" === n.at[1] ? m.top += f : "center" === n.at[1] && (m.top += f / 2), u = e(k.at, p, f), 
            m.left += u[0], m.top += u[1], this.each(function() {
                var s, r, l = t(this), h = l.outerWidth(), c = l.outerHeight(), d = i(this, "marginLeft"), _ = i(this, "marginTop"), x = h + d + i(this, "marginRight") + y.width, C = c + _ + i(this, "marginBottom") + y.height, D = t.extend({}, m), T = e(k.my, l.outerWidth(), l.outerHeight());
                "right" === n.my[0] ? D.left -= h : "center" === n.my[0] && (D.left -= h / 2), "bottom" === n.my[1] ? D.top -= c : "center" === n.my[1] && (D.top -= c / 2), 
                D.left += T[0], D.top += T[1], s = {
                    marginLeft: d,
                    marginTop: _
                }, t.each([ "left", "top" ], function(e, i) {
                    t.ui.position[w[e]] && t.ui.position[w[e]][i](D, {
                        targetWidth: p,
                        targetHeight: f,
                        elemWidth: h,
                        elemHeight: c,
                        collisionPosition: s,
                        collisionWidth: x,
                        collisionHeight: C,
                        offset: [ u[0] + T[0], u[1] + T[1] ],
                        my: n.my,
                        at: n.at,
                        within: b,
                        elem: l
                    });
                }), n.using && (r = function(t) {
                    var e = g.left - D.left, i = e + p - h, s = g.top - D.top, r = s + f - c, u = {
                        target: {
                            element: v,
                            left: g.left,
                            top: g.top,
                            width: p,
                            height: f
                        },
                        element: {
                            element: l,
                            left: D.left,
                            top: D.top,
                            width: h,
                            height: c
                        },
                        horizontal: 0 > i ? "left" : e > 0 ? "right" : "center",
                        vertical: 0 > r ? "top" : s > 0 ? "bottom" : "middle"
                    };
                    h > p && p > a(e + i) && (u.horizontal = "center"), c > f && f > a(s + r) && (u.vertical = "middle"), 
                    u.important = o(a(e), a(i)) > o(a(s), a(r)) ? "horizontal" : "vertical", n.using.call(this, t, u);
                }), l.offset(t.extend(D, {
                    using: r
                }));
            });
        }, t.ui.position = {
            fit: {
                left: function(t, e) {
                    var i, s = e.within, n = s.isWindow ? s.scrollLeft : s.offset.left, a = s.width, r = t.left - e.collisionPosition.marginLeft, l = n - r, h = r + e.collisionWidth - a - n;
                    e.collisionWidth > a ? l > 0 && 0 >= h ? (i = t.left + l + e.collisionWidth - a - n, 
                    t.left += l - i) : t.left = h > 0 && 0 >= l ? n : l > h ? n + a - e.collisionWidth : n : l > 0 ? t.left += l : h > 0 ? t.left -= h : t.left = o(t.left - r, t.left);
                },
                top: function(t, e) {
                    var i, s = e.within, n = s.isWindow ? s.scrollTop : s.offset.top, a = e.within.height, r = t.top - e.collisionPosition.marginTop, l = n - r, h = r + e.collisionHeight - a - n;
                    e.collisionHeight > a ? l > 0 && 0 >= h ? (i = t.top + l + e.collisionHeight - a - n, 
                    t.top += l - i) : t.top = h > 0 && 0 >= l ? n : l > h ? n + a - e.collisionHeight : n : l > 0 ? t.top += l : h > 0 ? t.top -= h : t.top = o(t.top - r, t.top);
                }
            },
            flip: {
                left: function(t, e) {
                    var i, s, n = e.within, o = n.offset.left + n.scrollLeft, r = n.width, l = n.isWindow ? n.scrollLeft : n.offset.left, h = t.left - e.collisionPosition.marginLeft, c = h - l, u = h + e.collisionWidth - r - l, d = "left" === e.my[0] ? -e.elemWidth : "right" === e.my[0] ? e.elemWidth : 0, p = "left" === e.at[0] ? e.targetWidth : "right" === e.at[0] ? -e.targetWidth : 0, f = -2 * e.offset[0];
                    0 > c ? (i = t.left + d + p + f + e.collisionWidth - r - o, (0 > i || a(c) > i) && (t.left += d + p + f)) : u > 0 && (s = t.left - e.collisionPosition.marginLeft + d + p + f - l, 
                    (s > 0 || u > a(s)) && (t.left += d + p + f));
                },
                top: function(t, e) {
                    var i, s, n = e.within, o = n.offset.top + n.scrollTop, r = n.height, l = n.isWindow ? n.scrollTop : n.offset.top, h = t.top - e.collisionPosition.marginTop, c = h - l, u = h + e.collisionHeight - r - l, d = "top" === e.my[1], p = d ? -e.elemHeight : "bottom" === e.my[1] ? e.elemHeight : 0, f = "top" === e.at[1] ? e.targetHeight : "bottom" === e.at[1] ? -e.targetHeight : 0, g = -2 * e.offset[1];
                    0 > c ? (s = t.top + p + f + g + e.collisionHeight - r - o, (0 > s || a(c) > s) && (t.top += p + f + g)) : u > 0 && (i = t.top - e.collisionPosition.marginTop + p + f + g - l, 
                    (i > 0 || u > a(i)) && (t.top += p + f + g));
                }
            },
            flipfit: {
                left: function() {
                    t.ui.position.flip.left.apply(this, arguments), t.ui.position.fit.left.apply(this, arguments);
                },
                top: function() {
                    t.ui.position.flip.top.apply(this, arguments), t.ui.position.fit.top.apply(this, arguments);
                }
            }
        };
    }(), t.ui.position, t.extend(t.expr[":"], {
        data: t.expr.createPseudo ? t.expr.createPseudo(function(e) {
            return function(i) {
                return !!t.data(i, e);
            };
        }) : function(e, i, s) {
            return !!t.data(e, s[3]);
        }
    }), t.fn.form = function() {
        return "string" == typeof this[0].form ? this.closest("form") : t(this[0].form);
    }, t.ui.formResetMixin = {
        _formResetHandler: function() {
            var e = t(this);
            setTimeout(function() {
                var i = e.data("ui-form-reset-instances");
                t.each(i, function() {
                    this.refresh();
                });
            });
        },
        _bindFormResetHandler: function() {
            if (this.form = this.element.form(), this.form.length) {
                var t = this.form.data("ui-form-reset-instances") || [];
                t.length || this.form.on("reset.ui-form-reset", this._formResetHandler), t.push(this), 
                this.form.data("ui-form-reset-instances", t);
            }
        },
        _unbindFormResetHandler: function() {
            if (this.form.length) {
                var e = this.form.data("ui-form-reset-instances");
                e.splice(t.inArray(this, e), 1), e.length ? this.form.data("ui-form-reset-instances", e) : this.form.removeData("ui-form-reset-instances").off("reset.ui-form-reset");
            }
        }
    }, t.ui.keyCode = {
        BACKSPACE: 8,
        COMMA: 188,
        DELETE: 46,
        DOWN: 40,
        END: 35,
        ENTER: 13,
        ESCAPE: 27,
        HOME: 36,
        LEFT: 37,
        PAGE_DOWN: 34,
        PAGE_UP: 33,
        PERIOD: 190,
        RIGHT: 39,
        SPACE: 32,
        TAB: 9,
        UP: 38
    }, t.ui.escapeSelector = function() {
        var t = /([!"#$%&'()*+,.\/:;<=>?@[\]^`{|}~])/g;
        return function(e) {
            return e.replace(t, "\\$1");
        };
    }(), t.fn.labels = function() {
        var e, i, s, n, o;
        return this[0].labels && this[0].labels.length ? this.pushStack(this[0].labels) : (n = this.eq(0).parents("label"), 
        s = this.attr("id"), s && (e = this.eq(0).parents().last(), o = e.add(e.length ? e.siblings() : this.siblings()), 
        i = "label[for='" + t.ui.escapeSelector(s) + "']", n = n.add(o.find(i).addBack(i))), 
        this.pushStack(n));
    }, t.fn.scrollParent = function(e) {
        var i = this.css("position"), s = "absolute" === i, n = e ? /(auto|scroll|hidden)/ : /(auto|scroll)/, o = this.parents().filter(function() {
            var e = t(this);
            return s && "static" === e.css("position") ? !1 : n.test(e.css("overflow") + e.css("overflow-y") + e.css("overflow-x"));
        }).eq(0);
        return "fixed" !== i && o.length ? o : t(this[0].ownerDocument || document);
    }, t.fn.extend({
        uniqueId: function() {
            var t = 0;
            return function() {
                return this.each(function() {
                    this.id || (this.id = "ui-id-" + ++t);
                });
            };
        }(),
        removeUniqueId: function() {
            return this.each(function() {
                /^ui-id-\d+$/.test(this.id) && t(this).removeAttr("id");
            });
        }
    }), t.ui.ie = !!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase());
    var h = !1;
    t(document).on("mouseup", function() {
        h = !1;
    }), t.widget("ui.mouse", {
        version: "1.12.1",
        options: {
            cancel: "input, textarea, button, select, option",
            distance: 1,
            delay: 0
        },
        _mouseInit: function() {
            var e = this;
            this.element.on("mousedown." + this.widgetName, function(t) {
                return e._mouseDown(t);
            }).on("click." + this.widgetName, function(i) {
                return !0 === t.data(i.target, e.widgetName + ".preventClickEvent") ? (t.removeData(i.target, e.widgetName + ".preventClickEvent"), 
                i.stopImmediatePropagation(), !1) : void 0;
            }), this.started = !1;
        },
        _mouseDestroy: function() {
            this.element.off("." + this.widgetName), this._mouseMoveDelegate && this.document.off("mousemove." + this.widgetName, this._mouseMoveDelegate).off("mouseup." + this.widgetName, this._mouseUpDelegate);
        },
        _mouseDown: function(e) {
            if (!h) {
                this._mouseMoved = !1, this._mouseStarted && this._mouseUp(e), this._mouseDownEvent = e;
                var i = this, s = 1 === e.which, n = "string" == typeof this.options.cancel && e.target.nodeName ? t(e.target).closest(this.options.cancel).length : !1;
                return s && !n && this._mouseCapture(e) ? (this.mouseDelayMet = !this.options.delay, 
                this.mouseDelayMet || (this._mouseDelayTimer = setTimeout(function() {
                    i.mouseDelayMet = !0;
                }, this.options.delay)), this._mouseDistanceMet(e) && this._mouseDelayMet(e) && (this._mouseStarted = this._mouseStart(e) !== !1, 
                !this._mouseStarted) ? (e.preventDefault(), !0) : (!0 === t.data(e.target, this.widgetName + ".preventClickEvent") && t.removeData(e.target, this.widgetName + ".preventClickEvent"), 
                this._mouseMoveDelegate = function(t) {
                    return i._mouseMove(t);
                }, this._mouseUpDelegate = function(t) {
                    return i._mouseUp(t);
                }, this.document.on("mousemove." + this.widgetName, this._mouseMoveDelegate).on("mouseup." + this.widgetName, this._mouseUpDelegate), 
                e.preventDefault(), h = !0, !0)) : !0;
            }
        },
        _mouseMove: function(e) {
            if (this._mouseMoved) {
                if (t.ui.ie && (!document.documentMode || 9 > document.documentMode) && !e.button) return this._mouseUp(e);
                if (!e.which) if (e.originalEvent.altKey || e.originalEvent.ctrlKey || e.originalEvent.metaKey || e.originalEvent.shiftKey) this.ignoreMissingWhich = !0; else if (!this.ignoreMissingWhich) return this._mouseUp(e);
            }
            return (e.which || e.button) && (this._mouseMoved = !0), this._mouseStarted ? (this._mouseDrag(e), 
            e.preventDefault()) : (this._mouseDistanceMet(e) && this._mouseDelayMet(e) && (this._mouseStarted = this._mouseStart(this._mouseDownEvent, e) !== !1, 
            this._mouseStarted ? this._mouseDrag(e) : this._mouseUp(e)), !this._mouseStarted);
        },
        _mouseUp: function(e) {
            this.document.off("mousemove." + this.widgetName, this._mouseMoveDelegate).off("mouseup." + this.widgetName, this._mouseUpDelegate), 
            this._mouseStarted && (this._mouseStarted = !1, e.target === this._mouseDownEvent.target && t.data(e.target, this.widgetName + ".preventClickEvent", !0), 
            this._mouseStop(e)), this._mouseDelayTimer && (clearTimeout(this._mouseDelayTimer), 
            delete this._mouseDelayTimer), this.ignoreMissingWhich = !1, h = !1, e.preventDefault();
        },
        _mouseDistanceMet: function(t) {
            return Math.max(Math.abs(this._mouseDownEvent.pageX - t.pageX), Math.abs(this._mouseDownEvent.pageY - t.pageY)) >= this.options.distance;
        },
        _mouseDelayMet: function() {
            return this.mouseDelayMet;
        },
        _mouseStart: function() {},
        _mouseDrag: function() {},
        _mouseStop: function() {},
        _mouseCapture: function() {
            return !0;
        }
    }), t.ui.plugin = {
        add: function(e, i, s) {
            var n, o = t.ui[e].prototype;
            for (n in s) o.plugins[n] = o.plugins[n] || [], o.plugins[n].push([ i, s[n] ]);
        },
        call: function(t, e, i, s) {
            var n, o = t.plugins[e];
            if (o && (s || t.element[0].parentNode && 11 !== t.element[0].parentNode.nodeType)) for (n = 0; o.length > n; n++) t.options[o[n][0]] && o[n][1].apply(t.element, i);
        }
    }, t.ui.safeActiveElement = function(t) {
        var e;
        try {
            e = t.activeElement;
        } catch (i) {
            e = t.body;
        }
        return e || (e = t.body), e.nodeName || (e = t.body), e;
    }, t.ui.safeBlur = function(e) {
        e && "body" !== e.nodeName.toLowerCase() && t(e).trigger("blur");
    }, t.widget("ui.draggable", t.ui.mouse, {
        version: "1.12.1",
        widgetEventPrefix: "drag",
        options: {
            addClasses: !0,
            appendTo: "parent",
            axis: !1,
            connectToSortable: !1,
            containment: !1,
            cursor: "auto",
            cursorAt: !1,
            grid: !1,
            handle: !1,
            helper: "original",
            iframeFix: !1,
            opacity: !1,
            refreshPositions: !1,
            revert: !1,
            revertDuration: 500,
            scope: "default",
            scroll: !0,
            scrollSensitivity: 20,
            scrollSpeed: 20,
            snap: !1,
            snapMode: "both",
            snapTolerance: 20,
            stack: !1,
            zIndex: !1,
            drag: null,
            start: null,
            stop: null
        },
        _create: function() {
            "original" === this.options.helper && this._setPositionRelative(), this.options.addClasses && this._addClass("ui-draggable"), 
            this._setHandleClassName(), this._mouseInit();
        },
        _setOption: function(t, e) {
            this._super(t, e), "handle" === t && (this._removeHandleClassName(), this._setHandleClassName());
        },
        _destroy: function() {
            return (this.helper || this.element).is(".ui-draggable-dragging") ? (this.destroyOnClear = !0, 
            void 0) : (this._removeHandleClassName(), this._mouseDestroy(), void 0);
        },
        _mouseCapture: function(e) {
            var i = this.options;
            return this.helper || i.disabled || t(e.target).closest(".ui-resizable-handle").length > 0 ? !1 : (this.handle = this._getHandle(e), 
            this.handle ? (this._blurActiveElement(e), this._blockFrames(i.iframeFix === !0 ? "iframe" : i.iframeFix), 
            !0) : !1);
        },
        _blockFrames: function(e) {
            this.iframeBlocks = this.document.find(e).map(function() {
                var e = t(this);
                return t("<div>").css("position", "absolute").appendTo(e.parent()).outerWidth(e.outerWidth()).outerHeight(e.outerHeight()).offset(e.offset())[0];
            });
        },
        _unblockFrames: function() {
            this.iframeBlocks && (this.iframeBlocks.remove(), delete this.iframeBlocks);
        },
        _blurActiveElement: function(e) {
            var i = t.ui.safeActiveElement(this.document[0]), s = t(e.target);
            s.closest(i).length || t.ui.safeBlur(i);
        },
        _mouseStart: function(e) {
            var i = this.options;
            return this.helper = this._createHelper(e), this._addClass(this.helper, "ui-draggable-dragging"), 
            this._cacheHelperProportions(), t.ui.ddmanager && (t.ui.ddmanager.current = this), 
            this._cacheMargins(), this.cssPosition = this.helper.css("position"), this.scrollParent = this.helper.scrollParent(!0), 
            this.offsetParent = this.helper.offsetParent(), this.hasFixedAncestor = this.helper.parents().filter(function() {
                return "fixed" === t(this).css("position");
            }).length > 0, this.positionAbs = this.element.offset(), this._refreshOffsets(e), 
            this.originalPosition = this.position = this._generatePosition(e, !1), this.originalPageX = e.pageX, 
            this.originalPageY = e.pageY, i.cursorAt && this._adjustOffsetFromHelper(i.cursorAt), 
            this._setContainment(), this._trigger("start", e) === !1 ? (this._clear(), !1) : (this._cacheHelperProportions(), 
            t.ui.ddmanager && !i.dropBehaviour && t.ui.ddmanager.prepareOffsets(this, e), this._mouseDrag(e, !0), 
            t.ui.ddmanager && t.ui.ddmanager.dragStart(this, e), !0);
        },
        _refreshOffsets: function(t) {
            this.offset = {
                top: this.positionAbs.top - this.margins.top,
                left: this.positionAbs.left - this.margins.left,
                scroll: !1,
                parent: this._getParentOffset(),
                relative: this._getRelativeOffset()
            }, this.offset.click = {
                left: t.pageX - this.offset.left,
                top: t.pageY - this.offset.top
            };
        },
        _mouseDrag: function(e, i) {
            if (this.hasFixedAncestor && (this.offset.parent = this._getParentOffset()), this.position = this._generatePosition(e, !0), 
            this.positionAbs = this._convertPositionTo("absolute"), !i) {
                var s = this._uiHash();
                if (this._trigger("drag", e, s) === !1) return this._mouseUp(new t.Event("mouseup", e)), 
                !1;
                this.position = s.position;
            }
            return this.helper[0].style.left = this.position.left + "px", this.helper[0].style.top = this.position.top + "px", 
            t.ui.ddmanager && t.ui.ddmanager.drag(this, e), !1;
        },
        _mouseStop: function(e) {
            var i = this, s = !1;
            return t.ui.ddmanager && !this.options.dropBehaviour && (s = t.ui.ddmanager.drop(this, e)), 
            this.dropped && (s = this.dropped, this.dropped = !1), "invalid" === this.options.revert && !s || "valid" === this.options.revert && s || this.options.revert === !0 || t.isFunction(this.options.revert) && this.options.revert.call(this.element, s) ? t(this.helper).animate(this.originalPosition, parseInt(this.options.revertDuration, 10), function() {
                i._trigger("stop", e) !== !1 && i._clear();
            }) : this._trigger("stop", e) !== !1 && this._clear(), !1;
        },
        _mouseUp: function(e) {
            return this._unblockFrames(), t.ui.ddmanager && t.ui.ddmanager.dragStop(this, e), 
            this.handleElement.is(e.target) && this.element.trigger("focus"), t.ui.mouse.prototype._mouseUp.call(this, e);
        },
        cancel: function() {
            return this.helper.is(".ui-draggable-dragging") ? this._mouseUp(new t.Event("mouseup", {
                target: this.element[0]
            })) : this._clear(), this;
        },
        _getHandle: function(e) {
            return this.options.handle ? !!t(e.target).closest(this.element.find(this.options.handle)).length : !0;
        },
        _setHandleClassName: function() {
            this.handleElement = this.options.handle ? this.element.find(this.options.handle) : this.element, 
            this._addClass(this.handleElement, "ui-draggable-handle");
        },
        _removeHandleClassName: function() {
            this._removeClass(this.handleElement, "ui-draggable-handle");
        },
        _createHelper: function(e) {
            var i = this.options, s = t.isFunction(i.helper), n = s ? t(i.helper.apply(this.element[0], [ e ])) : "clone" === i.helper ? this.element.clone().removeAttr("id") : this.element;
            return n.parents("body").length || n.appendTo("parent" === i.appendTo ? this.element[0].parentNode : i.appendTo), 
            s && n[0] === this.element[0] && this._setPositionRelative(), n[0] === this.element[0] || /(fixed|absolute)/.test(n.css("position")) || n.css("position", "absolute"), 
            n;
        },
        _setPositionRelative: function() {
            /^(?:r|a|f)/.test(this.element.css("position")) || (this.element[0].style.position = "relative");
        },
        _adjustOffsetFromHelper: function(e) {
            "string" == typeof e && (e = e.split(" ")), t.isArray(e) && (e = {
                left: +e[0],
                top: +e[1] || 0
            }), "left" in e && (this.offset.click.left = e.left + this.margins.left), "right" in e && (this.offset.click.left = this.helperProportions.width - e.right + this.margins.left), 
            "top" in e && (this.offset.click.top = e.top + this.margins.top), "bottom" in e && (this.offset.click.top = this.helperProportions.height - e.bottom + this.margins.top);
        },
        _isRootNode: function(t) {
            return /(html|body)/i.test(t.tagName) || t === this.document[0];
        },
        _getParentOffset: function() {
            var e = this.offsetParent.offset(), i = this.document[0];
            return "absolute" === this.cssPosition && this.scrollParent[0] !== i && t.contains(this.scrollParent[0], this.offsetParent[0]) && (e.left += this.scrollParent.scrollLeft(), 
            e.top += this.scrollParent.scrollTop()), this._isRootNode(this.offsetParent[0]) && (e = {
                top: 0,
                left: 0
            }), {
                top: e.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
                left: e.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)
            };
        },
        _getRelativeOffset: function() {
            if ("relative" !== this.cssPosition) return {
                top: 0,
                left: 0
            };
            var t = this.element.position(), e = this._isRootNode(this.scrollParent[0]);
            return {
                top: t.top - (parseInt(this.helper.css("top"), 10) || 0) + (e ? 0 : this.scrollParent.scrollTop()),
                left: t.left - (parseInt(this.helper.css("left"), 10) || 0) + (e ? 0 : this.scrollParent.scrollLeft())
            };
        },
        _cacheMargins: function() {
            this.margins = {
                left: parseInt(this.element.css("marginLeft"), 10) || 0,
                top: parseInt(this.element.css("marginTop"), 10) || 0,
                right: parseInt(this.element.css("marginRight"), 10) || 0,
                bottom: parseInt(this.element.css("marginBottom"), 10) || 0
            };
        },
        _cacheHelperProportions: function() {
            this.helperProportions = {
                width: this.helper.outerWidth(),
                height: this.helper.outerHeight()
            };
        },
        _setContainment: function() {
            var e, i, s, n = this.options, o = this.document[0];
            return this.relativeContainer = null, n.containment ? "window" === n.containment ? (this.containment = [ t(window).scrollLeft() - this.offset.relative.left - this.offset.parent.left, t(window).scrollTop() - this.offset.relative.top - this.offset.parent.top, t(window).scrollLeft() + t(window).width() - this.helperProportions.width - this.margins.left, t(window).scrollTop() + (t(window).height() || o.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top ], 
            void 0) : "document" === n.containment ? (this.containment = [ 0, 0, t(o).width() - this.helperProportions.width - this.margins.left, (t(o).height() || o.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top ], 
            void 0) : n.containment.constructor === Array ? (this.containment = n.containment, 
            void 0) : ("parent" === n.containment && (n.containment = this.helper[0].parentNode), 
            i = t(n.containment), s = i[0], s && (e = /(scroll|auto)/.test(i.css("overflow")), 
            this.containment = [ (parseInt(i.css("borderLeftWidth"), 10) || 0) + (parseInt(i.css("paddingLeft"), 10) || 0), (parseInt(i.css("borderTopWidth"), 10) || 0) + (parseInt(i.css("paddingTop"), 10) || 0), (e ? Math.max(s.scrollWidth, s.offsetWidth) : s.offsetWidth) - (parseInt(i.css("borderRightWidth"), 10) || 0) - (parseInt(i.css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left - this.margins.right, (e ? Math.max(s.scrollHeight, s.offsetHeight) : s.offsetHeight) - (parseInt(i.css("borderBottomWidth"), 10) || 0) - (parseInt(i.css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top - this.margins.bottom ], 
            this.relativeContainer = i), void 0) : (this.containment = null, void 0);
        },
        _convertPositionTo: function(t, e) {
            e || (e = this.position);
            var i = "absolute" === t ? 1 : -1, s = this._isRootNode(this.scrollParent[0]);
            return {
                top: e.top + this.offset.relative.top * i + this.offset.parent.top * i - ("fixed" === this.cssPosition ? -this.offset.scroll.top : s ? 0 : this.offset.scroll.top) * i,
                left: e.left + this.offset.relative.left * i + this.offset.parent.left * i - ("fixed" === this.cssPosition ? -this.offset.scroll.left : s ? 0 : this.offset.scroll.left) * i
            };
        },
        _generatePosition: function(t, e) {
            var i, s, n, o, a = this.options, r = this._isRootNode(this.scrollParent[0]), l = t.pageX, h = t.pageY;
            return r && this.offset.scroll || (this.offset.scroll = {
                top: this.scrollParent.scrollTop(),
                left: this.scrollParent.scrollLeft()
            }), e && (this.containment && (this.relativeContainer ? (s = this.relativeContainer.offset(), 
            i = [ this.containment[0] + s.left, this.containment[1] + s.top, this.containment[2] + s.left, this.containment[3] + s.top ]) : i = this.containment, 
            t.pageX - this.offset.click.left < i[0] && (l = i[0] + this.offset.click.left), 
            t.pageY - this.offset.click.top < i[1] && (h = i[1] + this.offset.click.top), t.pageX - this.offset.click.left > i[2] && (l = i[2] + this.offset.click.left), 
            t.pageY - this.offset.click.top > i[3] && (h = i[3] + this.offset.click.top)), a.grid && (n = a.grid[1] ? this.originalPageY + Math.round((h - this.originalPageY) / a.grid[1]) * a.grid[1] : this.originalPageY, 
            h = i ? n - this.offset.click.top >= i[1] || n - this.offset.click.top > i[3] ? n : n - this.offset.click.top >= i[1] ? n - a.grid[1] : n + a.grid[1] : n, 
            o = a.grid[0] ? this.originalPageX + Math.round((l - this.originalPageX) / a.grid[0]) * a.grid[0] : this.originalPageX, 
            l = i ? o - this.offset.click.left >= i[0] || o - this.offset.click.left > i[2] ? o : o - this.offset.click.left >= i[0] ? o - a.grid[0] : o + a.grid[0] : o), 
            "y" === a.axis && (l = this.originalPageX), "x" === a.axis && (h = this.originalPageY)), 
            {
                top: h - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.offset.scroll.top : r ? 0 : this.offset.scroll.top),
                left: l - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.offset.scroll.left : r ? 0 : this.offset.scroll.left)
            };
        },
        _clear: function() {
            this._removeClass(this.helper, "ui-draggable-dragging"), this.helper[0] === this.element[0] || this.cancelHelperRemoval || this.helper.remove(), 
            this.helper = null, this.cancelHelperRemoval = !1, this.destroyOnClear && this.destroy();
        },
        _trigger: function(e, i, s) {
            return s = s || this._uiHash(), t.ui.plugin.call(this, e, [ i, s, this ], !0), /^(drag|start|stop)/.test(e) && (this.positionAbs = this._convertPositionTo("absolute"), 
            s.offset = this.positionAbs), t.Widget.prototype._trigger.call(this, e, i, s);
        },
        plugins: {},
        _uiHash: function() {
            return {
                helper: this.helper,
                position: this.position,
                originalPosition: this.originalPosition,
                offset: this.positionAbs
            };
        }
    }), t.ui.plugin.add("draggable", "connectToSortable", {
        start: function(e, i, s) {
            var n = t.extend({}, i, {
                item: s.element
            });
            s.sortables = [], t(s.options.connectToSortable).each(function() {
                var i = t(this).sortable("instance");
                i && !i.options.disabled && (s.sortables.push(i), i.refreshPositions(), i._trigger("activate", e, n));
            });
        },
        stop: function(e, i, s) {
            var n = t.extend({}, i, {
                item: s.element
            });
            s.cancelHelperRemoval = !1, t.each(s.sortables, function() {
                var t = this;
                t.isOver ? (t.isOver = 0, s.cancelHelperRemoval = !0, t.cancelHelperRemoval = !1, 
                t._storedCSS = {
                    position: t.placeholder.css("position"),
                    top: t.placeholder.css("top"),
                    left: t.placeholder.css("left")
                }, t._mouseStop(e), t.options.helper = t.options._helper) : (t.cancelHelperRemoval = !0, 
                t._trigger("deactivate", e, n));
            });
        },
        drag: function(e, i, s) {
            t.each(s.sortables, function() {
                var n = !1, o = this;
                o.positionAbs = s.positionAbs, o.helperProportions = s.helperProportions, o.offset.click = s.offset.click, 
                o._intersectsWith(o.containerCache) && (n = !0, t.each(s.sortables, function() {
                    return this.positionAbs = s.positionAbs, this.helperProportions = s.helperProportions, 
                    this.offset.click = s.offset.click, this !== o && this._intersectsWith(this.containerCache) && t.contains(o.element[0], this.element[0]) && (n = !1), 
                    n;
                })), n ? (o.isOver || (o.isOver = 1, s._parent = i.helper.parent(), o.currentItem = i.helper.appendTo(o.element).data("ui-sortable-item", !0), 
                o.options._helper = o.options.helper, o.options.helper = function() {
                    return i.helper[0];
                }, e.target = o.currentItem[0], o._mouseCapture(e, !0), o._mouseStart(e, !0, !0), 
                o.offset.click.top = s.offset.click.top, o.offset.click.left = s.offset.click.left, 
                o.offset.parent.left -= s.offset.parent.left - o.offset.parent.left, o.offset.parent.top -= s.offset.parent.top - o.offset.parent.top, 
                s._trigger("toSortable", e), s.dropped = o.element, t.each(s.sortables, function() {
                    this.refreshPositions();
                }), s.currentItem = s.element, o.fromOutside = s), o.currentItem && (o._mouseDrag(e), 
                i.position = o.position)) : o.isOver && (o.isOver = 0, o.cancelHelperRemoval = !0, 
                o.options._revert = o.options.revert, o.options.revert = !1, o._trigger("out", e, o._uiHash(o)), 
                o._mouseStop(e, !0), o.options.revert = o.options._revert, o.options.helper = o.options._helper, 
                o.placeholder && o.placeholder.remove(), i.helper.appendTo(s._parent), s._refreshOffsets(e), 
                i.position = s._generatePosition(e, !0), s._trigger("fromSortable", e), s.dropped = !1, 
                t.each(s.sortables, function() {
                    this.refreshPositions();
                }));
            });
        }
    }), t.ui.plugin.add("draggable", "cursor", {
        start: function(e, i, s) {
            var n = t("body"), o = s.options;
            n.css("cursor") && (o._cursor = n.css("cursor")), n.css("cursor", o.cursor);
        },
        stop: function(e, i, s) {
            var n = s.options;
            n._cursor && t("body").css("cursor", n._cursor);
        }
    }), t.ui.plugin.add("draggable", "opacity", {
        start: function(e, i, s) {
            var n = t(i.helper), o = s.options;
            n.css("opacity") && (o._opacity = n.css("opacity")), n.css("opacity", o.opacity);
        },
        stop: function(e, i, s) {
            var n = s.options;
            n._opacity && t(i.helper).css("opacity", n._opacity);
        }
    }), t.ui.plugin.add("draggable", "scroll", {
        start: function(t, e, i) {
            i.scrollParentNotHidden || (i.scrollParentNotHidden = i.helper.scrollParent(!1)), 
            i.scrollParentNotHidden[0] !== i.document[0] && "HTML" !== i.scrollParentNotHidden[0].tagName && (i.overflowOffset = i.scrollParentNotHidden.offset());
        },
        drag: function(e, i, s) {
            var n = s.options, o = !1, a = s.scrollParentNotHidden[0], r = s.document[0];
            a !== r && "HTML" !== a.tagName ? (n.axis && "x" === n.axis || (s.overflowOffset.top + a.offsetHeight - e.pageY < n.scrollSensitivity ? a.scrollTop = o = a.scrollTop + n.scrollSpeed : e.pageY - s.overflowOffset.top < n.scrollSensitivity && (a.scrollTop = o = a.scrollTop - n.scrollSpeed)), 
            n.axis && "y" === n.axis || (s.overflowOffset.left + a.offsetWidth - e.pageX < n.scrollSensitivity ? a.scrollLeft = o = a.scrollLeft + n.scrollSpeed : e.pageX - s.overflowOffset.left < n.scrollSensitivity && (a.scrollLeft = o = a.scrollLeft - n.scrollSpeed))) : (n.axis && "x" === n.axis || (e.pageY - t(r).scrollTop() < n.scrollSensitivity ? o = t(r).scrollTop(t(r).scrollTop() - n.scrollSpeed) : t(window).height() - (e.pageY - t(r).scrollTop()) < n.scrollSensitivity && (o = t(r).scrollTop(t(r).scrollTop() + n.scrollSpeed))), 
            n.axis && "y" === n.axis || (e.pageX - t(r).scrollLeft() < n.scrollSensitivity ? o = t(r).scrollLeft(t(r).scrollLeft() - n.scrollSpeed) : t(window).width() - (e.pageX - t(r).scrollLeft()) < n.scrollSensitivity && (o = t(r).scrollLeft(t(r).scrollLeft() + n.scrollSpeed)))), 
            o !== !1 && t.ui.ddmanager && !n.dropBehaviour && t.ui.ddmanager.prepareOffsets(s, e);
        }
    }), t.ui.plugin.add("draggable", "snap", {
        start: function(e, i, s) {
            var n = s.options;
            s.snapElements = [], t(n.snap.constructor !== String ? n.snap.items || ":data(ui-draggable)" : n.snap).each(function() {
                var e = t(this), i = e.offset();
                this !== s.element[0] && s.snapElements.push({
                    item: this,
                    width: e.outerWidth(),
                    height: e.outerHeight(),
                    top: i.top,
                    left: i.left
                });
            });
        },
        drag: function(e, i, s) {
            var n, o, a, r, l, h, c, u, d, p, f = s.options, g = f.snapTolerance, m = i.offset.left, _ = m + s.helperProportions.width, v = i.offset.top, b = v + s.helperProportions.height;
            for (d = s.snapElements.length - 1; d >= 0; d--) l = s.snapElements[d].left - s.margins.left, 
            h = l + s.snapElements[d].width, c = s.snapElements[d].top - s.margins.top, u = c + s.snapElements[d].height, 
            l - g > _ || m > h + g || c - g > b || v > u + g || !t.contains(s.snapElements[d].item.ownerDocument, s.snapElements[d].item) ? (s.snapElements[d].snapping && s.options.snap.release && s.options.snap.release.call(s.element, e, t.extend(s._uiHash(), {
                snapItem: s.snapElements[d].item
            })), s.snapElements[d].snapping = !1) : ("inner" !== f.snapMode && (n = g >= Math.abs(c - b), 
            o = g >= Math.abs(u - v), a = g >= Math.abs(l - _), r = g >= Math.abs(h - m), n && (i.position.top = s._convertPositionTo("relative", {
                top: c - s.helperProportions.height,
                left: 0
            }).top), o && (i.position.top = s._convertPositionTo("relative", {
                top: u,
                left: 0
            }).top), a && (i.position.left = s._convertPositionTo("relative", {
                top: 0,
                left: l - s.helperProportions.width
            }).left), r && (i.position.left = s._convertPositionTo("relative", {
                top: 0,
                left: h
            }).left)), p = n || o || a || r, "outer" !== f.snapMode && (n = g >= Math.abs(c - v), 
            o = g >= Math.abs(u - b), a = g >= Math.abs(l - m), r = g >= Math.abs(h - _), n && (i.position.top = s._convertPositionTo("relative", {
                top: c,
                left: 0
            }).top), o && (i.position.top = s._convertPositionTo("relative", {
                top: u - s.helperProportions.height,
                left: 0
            }).top), a && (i.position.left = s._convertPositionTo("relative", {
                top: 0,
                left: l
            }).left), r && (i.position.left = s._convertPositionTo("relative", {
                top: 0,
                left: h - s.helperProportions.width
            }).left)), !s.snapElements[d].snapping && (n || o || a || r || p) && s.options.snap.snap && s.options.snap.snap.call(s.element, e, t.extend(s._uiHash(), {
                snapItem: s.snapElements[d].item
            })), s.snapElements[d].snapping = n || o || a || r || p);
        }
    }), t.ui.plugin.add("draggable", "stack", {
        start: function(e, i, s) {
            var n, o = s.options, a = t.makeArray(t(o.stack)).sort(function(e, i) {
                return (parseInt(t(e).css("zIndex"), 10) || 0) - (parseInt(t(i).css("zIndex"), 10) || 0);
            });
            a.length && (n = parseInt(t(a[0]).css("zIndex"), 10) || 0, t(a).each(function(e) {
                t(this).css("zIndex", n + e);
            }), this.css("zIndex", n + a.length));
        }
    }), t.ui.plugin.add("draggable", "zIndex", {
        start: function(e, i, s) {
            var n = t(i.helper), o = s.options;
            n.css("zIndex") && (o._zIndex = n.css("zIndex")), n.css("zIndex", o.zIndex);
        },
        stop: function(e, i, s) {
            var n = s.options;
            n._zIndex && t(i.helper).css("zIndex", n._zIndex);
        }
    }), t.ui.draggable, t.widget("ui.droppable", {
        version: "1.12.1",
        widgetEventPrefix: "drop",
        options: {
            accept: "*",
            addClasses: !0,
            greedy: !1,
            scope: "default",
            tolerance: "intersect",
            activate: null,
            deactivate: null,
            drop: null,
            out: null,
            over: null
        },
        _create: function() {
            var e, i = this.options, s = i.accept;
            this.isover = !1, this.isout = !0, this.accept = t.isFunction(s) ? s : function(t) {
                return t.is(s);
            }, this.proportions = function() {
                return arguments.length ? (e = arguments[0], void 0) : e ? e : e = {
                    width: this.element[0].offsetWidth,
                    height: this.element[0].offsetHeight
                };
            }, this._addToManager(i.scope), i.addClasses && this._addClass("ui-droppable");
        },
        _addToManager: function(e) {
            t.ui.ddmanager.droppables[e] = t.ui.ddmanager.droppables[e] || [], t.ui.ddmanager.droppables[e].push(this);
        },
        _splice: function(t) {
            for (var e = 0; t.length > e; e++) t[e] === this && t.splice(e, 1);
        },
        _destroy: function() {
            var e = t.ui.ddmanager.droppables[this.options.scope];
            this._splice(e);
        },
        _setOption: function(e, i) {
            if ("accept" === e) this.accept = t.isFunction(i) ? i : function(t) {
                return t.is(i);
            }; else if ("scope" === e) {
                var s = t.ui.ddmanager.droppables[this.options.scope];
                this._splice(s), this._addToManager(i);
            }
            this._super(e, i);
        },
        _activate: function(e) {
            var i = t.ui.ddmanager.current;
            this._addActiveClass(), i && this._trigger("activate", e, this.ui(i));
        },
        _deactivate: function(e) {
            var i = t.ui.ddmanager.current;
            this._removeActiveClass(), i && this._trigger("deactivate", e, this.ui(i));
        },
        _over: function(e) {
            var i = t.ui.ddmanager.current;
            i && (i.currentItem || i.element)[0] !== this.element[0] && this.accept.call(this.element[0], i.currentItem || i.element) && (this._addHoverClass(), 
            this._trigger("over", e, this.ui(i)));
        },
        _out: function(e) {
            var i = t.ui.ddmanager.current;
            i && (i.currentItem || i.element)[0] !== this.element[0] && this.accept.call(this.element[0], i.currentItem || i.element) && (this._removeHoverClass(), 
            this._trigger("out", e, this.ui(i)));
        },
        _drop: function(e, i) {
            var s = i || t.ui.ddmanager.current, n = !1;
            return s && (s.currentItem || s.element)[0] !== this.element[0] ? (this.element.find(":data(ui-droppable)").not(".ui-draggable-dragging").each(function() {
                var i = t(this).droppable("instance");
                return i.options.greedy && !i.options.disabled && i.options.scope === s.options.scope && i.accept.call(i.element[0], s.currentItem || s.element) && c(s, t.extend(i, {
                    offset: i.element.offset()
                }), i.options.tolerance, e) ? (n = !0, !1) : void 0;
            }), n ? !1 : this.accept.call(this.element[0], s.currentItem || s.element) ? (this._removeActiveClass(), 
            this._removeHoverClass(), this._trigger("drop", e, this.ui(s)), this.element) : !1) : !1;
        },
        ui: function(t) {
            return {
                draggable: t.currentItem || t.element,
                helper: t.helper,
                position: t.position,
                offset: t.positionAbs
            };
        },
        _addHoverClass: function() {
            this._addClass("ui-droppable-hover");
        },
        _removeHoverClass: function() {
            this._removeClass("ui-droppable-hover");
        },
        _addActiveClass: function() {
            this._addClass("ui-droppable-active");
        },
        _removeActiveClass: function() {
            this._removeClass("ui-droppable-active");
        }
    });
    var c = t.ui.intersect = function() {
        function t(t, e, i) {
            return t >= e && e + i > t;
        }
        return function(e, i, s, n) {
            if (!i.offset) return !1;
            var o = (e.positionAbs || e.position.absolute).left + e.margins.left, a = (e.positionAbs || e.position.absolute).top + e.margins.top, r = o + e.helperProportions.width, l = a + e.helperProportions.height, h = i.offset.left, c = i.offset.top, u = h + i.proportions().width, d = c + i.proportions().height;
            switch (s) {
              case "fit":
                return o >= h && u >= r && a >= c && d >= l;

              case "intersect":
                return o + e.helperProportions.width / 2 > h && u > r - e.helperProportions.width / 2 && a + e.helperProportions.height / 2 > c && d > l - e.helperProportions.height / 2;

              case "pointer":
                return t(n.pageY, c, i.proportions().height) && t(n.pageX, h, i.proportions().width);

              case "touch":
                return (a >= c && d >= a || l >= c && d >= l || c > a && l > d) && (o >= h && u >= o || r >= h && u >= r || h > o && r > u);

              default:
                return !1;
            }
        };
    }();
    t.ui.ddmanager = {
        current: null,
        droppables: {
            default: []
        },
        prepareOffsets: function(e, i) {
            var s, n, o = t.ui.ddmanager.droppables[e.options.scope] || [], a = i ? i.type : null, r = (e.currentItem || e.element).find(":data(ui-droppable)").addBack();
            t: for (s = 0; o.length > s; s++) if (!(o[s].options.disabled || e && !o[s].accept.call(o[s].element[0], e.currentItem || e.element))) {
                for (n = 0; r.length > n; n++) if (r[n] === o[s].element[0]) {
                    o[s].proportions().height = 0;
                    continue t;
                }
                o[s].visible = "none" !== o[s].element.css("display"), o[s].visible && ("mousedown" === a && o[s]._activate.call(o[s], i), 
                o[s].offset = o[s].element.offset(), o[s].proportions({
                    width: o[s].element[0].offsetWidth,
                    height: o[s].element[0].offsetHeight
                }));
            }
        },
        drop: function(e, i) {
            var s = !1;
            return t.each((t.ui.ddmanager.droppables[e.options.scope] || []).slice(), function() {
                this.options && (!this.options.disabled && this.visible && c(e, this, this.options.tolerance, i) && (s = this._drop.call(this, i) || s), 
                !this.options.disabled && this.visible && this.accept.call(this.element[0], e.currentItem || e.element) && (this.isout = !0, 
                this.isover = !1, this._deactivate.call(this, i)));
            }), s;
        },
        dragStart: function(e, i) {
            e.element.parentsUntil("body").on("scroll.droppable", function() {
                e.options.refreshPositions || t.ui.ddmanager.prepareOffsets(e, i);
            });
        },
        drag: function(e, i) {
            e.options.refreshPositions && t.ui.ddmanager.prepareOffsets(e, i), t.each(t.ui.ddmanager.droppables[e.options.scope] || [], function() {
                if (!this.options.disabled && !this.greedyChild && this.visible) {
                    var s, n, o, a = c(e, this, this.options.tolerance, i), r = !a && this.isover ? "isout" : a && !this.isover ? "isover" : null;
                    r && (this.options.greedy && (n = this.options.scope, o = this.element.parents(":data(ui-droppable)").filter(function() {
                        return t(this).droppable("instance").options.scope === n;
                    }), o.length && (s = t(o[0]).droppable("instance"), s.greedyChild = "isover" === r)), 
                    s && "isover" === r && (s.isover = !1, s.isout = !0, s._out.call(s, i)), this[r] = !0, 
                    this["isout" === r ? "isover" : "isout"] = !1, this["isover" === r ? "_over" : "_out"].call(this, i), 
                    s && "isout" === r && (s.isout = !1, s.isover = !0, s._over.call(s, i)));
                }
            });
        },
        dragStop: function(e, i) {
            e.element.parentsUntil("body").off("scroll.droppable"), e.options.refreshPositions || t.ui.ddmanager.prepareOffsets(e, i);
        }
    }, t.uiBackCompat !== !1 && t.widget("ui.droppable", t.ui.droppable, {
        options: {
            hoverClass: !1,
            activeClass: !1
        },
        _addActiveClass: function() {
            this._super(), this.options.activeClass && this.element.addClass(this.options.activeClass);
        },
        _removeActiveClass: function() {
            this._super(), this.options.activeClass && this.element.removeClass(this.options.activeClass);
        },
        _addHoverClass: function() {
            this._super(), this.options.hoverClass && this.element.addClass(this.options.hoverClass);
        },
        _removeHoverClass: function() {
            this._super(), this.options.hoverClass && this.element.removeClass(this.options.hoverClass);
        }
    }), t.ui.droppable;
    var u = /ui-corner-([a-z]){2,6}/g;
    t.widget("ui.controlgroup", {
        version: "1.12.1",
        defaultElement: "<div>",
        options: {
            direction: "horizontal",
            disabled: null,
            onlyVisible: !0,
            items: {
                button: "input[type=button], input[type=submit], input[type=reset], button, a",
                controlgroupLabel: ".ui-controlgroup-label",
                checkboxradio: "input[type='checkbox'], input[type='radio']",
                selectmenu: "select",
                spinner: ".ui-spinner-input"
            }
        },
        _create: function() {
            this._enhance();
        },
        _enhance: function() {
            this.element.attr("role", "toolbar"), this.refresh();
        },
        _destroy: function() {
            this._callChildMethod("destroy"), this.childWidgets.removeData("ui-controlgroup-data"), 
            this.element.removeAttr("role"), this.options.items.controlgroupLabel && this.element.find(this.options.items.controlgroupLabel).find(".ui-controlgroup-label-contents").contents().unwrap();
        },
        _initWidgets: function() {
            var e = this, i = [];
            t.each(this.options.items, function(s, n) {
                var o, a = {};
                return n ? "controlgroupLabel" === s ? (o = e.element.find(n), o.each(function() {
                    var e = t(this);
                    e.children(".ui-controlgroup-label-contents").length || e.contents().wrapAll("<span class='ui-controlgroup-label-contents'></span>");
                }), e._addClass(o, null, "ui-widget ui-widget-content ui-state-default"), i = i.concat(o.get()), 
                void 0) : (t.fn[s] && (a = e["_" + s + "Options"] ? e["_" + s + "Options"]("middle") : {
                    classes: {}
                }, e.element.find(n).each(function() {
                    var n = t(this), o = n[s]("instance"), r = t.widget.extend({}, a);
                    if ("button" !== s || !n.parent(".ui-spinner").length) {
                        o || (o = n[s]()[s]("instance")), o && (r.classes = e._resolveClassesValues(r.classes, o)), 
                        n[s](r);
                        var l = n[s]("widget");
                        t.data(l[0], "ui-controlgroup-data", o ? o : n[s]("instance")), i.push(l[0]);
                    }
                })), void 0) : void 0;
            }), this.childWidgets = t(t.unique(i)), this._addClass(this.childWidgets, "ui-controlgroup-item");
        },
        _callChildMethod: function(e) {
            this.childWidgets.each(function() {
                var i = t(this), s = i.data("ui-controlgroup-data");
                s && s[e] && s[e]();
            });
        },
        _updateCornerClass: function(t, e) {
            var i = "ui-corner-top ui-corner-bottom ui-corner-left ui-corner-right ui-corner-all", s = this._buildSimpleOptions(e, "label").classes.label;
            this._removeClass(t, null, i), this._addClass(t, null, s);
        },
        _buildSimpleOptions: function(t, e) {
            var i = "vertical" === this.options.direction, s = {
                classes: {}
            };
            return s.classes[e] = {
                middle: "",
                first: "ui-corner-" + (i ? "top" : "left"),
                last: "ui-corner-" + (i ? "bottom" : "right"),
                only: "ui-corner-all"
            }[t], s;
        },
        _spinnerOptions: function(t) {
            var e = this._buildSimpleOptions(t, "ui-spinner");
            return e.classes["ui-spinner-up"] = "", e.classes["ui-spinner-down"] = "", e;
        },
        _buttonOptions: function(t) {
            return this._buildSimpleOptions(t, "ui-button");
        },
        _checkboxradioOptions: function(t) {
            return this._buildSimpleOptions(t, "ui-checkboxradio-label");
        },
        _selectmenuOptions: function(t) {
            var e = "vertical" === this.options.direction;
            return {
                width: e ? "auto" : !1,
                classes: {
                    middle: {
                        "ui-selectmenu-button-open": "",
                        "ui-selectmenu-button-closed": ""
                    },
                    first: {
                        "ui-selectmenu-button-open": "ui-corner-" + (e ? "top" : "tl"),
                        "ui-selectmenu-button-closed": "ui-corner-" + (e ? "top" : "left")
                    },
                    last: {
                        "ui-selectmenu-button-open": e ? "" : "ui-corner-tr",
                        "ui-selectmenu-button-closed": "ui-corner-" + (e ? "bottom" : "right")
                    },
                    only: {
                        "ui-selectmenu-button-open": "ui-corner-top",
                        "ui-selectmenu-button-closed": "ui-corner-all"
                    }
                }[t]
            };
        },
        _resolveClassesValues: function(e, i) {
            var s = {};
            return t.each(e, function(n) {
                var o = i.options.classes[n] || "";
                o = t.trim(o.replace(u, "")), s[n] = (o + " " + e[n]).replace(/\s+/g, " ");
            }), s;
        },
        _setOption: function(t, e) {
            return "direction" === t && this._removeClass("ui-controlgroup-" + this.options.direction), 
            this._super(t, e), "disabled" === t ? (this._callChildMethod(e ? "disable" : "enable"), 
            void 0) : (this.refresh(), void 0);
        },
        refresh: function() {
            var e, i = this;
            this._addClass("ui-controlgroup ui-controlgroup-" + this.options.direction), "horizontal" === this.options.direction && this._addClass(null, "ui-helper-clearfix"), 
            this._initWidgets(), e = this.childWidgets, this.options.onlyVisible && (e = e.filter(":visible")), 
            e.length && (t.each([ "first", "last" ], function(t, s) {
                var n = e[s]().data("ui-controlgroup-data");
                if (n && i["_" + n.widgetName + "Options"]) {
                    var o = i["_" + n.widgetName + "Options"](1 === e.length ? "only" : s);
                    o.classes = i._resolveClassesValues(o.classes, n), n.element[n.widgetName](o);
                } else i._updateCornerClass(e[s](), s);
            }), this._callChildMethod("refresh"));
        }
    }), t.widget("ui.checkboxradio", [ t.ui.formResetMixin, {
        version: "1.12.1",
        options: {
            disabled: null,
            label: null,
            icon: !0,
            classes: {
                "ui-checkboxradio-label": "ui-corner-all",
                "ui-checkboxradio-icon": "ui-corner-all"
            }
        },
        _getCreateOptions: function() {
            var e, i, s = this, n = this._super() || {};
            return this._readType(), i = this.element.labels(), this.label = t(i[i.length - 1]), 
            this.label.length || t.error("No label found for checkboxradio widget"), this.originalLabel = "", 
            this.label.contents().not(this.element[0]).each(function() {
                s.originalLabel += 3 === this.nodeType ? t(this).text() : this.outerHTML;
            }), this.originalLabel && (n.label = this.originalLabel), e = this.element[0].disabled, 
            null != e && (n.disabled = e), n;
        },
        _create: function() {
            var t = this.element[0].checked;
            this._bindFormResetHandler(), null == this.options.disabled && (this.options.disabled = this.element[0].disabled), 
            this._setOption("disabled", this.options.disabled), this._addClass("ui-checkboxradio", "ui-helper-hidden-accessible"), 
            this._addClass(this.label, "ui-checkboxradio-label", "ui-button ui-widget"), "radio" === this.type && this._addClass(this.label, "ui-checkboxradio-radio-label"), 
            this.options.label && this.options.label !== this.originalLabel ? this._updateLabel() : this.originalLabel && (this.options.label = this.originalLabel), 
            this._enhance(), t && (this._addClass(this.label, "ui-checkboxradio-checked", "ui-state-active"), 
            this.icon && this._addClass(this.icon, null, "ui-state-hover")), this._on({
                change: "_toggleClasses",
                focus: function() {
                    this._addClass(this.label, null, "ui-state-focus ui-visual-focus");
                },
                blur: function() {
                    this._removeClass(this.label, null, "ui-state-focus ui-visual-focus");
                }
            });
        },
        _readType: function() {
            var e = this.element[0].nodeName.toLowerCase();
            this.type = this.element[0].type, "input" === e && /radio|checkbox/.test(this.type) || t.error("Can't create checkboxradio on element.nodeName=" + e + " and element.type=" + this.type);
        },
        _enhance: function() {
            this._updateIcon(this.element[0].checked);
        },
        widget: function() {
            return this.label;
        },
        _getRadioGroup: function() {
            var e, i = this.element[0].name, s = "input[name='" + t.ui.escapeSelector(i) + "']";
            return i ? (e = this.form.length ? t(this.form[0].elements).filter(s) : t(s).filter(function() {
                return 0 === t(this).form().length;
            }), e.not(this.element)) : t([]);
        },
        _toggleClasses: function() {
            var e = this.element[0].checked;
            this._toggleClass(this.label, "ui-checkboxradio-checked", "ui-state-active", e), 
            this.options.icon && "checkbox" === this.type && this._toggleClass(this.icon, null, "ui-icon-check ui-state-checked", e)._toggleClass(this.icon, null, "ui-icon-blank", !e), 
            "radio" === this.type && this._getRadioGroup().each(function() {
                var e = t(this).checkboxradio("instance");
                e && e._removeClass(e.label, "ui-checkboxradio-checked", "ui-state-active");
            });
        },
        _destroy: function() {
            this._unbindFormResetHandler(), this.icon && (this.icon.remove(), this.iconSpace.remove());
        },
        _setOption: function(t, e) {
            return "label" !== t || e ? (this._super(t, e), "disabled" === t ? (this._toggleClass(this.label, null, "ui-state-disabled", e), 
            this.element[0].disabled = e, void 0) : (this.refresh(), void 0)) : void 0;
        },
        _updateIcon: function(e) {
            var i = "ui-icon ui-icon-background ";
            this.options.icon ? (this.icon || (this.icon = t("<span>"), this.iconSpace = t("<span> </span>"), 
            this._addClass(this.iconSpace, "ui-checkboxradio-icon-space")), "checkbox" === this.type ? (i += e ? "ui-icon-check ui-state-checked" : "ui-icon-blank", 
            this._removeClass(this.icon, null, e ? "ui-icon-blank" : "ui-icon-check")) : i += "ui-icon-blank", 
            this._addClass(this.icon, "ui-checkboxradio-icon", i), e || this._removeClass(this.icon, null, "ui-icon-check ui-state-checked"), 
            this.icon.prependTo(this.label).after(this.iconSpace)) : void 0 !== this.icon && (this.icon.remove(), 
            this.iconSpace.remove(), delete this.icon);
        },
        _updateLabel: function() {
            var t = this.label.contents().not(this.element[0]);
            this.icon && (t = t.not(this.icon[0])), this.iconSpace && (t = t.not(this.iconSpace[0])), 
            t.remove(), this.label.append(this.options.label);
        },
        refresh: function() {
            var t = this.element[0].checked, e = this.element[0].disabled;
            this._updateIcon(t), this._toggleClass(this.label, "ui-checkboxradio-checked", "ui-state-active", t), 
            null !== this.options.label && this._updateLabel(), e !== this.options.disabled && this._setOptions({
                disabled: e
            });
        }
    } ]), t.ui.checkboxradio, t.widget("ui.button", {
        version: "1.12.1",
        defaultElement: "<button>",
        options: {
            classes: {
                "ui-button": "ui-corner-all"
            },
            disabled: null,
            icon: null,
            iconPosition: "beginning",
            label: null,
            showLabel: !0
        },
        _getCreateOptions: function() {
            var t, e = this._super() || {};
            return this.isInput = this.element.is("input"), t = this.element[0].disabled, null != t && (e.disabled = t), 
            this.originalLabel = this.isInput ? this.element.val() : this.element.html(), this.originalLabel && (e.label = this.originalLabel), 
            e;
        },
        _create: function() {
            !this.option.showLabel & !this.options.icon && (this.options.showLabel = !0), null == this.options.disabled && (this.options.disabled = this.element[0].disabled || !1), 
            this.hasTitle = !!this.element.attr("title"), this.options.label && this.options.label !== this.originalLabel && (this.isInput ? this.element.val(this.options.label) : this.element.html(this.options.label)), 
            this._addClass("ui-button", "ui-widget"), this._setOption("disabled", this.options.disabled), 
            this._enhance(), this.element.is("a") && this._on({
                keyup: function(e) {
                    e.keyCode === t.ui.keyCode.SPACE && (e.preventDefault(), this.element[0].click ? this.element[0].click() : this.element.trigger("click"));
                }
            });
        },
        _enhance: function() {
            this.element.is("button") || this.element.attr("role", "button"), this.options.icon && (this._updateIcon("icon", this.options.icon), 
            this._updateTooltip());
        },
        _updateTooltip: function() {
            this.title = this.element.attr("title"), this.options.showLabel || this.title || this.element.attr("title", this.options.label);
        },
        _updateIcon: function(e, i) {
            var s = "iconPosition" !== e, n = s ? this.options.iconPosition : i, o = "top" === n || "bottom" === n;
            this.icon ? s && this._removeClass(this.icon, null, this.options.icon) : (this.icon = t("<span>"), 
            this._addClass(this.icon, "ui-button-icon", "ui-icon"), this.options.showLabel || this._addClass("ui-button-icon-only")), 
            s && this._addClass(this.icon, null, i), this._attachIcon(n), o ? (this._addClass(this.icon, null, "ui-widget-icon-block"), 
            this.iconSpace && this.iconSpace.remove()) : (this.iconSpace || (this.iconSpace = t("<span> </span>"), 
            this._addClass(this.iconSpace, "ui-button-icon-space")), this._removeClass(this.icon, null, "ui-wiget-icon-block"), 
            this._attachIconSpace(n));
        },
        _destroy: function() {
            this.element.removeAttr("role"), this.icon && this.icon.remove(), this.iconSpace && this.iconSpace.remove(), 
            this.hasTitle || this.element.removeAttr("title");
        },
        _attachIconSpace: function(t) {
            this.icon[/^(?:end|bottom)/.test(t) ? "before" : "after"](this.iconSpace);
        },
        _attachIcon: function(t) {
            this.element[/^(?:end|bottom)/.test(t) ? "append" : "prepend"](this.icon);
        },
        _setOptions: function(t) {
            var e = void 0 === t.showLabel ? this.options.showLabel : t.showLabel, i = void 0 === t.icon ? this.options.icon : t.icon;
            e || i || (t.showLabel = !0), this._super(t);
        },
        _setOption: function(t, e) {
            "icon" === t && (e ? this._updateIcon(t, e) : this.icon && (this.icon.remove(), 
            this.iconSpace && this.iconSpace.remove())), "iconPosition" === t && this._updateIcon(t, e), 
            "showLabel" === t && (this._toggleClass("ui-button-icon-only", null, !e), this._updateTooltip()), 
            "label" === t && (this.isInput ? this.element.val(e) : (this.element.html(e), this.icon && (this._attachIcon(this.options.iconPosition), 
            this._attachIconSpace(this.options.iconPosition)))), this._super(t, e), "disabled" === t && (this._toggleClass(null, "ui-state-disabled", e), 
            this.element[0].disabled = e, e && this.element.blur());
        },
        refresh: function() {
            var t = this.element.is("input, button") ? this.element[0].disabled : this.element.hasClass("ui-button-disabled");
            t !== this.options.disabled && this._setOptions({
                disabled: t
            }), this._updateTooltip();
        }
    }), t.uiBackCompat !== !1 && (t.widget("ui.button", t.ui.button, {
        options: {
            text: !0,
            icons: {
                primary: null,
                secondary: null
            }
        },
        _create: function() {
            this.options.showLabel && !this.options.text && (this.options.showLabel = this.options.text), 
            !this.options.showLabel && this.options.text && (this.options.text = this.options.showLabel), 
            this.options.icon || !this.options.icons.primary && !this.options.icons.secondary ? this.options.icon && (this.options.icons.primary = this.options.icon) : this.options.icons.primary ? this.options.icon = this.options.icons.primary : (this.options.icon = this.options.icons.secondary, 
            this.options.iconPosition = "end"), this._super();
        },
        _setOption: function(t, e) {
            return "text" === t ? (this._super("showLabel", e), void 0) : ("showLabel" === t && (this.options.text = e), 
            "icon" === t && (this.options.icons.primary = e), "icons" === t && (e.primary ? (this._super("icon", e.primary), 
            this._super("iconPosition", "beginning")) : e.secondary && (this._super("icon", e.secondary), 
            this._super("iconPosition", "end"))), this._superApply(arguments), void 0);
        }
    }), t.fn.button = function(e) {
        return function() {
            return !this.length || this.length && "INPUT" !== this[0].tagName || this.length && "INPUT" === this[0].tagName && "checkbox" !== this.attr("type") && "radio" !== this.attr("type") ? e.apply(this, arguments) : (t.ui.checkboxradio || t.error("Checkboxradio widget missing"), 
            0 === arguments.length ? this.checkboxradio({
                icon: !1
            }) : this.checkboxradio.apply(this, arguments));
        };
    }(t.fn.button), t.fn.buttonset = function() {
        return t.ui.controlgroup || t.error("Controlgroup widget missing"), "option" === arguments[0] && "items" === arguments[1] && arguments[2] ? this.controlgroup.apply(this, [ arguments[0], "items.button", arguments[2] ]) : "option" === arguments[0] && "items" === arguments[1] ? this.controlgroup.apply(this, [ arguments[0], "items.button" ]) : ("object" == typeof arguments[0] && arguments[0].items && (arguments[0].items = {
            button: arguments[0].items
        }), this.controlgroup.apply(this, arguments));
    }), t.ui.button, t.extend(t.ui, {
        datepicker: {
            version: "1.12.1"
        }
    });
    var d;
    t.extend(i.prototype, {
        markerClassName: "hasDatepicker",
        maxRows: 4,
        _widgetDatepicker: function() {
            return this.dpDiv;
        },
        setDefaults: function(t) {
            return o(this._defaults, t || {}), this;
        },
        _attachDatepicker: function(e, i) {
            var s, n, o;
            s = e.nodeName.toLowerCase(), n = "div" === s || "span" === s, e.id || (this.uuid += 1, 
            e.id = "dp" + this.uuid), o = this._newInst(t(e), n), o.settings = t.extend({}, i || {}), 
            "input" === s ? this._connectDatepicker(e, o) : n && this._inlineDatepicker(e, o);
        },
        _newInst: function(e, i) {
            var n = e[0].id.replace(/([^A-Za-z0-9_\-])/g, "\\\\$1");
            return {
                id: n,
                input: e,
                selectedDay: 0,
                selectedMonth: 0,
                selectedYear: 0,
                drawMonth: 0,
                drawYear: 0,
                inline: i,
                dpDiv: i ? s(t("<div class='" + this._inlineClass + " ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>")) : this.dpDiv
            };
        },
        _connectDatepicker: function(e, i) {
            var s = t(e);
            i.append = t([]), i.trigger = t([]), s.hasClass(this.markerClassName) || (this._attachments(s, i), 
            s.addClass(this.markerClassName).on("keydown", this._doKeyDown).on("keypress", this._doKeyPress).on("keyup", this._doKeyUp), 
            this._autoSize(i), t.data(e, "datepicker", i), i.settings.disabled && this._disableDatepicker(e));
        },
        _attachments: function(e, i) {
            var s, n, o, a = this._get(i, "appendText"), r = this._get(i, "isRTL");
            i.append && i.append.remove(), a && (i.append = t("<span class='" + this._appendClass + "'>" + a + "</span>"), 
            e[r ? "before" : "after"](i.append)), e.off("focus", this._showDatepicker), i.trigger && i.trigger.remove(), 
            s = this._get(i, "showOn"), ("focus" === s || "both" === s) && e.on("focus", this._showDatepicker), 
            ("button" === s || "both" === s) && (n = this._get(i, "buttonText"), o = this._get(i, "buttonImage"), 
            i.trigger = t(this._get(i, "buttonImageOnly") ? t("<img/>").addClass(this._triggerClass).attr({
                src: o,
                alt: n,
                title: n
            }) : t("<button type='button'></button>").addClass(this._triggerClass).html(o ? t("<img/>").attr({
                src: o,
                alt: n,
                title: n
            }) : n)), e[r ? "before" : "after"](i.trigger), i.trigger.on("click", function() {
                return t.datepicker._datepickerShowing && t.datepicker._lastInput === e[0] ? t.datepicker._hideDatepicker() : t.datepicker._datepickerShowing && t.datepicker._lastInput !== e[0] ? (t.datepicker._hideDatepicker(), 
                t.datepicker._showDatepicker(e[0])) : t.datepicker._showDatepicker(e[0]), !1;
            }));
        },
        _autoSize: function(t) {
            if (this._get(t, "autoSize") && !t.inline) {
                var e, i, s, n, o = new Date(2009, 11, 20), a = this._get(t, "dateFormat");
                a.match(/[DM]/) && (e = function(t) {
                    for (i = 0, s = 0, n = 0; t.length > n; n++) t[n].length > i && (i = t[n].length, 
                    s = n);
                    return s;
                }, o.setMonth(e(this._get(t, a.match(/MM/) ? "monthNames" : "monthNamesShort"))), 
                o.setDate(e(this._get(t, a.match(/DD/) ? "dayNames" : "dayNamesShort")) + 20 - o.getDay())), 
                t.input.attr("size", this._formatDate(t, o).length);
            }
        },
        _inlineDatepicker: function(e, i) {
            var s = t(e);
            s.hasClass(this.markerClassName) || (s.addClass(this.markerClassName).append(i.dpDiv), 
            t.data(e, "datepicker", i), this._setDate(i, this._getDefaultDate(i), !0), this._updateDatepicker(i), 
            this._updateAlternate(i), i.settings.disabled && this._disableDatepicker(e), i.dpDiv.css("display", "block"));
        },
        _dialogDatepicker: function(e, i, s, n, a) {
            var r, l, h, c, u, d = this._dialogInst;
            return d || (this.uuid += 1, r = "dp" + this.uuid, this._dialogInput = t("<input type='text' id='" + r + "' style='position: absolute; top: -100px; width: 0px;'/>"), 
            this._dialogInput.on("keydown", this._doKeyDown), t("body").append(this._dialogInput), 
            d = this._dialogInst = this._newInst(this._dialogInput, !1), d.settings = {}, t.data(this._dialogInput[0], "datepicker", d)), 
            o(d.settings, n || {}), i = i && i.constructor === Date ? this._formatDate(d, i) : i, 
            this._dialogInput.val(i), this._pos = a ? a.length ? a : [ a.pageX, a.pageY ] : null, 
            this._pos || (l = document.documentElement.clientWidth, h = document.documentElement.clientHeight, 
            c = document.documentElement.scrollLeft || document.body.scrollLeft, u = document.documentElement.scrollTop || document.body.scrollTop, 
            this._pos = [ l / 2 - 100 + c, h / 2 - 150 + u ]), this._dialogInput.css("left", this._pos[0] + 20 + "px").css("top", this._pos[1] + "px"), 
            d.settings.onSelect = s, this._inDialog = !0, this.dpDiv.addClass(this._dialogClass), 
            this._showDatepicker(this._dialogInput[0]), t.blockUI && t.blockUI(this.dpDiv), 
            t.data(this._dialogInput[0], "datepicker", d), this;
        },
        _destroyDatepicker: function(e) {
            var i, s = t(e), n = t.data(e, "datepicker");
            s.hasClass(this.markerClassName) && (i = e.nodeName.toLowerCase(), t.removeData(e, "datepicker"), 
            "input" === i ? (n.append.remove(), n.trigger.remove(), s.removeClass(this.markerClassName).off("focus", this._showDatepicker).off("keydown", this._doKeyDown).off("keypress", this._doKeyPress).off("keyup", this._doKeyUp)) : ("div" === i || "span" === i) && s.removeClass(this.markerClassName).empty(), 
            d === n && (d = null));
        },
        _enableDatepicker: function(e) {
            var i, s, n = t(e), o = t.data(e, "datepicker");
            n.hasClass(this.markerClassName) && (i = e.nodeName.toLowerCase(), "input" === i ? (e.disabled = !1, 
            o.trigger.filter("button").each(function() {
                this.disabled = !1;
            }).end().filter("img").css({
                opacity: "1.0",
                cursor: ""
            })) : ("div" === i || "span" === i) && (s = n.children("." + this._inlineClass), 
            s.children().removeClass("ui-state-disabled"), s.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled", !1)), 
            this._disabledInputs = t.map(this._disabledInputs, function(t) {
                return t === e ? null : t;
            }));
        },
        _disableDatepicker: function(e) {
            var i, s, n = t(e), o = t.data(e, "datepicker");
            n.hasClass(this.markerClassName) && (i = e.nodeName.toLowerCase(), "input" === i ? (e.disabled = !0, 
            o.trigger.filter("button").each(function() {
                this.disabled = !0;
            }).end().filter("img").css({
                opacity: "0.5",
                cursor: "default"
            })) : ("div" === i || "span" === i) && (s = n.children("." + this._inlineClass), 
            s.children().addClass("ui-state-disabled"), s.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled", !0)), 
            this._disabledInputs = t.map(this._disabledInputs, function(t) {
                return t === e ? null : t;
            }), this._disabledInputs[this._disabledInputs.length] = e);
        },
        _isDisabledDatepicker: function(t) {
            if (!t) return !1;
            for (var e = 0; this._disabledInputs.length > e; e++) if (this._disabledInputs[e] === t) return !0;
            return !1;
        },
        _getInst: function(e) {
            try {
                return t.data(e, "datepicker");
            } catch (i) {
                throw "Missing instance data for this datepicker";
            }
        },
        _optionDatepicker: function(e, i, s) {
            var n, a, r, l, h = this._getInst(e);
            return 2 === arguments.length && "string" == typeof i ? "defaults" === i ? t.extend({}, t.datepicker._defaults) : h ? "all" === i ? t.extend({}, h.settings) : this._get(h, i) : null : (n = i || {}, 
            "string" == typeof i && (n = {}, n[i] = s), h && (this._curInst === h && this._hideDatepicker(), 
            a = this._getDateDatepicker(e, !0), r = this._getMinMaxDate(h, "min"), l = this._getMinMaxDate(h, "max"), 
            o(h.settings, n), null !== r && void 0 !== n.dateFormat && void 0 === n.minDate && (h.settings.minDate = this._formatDate(h, r)), 
            null !== l && void 0 !== n.dateFormat && void 0 === n.maxDate && (h.settings.maxDate = this._formatDate(h, l)), 
            "disabled" in n && (n.disabled ? this._disableDatepicker(e) : this._enableDatepicker(e)), 
            this._attachments(t(e), h), this._autoSize(h), this._setDate(h, a), this._updateAlternate(h), 
            this._updateDatepicker(h)), void 0);
        },
        _changeDatepicker: function(t, e, i) {
            this._optionDatepicker(t, e, i);
        },
        _refreshDatepicker: function(t) {
            var e = this._getInst(t);
            e && this._updateDatepicker(e);
        },
        _setDateDatepicker: function(t, e) {
            var i = this._getInst(t);
            i && (this._setDate(i, e), this._updateDatepicker(i), this._updateAlternate(i));
        },
        _getDateDatepicker: function(t, e) {
            var i = this._getInst(t);
            return i && !i.inline && this._setDateFromField(i, e), i ? this._getDate(i) : null;
        },
        _doKeyDown: function(e) {
            var i, s, n, o = t.datepicker._getInst(e.target), a = !0, r = o.dpDiv.is(".ui-datepicker-rtl");
            if (o._keyEvent = !0, t.datepicker._datepickerShowing) switch (e.keyCode) {
              case 9:
                t.datepicker._hideDatepicker(), a = !1;
                break;

              case 13:
                return n = t("td." + t.datepicker._dayOverClass + ":not(." + t.datepicker._currentClass + ")", o.dpDiv), 
                n[0] && t.datepicker._selectDay(e.target, o.selectedMonth, o.selectedYear, n[0]), 
                i = t.datepicker._get(o, "onSelect"), i ? (s = t.datepicker._formatDate(o), i.apply(o.input ? o.input[0] : null, [ s, o ])) : t.datepicker._hideDatepicker(), 
                !1;

              case 27:
                t.datepicker._hideDatepicker();
                break;

              case 33:
                t.datepicker._adjustDate(e.target, e.ctrlKey ? -t.datepicker._get(o, "stepBigMonths") : -t.datepicker._get(o, "stepMonths"), "M");
                break;

              case 34:
                t.datepicker._adjustDate(e.target, e.ctrlKey ? +t.datepicker._get(o, "stepBigMonths") : +t.datepicker._get(o, "stepMonths"), "M");
                break;

              case 35:
                (e.ctrlKey || e.metaKey) && t.datepicker._clearDate(e.target), a = e.ctrlKey || e.metaKey;
                break;

              case 36:
                (e.ctrlKey || e.metaKey) && t.datepicker._gotoToday(e.target), a = e.ctrlKey || e.metaKey;
                break;

              case 37:
                (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, r ? 1 : -1, "D"), 
                a = e.ctrlKey || e.metaKey, e.originalEvent.altKey && t.datepicker._adjustDate(e.target, e.ctrlKey ? -t.datepicker._get(o, "stepBigMonths") : -t.datepicker._get(o, "stepMonths"), "M");
                break;

              case 38:
                (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, -7, "D"), a = e.ctrlKey || e.metaKey;
                break;

              case 39:
                (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, r ? -1 : 1, "D"), 
                a = e.ctrlKey || e.metaKey, e.originalEvent.altKey && t.datepicker._adjustDate(e.target, e.ctrlKey ? +t.datepicker._get(o, "stepBigMonths") : +t.datepicker._get(o, "stepMonths"), "M");
                break;

              case 40:
                (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, 7, "D"), a = e.ctrlKey || e.metaKey;
                break;

              default:
                a = !1;
            } else 36 === e.keyCode && e.ctrlKey ? t.datepicker._showDatepicker(this) : a = !1;
            a && (e.preventDefault(), e.stopPropagation());
        },
        _doKeyPress: function(e) {
            var i, s, n = t.datepicker._getInst(e.target);
            return t.datepicker._get(n, "constrainInput") ? (i = t.datepicker._possibleChars(t.datepicker._get(n, "dateFormat")), 
            s = String.fromCharCode(null == e.charCode ? e.keyCode : e.charCode), e.ctrlKey || e.metaKey || " " > s || !i || i.indexOf(s) > -1) : void 0;
        },
        _doKeyUp: function(e) {
            var i, s = t.datepicker._getInst(e.target);
            if (s.input.val() !== s.lastVal) try {
                i = t.datepicker.parseDate(t.datepicker._get(s, "dateFormat"), s.input ? s.input.val() : null, t.datepicker._getFormatConfig(s)), 
                i && (t.datepicker._setDateFromField(s), t.datepicker._updateAlternate(s), t.datepicker._updateDatepicker(s));
            } catch (n) {}
            return !0;
        },
        _showDatepicker: function(i) {
            if (i = i.target || i, "input" !== i.nodeName.toLowerCase() && (i = t("input", i.parentNode)[0]), 
            !t.datepicker._isDisabledDatepicker(i) && t.datepicker._lastInput !== i) {
                var s, n, a, r, l, h, c;
                s = t.datepicker._getInst(i), t.datepicker._curInst && t.datepicker._curInst !== s && (t.datepicker._curInst.dpDiv.stop(!0, !0), 
                s && t.datepicker._datepickerShowing && t.datepicker._hideDatepicker(t.datepicker._curInst.input[0])), 
                n = t.datepicker._get(s, "beforeShow"), a = n ? n.apply(i, [ i, s ]) : {}, a !== !1 && (o(s.settings, a), 
                s.lastVal = null, t.datepicker._lastInput = i, t.datepicker._setDateFromField(s), 
                t.datepicker._inDialog && (i.value = ""), t.datepicker._pos || (t.datepicker._pos = t.datepicker._findPos(i), 
                t.datepicker._pos[1] += i.offsetHeight), r = !1, t(i).parents().each(function() {
                    return r |= "fixed" === t(this).css("position"), !r;
                }), l = {
                    left: t.datepicker._pos[0],
                    top: t.datepicker._pos[1]
                }, t.datepicker._pos = null, s.dpDiv.empty(), s.dpDiv.css({
                    position: "absolute",
                    display: "block",
                    top: "-1000px"
                }), t.datepicker._updateDatepicker(s), l = t.datepicker._checkOffset(s, l, r), s.dpDiv.css({
                    position: t.datepicker._inDialog && t.blockUI ? "static" : r ? "fixed" : "absolute",
                    display: "none",
                    left: l.left + "px",
                    top: l.top + "px"
                }), s.inline || (h = t.datepicker._get(s, "showAnim"), c = t.datepicker._get(s, "duration"), 
                s.dpDiv.css("z-index", e(t(i)) + 1), t.datepicker._datepickerShowing = !0, t.effects && t.effects.effect[h] ? s.dpDiv.show(h, t.datepicker._get(s, "showOptions"), c) : s.dpDiv[h || "show"](h ? c : null), 
                t.datepicker._shouldFocusInput(s) && s.input.trigger("focus"), t.datepicker._curInst = s));
            }
        },
        _updateDatepicker: function(e) {
            this.maxRows = 4, d = e, e.dpDiv.empty().append(this._generateHTML(e)), this._attachHandlers(e);
            var i, s = this._getNumberOfMonths(e), o = s[1], a = 17, r = e.dpDiv.find("." + this._dayOverClass + " a");
            r.length > 0 && n.apply(r.get(0)), e.dpDiv.removeClass("ui-datepicker-multi-2 ui-datepicker-multi-3 ui-datepicker-multi-4").width(""), 
            o > 1 && e.dpDiv.addClass("ui-datepicker-multi-" + o).css("width", a * o + "em"), 
            e.dpDiv[(1 !== s[0] || 1 !== s[1] ? "add" : "remove") + "Class"]("ui-datepicker-multi"), 
            e.dpDiv[(this._get(e, "isRTL") ? "add" : "remove") + "Class"]("ui-datepicker-rtl"), 
            e === t.datepicker._curInst && t.datepicker._datepickerShowing && t.datepicker._shouldFocusInput(e) && e.input.trigger("focus"), 
            e.yearshtml && (i = e.yearshtml, setTimeout(function() {
                i === e.yearshtml && e.yearshtml && e.dpDiv.find("select.ui-datepicker-year:first").replaceWith(e.yearshtml), 
                i = e.yearshtml = null;
            }, 0));
        },
        _shouldFocusInput: function(t) {
            return t.input && t.input.is(":visible") && !t.input.is(":disabled") && !t.input.is(":focus");
        },
        _checkOffset: function(e, i, s) {
            var n = e.dpDiv.outerWidth(), o = e.dpDiv.outerHeight(), a = e.input ? e.input.outerWidth() : 0, r = e.input ? e.input.outerHeight() : 0, l = document.documentElement.clientWidth + (s ? 0 : t(document).scrollLeft()), h = document.documentElement.clientHeight + (s ? 0 : t(document).scrollTop());
            return i.left -= this._get(e, "isRTL") ? n - a : 0, i.left -= s && i.left === e.input.offset().left ? t(document).scrollLeft() : 0, 
            i.top -= s && i.top === e.input.offset().top + r ? t(document).scrollTop() : 0, 
            i.left -= Math.min(i.left, i.left + n > l && l > n ? Math.abs(i.left + n - l) : 0), 
            i.top -= Math.min(i.top, i.top + o > h && h > o ? Math.abs(o + r) : 0), i;
        },
        _findPos: function(e) {
            for (var i, s = this._getInst(e), n = this._get(s, "isRTL"); e && ("hidden" === e.type || 1 !== e.nodeType || t.expr.filters.hidden(e)); ) e = e[n ? "previousSibling" : "nextSibling"];
            return i = t(e).offset(), [ i.left, i.top ];
        },
        _hideDatepicker: function(e) {
            var i, s, n, o, a = this._curInst;
            !a || e && a !== t.data(e, "datepicker") || this._datepickerShowing && (i = this._get(a, "showAnim"), 
            s = this._get(a, "duration"), n = function() {
                t.datepicker._tidyDialog(a);
            }, t.effects && (t.effects.effect[i] || t.effects[i]) ? a.dpDiv.hide(i, t.datepicker._get(a, "showOptions"), s, n) : a.dpDiv["slideDown" === i ? "slideUp" : "fadeIn" === i ? "fadeOut" : "hide"](i ? s : null, n), 
            i || n(), this._datepickerShowing = !1, o = this._get(a, "onClose"), o && o.apply(a.input ? a.input[0] : null, [ a.input ? a.input.val() : "", a ]), 
            this._lastInput = null, this._inDialog && (this._dialogInput.css({
                position: "absolute",
                left: "0",
                top: "-100px"
            }), t.blockUI && (t.unblockUI(), t("body").append(this.dpDiv))), this._inDialog = !1);
        },
        _tidyDialog: function(t) {
            t.dpDiv.removeClass(this._dialogClass).off(".ui-datepicker-calendar");
        },
        _checkExternalClick: function(e) {
            if (t.datepicker._curInst) {
                var i = t(e.target), s = t.datepicker._getInst(i[0]);
                (i[0].id !== t.datepicker._mainDivId && 0 === i.parents("#" + t.datepicker._mainDivId).length && !i.hasClass(t.datepicker.markerClassName) && !i.closest("." + t.datepicker._triggerClass).length && t.datepicker._datepickerShowing && (!t.datepicker._inDialog || !t.blockUI) || i.hasClass(t.datepicker.markerClassName) && t.datepicker._curInst !== s) && t.datepicker._hideDatepicker();
            }
        },
        _adjustDate: function(e, i, s) {
            var n = t(e), o = this._getInst(n[0]);
            this._isDisabledDatepicker(n[0]) || (this._adjustInstDate(o, i + ("M" === s ? this._get(o, "showCurrentAtPos") : 0), s), 
            this._updateDatepicker(o));
        },
        _gotoToday: function(e) {
            var i, s = t(e), n = this._getInst(s[0]);
            this._get(n, "gotoCurrent") && n.currentDay ? (n.selectedDay = n.currentDay, n.drawMonth = n.selectedMonth = n.currentMonth, 
            n.drawYear = n.selectedYear = n.currentYear) : (i = new Date(), n.selectedDay = i.getDate(), 
            n.drawMonth = n.selectedMonth = i.getMonth(), n.drawYear = n.selectedYear = i.getFullYear()), 
            this._notifyChange(n), this._adjustDate(s);
        },
        _selectMonthYear: function(e, i, s) {
            var n = t(e), o = this._getInst(n[0]);
            o["selected" + ("M" === s ? "Month" : "Year")] = o["draw" + ("M" === s ? "Month" : "Year")] = parseInt(i.options[i.selectedIndex].value, 10), 
            this._notifyChange(o), this._adjustDate(n);
        },
        _selectDay: function(e, i, s, n) {
            var o, a = t(e);
            t(n).hasClass(this._unselectableClass) || this._isDisabledDatepicker(a[0]) || (o = this._getInst(a[0]), 
            o.selectedDay = o.currentDay = t("a", n).html(), o.selectedMonth = o.currentMonth = i, 
            o.selectedYear = o.currentYear = s, this._selectDate(e, this._formatDate(o, o.currentDay, o.currentMonth, o.currentYear)));
        },
        _clearDate: function(e) {
            var i = t(e);
            this._selectDate(i, "");
        },
        _selectDate: function(e, i) {
            var s, n = t(e), o = this._getInst(n[0]);
            i = null != i ? i : this._formatDate(o), o.input && o.input.val(i), this._updateAlternate(o), 
            s = this._get(o, "onSelect"), s ? s.apply(o.input ? o.input[0] : null, [ i, o ]) : o.input && o.input.trigger("change"), 
            o.inline ? this._updateDatepicker(o) : (this._hideDatepicker(), this._lastInput = o.input[0], 
            "object" != typeof o.input[0] && o.input.trigger("focus"), this._lastInput = null);
        },
        _updateAlternate: function(e) {
            var i, s, n, o = this._get(e, "altField");
            o && (i = this._get(e, "altFormat") || this._get(e, "dateFormat"), s = this._getDate(e), 
            n = this.formatDate(i, s, this._getFormatConfig(e)), t(o).val(n));
        },
        noWeekends: function(t) {
            var e = t.getDay();
            return [ e > 0 && 6 > e, "" ];
        },
        iso8601Week: function(t) {
            var e, i = new Date(t.getTime());
            return i.setDate(i.getDate() + 4 - (i.getDay() || 7)), e = i.getTime(), i.setMonth(0), 
            i.setDate(1), Math.floor(Math.round((e - i) / 864e5) / 7) + 1;
        },
        parseDate: function(e, i, s) {
            if (null == e || null == i) throw "Invalid arguments";
            if (i = "object" == typeof i ? "" + i : i + "", "" === i) return null;
            var n, o, a, r, l = 0, h = (s ? s.shortYearCutoff : null) || this._defaults.shortYearCutoff, c = "string" != typeof h ? h : new Date().getFullYear() % 100 + parseInt(h, 10), u = (s ? s.dayNamesShort : null) || this._defaults.dayNamesShort, d = (s ? s.dayNames : null) || this._defaults.dayNames, p = (s ? s.monthNamesShort : null) || this._defaults.monthNamesShort, f = (s ? s.monthNames : null) || this._defaults.monthNames, g = -1, m = -1, _ = -1, v = -1, b = !1, y = function(t) {
                var i = e.length > n + 1 && e.charAt(n + 1) === t;
                return i && n++, i;
            }, w = function(t) {
                var e = y(t), s = "@" === t ? 14 : "!" === t ? 20 : "y" === t && e ? 4 : "o" === t ? 3 : 2, n = "y" === t ? s : 1, o = RegExp("^\\d{" + n + "," + s + "}"), a = i.substring(l).match(o);
                if (!a) throw "Missing number at position " + l;
                return l += a[0].length, parseInt(a[0], 10);
            }, k = function(e, s, n) {
                var o = -1, a = t.map(y(e) ? n : s, function(t, e) {
                    return [ [ e, t ] ];
                }).sort(function(t, e) {
                    return -(t[1].length - e[1].length);
                });
                if (t.each(a, function(t, e) {
                    var s = e[1];
                    return i.substr(l, s.length).toLowerCase() === s.toLowerCase() ? (o = e[0], l += s.length, 
                    !1) : void 0;
                }), -1 !== o) return o + 1;
                throw "Unknown name at position " + l;
            }, x = function() {
                if (i.charAt(l) !== e.charAt(n)) throw "Unexpected literal at position " + l;
                l++;
            };
            for (n = 0; e.length > n; n++) if (b) "'" !== e.charAt(n) || y("'") ? x() : b = !1; else switch (e.charAt(n)) {
              case "d":
                _ = w("d");
                break;

              case "D":
                k("D", u, d);
                break;

              case "o":
                v = w("o");
                break;

              case "m":
                m = w("m");
                break;

              case "M":
                m = k("M", p, f);
                break;

              case "y":
                g = w("y");
                break;

              case "@":
                r = new Date(w("@")), g = r.getFullYear(), m = r.getMonth() + 1, _ = r.getDate();
                break;

              case "!":
                r = new Date((w("!") - this._ticksTo1970) / 1e4), g = r.getFullYear(), m = r.getMonth() + 1, 
                _ = r.getDate();
                break;

              case "'":
                y("'") ? x() : b = !0;
                break;

              default:
                x();
            }
            if (i.length > l && (a = i.substr(l), !/^\s+/.test(a))) throw "Extra/unparsed characters found in date: " + a;
            if (-1 === g ? g = new Date().getFullYear() : 100 > g && (g += new Date().getFullYear() - new Date().getFullYear() % 100 + (c >= g ? 0 : -100)), 
            v > -1) for (m = 1, _ = v; ;) {
                if (o = this._getDaysInMonth(g, m - 1), o >= _) break;
                m++, _ -= o;
            }
            if (r = this._daylightSavingAdjust(new Date(g, m - 1, _)), r.getFullYear() !== g || r.getMonth() + 1 !== m || r.getDate() !== _) throw "Invalid date";
            return r;
        },
        ATOM: "yy-mm-dd",
        COOKIE: "D, dd M yy",
        ISO_8601: "yy-mm-dd",
        RFC_822: "D, d M y",
        RFC_850: "DD, dd-M-y",
        RFC_1036: "D, d M y",
        RFC_1123: "D, d M yy",
        RFC_2822: "D, d M yy",
        RSS: "D, d M y",
        TICKS: "!",
        TIMESTAMP: "@",
        W3C: "yy-mm-dd",
        _ticksTo1970: 1e7 * 60 * 60 * 24 * (718685 + Math.floor(492.5) - Math.floor(19.7) + Math.floor(4.925)),
        formatDate: function(t, e, i) {
            if (!e) return "";
            var s, n = (i ? i.dayNamesShort : null) || this._defaults.dayNamesShort, o = (i ? i.dayNames : null) || this._defaults.dayNames, a = (i ? i.monthNamesShort : null) || this._defaults.monthNamesShort, r = (i ? i.monthNames : null) || this._defaults.monthNames, l = function(e) {
                var i = t.length > s + 1 && t.charAt(s + 1) === e;
                return i && s++, i;
            }, h = function(t, e, i) {
                var s = "" + e;
                if (l(t)) for (;i > s.length; ) s = "0" + s;
                return s;
            }, c = function(t, e, i, s) {
                return l(t) ? s[e] : i[e];
            }, u = "", d = !1;
            if (e) for (s = 0; t.length > s; s++) if (d) "'" !== t.charAt(s) || l("'") ? u += t.charAt(s) : d = !1; else switch (t.charAt(s)) {
              case "d":
                u += h("d", e.getDate(), 2);
                break;

              case "D":
                u += c("D", e.getDay(), n, o);
                break;

              case "o":
                u += h("o", Math.round((new Date(e.getFullYear(), e.getMonth(), e.getDate()).getTime() - new Date(e.getFullYear(), 0, 0).getTime()) / 864e5), 3);
                break;

              case "m":
                u += h("m", e.getMonth() + 1, 2);
                break;

              case "M":
                u += c("M", e.getMonth(), a, r);
                break;

              case "y":
                u += l("y") ? e.getFullYear() : (10 > e.getFullYear() % 100 ? "0" : "") + e.getFullYear() % 100;
                break;

              case "@":
                u += e.getTime();
                break;

              case "!":
                u += 1e4 * e.getTime() + this._ticksTo1970;
                break;

              case "'":
                l("'") ? u += "'" : d = !0;
                break;

              default:
                u += t.charAt(s);
            }
            return u;
        },
        _possibleChars: function(t) {
            var e, i = "", s = !1, n = function(i) {
                var s = t.length > e + 1 && t.charAt(e + 1) === i;
                return s && e++, s;
            };
            for (e = 0; t.length > e; e++) if (s) "'" !== t.charAt(e) || n("'") ? i += t.charAt(e) : s = !1; else switch (t.charAt(e)) {
              case "d":
              case "m":
              case "y":
              case "@":
                i += "0123456789";
                break;

              case "D":
              case "M":
                return null;

              case "'":
                n("'") ? i += "'" : s = !0;
                break;

              default:
                i += t.charAt(e);
            }
            return i;
        },
        _get: function(t, e) {
            return void 0 !== t.settings[e] ? t.settings[e] : this._defaults[e];
        },
        _setDateFromField: function(t, e) {
            if (t.input.val() !== t.lastVal) {
                var i = this._get(t, "dateFormat"), s = t.lastVal = t.input ? t.input.val() : null, n = this._getDefaultDate(t), o = n, a = this._getFormatConfig(t);
                try {
                    o = this.parseDate(i, s, a) || n;
                } catch (r) {
                    s = e ? "" : s;
                }
                t.selectedDay = o.getDate(), t.drawMonth = t.selectedMonth = o.getMonth(), t.drawYear = t.selectedYear = o.getFullYear(), 
                t.currentDay = s ? o.getDate() : 0, t.currentMonth = s ? o.getMonth() : 0, t.currentYear = s ? o.getFullYear() : 0, 
                this._adjustInstDate(t);
            }
        },
        _getDefaultDate: function(t) {
            return this._restrictMinMax(t, this._determineDate(t, this._get(t, "defaultDate"), new Date()));
        },
        _determineDate: function(e, i, s) {
            var n = function(t) {
                var e = new Date();
                return e.setDate(e.getDate() + t), e;
            }, o = function(i) {
                try {
                    return t.datepicker.parseDate(t.datepicker._get(e, "dateFormat"), i, t.datepicker._getFormatConfig(e));
                } catch (s) {}
                for (var n = (i.toLowerCase().match(/^c/) ? t.datepicker._getDate(e) : null) || new Date(), o = n.getFullYear(), a = n.getMonth(), r = n.getDate(), l = /([+\-]?[0-9]+)\s*(d|D|w|W|m|M|y|Y)?/g, h = l.exec(i); h; ) {
                    switch (h[2] || "d") {
                      case "d":
                      case "D":
                        r += parseInt(h[1], 10);
                        break;

                      case "w":
                      case "W":
                        r += 7 * parseInt(h[1], 10);
                        break;

                      case "m":
                      case "M":
                        a += parseInt(h[1], 10), r = Math.min(r, t.datepicker._getDaysInMonth(o, a));
                        break;

                      case "y":
                      case "Y":
                        o += parseInt(h[1], 10), r = Math.min(r, t.datepicker._getDaysInMonth(o, a));
                    }
                    h = l.exec(i);
                }
                return new Date(o, a, r);
            }, a = null == i || "" === i ? s : "string" == typeof i ? o(i) : "number" == typeof i ? isNaN(i) ? s : n(i) : new Date(i.getTime());
            return a = a && "Invalid Date" == "" + a ? s : a, a && (a.setHours(0), a.setMinutes(0), 
            a.setSeconds(0), a.setMilliseconds(0)), this._daylightSavingAdjust(a);
        },
        _daylightSavingAdjust: function(t) {
            return t ? (t.setHours(t.getHours() > 12 ? t.getHours() + 2 : 0), t) : null;
        },
        _setDate: function(t, e, i) {
            var s = !e, n = t.selectedMonth, o = t.selectedYear, a = this._restrictMinMax(t, this._determineDate(t, e, new Date()));
            t.selectedDay = t.currentDay = a.getDate(), t.drawMonth = t.selectedMonth = t.currentMonth = a.getMonth(), 
            t.drawYear = t.selectedYear = t.currentYear = a.getFullYear(), n === t.selectedMonth && o === t.selectedYear || i || this._notifyChange(t), 
            this._adjustInstDate(t), t.input && t.input.val(s ? "" : this._formatDate(t));
        },
        _getDate: function(t) {
            var e = !t.currentYear || t.input && "" === t.input.val() ? null : this._daylightSavingAdjust(new Date(t.currentYear, t.currentMonth, t.currentDay));
            return e;
        },
        _attachHandlers: function(e) {
            var i = this._get(e, "stepMonths"), s = "#" + e.id.replace(/\\\\/g, "\\");
            e.dpDiv.find("[data-handler]").map(function() {
                var e = {
                    prev: function() {
                        t.datepicker._adjustDate(s, -i, "M");
                    },
                    next: function() {
                        t.datepicker._adjustDate(s, +i, "M");
                    },
                    hide: function() {
                        t.datepicker._hideDatepicker();
                    },
                    today: function() {
                        t.datepicker._gotoToday(s);
                    },
                    selectDay: function() {
                        return t.datepicker._selectDay(s, +this.getAttribute("data-month"), +this.getAttribute("data-year"), this), 
                        !1;
                    },
                    selectMonth: function() {
                        return t.datepicker._selectMonthYear(s, this, "M"), !1;
                    },
                    selectYear: function() {
                        return t.datepicker._selectMonthYear(s, this, "Y"), !1;
                    }
                };
                t(this).on(this.getAttribute("data-event"), e[this.getAttribute("data-handler")]);
            });
        },
        _generateHTML: function(t) {
            var e, i, s, n, o, a, r, l, h, c, u, d, p, f, g, m, _, v, b, y, w, k, x, C, D, T, I, M, P, S, N, H, A, z, O, E, W, F, L, R = new Date(), Y = this._daylightSavingAdjust(new Date(R.getFullYear(), R.getMonth(), R.getDate())), B = this._get(t, "isRTL"), j = this._get(t, "showButtonPanel"), q = this._get(t, "hideIfNoPrevNext"), K = this._get(t, "navigationAsDateFormat"), U = this._getNumberOfMonths(t), V = this._get(t, "showCurrentAtPos"), X = this._get(t, "stepMonths"), $ = 1 !== U[0] || 1 !== U[1], G = this._daylightSavingAdjust(t.currentDay ? new Date(t.currentYear, t.currentMonth, t.currentDay) : new Date(9999, 9, 9)), J = this._getMinMaxDate(t, "min"), Q = this._getMinMaxDate(t, "max"), Z = t.drawMonth - V, te = t.drawYear;
            if (0 > Z && (Z += 12, te--), Q) for (e = this._daylightSavingAdjust(new Date(Q.getFullYear(), Q.getMonth() - U[0] * U[1] + 1, Q.getDate())), 
            e = J && J > e ? J : e; this._daylightSavingAdjust(new Date(te, Z, 1)) > e; ) Z--, 
            0 > Z && (Z = 11, te--);
            for (t.drawMonth = Z, t.drawYear = te, i = this._get(t, "prevText"), i = K ? this.formatDate(i, this._daylightSavingAdjust(new Date(te, Z - X, 1)), this._getFormatConfig(t)) : i, 
            s = this._canAdjustMonth(t, -1, te, Z) ? "<a class='ui-datepicker-prev ui-corner-all' data-handler='prev' data-event='click' title='" + i + "'><span class='ui-icon ui-icon-circle-triangle-" + (B ? "e" : "w") + "'>" + i + "</span></a>" : q ? "" : "<a class='ui-datepicker-prev ui-corner-all ui-state-disabled' title='" + i + "'><span class='ui-icon ui-icon-circle-triangle-" + (B ? "e" : "w") + "'>" + i + "</span></a>", 
            n = this._get(t, "nextText"), n = K ? this.formatDate(n, this._daylightSavingAdjust(new Date(te, Z + X, 1)), this._getFormatConfig(t)) : n, 
            o = this._canAdjustMonth(t, 1, te, Z) ? "<a class='ui-datepicker-next ui-corner-all' data-handler='next' data-event='click' title='" + n + "'><span class='ui-icon ui-icon-circle-triangle-" + (B ? "w" : "e") + "'>" + n + "</span></a>" : q ? "" : "<a class='ui-datepicker-next ui-corner-all ui-state-disabled' title='" + n + "'><span class='ui-icon ui-icon-circle-triangle-" + (B ? "w" : "e") + "'>" + n + "</span></a>", 
            a = this._get(t, "currentText"), r = this._get(t, "gotoCurrent") && t.currentDay ? G : Y, 
            a = K ? this.formatDate(a, r, this._getFormatConfig(t)) : a, l = t.inline ? "" : "<button type='button' class='ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all' data-handler='hide' data-event='click'>" + this._get(t, "closeText") + "</button>", 
            h = j ? "<div class='ui-datepicker-buttonpane ui-widget-content'>" + (B ? l : "") + (this._isInRange(t, r) ? "<button type='button' class='ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all' data-handler='today' data-event='click'>" + a + "</button>" : "") + (B ? "" : l) + "</div>" : "", 
            c = parseInt(this._get(t, "firstDay"), 10), c = isNaN(c) ? 0 : c, u = this._get(t, "showWeek"), 
            d = this._get(t, "dayNames"), p = this._get(t, "dayNamesMin"), f = this._get(t, "monthNames"), 
            g = this._get(t, "monthNamesShort"), m = this._get(t, "beforeShowDay"), _ = this._get(t, "showOtherMonths"), 
            v = this._get(t, "selectOtherMonths"), b = this._getDefaultDate(t), y = "", k = 0; U[0] > k; k++) {
                for (x = "", this.maxRows = 4, C = 0; U[1] > C; C++) {
                    if (D = this._daylightSavingAdjust(new Date(te, Z, t.selectedDay)), T = " ui-corner-all", 
                    I = "", $) {
                        if (I += "<div class='ui-datepicker-group", U[1] > 1) switch (C) {
                          case 0:
                            I += " ui-datepicker-group-first", T = " ui-corner-" + (B ? "right" : "left");
                            break;

                          case U[1] - 1:
                            I += " ui-datepicker-group-last", T = " ui-corner-" + (B ? "left" : "right");
                            break;

                          default:
                            I += " ui-datepicker-group-middle", T = "";
                        }
                        I += "'>";
                    }
                    for (I += "<div class='ui-datepicker-header ui-widget-header ui-helper-clearfix" + T + "'>" + (/all|left/.test(T) && 0 === k ? B ? o : s : "") + (/all|right/.test(T) && 0 === k ? B ? s : o : "") + this._generateMonthYearHeader(t, Z, te, J, Q, k > 0 || C > 0, f, g) + "</div><table class='ui-datepicker-calendar'><thead>" + "<tr>", 
                    M = u ? "<th class='ui-datepicker-week-col'>" + this._get(t, "weekHeader") + "</th>" : "", 
                    w = 0; 7 > w; w++) P = (w + c) % 7, M += "<th scope='col'" + ((w + c + 6) % 7 >= 5 ? " class='ui-datepicker-week-end'" : "") + ">" + "<span title='" + d[P] + "'>" + p[P] + "</span></th>";
                    for (I += M + "</tr></thead><tbody>", S = this._getDaysInMonth(te, Z), te === t.selectedYear && Z === t.selectedMonth && (t.selectedDay = Math.min(t.selectedDay, S)), 
                    N = (this._getFirstDayOfMonth(te, Z) - c + 7) % 7, H = Math.ceil((N + S) / 7), A = $ ? this.maxRows > H ? this.maxRows : H : H, 
                    this.maxRows = A, z = this._daylightSavingAdjust(new Date(te, Z, 1 - N)), O = 0; A > O; O++) {
                        for (I += "<tr>", E = u ? "<td class='ui-datepicker-week-col'>" + this._get(t, "calculateWeek")(z) + "</td>" : "", 
                        w = 0; 7 > w; w++) W = m ? m.apply(t.input ? t.input[0] : null, [ z ]) : [ !0, "" ], 
                        F = z.getMonth() !== Z, L = F && !v || !W[0] || J && J > z || Q && z > Q, E += "<td class='" + ((w + c + 6) % 7 >= 5 ? " ui-datepicker-week-end" : "") + (F ? " ui-datepicker-other-month" : "") + (z.getTime() === D.getTime() && Z === t.selectedMonth && t._keyEvent || b.getTime() === z.getTime() && b.getTime() === D.getTime() ? " " + this._dayOverClass : "") + (L ? " " + this._unselectableClass + " ui-state-disabled" : "") + (F && !_ ? "" : " " + W[1] + (z.getTime() === G.getTime() ? " " + this._currentClass : "") + (z.getTime() === Y.getTime() ? " ui-datepicker-today" : "")) + "'" + (F && !_ || !W[2] ? "" : " title='" + W[2].replace(/'/g, "&#39;") + "'") + (L ? "" : " data-handler='selectDay' data-event='click' data-month='" + z.getMonth() + "' data-year='" + z.getFullYear() + "'") + ">" + (F && !_ ? "&#xa0;" : L ? "<span class='ui-state-default'>" + z.getDate() + "</span>" : "<a class='ui-state-default" + (z.getTime() === Y.getTime() ? " ui-state-highlight" : "") + (z.getTime() === G.getTime() ? " ui-state-active" : "") + (F ? " ui-priority-secondary" : "") + "' href='#'>" + z.getDate() + "</a>") + "</td>", 
                        z.setDate(z.getDate() + 1), z = this._daylightSavingAdjust(z);
                        I += E + "</tr>";
                    }
                    Z++, Z > 11 && (Z = 0, te++), I += "</tbody></table>" + ($ ? "</div>" + (U[0] > 0 && C === U[1] - 1 ? "<div class='ui-datepicker-row-break'></div>" : "") : ""), 
                    x += I;
                }
                y += x;
            }
            return y += h, t._keyEvent = !1, y;
        },
        _generateMonthYearHeader: function(t, e, i, s, n, o, a, r) {
            var l, h, c, u, d, p, f, g, m = this._get(t, "changeMonth"), _ = this._get(t, "changeYear"), v = this._get(t, "showMonthAfterYear"), b = "<div class='ui-datepicker-title'>", y = "";
            if (o || !m) y += "<span class='ui-datepicker-month'>" + a[e] + "</span>"; else {
                for (l = s && s.getFullYear() === i, h = n && n.getFullYear() === i, y += "<select class='ui-datepicker-month' data-handler='selectMonth' data-event='change'>", 
                c = 0; 12 > c; c++) (!l || c >= s.getMonth()) && (!h || n.getMonth() >= c) && (y += "<option value='" + c + "'" + (c === e ? " selected='selected'" : "") + ">" + r[c] + "</option>");
                y += "</select>";
            }
            if (v || (b += y + (!o && m && _ ? "" : "&#xa0;")), !t.yearshtml) if (t.yearshtml = "", 
            o || !_) b += "<span class='ui-datepicker-year'>" + i + "</span>"; else {
                for (u = this._get(t, "yearRange").split(":"), d = new Date().getFullYear(), p = function(t) {
                    var e = t.match(/c[+\-].*/) ? i + parseInt(t.substring(1), 10) : t.match(/[+\-].*/) ? d + parseInt(t, 10) : parseInt(t, 10);
                    return isNaN(e) ? d : e;
                }, f = p(u[0]), g = Math.max(f, p(u[1] || "")), f = s ? Math.max(f, s.getFullYear()) : f, 
                g = n ? Math.min(g, n.getFullYear()) : g, t.yearshtml += "<select class='ui-datepicker-year' data-handler='selectYear' data-event='change'>"; g >= f; f++) t.yearshtml += "<option value='" + f + "'" + (f === i ? " selected='selected'" : "") + ">" + f + "</option>";
                t.yearshtml += "</select>", b += t.yearshtml, t.yearshtml = null;
            }
            return b += this._get(t, "yearSuffix"), v && (b += (!o && m && _ ? "" : "&#xa0;") + y), 
            b += "</div>";
        },
        _adjustInstDate: function(t, e, i) {
            var s = t.selectedYear + ("Y" === i ? e : 0), n = t.selectedMonth + ("M" === i ? e : 0), o = Math.min(t.selectedDay, this._getDaysInMonth(s, n)) + ("D" === i ? e : 0), a = this._restrictMinMax(t, this._daylightSavingAdjust(new Date(s, n, o)));
            t.selectedDay = a.getDate(), t.drawMonth = t.selectedMonth = a.getMonth(), t.drawYear = t.selectedYear = a.getFullYear(), 
            ("M" === i || "Y" === i) && this._notifyChange(t);
        },
        _restrictMinMax: function(t, e) {
            var i = this._getMinMaxDate(t, "min"), s = this._getMinMaxDate(t, "max"), n = i && i > e ? i : e;
            return s && n > s ? s : n;
        },
        _notifyChange: function(t) {
            var e = this._get(t, "onChangeMonthYear");
            e && e.apply(t.input ? t.input[0] : null, [ t.selectedYear, t.selectedMonth + 1, t ]);
        },
        _getNumberOfMonths: function(t) {
            var e = this._get(t, "numberOfMonths");
            return null == e ? [ 1, 1 ] : "number" == typeof e ? [ 1, e ] : e;
        },
        _getMinMaxDate: function(t, e) {
            return this._determineDate(t, this._get(t, e + "Date"), null);
        },
        _getDaysInMonth: function(t, e) {
            return 32 - this._daylightSavingAdjust(new Date(t, e, 32)).getDate();
        },
        _getFirstDayOfMonth: function(t, e) {
            return new Date(t, e, 1).getDay();
        },
        _canAdjustMonth: function(t, e, i, s) {
            var n = this._getNumberOfMonths(t), o = this._daylightSavingAdjust(new Date(i, s + (0 > e ? e : n[0] * n[1]), 1));
            return 0 > e && o.setDate(this._getDaysInMonth(o.getFullYear(), o.getMonth())), 
            this._isInRange(t, o);
        },
        _isInRange: function(t, e) {
            var i, s, n = this._getMinMaxDate(t, "min"), o = this._getMinMaxDate(t, "max"), a = null, r = null, l = this._get(t, "yearRange");
            return l && (i = l.split(":"), s = new Date().getFullYear(), a = parseInt(i[0], 10), 
            r = parseInt(i[1], 10), i[0].match(/[+\-].*/) && (a += s), i[1].match(/[+\-].*/) && (r += s)), 
            (!n || e.getTime() >= n.getTime()) && (!o || e.getTime() <= o.getTime()) && (!a || e.getFullYear() >= a) && (!r || r >= e.getFullYear());
        },
        _getFormatConfig: function(t) {
            var e = this._get(t, "shortYearCutoff");
            return e = "string" != typeof e ? e : new Date().getFullYear() % 100 + parseInt(e, 10), 
            {
                shortYearCutoff: e,
                dayNamesShort: this._get(t, "dayNamesShort"),
                dayNames: this._get(t, "dayNames"),
                monthNamesShort: this._get(t, "monthNamesShort"),
                monthNames: this._get(t, "monthNames")
            };
        },
        _formatDate: function(t, e, i, s) {
            e || (t.currentDay = t.selectedDay, t.currentMonth = t.selectedMonth, t.currentYear = t.selectedYear);
            var n = e ? "object" == typeof e ? e : this._daylightSavingAdjust(new Date(s, i, e)) : this._daylightSavingAdjust(new Date(t.currentYear, t.currentMonth, t.currentDay));
            return this.formatDate(this._get(t, "dateFormat"), n, this._getFormatConfig(t));
        }
    }), t.fn.datepicker = function(e) {
        if (!this.length) return this;
        t.datepicker.initialized || (t(document).on("mousedown", t.datepicker._checkExternalClick), 
        t.datepicker.initialized = !0), 0 === t("#" + t.datepicker._mainDivId).length && t("body").append(t.datepicker.dpDiv);
        var i = Array.prototype.slice.call(arguments, 1);
        return "string" != typeof e || "isDisabled" !== e && "getDate" !== e && "widget" !== e ? "option" === e && 2 === arguments.length && "string" == typeof arguments[1] ? t.datepicker["_" + e + "Datepicker"].apply(t.datepicker, [ this[0] ].concat(i)) : this.each(function() {
            "string" == typeof e ? t.datepicker["_" + e + "Datepicker"].apply(t.datepicker, [ this ].concat(i)) : t.datepicker._attachDatepicker(this, e);
        }) : t.datepicker["_" + e + "Datepicker"].apply(t.datepicker, [ this[0] ].concat(i));
    }, t.datepicker = new i(), t.datepicker.initialized = !1, t.datepicker.uuid = new Date().getTime(), 
    t.datepicker.version = "1.12.1", t.datepicker, t.widget("ui.menu", {
        version: "1.12.1",
        defaultElement: "<ul>",
        delay: 300,
        options: {
            icons: {
                submenu: "ui-icon-caret-1-e"
            },
            items: "> *",
            menus: "ul",
            position: {
                my: "left top",
                at: "right top"
            },
            role: "menu",
            blur: null,
            focus: null,
            select: null
        },
        _create: function() {
            this.activeMenu = this.element, this.mouseHandled = !1, this.element.uniqueId().attr({
                role: this.options.role,
                tabIndex: 0
            }), this._addClass("ui-menu", "ui-widget ui-widget-content"), this._on({
                "mousedown .ui-menu-item": function(t) {
                    t.preventDefault();
                },
                "click .ui-menu-item": function(e) {
                    var i = t(e.target), s = t(t.ui.safeActiveElement(this.document[0]));
                    !this.mouseHandled && i.not(".ui-state-disabled").length && (this.select(e), e.isPropagationStopped() || (this.mouseHandled = !0), 
                    i.has(".ui-menu").length ? this.expand(e) : !this.element.is(":focus") && s.closest(".ui-menu").length && (this.element.trigger("focus", [ !0 ]), 
                    this.active && 1 === this.active.parents(".ui-menu").length && clearTimeout(this.timer)));
                },
                "mouseenter .ui-menu-item": function(e) {
                    if (!this.previousFilter) {
                        var i = t(e.target).closest(".ui-menu-item"), s = t(e.currentTarget);
                        i[0] === s[0] && (this._removeClass(s.siblings().children(".ui-state-active"), null, "ui-state-active"), 
                        this.focus(e, s));
                    }
                },
                mouseleave: "collapseAll",
                "mouseleave .ui-menu": "collapseAll",
                focus: function(t, e) {
                    var i = this.active || this.element.find(this.options.items).eq(0);
                    e || this.focus(t, i);
                },
                blur: function(e) {
                    this._delay(function() {
                        var i = !t.contains(this.element[0], t.ui.safeActiveElement(this.document[0]));
                        i && this.collapseAll(e);
                    });
                },
                keydown: "_keydown"
            }), this.refresh(), this._on(this.document, {
                click: function(t) {
                    this._closeOnDocumentClick(t) && this.collapseAll(t), this.mouseHandled = !1;
                }
            });
        },
        _destroy: function() {
            var e = this.element.find(".ui-menu-item").removeAttr("role aria-disabled"), i = e.children(".ui-menu-item-wrapper").removeUniqueId().removeAttr("tabIndex role aria-haspopup");
            this.element.removeAttr("aria-activedescendant").find(".ui-menu").addBack().removeAttr("role aria-labelledby aria-expanded aria-hidden aria-disabled tabIndex").removeUniqueId().show(), 
            i.children().each(function() {
                var e = t(this);
                e.data("ui-menu-submenu-caret") && e.remove();
            });
        },
        _keydown: function(e) {
            var i, s, n, o, a = !0;
            switch (e.keyCode) {
              case t.ui.keyCode.PAGE_UP:
                this.previousPage(e);
                break;

              case t.ui.keyCode.PAGE_DOWN:
                this.nextPage(e);
                break;

              case t.ui.keyCode.HOME:
                this._move("first", "first", e);
                break;

              case t.ui.keyCode.END:
                this._move("last", "last", e);
                break;

              case t.ui.keyCode.UP:
                this.previous(e);
                break;

              case t.ui.keyCode.DOWN:
                this.next(e);
                break;

              case t.ui.keyCode.LEFT:
                this.collapse(e);
                break;

              case t.ui.keyCode.RIGHT:
                this.active && !this.active.is(".ui-state-disabled") && this.expand(e);
                break;

              case t.ui.keyCode.ENTER:
              case t.ui.keyCode.SPACE:
                this._activate(e);
                break;

              case t.ui.keyCode.ESCAPE:
                this.collapse(e);
                break;

              default:
                a = !1, s = this.previousFilter || "", o = !1, n = e.keyCode >= 96 && 105 >= e.keyCode ? "" + (e.keyCode - 96) : String.fromCharCode(e.keyCode), 
                clearTimeout(this.filterTimer), n === s ? o = !0 : n = s + n, i = this._filterMenuItems(n), 
                i = o && -1 !== i.index(this.active.next()) ? this.active.nextAll(".ui-menu-item") : i, 
                i.length || (n = String.fromCharCode(e.keyCode), i = this._filterMenuItems(n)), 
                i.length ? (this.focus(e, i), this.previousFilter = n, this.filterTimer = this._delay(function() {
                    delete this.previousFilter;
                }, 1e3)) : delete this.previousFilter;
            }
            a && e.preventDefault();
        },
        _activate: function(t) {
            this.active && !this.active.is(".ui-state-disabled") && (this.active.children("[aria-haspopup='true']").length ? this.expand(t) : this.select(t));
        },
        refresh: function() {
            var e, i, s, n, o, a = this, r = this.options.icons.submenu, l = this.element.find(this.options.menus);
            this._toggleClass("ui-menu-icons", null, !!this.element.find(".ui-icon").length), 
            s = l.filter(":not(.ui-menu)").hide().attr({
                role: this.options.role,
                "aria-hidden": "true",
                "aria-expanded": "false"
            }).each(function() {
                var e = t(this), i = e.prev(), s = t("<span>").data("ui-menu-submenu-caret", !0);
                a._addClass(s, "ui-menu-icon", "ui-icon " + r), i.attr("aria-haspopup", "true").prepend(s), 
                e.attr("aria-labelledby", i.attr("id"));
            }), this._addClass(s, "ui-menu", "ui-widget ui-widget-content ui-front"), e = l.add(this.element), 
            i = e.find(this.options.items), i.not(".ui-menu-item").each(function() {
                var e = t(this);
                a._isDivider(e) && a._addClass(e, "ui-menu-divider", "ui-widget-content");
            }), n = i.not(".ui-menu-item, .ui-menu-divider"), o = n.children().not(".ui-menu").uniqueId().attr({
                tabIndex: -1,
                role: this._itemRole()
            }), this._addClass(n, "ui-menu-item")._addClass(o, "ui-menu-item-wrapper"), i.filter(".ui-state-disabled").attr("aria-disabled", "true"), 
            this.active && !t.contains(this.element[0], this.active[0]) && this.blur();
        },
        _itemRole: function() {
            return {
                menu: "menuitem",
                listbox: "option"
            }[this.options.role];
        },
        _setOption: function(t, e) {
            if ("icons" === t) {
                var i = this.element.find(".ui-menu-icon");
                this._removeClass(i, null, this.options.icons.submenu)._addClass(i, null, e.submenu);
            }
            this._super(t, e);
        },
        _setOptionDisabled: function(t) {
            this._super(t), this.element.attr("aria-disabled", t + ""), this._toggleClass(null, "ui-state-disabled", !!t);
        },
        focus: function(t, e) {
            var i, s, n;
            this.blur(t, t && "focus" === t.type), this._scrollIntoView(e), this.active = e.first(), 
            s = this.active.children(".ui-menu-item-wrapper"), this._addClass(s, null, "ui-state-active"), 
            this.options.role && this.element.attr("aria-activedescendant", s.attr("id")), n = this.active.parent().closest(".ui-menu-item").children(".ui-menu-item-wrapper"), 
            this._addClass(n, null, "ui-state-active"), t && "keydown" === t.type ? this._close() : this.timer = this._delay(function() {
                this._close();
            }, this.delay), i = e.children(".ui-menu"), i.length && t && /^mouse/.test(t.type) && this._startOpening(i), 
            this.activeMenu = e.parent(), this._trigger("focus", t, {
                item: e
            });
        },
        _scrollIntoView: function(e) {
            var i, s, n, o, a, r;
            this._hasScroll() && (i = parseFloat(t.css(this.activeMenu[0], "borderTopWidth")) || 0, 
            s = parseFloat(t.css(this.activeMenu[0], "paddingTop")) || 0, n = e.offset().top - this.activeMenu.offset().top - i - s, 
            o = this.activeMenu.scrollTop(), a = this.activeMenu.height(), r = e.outerHeight(), 
            0 > n ? this.activeMenu.scrollTop(o + n) : n + r > a && this.activeMenu.scrollTop(o + n - a + r));
        },
        blur: function(t, e) {
            e || clearTimeout(this.timer), this.active && (this._removeClass(this.active.children(".ui-menu-item-wrapper"), null, "ui-state-active"), 
            this._trigger("blur", t, {
                item: this.active
            }), this.active = null);
        },
        _startOpening: function(t) {
            clearTimeout(this.timer), "true" === t.attr("aria-hidden") && (this.timer = this._delay(function() {
                this._close(), this._open(t);
            }, this.delay));
        },
        _open: function(e) {
            var i = t.extend({
                of: this.active
            }, this.options.position);
            clearTimeout(this.timer), this.element.find(".ui-menu").not(e.parents(".ui-menu")).hide().attr("aria-hidden", "true"), 
            e.show().removeAttr("aria-hidden").attr("aria-expanded", "true").position(i);
        },
        collapseAll: function(e, i) {
            clearTimeout(this.timer), this.timer = this._delay(function() {
                var s = i ? this.element : t(e && e.target).closest(this.element.find(".ui-menu"));
                s.length || (s = this.element), this._close(s), this.blur(e), this._removeClass(s.find(".ui-state-active"), null, "ui-state-active"), 
                this.activeMenu = s;
            }, this.delay);
        },
        _close: function(t) {
            t || (t = this.active ? this.active.parent() : this.element), t.find(".ui-menu").hide().attr("aria-hidden", "true").attr("aria-expanded", "false");
        },
        _closeOnDocumentClick: function(e) {
            return !t(e.target).closest(".ui-menu").length;
        },
        _isDivider: function(t) {
            return !/[^\-\u2014\u2013\s]/.test(t.text());
        },
        collapse: function(t) {
            var e = this.active && this.active.parent().closest(".ui-menu-item", this.element);
            e && e.length && (this._close(), this.focus(t, e));
        },
        expand: function(t) {
            var e = this.active && this.active.children(".ui-menu ").find(this.options.items).first();
            e && e.length && (this._open(e.parent()), this._delay(function() {
                this.focus(t, e);
            }));
        },
        next: function(t) {
            this._move("next", "first", t);
        },
        previous: function(t) {
            this._move("prev", "last", t);
        },
        isFirstItem: function() {
            return this.active && !this.active.prevAll(".ui-menu-item").length;
        },
        isLastItem: function() {
            return this.active && !this.active.nextAll(".ui-menu-item").length;
        },
        _move: function(t, e, i) {
            var s;
            this.active && (s = "first" === t || "last" === t ? this.active["first" === t ? "prevAll" : "nextAll"](".ui-menu-item").eq(-1) : this.active[t + "All"](".ui-menu-item").eq(0)), 
            s && s.length && this.active || (s = this.activeMenu.find(this.options.items)[e]()), 
            this.focus(i, s);
        },
        nextPage: function(e) {
            var i, s, n;
            return this.active ? (this.isLastItem() || (this._hasScroll() ? (s = this.active.offset().top, 
            n = this.element.height(), this.active.nextAll(".ui-menu-item").each(function() {
                return i = t(this), 0 > i.offset().top - s - n;
            }), this.focus(e, i)) : this.focus(e, this.activeMenu.find(this.options.items)[this.active ? "last" : "first"]())), 
            void 0) : (this.next(e), void 0);
        },
        previousPage: function(e) {
            var i, s, n;
            return this.active ? (this.isFirstItem() || (this._hasScroll() ? (s = this.active.offset().top, 
            n = this.element.height(), this.active.prevAll(".ui-menu-item").each(function() {
                return i = t(this), i.offset().top - s + n > 0;
            }), this.focus(e, i)) : this.focus(e, this.activeMenu.find(this.options.items).first())), 
            void 0) : (this.next(e), void 0);
        },
        _hasScroll: function() {
            return this.element.outerHeight() < this.element.prop("scrollHeight");
        },
        select: function(e) {
            this.active = this.active || t(e.target).closest(".ui-menu-item");
            var i = {
                item: this.active
            };
            this.active.has(".ui-menu").length || this.collapseAll(e, !0), this._trigger("select", e, i);
        },
        _filterMenuItems: function(e) {
            var i = e.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&"), s = RegExp("^" + i, "i");
            return this.activeMenu.find(this.options.items).filter(".ui-menu-item").filter(function() {
                return s.test(t.trim(t(this).children(".ui-menu-item-wrapper").text()));
            });
        }
    }), t.widget("ui.selectmenu", [ t.ui.formResetMixin, {
        version: "1.12.1",
        defaultElement: "<select>",
        options: {
            appendTo: null,
            classes: {
                "ui-selectmenu-button-open": "ui-corner-top",
                "ui-selectmenu-button-closed": "ui-corner-all"
            },
            disabled: null,
            icons: {
                button: "ui-icon-triangle-1-s"
            },
            position: {
                my: "left top",
                at: "left bottom",
                collision: "none"
            },
            width: !1,
            change: null,
            close: null,
            focus: null,
            open: null,
            select: null
        },
        _create: function() {
            var e = this.element.uniqueId().attr("id");
            this.ids = {
                element: e,
                button: e + "-button",
                menu: e + "-menu"
            }, this._drawButton(), this._drawMenu(), this._bindFormResetHandler(), this._rendered = !1, 
            this.menuItems = t();
        },
        _drawButton: function() {
            var e, i = this, s = this._parseOption(this.element.find("option:selected"), this.element[0].selectedIndex);
            this.labels = this.element.labels().attr("for", this.ids.button), this._on(this.labels, {
                click: function(t) {
                    this.button.focus(), t.preventDefault();
                }
            }), this.element.hide(), this.button = t("<span>", {
                tabindex: this.options.disabled ? -1 : 0,
                id: this.ids.button,
                role: "combobox",
                "aria-expanded": "false",
                "aria-autocomplete": "list",
                "aria-owns": this.ids.menu,
                "aria-haspopup": "true",
                title: this.element.attr("title")
            }).insertAfter(this.element), this._addClass(this.button, "ui-selectmenu-button ui-selectmenu-button-closed", "ui-button ui-widget"), 
            e = t("<span>").appendTo(this.button), this._addClass(e, "ui-selectmenu-icon", "ui-icon " + this.options.icons.button), 
            this.buttonItem = this._renderButtonItem(s).appendTo(this.button), this.options.width !== !1 && this._resizeButton(), 
            this._on(this.button, this._buttonEvents), this.button.one("focusin", function() {
                i._rendered || i._refreshMenu();
            });
        },
        _drawMenu: function() {
            var e = this;
            this.menu = t("<ul>", {
                "aria-hidden": "true",
                "aria-labelledby": this.ids.button,
                id: this.ids.menu
            }), this.menuWrap = t("<div>").append(this.menu), this._addClass(this.menuWrap, "ui-selectmenu-menu", "ui-front"), 
            this.menuWrap.appendTo(this._appendTo()), this.menuInstance = this.menu.menu({
                classes: {
                    "ui-menu": "ui-corner-bottom"
                },
                role: "listbox",
                select: function(t, i) {
                    t.preventDefault(), e._setSelection(), e._select(i.item.data("ui-selectmenu-item"), t);
                },
                focus: function(t, i) {
                    var s = i.item.data("ui-selectmenu-item");
                    null != e.focusIndex && s.index !== e.focusIndex && (e._trigger("focus", t, {
                        item: s
                    }), e.isOpen || e._select(s, t)), e.focusIndex = s.index, e.button.attr("aria-activedescendant", e.menuItems.eq(s.index).attr("id"));
                }
            }).menu("instance"), this.menuInstance._off(this.menu, "mouseleave"), this.menuInstance._closeOnDocumentClick = function() {
                return !1;
            }, this.menuInstance._isDivider = function() {
                return !1;
            };
        },
        refresh: function() {
            this._refreshMenu(), this.buttonItem.replaceWith(this.buttonItem = this._renderButtonItem(this._getSelectedItem().data("ui-selectmenu-item") || {})), 
            null === this.options.width && this._resizeButton();
        },
        _refreshMenu: function() {
            var t, e = this.element.find("option");
            this.menu.empty(), this._parseOptions(e), this._renderMenu(this.menu, this.items), 
            this.menuInstance.refresh(), this.menuItems = this.menu.find("li").not(".ui-selectmenu-optgroup").find(".ui-menu-item-wrapper"), 
            this._rendered = !0, e.length && (t = this._getSelectedItem(), this.menuInstance.focus(null, t), 
            this._setAria(t.data("ui-selectmenu-item")), this._setOption("disabled", this.element.prop("disabled")));
        },
        open: function(t) {
            this.options.disabled || (this._rendered ? (this._removeClass(this.menu.find(".ui-state-active"), null, "ui-state-active"), 
            this.menuInstance.focus(null, this._getSelectedItem())) : this._refreshMenu(), this.menuItems.length && (this.isOpen = !0, 
            this._toggleAttr(), this._resizeMenu(), this._position(), this._on(this.document, this._documentClick), 
            this._trigger("open", t)));
        },
        _position: function() {
            this.menuWrap.position(t.extend({
                of: this.button
            }, this.options.position));
        },
        close: function(t) {
            this.isOpen && (this.isOpen = !1, this._toggleAttr(), this.range = null, this._off(this.document), 
            this._trigger("close", t));
        },
        widget: function() {
            return this.button;
        },
        menuWidget: function() {
            return this.menu;
        },
        _renderButtonItem: function(e) {
            var i = t("<span>");
            return this._setText(i, e.label), this._addClass(i, "ui-selectmenu-text"), i;
        },
        _renderMenu: function(e, i) {
            var s = this, n = "";
            t.each(i, function(i, o) {
                var a;
                o.optgroup !== n && (a = t("<li>", {
                    text: o.optgroup
                }), s._addClass(a, "ui-selectmenu-optgroup", "ui-menu-divider" + (o.element.parent("optgroup").prop("disabled") ? " ui-state-disabled" : "")), 
                a.appendTo(e), n = o.optgroup), s._renderItemData(e, o);
            });
        },
        _renderItemData: function(t, e) {
            return this._renderItem(t, e).data("ui-selectmenu-item", e);
        },
        _renderItem: function(e, i) {
            var s = t("<li>"), n = t("<div>", {
                title: i.element.attr("title")
            });
            return i.disabled && this._addClass(s, null, "ui-state-disabled"), this._setText(n, i.label), 
            s.append(n).appendTo(e);
        },
        _setText: function(t, e) {
            e ? t.text(e) : t.html("&#160;");
        },
        _move: function(t, e) {
            var i, s, n = ".ui-menu-item";
            this.isOpen ? i = this.menuItems.eq(this.focusIndex).parent("li") : (i = this.menuItems.eq(this.element[0].selectedIndex).parent("li"), 
            n += ":not(.ui-state-disabled)"), s = "first" === t || "last" === t ? i["first" === t ? "prevAll" : "nextAll"](n).eq(-1) : i[t + "All"](n).eq(0), 
            s.length && this.menuInstance.focus(e, s);
        },
        _getSelectedItem: function() {
            return this.menuItems.eq(this.element[0].selectedIndex).parent("li");
        },
        _toggle: function(t) {
            this[this.isOpen ? "close" : "open"](t);
        },
        _setSelection: function() {
            var t;
            this.range && (window.getSelection ? (t = window.getSelection(), t.removeAllRanges(), 
            t.addRange(this.range)) : this.range.select(), this.button.focus());
        },
        _documentClick: {
            mousedown: function(e) {
                this.isOpen && (t(e.target).closest(".ui-selectmenu-menu, #" + t.ui.escapeSelector(this.ids.button)).length || this.close(e));
            }
        },
        _buttonEvents: {
            mousedown: function() {
                var t;
                window.getSelection ? (t = window.getSelection(), t.rangeCount && (this.range = t.getRangeAt(0))) : this.range = document.selection.createRange();
            },
            click: function(t) {
                this._setSelection(), this._toggle(t);
            },
            keydown: function(e) {
                var i = !0;
                switch (e.keyCode) {
                  case t.ui.keyCode.TAB:
                  case t.ui.keyCode.ESCAPE:
                    this.close(e), i = !1;
                    break;

                  case t.ui.keyCode.ENTER:
                    this.isOpen && this._selectFocusedItem(e);
                    break;

                  case t.ui.keyCode.UP:
                    e.altKey ? this._toggle(e) : this._move("prev", e);
                    break;

                  case t.ui.keyCode.DOWN:
                    e.altKey ? this._toggle(e) : this._move("next", e);
                    break;

                  case t.ui.keyCode.SPACE:
                    this.isOpen ? this._selectFocusedItem(e) : this._toggle(e);
                    break;

                  case t.ui.keyCode.LEFT:
                    this._move("prev", e);
                    break;

                  case t.ui.keyCode.RIGHT:
                    this._move("next", e);
                    break;

                  case t.ui.keyCode.HOME:
                  case t.ui.keyCode.PAGE_UP:
                    this._move("first", e);
                    break;

                  case t.ui.keyCode.END:
                  case t.ui.keyCode.PAGE_DOWN:
                    this._move("last", e);
                    break;

                  default:
                    this.menu.trigger(e), i = !1;
                }
                i && e.preventDefault();
            }
        },
        _selectFocusedItem: function(t) {
            var e = this.menuItems.eq(this.focusIndex).parent("li");
            e.hasClass("ui-state-disabled") || this._select(e.data("ui-selectmenu-item"), t);
        },
        _select: function(t, e) {
            var i = this.element[0].selectedIndex;
            this.element[0].selectedIndex = t.index, this.buttonItem.replaceWith(this.buttonItem = this._renderButtonItem(t)), 
            this._setAria(t), this._trigger("select", e, {
                item: t
            }), t.index !== i && this._trigger("change", e, {
                item: t
            }), this.close(e);
        },
        _setAria: function(t) {
            var e = this.menuItems.eq(t.index).attr("id");
            this.button.attr({
                "aria-labelledby": e,
                "aria-activedescendant": e
            }), this.menu.attr("aria-activedescendant", e);
        },
        _setOption: function(t, e) {
            if ("icons" === t) {
                var i = this.button.find("span.ui-icon");
                this._removeClass(i, null, this.options.icons.button)._addClass(i, null, e.button);
            }
            this._super(t, e), "appendTo" === t && this.menuWrap.appendTo(this._appendTo()), 
            "width" === t && this._resizeButton();
        },
        _setOptionDisabled: function(t) {
            this._super(t), this.menuInstance.option("disabled", t), this.button.attr("aria-disabled", t), 
            this._toggleClass(this.button, null, "ui-state-disabled", t), this.element.prop("disabled", t), 
            t ? (this.button.attr("tabindex", -1), this.close()) : this.button.attr("tabindex", 0);
        },
        _appendTo: function() {
            var e = this.options.appendTo;
            return e && (e = e.jquery || e.nodeType ? t(e) : this.document.find(e).eq(0)), e && e[0] || (e = this.element.closest(".ui-front, dialog")), 
            e.length || (e = this.document[0].body), e;
        },
        _toggleAttr: function() {
            this.button.attr("aria-expanded", this.isOpen), this._removeClass(this.button, "ui-selectmenu-button-" + (this.isOpen ? "closed" : "open"))._addClass(this.button, "ui-selectmenu-button-" + (this.isOpen ? "open" : "closed"))._toggleClass(this.menuWrap, "ui-selectmenu-open", null, this.isOpen), 
            this.menu.attr("aria-hidden", !this.isOpen);
        },
        _resizeButton: function() {
            var t = this.options.width;
            return t === !1 ? (this.button.css("width", ""), void 0) : (null === t && (t = this.element.show().outerWidth(), 
            this.element.hide()), this.button.outerWidth(t), void 0);
        },
        _resizeMenu: function() {
            this.menu.outerWidth(Math.max(this.button.outerWidth(), this.menu.width("").outerWidth() + 1));
        },
        _getCreateOptions: function() {
            var t = this._super();
            return t.disabled = this.element.prop("disabled"), t;
        },
        _parseOptions: function(e) {
            var i = this, s = [];
            e.each(function(e, n) {
                s.push(i._parseOption(t(n), e));
            }), this.items = s;
        },
        _parseOption: function(t, e) {
            var i = t.parent("optgroup");
            return {
                element: t,
                index: e,
                value: t.val(),
                label: t.text(),
                optgroup: i.attr("label") || "",
                disabled: i.prop("disabled") || t.prop("disabled")
            };
        },
        _destroy: function() {
            this._unbindFormResetHandler(), this.menuWrap.remove(), this.button.remove(), this.element.show(), 
            this.element.removeUniqueId(), this.labels.attr("for", this.ids.element);
        }
    } ]), t.widget("ui.slider", t.ui.mouse, {
        version: "1.12.1",
        widgetEventPrefix: "slide",
        options: {
            animate: !1,
            classes: {
                "ui-slider": "ui-corner-all",
                "ui-slider-handle": "ui-corner-all",
                "ui-slider-range": "ui-corner-all ui-widget-header"
            },
            distance: 0,
            max: 100,
            min: 0,
            orientation: "horizontal",
            range: !1,
            step: 1,
            value: 0,
            values: null,
            change: null,
            slide: null,
            start: null,
            stop: null
        },
        numPages: 5,
        _create: function() {
            this._keySliding = !1, this._mouseSliding = !1, this._animateOff = !0, this._handleIndex = null, 
            this._detectOrientation(), this._mouseInit(), this._calculateNewMax(), this._addClass("ui-slider ui-slider-" + this.orientation, "ui-widget ui-widget-content"), 
            this._refresh(), this._animateOff = !1;
        },
        _refresh: function() {
            this._createRange(), this._createHandles(), this._setupEvents(), this._refreshValue();
        },
        _createHandles: function() {
            var e, i, s = this.options, n = this.element.find(".ui-slider-handle"), o = "<span tabindex='0'></span>", a = [];
            for (i = s.values && s.values.length || 1, n.length > i && (n.slice(i).remove(), 
            n = n.slice(0, i)), e = n.length; i > e; e++) a.push(o);
            this.handles = n.add(t(a.join("")).appendTo(this.element)), this._addClass(this.handles, "ui-slider-handle", "ui-state-default"), 
            this.handle = this.handles.eq(0), this.handles.each(function(e) {
                t(this).data("ui-slider-handle-index", e).attr("tabIndex", 0);
            });
        },
        _createRange: function() {
            var e = this.options;
            e.range ? (e.range === !0 && (e.values ? e.values.length && 2 !== e.values.length ? e.values = [ e.values[0], e.values[0] ] : t.isArray(e.values) && (e.values = e.values.slice(0)) : e.values = [ this._valueMin(), this._valueMin() ]), 
            this.range && this.range.length ? (this._removeClass(this.range, "ui-slider-range-min ui-slider-range-max"), 
            this.range.css({
                left: "",
                bottom: ""
            })) : (this.range = t("<div>").appendTo(this.element), this._addClass(this.range, "ui-slider-range")), 
            ("min" === e.range || "max" === e.range) && this._addClass(this.range, "ui-slider-range-" + e.range)) : (this.range && this.range.remove(), 
            this.range = null);
        },
        _setupEvents: function() {
            this._off(this.handles), this._on(this.handles, this._handleEvents), this._hoverable(this.handles), 
            this._focusable(this.handles);
        },
        _destroy: function() {
            this.handles.remove(), this.range && this.range.remove(), this._mouseDestroy();
        },
        _mouseCapture: function(e) {
            var i, s, n, o, a, r, l, h, c = this, u = this.options;
            return u.disabled ? !1 : (this.elementSize = {
                width: this.element.outerWidth(),
                height: this.element.outerHeight()
            }, this.elementOffset = this.element.offset(), i = {
                x: e.pageX,
                y: e.pageY
            }, s = this._normValueFromMouse(i), n = this._valueMax() - this._valueMin() + 1, 
            this.handles.each(function(e) {
                var i = Math.abs(s - c.values(e));
                (n > i || n === i && (e === c._lastChangedValue || c.values(e) === u.min)) && (n = i, 
                o = t(this), a = e);
            }), r = this._start(e, a), r === !1 ? !1 : (this._mouseSliding = !0, this._handleIndex = a, 
            this._addClass(o, null, "ui-state-active"), o.trigger("focus"), l = o.offset(), 
            h = !t(e.target).parents().addBack().is(".ui-slider-handle"), this._clickOffset = h ? {
                left: 0,
                top: 0
            } : {
                left: e.pageX - l.left - o.width() / 2,
                top: e.pageY - l.top - o.height() / 2 - (parseInt(o.css("borderTopWidth"), 10) || 0) - (parseInt(o.css("borderBottomWidth"), 10) || 0) + (parseInt(o.css("marginTop"), 10) || 0)
            }, this.handles.hasClass("ui-state-hover") || this._slide(e, a, s), this._animateOff = !0, 
            !0));
        },
        _mouseStart: function() {
            return !0;
        },
        _mouseDrag: function(t) {
            var e = {
                x: t.pageX,
                y: t.pageY
            }, i = this._normValueFromMouse(e);
            return this._slide(t, this._handleIndex, i), !1;
        },
        _mouseStop: function(t) {
            return this._removeClass(this.handles, null, "ui-state-active"), this._mouseSliding = !1, 
            this._stop(t, this._handleIndex), this._change(t, this._handleIndex), this._handleIndex = null, 
            this._clickOffset = null, this._animateOff = !1, !1;
        },
        _detectOrientation: function() {
            this.orientation = "vertical" === this.options.orientation ? "vertical" : "horizontal";
        },
        _normValueFromMouse: function(t) {
            var e, i, s, n, o;
            return "horizontal" === this.orientation ? (e = this.elementSize.width, i = t.x - this.elementOffset.left - (this._clickOffset ? this._clickOffset.left : 0)) : (e = this.elementSize.height, 
            i = t.y - this.elementOffset.top - (this._clickOffset ? this._clickOffset.top : 0)), 
            s = i / e, s > 1 && (s = 1), 0 > s && (s = 0), "vertical" === this.orientation && (s = 1 - s), 
            n = this._valueMax() - this._valueMin(), o = this._valueMin() + s * n, this._trimAlignValue(o);
        },
        _uiHash: function(t, e, i) {
            var s = {
                handle: this.handles[t],
                handleIndex: t,
                value: void 0 !== e ? e : this.value()
            };
            return this._hasMultipleValues() && (s.value = void 0 !== e ? e : this.values(t), 
            s.values = i || this.values()), s;
        },
        _hasMultipleValues: function() {
            return this.options.values && this.options.values.length;
        },
        _start: function(t, e) {
            return this._trigger("start", t, this._uiHash(e));
        },
        _slide: function(t, e, i) {
            var s, n, o = this.value(), a = this.values();
            this._hasMultipleValues() && (n = this.values(e ? 0 : 1), o = this.values(e), 2 === this.options.values.length && this.options.range === !0 && (i = 0 === e ? Math.min(n, i) : Math.max(n, i)), 
            a[e] = i), i !== o && (s = this._trigger("slide", t, this._uiHash(e, i, a)), s !== !1 && (this._hasMultipleValues() ? this.values(e, i) : this.value(i)));
        },
        _stop: function(t, e) {
            this._trigger("stop", t, this._uiHash(e));
        },
        _change: function(t, e) {
            this._keySliding || this._mouseSliding || (this._lastChangedValue = e, this._trigger("change", t, this._uiHash(e)));
        },
        value: function(t) {
            return arguments.length ? (this.options.value = this._trimAlignValue(t), this._refreshValue(), 
            this._change(null, 0), void 0) : this._value();
        },
        values: function(e, i) {
            var s, n, o;
            if (arguments.length > 1) return this.options.values[e] = this._trimAlignValue(i), 
            this._refreshValue(), this._change(null, e), void 0;
            if (!arguments.length) return this._values();
            if (!t.isArray(arguments[0])) return this._hasMultipleValues() ? this._values(e) : this.value();
            for (s = this.options.values, n = arguments[0], o = 0; s.length > o; o += 1) s[o] = this._trimAlignValue(n[o]), 
            this._change(null, o);
            this._refreshValue();
        },
        _setOption: function(e, i) {
            var s, n = 0;
            switch ("range" === e && this.options.range === !0 && ("min" === i ? (this.options.value = this._values(0), 
            this.options.values = null) : "max" === i && (this.options.value = this._values(this.options.values.length - 1), 
            this.options.values = null)), t.isArray(this.options.values) && (n = this.options.values.length), 
            this._super(e, i), e) {
              case "orientation":
                this._detectOrientation(), this._removeClass("ui-slider-horizontal ui-slider-vertical")._addClass("ui-slider-" + this.orientation), 
                this._refreshValue(), this.options.range && this._refreshRange(i), this.handles.css("horizontal" === i ? "bottom" : "left", "");
                break;

              case "value":
                this._animateOff = !0, this._refreshValue(), this._change(null, 0), this._animateOff = !1;
                break;

              case "values":
                for (this._animateOff = !0, this._refreshValue(), s = n - 1; s >= 0; s--) this._change(null, s);
                this._animateOff = !1;
                break;

              case "step":
              case "min":
              case "max":
                this._animateOff = !0, this._calculateNewMax(), this._refreshValue(), this._animateOff = !1;
                break;

              case "range":
                this._animateOff = !0, this._refresh(), this._animateOff = !1;
            }
        },
        _setOptionDisabled: function(t) {
            this._super(t), this._toggleClass(null, "ui-state-disabled", !!t);
        },
        _value: function() {
            var t = this.options.value;
            return t = this._trimAlignValue(t);
        },
        _values: function(t) {
            var e, i, s;
            if (arguments.length) return e = this.options.values[t], e = this._trimAlignValue(e);
            if (this._hasMultipleValues()) {
                for (i = this.options.values.slice(), s = 0; i.length > s; s += 1) i[s] = this._trimAlignValue(i[s]);
                return i;
            }
            return [];
        },
        _trimAlignValue: function(t) {
            if (this._valueMin() >= t) return this._valueMin();
            if (t >= this._valueMax()) return this._valueMax();
            var e = this.options.step > 0 ? this.options.step : 1, i = (t - this._valueMin()) % e, s = t - i;
            return 2 * Math.abs(i) >= e && (s += i > 0 ? e : -e), parseFloat(s.toFixed(5));
        },
        _calculateNewMax: function() {
            var t = this.options.max, e = this._valueMin(), i = this.options.step, s = Math.round((t - e) / i) * i;
            t = s + e, t > this.options.max && (t -= i), this.max = parseFloat(t.toFixed(this._precision()));
        },
        _precision: function() {
            var t = this._precisionOf(this.options.step);
            return null !== this.options.min && (t = Math.max(t, this._precisionOf(this.options.min))), 
            t;
        },
        _precisionOf: function(t) {
            var e = "" + t, i = e.indexOf(".");
            return -1 === i ? 0 : e.length - i - 1;
        },
        _valueMin: function() {
            return this.options.min;
        },
        _valueMax: function() {
            return this.max;
        },
        _refreshRange: function(t) {
            "vertical" === t && this.range.css({
                width: "",
                left: ""
            }), "horizontal" === t && this.range.css({
                height: "",
                bottom: ""
            });
        },
        _refreshValue: function() {
            var e, i, s, n, o, a = this.options.range, r = this.options, l = this, h = this._animateOff ? !1 : r.animate, c = {};
            this._hasMultipleValues() ? this.handles.each(function(s) {
                i = 100 * ((l.values(s) - l._valueMin()) / (l._valueMax() - l._valueMin())), c["horizontal" === l.orientation ? "left" : "bottom"] = i + "%", 
                t(this).stop(1, 1)[h ? "animate" : "css"](c, r.animate), l.options.range === !0 && ("horizontal" === l.orientation ? (0 === s && l.range.stop(1, 1)[h ? "animate" : "css"]({
                    left: i + "%"
                }, r.animate), 1 === s && l.range[h ? "animate" : "css"]({
                    width: i - e + "%"
                }, {
                    queue: !1,
                    duration: r.animate
                })) : (0 === s && l.range.stop(1, 1)[h ? "animate" : "css"]({
                    bottom: i + "%"
                }, r.animate), 1 === s && l.range[h ? "animate" : "css"]({
                    height: i - e + "%"
                }, {
                    queue: !1,
                    duration: r.animate
                }))), e = i;
            }) : (s = this.value(), n = this._valueMin(), o = this._valueMax(), i = o !== n ? 100 * ((s - n) / (o - n)) : 0, 
            c["horizontal" === this.orientation ? "left" : "bottom"] = i + "%", this.handle.stop(1, 1)[h ? "animate" : "css"](c, r.animate), 
            "min" === a && "horizontal" === this.orientation && this.range.stop(1, 1)[h ? "animate" : "css"]({
                width: i + "%"
            }, r.animate), "max" === a && "horizontal" === this.orientation && this.range.stop(1, 1)[h ? "animate" : "css"]({
                width: 100 - i + "%"
            }, r.animate), "min" === a && "vertical" === this.orientation && this.range.stop(1, 1)[h ? "animate" : "css"]({
                height: i + "%"
            }, r.animate), "max" === a && "vertical" === this.orientation && this.range.stop(1, 1)[h ? "animate" : "css"]({
                height: 100 - i + "%"
            }, r.animate));
        },
        _handleEvents: {
            keydown: function(e) {
                var i, s, n, o, a = t(e.target).data("ui-slider-handle-index");
                switch (e.keyCode) {
                  case t.ui.keyCode.HOME:
                  case t.ui.keyCode.END:
                  case t.ui.keyCode.PAGE_UP:
                  case t.ui.keyCode.PAGE_DOWN:
                  case t.ui.keyCode.UP:
                  case t.ui.keyCode.RIGHT:
                  case t.ui.keyCode.DOWN:
                  case t.ui.keyCode.LEFT:
                    if (e.preventDefault(), !this._keySliding && (this._keySliding = !0, this._addClass(t(e.target), null, "ui-state-active"), 
                    i = this._start(e, a), i === !1)) return;
                }
                switch (o = this.options.step, s = n = this._hasMultipleValues() ? this.values(a) : this.value(), 
                e.keyCode) {
                  case t.ui.keyCode.HOME:
                    n = this._valueMin();
                    break;

                  case t.ui.keyCode.END:
                    n = this._valueMax();
                    break;

                  case t.ui.keyCode.PAGE_UP:
                    n = this._trimAlignValue(s + (this._valueMax() - this._valueMin()) / this.numPages);
                    break;

                  case t.ui.keyCode.PAGE_DOWN:
                    n = this._trimAlignValue(s - (this._valueMax() - this._valueMin()) / this.numPages);
                    break;

                  case t.ui.keyCode.UP:
                  case t.ui.keyCode.RIGHT:
                    if (s === this._valueMax()) return;
                    n = this._trimAlignValue(s + o);
                    break;

                  case t.ui.keyCode.DOWN:
                  case t.ui.keyCode.LEFT:
                    if (s === this._valueMin()) return;
                    n = this._trimAlignValue(s - o);
                }
                this._slide(e, a, n);
            },
            keyup: function(e) {
                var i = t(e.target).data("ui-slider-handle-index");
                this._keySliding && (this._keySliding = !1, this._stop(e, i), this._change(e, i), 
                this._removeClass(t(e.target), null, "ui-state-active"));
            }
        }
    }), t.widget("ui.spinner", {
        version: "1.12.1",
        defaultElement: "<input>",
        widgetEventPrefix: "spin",
        options: {
            classes: {
                "ui-spinner": "ui-corner-all",
                "ui-spinner-down": "ui-corner-br",
                "ui-spinner-up": "ui-corner-tr"
            },
            culture: null,
            icons: {
                down: "ui-icon-triangle-1-s",
                up: "ui-icon-triangle-1-n"
            },
            incremental: !0,
            max: null,
            min: null,
            numberFormat: null,
            page: 10,
            step: 1,
            change: null,
            spin: null,
            start: null,
            stop: null
        },
        _create: function() {
            this._setOption("max", this.options.max), this._setOption("min", this.options.min), 
            this._setOption("step", this.options.step), "" !== this.value() && this._value(this.element.val(), !0), 
            this._draw(), this._on(this._events), this._refresh(), this._on(this.window, {
                beforeunload: function() {
                    this.element.removeAttr("autocomplete");
                }
            });
        },
        _getCreateOptions: function() {
            var e = this._super(), i = this.element;
            return t.each([ "min", "max", "step" ], function(t, s) {
                var n = i.attr(s);
                null != n && n.length && (e[s] = n);
            }), e;
        },
        _events: {
            keydown: function(t) {
                this._start(t) && this._keydown(t) && t.preventDefault();
            },
            keyup: "_stop",
            focus: function() {
                this.previous = this.element.val();
            },
            blur: function(t) {
                return this.cancelBlur ? (delete this.cancelBlur, void 0) : (this._stop(), this._refresh(), 
                this.previous !== this.element.val() && this._trigger("change", t), void 0);
            },
            mousewheel: function(t, e) {
                if (e) {
                    if (!this.spinning && !this._start(t)) return !1;
                    this._spin((e > 0 ? 1 : -1) * this.options.step, t), clearTimeout(this.mousewheelTimer), 
                    this.mousewheelTimer = this._delay(function() {
                        this.spinning && this._stop(t);
                    }, 100), t.preventDefault();
                }
            },
            "mousedown .ui-spinner-button": function(e) {
                function i() {
                    var e = this.element[0] === t.ui.safeActiveElement(this.document[0]);
                    e || (this.element.trigger("focus"), this.previous = s, this._delay(function() {
                        this.previous = s;
                    }));
                }
                var s;
                s = this.element[0] === t.ui.safeActiveElement(this.document[0]) ? this.previous : this.element.val(), 
                e.preventDefault(), i.call(this), this.cancelBlur = !0, this._delay(function() {
                    delete this.cancelBlur, i.call(this);
                }), this._start(e) !== !1 && this._repeat(null, t(e.currentTarget).hasClass("ui-spinner-up") ? 1 : -1, e);
            },
            "mouseup .ui-spinner-button": "_stop",
            "mouseenter .ui-spinner-button": function(e) {
                return t(e.currentTarget).hasClass("ui-state-active") ? this._start(e) === !1 ? !1 : (this._repeat(null, t(e.currentTarget).hasClass("ui-spinner-up") ? 1 : -1, e), 
                void 0) : void 0;
            },
            "mouseleave .ui-spinner-button": "_stop"
        },
        _enhance: function() {
            this.uiSpinner = this.element.attr("autocomplete", "off").wrap("<span>").parent().append("<a></a><a></a>");
        },
        _draw: function() {
            this._enhance(), this._addClass(this.uiSpinner, "ui-spinner", "ui-widget ui-widget-content"), 
            this._addClass("ui-spinner-input"), this.element.attr("role", "spinbutton"), this.buttons = this.uiSpinner.children("a").attr("tabIndex", -1).attr("aria-hidden", !0).button({
                classes: {
                    "ui-button": ""
                }
            }), this._removeClass(this.buttons, "ui-corner-all"), this._addClass(this.buttons.first(), "ui-spinner-button ui-spinner-up"), 
            this._addClass(this.buttons.last(), "ui-spinner-button ui-spinner-down"), this.buttons.first().button({
                icon: this.options.icons.up,
                showLabel: !1
            }), this.buttons.last().button({
                icon: this.options.icons.down,
                showLabel: !1
            }), this.buttons.height() > Math.ceil(.5 * this.uiSpinner.height()) && this.uiSpinner.height() > 0 && this.uiSpinner.height(this.uiSpinner.height());
        },
        _keydown: function(e) {
            var i = this.options, s = t.ui.keyCode;
            switch (e.keyCode) {
              case s.UP:
                return this._repeat(null, 1, e), !0;

              case s.DOWN:
                return this._repeat(null, -1, e), !0;

              case s.PAGE_UP:
                return this._repeat(null, i.page, e), !0;

              case s.PAGE_DOWN:
                return this._repeat(null, -i.page, e), !0;
            }
            return !1;
        },
        _start: function(t) {
            return this.spinning || this._trigger("start", t) !== !1 ? (this.counter || (this.counter = 1), 
            this.spinning = !0, !0) : !1;
        },
        _repeat: function(t, e, i) {
            t = t || 500, clearTimeout(this.timer), this.timer = this._delay(function() {
                this._repeat(40, e, i);
            }, t), this._spin(e * this.options.step, i);
        },
        _spin: function(t, e) {
            var i = this.value() || 0;
            this.counter || (this.counter = 1), i = this._adjustValue(i + t * this._increment(this.counter)), 
            this.spinning && this._trigger("spin", e, {
                value: i
            }) === !1 || (this._value(i), this.counter++);
        },
        _increment: function(e) {
            var i = this.options.incremental;
            return i ? t.isFunction(i) ? i(e) : Math.floor(e * e * e / 5e4 - e * e / 500 + 17 * e / 200 + 1) : 1;
        },
        _precision: function() {
            var t = this._precisionOf(this.options.step);
            return null !== this.options.min && (t = Math.max(t, this._precisionOf(this.options.min))), 
            t;
        },
        _precisionOf: function(t) {
            var e = "" + t, i = e.indexOf(".");
            return -1 === i ? 0 : e.length - i - 1;
        },
        _adjustValue: function(t) {
            var e, i, s = this.options;
            return e = null !== s.min ? s.min : 0, i = t - e, i = Math.round(i / s.step) * s.step, 
            t = e + i, t = parseFloat(t.toFixed(this._precision())), null !== s.max && t > s.max ? s.max : null !== s.min && s.min > t ? s.min : t;
        },
        _stop: function(t) {
            this.spinning && (clearTimeout(this.timer), clearTimeout(this.mousewheelTimer), 
            this.counter = 0, this.spinning = !1, this._trigger("stop", t));
        },
        _setOption: function(t, e) {
            var i, s, n;
            return "culture" === t || "numberFormat" === t ? (i = this._parse(this.element.val()), 
            this.options[t] = e, this.element.val(this._format(i)), void 0) : (("max" === t || "min" === t || "step" === t) && "string" == typeof e && (e = this._parse(e)), 
            "icons" === t && (s = this.buttons.first().find(".ui-icon"), this._removeClass(s, null, this.options.icons.up), 
            this._addClass(s, null, e.up), n = this.buttons.last().find(".ui-icon"), this._removeClass(n, null, this.options.icons.down), 
            this._addClass(n, null, e.down)), this._super(t, e), void 0);
        },
        _setOptionDisabled: function(t) {
            this._super(t), this._toggleClass(this.uiSpinner, null, "ui-state-disabled", !!t), 
            this.element.prop("disabled", !!t), this.buttons.button(t ? "disable" : "enable");
        },
        _setOptions: a(function(t) {
            this._super(t);
        }),
        _parse: function(t) {
            return "string" == typeof t && "" !== t && (t = window.Globalize && this.options.numberFormat ? Globalize.parseFloat(t, 10, this.options.culture) : +t), 
            "" === t || isNaN(t) ? null : t;
        },
        _format: function(t) {
            return "" === t ? "" : window.Globalize && this.options.numberFormat ? Globalize.format(t, this.options.numberFormat, this.options.culture) : t;
        },
        _refresh: function() {
            this.element.attr({
                "aria-valuemin": this.options.min,
                "aria-valuemax": this.options.max,
                "aria-valuenow": this._parse(this.element.val())
            });
        },
        isValid: function() {
            var t = this.value();
            return null === t ? !1 : t === this._adjustValue(t);
        },
        _value: function(t, e) {
            var i;
            "" !== t && (i = this._parse(t), null !== i && (e || (i = this._adjustValue(i)), 
            t = this._format(i))), this.element.val(t), this._refresh();
        },
        _destroy: function() {
            this.element.prop("disabled", !1).removeAttr("autocomplete role aria-valuemin aria-valuemax aria-valuenow"), 
            this.uiSpinner.replaceWith(this.element);
        },
        stepUp: a(function(t) {
            this._stepUp(t);
        }),
        _stepUp: function(t) {
            this._start() && (this._spin((t || 1) * this.options.step), this._stop());
        },
        stepDown: a(function(t) {
            this._stepDown(t);
        }),
        _stepDown: function(t) {
            this._start() && (this._spin((t || 1) * -this.options.step), this._stop());
        },
        pageUp: a(function(t) {
            this._stepUp((t || 1) * this.options.page);
        }),
        pageDown: a(function(t) {
            this._stepDown((t || 1) * this.options.page);
        }),
        value: function(t) {
            return arguments.length ? (a(this._value).call(this, t), void 0) : this._parse(this.element.val());
        },
        widget: function() {
            return this.uiSpinner;
        }
    }), t.uiBackCompat !== !1 && t.widget("ui.spinner", t.ui.spinner, {
        _enhance: function() {
            this.uiSpinner = this.element.attr("autocomplete", "off").wrap(this._uiSpinnerHtml()).parent().append(this._buttonHtml());
        },
        _uiSpinnerHtml: function() {
            return "<span>";
        },
        _buttonHtml: function() {
            return "<a></a><a></a>";
        }
    }), t.ui.spinner;
});

if ("undefined" == typeof jQuery) throw new Error("Bootstrap's JavaScript requires jQuery");

+function(t) {
    "use strict";
    var e = t.fn.jquery.split(" ")[0].split(".");
    if (e[0] < 2 && e[1] < 9 || 1 == e[0] && 9 == e[1] && e[2] < 1 || e[0] > 3) throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher, but lower than version 4");
}(jQuery), +function(t) {
    "use strict";
    function e(e) {
        var i = e.attr("data-target");
        i || (i = e.attr("href"), i = i && /#[A-Za-z]/.test(i) && i.replace(/.*(?=#[^\s]*$)/, ""));
        var n = i && t(i);
        return n && n.length ? n : e.parent();
    }
    function i(i) {
        i && 3 === i.which || (t(s).remove(), t(o).each(function() {
            var n = t(this), s = e(n), o = {
                relatedTarget: this
            };
            s.hasClass("open") && (i && "click" == i.type && /input|textarea/i.test(i.target.tagName) && t.contains(s[0], i.target) || (s.trigger(i = t.Event("hide.bs.dropdown", o)), 
            i.isDefaultPrevented() || (n.attr("aria-expanded", "false"), s.removeClass("open").trigger(t.Event("hidden.bs.dropdown", o)))));
        }));
    }
    function n(e) {
        return this.each(function() {
            var i = t(this), n = i.data("bs.dropdown");
            n || i.data("bs.dropdown", n = new a(this)), "string" == typeof e && n[e].call(i);
        });
    }
    var s = ".dropdown-backdrop", o = '[data-toggle="dropdown"]', a = function(e) {
        t(e).on("click.bs.dropdown", this.toggle);
    };
    a.VERSION = "3.3.7", a.prototype.toggle = function(n) {
        var s = t(this);
        if (!s.is(".disabled, :disabled")) {
            var o = e(s), a = o.hasClass("open");
            if (i(), !a) {
                "ontouchstart" in document.documentElement && !o.closest(".navbar-nav").length && t(document.createElement("div")).addClass("dropdown-backdrop").insertAfter(t(this)).on("click", i);
                var r = {
                    relatedTarget: this
                };
                if (o.trigger(n = t.Event("show.bs.dropdown", r)), n.isDefaultPrevented()) return;
                s.trigger("focus").attr("aria-expanded", "true"), o.toggleClass("open").trigger(t.Event("shown.bs.dropdown", r));
            }
            return !1;
        }
    }, a.prototype.keydown = function(i) {
        if (/(38|40|27|32)/.test(i.which) && !/input|textarea/i.test(i.target.tagName)) {
            var n = t(this);
            if (i.preventDefault(), i.stopPropagation(), !n.is(".disabled, :disabled")) {
                var s = e(n), a = s.hasClass("open");
                if (!a && 27 != i.which || a && 27 == i.which) return 27 == i.which && s.find(o).trigger("focus"), 
                n.trigger("click");
                var r = " li:not(.disabled):visible a", l = s.find(".dropdown-menu" + r);
                if (l.length) {
                    var d = l.index(i.target);
                    38 == i.which && d > 0 && d--, 40 == i.which && d < l.length - 1 && d++, ~d || (d = 0), 
                    l.eq(d).trigger("focus");
                }
            }
        }
    };
    var r = t.fn.dropdown;
    t.fn.dropdown = n, t.fn.dropdown.Constructor = a, t.fn.dropdown.noConflict = function() {
        return t.fn.dropdown = r, this;
    }, t(document).on("click.bs.dropdown.data-api", i).on("click.bs.dropdown.data-api", ".dropdown form", function(t) {
        t.stopPropagation();
    }).on("click.bs.dropdown.data-api", o, a.prototype.toggle).on("keydown.bs.dropdown.data-api", o, a.prototype.keydown).on("keydown.bs.dropdown.data-api", ".dropdown-menu", a.prototype.keydown);
}(jQuery), +function(t) {
    "use strict";
    function e(e) {
        return this.each(function() {
            var n = t(this), s = n.data("bs.tab");
            s || n.data("bs.tab", s = new i(this)), "string" == typeof e && s[e]();
        });
    }
    var i = function(e) {
        this.element = t(e);
    };
    i.VERSION = "3.3.7", i.TRANSITION_DURATION = 150, i.prototype.show = function() {
        var e = this.element, i = e.closest("ul:not(.dropdown-menu)"), n = e.data("target");
        if (n || (n = e.attr("href"), n = n && n.replace(/.*(?=#[^\s]*$)/, "")), !e.parent("li").hasClass("active")) {
            var s = i.find(".active:last a"), o = t.Event("hide.bs.tab", {
                relatedTarget: e[0]
            }), a = t.Event("show.bs.tab", {
                relatedTarget: s[0]
            });
            if (s.trigger(o), e.trigger(a), !a.isDefaultPrevented() && !o.isDefaultPrevented()) {
                var r = t(n);
                this.activate(e.closest("li"), i), this.activate(r, r.parent(), function() {
                    s.trigger({
                        type: "hidden.bs.tab",
                        relatedTarget: e[0]
                    }), e.trigger({
                        type: "shown.bs.tab",
                        relatedTarget: s[0]
                    });
                });
            }
        }
    }, i.prototype.activate = function(e, n, s) {
        function o() {
            a.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !1), 
            e.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded", !0), r ? (e[0].offsetWidth, 
            e.addClass("in")) : e.removeClass("fade"), e.parent(".dropdown-menu").length && e.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !0), 
            s && s();
        }
        var a = n.find("> .active"), r = s && t.support.transition && (a.length && a.hasClass("fade") || !!n.find("> .fade").length);
        a.length && r ? a.one("bsTransitionEnd", o).emulateTransitionEnd(i.TRANSITION_DURATION) : o(), 
        a.removeClass("in");
    };
    var n = t.fn.tab;
    t.fn.tab = e, t.fn.tab.Constructor = i, t.fn.tab.noConflict = function() {
        return t.fn.tab = n, this;
    };
    var s = function(i) {
        i.preventDefault(), e.call(t(this), "show");
    };
    t(document).on("click.bs.tab.data-api", '[data-toggle="tab"]', s).on("click.bs.tab.data-api", '[data-toggle="pill"]', s);
}(jQuery), +function(t) {
    "use strict";
    function e(e) {
        return this.each(function() {
            var n = t(this), s = n.data("bs.affix"), o = "object" == typeof e && e;
            s || n.data("bs.affix", s = new i(this, o)), "string" == typeof e && s[e]();
        });
    }
    var i = function(e, n) {
        this.options = t.extend({}, i.DEFAULTS, n), this.$target = t(this.options.target).on("scroll.bs.affix.data-api", t.proxy(this.checkPosition, this)).on("click.bs.affix.data-api", t.proxy(this.checkPositionWithEventLoop, this)), 
        this.$element = t(e), this.affixed = null, this.unpin = null, this.pinnedOffset = null, 
        this.checkPosition();
    };
    i.VERSION = "3.3.7", i.RESET = "affix affix-top affix-bottom", i.DEFAULTS = {
        offset: 0,
        target: window
    }, i.prototype.getState = function(t, e, i, n) {
        var s = this.$target.scrollTop(), o = this.$element.offset(), a = this.$target.height();
        if (null != i && "top" == this.affixed) return i > s ? "top" : !1;
        if ("bottom" == this.affixed) return null != i ? s + this.unpin <= o.top ? !1 : "bottom" : t - n >= s + a ? !1 : "bottom";
        var r = null == this.affixed, l = r ? s : o.top, d = r ? a : e;
        return null != i && i >= s ? "top" : null != n && l + d >= t - n ? "bottom" : !1;
    }, i.prototype.getPinnedOffset = function() {
        if (this.pinnedOffset) return this.pinnedOffset;
        this.$element.removeClass(i.RESET).addClass("affix");
        var t = this.$target.scrollTop(), e = this.$element.offset();
        return this.pinnedOffset = e.top - t;
    }, i.prototype.checkPositionWithEventLoop = function() {
        setTimeout(t.proxy(this.checkPosition, this), 1);
    }, i.prototype.checkPosition = function() {
        if (this.$element.is(":visible")) {
            var e = this.$element.height(), n = this.options.offset, s = n.top, o = n.bottom, a = Math.max(t(document).height(), t(document.body).height());
            "object" != typeof n && (o = s = n), "function" == typeof s && (s = n.top(this.$element)), 
            "function" == typeof o && (o = n.bottom(this.$element));
            var r = this.getState(a, e, s, o);
            if (this.affixed != r) {
                null != this.unpin && this.$element.css("top", "");
                var l = "affix" + (r ? "-" + r : ""), d = t.Event(l + ".bs.affix");
                if (this.$element.trigger(d), d.isDefaultPrevented()) return;
                this.affixed = r, this.unpin = "bottom" == r ? this.getPinnedOffset() : null, this.$element.removeClass(i.RESET).addClass(l).trigger(l.replace("affix", "affixed") + ".bs.affix");
            }
            "bottom" == r && this.$element.offset({
                top: a - e - o
            });
        }
    };
    var n = t.fn.affix;
    t.fn.affix = e, t.fn.affix.Constructor = i, t.fn.affix.noConflict = function() {
        return t.fn.affix = n, this;
    }, t(window).on("load", function() {
        t('[data-spy="affix"]').each(function() {
            var i = t(this), n = i.data();
            n.offset = n.offset || {}, null != n.offsetBottom && (n.offset.bottom = n.offsetBottom), 
            null != n.offsetTop && (n.offset.top = n.offsetTop), e.call(i, n);
        });
    });
}(jQuery), +function(t) {
    "use strict";
    function e(e) {
        var i, n = e.attr("data-target") || (i = e.attr("href")) && i.replace(/.*(?=#[^\s]+$)/, "");
        return t(n);
    }
    function i(e) {
        return this.each(function() {
            var i = t(this), s = i.data("bs.collapse"), o = t.extend({}, n.DEFAULTS, i.data(), "object" == typeof e && e);
            !s && o.toggle && /show|hide/.test(e) && (o.toggle = !1), s || i.data("bs.collapse", s = new n(this, o)), 
            "string" == typeof e && s[e]();
        });
    }
    var n = function(e, i) {
        this.$element = t(e), this.options = t.extend({}, n.DEFAULTS, i), this.$trigger = t('[data-toggle="collapse"][href="#' + e.id + '"],[data-toggle="collapse"][data-target="#' + e.id + '"]'), 
        this.transitioning = null, this.options.parent ? this.$parent = this.getParent() : this.addAriaAndCollapsedClass(this.$element, this.$trigger), 
        this.options.toggle && this.toggle();
    };
    n.VERSION = "3.3.7", n.TRANSITION_DURATION = 350, n.DEFAULTS = {
        toggle: !0
    }, n.prototype.dimension = function() {
        var t = this.$element.hasClass("width");
        return t ? "width" : "height";
    }, n.prototype.show = function() {
        if (!this.transitioning && !this.$element.hasClass("in")) {
            var e, s = this.$parent && this.$parent.children(".panel").children(".in, .collapsing");
            if (!(s && s.length && (e = s.data("bs.collapse"), e && e.transitioning))) {
                var o = t.Event("show.bs.collapse");
                if (this.$element.trigger(o), !o.isDefaultPrevented()) {
                    s && s.length && (i.call(s, "hide"), e || s.data("bs.collapse", null));
                    var a = this.dimension();
                    this.$element.removeClass("collapse").addClass("collapsing")[a](0).attr("aria-expanded", !0), 
                    this.$trigger.removeClass("collapsed").attr("aria-expanded", !0), this.transitioning = 1;
                    var r = function() {
                        this.$element.removeClass("collapsing").addClass("collapse in")[a](""), this.transitioning = 0, 
                        this.$element.trigger("shown.bs.collapse");
                    };
                    if (!t.support.transition) return r.call(this);
                    var l = t.camelCase([ "scroll", a ].join("-"));
                    this.$element.one("bsTransitionEnd", t.proxy(r, this)).emulateTransitionEnd(n.TRANSITION_DURATION)[a](this.$element[0][l]);
                }
            }
        }
    }, n.prototype.hide = function() {
        if (!this.transitioning && this.$element.hasClass("in")) {
            var e = t.Event("hide.bs.collapse");
            if (this.$element.trigger(e), !e.isDefaultPrevented()) {
                var i = this.dimension();
                this.$element[i](this.$element[i]())[0].offsetHeight, this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded", !1), 
                this.$trigger.addClass("collapsed").attr("aria-expanded", !1), this.transitioning = 1;
                var s = function() {
                    this.transitioning = 0, this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse");
                };
                return t.support.transition ? void this.$element[i](0).one("bsTransitionEnd", t.proxy(s, this)).emulateTransitionEnd(n.TRANSITION_DURATION) : s.call(this);
            }
        }
    }, n.prototype.toggle = function() {
        this[this.$element.hasClass("in") ? "hide" : "show"]();
    }, n.prototype.getParent = function() {
        return t(this.options.parent).find('[data-toggle="collapse"][data-parent="' + this.options.parent + '"]').each(t.proxy(function(i, n) {
            var s = t(n);
            this.addAriaAndCollapsedClass(e(s), s);
        }, this)).end();
    }, n.prototype.addAriaAndCollapsedClass = function(t, e) {
        var i = t.hasClass("in");
        t.attr("aria-expanded", i), e.toggleClass("collapsed", !i).attr("aria-expanded", i);
    };
    var s = t.fn.collapse;
    t.fn.collapse = i, t.fn.collapse.Constructor = n, t.fn.collapse.noConflict = function() {
        return t.fn.collapse = s, this;
    }, t(document).on("click.bs.collapse.data-api", '[data-toggle="collapse"]', function(n) {
        var s = t(this);
        s.attr("data-target") || n.preventDefault();
        var o = e(s), a = o.data("bs.collapse"), r = a ? "toggle" : s.data();
        i.call(o, r);
    });
}(jQuery), +function(t) {
    "use strict";
    function e(i, n) {
        this.$body = t(document.body), this.$scrollElement = t(t(i).is(document.body) ? window : i), 
        this.options = t.extend({}, e.DEFAULTS, n), this.selector = (this.options.target || "") + " .nav li > a", 
        this.offsets = [], this.targets = [], this.activeTarget = null, this.scrollHeight = 0, 
        this.$scrollElement.on("scroll.bs.scrollspy", t.proxy(this.process, this)), this.refresh(), 
        this.process();
    }
    function i(i) {
        return this.each(function() {
            var n = t(this), s = n.data("bs.scrollspy"), o = "object" == typeof i && i;
            s || n.data("bs.scrollspy", s = new e(this, o)), "string" == typeof i && s[i]();
        });
    }
    e.VERSION = "3.3.7", e.DEFAULTS = {
        offset: 10
    }, e.prototype.getScrollHeight = function() {
        return this.$scrollElement[0].scrollHeight || Math.max(this.$body[0].scrollHeight, document.documentElement.scrollHeight);
    }, e.prototype.refresh = function() {
        var e = this, i = "offset", n = 0;
        this.offsets = [], this.targets = [], this.scrollHeight = this.getScrollHeight(), 
        t.isWindow(this.$scrollElement[0]) || (i = "position", n = this.$scrollElement.scrollTop()), 
        this.$body.find(this.selector).map(function() {
            var e = t(this), s = e.data("target") || e.attr("href"), o = /^#./.test(s) && t(s);
            return o && o.length && o.is(":visible") && [ [ o[i]().top + n, s ] ] || null;
        }).sort(function(t, e) {
            return t[0] - e[0];
        }).each(function() {
            e.offsets.push(this[0]), e.targets.push(this[1]);
        });
    }, e.prototype.process = function() {
        var t, e = this.$scrollElement.scrollTop() + this.options.offset, i = this.getScrollHeight(), n = this.options.offset + i - this.$scrollElement.height(), s = this.offsets, o = this.targets, a = this.activeTarget;
        if (this.scrollHeight != i && this.refresh(), e >= n) return a != (t = o[o.length - 1]) && this.activate(t);
        if (a && e < s[0]) return this.activeTarget = null, this.clear();
        for (t = s.length; t--; ) a != o[t] && e >= s[t] && (void 0 === s[t + 1] || e < s[t + 1]) && this.activate(o[t]);
    }, e.prototype.activate = function(e) {
        this.activeTarget = e, this.clear();
        var i = this.selector + '[data-target="' + e + '"],' + this.selector + '[href="' + e + '"]', n = t(i).parents("li").addClass("active");
        n.parent(".dropdown-menu").length && (n = n.closest("li.dropdown").addClass("active")), 
        n.trigger("activate.bs.scrollspy");
    }, e.prototype.clear = function() {
        t(this.selector).parentsUntil(this.options.target, ".active").removeClass("active");
    };
    var n = t.fn.scrollspy;
    t.fn.scrollspy = i, t.fn.scrollspy.Constructor = e, t.fn.scrollspy.noConflict = function() {
        return t.fn.scrollspy = n, this;
    }, t(window).on("load.bs.scrollspy.data-api", function() {
        t('[data-spy="scroll"]').each(function() {
            var e = t(this);
            i.call(e, e.data());
        });
    });
}(jQuery), +function(t) {
    "use strict";
    function e() {
        var t = document.createElement("bootstrap"), e = {
            WebkitTransition: "webkitTransitionEnd",
            MozTransition: "transitionend",
            OTransition: "oTransitionEnd otransitionend",
            transition: "transitionend"
        };
        for (var i in e) if (void 0 !== t.style[i]) return {
            end: e[i]
        };
        return !1;
    }
    t.fn.emulateTransitionEnd = function(e) {
        var i = !1, n = this;
        t(this).one("bsTransitionEnd", function() {
            i = !0;
        });
        var s = function() {
            i || t(n).trigger(t.support.transition.end);
        };
        return setTimeout(s, e), this;
    }, t(function() {
        t.support.transition = e(), t.support.transition && (t.event.special.bsTransitionEnd = {
            bindType: t.support.transition.end,
            delegateType: t.support.transition.end,
            handle: function(e) {
                return t(e.target).is(this) ? e.handleObj.handler.apply(this, arguments) : void 0;
            }
        });
    });
}(jQuery);

!function(e, t) {
    "function" == typeof define && define.amd ? define("ev-emitter/ev-emitter", t) : "object" == typeof module && module.exports ? module.exports = t() : e.EvEmitter = t();
}("undefined" != typeof window ? window : this, function() {
    function e() {}
    var t = e.prototype;
    return t.on = function(e, t) {
        if (e && t) {
            var i = this._events = this._events || {}, n = i[e] = i[e] || [];
            return -1 == n.indexOf(t) && n.push(t), this;
        }
    }, t.once = function(e, t) {
        if (e && t) {
            this.on(e, t);
            var i = this._onceEvents = this._onceEvents || {}, n = i[e] = i[e] || {};
            return n[t] = !0, this;
        }
    }, t.off = function(e, t) {
        var i = this._events && this._events[e];
        if (i && i.length) {
            var n = i.indexOf(t);
            return -1 != n && i.splice(n, 1), this;
        }
    }, t.emitEvent = function(e, t) {
        var i = this._events && this._events[e];
        if (i && i.length) {
            var n = 0, o = i[n];
            t = t || [];
            for (var r = this._onceEvents && this._onceEvents[e]; o; ) {
                var s = r && r[o];
                s && (this.off(e, o), delete r[o]), o.apply(this, t), n += s ? 0 : 1, o = i[n];
            }
            return this;
        }
    }, t.allOff = t.removeAllListeners = function() {
        delete this._events, delete this._onceEvents;
    }, e;
}), function(e, t) {
    "use strict";
    "function" == typeof define && define.amd ? define([ "ev-emitter/ev-emitter" ], function(i) {
        return t(e, i);
    }) : "object" == typeof module && module.exports ? module.exports = t(e, require("ev-emitter")) : e.imagesLoaded = t(e, e.EvEmitter);
}("undefined" != typeof window ? window : this, function(e, t) {
    function i(e, t) {
        for (var i in t) e[i] = t[i];
        return e;
    }
    function n(e) {
        var t = [];
        if (Array.isArray(e)) t = e; else if ("number" == typeof e.length) for (var i = 0; i < e.length; i++) t.push(e[i]); else t.push(e);
        return t;
    }
    function o(e, t, r) {
        return this instanceof o ? ("string" == typeof e && (e = document.querySelectorAll(e)), 
        this.elements = n(e), this.options = i({}, this.options), "function" == typeof t ? r = t : i(this.options, t), 
        r && this.on("always", r), this.getImages(), h && (this.jqDeferred = new h.Deferred()), 
        void setTimeout(function() {
            this.check();
        }.bind(this))) : new o(e, t, r);
    }
    function r(e) {
        this.img = e;
    }
    function s(e, t) {
        this.url = e, this.element = t, this.img = new Image();
    }
    var h = e.jQuery, a = e.console;
    o.prototype = Object.create(t.prototype), o.prototype.options = {}, o.prototype.getImages = function() {
        this.images = [], this.elements.forEach(this.addElementImages, this);
    }, o.prototype.addElementImages = function(e) {
        "IMG" == e.nodeName && this.addImage(e), this.options.background === !0 && this.addElementBackgroundImages(e);
        var t = e.nodeType;
        if (t && d[t]) {
            for (var i = e.querySelectorAll("img"), n = 0; n < i.length; n++) {
                var o = i[n];
                this.addImage(o);
            }
            if ("string" == typeof this.options.background) {
                var r = e.querySelectorAll(this.options.background);
                for (n = 0; n < r.length; n++) {
                    var s = r[n];
                    this.addElementBackgroundImages(s);
                }
            }
        }
    };
    var d = {
        1: !0,
        9: !0,
        11: !0
    };
    return o.prototype.addElementBackgroundImages = function(e) {
        var t = getComputedStyle(e);
        if (t) for (var i = /url\((['"])?(.*?)\1\)/gi, n = i.exec(t.backgroundImage); null !== n; ) {
            var o = n && n[2];
            o && this.addBackground(o, e), n = i.exec(t.backgroundImage);
        }
    }, o.prototype.addImage = function(e) {
        var t = new r(e);
        this.images.push(t);
    }, o.prototype.addBackground = function(e, t) {
        var i = new s(e, t);
        this.images.push(i);
    }, o.prototype.check = function() {
        function e(e, i, n) {
            setTimeout(function() {
                t.progress(e, i, n);
            });
        }
        var t = this;
        return this.progressedCount = 0, this.hasAnyBroken = !1, this.images.length ? void this.images.forEach(function(t) {
            t.once("progress", e), t.check();
        }) : void this.complete();
    }, o.prototype.progress = function(e, t, i) {
        this.progressedCount++, this.hasAnyBroken = this.hasAnyBroken || !e.isLoaded, this.emitEvent("progress", [ this, e, t ]), 
        this.jqDeferred && this.jqDeferred.notify && this.jqDeferred.notify(this, e), this.progressedCount == this.images.length && this.complete(), 
        this.options.debug && a && a.log("progress: " + i, e, t);
    }, o.prototype.complete = function() {
        var e = this.hasAnyBroken ? "fail" : "done";
        if (this.isComplete = !0, this.emitEvent(e, [ this ]), this.emitEvent("always", [ this ]), 
        this.jqDeferred) {
            var t = this.hasAnyBroken ? "reject" : "resolve";
            this.jqDeferred[t](this);
        }
    }, r.prototype = Object.create(t.prototype), r.prototype.check = function() {
        var e = this.getIsImageComplete();
        return e ? void this.confirm(0 !== this.img.naturalWidth, "naturalWidth") : (this.proxyImage = new Image(), 
        this.proxyImage.addEventListener("load", this), this.proxyImage.addEventListener("error", this), 
        this.img.addEventListener("load", this), this.img.addEventListener("error", this), 
        void (this.proxyImage.src = this.img.src));
    }, r.prototype.getIsImageComplete = function() {
        return this.img.complete && void 0 !== this.img.naturalWidth;
    }, r.prototype.confirm = function(e, t) {
        this.isLoaded = e, this.emitEvent("progress", [ this, this.img, t ]);
    }, r.prototype.handleEvent = function(e) {
        var t = "on" + e.type;
        this[t] && this[t](e);
    }, r.prototype.onload = function() {
        this.confirm(!0, "onload"), this.unbindEvents();
    }, r.prototype.onerror = function() {
        this.confirm(!1, "onerror"), this.unbindEvents();
    }, r.prototype.unbindEvents = function() {
        this.proxyImage.removeEventListener("load", this), this.proxyImage.removeEventListener("error", this), 
        this.img.removeEventListener("load", this), this.img.removeEventListener("error", this);
    }, s.prototype = Object.create(r.prototype), s.prototype.check = function() {
        this.img.addEventListener("load", this), this.img.addEventListener("error", this), 
        this.img.src = this.url;
        var e = this.getIsImageComplete();
        e && (this.confirm(0 !== this.img.naturalWidth, "naturalWidth"), this.unbindEvents());
    }, s.prototype.unbindEvents = function() {
        this.img.removeEventListener("load", this), this.img.removeEventListener("error", this);
    }, s.prototype.confirm = function(e, t) {
        this.isLoaded = e, this.emitEvent("progress", [ this, this.element, t ]);
    }, o.makeJQueryPlugin = function(t) {
        t = t || e.jQuery, t && (h = t, h.fn.imagesLoaded = function(e, t) {
            var i = new o(this, e, t);
            return i.jqDeferred.promise(h(this));
        });
    }, o.makeJQueryPlugin(), o;
});

!function(t, e) {
    "use strict";
    function n(t) {
        this.time = t.time, this.target = t.target, this.rootBounds = t.rootBounds, this.boundingClientRect = t.boundingClientRect, 
        this.intersectionRect = t.intersectionRect || {
            top: 0,
            bottom: 0,
            left: 0,
            right: 0,
            width: 0,
            height: 0
        }, this.isIntersecting = !!t.intersectionRect;
        var e = this.boundingClientRect, n = e.width * e.height, o = this.intersectionRect, i = o.width * o.height;
        this.intersectionRatio = n ? i / n : this.isIntersecting ? 1 : 0;
    }
    function o(t, e) {
        var n = e || {};
        if ("function" != typeof t) throw new Error("callback must be a function");
        if (n.root && 1 != n.root.nodeType) throw new Error("root must be an Element");
        this._checkForIntersections = r(this._checkForIntersections.bind(this), this.THROTTLE_TIMEOUT), 
        this._callback = t, this._observationTargets = [], this._queuedEntries = [], this._rootMarginValues = this._parseRootMargin(n.rootMargin), 
        this.thresholds = this._initThresholds(n.threshold), this.root = n.root || null, 
        this.rootMargin = this._rootMarginValues.map(function(t) {
            return t.value + t.unit;
        }).join(" ");
    }
    function i() {
        return t.performance && performance.now && performance.now();
    }
    function r(t, e) {
        var n = null;
        return function() {
            n || (n = setTimeout(function() {
                t(), n = null;
            }, e));
        };
    }
    function s(t, e, n, o) {
        "function" == typeof t.addEventListener ? t.addEventListener(e, n, o || !1) : "function" == typeof t.attachEvent && t.attachEvent("on" + e, n);
    }
    function h(t, e, n, o) {
        "function" == typeof t.removeEventListener ? t.removeEventListener(e, n, o || !1) : "function" == typeof t.detatchEvent && t.detatchEvent("on" + e, n);
    }
    function c(t, e) {
        var n = Math.max(t.top, e.top), o = Math.min(t.bottom, e.bottom), i = Math.max(t.left, e.left), r = Math.min(t.right, e.right), s = r - i, h = o - n;
        return s >= 0 && h >= 0 && {
            top: n,
            bottom: o,
            left: i,
            right: r,
            width: s,
            height: h
        };
    }
    function u(t) {
        var e;
        try {
            e = t.getBoundingClientRect();
        } catch (t) {}
        return e ? (e.width && e.height || (e = {
            top: e.top,
            right: e.right,
            bottom: e.bottom,
            left: e.left,
            width: e.right - e.left,
            height: e.bottom - e.top
        }), e) : {
            top: 0,
            bottom: 0,
            left: 0,
            right: 0,
            width: 0,
            height: 0
        };
    }
    function a(t, e) {
        for (var n = e; n; ) {
            if (n == t) return !0;
            n = l(n);
        }
        return !1;
    }
    function l(t) {
        var e = t.parentNode;
        return e && 11 == e.nodeType && e.host ? e.host : e;
    }
    if ("IntersectionObserver" in t && "IntersectionObserverEntry" in t && "intersectionRatio" in t.IntersectionObserverEntry.prototype) "isIntersecting" in t.IntersectionObserverEntry.prototype || Object.defineProperty(t.IntersectionObserverEntry.prototype, "isIntersecting", {
        get: function() {
            return this.intersectionRatio > 0;
        }
    }); else {
        var p = [];
        o.prototype.THROTTLE_TIMEOUT = 100, o.prototype.POLL_INTERVAL = null, o.prototype.observe = function(t) {
            if (!this._observationTargets.some(function(e) {
                return e.element == t;
            })) {
                if (!t || 1 != t.nodeType) throw new Error("target must be an Element");
                this._registerInstance(), this._observationTargets.push({
                    element: t,
                    entry: null
                }), this._monitorIntersections(), this._checkForIntersections();
            }
        }, o.prototype.unobserve = function(t) {
            this._observationTargets = this._observationTargets.filter(function(e) {
                return e.element != t;
            }), this._observationTargets.length || (this._unmonitorIntersections(), this._unregisterInstance());
        }, o.prototype.disconnect = function() {
            this._observationTargets = [], this._unmonitorIntersections(), this._unregisterInstance();
        }, o.prototype.takeRecords = function() {
            var t = this._queuedEntries.slice();
            return this._queuedEntries = [], t;
        }, o.prototype._initThresholds = function(t) {
            var e = t || [ 0 ];
            return Array.isArray(e) || (e = [ e ]), e.sort().filter(function(t, e, n) {
                if ("number" != typeof t || isNaN(t) || t < 0 || t > 1) throw new Error("threshold must be a number between 0 and 1 inclusively");
                return t !== n[e - 1];
            });
        }, o.prototype._parseRootMargin = function(t) {
            var e = (t || "0px").split(/\s+/).map(function(t) {
                var e = /^(-?\d*\.?\d+)(px|%)$/.exec(t);
                if (!e) throw new Error("rootMargin must be specified in pixels or percent");
                return {
                    value: parseFloat(e[1]),
                    unit: e[2]
                };
            });
            return e[1] = e[1] || e[0], e[2] = e[2] || e[0], e[3] = e[3] || e[1], e;
        }, o.prototype._monitorIntersections = function() {
            this._monitoringIntersections || (this._monitoringIntersections = !0, this.POLL_INTERVAL ? this._monitoringInterval = setInterval(this._checkForIntersections, this.POLL_INTERVAL) : (s(t, "resize", this._checkForIntersections, !0), 
            s(e, "scroll", this._checkForIntersections, !0), "MutationObserver" in t && (this._domObserver = new MutationObserver(this._checkForIntersections), 
            this._domObserver.observe(e, {
                attributes: !0,
                childList: !0,
                characterData: !0,
                subtree: !0
            }))));
        }, o.prototype._unmonitorIntersections = function() {
            this._monitoringIntersections && (this._monitoringIntersections = !1, clearInterval(this._monitoringInterval), 
            this._monitoringInterval = null, h(t, "resize", this._checkForIntersections, !0), 
            h(e, "scroll", this._checkForIntersections, !0), this._domObserver && (this._domObserver.disconnect(), 
            this._domObserver = null));
        }, o.prototype._checkForIntersections = function() {
            var t = this._rootIsInDom(), e = t ? this._getRootRect() : {
                top: 0,
                bottom: 0,
                left: 0,
                right: 0,
                width: 0,
                height: 0
            };
            this._observationTargets.forEach(function(o) {
                var r = o.element, s = u(r), h = this._rootContainsTarget(r), c = o.entry, a = t && h && this._computeTargetAndRootIntersection(r, e), l = o.entry = new n({
                    time: i(),
                    target: r,
                    boundingClientRect: s,
                    rootBounds: e,
                    intersectionRect: a
                });
                c ? t && h ? this._hasCrossedThreshold(c, l) && this._queuedEntries.push(l) : c && c.isIntersecting && this._queuedEntries.push(l) : this._queuedEntries.push(l);
            }, this), this._queuedEntries.length && this._callback(this.takeRecords(), this);
        }, o.prototype._computeTargetAndRootIntersection = function(n, o) {
            if ("none" != t.getComputedStyle(n).display) {
                for (var i = u(n), r = l(n), s = !1; !s; ) {
                    var h = null, a = 1 == r.nodeType ? t.getComputedStyle(r) : {};
                    if ("none" == a.display) return;
                    if (r == this.root || r == e ? (s = !0, h = o) : r != e.body && r != e.documentElement && "visible" != a.overflow && (h = u(r)), 
                    h && !(i = c(h, i))) break;
                    r = l(r);
                }
                return i;
            }
        }, o.prototype._getRootRect = function() {
            var t;
            if (this.root) t = u(this.root); else {
                var n = e.documentElement, o = e.body;
                t = {
                    top: 0,
                    left: 0,
                    right: n.clientWidth || o.clientWidth,
                    width: n.clientWidth || o.clientWidth,
                    bottom: n.clientHeight || o.clientHeight,
                    height: n.clientHeight || o.clientHeight
                };
            }
            return this._expandRectByRootMargin(t);
        }, o.prototype._expandRectByRootMargin = function(t) {
            var e = this._rootMarginValues.map(function(e, n) {
                return "px" == e.unit ? e.value : e.value * (n % 2 ? t.width : t.height) / 100;
            }), n = {
                top: t.top - e[0],
                right: t.right + e[1],
                bottom: t.bottom + e[2],
                left: t.left - e[3]
            };
            return n.width = n.right - n.left, n.height = n.bottom - n.top, n;
        }, o.prototype._hasCrossedThreshold = function(t, e) {
            var n = t && t.isIntersecting ? t.intersectionRatio || 0 : -1, o = e.isIntersecting ? e.intersectionRatio || 0 : -1;
            if (n !== o) for (var i = 0; i < this.thresholds.length; i++) {
                var r = this.thresholds[i];
                if (r == n || r == o || r < n != r < o) return !0;
            }
        }, o.prototype._rootIsInDom = function() {
            return !this.root || a(e, this.root);
        }, o.prototype._rootContainsTarget = function(t) {
            return a(this.root || e, t);
        }, o.prototype._registerInstance = function() {
            p.indexOf(this) < 0 && p.push(this);
        }, o.prototype._unregisterInstance = function() {
            var t = p.indexOf(this);
            -1 != t && p.splice(t, 1);
        }, t.IntersectionObserver = o, t.IntersectionObserverEntry = n;
    }
}(window, document);

/**
 * vivus - JavaScript library to make drawing animation on SVG
 * @version v0.4.2
 * @link https://github.com/maxwellito/vivus
 * @license MIT
 */
"use strict";

!function() {
    function t(t) {
        if ("undefined" == typeof t) throw new Error('Pathformer [constructor]: "element" parameter is required');
        if (t.constructor === String && (t = document.getElementById(t), !t)) throw new Error('Pathformer [constructor]: "element" parameter is not related to an existing ID');
        if (!(t instanceof window.SVGElement || t instanceof window.SVGGElement || /^svg$/i.test(t.nodeName))) throw new Error('Pathformer [constructor]: "element" parameter must be a string or a SVGelement');
        this.el = t, this.scan(t);
    }
    function e(t, e, n) {
        r(), this.isReady = !1, this.setElement(t, e), this.setOptions(e), this.setCallback(n), 
        this.isReady && this.init();
    }
    t.prototype.TYPES = [ "line", "ellipse", "circle", "polygon", "polyline", "rect" ], 
    t.prototype.ATTR_WATCH = [ "cx", "cy", "points", "r", "rx", "ry", "x", "x1", "x2", "y", "y1", "y2" ], 
    t.prototype.scan = function(t) {
        for (var e, r, n, i, a = t.querySelectorAll(this.TYPES.join(",")), o = 0; o < a.length; o++) r = a[o], 
        e = this[r.tagName.toLowerCase() + "ToPath"], n = e(this.parseAttr(r.attributes)), 
        i = this.pathMaker(r, n), r.parentNode.replaceChild(i, r);
    }, t.prototype.lineToPath = function(t) {
        var e = {}, r = t.x1 || 0, n = t.y1 || 0, i = t.x2 || 0, a = t.y2 || 0;
        return e.d = "M" + r + "," + n + "L" + i + "," + a, e;
    }, t.prototype.rectToPath = function(t) {
        var e = {}, r = parseFloat(t.x) || 0, n = parseFloat(t.y) || 0, i = parseFloat(t.width) || 0, a = parseFloat(t.height) || 0;
        if (t.rx || t.ry) {
            var o = parseInt(t.rx, 10) || -1, s = parseInt(t.ry, 10) || -1;
            o = Math.min(Math.max(0 > o ? s : o, 0), i / 2), s = Math.min(Math.max(0 > s ? o : s, 0), a / 2), 
            e.d = "M " + (r + o) + "," + n + " L " + (r + i - o) + "," + n + " A " + o + "," + s + ",0,0,1," + (r + i) + "," + (n + s) + " L " + (r + i) + "," + (n + a - s) + " A " + o + "," + s + ",0,0,1," + (r + i - o) + "," + (n + a) + " L " + (r + o) + "," + (n + a) + " A " + o + "," + s + ",0,0,1," + r + "," + (n + a - s) + " L " + r + "," + (n + s) + " A " + o + "," + s + ",0,0,1," + (r + o) + "," + n;
        } else e.d = "M" + r + " " + n + " L" + (r + i) + " " + n + " L" + (r + i) + " " + (n + a) + " L" + r + " " + (n + a) + " Z";
        return e;
    }, t.prototype.polylineToPath = function(t) {
        var e, r, n = {}, i = t.points.trim().split(" ");
        if (-1 === t.points.indexOf(",")) {
            var a = [];
            for (e = 0; e < i.length; e += 2) a.push(i[e] + "," + i[e + 1]);
            i = a;
        }
        for (r = "M" + i[0], e = 1; e < i.length; e++) -1 !== i[e].indexOf(",") && (r += "L" + i[e]);
        return n.d = r, n;
    }, t.prototype.polygonToPath = function(e) {
        var r = t.prototype.polylineToPath(e);
        return r.d += "Z", r;
    }, t.prototype.ellipseToPath = function(t) {
        var e = {}, r = parseFloat(t.rx) || 0, n = parseFloat(t.ry) || 0, i = parseFloat(t.cx) || 0, a = parseFloat(t.cy) || 0, o = i - r, s = a, h = parseFloat(i) + parseFloat(r), l = a;
        return e.d = "M" + o + "," + s + "A" + r + "," + n + " 0,1,1 " + h + "," + l + "A" + r + "," + n + " 0,1,1 " + o + "," + l, 
        e;
    }, t.prototype.circleToPath = function(t) {
        var e = {}, r = parseFloat(t.r) || 0, n = parseFloat(t.cx) || 0, i = parseFloat(t.cy) || 0, a = n - r, o = i, s = parseFloat(n) + parseFloat(r), h = i;
        return e.d = "M" + a + "," + o + "A" + r + "," + r + " 0,1,1 " + s + "," + h + "A" + r + "," + r + " 0,1,1 " + a + "," + h, 
        e;
    }, t.prototype.pathMaker = function(t, e) {
        var r, n, i = document.createElementNS("http://www.w3.org/2000/svg", "path");
        for (r = 0; r < t.attributes.length; r++) n = t.attributes[r], -1 === this.ATTR_WATCH.indexOf(n.name) && i.setAttribute(n.name, n.value);
        for (r in e) i.setAttribute(r, e[r]);
        return i;
    }, t.prototype.parseAttr = function(t) {
        for (var e, r = {}, n = 0; n < t.length; n++) {
            if (e = t[n], -1 !== this.ATTR_WATCH.indexOf(e.name) && -1 !== e.value.indexOf("%")) throw new Error("Pathformer [parseAttr]: a SVG shape got values in percentage. This cannot be transformed into 'path' tags. Please use 'viewBox'.");
            r[e.name] = e.value;
        }
        return r;
    };
    var r, n, i, a;
    e.LINEAR = function(t) {
        return t;
    }, e.EASE = function(t) {
        return -Math.cos(t * Math.PI) / 2 + .5;
    }, e.EASE_OUT = function(t) {
        return 1 - Math.pow(1 - t, 3);
    }, e.EASE_IN = function(t) {
        return Math.pow(t, 3);
    }, e.EASE_OUT_BOUNCE = function(t) {
        var e = -Math.cos(.5 * t * Math.PI) + 1, r = Math.pow(e, 1.5), n = Math.pow(1 - t, 2), i = -Math.abs(Math.cos(2.5 * r * Math.PI)) + 1;
        return 1 - n + i * n;
    }, e.prototype.setElement = function(t, e) {
        if ("undefined" == typeof t) throw new Error('Vivus [constructor]: "element" parameter is required');
        if (t.constructor === String && (t = document.getElementById(t), !t)) throw new Error('Vivus [constructor]: "element" parameter is not related to an existing ID');
        if (this.parentEl = t, e && e.file) {
            var r = document.createElement("object");
            r.setAttribute("type", "image/svg+xml"), r.setAttribute("data", e.file), r.setAttribute("built-by-vivus", "true"), 
            t.appendChild(r), t = r;
        }
        switch (t.constructor) {
          case window.SVGSVGElement:
          case window.SVGElement:
          case window.SVGGElement:
            this.el = t, this.isReady = !0;
            break;

          case window.HTMLObjectElement:
            var n, i;
            i = this, n = function(e) {
                if (!i.isReady) {
                    if (i.el = t.contentDocument && t.contentDocument.querySelector("svg"), !i.el && e) throw new Error("Vivus [constructor]: object loaded does not contain any SVG");
                    return i.el ? (t.getAttribute("built-by-vivus") && (i.parentEl.insertBefore(i.el, t), 
                    i.parentEl.removeChild(t), i.el.setAttribute("width", "100%"), i.el.setAttribute("height", "100%")), 
                    i.isReady = !0, i.init(), !0) : void 0;
                }
            }, n() || t.addEventListener("load", n);
            break;

          default:
            throw new Error('Vivus [constructor]: "element" parameter is not valid (or miss the "file" attribute)');
        }
    }, e.prototype.setOptions = function(t) {
        var r = [ "delayed", "sync", "async", "nsync", "oneByOne", "scenario", "scenario-sync" ], n = [ "inViewport", "manual", "autostart" ];
        if (void 0 !== t && t.constructor !== Object) throw new Error('Vivus [constructor]: "options" parameter must be an object');
        if (t = t || {}, t.type && -1 === r.indexOf(t.type)) throw new Error("Vivus [constructor]: " + t.type + " is not an existing animation `type`");
        if (this.type = t.type || r[0], t.start && -1 === n.indexOf(t.start)) throw new Error("Vivus [constructor]: " + t.start + " is not an existing `start` option");
        if (this.start = t.start || n[0], this.isIE = -1 !== window.navigator.userAgent.indexOf("MSIE") || -1 !== window.navigator.userAgent.indexOf("Trident/") || -1 !== window.navigator.userAgent.indexOf("Edge/"), 
        this.duration = a(t.duration, 120), this.delay = a(t.delay, null), this.dashGap = a(t.dashGap, 1), 
        this.forceRender = t.hasOwnProperty("forceRender") ? !!t.forceRender : this.isIE, 
        this.reverseStack = !!t.reverseStack, this.selfDestroy = !!t.selfDestroy, this.onReady = t.onReady, 
        this.map = [], this.frameLength = this.currentFrame = this.delayUnit = this.speed = this.handle = null, 
        this.ignoreInvisible = t.hasOwnProperty("ignoreInvisible") ? !!t.ignoreInvisible : !1, 
        this.animTimingFunction = t.animTimingFunction || e.LINEAR, this.pathTimingFunction = t.pathTimingFunction || e.LINEAR, 
        this.delay >= this.duration) throw new Error("Vivus [constructor]: delay must be shorter than duration");
    }, e.prototype.setCallback = function(t) {
        if (t && t.constructor !== Function) throw new Error('Vivus [constructor]: "callback" parameter must be a function');
        this.callback = t || function() {};
    }, e.prototype.mapping = function() {
        var t, e, r, n, i, o, s, h;
        for (h = o = s = 0, e = this.el.querySelectorAll("path"), t = 0; t < e.length; t++) r = e[t], 
        this.isInvisible(r) || (i = {
            el: r,
            length: Math.ceil(r.getTotalLength())
        }, isNaN(i.length) ? window.console && console.warn && console.warn("Vivus [mapping]: cannot retrieve a path element length", r) : (this.map.push(i), 
        r.style.strokeDasharray = i.length + " " + (i.length + 2 * this.dashGap), r.style.strokeDashoffset = i.length + this.dashGap, 
        i.length += this.dashGap, o += i.length, this.renderPath(t)));
        for (o = 0 === o ? 1 : o, this.delay = null === this.delay ? this.duration / 3 : this.delay, 
        this.delayUnit = this.delay / (e.length > 1 ? e.length - 1 : 1), this.reverseStack && this.map.reverse(), 
        t = 0; t < this.map.length; t++) {
            switch (i = this.map[t], this.type) {
              case "delayed":
                i.startAt = this.delayUnit * t, i.duration = this.duration - this.delay;
                break;

              case "oneByOne":
                i.startAt = s / o * this.duration, i.duration = i.length / o * this.duration;
                break;

              case "sync":
              case "async":
              case "nsync":
                i.startAt = 0, i.duration = this.duration;
                break;

              case "scenario-sync":
                r = i.el, n = this.parseAttr(r), i.startAt = h + (a(n["data-delay"], this.delayUnit) || 0), 
                i.duration = a(n["data-duration"], this.duration), h = void 0 !== n["data-async"] ? i.startAt : i.startAt + i.duration, 
                this.frameLength = Math.max(this.frameLength, i.startAt + i.duration);
                break;

              case "scenario":
                r = i.el, n = this.parseAttr(r), i.startAt = a(n["data-start"], this.delayUnit) || 0, 
                i.duration = a(n["data-duration"], this.duration), this.frameLength = Math.max(this.frameLength, i.startAt + i.duration);
            }
            s += i.length, this.frameLength = this.frameLength || this.duration;
        }
    }, e.prototype.drawer = function() {
        var t = this;
        if (this.currentFrame += this.speed, this.currentFrame <= 0) this.stop(), this.reset(); else {
            if (!(this.currentFrame >= this.frameLength)) return this.trace(), this.handle = n(function() {
                t.drawer();
            }), void 0;
            this.stop(), this.currentFrame = this.frameLength, this.trace(), this.selfDestroy && this.destroy();
        }
        this.callback(this), this.instanceCallback && (this.instanceCallback(this), this.instanceCallback = null);
    }, e.prototype.trace = function() {
        var t, e, r, n;
        for (n = this.animTimingFunction(this.currentFrame / this.frameLength) * this.frameLength, 
        t = 0; t < this.map.length; t++) r = this.map[t], e = (n - r.startAt) / r.duration, 
        e = this.pathTimingFunction(Math.max(0, Math.min(1, e))), r.progress !== e && (r.progress = e, 
        r.el.style.strokeDashoffset = Math.floor(r.length * (1 - e)), this.renderPath(t));
    }, e.prototype.renderPath = function(t) {
        if (this.forceRender && this.map && this.map[t]) {
            var e = this.map[t], r = e.el.cloneNode(!0);
            e.el.parentNode.replaceChild(r, e.el), e.el = r;
        }
    }, e.prototype.init = function() {
        this.frameLength = 0, this.currentFrame = 0, this.map = [], new t(this.el), this.mapping(), 
        this.starter(), this.onReady && this.onReady(this);
    }, e.prototype.starter = function() {
        switch (this.start) {
          case "manual":
            return;

          case "autostart":
            this.play();
            break;

          case "inViewport":
            var t = this, e = function() {
                t.isInViewport(t.parentEl, 1) && (t.play(), window.removeEventListener("scroll", e));
            };
            window.addEventListener("scroll", e), e();
        }
    }, e.prototype.getStatus = function() {
        return 0 === this.currentFrame ? "start" : this.currentFrame === this.frameLength ? "end" : "progress";
    }, e.prototype.reset = function() {
        return this.setFrameProgress(0);
    }, e.prototype.finish = function() {
        return this.setFrameProgress(1);
    }, e.prototype.setFrameProgress = function(t) {
        return t = Math.min(1, Math.max(0, t)), this.currentFrame = Math.round(this.frameLength * t), 
        this.trace(), this;
    }, e.prototype.play = function(t, e) {
        if (this.instanceCallback = null, t && "function" == typeof t) this.instanceCallback = t, 
        t = null; else if (t && "number" != typeof t) throw new Error("Vivus [play]: invalid speed");
        return e && "function" == typeof e && !this.instanceCallback && (this.instanceCallback = e), 
        this.speed = t || 1, this.handle || this.drawer(), this;
    }, e.prototype.stop = function() {
        return this.handle && (i(this.handle), this.handle = null), this;
    }, e.prototype.destroy = function() {
        this.stop();
        var t, e;
        for (t = 0; t < this.map.length; t++) e = this.map[t], e.el.style.strokeDashoffset = null, 
        e.el.style.strokeDasharray = null, this.renderPath(t);
    }, e.prototype.isInvisible = function(t) {
        var e, r = t.getAttribute("data-ignore");
        return null !== r ? "false" !== r : this.ignoreInvisible ? (e = t.getBoundingClientRect(), 
        !e.width && !e.height) : !1;
    }, e.prototype.parseAttr = function(t) {
        var e, r = {};
        if (t && t.attributes) for (var n = 0; n < t.attributes.length; n++) e = t.attributes[n], 
        r[e.name] = e.value;
        return r;
    }, e.prototype.isInViewport = function(t, e) {
        var r = this.scrollY(), n = r + this.getViewportH(), i = t.getBoundingClientRect(), a = i.height, o = r + i.top, s = o + a;
        return e = e || 0, n >= o + a * e && s >= r;
    }, e.prototype.getViewportH = function() {
        var t = this.docElem.clientHeight, e = window.innerHeight;
        return e > t ? e : t;
    }, e.prototype.scrollY = function() {
        return window.pageYOffset || this.docElem.scrollTop;
    }, r = function() {
        e.prototype.docElem || (e.prototype.docElem = window.document.documentElement, n = function() {
            return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function(t) {
                return window.setTimeout(t, 1e3 / 60);
            };
        }(), i = function() {
            return window.cancelAnimationFrame || window.webkitCancelAnimationFrame || window.mozCancelAnimationFrame || window.oCancelAnimationFrame || window.msCancelAnimationFrame || function(t) {
                return window.clearTimeout(t);
            };
        }());
    }, a = function(t, e) {
        var r = parseInt(t, 10);
        return r >= 0 ? r : e;
    }, "function" == typeof define && define.amd ? define([], function() {
        return e;
    }) : "object" == typeof exports ? module.exports = e : window.Vivus = e;
}();

!function(t, e) {
    "function" == typeof define && define.amd ? define("jquery-bridget/jquery-bridget", [ "jquery" ], function(i) {
        return e(t, i);
    }) : "object" == typeof module && module.exports ? module.exports = e(t, require("jquery")) : t.jQueryBridget = e(t, t.jQuery);
}(window, function(t, e) {
    "use strict";
    function i(i, o, a) {
        function h(t, e, n) {
            var s, o = "$()." + i + '("' + e + '")';
            return t.each(function(t, h) {
                var l = a.data(h, i);
                if (!l) return void r(i + " not initialized. Cannot call methods, i.e. " + o);
                var c = l[e];
                if (!c || "_" == e.charAt(0)) return void r(o + " is not a valid method");
                var d = c.apply(l, n);
                s = void 0 === s ? d : s;
            }), void 0 !== s ? s : t;
        }
        function l(t, e) {
            t.each(function(t, n) {
                var s = a.data(n, i);
                s ? (s.option(e), s._init()) : (s = new o(n, e), a.data(n, i, s));
            });
        }
        a = a || e || t.jQuery, a && (o.prototype.option || (o.prototype.option = function(t) {
            a.isPlainObject(t) && (this.options = a.extend(!0, this.options, t));
        }), a.fn[i] = function(t) {
            if ("string" == typeof t) {
                var e = s.call(arguments, 1);
                return h(this, t, e);
            }
            return l(this, t), this;
        }, n(a));
    }
    function n(t) {
        !t || t && t.bridget || (t.bridget = i);
    }
    var s = Array.prototype.slice, o = t.console, r = "undefined" == typeof o ? function() {} : function(t) {
        o.error(t);
    };
    return n(e || t.jQuery), i;
}), function(t, e) {
    "function" == typeof define && define.amd ? define("ev-emitter/ev-emitter", e) : "object" == typeof module && module.exports ? module.exports = e() : t.EvEmitter = e();
}("undefined" != typeof window ? window : this, function() {
    function t() {}
    var e = t.prototype;
    return e.on = function(t, e) {
        if (t && e) {
            var i = this._events = this._events || {}, n = i[t] = i[t] || [];
            return n.indexOf(e) == -1 && n.push(e), this;
        }
    }, e.once = function(t, e) {
        if (t && e) {
            this.on(t, e);
            var i = this._onceEvents = this._onceEvents || {}, n = i[t] = i[t] || {};
            return n[e] = !0, this;
        }
    }, e.off = function(t, e) {
        var i = this._events && this._events[t];
        if (i && i.length) {
            var n = i.indexOf(e);
            return n != -1 && i.splice(n, 1), this;
        }
    }, e.emitEvent = function(t, e) {
        var i = this._events && this._events[t];
        if (i && i.length) {
            i = i.slice(0), e = e || [];
            for (var n = this._onceEvents && this._onceEvents[t], s = 0; s < i.length; s++) {
                var o = i[s], r = n && n[o];
                r && (this.off(t, o), delete n[o]), o.apply(this, e);
            }
            return this;
        }
    }, e.allOff = function() {
        delete this._events, delete this._onceEvents;
    }, t;
}), function(t, e) {
    "use strict";
    "function" == typeof define && define.amd ? define("get-size/get-size", [], function() {
        return e();
    }) : "object" == typeof module && module.exports ? module.exports = e() : t.getSize = e();
}(window, function() {
    "use strict";
    function t(t) {
        var e = parseFloat(t), i = t.indexOf("%") == -1 && !isNaN(e);
        return i && e;
    }
    function e() {}
    function i() {
        for (var t = {
            width: 0,
            height: 0,
            innerWidth: 0,
            innerHeight: 0,
            outerWidth: 0,
            outerHeight: 0
        }, e = 0; e < l; e++) {
            var i = h[e];
            t[i] = 0;
        }
        return t;
    }
    function n(t) {
        var e = getComputedStyle(t);
        return e || a("Style returned " + e + ". Are you running this code in a hidden iframe on Firefox? See http://bit.ly/getsizebug1"), 
        e;
    }
    function s() {
        if (!c) {
            c = !0;
            var e = document.createElement("div");
            e.style.width = "200px", e.style.padding = "1px 2px 3px 4px", e.style.borderStyle = "solid", 
            e.style.borderWidth = "1px 2px 3px 4px", e.style.boxSizing = "border-box";
            var i = document.body || document.documentElement;
            i.appendChild(e);
            var s = n(e);
            o.isBoxSizeOuter = r = 200 == t(s.width), i.removeChild(e);
        }
    }
    function o(e) {
        if (s(), "string" == typeof e && (e = document.querySelector(e)), e && "object" == typeof e && e.nodeType) {
            var o = n(e);
            if ("none" == o.display) return i();
            var a = {};
            a.width = e.offsetWidth, a.height = e.offsetHeight;
            for (var c = a.isBorderBox = "border-box" == o.boxSizing, d = 0; d < l; d++) {
                var u = h[d], f = o[u], p = parseFloat(f);
                a[u] = isNaN(p) ? 0 : p;
            }
            var v = a.paddingLeft + a.paddingRight, g = a.paddingTop + a.paddingBottom, m = a.marginLeft + a.marginRight, y = a.marginTop + a.marginBottom, E = a.borderLeftWidth + a.borderRightWidth, S = a.borderTopWidth + a.borderBottomWidth, b = c && r, x = t(o.width);
            x !== !1 && (a.width = x + (b ? 0 : v + E));
            var C = t(o.height);
            return C !== !1 && (a.height = C + (b ? 0 : g + S)), a.innerWidth = a.width - (v + E), 
            a.innerHeight = a.height - (g + S), a.outerWidth = a.width + m, a.outerHeight = a.height + y, 
            a;
        }
    }
    var r, a = "undefined" == typeof console ? e : function(t) {
        console.error(t);
    }, h = [ "paddingLeft", "paddingRight", "paddingTop", "paddingBottom", "marginLeft", "marginRight", "marginTop", "marginBottom", "borderLeftWidth", "borderRightWidth", "borderTopWidth", "borderBottomWidth" ], l = h.length, c = !1;
    return o;
}), function(t, e) {
    "use strict";
    "function" == typeof define && define.amd ? define("desandro-matches-selector/matches-selector", e) : "object" == typeof module && module.exports ? module.exports = e() : t.matchesSelector = e();
}(window, function() {
    "use strict";
    var t = function() {
        var t = window.Element.prototype;
        if (t.matches) return "matches";
        if (t.matchesSelector) return "matchesSelector";
        for (var e = [ "webkit", "moz", "ms", "o" ], i = 0; i < e.length; i++) {
            var n = e[i], s = n + "MatchesSelector";
            if (t[s]) return s;
        }
    }();
    return function(e, i) {
        return e[t](i);
    };
}), function(t, e) {
    "function" == typeof define && define.amd ? define("fizzy-ui-utils/utils", [ "desandro-matches-selector/matches-selector" ], function(i) {
        return e(t, i);
    }) : "object" == typeof module && module.exports ? module.exports = e(t, require("desandro-matches-selector")) : t.fizzyUIUtils = e(t, t.matchesSelector);
}(window, function(t, e) {
    var i = {};
    i.extend = function(t, e) {
        for (var i in e) t[i] = e[i];
        return t;
    }, i.modulo = function(t, e) {
        return (t % e + e) % e;
    }, i.makeArray = function(t) {
        var e = [];
        if (Array.isArray(t)) e = t; else if (t && "object" == typeof t && "number" == typeof t.length) for (var i = 0; i < t.length; i++) e.push(t[i]); else e.push(t);
        return e;
    }, i.removeFrom = function(t, e) {
        var i = t.indexOf(e);
        i != -1 && t.splice(i, 1);
    }, i.getParent = function(t, i) {
        for (;t.parentNode && t != document.body; ) if (t = t.parentNode, e(t, i)) return t;
    }, i.getQueryElement = function(t) {
        return "string" == typeof t ? document.querySelector(t) : t;
    }, i.handleEvent = function(t) {
        var e = "on" + t.type;
        this[e] && this[e](t);
    }, i.filterFindElements = function(t, n) {
        t = i.makeArray(t);
        var s = [];
        return t.forEach(function(t) {
            if (t instanceof HTMLElement) {
                if (!n) return void s.push(t);
                e(t, n) && s.push(t);
                for (var i = t.querySelectorAll(n), o = 0; o < i.length; o++) s.push(i[o]);
            }
        }), s;
    }, i.debounceMethod = function(t, e, i) {
        var n = t.prototype[e], s = e + "Timeout";
        t.prototype[e] = function() {
            var t = this[s];
            t && clearTimeout(t);
            var e = arguments, o = this;
            this[s] = setTimeout(function() {
                n.apply(o, e), delete o[s];
            }, i || 100);
        };
    }, i.docReady = function(t) {
        var e = document.readyState;
        "complete" == e || "interactive" == e ? setTimeout(t) : document.addEventListener("DOMContentLoaded", t);
    }, i.toDashed = function(t) {
        return t.replace(/(.)([A-Z])/g, function(t, e, i) {
            return e + "-" + i;
        }).toLowerCase();
    };
    var n = t.console;
    return i.htmlInit = function(e, s) {
        i.docReady(function() {
            var o = i.toDashed(s), r = "data-" + o, a = document.querySelectorAll("[" + r + "]"), h = document.querySelectorAll(".js-" + o), l = i.makeArray(a).concat(i.makeArray(h)), c = r + "-options", d = t.jQuery;
            l.forEach(function(t) {
                var i, o = t.getAttribute(r) || t.getAttribute(c);
                try {
                    i = o && JSON.parse(o);
                } catch (a) {
                    return void (n && n.error("Error parsing " + r + " on " + t.className + ": " + a));
                }
                var h = new e(t, i);
                d && d.data(t, s, h);
            });
        });
    }, i;
}), function(t, e) {
    "function" == typeof define && define.amd ? define("flickity/js/cell", [ "get-size/get-size" ], function(i) {
        return e(t, i);
    }) : "object" == typeof module && module.exports ? module.exports = e(t, require("get-size")) : (t.Flickity = t.Flickity || {}, 
    t.Flickity.Cell = e(t, t.getSize));
}(window, function(t, e) {
    function i(t, e) {
        this.element = t, this.parent = e, this.create();
    }
    var n = i.prototype;
    return n.create = function() {
        this.element.style.position = "absolute", this.x = 0, this.shift = 0;
    }, n.destroy = function() {
        this.element.style.position = "";
        var t = this.parent.originSide;
        this.element.style[t] = "";
    }, n.getSize = function() {
        this.size = e(this.element);
    }, n.setPosition = function(t) {
        this.x = t, this.updateTarget(), this.renderPosition(t);
    }, n.updateTarget = n.setDefaultTarget = function() {
        var t = "left" == this.parent.originSide ? "marginLeft" : "marginRight";
        this.target = this.x + this.size[t] + this.size.width * this.parent.cellAlign;
    }, n.renderPosition = function(t) {
        var e = this.parent.originSide;
        this.element.style[e] = this.parent.getPositionValue(t);
    }, n.wrapShift = function(t) {
        this.shift = t, this.renderPosition(this.x + this.parent.slideableWidth * t);
    }, n.remove = function() {
        this.element.parentNode.removeChild(this.element);
    }, i;
}), function(t, e) {
    "function" == typeof define && define.amd ? define("flickity/js/slide", e) : "object" == typeof module && module.exports ? module.exports = e() : (t.Flickity = t.Flickity || {}, 
    t.Flickity.Slide = e());
}(window, function() {
    "use strict";
    function t(t) {
        this.parent = t, this.isOriginLeft = "left" == t.originSide, this.cells = [], this.outerWidth = 0, 
        this.height = 0;
    }
    var e = t.prototype;
    return e.addCell = function(t) {
        if (this.cells.push(t), this.outerWidth += t.size.outerWidth, this.height = Math.max(t.size.outerHeight, this.height), 
        1 == this.cells.length) {
            this.x = t.x;
            var e = this.isOriginLeft ? "marginLeft" : "marginRight";
            this.firstMargin = t.size[e];
        }
    }, e.updateTarget = function() {
        var t = this.isOriginLeft ? "marginRight" : "marginLeft", e = this.getLastCell(), i = e ? e.size[t] : 0, n = this.outerWidth - (this.firstMargin + i);
        this.target = this.x + this.firstMargin + n * this.parent.cellAlign;
    }, e.getLastCell = function() {
        return this.cells[this.cells.length - 1];
    }, e.select = function() {
        this.changeSelectedClass("add");
    }, e.unselect = function() {
        this.changeSelectedClass("remove");
    }, e.changeSelectedClass = function(t) {
        this.cells.forEach(function(e) {
            e.element.classList[t]("is-selected");
        });
    }, e.getCellElements = function() {
        return this.cells.map(function(t) {
            return t.element;
        });
    }, t;
}), function(t, e) {
    "function" == typeof define && define.amd ? define("flickity/js/animate", [ "fizzy-ui-utils/utils" ], function(i) {
        return e(t, i);
    }) : "object" == typeof module && module.exports ? module.exports = e(t, require("fizzy-ui-utils")) : (t.Flickity = t.Flickity || {}, 
    t.Flickity.animatePrototype = e(t, t.fizzyUIUtils));
}(window, function(t, e) {
    var i = t.requestAnimationFrame || t.webkitRequestAnimationFrame, n = 0;
    i || (i = function(t) {
        var e = new Date().getTime(), i = Math.max(0, 16 - (e - n)), s = setTimeout(t, i);
        return n = e + i, s;
    });
    var s = {};
    s.startAnimation = function() {
        this.isAnimating || (this.isAnimating = !0, this.restingFrames = 0, this.animate());
    }, s.animate = function() {
        this.applyDragForce(), this.applySelectedAttraction();
        var t = this.x;
        if (this.integratePhysics(), this.positionSlider(), this.settle(t), this.isAnimating) {
            var e = this;
            i(function() {
                e.animate();
            });
        }
    };
    var o = function() {
        var t = document.documentElement.style;
        return "string" == typeof t.transform ? "transform" : "WebkitTransform";
    }();
    return s.positionSlider = function() {
        var t = this.x;
        this.options.wrapAround && this.cells.length > 1 && (t = e.modulo(t, this.slideableWidth), 
        t -= this.slideableWidth, this.shiftWrapCells(t)), t += this.cursorPosition, t = this.options.rightToLeft && o ? -t : t;
        var i = this.getPositionValue(t);
        this.slider.style[o] = this.isAnimating ? "translate3d(" + i + ",0,0)" : "translateX(" + i + ")";
        var n = this.slides[0];
        if (n) {
            var s = -this.x - n.target, r = s / this.slidesWidth;
            this.dispatchEvent("scroll", null, [ r, s ]);
        }
    }, s.positionSliderAtSelected = function() {
        this.cells.length && (this.x = -this.selectedSlide.target, this.positionSlider());
    }, s.getPositionValue = function(t) {
        return this.options.percentPosition ? .01 * Math.round(t / this.size.innerWidth * 1e4) + "%" : Math.round(t) + "px";
    }, s.settle = function(t) {
        this.isPointerDown || Math.round(100 * this.x) != Math.round(100 * t) || this.restingFrames++, 
        this.restingFrames > 2 && (this.isAnimating = !1, delete this.isFreeScrolling, this.positionSlider(), 
        this.dispatchEvent("settle"));
    }, s.shiftWrapCells = function(t) {
        var e = this.cursorPosition + t;
        this._shiftCells(this.beforeShiftCells, e, -1);
        var i = this.size.innerWidth - (t + this.slideableWidth + this.cursorPosition);
        this._shiftCells(this.afterShiftCells, i, 1);
    }, s._shiftCells = function(t, e, i) {
        for (var n = 0; n < t.length; n++) {
            var s = t[n], o = e > 0 ? i : 0;
            s.wrapShift(o), e -= s.size.outerWidth;
        }
    }, s._unshiftCells = function(t) {
        if (t && t.length) for (var e = 0; e < t.length; e++) t[e].wrapShift(0);
    }, s.integratePhysics = function() {
        this.x += this.velocity, this.velocity *= this.getFrictionFactor();
    }, s.applyForce = function(t) {
        this.velocity += t;
    }, s.getFrictionFactor = function() {
        return 1 - this.options[this.isFreeScrolling ? "freeScrollFriction" : "friction"];
    }, s.getRestingPosition = function() {
        return this.x + this.velocity / (1 - this.getFrictionFactor());
    }, s.applyDragForce = function() {
        if (this.isPointerDown) {
            var t = this.dragX - this.x, e = t - this.velocity;
            this.applyForce(e);
        }
    }, s.applySelectedAttraction = function() {
        if (!this.isPointerDown && !this.isFreeScrolling && this.cells.length) {
            var t = this.selectedSlide.target * -1 - this.x, e = t * this.options.selectedAttraction;
            this.applyForce(e);
        }
    }, s;
}), function(t, e) {
    if ("function" == typeof define && define.amd) define("flickity/js/flickity", [ "ev-emitter/ev-emitter", "get-size/get-size", "fizzy-ui-utils/utils", "./cell", "./slide", "./animate" ], function(i, n, s, o, r, a) {
        return e(t, i, n, s, o, r, a);
    }); else if ("object" == typeof module && module.exports) module.exports = e(t, require("ev-emitter"), require("get-size"), require("fizzy-ui-utils"), require("./cell"), require("./slide"), require("./animate")); else {
        var i = t.Flickity;
        t.Flickity = e(t, t.EvEmitter, t.getSize, t.fizzyUIUtils, i.Cell, i.Slide, i.animatePrototype);
    }
}(window, function(t, e, i, n, s, o, r) {
    function a(t, e) {
        for (t = n.makeArray(t); t.length; ) e.appendChild(t.shift());
    }
    function h(t, e) {
        var i = n.getQueryElement(t);
        if (!i) return void (d && d.error("Bad element for Flickity: " + (i || t)));
        if (this.element = i, this.element.flickityGUID) {
            var s = f[this.element.flickityGUID];
            return s.option(e), s;
        }
        l && (this.$element = l(this.element)), this.options = n.extend({}, this.constructor.defaults), 
        this.option(e), this._create();
    }
    var l = t.jQuery, c = t.getComputedStyle, d = t.console, u = 0, f = {};
    h.defaults = {
        accessibility: !0,
        cellAlign: "center",
        freeScrollFriction: .075,
        friction: .28,
        namespaceJQueryEvents: !0,
        percentPosition: !0,
        resize: !0,
        selectedAttraction: .025,
        setGallerySize: !0
    }, h.createMethods = [];
    var p = h.prototype;
    n.extend(p, e.prototype), p._create = function() {
        var e = this.guid = ++u;
        this.element.flickityGUID = e, f[e] = this, this.selectedIndex = 0, this.restingFrames = 0, 
        this.x = 0, this.velocity = 0, this.originSide = this.options.rightToLeft ? "right" : "left", 
        this.viewport = document.createElement("div"), this.viewport.className = "flickity-viewport", 
        this._createSlider(), (this.options.resize || this.options.watchCSS) && t.addEventListener("resize", this), 
        h.createMethods.forEach(function(t) {
            this[t]();
        }, this), this.options.watchCSS ? this.watchCSS() : this.activate();
    }, p.option = function(t) {
        n.extend(this.options, t);
    }, p.activate = function() {
        if (!this.isActive) {
            this.isActive = !0, this.element.classList.add("flickity-enabled"), this.options.rightToLeft && this.element.classList.add("flickity-rtl"), 
            this.getSize();
            var t = this._filterFindCellElements(this.element.children);
            a(t, this.slider), this.viewport.appendChild(this.slider), this.element.appendChild(this.viewport), 
            this.reloadCells(), this.options.accessibility && (this.element.tabIndex = 0, this.element.addEventListener("keydown", this)), 
            this.emitEvent("activate");
            var e, i = this.options.initialIndex;
            e = this.isInitActivated ? this.selectedIndex : void 0 !== i && this.cells[i] ? i : 0, 
            this.select(e, !1, !0), this.isInitActivated = !0;
        }
    }, p._createSlider = function() {
        var t = document.createElement("div");
        t.className = "flickity-slider", t.style[this.originSide] = 0, this.slider = t;
    }, p._filterFindCellElements = function(t) {
        return n.filterFindElements(t, this.options.cellSelector);
    }, p.reloadCells = function() {
        this.cells = this._makeCells(this.slider.children), this.positionCells(), this._getWrapShiftCells(), 
        this.setGallerySize();
    }, p._makeCells = function(t) {
        var e = this._filterFindCellElements(t), i = e.map(function(t) {
            return new s(t, this);
        }, this);
        return i;
    }, p.getLastCell = function() {
        return this.cells[this.cells.length - 1];
    }, p.getLastSlide = function() {
        return this.slides[this.slides.length - 1];
    }, p.positionCells = function() {
        this._sizeCells(this.cells), this._positionCells(0);
    }, p._positionCells = function(t) {
        t = t || 0, this.maxCellHeight = t ? this.maxCellHeight || 0 : 0;
        var e = 0;
        if (t > 0) {
            var i = this.cells[t - 1];
            e = i.x + i.size.outerWidth;
        }
        for (var n = this.cells.length, s = t; s < n; s++) {
            var o = this.cells[s];
            o.setPosition(e), e += o.size.outerWidth, this.maxCellHeight = Math.max(o.size.outerHeight, this.maxCellHeight);
        }
        this.slideableWidth = e, this.updateSlides(), this._containSlides(), this.slidesWidth = n ? this.getLastSlide().target - this.slides[0].target : 0;
    }, p._sizeCells = function(t) {
        t.forEach(function(t) {
            t.getSize();
        });
    }, p.updateSlides = function() {
        if (this.slides = [], this.cells.length) {
            var t = new o(this);
            this.slides.push(t);
            var e = "left" == this.originSide, i = e ? "marginRight" : "marginLeft", n = this._getCanCellFit();
            this.cells.forEach(function(e, s) {
                if (!t.cells.length) return void t.addCell(e);
                var r = t.outerWidth - t.firstMargin + (e.size.outerWidth - e.size[i]);
                n.call(this, s, r) ? t.addCell(e) : (t.updateTarget(), t = new o(this), this.slides.push(t), 
                t.addCell(e));
            }, this), t.updateTarget(), this.updateSelectedSlide();
        }
    }, p._getCanCellFit = function() {
        var t = this.options.groupCells;
        if (!t) return function() {
            return !1;
        };
        if ("number" == typeof t) {
            var e = parseInt(t, 10);
            return function(t) {
                return t % e !== 0;
            };
        }
        var i = "string" == typeof t && t.match(/^(\d+)%$/), n = i ? parseInt(i[1], 10) / 100 : 1;
        return function(t, e) {
            return e <= (this.size.innerWidth + 1) * n;
        };
    }, p._init = p.reposition = function() {
        this.positionCells(), this.positionSliderAtSelected();
    }, p.getSize = function() {
        this.size = i(this.element), this.setCellAlign(), this.cursorPosition = this.size.innerWidth * this.cellAlign;
    };
    var v = {
        center: {
            left: .5,
            right: .5
        },
        left: {
            left: 0,
            right: 1
        },
        right: {
            right: 0,
            left: 1
        }
    };
    return p.setCellAlign = function() {
        var t = v[this.options.cellAlign];
        this.cellAlign = t ? t[this.originSide] : this.options.cellAlign;
    }, p.setGallerySize = function() {
        if (this.options.setGallerySize) {
            var t = this.options.adaptiveHeight && this.selectedSlide ? this.selectedSlide.height : this.maxCellHeight;
            this.viewport.style.height = t + "px";
        }
    }, p._getWrapShiftCells = function() {
        if (this.options.wrapAround) {
            this._unshiftCells(this.beforeShiftCells), this._unshiftCells(this.afterShiftCells);
            var t = this.cursorPosition, e = this.cells.length - 1;
            this.beforeShiftCells = this._getGapCells(t, e, -1), t = this.size.innerWidth - this.cursorPosition, 
            this.afterShiftCells = this._getGapCells(t, 0, 1);
        }
    }, p._getGapCells = function(t, e, i) {
        for (var n = []; t > 0; ) {
            var s = this.cells[e];
            if (!s) break;
            n.push(s), e += i, t -= s.size.outerWidth;
        }
        return n;
    }, p._containSlides = function() {
        if (this.options.contain && !this.options.wrapAround && this.cells.length) {
            var t = this.options.rightToLeft, e = t ? "marginRight" : "marginLeft", i = t ? "marginLeft" : "marginRight", n = this.slideableWidth - this.getLastCell().size[i], s = n < this.size.innerWidth, o = this.cursorPosition + this.cells[0].size[e], r = n - this.size.innerWidth * (1 - this.cellAlign);
            this.slides.forEach(function(t) {
                s ? t.target = n * this.cellAlign : (t.target = Math.max(t.target, o), t.target = Math.min(t.target, r));
            }, this);
        }
    }, p.dispatchEvent = function(t, e, i) {
        var n = e ? [ e ].concat(i) : i;
        if (this.emitEvent(t, n), l && this.$element) {
            t += this.options.namespaceJQueryEvents ? ".flickity" : "";
            var s = t;
            if (e) {
                var o = l.Event(e);
                o.type = t, s = o;
            }
            this.$element.trigger(s, i);
        }
    }, p.select = function(t, e, i) {
        this.isActive && (t = parseInt(t, 10), this._wrapSelect(t), (this.options.wrapAround || e) && (t = n.modulo(t, this.slides.length)), 
        this.slides[t] && (this.selectedIndex = t, this.updateSelectedSlide(), i ? this.positionSliderAtSelected() : this.startAnimation(), 
        this.options.adaptiveHeight && this.setGallerySize(), this.dispatchEvent("select"), 
        this.dispatchEvent("cellSelect")));
    }, p._wrapSelect = function(t) {
        var e = this.slides.length, i = this.options.wrapAround && e > 1;
        if (!i) return t;
        var s = n.modulo(t, e), o = Math.abs(s - this.selectedIndex), r = Math.abs(s + e - this.selectedIndex), a = Math.abs(s - e - this.selectedIndex);
        !this.isDragSelect && r < o ? t += e : !this.isDragSelect && a < o && (t -= e), 
        t < 0 ? this.x -= this.slideableWidth : t >= e && (this.x += this.slideableWidth);
    }, p.previous = function(t, e) {
        this.select(this.selectedIndex - 1, t, e);
    }, p.next = function(t, e) {
        this.select(this.selectedIndex + 1, t, e);
    }, p.updateSelectedSlide = function() {
        var t = this.slides[this.selectedIndex];
        t && (this.unselectSelectedSlide(), this.selectedSlide = t, t.select(), this.selectedCells = t.cells, 
        this.selectedElements = t.getCellElements(), this.selectedCell = t.cells[0], this.selectedElement = this.selectedElements[0]);
    }, p.unselectSelectedSlide = function() {
        this.selectedSlide && this.selectedSlide.unselect();
    }, p.selectCell = function(t, e, i) {
        var n;
        "number" == typeof t ? n = this.cells[t] : ("string" == typeof t && (t = this.element.querySelector(t)), 
        n = this.getCell(t));
        for (var s = 0; n && s < this.slides.length; s++) {
            var o = this.slides[s], r = o.cells.indexOf(n);
            if (r != -1) return void this.select(s, e, i);
        }
    }, p.getCell = function(t) {
        for (var e = 0; e < this.cells.length; e++) {
            var i = this.cells[e];
            if (i.element == t) return i;
        }
    }, p.getCells = function(t) {
        t = n.makeArray(t);
        var e = [];
        return t.forEach(function(t) {
            var i = this.getCell(t);
            i && e.push(i);
        }, this), e;
    }, p.getCellElements = function() {
        return this.cells.map(function(t) {
            return t.element;
        });
    }, p.getParentCell = function(t) {
        var e = this.getCell(t);
        return e ? e : (t = n.getParent(t, ".flickity-slider > *"), this.getCell(t));
    }, p.getAdjacentCellElements = function(t, e) {
        if (!t) return this.selectedSlide.getCellElements();
        e = void 0 === e ? this.selectedIndex : e;
        var i = this.slides.length;
        if (1 + 2 * t >= i) return this.getCellElements();
        for (var s = [], o = e - t; o <= e + t; o++) {
            var r = this.options.wrapAround ? n.modulo(o, i) : o, a = this.slides[r];
            a && (s = s.concat(a.getCellElements()));
        }
        return s;
    }, p.uiChange = function() {
        this.emitEvent("uiChange");
    }, p.childUIPointerDown = function(t) {
        this.emitEvent("childUIPointerDown", [ t ]);
    }, p.onresize = function() {
        this.watchCSS(), this.resize();
    }, n.debounceMethod(h, "onresize", 150), p.resize = function() {
        if (this.isActive) {
            this.getSize(), this.options.wrapAround && (this.x = n.modulo(this.x, this.slideableWidth)), 
            this.positionCells(), this._getWrapShiftCells(), this.setGallerySize(), this.emitEvent("resize");
            var t = this.selectedElements && this.selectedElements[0];
            this.selectCell(t, !1, !0);
        }
    }, p.watchCSS = function() {
        var t = this.options.watchCSS;
        if (t) {
            var e = c(this.element, ":after").content;
            e.indexOf("flickity") != -1 ? this.activate() : this.deactivate();
        }
    }, p.onkeydown = function(t) {
        if (this.options.accessibility && (!document.activeElement || document.activeElement == this.element)) if (37 == t.keyCode) {
            var e = this.options.rightToLeft ? "next" : "previous";
            this.uiChange(), this[e]();
        } else if (39 == t.keyCode) {
            var i = this.options.rightToLeft ? "previous" : "next";
            this.uiChange(), this[i]();
        }
    }, p.deactivate = function() {
        this.isActive && (this.element.classList.remove("flickity-enabled"), this.element.classList.remove("flickity-rtl"), 
        this.cells.forEach(function(t) {
            t.destroy();
        }), this.unselectSelectedSlide(), this.element.removeChild(this.viewport), a(this.slider.children, this.element), 
        this.options.accessibility && (this.element.removeAttribute("tabIndex"), this.element.removeEventListener("keydown", this)), 
        this.isActive = !1, this.emitEvent("deactivate"));
    }, p.destroy = function() {
        this.deactivate(), t.removeEventListener("resize", this), this.emitEvent("destroy"), 
        l && this.$element && l.removeData(this.element, "flickity"), delete this.element.flickityGUID, 
        delete f[this.guid];
    }, n.extend(p, r), h.data = function(t) {
        t = n.getQueryElement(t);
        var e = t && t.flickityGUID;
        return e && f[e];
    }, n.htmlInit(h, "flickity"), l && l.bridget && l.bridget("flickity", h), h.setJQuery = function(t) {
        l = t;
    }, h.Cell = s, h;
}), function(t, e) {
    "function" == typeof define && define.amd ? define("unipointer/unipointer", [ "ev-emitter/ev-emitter" ], function(i) {
        return e(t, i);
    }) : "object" == typeof module && module.exports ? module.exports = e(t, require("ev-emitter")) : t.Unipointer = e(t, t.EvEmitter);
}(window, function(t, e) {
    function i() {}
    function n() {}
    var s = n.prototype = Object.create(e.prototype);
    s.bindStartEvent = function(t) {
        this._bindStartEvent(t, !0);
    }, s.unbindStartEvent = function(t) {
        this._bindStartEvent(t, !1);
    }, s._bindStartEvent = function(e, i) {
        i = void 0 === i || !!i;
        var n = i ? "addEventListener" : "removeEventListener";
        t.PointerEvent ? e[n]("pointerdown", this) : (e[n]("mousedown", this), e[n]("touchstart", this));
    }, s.handleEvent = function(t) {
        var e = "on" + t.type;
        this[e] && this[e](t);
    }, s.getTouch = function(t) {
        for (var e = 0; e < t.length; e++) {
            var i = t[e];
            if (i.identifier == this.pointerIdentifier) return i;
        }
    }, s.onmousedown = function(t) {
        var e = t.button;
        e && 0 !== e && 1 !== e || this._pointerDown(t, t);
    }, s.ontouchstart = function(t) {
        this._pointerDown(t, t.changedTouches[0]);
    }, s.onpointerdown = function(t) {
        this._pointerDown(t, t);
    }, s._pointerDown = function(t, e) {
        this.isPointerDown || (this.isPointerDown = !0, this.pointerIdentifier = void 0 !== e.pointerId ? e.pointerId : e.identifier, 
        this.pointerDown(t, e));
    }, s.pointerDown = function(t, e) {
        this._bindPostStartEvents(t), this.emitEvent("pointerDown", [ t, e ]);
    };
    var o = {
        mousedown: [ "mousemove", "mouseup" ],
        touchstart: [ "touchmove", "touchend", "touchcancel" ],
        pointerdown: [ "pointermove", "pointerup", "pointercancel" ]
    };
    return s._bindPostStartEvents = function(e) {
        if (e) {
            var i = o[e.type];
            i.forEach(function(e) {
                t.addEventListener(e, this);
            }, this), this._boundPointerEvents = i;
        }
    }, s._unbindPostStartEvents = function() {
        this._boundPointerEvents && (this._boundPointerEvents.forEach(function(e) {
            t.removeEventListener(e, this);
        }, this), delete this._boundPointerEvents);
    }, s.onmousemove = function(t) {
        this._pointerMove(t, t);
    }, s.onpointermove = function(t) {
        t.pointerId == this.pointerIdentifier && this._pointerMove(t, t);
    }, s.ontouchmove = function(t) {
        var e = this.getTouch(t.changedTouches);
        e && this._pointerMove(t, e);
    }, s._pointerMove = function(t, e) {
        this.pointerMove(t, e);
    }, s.pointerMove = function(t, e) {
        this.emitEvent("pointerMove", [ t, e ]);
    }, s.onmouseup = function(t) {
        this._pointerUp(t, t);
    }, s.onpointerup = function(t) {
        t.pointerId == this.pointerIdentifier && this._pointerUp(t, t);
    }, s.ontouchend = function(t) {
        var e = this.getTouch(t.changedTouches);
        e && this._pointerUp(t, e);
    }, s._pointerUp = function(t, e) {
        this._pointerDone(), this.pointerUp(t, e);
    }, s.pointerUp = function(t, e) {
        this.emitEvent("pointerUp", [ t, e ]);
    }, s._pointerDone = function() {
        this.isPointerDown = !1, delete this.pointerIdentifier, this._unbindPostStartEvents(), 
        this.pointerDone();
    }, s.pointerDone = i, s.onpointercancel = function(t) {
        t.pointerId == this.pointerIdentifier && this._pointerCancel(t, t);
    }, s.ontouchcancel = function(t) {
        var e = this.getTouch(t.changedTouches);
        e && this._pointerCancel(t, e);
    }, s._pointerCancel = function(t, e) {
        this._pointerDone(), this.pointerCancel(t, e);
    }, s.pointerCancel = function(t, e) {
        this.emitEvent("pointerCancel", [ t, e ]);
    }, n.getPointerPoint = function(t) {
        return {
            x: t.pageX,
            y: t.pageY
        };
    }, n;
}), function(t, e) {
    "function" == typeof define && define.amd ? define("unidragger/unidragger", [ "unipointer/unipointer" ], function(i) {
        return e(t, i);
    }) : "object" == typeof module && module.exports ? module.exports = e(t, require("unipointer")) : t.Unidragger = e(t, t.Unipointer);
}(window, function(t, e) {
    function i() {}
    var n = i.prototype = Object.create(e.prototype);
    return n.bindHandles = function() {
        this._bindHandles(!0);
    }, n.unbindHandles = function() {
        this._bindHandles(!1);
    }, n._bindHandles = function(e) {
        e = void 0 === e || !!e;
        for (var i = e ? "addEventListener" : "removeEventListener", n = 0; n < this.handles.length; n++) {
            var s = this.handles[n];
            this._bindStartEvent(s, e), s[i]("click", this), t.PointerEvent && (s.style.touchAction = e ? this._touchActionValue : "");
        }
    }, n._touchActionValue = "none", n.pointerDown = function(t, e) {
        if ("INPUT" == t.target.nodeName && "range" == t.target.type) return this.isPointerDown = !1, 
        void delete this.pointerIdentifier;
        this._dragPointerDown(t, e);
        var i = document.activeElement;
        i && i.blur && i.blur(), this._bindPostStartEvents(t), this.emitEvent("pointerDown", [ t, e ]);
    }, n._dragPointerDown = function(t, i) {
        this.pointerDownPoint = e.getPointerPoint(i);
        var n = this.canPreventDefaultOnPointerDown(t, i);
        n && t.preventDefault();
    }, n.canPreventDefaultOnPointerDown = function(t) {
        return "SELECT" != t.target.nodeName;
    }, n.pointerMove = function(t, e) {
        var i = this._dragPointerMove(t, e);
        this.emitEvent("pointerMove", [ t, e, i ]), this._dragMove(t, e, i);
    }, n._dragPointerMove = function(t, i) {
        var n = e.getPointerPoint(i), s = {
            x: n.x - this.pointerDownPoint.x,
            y: n.y - this.pointerDownPoint.y
        };
        return !this.isDragging && this.hasDragStarted(s) && this._dragStart(t, i), s;
    }, n.hasDragStarted = function(t) {
        return Math.abs(t.x) > 3 || Math.abs(t.y) > 3;
    }, n.pointerUp = function(t, e) {
        this.emitEvent("pointerUp", [ t, e ]), this._dragPointerUp(t, e);
    }, n._dragPointerUp = function(t, e) {
        this.isDragging ? this._dragEnd(t, e) : this._staticClick(t, e);
    }, n._dragStart = function(t, i) {
        this.isDragging = !0, this.dragStartPoint = e.getPointerPoint(i), this.isPreventingClicks = !0, 
        this.dragStart(t, i);
    }, n.dragStart = function(t, e) {
        this.emitEvent("dragStart", [ t, e ]);
    }, n._dragMove = function(t, e, i) {
        this.isDragging && this.dragMove(t, e, i);
    }, n.dragMove = function(t, e, i) {
        t.preventDefault(), this.emitEvent("dragMove", [ t, e, i ]);
    }, n._dragEnd = function(t, e) {
        this.isDragging = !1, setTimeout(function() {
            delete this.isPreventingClicks;
        }.bind(this)), this.dragEnd(t, e);
    }, n.dragEnd = function(t, e) {
        this.emitEvent("dragEnd", [ t, e ]);
    }, n.onclick = function(t) {
        this.isPreventingClicks && t.preventDefault();
    }, n._staticClick = function(t, e) {
        if (!this.isIgnoringMouseUp || "mouseup" != t.type) {
            var i = t.target.nodeName;
            "INPUT" != i && "TEXTAREA" != i || t.target.focus(), this.staticClick(t, e), "mouseup" != t.type && (this.isIgnoringMouseUp = !0, 
            setTimeout(function() {
                delete this.isIgnoringMouseUp;
            }.bind(this), 400));
        }
    }, n.staticClick = function(t, e) {
        this.emitEvent("staticClick", [ t, e ]);
    }, i.getPointerPoint = e.getPointerPoint, i;
}), function(t, e) {
    "function" == typeof define && define.amd ? define("flickity/js/drag", [ "./flickity", "unidragger/unidragger", "fizzy-ui-utils/utils" ], function(i, n, s) {
        return e(t, i, n, s);
    }) : "object" == typeof module && module.exports ? module.exports = e(t, require("./flickity"), require("unidragger"), require("fizzy-ui-utils")) : t.Flickity = e(t, t.Flickity, t.Unidragger, t.fizzyUIUtils);
}(window, function(t, e, i, n) {
    function s(t) {
        var e = "touchstart" == t.type, i = "touch" == t.pointerType, n = d[t.target.nodeName];
        return e || i || n;
    }
    function o() {
        return {
            x: t.pageXOffset,
            y: t.pageYOffset
        };
    }
    n.extend(e.defaults, {
        draggable: !0,
        dragThreshold: 3
    }), e.createMethods.push("_createDrag");
    var r = e.prototype;
    n.extend(r, i.prototype), r._touchActionValue = "pan-y";
    var a = "createTouch" in document, h = !1;
    r._createDrag = function() {
        this.on("activate", this.bindDrag), this.on("uiChange", this._uiChangeDrag), this.on("childUIPointerDown", this._childUIPointerDownDrag), 
        this.on("deactivate", this.unbindDrag), a && !h && (t.addEventListener("touchmove", function() {}), 
        h = !0);
    }, r.bindDrag = function() {
        this.options.draggable && !this.isDragBound && (this.element.classList.add("is-draggable"), 
        this.handles = [ this.viewport ], this.bindHandles(), this.isDragBound = !0);
    }, r.unbindDrag = function() {
        this.isDragBound && (this.element.classList.remove("is-draggable"), this.unbindHandles(), 
        delete this.isDragBound);
    }, r._uiChangeDrag = function() {
        delete this.isFreeScrolling;
    }, r._childUIPointerDownDrag = function(t) {
        t.preventDefault(), this.pointerDownFocus(t);
    };
    var l = {
        TEXTAREA: !0,
        INPUT: !0,
        OPTION: !0
    }, c = {
        radio: !0,
        checkbox: !0,
        button: !0,
        submit: !0,
        image: !0,
        file: !0
    };
    r.pointerDown = function(e, i) {
        var n = l[e.target.nodeName] && !c[e.target.type];
        if (n) return this.isPointerDown = !1, void delete this.pointerIdentifier;
        this._dragPointerDown(e, i);
        var s = document.activeElement;
        s && s.blur && s != this.element && s != document.body && s.blur(), this.pointerDownFocus(e), 
        this.dragX = this.x, this.viewport.classList.add("is-pointer-down"), this._bindPostStartEvents(e), 
        this.pointerDownScroll = o(), t.addEventListener("scroll", this), this.dispatchEvent("pointerDown", e, [ i ]);
    }, r.pointerDownFocus = function(e) {
        var i = s(e);
        if (this.options.accessibility && !i) {
            var n = t.pageYOffset;
            this.element.focus(), t.pageYOffset != n && t.scrollTo(t.pageXOffset, n);
        }
    };
    var d = {
        INPUT: !0,
        SELECT: !0
    };
    return r.canPreventDefaultOnPointerDown = function(t) {
        var e = s(t);
        return !e;
    }, r.hasDragStarted = function(t) {
        return Math.abs(t.x) > this.options.dragThreshold;
    }, r.pointerUp = function(t, e) {
        delete this.isTouchScrolling, this.viewport.classList.remove("is-pointer-down"), 
        this.dispatchEvent("pointerUp", t, [ e ]), this._dragPointerUp(t, e);
    }, r.pointerDone = function() {
        t.removeEventListener("scroll", this), delete this.pointerDownScroll;
    }, r.dragStart = function(e, i) {
        this.dragStartPosition = this.x, this.startAnimation(), t.removeEventListener("scroll", this), 
        this.dispatchEvent("dragStart", e, [ i ]);
    }, r.pointerMove = function(t, e) {
        var i = this._dragPointerMove(t, e);
        this.dispatchEvent("pointerMove", t, [ e, i ]), this._dragMove(t, e, i);
    }, r.dragMove = function(t, e, i) {
        t.preventDefault(), this.previousDragX = this.dragX;
        var n = this.options.rightToLeft ? -1 : 1, s = this.dragStartPosition + i.x * n;
        if (!this.options.wrapAround && this.slides.length) {
            var o = Math.max(-this.slides[0].target, this.dragStartPosition);
            s = s > o ? .5 * (s + o) : s;
            var r = Math.min(-this.getLastSlide().target, this.dragStartPosition);
            s = s < r ? .5 * (s + r) : s;
        }
        this.dragX = s, this.dragMoveTime = new Date(), this.dispatchEvent("dragMove", t, [ e, i ]);
    }, r.dragEnd = function(t, e) {
        this.options.freeScroll && (this.isFreeScrolling = !0);
        var i = this.dragEndRestingSelect();
        if (this.options.freeScroll && !this.options.wrapAround) {
            var n = this.getRestingPosition();
            this.isFreeScrolling = -n > this.slides[0].target && -n < this.getLastSlide().target;
        } else this.options.freeScroll || i != this.selectedIndex || (i += this.dragEndBoostSelect());
        delete this.previousDragX, this.isDragSelect = this.options.wrapAround, this.select(i), 
        delete this.isDragSelect, this.dispatchEvent("dragEnd", t, [ e ]);
    }, r.dragEndRestingSelect = function() {
        var t = this.getRestingPosition(), e = Math.abs(this.getSlideDistance(-t, this.selectedIndex)), i = this._getClosestResting(t, e, 1), n = this._getClosestResting(t, e, -1), s = i.distance < n.distance ? i.index : n.index;
        return s;
    }, r._getClosestResting = function(t, e, i) {
        for (var n = this.selectedIndex, s = 1 / 0, o = this.options.contain && !this.options.wrapAround ? function(t, e) {
            return t <= e;
        } : function(t, e) {
            return t < e;
        }; o(e, s) && (n += i, s = e, e = this.getSlideDistance(-t, n), null !== e); ) e = Math.abs(e);
        return {
            distance: s,
            index: n - i
        };
    }, r.getSlideDistance = function(t, e) {
        var i = this.slides.length, s = this.options.wrapAround && i > 1, o = s ? n.modulo(e, i) : e, r = this.slides[o];
        if (!r) return null;
        var a = s ? this.slideableWidth * Math.floor(e / i) : 0;
        return t - (r.target + a);
    }, r.dragEndBoostSelect = function() {
        if (void 0 === this.previousDragX || !this.dragMoveTime || new Date() - this.dragMoveTime > 100) return 0;
        var t = this.getSlideDistance(-this.dragX, this.selectedIndex), e = this.previousDragX - this.dragX;
        return t > 0 && e > 0 ? 1 : t < 0 && e < 0 ? -1 : 0;
    }, r.staticClick = function(t, e) {
        var i = this.getParentCell(t.target), n = i && i.element, s = i && this.cells.indexOf(i);
        this.dispatchEvent("staticClick", t, [ e, n, s ]);
    }, r.onscroll = function() {
        var t = o(), e = this.pointerDownScroll.x - t.x, i = this.pointerDownScroll.y - t.y;
        (Math.abs(e) > 3 || Math.abs(i) > 3) && this._pointerDone();
    }, e;
}), function(t, e) {
    "function" == typeof define && define.amd ? define("tap-listener/tap-listener", [ "unipointer/unipointer" ], function(i) {
        return e(t, i);
    }) : "object" == typeof module && module.exports ? module.exports = e(t, require("unipointer")) : t.TapListener = e(t, t.Unipointer);
}(window, function(t, e) {
    function i(t) {
        this.bindTap(t);
    }
    var n = i.prototype = Object.create(e.prototype);
    return n.bindTap = function(t) {
        t && (this.unbindTap(), this.tapElement = t, this._bindStartEvent(t, !0));
    }, n.unbindTap = function() {
        this.tapElement && (this._bindStartEvent(this.tapElement, !0), delete this.tapElement);
    }, n.pointerUp = function(i, n) {
        if (!this.isIgnoringMouseUp || "mouseup" != i.type) {
            var s = e.getPointerPoint(n), o = this.tapElement.getBoundingClientRect(), r = t.pageXOffset, a = t.pageYOffset, h = s.x >= o.left + r && s.x <= o.right + r && s.y >= o.top + a && s.y <= o.bottom + a;
            if (h && this.emitEvent("tap", [ i, n ]), "mouseup" != i.type) {
                this.isIgnoringMouseUp = !0;
                var l = this;
                setTimeout(function() {
                    delete l.isIgnoringMouseUp;
                }, 400);
            }
        }
    }, n.destroy = function() {
        this.pointerDone(), this.unbindTap();
    }, i;
}), function(t, e) {
    "function" == typeof define && define.amd ? define("flickity/js/prev-next-button", [ "./flickity", "tap-listener/tap-listener", "fizzy-ui-utils/utils" ], function(i, n, s) {
        return e(t, i, n, s);
    }) : "object" == typeof module && module.exports ? module.exports = e(t, require("./flickity"), require("tap-listener"), require("fizzy-ui-utils")) : e(t, t.Flickity, t.TapListener, t.fizzyUIUtils);
}(window, function(t, e, i, n) {
    "use strict";
    function s(t, e) {
        this.direction = t, this.parent = e, this._create();
    }
    function o(t) {
        return "string" == typeof t ? t : "M " + t.x0 + ",50 L " + t.x1 + "," + (t.y1 + 50) + " L " + t.x2 + "," + (t.y2 + 50) + " L " + t.x3 + ",50  L " + t.x2 + "," + (50 - t.y2) + " L " + t.x1 + "," + (50 - t.y1) + " Z";
    }
    var r = "http://www.w3.org/2000/svg";
    s.prototype = new i(), s.prototype._create = function() {
        this.isEnabled = !0, this.isPrevious = this.direction == -1;
        var t = this.parent.options.rightToLeft ? 1 : -1;
        this.isLeft = this.direction == t;
        var e = this.element = document.createElement("button");
        e.className = "flickity-prev-next-button", e.className += this.isPrevious ? " previous" : " next", 
        e.setAttribute("type", "button"), this.disable(), e.setAttribute("aria-label", this.isPrevious ? "previous" : "next");
        var i = this.createSVG();
        e.appendChild(i), this.on("tap", this.onTap), this.parent.on("select", this.update.bind(this)), 
        this.on("pointerDown", this.parent.childUIPointerDown.bind(this.parent));
    }, s.prototype.activate = function() {
        this.bindTap(this.element), this.element.addEventListener("click", this), this.parent.element.appendChild(this.element);
    }, s.prototype.deactivate = function() {
        this.parent.element.removeChild(this.element), i.prototype.destroy.call(this), this.element.removeEventListener("click", this);
    }, s.prototype.createSVG = function() {
        var t = document.createElementNS(r, "svg");
        t.setAttribute("viewBox", "0 0 100 100");
        var e = document.createElementNS(r, "path"), i = o(this.parent.options.arrowShape);
        return e.setAttribute("d", i), e.setAttribute("class", "arrow"), this.isLeft || e.setAttribute("transform", "translate(100, 100) rotate(180) "), 
        t.appendChild(e), t;
    }, s.prototype.onTap = function() {
        if (this.isEnabled) {
            this.parent.uiChange();
            var t = this.isPrevious ? "previous" : "next";
            this.parent[t]();
        }
    }, s.prototype.handleEvent = n.handleEvent, s.prototype.onclick = function() {
        var t = document.activeElement;
        t && t == this.element && this.onTap();
    }, s.prototype.enable = function() {
        this.isEnabled || (this.element.disabled = !1, this.isEnabled = !0);
    }, s.prototype.disable = function() {
        this.isEnabled && (this.element.disabled = !0, this.isEnabled = !1);
    }, s.prototype.update = function() {
        var t = this.parent.slides;
        if (this.parent.options.wrapAround && t.length > 1) return void this.enable();
        var e = t.length ? t.length - 1 : 0, i = this.isPrevious ? 0 : e, n = this.parent.selectedIndex == i ? "disable" : "enable";
        this[n]();
    }, s.prototype.destroy = function() {
        this.deactivate();
    }, n.extend(e.defaults, {
        prevNextButtons: !0,
        arrowShape: {
            x0: 10,
            x1: 60,
            y1: 50,
            x2: 70,
            y2: 40,
            x3: 30
        }
    }), e.createMethods.push("_createPrevNextButtons");
    var a = e.prototype;
    return a._createPrevNextButtons = function() {
        this.options.prevNextButtons && (this.prevButton = new s(-1, this), this.nextButton = new s(1, this), 
        this.on("activate", this.activatePrevNextButtons));
    }, a.activatePrevNextButtons = function() {
        this.prevButton.activate(), this.nextButton.activate(), this.on("deactivate", this.deactivatePrevNextButtons);
    }, a.deactivatePrevNextButtons = function() {
        this.prevButton.deactivate(), this.nextButton.deactivate(), this.off("deactivate", this.deactivatePrevNextButtons);
    }, e.PrevNextButton = s, e;
}), function(t, e) {
    "function" == typeof define && define.amd ? define("flickity/js/page-dots", [ "./flickity", "tap-listener/tap-listener", "fizzy-ui-utils/utils" ], function(i, n, s) {
        return e(t, i, n, s);
    }) : "object" == typeof module && module.exports ? module.exports = e(t, require("./flickity"), require("tap-listener"), require("fizzy-ui-utils")) : e(t, t.Flickity, t.TapListener, t.fizzyUIUtils);
}(window, function(t, e, i, n) {
    function s(t) {
        this.parent = t, this._create();
    }
    s.prototype = new i(), s.prototype._create = function() {
        this.holder = document.createElement("ol"), this.holder.className = "flickity-page-dots", 
        this.dots = [], this.on("tap", this.onTap), this.on("pointerDown", this.parent.childUIPointerDown.bind(this.parent));
    }, s.prototype.activate = function() {
        this.setDots(), this.bindTap(this.holder), this.parent.element.appendChild(this.holder);
    }, s.prototype.deactivate = function() {
        this.parent.element.removeChild(this.holder), i.prototype.destroy.call(this);
    }, s.prototype.setDots = function() {
        var t = this.parent.slides.length - this.dots.length;
        t > 0 ? this.addDots(t) : t < 0 && this.removeDots(-t);
    }, s.prototype.addDots = function(t) {
        for (var e = document.createDocumentFragment(), i = []; t; ) {
            var n = document.createElement("li");
            n.className = "dot", e.appendChild(n), i.push(n), t--;
        }
        this.holder.appendChild(e), this.dots = this.dots.concat(i);
    }, s.prototype.removeDots = function(t) {
        var e = this.dots.splice(this.dots.length - t, t);
        e.forEach(function(t) {
            this.holder.removeChild(t);
        }, this);
    }, s.prototype.updateSelected = function() {
        this.selectedDot && (this.selectedDot.className = "dot"), this.dots.length && (this.selectedDot = this.dots[this.parent.selectedIndex], 
        this.selectedDot.className = "dot is-selected");
    }, s.prototype.onTap = function(t) {
        var e = t.target;
        if ("LI" == e.nodeName) {
            this.parent.uiChange();
            var i = this.dots.indexOf(e);
            this.parent.select(i);
        }
    }, s.prototype.destroy = function() {
        this.deactivate();
    }, e.PageDots = s, n.extend(e.defaults, {
        pageDots: !0
    }), e.createMethods.push("_createPageDots");
    var o = e.prototype;
    return o._createPageDots = function() {
        this.options.pageDots && (this.pageDots = new s(this), this.on("activate", this.activatePageDots), 
        this.on("select", this.updateSelectedPageDots), this.on("cellChange", this.updatePageDots), 
        this.on("resize", this.updatePageDots), this.on("deactivate", this.deactivatePageDots));
    }, o.activatePageDots = function() {
        this.pageDots.activate();
    }, o.updateSelectedPageDots = function() {
        this.pageDots.updateSelected();
    }, o.updatePageDots = function() {
        this.pageDots.setDots();
    }, o.deactivatePageDots = function() {
        this.pageDots.deactivate();
    }, e.PageDots = s, e;
}), function(t, e) {
    "function" == typeof define && define.amd ? define("flickity/js/player", [ "ev-emitter/ev-emitter", "fizzy-ui-utils/utils", "./flickity" ], function(t, i, n) {
        return e(t, i, n);
    }) : "object" == typeof module && module.exports ? module.exports = e(require("ev-emitter"), require("fizzy-ui-utils"), require("./flickity")) : e(t.EvEmitter, t.fizzyUIUtils, t.Flickity);
}(window, function(t, e, i) {
    function n(t) {
        this.parent = t, this.state = "stopped", o && (this.onVisibilityChange = function() {
            this.visibilityChange();
        }.bind(this), this.onVisibilityPlay = function() {
            this.visibilityPlay();
        }.bind(this));
    }
    var s, o;
    "hidden" in document ? (s = "hidden", o = "visibilitychange") : "webkitHidden" in document && (s = "webkitHidden", 
    o = "webkitvisibilitychange"), n.prototype = Object.create(t.prototype), n.prototype.play = function() {
        if ("playing" != this.state) {
            var t = document[s];
            if (o && t) return void document.addEventListener(o, this.onVisibilityPlay);
            this.state = "playing", o && document.addEventListener(o, this.onVisibilityChange), 
            this.tick();
        }
    }, n.prototype.tick = function() {
        if ("playing" == this.state) {
            var t = this.parent.options.autoPlay;
            t = "number" == typeof t ? t : 3e3;
            var e = this;
            this.clear(), this.timeout = setTimeout(function() {
                e.parent.next(!0), e.tick();
            }, t);
        }
    }, n.prototype.stop = function() {
        this.state = "stopped", this.clear(), o && document.removeEventListener(o, this.onVisibilityChange);
    }, n.prototype.clear = function() {
        clearTimeout(this.timeout);
    }, n.prototype.pause = function() {
        "playing" == this.state && (this.state = "paused", this.clear());
    }, n.prototype.unpause = function() {
        "paused" == this.state && this.play();
    }, n.prototype.visibilityChange = function() {
        var t = document[s];
        this[t ? "pause" : "unpause"]();
    }, n.prototype.visibilityPlay = function() {
        this.play(), document.removeEventListener(o, this.onVisibilityPlay);
    }, e.extend(i.defaults, {
        pauseAutoPlayOnHover: !0
    }), i.createMethods.push("_createPlayer");
    var r = i.prototype;
    return r._createPlayer = function() {
        this.player = new n(this), this.on("activate", this.activatePlayer), this.on("uiChange", this.stopPlayer), 
        this.on("pointerDown", this.stopPlayer), this.on("deactivate", this.deactivatePlayer);
    }, r.activatePlayer = function() {
        this.options.autoPlay && (this.player.play(), this.element.addEventListener("mouseenter", this));
    }, r.playPlayer = function() {
        this.player.play();
    }, r.stopPlayer = function() {
        this.player.stop();
    }, r.pausePlayer = function() {
        this.player.pause();
    }, r.unpausePlayer = function() {
        this.player.unpause();
    }, r.deactivatePlayer = function() {
        this.player.stop(), this.element.removeEventListener("mouseenter", this);
    }, r.onmouseenter = function() {
        this.options.pauseAutoPlayOnHover && (this.player.pause(), this.element.addEventListener("mouseleave", this));
    }, r.onmouseleave = function() {
        this.player.unpause(), this.element.removeEventListener("mouseleave", this);
    }, i.Player = n, i;
}), function(t, e) {
    "function" == typeof define && define.amd ? define("flickity/js/add-remove-cell", [ "./flickity", "fizzy-ui-utils/utils" ], function(i, n) {
        return e(t, i, n);
    }) : "object" == typeof module && module.exports ? module.exports = e(t, require("./flickity"), require("fizzy-ui-utils")) : e(t, t.Flickity, t.fizzyUIUtils);
}(window, function(t, e, i) {
    function n(t) {
        var e = document.createDocumentFragment();
        return t.forEach(function(t) {
            e.appendChild(t.element);
        }), e;
    }
    var s = e.prototype;
    return s.insert = function(t, e) {
        var i = this._makeCells(t);
        if (i && i.length) {
            var s = this.cells.length;
            e = void 0 === e ? s : e;
            var o = n(i), r = e == s;
            if (r) this.slider.appendChild(o); else {
                var a = this.cells[e].element;
                this.slider.insertBefore(o, a);
            }
            if (0 === e) this.cells = i.concat(this.cells); else if (r) this.cells = this.cells.concat(i); else {
                var h = this.cells.splice(e, s - e);
                this.cells = this.cells.concat(i).concat(h);
            }
            this._sizeCells(i);
            var l = e > this.selectedIndex ? 0 : i.length;
            this._cellAddedRemoved(e, l);
        }
    }, s.append = function(t) {
        this.insert(t, this.cells.length);
    }, s.prepend = function(t) {
        this.insert(t, 0);
    }, s.remove = function(t) {
        var e, n, s = this.getCells(t), o = 0, r = s.length;
        for (e = 0; e < r; e++) {
            n = s[e];
            var a = this.cells.indexOf(n) < this.selectedIndex;
            o -= a ? 1 : 0;
        }
        for (e = 0; e < r; e++) n = s[e], n.remove(), i.removeFrom(this.cells, n);
        s.length && this._cellAddedRemoved(0, o);
    }, s._cellAddedRemoved = function(t, e) {
        e = e || 0, this.selectedIndex += e, this.selectedIndex = Math.max(0, Math.min(this.slides.length - 1, this.selectedIndex)), 
        this.cellChange(t, !0), this.emitEvent("cellAddedRemoved", [ t, e ]);
    }, s.cellSizeChange = function(t) {
        var e = this.getCell(t);
        if (e) {
            e.getSize();
            var i = this.cells.indexOf(e);
            this.cellChange(i);
        }
    }, s.cellChange = function(t, e) {
        var i = this.slideableWidth;
        if (this._positionCells(t), this._getWrapShiftCells(), this.setGallerySize(), this.emitEvent("cellChange", [ t ]), 
        this.options.freeScroll) {
            var n = i - this.slideableWidth;
            this.x += n * this.cellAlign, this.positionSlider();
        } else e && this.positionSliderAtSelected(), this.select(this.selectedIndex);
    }, e;
}), function(t, e) {
    "function" == typeof define && define.amd ? define("flickity/js/lazyload", [ "./flickity", "fizzy-ui-utils/utils" ], function(i, n) {
        return e(t, i, n);
    }) : "object" == typeof module && module.exports ? module.exports = e(t, require("./flickity"), require("fizzy-ui-utils")) : e(t, t.Flickity, t.fizzyUIUtils);
}(window, function(t, e, i) {
    "use strict";
    function n(t) {
        if ("IMG" == t.nodeName && t.getAttribute("data-flickity-lazyload")) return [ t ];
        var e = t.querySelectorAll("img[data-flickity-lazyload]");
        return i.makeArray(e);
    }
    function s(t, e) {
        this.img = t, this.flickity = e, this.load();
    }
    e.createMethods.push("_createLazyload");
    var o = e.prototype;
    return o._createLazyload = function() {
        this.on("select", this.lazyLoad);
    }, o.lazyLoad = function() {
        var t = this.options.lazyLoad;
        if (t) {
            var e = "number" == typeof t ? t : 0, i = this.getAdjacentCellElements(e), o = [];
            i.forEach(function(t) {
                var e = n(t);
                o = o.concat(e);
            }), o.forEach(function(t) {
                new s(t, this);
            }, this);
        }
    }, s.prototype.handleEvent = i.handleEvent, s.prototype.load = function() {
        this.img.addEventListener("load", this), this.img.addEventListener("error", this), 
        this.img.src = this.img.getAttribute("data-flickity-lazyload"), this.img.removeAttribute("data-flickity-lazyload");
    }, s.prototype.onload = function(t) {
        this.complete(t, "flickity-lazyloaded");
    }, s.prototype.onerror = function(t) {
        this.complete(t, "flickity-lazyerror");
    }, s.prototype.complete = function(t, e) {
        this.img.removeEventListener("load", this), this.img.removeEventListener("error", this);
        var i = this.flickity.getParentCell(this.img), n = i && i.element;
        this.flickity.cellSizeChange(n), this.img.classList.add(e), this.flickity.dispatchEvent("lazyLoad", t, n);
    }, e.LazyLoader = s, e;
}), function(t, e) {
    "function" == typeof define && define.amd ? define("flickity/js/index", [ "./flickity", "./drag", "./prev-next-button", "./page-dots", "./player", "./add-remove-cell", "./lazyload" ], e) : "object" == typeof module && module.exports && (module.exports = e(require("./flickity"), require("./drag"), require("./prev-next-button"), require("./page-dots"), require("./player"), require("./add-remove-cell"), require("./lazyload")));
}(window, function(t) {
    return t;
}), function(t, e) {
    "function" == typeof define && define.amd ? define("flickity-as-nav-for/as-nav-for", [ "flickity/js/index", "fizzy-ui-utils/utils" ], e) : "object" == typeof module && module.exports ? module.exports = e(require("flickity"), require("fizzy-ui-utils")) : t.Flickity = e(t.Flickity, t.fizzyUIUtils);
}(window, function(t, e) {
    function i(t, e, i) {
        return (e - t) * i + t;
    }
    t.createMethods.push("_createAsNavFor");
    var n = t.prototype;
    return n._createAsNavFor = function() {
        this.on("activate", this.activateAsNavFor), this.on("deactivate", this.deactivateAsNavFor), 
        this.on("destroy", this.destroyAsNavFor);
        var t = this.options.asNavFor;
        if (t) {
            var e = this;
            setTimeout(function() {
                e.setNavCompanion(t);
            });
        }
    }, n.setNavCompanion = function(i) {
        i = e.getQueryElement(i);
        var n = t.data(i);
        if (n && n != this) {
            this.navCompanion = n;
            var s = this;
            this.onNavCompanionSelect = function() {
                s.navCompanionSelect();
            }, n.on("select", this.onNavCompanionSelect), this.on("staticClick", this.onNavStaticClick), 
            this.navCompanionSelect(!0);
        }
    }, n.navCompanionSelect = function(t) {
        if (this.navCompanion) {
            var e = this.navCompanion.selectedCells[0], n = this.navCompanion.cells.indexOf(e), s = n + this.navCompanion.selectedCells.length - 1, o = Math.floor(i(n, s, this.navCompanion.cellAlign));
            if (this.selectCell(o, !1, t), this.removeNavSelectedElements(), !(o >= this.cells.length)) {
                var r = this.cells.slice(n, s + 1);
                this.navSelectedElements = r.map(function(t) {
                    return t.element;
                }), this.changeNavSelectedClass("add");
            }
        }
    }, n.changeNavSelectedClass = function(t) {
        this.navSelectedElements.forEach(function(e) {
            e.classList[t]("is-nav-selected");
        });
    }, n.activateAsNavFor = function() {
        this.navCompanionSelect(!0);
    }, n.removeNavSelectedElements = function() {
        this.navSelectedElements && (this.changeNavSelectedClass("remove"), delete this.navSelectedElements);
    }, n.onNavStaticClick = function(t, e, i, n) {
        "number" == typeof n && this.navCompanion.selectCell(n);
    }, n.deactivateAsNavFor = function() {
        this.removeNavSelectedElements();
    }, n.destroyAsNavFor = function() {
        this.navCompanion && (this.navCompanion.off("select", this.onNavCompanionSelect), 
        this.off("staticClick", this.onNavStaticClick), delete this.navCompanion);
    }, t;
}), function(t, e) {
    "use strict";
    "function" == typeof define && define.amd ? define("imagesloaded/imagesloaded", [ "ev-emitter/ev-emitter" ], function(i) {
        return e(t, i);
    }) : "object" == typeof module && module.exports ? module.exports = e(t, require("ev-emitter")) : t.imagesLoaded = e(t, t.EvEmitter);
}("undefined" != typeof window ? window : this, function(t, e) {
    function i(t, e) {
        for (var i in e) t[i] = e[i];
        return t;
    }
    function n(t) {
        var e = [];
        if (Array.isArray(t)) e = t; else if ("number" == typeof t.length) for (var i = 0; i < t.length; i++) e.push(t[i]); else e.push(t);
        return e;
    }
    function s(t, e, o) {
        return this instanceof s ? ("string" == typeof t && (t = document.querySelectorAll(t)), 
        this.elements = n(t), this.options = i({}, this.options), "function" == typeof e ? o = e : i(this.options, e), 
        o && this.on("always", o), this.getImages(), a && (this.jqDeferred = new a.Deferred()), 
        void setTimeout(function() {
            this.check();
        }.bind(this))) : new s(t, e, o);
    }
    function o(t) {
        this.img = t;
    }
    function r(t, e) {
        this.url = t, this.element = e, this.img = new Image();
    }
    var a = t.jQuery, h = t.console;
    s.prototype = Object.create(e.prototype), s.prototype.options = {}, s.prototype.getImages = function() {
        this.images = [], this.elements.forEach(this.addElementImages, this);
    }, s.prototype.addElementImages = function(t) {
        "IMG" == t.nodeName && this.addImage(t), this.options.background === !0 && this.addElementBackgroundImages(t);
        var e = t.nodeType;
        if (e && l[e]) {
            for (var i = t.querySelectorAll("img"), n = 0; n < i.length; n++) {
                var s = i[n];
                this.addImage(s);
            }
            if ("string" == typeof this.options.background) {
                var o = t.querySelectorAll(this.options.background);
                for (n = 0; n < o.length; n++) {
                    var r = o[n];
                    this.addElementBackgroundImages(r);
                }
            }
        }
    };
    var l = {
        1: !0,
        9: !0,
        11: !0
    };
    return s.prototype.addElementBackgroundImages = function(t) {
        var e = getComputedStyle(t);
        if (e) for (var i = /url\((['"])?(.*?)\1\)/gi, n = i.exec(e.backgroundImage); null !== n; ) {
            var s = n && n[2];
            s && this.addBackground(s, t), n = i.exec(e.backgroundImage);
        }
    }, s.prototype.addImage = function(t) {
        var e = new o(t);
        this.images.push(e);
    }, s.prototype.addBackground = function(t, e) {
        var i = new r(t, e);
        this.images.push(i);
    }, s.prototype.check = function() {
        function t(t, i, n) {
            setTimeout(function() {
                e.progress(t, i, n);
            });
        }
        var e = this;
        return this.progressedCount = 0, this.hasAnyBroken = !1, this.images.length ? void this.images.forEach(function(e) {
            e.once("progress", t), e.check();
        }) : void this.complete();
    }, s.prototype.progress = function(t, e, i) {
        this.progressedCount++, this.hasAnyBroken = this.hasAnyBroken || !t.isLoaded, this.emitEvent("progress", [ this, t, e ]), 
        this.jqDeferred && this.jqDeferred.notify && this.jqDeferred.notify(this, t), this.progressedCount == this.images.length && this.complete(), 
        this.options.debug && h && h.log("progress: " + i, t, e);
    }, s.prototype.complete = function() {
        var t = this.hasAnyBroken ? "fail" : "done";
        if (this.isComplete = !0, this.emitEvent(t, [ this ]), this.emitEvent("always", [ this ]), 
        this.jqDeferred) {
            var e = this.hasAnyBroken ? "reject" : "resolve";
            this.jqDeferred[e](this);
        }
    }, o.prototype = Object.create(e.prototype), o.prototype.check = function() {
        var t = this.getIsImageComplete();
        return t ? void this.confirm(0 !== this.img.naturalWidth, "naturalWidth") : (this.proxyImage = new Image(), 
        this.proxyImage.addEventListener("load", this), this.proxyImage.addEventListener("error", this), 
        this.img.addEventListener("load", this), this.img.addEventListener("error", this), 
        void (this.proxyImage.src = this.img.src));
    }, o.prototype.getIsImageComplete = function() {
        return this.img.complete && void 0 !== this.img.naturalWidth;
    }, o.prototype.confirm = function(t, e) {
        this.isLoaded = t, this.emitEvent("progress", [ this, this.img, e ]);
    }, o.prototype.handleEvent = function(t) {
        var e = "on" + t.type;
        this[e] && this[e](t);
    }, o.prototype.onload = function() {
        this.confirm(!0, "onload"), this.unbindEvents();
    }, o.prototype.onerror = function() {
        this.confirm(!1, "onerror"), this.unbindEvents();
    }, o.prototype.unbindEvents = function() {
        this.proxyImage.removeEventListener("load", this), this.proxyImage.removeEventListener("error", this), 
        this.img.removeEventListener("load", this), this.img.removeEventListener("error", this);
    }, r.prototype = Object.create(o.prototype), r.prototype.check = function() {
        this.img.addEventListener("load", this), this.img.addEventListener("error", this), 
        this.img.src = this.url;
        var t = this.getIsImageComplete();
        t && (this.confirm(0 !== this.img.naturalWidth, "naturalWidth"), this.unbindEvents());
    }, r.prototype.unbindEvents = function() {
        this.img.removeEventListener("load", this), this.img.removeEventListener("error", this);
    }, r.prototype.confirm = function(t, e) {
        this.isLoaded = t, this.emitEvent("progress", [ this, this.element, e ]);
    }, s.makeJQueryPlugin = function(e) {
        e = e || t.jQuery, e && (a = e, a.fn.imagesLoaded = function(t, e) {
            var i = new s(this, t, e);
            return i.jqDeferred.promise(a(this));
        });
    }, s.makeJQueryPlugin(), s;
}), function(t, e) {
    "function" == typeof define && define.amd ? define([ "flickity/js/index", "imagesloaded/imagesloaded" ], function(i, n) {
        return e(t, i, n);
    }) : "object" == typeof module && module.exports ? module.exports = e(t, require("flickity"), require("imagesloaded")) : t.Flickity = e(t, t.Flickity, t.imagesLoaded);
}(window, function(t, e, i) {
    "use strict";
    e.createMethods.push("_createImagesLoaded");
    var n = e.prototype;
    return n._createImagesLoaded = function() {
        this.on("activate", this.imagesLoaded);
    }, n.imagesLoaded = function() {
        function t(t, i) {
            var n = e.getParentCell(i.img);
            e.cellSizeChange(n && n.element), e.options.freeScroll || e.positionSliderAtSelected();
        }
        if (this.options.imagesLoaded) {
            var e = this;
            i(this.slider).on("progress", t);
        }
    }, e;
});

!function(t, e) {
    "function" == typeof define && define.amd ? define("jquery-bridget/jquery-bridget", [ "jquery" ], function(i) {
        return e(t, i);
    }) : "object" == typeof module && module.exports ? module.exports = e(t, require("jquery")) : t.jQueryBridget = e(t, t.jQuery);
}(window, function(t, e) {
    "use strict";
    function i(i, s, a) {
        function u(t, e, n) {
            var o, s = "$()." + i + '("' + e + '")';
            return t.each(function(t, u) {
                var h = a.data(u, i);
                if (!h) return void r(i + " not initialized. Cannot call methods, i.e. " + s);
                var d = h[e];
                if (!d || "_" == e.charAt(0)) return void r(s + " is not a valid method");
                var l = d.apply(h, n);
                o = void 0 === o ? l : o;
            }), void 0 !== o ? o : t;
        }
        function h(t, e) {
            t.each(function(t, n) {
                var o = a.data(n, i);
                o ? (o.option(e), o._init()) : (o = new s(n, e), a.data(n, i, o));
            });
        }
        a = a || e || t.jQuery, a && (s.prototype.option || (s.prototype.option = function(t) {
            a.isPlainObject(t) && (this.options = a.extend(!0, this.options, t));
        }), a.fn[i] = function(t) {
            if ("string" == typeof t) {
                var e = o.call(arguments, 1);
                return u(this, t, e);
            }
            return h(this, t), this;
        }, n(a));
    }
    function n(t) {
        !t || t && t.bridget || (t.bridget = i);
    }
    var o = Array.prototype.slice, s = t.console, r = "undefined" == typeof s ? function() {} : function(t) {
        s.error(t);
    };
    return n(e || t.jQuery), i;
}), function(t, e) {
    "function" == typeof define && define.amd ? define("ev-emitter/ev-emitter", e) : "object" == typeof module && module.exports ? module.exports = e() : t.EvEmitter = e();
}("undefined" != typeof window ? window : this, function() {
    function t() {}
    var e = t.prototype;
    return e.on = function(t, e) {
        if (t && e) {
            var i = this._events = this._events || {}, n = i[t] = i[t] || [];
            return n.indexOf(e) == -1 && n.push(e), this;
        }
    }, e.once = function(t, e) {
        if (t && e) {
            this.on(t, e);
            var i = this._onceEvents = this._onceEvents || {}, n = i[t] = i[t] || {};
            return n[e] = !0, this;
        }
    }, e.off = function(t, e) {
        var i = this._events && this._events[t];
        if (i && i.length) {
            var n = i.indexOf(e);
            return n != -1 && i.splice(n, 1), this;
        }
    }, e.emitEvent = function(t, e) {
        var i = this._events && this._events[t];
        if (i && i.length) {
            var n = 0, o = i[n];
            e = e || [];
            for (var s = this._onceEvents && this._onceEvents[t]; o; ) {
                var r = s && s[o];
                r && (this.off(t, o), delete s[o]), o.apply(this, e), n += r ? 0 : 1, o = i[n];
            }
            return this;
        }
    }, t;
}), function(t, e) {
    "use strict";
    "function" == typeof define && define.amd ? define("get-size/get-size", [], function() {
        return e();
    }) : "object" == typeof module && module.exports ? module.exports = e() : t.getSize = e();
}(window, function() {
    "use strict";
    function t(t) {
        var e = parseFloat(t), i = t.indexOf("%") == -1 && !isNaN(e);
        return i && e;
    }
    function e() {}
    function i() {
        for (var t = {
            width: 0,
            height: 0,
            innerWidth: 0,
            innerHeight: 0,
            outerWidth: 0,
            outerHeight: 0
        }, e = 0; e < h; e++) {
            var i = u[e];
            t[i] = 0;
        }
        return t;
    }
    function n(t) {
        var e = getComputedStyle(t);
        return e || a("Style returned " + e + ". Are you running this code in a hidden iframe on Firefox? See http://bit.ly/getsizebug1"), 
        e;
    }
    function o() {
        if (!d) {
            d = !0;
            var e = document.createElement("div");
            e.style.width = "200px", e.style.padding = "1px 2px 3px 4px", e.style.borderStyle = "solid", 
            e.style.borderWidth = "1px 2px 3px 4px", e.style.boxSizing = "border-box";
            var i = document.body || document.documentElement;
            i.appendChild(e);
            var o = n(e);
            s.isBoxSizeOuter = r = 200 == t(o.width), i.removeChild(e);
        }
    }
    function s(e) {
        if (o(), "string" == typeof e && (e = document.querySelector(e)), e && "object" == typeof e && e.nodeType) {
            var s = n(e);
            if ("none" == s.display) return i();
            var a = {};
            a.width = e.offsetWidth, a.height = e.offsetHeight;
            for (var d = a.isBorderBox = "border-box" == s.boxSizing, l = 0; l < h; l++) {
                var f = u[l], c = s[f], m = parseFloat(c);
                a[f] = isNaN(m) ? 0 : m;
            }
            var p = a.paddingLeft + a.paddingRight, y = a.paddingTop + a.paddingBottom, g = a.marginLeft + a.marginRight, v = a.marginTop + a.marginBottom, _ = a.borderLeftWidth + a.borderRightWidth, I = a.borderTopWidth + a.borderBottomWidth, z = d && r, x = t(s.width);
            x !== !1 && (a.width = x + (z ? 0 : p + _));
            var S = t(s.height);
            return S !== !1 && (a.height = S + (z ? 0 : y + I)), a.innerWidth = a.width - (p + _), 
            a.innerHeight = a.height - (y + I), a.outerWidth = a.width + g, a.outerHeight = a.height + v, 
            a;
        }
    }
    var r, a = "undefined" == typeof console ? e : function(t) {
        console.error(t);
    }, u = [ "paddingLeft", "paddingRight", "paddingTop", "paddingBottom", "marginLeft", "marginRight", "marginTop", "marginBottom", "borderLeftWidth", "borderRightWidth", "borderTopWidth", "borderBottomWidth" ], h = u.length, d = !1;
    return s;
}), function(t, e) {
    "use strict";
    "function" == typeof define && define.amd ? define("desandro-matches-selector/matches-selector", e) : "object" == typeof module && module.exports ? module.exports = e() : t.matchesSelector = e();
}(window, function() {
    "use strict";
    var t = function() {
        var t = Element.prototype;
        if (t.matches) return "matches";
        if (t.matchesSelector) return "matchesSelector";
        for (var e = [ "webkit", "moz", "ms", "o" ], i = 0; i < e.length; i++) {
            var n = e[i], o = n + "MatchesSelector";
            if (t[o]) return o;
        }
    }();
    return function(e, i) {
        return e[t](i);
    };
}), function(t, e) {
    "function" == typeof define && define.amd ? define("fizzy-ui-utils/utils", [ "desandro-matches-selector/matches-selector" ], function(i) {
        return e(t, i);
    }) : "object" == typeof module && module.exports ? module.exports = e(t, require("desandro-matches-selector")) : t.fizzyUIUtils = e(t, t.matchesSelector);
}(window, function(t, e) {
    var i = {};
    i.extend = function(t, e) {
        for (var i in e) t[i] = e[i];
        return t;
    }, i.modulo = function(t, e) {
        return (t % e + e) % e;
    }, i.makeArray = function(t) {
        var e = [];
        if (Array.isArray(t)) e = t; else if (t && "number" == typeof t.length) for (var i = 0; i < t.length; i++) e.push(t[i]); else e.push(t);
        return e;
    }, i.removeFrom = function(t, e) {
        var i = t.indexOf(e);
        i != -1 && t.splice(i, 1);
    }, i.getParent = function(t, i) {
        for (;t != document.body; ) if (t = t.parentNode, e(t, i)) return t;
    }, i.getQueryElement = function(t) {
        return "string" == typeof t ? document.querySelector(t) : t;
    }, i.handleEvent = function(t) {
        var e = "on" + t.type;
        this[e] && this[e](t);
    }, i.filterFindElements = function(t, n) {
        t = i.makeArray(t);
        var o = [];
        return t.forEach(function(t) {
            if (t instanceof HTMLElement) {
                if (!n) return void o.push(t);
                e(t, n) && o.push(t);
                for (var i = t.querySelectorAll(n), s = 0; s < i.length; s++) o.push(i[s]);
            }
        }), o;
    }, i.debounceMethod = function(t, e, i) {
        var n = t.prototype[e], o = e + "Timeout";
        t.prototype[e] = function() {
            var t = this[o];
            t && clearTimeout(t);
            var e = arguments, s = this;
            this[o] = setTimeout(function() {
                n.apply(s, e), delete s[o];
            }, i || 100);
        };
    }, i.docReady = function(t) {
        var e = document.readyState;
        "complete" == e || "interactive" == e ? setTimeout(t) : document.addEventListener("DOMContentLoaded", t);
    }, i.toDashed = function(t) {
        return t.replace(/(.)([A-Z])/g, function(t, e, i) {
            return e + "-" + i;
        }).toLowerCase();
    };
    var n = t.console;
    return i.htmlInit = function(e, o) {
        i.docReady(function() {
            var s = i.toDashed(o), r = "data-" + s, a = document.querySelectorAll("[" + r + "]"), u = document.querySelectorAll(".js-" + s), h = i.makeArray(a).concat(i.makeArray(u)), d = r + "-options", l = t.jQuery;
            h.forEach(function(t) {
                var i, s = t.getAttribute(r) || t.getAttribute(d);
                try {
                    i = s && JSON.parse(s);
                } catch (a) {
                    return void (n && n.error("Error parsing " + r + " on " + t.className + ": " + a));
                }
                var u = new e(t, i);
                l && l.data(t, o, u);
            });
        });
    }, i;
}), function(t, e) {
    "function" == typeof define && define.amd ? define("outlayer/item", [ "ev-emitter/ev-emitter", "get-size/get-size" ], e) : "object" == typeof module && module.exports ? module.exports = e(require("ev-emitter"), require("get-size")) : (t.Outlayer = {}, 
    t.Outlayer.Item = e(t.EvEmitter, t.getSize));
}(window, function(t, e) {
    "use strict";
    function i(t) {
        for (var e in t) return !1;
        return e = null, !0;
    }
    function n(t, e) {
        t && (this.element = t, this.layout = e, this.position = {
            x: 0,
            y: 0
        }, this._create());
    }
    function o(t) {
        return t.replace(/([A-Z])/g, function(t) {
            return "-" + t.toLowerCase();
        });
    }
    var s = document.documentElement.style, r = "string" == typeof s.transition ? "transition" : "WebkitTransition", a = "string" == typeof s.transform ? "transform" : "WebkitTransform", u = {
        WebkitTransition: "webkitTransitionEnd",
        transition: "transitionend"
    }[r], h = {
        transform: a,
        transition: r,
        transitionDuration: r + "Duration",
        transitionProperty: r + "Property",
        transitionDelay: r + "Delay"
    }, d = n.prototype = Object.create(t.prototype);
    d.constructor = n, d._create = function() {
        this._transn = {
            ingProperties: {},
            clean: {},
            onEnd: {}
        }, this.css({
            position: "absolute"
        });
    }, d.handleEvent = function(t) {
        var e = "on" + t.type;
        this[e] && this[e](t);
    }, d.getSize = function() {
        this.size = e(this.element);
    }, d.css = function(t) {
        var e = this.element.style;
        for (var i in t) {
            var n = h[i] || i;
            e[n] = t[i];
        }
    }, d.getPosition = function() {
        var t = getComputedStyle(this.element), e = this.layout._getOption("originLeft"), i = this.layout._getOption("originTop"), n = t[e ? "left" : "right"], o = t[i ? "top" : "bottom"], s = this.layout.size, r = n.indexOf("%") != -1 ? parseFloat(n) / 100 * s.width : parseInt(n, 10), a = o.indexOf("%") != -1 ? parseFloat(o) / 100 * s.height : parseInt(o, 10);
        r = isNaN(r) ? 0 : r, a = isNaN(a) ? 0 : a, r -= e ? s.paddingLeft : s.paddingRight, 
        a -= i ? s.paddingTop : s.paddingBottom, this.position.x = r, this.position.y = a;
    }, d.layoutPosition = function() {
        var t = this.layout.size, e = {}, i = this.layout._getOption("originLeft"), n = this.layout._getOption("originTop"), o = i ? "paddingLeft" : "paddingRight", s = i ? "left" : "right", r = i ? "right" : "left", a = this.position.x + t[o];
        e[s] = this.getXValue(a), e[r] = "";
        var u = n ? "paddingTop" : "paddingBottom", h = n ? "top" : "bottom", d = n ? "bottom" : "top", l = this.position.y + t[u];
        e[h] = this.getYValue(l), e[d] = "", this.css(e), this.emitEvent("layout", [ this ]);
    }, d.getXValue = function(t) {
        var e = this.layout._getOption("horizontal");
        return this.layout.options.percentPosition && !e ? t / this.layout.size.width * 100 + "%" : t + "px";
    }, d.getYValue = function(t) {
        var e = this.layout._getOption("horizontal");
        return this.layout.options.percentPosition && e ? t / this.layout.size.height * 100 + "%" : t + "px";
    }, d._transitionTo = function(t, e) {
        this.getPosition();
        var i = this.position.x, n = this.position.y, o = parseInt(t, 10), s = parseInt(e, 10), r = o === this.position.x && s === this.position.y;
        if (this.setPosition(t, e), r && !this.isTransitioning) return void this.layoutPosition();
        var a = t - i, u = e - n, h = {};
        h.transform = this.getTranslate(a, u), this.transition({
            to: h,
            onTransitionEnd: {
                transform: this.layoutPosition
            },
            isCleaning: !0
        });
    }, d.getTranslate = function(t, e) {
        var i = this.layout._getOption("originLeft"), n = this.layout._getOption("originTop");
        return t = i ? t : -t, e = n ? e : -e, "translate3d(" + t + "px, " + e + "px, 0)";
    }, d.goTo = function(t, e) {
        this.setPosition(t, e), this.layoutPosition();
    }, d.moveTo = d._transitionTo, d.setPosition = function(t, e) {
        this.position.x = parseInt(t, 10), this.position.y = parseInt(e, 10);
    }, d._nonTransition = function(t) {
        this.css(t.to), t.isCleaning && this._removeStyles(t.to);
        for (var e in t.onTransitionEnd) t.onTransitionEnd[e].call(this);
    }, d.transition = function(t) {
        if (!parseFloat(this.layout.options.transitionDuration)) return void this._nonTransition(t);
        var e = this._transn;
        for (var i in t.onTransitionEnd) e.onEnd[i] = t.onTransitionEnd[i];
        for (i in t.to) e.ingProperties[i] = !0, t.isCleaning && (e.clean[i] = !0);
        if (t.from) {
            this.css(t.from);
            var n = this.element.offsetHeight;
            n = null;
        }
        this.enableTransition(t.to), this.css(t.to), this.isTransitioning = !0;
    };
    var l = "opacity," + o(a);
    d.enableTransition = function() {
        if (!this.isTransitioning) {
            var t = this.layout.options.transitionDuration;
            t = "number" == typeof t ? t + "ms" : t, this.css({
                transitionProperty: l,
                transitionDuration: t,
                transitionDelay: this.staggerDelay || 0
            }), this.element.addEventListener(u, this, !1);
        }
    }, d.onwebkitTransitionEnd = function(t) {
        this.ontransitionend(t);
    }, d.onotransitionend = function(t) {
        this.ontransitionend(t);
    };
    var f = {
        "-webkit-transform": "transform"
    };
    d.ontransitionend = function(t) {
        if (t.target === this.element) {
            var e = this._transn, n = f[t.propertyName] || t.propertyName;
            if (delete e.ingProperties[n], i(e.ingProperties) && this.disableTransition(), n in e.clean && (this.element.style[t.propertyName] = "", 
            delete e.clean[n]), n in e.onEnd) {
                var o = e.onEnd[n];
                o.call(this), delete e.onEnd[n];
            }
            this.emitEvent("transitionEnd", [ this ]);
        }
    }, d.disableTransition = function() {
        this.removeTransitionStyles(), this.element.removeEventListener(u, this, !1), this.isTransitioning = !1;
    }, d._removeStyles = function(t) {
        var e = {};
        for (var i in t) e[i] = "";
        this.css(e);
    };
    var c = {
        transitionProperty: "",
        transitionDuration: "",
        transitionDelay: ""
    };
    return d.removeTransitionStyles = function() {
        this.css(c);
    }, d.stagger = function(t) {
        t = isNaN(t) ? 0 : t, this.staggerDelay = t + "ms";
    }, d.removeElem = function() {
        this.element.parentNode.removeChild(this.element), this.css({
            display: ""
        }), this.emitEvent("remove", [ this ]);
    }, d.remove = function() {
        return r && parseFloat(this.layout.options.transitionDuration) ? (this.once("transitionEnd", function() {
            this.removeElem();
        }), void this.hide()) : void this.removeElem();
    }, d.reveal = function() {
        delete this.isHidden, this.css({
            display: ""
        });
        var t = this.layout.options, e = {}, i = this.getHideRevealTransitionEndProperty("visibleStyle");
        e[i] = this.onRevealTransitionEnd, this.transition({
            from: t.hiddenStyle,
            to: t.visibleStyle,
            isCleaning: !0,
            onTransitionEnd: e
        });
    }, d.onRevealTransitionEnd = function() {
        this.isHidden || this.emitEvent("reveal");
    }, d.getHideRevealTransitionEndProperty = function(t) {
        var e = this.layout.options[t];
        if (e.opacity) return "opacity";
        for (var i in e) return i;
    }, d.hide = function() {
        this.isHidden = !0, this.css({
            display: ""
        });
        var t = this.layout.options, e = {}, i = this.getHideRevealTransitionEndProperty("hiddenStyle");
        e[i] = this.onHideTransitionEnd, this.transition({
            from: t.visibleStyle,
            to: t.hiddenStyle,
            isCleaning: !0,
            onTransitionEnd: e
        });
    }, d.onHideTransitionEnd = function() {
        this.isHidden && (this.css({
            display: "none"
        }), this.emitEvent("hide"));
    }, d.destroy = function() {
        this.css({
            position: "",
            left: "",
            right: "",
            top: "",
            bottom: "",
            transition: "",
            transform: ""
        });
    }, n;
}), function(t, e) {
    "use strict";
    "function" == typeof define && define.amd ? define("outlayer/outlayer", [ "ev-emitter/ev-emitter", "get-size/get-size", "fizzy-ui-utils/utils", "./item" ], function(i, n, o, s) {
        return e(t, i, n, o, s);
    }) : "object" == typeof module && module.exports ? module.exports = e(t, require("ev-emitter"), require("get-size"), require("fizzy-ui-utils"), require("./item")) : t.Outlayer = e(t, t.EvEmitter, t.getSize, t.fizzyUIUtils, t.Outlayer.Item);
}(window, function(t, e, i, n, o) {
    "use strict";
    function s(t, e) {
        var i = n.getQueryElement(t);
        if (!i) return void (u && u.error("Bad element for " + this.constructor.namespace + ": " + (i || t)));
        this.element = i, h && (this.$element = h(this.element)), this.options = n.extend({}, this.constructor.defaults), 
        this.option(e);
        var o = ++l;
        this.element.outlayerGUID = o, f[o] = this, this._create();
        var s = this._getOption("initLayout");
        s && this.layout();
    }
    function r(t) {
        function e() {
            t.apply(this, arguments);
        }
        return e.prototype = Object.create(t.prototype), e.prototype.constructor = e, e;
    }
    function a(t) {
        if ("number" == typeof t) return t;
        var e = t.match(/(^\d*\.?\d*)(\w*)/), i = e && e[1], n = e && e[2];
        if (!i.length) return 0;
        i = parseFloat(i);
        var o = m[n] || 1;
        return i * o;
    }
    var u = t.console, h = t.jQuery, d = function() {}, l = 0, f = {};
    s.namespace = "outlayer", s.Item = o, s.defaults = {
        containerStyle: {
            position: "relative"
        },
        initLayout: !0,
        originLeft: !0,
        originTop: !0,
        resize: !0,
        resizeContainer: !0,
        transitionDuration: "0.4s",
        hiddenStyle: {
            opacity: 0,
            transform: "scale(0.001)"
        },
        visibleStyle: {
            opacity: 1,
            transform: "scale(1)"
        }
    };
    var c = s.prototype;
    n.extend(c, e.prototype), c.option = function(t) {
        n.extend(this.options, t);
    }, c._getOption = function(t) {
        var e = this.constructor.compatOptions[t];
        return e && void 0 !== this.options[e] ? this.options[e] : this.options[t];
    }, s.compatOptions = {
        initLayout: "isInitLayout",
        horizontal: "isHorizontal",
        layoutInstant: "isLayoutInstant",
        originLeft: "isOriginLeft",
        originTop: "isOriginTop",
        resize: "isResizeBound",
        resizeContainer: "isResizingContainer"
    }, c._create = function() {
        this.reloadItems(), this.stamps = [], this.stamp(this.options.stamp), n.extend(this.element.style, this.options.containerStyle);
        var t = this._getOption("resize");
        t && this.bindResize();
    }, c.reloadItems = function() {
        this.items = this._itemize(this.element.children);
    }, c._itemize = function(t) {
        for (var e = this._filterFindItemElements(t), i = this.constructor.Item, n = [], o = 0; o < e.length; o++) {
            var s = e[o], r = new i(s, this);
            n.push(r);
        }
        return n;
    }, c._filterFindItemElements = function(t) {
        return n.filterFindElements(t, this.options.itemSelector);
    }, c.getItemElements = function() {
        return this.items.map(function(t) {
            return t.element;
        });
    }, c.layout = function() {
        this._resetLayout(), this._manageStamps();
        var t = this._getOption("layoutInstant"), e = void 0 !== t ? t : !this._isLayoutInited;
        this.layoutItems(this.items, e), this._isLayoutInited = !0;
    }, c._init = c.layout, c._resetLayout = function() {
        this.getSize();
    }, c.getSize = function() {
        this.size = i(this.element);
    }, c._getMeasurement = function(t, e) {
        var n, o = this.options[t];
        o ? ("string" == typeof o ? n = this.element.querySelector(o) : o instanceof HTMLElement && (n = o), 
        this[t] = n ? i(n)[e] : o) : this[t] = 0;
    }, c.layoutItems = function(t, e) {
        t = this._getItemsForLayout(t), this._layoutItems(t, e), this._postLayout();
    }, c._getItemsForLayout = function(t) {
        return t.filter(function(t) {
            return !t.isIgnored;
        });
    }, c._layoutItems = function(t, e) {
        if (this._emitCompleteOnItems("layout", t), t && t.length) {
            var i = [];
            t.forEach(function(t) {
                var n = this._getItemLayoutPosition(t);
                n.item = t, n.isInstant = e || t.isLayoutInstant, i.push(n);
            }, this), this._processLayoutQueue(i);
        }
    }, c._getItemLayoutPosition = function() {
        return {
            x: 0,
            y: 0
        };
    }, c._processLayoutQueue = function(t) {
        this.updateStagger(), t.forEach(function(t, e) {
            this._positionItem(t.item, t.x, t.y, t.isInstant, e);
        }, this);
    }, c.updateStagger = function() {
        var t = this.options.stagger;
        return null === t || void 0 === t ? void (this.stagger = 0) : (this.stagger = a(t), 
        this.stagger);
    }, c._positionItem = function(t, e, i, n, o) {
        n ? t.goTo(e, i) : (t.stagger(o * this.stagger), t.moveTo(e, i));
    }, c._postLayout = function() {
        this.resizeContainer();
    }, c.resizeContainer = function() {
        var t = this._getOption("resizeContainer");
        if (t) {
            var e = this._getContainerSize();
            e && (this._setContainerMeasure(e.width, !0), this._setContainerMeasure(e.height, !1));
        }
    }, c._getContainerSize = d, c._setContainerMeasure = function(t, e) {
        if (void 0 !== t) {
            var i = this.size;
            i.isBorderBox && (t += e ? i.paddingLeft + i.paddingRight + i.borderLeftWidth + i.borderRightWidth : i.paddingBottom + i.paddingTop + i.borderTopWidth + i.borderBottomWidth), 
            t = Math.max(t, 0), this.element.style[e ? "width" : "height"] = t + "px";
        }
    }, c._emitCompleteOnItems = function(t, e) {
        function i() {
            o.dispatchEvent(t + "Complete", null, [ e ]);
        }
        function n() {
            r++, r == s && i();
        }
        var o = this, s = e.length;
        if (!e || !s) return void i();
        var r = 0;
        e.forEach(function(e) {
            e.once(t, n);
        });
    }, c.dispatchEvent = function(t, e, i) {
        var n = e ? [ e ].concat(i) : i;
        if (this.emitEvent(t, n), h) if (this.$element = this.$element || h(this.element), 
        e) {
            var o = h.Event(e);
            o.type = t, this.$element.trigger(o, i);
        } else this.$element.trigger(t, i);
    }, c.ignore = function(t) {
        var e = this.getItem(t);
        e && (e.isIgnored = !0);
    }, c.unignore = function(t) {
        var e = this.getItem(t);
        e && delete e.isIgnored;
    }, c.stamp = function(t) {
        t = this._find(t), t && (this.stamps = this.stamps.concat(t), t.forEach(this.ignore, this));
    }, c.unstamp = function(t) {
        t = this._find(t), t && t.forEach(function(t) {
            n.removeFrom(this.stamps, t), this.unignore(t);
        }, this);
    }, c._find = function(t) {
        if (t) return "string" == typeof t && (t = this.element.querySelectorAll(t)), t = n.makeArray(t);
    }, c._manageStamps = function() {
        this.stamps && this.stamps.length && (this._getBoundingRect(), this.stamps.forEach(this._manageStamp, this));
    }, c._getBoundingRect = function() {
        var t = this.element.getBoundingClientRect(), e = this.size;
        this._boundingRect = {
            left: t.left + e.paddingLeft + e.borderLeftWidth,
            top: t.top + e.paddingTop + e.borderTopWidth,
            right: t.right - (e.paddingRight + e.borderRightWidth),
            bottom: t.bottom - (e.paddingBottom + e.borderBottomWidth)
        };
    }, c._manageStamp = d, c._getElementOffset = function(t) {
        var e = t.getBoundingClientRect(), n = this._boundingRect, o = i(t), s = {
            left: e.left - n.left - o.marginLeft,
            top: e.top - n.top - o.marginTop,
            right: n.right - e.right - o.marginRight,
            bottom: n.bottom - e.bottom - o.marginBottom
        };
        return s;
    }, c.handleEvent = n.handleEvent, c.bindResize = function() {
        t.addEventListener("resize", this), this.isResizeBound = !0;
    }, c.unbindResize = function() {
        t.removeEventListener("resize", this), this.isResizeBound = !1;
    }, c.onresize = function() {
        this.resize();
    }, n.debounceMethod(s, "onresize", 100), c.resize = function() {
        this.isResizeBound && this.needsResizeLayout() && this.layout();
    }, c.needsResizeLayout = function() {
        var t = i(this.element), e = this.size && t;
        return e && t.innerWidth !== this.size.innerWidth;
    }, c.addItems = function(t) {
        var e = this._itemize(t);
        return e.length && (this.items = this.items.concat(e)), e;
    }, c.appended = function(t) {
        var e = this.addItems(t);
        e.length && (this.layoutItems(e, !0), this.reveal(e));
    }, c.prepended = function(t) {
        var e = this._itemize(t);
        if (e.length) {
            var i = this.items.slice(0);
            this.items = e.concat(i), this._resetLayout(), this._manageStamps(), this.layoutItems(e, !0), 
            this.reveal(e), this.layoutItems(i);
        }
    }, c.reveal = function(t) {
        if (this._emitCompleteOnItems("reveal", t), t && t.length) {
            var e = this.updateStagger();
            t.forEach(function(t, i) {
                t.stagger(i * e), t.reveal();
            });
        }
    }, c.hide = function(t) {
        if (this._emitCompleteOnItems("hide", t), t && t.length) {
            var e = this.updateStagger();
            t.forEach(function(t, i) {
                t.stagger(i * e), t.hide();
            });
        }
    }, c.revealItemElements = function(t) {
        var e = this.getItems(t);
        this.reveal(e);
    }, c.hideItemElements = function(t) {
        var e = this.getItems(t);
        this.hide(e);
    }, c.getItem = function(t) {
        for (var e = 0; e < this.items.length; e++) {
            var i = this.items[e];
            if (i.element == t) return i;
        }
    }, c.getItems = function(t) {
        t = n.makeArray(t);
        var e = [];
        return t.forEach(function(t) {
            var i = this.getItem(t);
            i && e.push(i);
        }, this), e;
    }, c.remove = function(t) {
        var e = this.getItems(t);
        this._emitCompleteOnItems("remove", e), e && e.length && e.forEach(function(t) {
            t.remove(), n.removeFrom(this.items, t);
        }, this);
    }, c.destroy = function() {
        var t = this.element.style;
        t.height = "", t.position = "", t.width = "", this.items.forEach(function(t) {
            t.destroy();
        }), this.unbindResize();
        var e = this.element.outlayerGUID;
        delete f[e], delete this.element.outlayerGUID, h && h.removeData(this.element, this.constructor.namespace);
    }, s.data = function(t) {
        t = n.getQueryElement(t);
        var e = t && t.outlayerGUID;
        return e && f[e];
    }, s.create = function(t, e) {
        var i = r(s);
        return i.defaults = n.extend({}, s.defaults), n.extend(i.defaults, e), i.compatOptions = n.extend({}, s.compatOptions), 
        i.namespace = t, i.data = s.data, i.Item = r(o), n.htmlInit(i, t), h && h.bridget && h.bridget(t, i), 
        i;
    };
    var m = {
        ms: 1,
        s: 1e3
    };
    return s.Item = o, s;
}), function(t, e) {
    "function" == typeof define && define.amd ? define("isotope/js/item", [ "outlayer/outlayer" ], e) : "object" == typeof module && module.exports ? module.exports = e(require("outlayer")) : (t.Isotope = t.Isotope || {}, 
    t.Isotope.Item = e(t.Outlayer));
}(window, function(t) {
    "use strict";
    function e() {
        t.Item.apply(this, arguments);
    }
    var i = e.prototype = Object.create(t.Item.prototype), n = i._create;
    i._create = function() {
        this.id = this.layout.itemGUID++, n.call(this), this.sortData = {};
    }, i.updateSortData = function() {
        if (!this.isIgnored) {
            this.sortData.id = this.id, this.sortData["original-order"] = this.id, this.sortData.random = Math.random();
            var t = this.layout.options.getSortData, e = this.layout._sorters;
            for (var i in t) {
                var n = e[i];
                this.sortData[i] = n(this.element, this);
            }
        }
    };
    var o = i.destroy;
    return i.destroy = function() {
        o.apply(this, arguments), this.css({
            display: ""
        });
    }, e;
}), function(t, e) {
    "function" == typeof define && define.amd ? define("isotope/js/layout-mode", [ "get-size/get-size", "outlayer/outlayer" ], e) : "object" == typeof module && module.exports ? module.exports = e(require("get-size"), require("outlayer")) : (t.Isotope = t.Isotope || {}, 
    t.Isotope.LayoutMode = e(t.getSize, t.Outlayer));
}(window, function(t, e) {
    "use strict";
    function i(t) {
        this.isotope = t, t && (this.options = t.options[this.namespace], this.element = t.element, 
        this.items = t.filteredItems, this.size = t.size);
    }
    var n = i.prototype, o = [ "_resetLayout", "_getItemLayoutPosition", "_manageStamp", "_getContainerSize", "_getElementOffset", "needsResizeLayout", "_getOption" ];
    return o.forEach(function(t) {
        n[t] = function() {
            return e.prototype[t].apply(this.isotope, arguments);
        };
    }), n.needsVerticalResizeLayout = function() {
        var e = t(this.isotope.element), i = this.isotope.size && e;
        return i && e.innerHeight != this.isotope.size.innerHeight;
    }, n._getMeasurement = function() {
        this.isotope._getMeasurement.apply(this, arguments);
    }, n.getColumnWidth = function() {
        this.getSegmentSize("column", "Width");
    }, n.getRowHeight = function() {
        this.getSegmentSize("row", "Height");
    }, n.getSegmentSize = function(t, e) {
        var i = t + e, n = "outer" + e;
        if (this._getMeasurement(i, n), !this[i]) {
            var o = this.getFirstItemSize();
            this[i] = o && o[n] || this.isotope.size["inner" + e];
        }
    }, n.getFirstItemSize = function() {
        var e = this.isotope.filteredItems[0];
        return e && e.element && t(e.element);
    }, n.layout = function() {
        this.isotope.layout.apply(this.isotope, arguments);
    }, n.getSize = function() {
        this.isotope.getSize(), this.size = this.isotope.size;
    }, i.modes = {}, i.create = function(t, e) {
        function o() {
            i.apply(this, arguments);
        }
        return o.prototype = Object.create(n), o.prototype.constructor = o, e && (o.options = e), 
        o.prototype.namespace = t, i.modes[t] = o, o;
    }, i;
}), function(t, e) {
    "function" == typeof define && define.amd ? define("masonry/masonry", [ "outlayer/outlayer", "get-size/get-size" ], e) : "object" == typeof module && module.exports ? module.exports = e(require("outlayer"), require("get-size")) : t.Masonry = e(t.Outlayer, t.getSize);
}(window, function(t, e) {
    var i = t.create("masonry");
    return i.compatOptions.fitWidth = "isFitWidth", i.prototype._resetLayout = function() {
        this.getSize(), this._getMeasurement("columnWidth", "outerWidth"), this._getMeasurement("gutter", "outerWidth"), 
        this.measureColumns(), this.colYs = [];
        for (var t = 0; t < this.cols; t++) this.colYs.push(0);
        this.maxY = 0;
    }, i.prototype.measureColumns = function() {
        if (this.getContainerWidth(), !this.columnWidth) {
            var t = this.items[0], i = t && t.element;
            this.columnWidth = i && e(i).outerWidth || this.containerWidth;
        }
        var n = this.columnWidth += this.gutter, o = this.containerWidth + this.gutter, s = o / n, r = n - o % n, a = r && r < 1 ? "round" : "floor";
        s = Math[a](s), this.cols = Math.max(s, 1);
    }, i.prototype.getContainerWidth = function() {
        var t = this._getOption("fitWidth"), i = t ? this.element.parentNode : this.element, n = e(i);
        this.containerWidth = n && n.innerWidth;
    }, i.prototype._getItemLayoutPosition = function(t) {
        t.getSize();
        var e = t.size.outerWidth % this.columnWidth, i = e && e < 1 ? "round" : "ceil", n = Math[i](t.size.outerWidth / this.columnWidth);
        n = Math.min(n, this.cols);
        for (var o = this._getColGroup(n), s = Math.min.apply(Math, o), r = o.indexOf(s), a = {
            x: this.columnWidth * r,
            y: s
        }, u = s + t.size.outerHeight, h = this.cols + 1 - o.length, d = 0; d < h; d++) this.colYs[r + d] = u;
        return a;
    }, i.prototype._getColGroup = function(t) {
        if (t < 2) return this.colYs;
        for (var e = [], i = this.cols + 1 - t, n = 0; n < i; n++) {
            var o = this.colYs.slice(n, n + t);
            e[n] = Math.max.apply(Math, o);
        }
        return e;
    }, i.prototype._manageStamp = function(t) {
        var i = e(t), n = this._getElementOffset(t), o = this._getOption("originLeft"), s = o ? n.left : n.right, r = s + i.outerWidth, a = Math.floor(s / this.columnWidth);
        a = Math.max(0, a);
        var u = Math.floor(r / this.columnWidth);
        u -= r % this.columnWidth ? 0 : 1, u = Math.min(this.cols - 1, u);
        for (var h = this._getOption("originTop"), d = (h ? n.top : n.bottom) + i.outerHeight, l = a; l <= u; l++) this.colYs[l] = Math.max(d, this.colYs[l]);
    }, i.prototype._getContainerSize = function() {
        this.maxY = Math.max.apply(Math, this.colYs);
        var t = {
            height: this.maxY
        };
        return this._getOption("fitWidth") && (t.width = this._getContainerFitWidth()), 
        t;
    }, i.prototype._getContainerFitWidth = function() {
        for (var t = 0, e = this.cols; --e && 0 === this.colYs[e]; ) t++;
        return (this.cols - t) * this.columnWidth - this.gutter;
    }, i.prototype.needsResizeLayout = function() {
        var t = this.containerWidth;
        return this.getContainerWidth(), t != this.containerWidth;
    }, i;
}), function(t, e) {
    "function" == typeof define && define.amd ? define("isotope/js/layout-modes/masonry", [ "../layout-mode", "masonry/masonry" ], e) : "object" == typeof module && module.exports ? module.exports = e(require("../layout-mode"), require("masonry-layout")) : e(t.Isotope.LayoutMode, t.Masonry);
}(window, function(t, e) {
    "use strict";
    var i = t.create("masonry"), n = i.prototype, o = {
        _getElementOffset: !0,
        layout: !0,
        _getMeasurement: !0
    };
    for (var s in e.prototype) o[s] || (n[s] = e.prototype[s]);
    var r = n.measureColumns;
    n.measureColumns = function() {
        this.items = this.isotope.filteredItems, r.call(this);
    };
    var a = n._getOption;
    return n._getOption = function(t) {
        return "fitWidth" == t ? void 0 !== this.options.isFitWidth ? this.options.isFitWidth : this.options.fitWidth : a.apply(this.isotope, arguments);
    }, i;
}), function(t, e) {
    "function" == typeof define && define.amd ? define("isotope/js/layout-modes/fit-rows", [ "../layout-mode" ], e) : "object" == typeof exports ? module.exports = e(require("../layout-mode")) : e(t.Isotope.LayoutMode);
}(window, function(t) {
    "use strict";
    var e = t.create("fitRows"), i = e.prototype;
    return i._resetLayout = function() {
        this.x = 0, this.y = 0, this.maxY = 0, this._getMeasurement("gutter", "outerWidth");
    }, i._getItemLayoutPosition = function(t) {
        t.getSize();
        var e = t.size.outerWidth + this.gutter, i = this.isotope.size.innerWidth + this.gutter;
        0 !== this.x && e + this.x > i && (this.x = 0, this.y = this.maxY);
        var n = {
            x: this.x,
            y: this.y
        };
        return this.maxY = Math.max(this.maxY, this.y + t.size.outerHeight), this.x += e, 
        n;
    }, i._getContainerSize = function() {
        return {
            height: this.maxY
        };
    }, e;
}), function(t, e) {
    "function" == typeof define && define.amd ? define("isotope/js/layout-modes/vertical", [ "../layout-mode" ], e) : "object" == typeof module && module.exports ? module.exports = e(require("../layout-mode")) : e(t.Isotope.LayoutMode);
}(window, function(t) {
    "use strict";
    var e = t.create("vertical", {
        horizontalAlignment: 0
    }), i = e.prototype;
    return i._resetLayout = function() {
        this.y = 0;
    }, i._getItemLayoutPosition = function(t) {
        t.getSize();
        var e = (this.isotope.size.innerWidth - t.size.outerWidth) * this.options.horizontalAlignment, i = this.y;
        return this.y += t.size.outerHeight, {
            x: e,
            y: i
        };
    }, i._getContainerSize = function() {
        return {
            height: this.y
        };
    }, e;
}), function(t, e) {
    "function" == typeof define && define.amd ? define([ "outlayer/outlayer", "get-size/get-size", "desandro-matches-selector/matches-selector", "fizzy-ui-utils/utils", "isotope/js/item", "isotope/js/layout-mode", "isotope/js/layout-modes/masonry", "isotope/js/layout-modes/fit-rows", "isotope/js/layout-modes/vertical" ], function(i, n, o, s, r, a) {
        return e(t, i, n, o, s, r, a);
    }) : "object" == typeof module && module.exports ? module.exports = e(t, require("outlayer"), require("get-size"), require("desandro-matches-selector"), require("fizzy-ui-utils"), require("isotope/js/item"), require("isotope/js/layout-mode"), require("isotope/js/layout-modes/masonry"), require("isotope/js/layout-modes/fit-rows"), require("isotope/js/layout-modes/vertical")) : t.Isotope = e(t, t.Outlayer, t.getSize, t.matchesSelector, t.fizzyUIUtils, t.Isotope.Item, t.Isotope.LayoutMode);
}(window, function(t, e, i, n, o, s, r) {
    function a(t, e) {
        return function(i, n) {
            for (var o = 0; o < t.length; o++) {
                var s = t[o], r = i.sortData[s], a = n.sortData[s];
                if (r > a || r < a) {
                    var u = void 0 !== e[s] ? e[s] : e, h = u ? 1 : -1;
                    return (r > a ? 1 : -1) * h;
                }
            }
            return 0;
        };
    }
    var u = t.jQuery, h = String.prototype.trim ? function(t) {
        return t.trim();
    } : function(t) {
        return t.replace(/^\s+|\s+$/g, "");
    }, d = e.create("isotope", {
        layoutMode: "masonry",
        isJQueryFiltering: !0,
        sortAscending: !0
    });
    d.Item = s, d.LayoutMode = r;
    var l = d.prototype;
    l._create = function() {
        this.itemGUID = 0, this._sorters = {}, this._getSorters(), e.prototype._create.call(this), 
        this.modes = {}, this.filteredItems = this.items, this.sortHistory = [ "original-order" ];
        for (var t in r.modes) this._initLayoutMode(t);
    }, l.reloadItems = function() {
        this.itemGUID = 0, e.prototype.reloadItems.call(this);
    }, l._itemize = function() {
        for (var t = e.prototype._itemize.apply(this, arguments), i = 0; i < t.length; i++) {
            var n = t[i];
            n.id = this.itemGUID++;
        }
        return this._updateItemsSortData(t), t;
    }, l._initLayoutMode = function(t) {
        var e = r.modes[t], i = this.options[t] || {};
        this.options[t] = e.options ? o.extend(e.options, i) : i, this.modes[t] = new e(this);
    }, l.layout = function() {
        return !this._isLayoutInited && this._getOption("initLayout") ? void this.arrange() : void this._layout();
    }, l._layout = function() {
        var t = this._getIsInstant();
        this._resetLayout(), this._manageStamps(), this.layoutItems(this.filteredItems, t), 
        this._isLayoutInited = !0;
    }, l.arrange = function(t) {
        this.option(t), this._getIsInstant();
        var e = this._filter(this.items);
        this.filteredItems = e.matches, this._bindArrangeComplete(), this._isInstant ? this._noTransition(this._hideReveal, [ e ]) : this._hideReveal(e), 
        this._sort(), this._layout();
    }, l._init = l.arrange, l._hideReveal = function(t) {
        this.reveal(t.needReveal), this.hide(t.needHide);
    }, l._getIsInstant = function() {
        var t = this._getOption("layoutInstant"), e = void 0 !== t ? t : !this._isLayoutInited;
        return this._isInstant = e, e;
    }, l._bindArrangeComplete = function() {
        function t() {
            e && i && n && o.dispatchEvent("arrangeComplete", null, [ o.filteredItems ]);
        }
        var e, i, n, o = this;
        this.once("layoutComplete", function() {
            e = !0, t();
        }), this.once("hideComplete", function() {
            i = !0, t();
        }), this.once("revealComplete", function() {
            n = !0, t();
        });
    }, l._filter = function(t) {
        var e = this.options.filter;
        e = e || "*";
        for (var i = [], n = [], o = [], s = this._getFilterTest(e), r = 0; r < t.length; r++) {
            var a = t[r];
            if (!a.isIgnored) {
                var u = s(a);
                u && i.push(a), u && a.isHidden ? n.push(a) : u || a.isHidden || o.push(a);
            }
        }
        return {
            matches: i,
            needReveal: n,
            needHide: o
        };
    }, l._getFilterTest = function(t) {
        return u && this.options.isJQueryFiltering ? function(e) {
            return u(e.element).is(t);
        } : "function" == typeof t ? function(e) {
            return t(e.element);
        } : function(e) {
            return n(e.element, t);
        };
    }, l.updateSortData = function(t) {
        var e;
        t ? (t = o.makeArray(t), e = this.getItems(t)) : e = this.items, this._getSorters(), 
        this._updateItemsSortData(e);
    }, l._getSorters = function() {
        var t = this.options.getSortData;
        for (var e in t) {
            var i = t[e];
            this._sorters[e] = f(i);
        }
    }, l._updateItemsSortData = function(t) {
        for (var e = t && t.length, i = 0; e && i < e; i++) {
            var n = t[i];
            n.updateSortData();
        }
    };
    var f = function() {
        function t(t) {
            if ("string" != typeof t) return t;
            var i = h(t).split(" "), n = i[0], o = n.match(/^\[(.+)\]$/), s = o && o[1], r = e(s, n), a = d.sortDataParsers[i[1]];
            return t = a ? function(t) {
                return t && a(r(t));
            } : function(t) {
                return t && r(t);
            };
        }
        function e(t, e) {
            return t ? function(e) {
                return e.getAttribute(t);
            } : function(t) {
                var i = t.querySelector(e);
                return i && i.textContent;
            };
        }
        return t;
    }();
    d.sortDataParsers = {
        parseInt: function(t) {
            return parseInt(t, 10);
        },
        parseFloat: function(t) {
            return parseFloat(t);
        }
    }, l._sort = function() {
        var t = this.options.sortBy;
        if (t) {
            var e = [].concat.apply(t, this.sortHistory), i = a(e, this.options.sortAscending);
            this.filteredItems.sort(i), t != this.sortHistory[0] && this.sortHistory.unshift(t);
        }
    }, l._mode = function() {
        var t = this.options.layoutMode, e = this.modes[t];
        if (!e) throw new Error("No layout mode: " + t);
        return e.options = this.options[t], e;
    }, l._resetLayout = function() {
        e.prototype._resetLayout.call(this), this._mode()._resetLayout();
    }, l._getItemLayoutPosition = function(t) {
        return this._mode()._getItemLayoutPosition(t);
    }, l._manageStamp = function(t) {
        this._mode()._manageStamp(t);
    }, l._getContainerSize = function() {
        return this._mode()._getContainerSize();
    }, l.needsResizeLayout = function() {
        return this._mode().needsResizeLayout();
    }, l.appended = function(t) {
        var e = this.addItems(t);
        if (e.length) {
            var i = this._filterRevealAdded(e);
            this.filteredItems = this.filteredItems.concat(i);
        }
    }, l.prepended = function(t) {
        var e = this._itemize(t);
        if (e.length) {
            this._resetLayout(), this._manageStamps();
            var i = this._filterRevealAdded(e);
            this.layoutItems(this.filteredItems), this.filteredItems = i.concat(this.filteredItems), 
            this.items = e.concat(this.items);
        }
    }, l._filterRevealAdded = function(t) {
        var e = this._filter(t);
        return this.hide(e.needHide), this.reveal(e.matches), this.layoutItems(e.matches, !0), 
        e.matches;
    }, l.insert = function(t) {
        var e = this.addItems(t);
        if (e.length) {
            var i, n, o = e.length;
            for (i = 0; i < o; i++) n = e[i], this.element.appendChild(n.element);
            var s = this._filter(e).matches;
            for (i = 0; i < o; i++) e[i].isLayoutInstant = !0;
            for (this.arrange(), i = 0; i < o; i++) delete e[i].isLayoutInstant;
            this.reveal(s);
        }
    };
    var c = l.remove;
    return l.remove = function(t) {
        t = o.makeArray(t);
        var e = this.getItems(t);
        c.call(this, t);
        for (var i = e && e.length, n = 0; i && n < i; n++) {
            var s = e[n];
            o.removeFrom(this.filteredItems, s);
        }
    }, l.shuffle = function() {
        for (var t = 0; t < this.items.length; t++) {
            var e = this.items[t];
            e.sortData.random = Math.random();
        }
        this.options.sortBy = "random", this._sort(), this._layout();
    }, l._noTransition = function(t, e) {
        var i = this.options.transitionDuration;
        this.options.transitionDuration = 0;
        var n = t.apply(this, e);
        return this.options.transitionDuration = i, n;
    }, l.getFilteredItemElements = function() {
        return this.filteredItems.map(function(t) {
            return t.element;
        });
    }, d;
});

!function(a, b) {
    "function" == typeof define && define.amd ? define("packery/js/rect", b) : "object" == typeof module && module.exports ? module.exports = b() : (a.Packery = a.Packery || {}, 
    a.Packery.Rect = b());
}(window, function() {
    function a(b) {
        for (var c in a.defaults) this[c] = a.defaults[c];
        for (c in b) this[c] = b[c];
    }
    a.defaults = {
        x: 0,
        y: 0,
        width: 0,
        height: 0
    };
    var b = a.prototype;
    return b.contains = function(a) {
        var b = a.width || 0, c = a.height || 0;
        return this.x <= a.x && this.y <= a.y && this.x + this.width >= a.x + b && this.y + this.height >= a.y + c;
    }, b.overlaps = function(a) {
        var b = this.x + this.width, c = this.y + this.height, d = a.x + a.width, e = a.y + a.height;
        return this.x < d && b > a.x && this.y < e && c > a.y;
    }, b.getMaximalFreeRects = function(b) {
        if (!this.overlaps(b)) return !1;
        var c, d = [], e = this.x + this.width, f = this.y + this.height, g = b.x + b.width, h = b.y + b.height;
        return this.y < b.y && (c = new a({
            x: this.x,
            y: this.y,
            width: this.width,
            height: b.y - this.y
        }), d.push(c)), e > g && (c = new a({
            x: g,
            y: this.y,
            width: e - g,
            height: this.height
        }), d.push(c)), f > h && (c = new a({
            x: this.x,
            y: h,
            width: this.width,
            height: f - h
        }), d.push(c)), this.x < b.x && (c = new a({
            x: this.x,
            y: this.y,
            width: b.x - this.x,
            height: this.height
        }), d.push(c)), d;
    }, b.canFit = function(a) {
        return this.width >= a.width && this.height >= a.height;
    }, a;
}), function(a, b) {
    if ("function" == typeof define && define.amd) define("packery/js/packer", [ "./rect" ], b); else if ("object" == typeof module && module.exports) module.exports = b(require("./rect")); else {
        var c = a.Packery = a.Packery || {};
        c.Packer = b(c.Rect);
    }
}(window, function(a) {
    function b(a, b, c) {
        this.width = a || 0, this.height = b || 0, this.sortDirection = c || "downwardLeftToRight", 
        this.reset();
    }
    var c = b.prototype;
    c.reset = function() {
        this.spaces = [];
        var b = new a({
            x: 0,
            y: 0,
            width: this.width,
            height: this.height
        });
        this.spaces.push(b), this.sorter = d[this.sortDirection] || d.downwardLeftToRight;
    }, c.pack = function(a) {
        for (var b = 0; b < this.spaces.length; b++) {
            var c = this.spaces[b];
            if (c.canFit(a)) {
                this.placeInSpace(a, c);
                break;
            }
        }
    }, c.columnPack = function(a) {
        for (var b = 0; b < this.spaces.length; b++) {
            var c = this.spaces[b], d = c.x <= a.x && c.x + c.width >= a.x + a.width && c.height >= a.height - .01;
            if (d) {
                a.y = c.y, this.placed(a);
                break;
            }
        }
    }, c.rowPack = function(a) {
        for (var b = 0; b < this.spaces.length; b++) {
            var c = this.spaces[b], d = c.y <= a.y && c.y + c.height >= a.y + a.height && c.width >= a.width - .01;
            if (d) {
                a.x = c.x, this.placed(a);
                break;
            }
        }
    }, c.placeInSpace = function(a, b) {
        a.x = b.x, a.y = b.y, this.placed(a);
    }, c.placed = function(a) {
        for (var b = [], c = 0; c < this.spaces.length; c++) {
            var d = this.spaces[c], e = d.getMaximalFreeRects(a);
            e ? b.push.apply(b, e) : b.push(d);
        }
        this.spaces = b, this.mergeSortSpaces();
    }, c.mergeSortSpaces = function() {
        b.mergeRects(this.spaces), this.spaces.sort(this.sorter);
    }, c.addSpace = function(a) {
        this.spaces.push(a), this.mergeSortSpaces();
    }, b.mergeRects = function(a) {
        var b = 0, c = a[b];
        a: for (;c; ) {
            for (var d = 0, e = a[b + d]; e; ) {
                if (e == c) d++; else {
                    if (e.contains(c)) {
                        a.splice(b, 1), c = a[b];
                        continue a;
                    }
                    c.contains(e) ? a.splice(b + d, 1) : d++;
                }
                e = a[b + d];
            }
            b++, c = a[b];
        }
        return a;
    };
    var d = {
        downwardLeftToRight: function(a, b) {
            return a.y - b.y || a.x - b.x;
        },
        rightwardTopToBottom: function(a, b) {
            return a.x - b.x || a.y - b.y;
        }
    };
    return b;
}), function(a, b) {
    "function" == typeof define && define.amd ? define("packery/js/item", [ "outlayer/outlayer", "./rect" ], b) : "object" == typeof module && module.exports ? module.exports = b(require("outlayer"), require("./rect")) : a.Packery.Item = b(a.Outlayer, a.Packery.Rect);
}(window, function(a, b) {
    var c = document.documentElement.style, d = "string" == typeof c.transform ? "transform" : "WebkitTransform", e = function() {
        a.Item.apply(this, arguments);
    }, f = e.prototype = Object.create(a.Item.prototype), g = f._create;
    f._create = function() {
        g.call(this), this.rect = new b();
    };
    var h = f.moveTo;
    return f.moveTo = function(a, b) {
        var c = Math.abs(this.position.x - a), d = Math.abs(this.position.y - b), e = this.layout.dragItemCount && !this.isPlacing && !this.isTransitioning && 1 > c && 1 > d;
        return e ? void this.goTo(a, b) : void h.apply(this, arguments);
    }, f.enablePlacing = function() {
        this.removeTransitionStyles(), this.isTransitioning && d && (this.element.style[d] = "none"), 
        this.isTransitioning = !1, this.getSize(), this.layout._setRectSize(this.element, this.rect), 
        this.isPlacing = !0;
    }, f.disablePlacing = function() {
        this.isPlacing = !1;
    }, f.removeElem = function() {
        this.element.parentNode.removeChild(this.element), this.layout.packer.addSpace(this.rect), 
        this.emitEvent("remove", [ this ]);
    }, f.showDropPlaceholder = function() {
        var a = this.dropPlaceholder;
        a || (a = this.dropPlaceholder = document.createElement("div"), a.className = "packery-drop-placeholder", 
        a.style.position = "absolute"), a.style.width = this.size.width + "px", a.style.height = this.size.height + "px", 
        this.positionDropPlaceholder(), this.layout.element.appendChild(a);
    }, f.positionDropPlaceholder = function() {
        this.dropPlaceholder.style[d] = "translate(" + this.rect.x + "px, " + this.rect.y + "px)";
    }, f.hideDropPlaceholder = function() {
        this.layout.element.removeChild(this.dropPlaceholder);
    }, e;
}), function(a, b) {
    "function" == typeof define && define.amd ? define("packery/js/packery", [ "get-size/get-size", "outlayer/outlayer", "./rect", "./packer", "./item" ], b) : "object" == typeof module && module.exports ? module.exports = b(require("get-size"), require("outlayer"), require("./rect"), require("./packer"), require("./item")) : a.Packery = b(a.getSize, a.Outlayer, a.Packery.Rect, a.Packery.Packer, a.Packery.Item);
}(window, function(a, b, c, d, e) {
    function f(a, b) {
        return a.position.y - b.position.y || a.position.x - b.position.x;
    }
    function g(a, b) {
        return a.position.x - b.position.x || a.position.y - b.position.y;
    }
    function h(a, b) {
        var c = b.x - a.x, d = b.y - a.y;
        return Math.sqrt(c * c + d * d);
    }
    c.prototype.canFit = function(a) {
        return this.width >= a.width - 1 && this.height >= a.height - 1;
    };
    var i = b.create("packery");
    i.Item = e;
    var j = i.prototype;
    j._create = function() {
        b.prototype._create.call(this), this.packer = new d(), this.shiftPacker = new d(), 
        this.isEnabled = !0, this.dragItemCount = 0;
        var a = this;
        this.handleDraggabilly = {
            dragStart: function() {
                a.itemDragStart(this.element);
            },
            dragMove: function() {
                a.itemDragMove(this.element, this.position.x, this.position.y);
            },
            dragEnd: function() {
                a.itemDragEnd(this.element);
            }
        }, this.handleUIDraggable = {
            start: function(b, c) {
                c && a.itemDragStart(b.currentTarget);
            },
            drag: function(b, c) {
                c && a.itemDragMove(b.currentTarget, c.position.left, c.position.top);
            },
            stop: function(b, c) {
                c && a.itemDragEnd(b.currentTarget);
            }
        };
    }, j._resetLayout = function() {
        this.getSize(), this._getMeasurements();
        var a, b, c;
        this._getOption("horizontal") ? (a = 1 / 0, b = this.size.innerHeight + this.gutter, 
        c = "rightwardTopToBottom") : (a = this.size.innerWidth + this.gutter, b = 1 / 0, 
        c = "downwardLeftToRight"), this.packer.width = this.shiftPacker.width = a, this.packer.height = this.shiftPacker.height = b, 
        this.packer.sortDirection = this.shiftPacker.sortDirection = c, this.packer.reset(), 
        this.maxY = 0, this.maxX = 0;
    }, j._getMeasurements = function() {
        this._getMeasurement("columnWidth", "width"), this._getMeasurement("rowHeight", "height"), 
        this._getMeasurement("gutter", "width");
    }, j._getItemLayoutPosition = function(a) {
        if (this._setRectSize(a.element, a.rect), this.isShifting || this.dragItemCount > 0) {
            var b = this._getPackMethod();
            this.packer[b](a.rect);
        } else this.packer.pack(a.rect);
        return this._setMaxXY(a.rect), a.rect;
    }, j.shiftLayout = function() {
        this.isShifting = !0, this.layout(), delete this.isShifting;
    }, j._getPackMethod = function() {
        return this._getOption("horizontal") ? "rowPack" : "columnPack";
    }, j._setMaxXY = function(a) {
        this.maxX = Math.max(a.x + a.width, this.maxX), this.maxY = Math.max(a.y + a.height, this.maxY);
    }, j._setRectSize = function(b, c) {
        var d = a(b), e = d.outerWidth, f = d.outerHeight;
        (e || f) && (e = this._applyGridGutter(e, this.columnWidth), f = this._applyGridGutter(f, this.rowHeight)), 
        c.width = Math.min(e, this.packer.width), c.height = Math.min(f, this.packer.height);
    }, j._applyGridGutter = function(a, b) {
        if (!b) return a + this.gutter;
        b += this.gutter;
        var c = a % b, d = c && 1 > c ? "round" : "ceil";
        return a = Math[d](a / b) * b;
    }, j._getContainerSize = function() {
        return this._getOption("horizontal") ? {
            width: this.maxX - this.gutter
        } : {
            height: this.maxY - this.gutter
        };
    }, j._manageStamp = function(a) {
        var b, d = this.getItem(a);
        if (d && d.isPlacing) b = d.rect; else {
            var e = this._getElementOffset(a);
            b = new c({
                x: this._getOption("originLeft") ? e.left : e.right,
                y: this._getOption("originTop") ? e.top : e.bottom
            });
        }
        this._setRectSize(a, b), this.packer.placed(b), this._setMaxXY(b);
    }, j.sortItemsByPosition = function() {
        var a = this._getOption("horizontal") ? g : f;
        this.items.sort(a);
    }, j.fit = function(a, b, c) {
        var d = this.getItem(a);
        d && (this.stamp(d.element), d.enablePlacing(), this.updateShiftTargets(d), b = void 0 === b ? d.rect.x : b, 
        c = void 0 === c ? d.rect.y : c, this.shift(d, b, c), this._bindFitEvents(d), d.moveTo(d.rect.x, d.rect.y), 
        this.shiftLayout(), this.unstamp(d.element), this.sortItemsByPosition(), d.disablePlacing());
    }, j._bindFitEvents = function(a) {
        function b() {
            d++, 2 == d && c.dispatchEvent("fitComplete", null, [ a ]);
        }
        var c = this, d = 0;
        a.once("layout", b), this.once("layoutComplete", b);
    }, j.resize = function() {
        this.isResizeBound && this.needsResizeLayout() && (this.options.shiftPercentResize ? this.resizeShiftPercentLayout() : this.layout());
    }, j.needsResizeLayout = function() {
        var b = a(this.element), c = this._getOption("horizontal") ? "innerHeight" : "innerWidth";
        return b[c] != this.size[c];
    }, j.resizeShiftPercentLayout = function() {
        var b = this._getItemsForLayout(this.items), c = this._getOption("horizontal"), d = c ? "y" : "x", e = c ? "height" : "width", f = c ? "rowHeight" : "columnWidth", g = c ? "innerHeight" : "innerWidth", h = this[f];
        if (h = h && h + this.gutter) {
            this._getMeasurements();
            var i = this[f] + this.gutter;
            b.forEach(function(a) {
                var b = Math.round(a.rect[d] / h);
                a.rect[d] = b * i;
            });
        } else {
            var j = a(this.element)[g] + this.gutter, k = this.packer[e];
            b.forEach(function(a) {
                a.rect[d] = a.rect[d] / k * j;
            });
        }
        this.shiftLayout();
    }, j.itemDragStart = function(a) {
        if (this.isEnabled) {
            this.stamp(a);
            var b = this.getItem(a);
            b && (b.enablePlacing(), b.showDropPlaceholder(), this.dragItemCount++, this.updateShiftTargets(b));
        }
    }, j.updateShiftTargets = function(a) {
        this.shiftPacker.reset(), this._getBoundingRect();
        var b = this._getOption("originLeft"), d = this._getOption("originTop");
        this.stamps.forEach(function(a) {
            var e = this.getItem(a);
            if (!e || !e.isPlacing) {
                var f = this._getElementOffset(a), g = new c({
                    x: b ? f.left : f.right,
                    y: d ? f.top : f.bottom
                });
                this._setRectSize(a, g), this.shiftPacker.placed(g);
            }
        }, this);
        var e = this._getOption("horizontal"), f = e ? "rowHeight" : "columnWidth", g = e ? "height" : "width";
        this.shiftTargetKeys = [], this.shiftTargets = [];
        var h, i = this[f];
        if (i = i && i + this.gutter) {
            var j = Math.ceil(a.rect[g] / i), k = Math.floor((this.shiftPacker[g] + this.gutter) / i);
            h = (k - j) * i;
            for (var l = 0; k > l; l++) this._addShiftTarget(l * i, 0, h);
        } else h = this.shiftPacker[g] + this.gutter - a.rect[g], this._addShiftTarget(0, 0, h);
        var m = this._getItemsForLayout(this.items), n = this._getPackMethod();
        m.forEach(function(a) {
            var b = a.rect;
            this._setRectSize(a.element, b), this.shiftPacker[n](b), this._addShiftTarget(b.x, b.y, h);
            var c = e ? b.x + b.width : b.x, d = e ? b.y : b.y + b.height;
            if (this._addShiftTarget(c, d, h), i) for (var f = Math.round(b[g] / i), j = 1; f > j; j++) {
                var k = e ? c : b.x + i * j, l = e ? b.y + i * j : d;
                this._addShiftTarget(k, l, h);
            }
        }, this);
    }, j._addShiftTarget = function(a, b, c) {
        var d = this._getOption("horizontal") ? b : a;
        if (!(0 !== d && d > c)) {
            var e = a + "," + b, f = -1 != this.shiftTargetKeys.indexOf(e);
            f || (this.shiftTargetKeys.push(e), this.shiftTargets.push({
                x: a,
                y: b
            }));
        }
    }, j.shift = function(a, b, c) {
        var d, e = 1 / 0, f = {
            x: b,
            y: c
        };
        this.shiftTargets.forEach(function(a) {
            var b = h(a, f);
            e > b && (d = a, e = b);
        }), a.rect.x = d.x, a.rect.y = d.y;
    };
    var k = 120;
    j.itemDragMove = function(a, b, c) {
        function d() {
            f.shift(e, b, c), e.positionDropPlaceholder(), f.layout();
        }
        var e = this.isEnabled && this.getItem(a);
        if (e) {
            b -= this.size.paddingLeft, c -= this.size.paddingTop;
            var f = this, g = new Date();
            this._itemDragTime && g - this._itemDragTime < k ? (clearTimeout(this.dragTimeout), 
            this.dragTimeout = setTimeout(d, k)) : (d(), this._itemDragTime = g);
        }
    }, j.itemDragEnd = function(a) {
        function b() {
            d++, 2 == d && (c.element.classList.remove("is-positioning-post-drag"), c.hideDropPlaceholder(), 
            e.dispatchEvent("dragItemPositioned", null, [ c ]));
        }
        var c = this.isEnabled && this.getItem(a);
        if (c) {
            clearTimeout(this.dragTimeout), c.element.classList.add("is-positioning-post-drag");
            var d = 0, e = this;
            c.once("layout", b), this.once("layoutComplete", b), c.moveTo(c.rect.x, c.rect.y), 
            this.layout(), this.dragItemCount = Math.max(0, this.dragItemCount - 1), this.sortItemsByPosition(), 
            c.disablePlacing(), this.unstamp(c.element);
        }
    }, j.bindDraggabillyEvents = function(a) {
        this._bindDraggabillyEvents(a, "on");
    }, j.unbindDraggabillyEvents = function(a) {
        this._bindDraggabillyEvents(a, "off");
    }, j._bindDraggabillyEvents = function(a, b) {
        var c = this.handleDraggabilly;
        a[b]("dragStart", c.dragStart), a[b]("dragMove", c.dragMove), a[b]("dragEnd", c.dragEnd);
    }, j.bindUIDraggableEvents = function(a) {
        this._bindUIDraggableEvents(a, "on");
    }, j.unbindUIDraggableEvents = function(a) {
        this._bindUIDraggableEvents(a, "off");
    }, j._bindUIDraggableEvents = function(a, b) {
        var c = this.handleUIDraggable;
        a[b]("dragstart", c.start)[b]("drag", c.drag)[b]("dragstop", c.stop);
    };
    var l = j.destroy;
    return j.destroy = function() {
        l.apply(this, arguments), this.isEnabled = !1;
    }, i.Rect = c, i.Packer = d, i;
}), function(a, b) {
    "function" == typeof define && define.amd ? define([ "isotope/js/layout-mode", "packery/js/packery" ], b) : "object" == typeof module && module.exports ? module.exports = b(require("isotope-layout/js/layout-mode"), require("packery")) : b(a.Isotope.LayoutMode, a.Packery);
}(window, function(a, b) {
    var c = a.create("packery"), d = c.prototype, e = {
        _getElementOffset: !0,
        _getMeasurement: !0
    };
    for (var f in b.prototype) e[f] || (d[f] = b.prototype[f]);
    var g = d._resetLayout;
    d._resetLayout = function() {
        this.packer = this.packer || new b.Packer(), this.shiftPacker = this.shiftPacker || new b.Packer(), 
        g.apply(this, arguments);
    };
    var h = d._getItemLayoutPosition;
    d._getItemLayoutPosition = function(a) {
        return a.rect = a.rect || new b.Rect(), h.call(this, a);
    };
    var i = d.needsResizeLayout;
    d.needsResizeLayout = function() {
        return this._getOption("horizontal") ? this.needsVerticalResizeLayout() : i.call(this);
    };
    var j = d._getOption;
    return d._getOption = function(a) {
        return "horizontal" == a ? void 0 !== this.options.isHorizontal ? this.options.isHorizontal : this.options.horizontal : j.apply(this.isotope, arguments);
    }, c;
});

var mejs = mejs || {};

mejs.version = "2.23.3", mejs.meIndex = 0, mejs.plugins = {
    silverlight: [ {
        version: [ 3, 0 ],
        types: [ "video/mp4", "video/m4v", "video/mov", "video/wmv", "audio/wma", "audio/m4a", "audio/mp3", "audio/wav", "audio/mpeg" ]
    } ],
    flash: [ {
        version: [ 9, 0, 124 ],
        types: [ "video/mp4", "video/m4v", "video/mov", "video/flv", "video/rtmp", "video/x-flv", "audio/flv", "audio/x-flv", "audio/mp3", "audio/m4a", "audio/mp4", "audio/mpeg", "video/dailymotion", "video/x-dailymotion", "application/x-mpegURL", "audio/ogg" ]
    } ],
    youtube: [ {
        version: null,
        types: [ "video/youtube", "video/x-youtube", "audio/youtube", "audio/x-youtube" ]
    } ],
    vimeo: [ {
        version: null,
        types: [ "video/vimeo", "video/x-vimeo" ]
    } ]
}, mejs.Utility = {
    encodeUrl: function(a) {
        return encodeURIComponent(a);
    },
    escapeHTML: function(a) {
        return a.toString().split("&").join("&amp;").split("<").join("&lt;").split('"').join("&quot;");
    },
    absolutizeUrl: function(a) {
        var b = document.createElement("div");
        return b.innerHTML = '<a href="' + this.escapeHTML(a) + '">x</a>', b.firstChild.href;
    },
    getScriptPath: function(a) {
        for (var b, c, d, e, f, g, h = 0, i = "", j = "", k = document.getElementsByTagName("script"), l = k.length, m = a.length; l > h; h++) {
            for (e = k[h].src, c = e.lastIndexOf("/"), c > -1 ? (g = e.substring(c + 1), f = e.substring(0, c + 1)) : (g = e, 
            f = ""), b = 0; m > b; b++) if (j = a[b], d = g.indexOf(j), d > -1) {
                i = f;
                break;
            }
            if ("" !== i) break;
        }
        return i;
    },
    calculateTimeFormat: function(a, b, c) {
        0 > a && (a = 0), "undefined" == typeof c && (c = 25);
        var d = b.timeFormat, e = d[0], f = d[1] == d[0], g = f ? 2 : 1, h = ":", i = Math.floor(a / 3600) % 24, j = Math.floor(a / 60) % 60, k = Math.floor(a % 60), l = Math.floor((a % 1 * c).toFixed(3)), m = [ [ l, "f" ], [ k, "s" ], [ j, "m" ], [ i, "h" ] ];
        d.length < g && (h = d[g]);
        for (var n = !1, o = 0, p = m.length; p > o; o++) if (-1 !== d.indexOf(m[o][1])) n = !0; else if (n) {
            for (var q = !1, r = o; p > r; r++) if (m[r][0] > 0) {
                q = !0;
                break;
            }
            if (!q) break;
            f || (d = e + d), d = m[o][1] + h + d, f && (d = m[o][1] + d), e = m[o][1];
        }
        b.currentTimeFormat = d;
    },
    twoDigitsString: function(a) {
        return 10 > a ? "0" + a : String(a);
    },
    secondsToTimeCode: function(a, b) {
        if (0 > a && (a = 0), "object" != typeof b) {
            var c = "m:ss";
            c = arguments[1] ? "hh:mm:ss" : c, c = arguments[2] ? c + ":ff" : c, b = {
                currentTimeFormat: c,
                framesPerSecond: arguments[3] || 25
            };
        }
        var d = b.framesPerSecond;
        "undefined" == typeof d && (d = 25);
        var c = b.currentTimeFormat, e = Math.floor(a / 3600) % 24, f = Math.floor(a / 60) % 60, g = Math.floor(a % 60), h = Math.floor((a % 1 * d).toFixed(3));
        lis = [ [ h, "f" ], [ g, "s" ], [ f, "m" ], [ e, "h" ] ];
        var j = c;
        for (i = 0, len = lis.length; i < len; i++) j = j.replace(lis[i][1] + lis[i][1], this.twoDigitsString(lis[i][0])), 
        j = j.replace(lis[i][1], lis[i][0]);
        return j;
    },
    timeCodeToSeconds: function(a, b, c, d) {
        "undefined" == typeof c ? c = !1 : "undefined" == typeof d && (d = 25);
        var e = a.split(":"), f = parseInt(e[0], 10), g = parseInt(e[1], 10), h = parseInt(e[2], 10), i = 0, j = 0;
        return c && (i = parseInt(e[3]) / d), j = 3600 * f + 60 * g + h + i;
    },
    convertSMPTEtoSeconds: function(a) {
        if ("string" != typeof a) return !1;
        a = a.replace(",", ".");
        var b = 0, c = -1 != a.indexOf(".") ? a.split(".")[1].length : 0, d = 1;
        a = a.split(":").reverse();
        for (var e = 0; e < a.length; e++) d = 1, e > 0 && (d = Math.pow(60, e)), b += Number(a[e]) * d;
        return Number(b.toFixed(c));
    },
    removeSwf: function(a) {
        var b = document.getElementById(a);
        b && /object|embed/i.test(b.nodeName) && (mejs.MediaFeatures.isIE ? (b.style.display = "none", 
        function() {
            4 == b.readyState ? mejs.Utility.removeObjectInIE(a) : setTimeout(arguments.callee, 10);
        }()) : b.parentNode.removeChild(b));
    },
    removeObjectInIE: function(a) {
        var b = document.getElementById(a);
        if (b) {
            for (var c in b) "function" == typeof b[c] && (b[c] = null);
            b.parentNode.removeChild(b);
        }
    },
    determineScheme: function(a) {
        return a && -1 != a.indexOf("://") ? a.substr(0, a.indexOf("://") + 3) : "//";
    },
    debounce: function(a, b, c) {
        var d;
        return function() {
            var e = this, f = arguments, g = function() {
                d = null, c || a.apply(e, f);
            }, h = c && !d;
            clearTimeout(d), d = setTimeout(g, b), h && a.apply(e, f);
        };
    },
    isNodeAfter: function(a, b) {
        return !!(a && b && "function" == typeof a.compareDocumentPosition && a.compareDocumentPosition(b) & Node.DOCUMENT_POSITION_PRECEDING);
    }
}, mejs.PluginDetector = {
    hasPluginVersion: function(a, b) {
        var c = this.plugins[a];
        return b[1] = b[1] || 0, b[2] = b[2] || 0, c[0] > b[0] || c[0] == b[0] && c[1] > b[1] || c[0] == b[0] && c[1] == b[1] && c[2] >= b[2] ? !0 : !1;
    },
    nav: window.navigator,
    ua: window.navigator.userAgent.toLowerCase(),
    plugins: [],
    addPlugin: function(a, b, c, d, e) {
        this.plugins[a] = this.detectPlugin(b, c, d, e);
    },
    detectPlugin: function(a, b, c, d) {
        var e, f, g, h = [ 0, 0, 0 ];
        if ("undefined" != typeof this.nav.plugins && "object" == typeof this.nav.plugins[a]) {
            if (e = this.nav.plugins[a].description, e && ("undefined" == typeof this.nav.mimeTypes || !this.nav.mimeTypes[b] || this.nav.mimeTypes[b].enabledPlugin)) for (h = e.replace(a, "").replace(/^\s+/, "").replace(/\sr/gi, ".").split("."), 
            f = 0; f < h.length; f++) h[f] = parseInt(h[f].match(/\d+/), 10);
        } else if ("undefined" != typeof window.ActiveXObject) try {
            g = new ActiveXObject(c), g && (h = d(g));
        } catch (i) {}
        return h;
    }
}, mejs.PluginDetector.addPlugin("flash", "Shockwave Flash", "application/x-shockwave-flash", "ShockwaveFlash.ShockwaveFlash", function(a) {
    var b = [], c = a.GetVariable("$version");
    return c && (c = c.split(" ")[1].split(","), b = [ parseInt(c[0], 10), parseInt(c[1], 10), parseInt(c[2], 10) ]), 
    b;
}), mejs.PluginDetector.addPlugin("silverlight", "Silverlight Plug-In", "application/x-silverlight-2", "AgControl.AgControl", function(a) {
    var b = [ 0, 0, 0, 0 ], c = function(a, b, c, d) {
        for (;a.isVersionSupported(b[0] + "." + b[1] + "." + b[2] + "." + b[3]); ) b[c] += d;
        b[c] -= d;
    };
    return c(a, b, 0, 1), c(a, b, 1, 1), c(a, b, 2, 1e4), c(a, b, 2, 1e3), c(a, b, 2, 100), 
    c(a, b, 2, 10), c(a, b, 2, 1), c(a, b, 3, 1), b;
}), mejs.MediaFeatures = {
    init: function() {
        var a, b, c = this, d = document, e = mejs.PluginDetector.nav, f = mejs.PluginDetector.ua.toLowerCase(), g = [ "source", "track", "audio", "video" ];
        c.isiPad = null !== f.match(/ipad/i), c.isiPhone = null !== f.match(/iphone/i), 
        c.isiOS = c.isiPhone || c.isiPad, c.isAndroid = null !== f.match(/android/i), c.isBustedAndroid = null !== f.match(/android 2\.[12]/), 
        c.isBustedNativeHTTPS = "https:" === location.protocol && (null !== f.match(/android [12]\./) || null !== f.match(/macintosh.* version.* safari/)), 
        c.isIE = -1 != e.appName.toLowerCase().indexOf("microsoft") || null !== e.appName.toLowerCase().match(/trident/gi), 
        c.isChrome = null !== f.match(/chrome/gi), c.isChromium = null !== f.match(/chromium/gi), 
        c.isFirefox = null !== f.match(/firefox/gi), c.isWebkit = null !== f.match(/webkit/gi), 
        c.isGecko = null !== f.match(/gecko/gi) && !c.isWebkit && !c.isIE, c.isOpera = null !== f.match(/opera/gi), 
        c.hasTouch = "ontouchstart" in window, c.svgAsImg = !!document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#Image", "1.1");
        for (a = 0; a < g.length; a++) b = document.createElement(g[a]);
        c.supportsMediaTag = "undefined" != typeof b.canPlayType || c.isBustedAndroid;
        try {
            b.canPlayType("video/mp4");
        } catch (h) {
            c.supportsMediaTag = !1;
        }
        c.supportsPointerEvents = function() {
            var a, b = document.createElement("x"), c = document.documentElement, d = window.getComputedStyle;
            return "pointerEvents" in b.style ? (b.style.pointerEvents = "auto", b.style.pointerEvents = "x", 
            c.appendChild(b), a = d && "auto" === d(b, "").pointerEvents, c.removeChild(b), 
            !!a) : !1;
        }(), c.hasFirefoxPluginMovingProblem = !1, c.hasiOSFullScreen = "undefined" != typeof b.webkitEnterFullscreen, 
        c.hasNativeFullscreen = "undefined" != typeof b.requestFullscreen, c.hasWebkitNativeFullScreen = "undefined" != typeof b.webkitRequestFullScreen, 
        c.hasMozNativeFullScreen = "undefined" != typeof b.mozRequestFullScreen, c.hasMsNativeFullScreen = "undefined" != typeof b.msRequestFullscreen, 
        c.hasTrueNativeFullScreen = c.hasWebkitNativeFullScreen || c.hasMozNativeFullScreen || c.hasMsNativeFullScreen, 
        c.nativeFullScreenEnabled = c.hasTrueNativeFullScreen, c.hasMozNativeFullScreen ? c.nativeFullScreenEnabled = document.mozFullScreenEnabled : c.hasMsNativeFullScreen && (c.nativeFullScreenEnabled = document.msFullscreenEnabled), 
        c.isChrome && (c.hasiOSFullScreen = !1), c.hasTrueNativeFullScreen && (c.fullScreenEventName = "", 
        c.hasWebkitNativeFullScreen ? c.fullScreenEventName = "webkitfullscreenchange" : c.hasMozNativeFullScreen ? c.fullScreenEventName = "mozfullscreenchange" : c.hasMsNativeFullScreen && (c.fullScreenEventName = "MSFullscreenChange"), 
        c.isFullScreen = function() {
            return c.hasMozNativeFullScreen ? d.mozFullScreen : c.hasWebkitNativeFullScreen ? d.webkitIsFullScreen : c.hasMsNativeFullScreen ? null !== d.msFullscreenElement : void 0;
        }, c.requestFullScreen = function(a) {
            c.hasWebkitNativeFullScreen ? a.webkitRequestFullScreen() : c.hasMozNativeFullScreen ? a.mozRequestFullScreen() : c.hasMsNativeFullScreen && a.msRequestFullscreen();
        }, c.cancelFullScreen = function() {
            c.hasWebkitNativeFullScreen ? document.webkitCancelFullScreen() : c.hasMozNativeFullScreen ? document.mozCancelFullScreen() : c.hasMsNativeFullScreen && document.msExitFullscreen();
        }), c.hasiOSFullScreen && f.match(/mac os x 10_5/i) && (c.hasNativeFullScreen = !1, 
        c.hasiOSFullScreen = !1);
    }
}, mejs.MediaFeatures.init(), mejs.HtmlMediaElement = {
    pluginType: "native",
    isFullScreen: !1,
    setCurrentTime: function(a) {
        this.currentTime = a;
    },
    setMuted: function(a) {
        this.muted = a;
    },
    setVolume: function(a) {
        this.volume = a;
    },
    stop: function() {
        this.pause();
    },
    setSrc: function(a) {
        for (var b = this.getElementsByTagName("source"); b.length > 0; ) this.removeChild(b[0]);
        if ("string" == typeof a) this.src = a; else {
            var c, d;
            for (c = 0; c < a.length; c++) if (d = a[c], this.canPlayType(d.type)) {
                this.src = d.src;
                break;
            }
        }
    },
    setVideoSize: function(a, b) {
        this.width = a, this.height = b;
    }
}, mejs.PluginMediaElement = function(a, b, c) {
    this.id = a, this.pluginType = b, this.src = c, this.events = {}, this.attributes = {};
}, mejs.PluginMediaElement.prototype = {
    pluginElement: null,
    pluginType: "",
    isFullScreen: !1,
    playbackRate: -1,
    defaultPlaybackRate: -1,
    seekable: [],
    played: [],
    paused: !0,
    ended: !1,
    seeking: !1,
    duration: 0,
    error: null,
    tagName: "",
    muted: !1,
    volume: 1,
    currentTime: 0,
    play: function() {
        null != this.pluginApi && ("youtube" == this.pluginType || "vimeo" == this.pluginType ? this.pluginApi.playVideo() : this.pluginApi.playMedia(), 
        this.paused = !1);
    },
    load: function() {
        null != this.pluginApi && ("youtube" == this.pluginType || "vimeo" == this.pluginType || this.pluginApi.loadMedia(), 
        this.paused = !1);
    },
    pause: function() {
        null != this.pluginApi && ("youtube" == this.pluginType || "vimeo" == this.pluginType ? 1 == this.pluginApi.getPlayerState() && this.pluginApi.pauseVideo() : this.pluginApi.pauseMedia(), 
        this.paused = !0);
    },
    stop: function() {
        null != this.pluginApi && ("youtube" == this.pluginType || "vimeo" == this.pluginType ? this.pluginApi.stopVideo() : this.pluginApi.stopMedia(), 
        this.paused = !0);
    },
    canPlayType: function(a) {
        var b, c, d, e = mejs.plugins[this.pluginType];
        for (b = 0; b < e.length; b++) if (d = e[b], mejs.PluginDetector.hasPluginVersion(this.pluginType, d.version)) for (c = 0; c < d.types.length; c++) if (a == d.types[c]) return "probably";
        return "";
    },
    positionFullscreenButton: function(a, b, c) {
        null != this.pluginApi && this.pluginApi.positionFullscreenButton && this.pluginApi.positionFullscreenButton(Math.floor(a), Math.floor(b), c);
    },
    hideFullscreenButton: function() {
        null != this.pluginApi && this.pluginApi.hideFullscreenButton && this.pluginApi.hideFullscreenButton();
    },
    setSrc: function(a) {
        if ("string" == typeof a) this.pluginApi.setSrc(mejs.Utility.absolutizeUrl(a)), 
        this.src = mejs.Utility.absolutizeUrl(a); else {
            var b, c;
            for (b = 0; b < a.length; b++) if (c = a[b], this.canPlayType(c.type)) {
                this.pluginApi.setSrc(mejs.Utility.absolutizeUrl(c.src)), this.src = mejs.Utility.absolutizeUrl(c.src);
                break;
            }
        }
    },
    setCurrentTime: function(a) {
        null != this.pluginApi && ("youtube" == this.pluginType || "vimeo" == this.pluginType ? this.pluginApi.seekTo(a) : this.pluginApi.setCurrentTime(a), 
        this.currentTime = a);
    },
    setVolume: function(a) {
        null != this.pluginApi && ("youtube" == this.pluginType ? this.pluginApi.setVolume(100 * a) : this.pluginApi.setVolume(a), 
        this.volume = a);
    },
    setMuted: function(a) {
        null != this.pluginApi && ("youtube" == this.pluginType ? (a ? this.pluginApi.mute() : this.pluginApi.unMute(), 
        this.muted = a, this.dispatchEvent({
            type: "volumechange"
        })) : this.pluginApi.setMuted(a), this.muted = a);
    },
    setVideoSize: function(a, b) {
        this.pluginElement && this.pluginElement.style && (this.pluginElement.style.width = a + "px", 
        this.pluginElement.style.height = b + "px"), null != this.pluginApi && this.pluginApi.setVideoSize && this.pluginApi.setVideoSize(a, b);
    },
    setFullscreen: function(a) {
        null != this.pluginApi && this.pluginApi.setFullscreen && this.pluginApi.setFullscreen(a);
    },
    enterFullScreen: function() {
        null != this.pluginApi && this.pluginApi.setFullscreen && this.setFullscreen(!0);
    },
    exitFullScreen: function() {
        null != this.pluginApi && this.pluginApi.setFullscreen && this.setFullscreen(!1);
    },
    addEventListener: function(a, b, c) {
        this.events[a] = this.events[a] || [], this.events[a].push(b);
    },
    removeEventListener: function(a, b) {
        if (!a) return this.events = {}, !0;
        var c = this.events[a];
        if (!c) return !0;
        if (!b) return this.events[a] = [], !0;
        for (var d = 0; d < c.length; d++) if (c[d] === b) return this.events[a].splice(d, 1), 
        !0;
        return !1;
    },
    dispatchEvent: function(a) {
        var b, c = this.events[a.type];
        if (c) for (b = 0; b < c.length; b++) c[b].apply(this, [ a ]);
    },
    hasAttribute: function(a) {
        return a in this.attributes;
    },
    removeAttribute: function(a) {
        delete this.attributes[a];
    },
    getAttribute: function(a) {
        return this.hasAttribute(a) ? this.attributes[a] : null;
    },
    setAttribute: function(a, b) {
        this.attributes[a] = b;
    },
    remove: function() {
        mejs.Utility.removeSwf(this.pluginElement.id);
    }
}, mejs.MediaElementDefaults = {
    mode: "auto",
    plugins: [ "flash", "silverlight", "youtube", "vimeo" ],
    enablePluginDebug: !1,
    httpsBasicAuthSite: !1,
    type: "",
    pluginPath: mejs.Utility.getScriptPath([ "mediaelement.js", "mediaelement.min.js", "mediaelement-and-player.js", "mediaelement-and-player.min.js" ]),
    flashName: "flashmediaelement.swf",
    flashStreamer: "",
    flashScriptAccess: "sameDomain",
    enablePluginSmoothing: !1,
    enablePseudoStreaming: !1,
    pseudoStreamingStartQueryParam: "start",
    silverlightName: "silverlightmediaelement.xap",
    defaultVideoWidth: 480,
    defaultVideoHeight: 270,
    pluginWidth: -1,
    pluginHeight: -1,
    pluginVars: [],
    timerRate: 250,
    startVolume: .8,
    customError: "",
    success: function() {},
    error: function() {}
}, mejs.MediaElement = function(a, b) {
    return mejs.HtmlMediaElementShim.create(a, b);
}, mejs.HtmlMediaElementShim = {
    create: function(a, b) {
        var c, d, e = {}, f = "string" == typeof a ? document.getElementById(a) : a, g = f.tagName.toLowerCase(), h = "audio" === g || "video" === g, i = h ? f.getAttribute("src") : f.getAttribute("href"), j = f.getAttribute("poster"), k = f.getAttribute("autoplay"), l = f.getAttribute("preload"), m = f.getAttribute("controls");
        for (d in mejs.MediaElementDefaults) e[d] = mejs.MediaElementDefaults[d];
        for (d in b) e[d] = b[d];
        return i = "undefined" == typeof i || null === i || "" == i ? null : i, j = "undefined" == typeof j || null === j ? "" : j, 
        l = "undefined" == typeof l || null === l || "false" === l ? "none" : l, k = !("undefined" == typeof k || null === k || "false" === k), 
        m = !("undefined" == typeof m || null === m || "false" === m), c = this.determinePlayback(f, e, mejs.MediaFeatures.supportsMediaTag, h, i), 
        c.url = null !== c.url ? mejs.Utility.absolutizeUrl(c.url) : "", c.scheme = mejs.Utility.determineScheme(c.url), 
        "native" == c.method ? (mejs.MediaFeatures.isBustedAndroid && (f.src = c.url, f.addEventListener("click", function() {
            f.play();
        }, !1)), this.updateNative(c, e, k, l)) : "" !== c.method ? this.createPlugin(c, e, j, k, l, m) : (this.createErrorMessage(c, e, j), 
        this);
    },
    determinePlayback: function(a, b, c, d, e) {
        var f, g, h, i, j, k, l, m, n, o, p, q = [], r = {
            method: "",
            url: "",
            htmlMediaElement: a,
            isVideo: "audio" !== a.tagName.toLowerCase(),
            scheme: ""
        };
        if ("undefined" != typeof b.type && "" !== b.type) if ("string" == typeof b.type) q.push({
            type: b.type,
            url: e
        }); else for (f = 0; f < b.type.length; f++) q.push({
            type: b.type[f],
            url: e
        }); else if (null !== e) k = this.formatType(e, a.getAttribute("type")), q.push({
            type: k,
            url: e
        }); else for (f = 0; f < a.childNodes.length; f++) j = a.childNodes[f], 1 == j.nodeType && "source" == j.tagName.toLowerCase() && (e = j.getAttribute("src"), 
        k = this.formatType(e, j.getAttribute("type")), p = j.getAttribute("media"), (!p || !window.matchMedia || window.matchMedia && window.matchMedia(p).matches) && q.push({
            type: k,
            url: e
        }));
        if (!d && q.length > 0 && null !== q[0].url && this.getTypeFromFile(q[0].url).indexOf("audio") > -1 && (r.isVideo = !1), 
        r.isVideo && mejs.MediaFeatures.isBustedAndroid && (a.canPlayType = function(a) {
            return null !== a.match(/video\/(mp4|m4v)/gi) ? "maybe" : "";
        }), r.isVideo && mejs.MediaFeatures.isChromium && (a.canPlayType = function(a) {
            return null !== a.match(/video\/(webm|ogv|ogg)/gi) ? "maybe" : "";
        }), c && ("auto" === b.mode || "auto_plugin" === b.mode || "native" === b.mode) && (!mejs.MediaFeatures.isBustedNativeHTTPS || b.httpsBasicAuthSite !== !0)) {
            for (d || (o = document.createElement(r.isVideo ? "video" : "audio"), a.parentNode.insertBefore(o, a), 
            a.style.display = "none", r.htmlMediaElement = a = o), f = 0; f < q.length; f++) if ("video/m3u8" == q[f].type || "" !== a.canPlayType(q[f].type).replace(/no/, "") || "" !== a.canPlayType(q[f].type.replace(/mp3/, "mpeg")).replace(/no/, "") || "" !== a.canPlayType(q[f].type.replace(/m4a/, "mp4")).replace(/no/, "")) {
                r.method = "native", r.url = q[f].url;
                break;
            }
            if ("native" === r.method && (null !== r.url && (a.src = r.url), "auto_plugin" !== b.mode)) return r;
        }
        if ("auto" === b.mode || "auto_plugin" === b.mode || "shim" === b.mode) for (f = 0; f < q.length; f++) for (k = q[f].type, 
        g = 0; g < b.plugins.length; g++) for (l = b.plugins[g], m = mejs.plugins[l], h = 0; h < m.length; h++) if (n = m[h], 
        null == n.version || mejs.PluginDetector.hasPluginVersion(l, n.version)) for (i = 0; i < n.types.length; i++) if (k.toLowerCase() == n.types[i].toLowerCase()) return r.method = l, 
        r.url = q[f].url, r;
        return "auto_plugin" === b.mode && "native" === r.method ? r : ("" === r.method && q.length > 0 && (r.url = q[0].url), 
        r);
    },
    formatType: function(a, b) {
        return a && !b ? this.getTypeFromFile(a) : b && ~b.indexOf(";") ? b.substr(0, b.indexOf(";")) : b;
    },
    getTypeFromFile: function(a) {
        a = a.split("?")[0];
        var b = a.substring(a.lastIndexOf(".") + 1).toLowerCase(), c = /(mp4|m4v|ogg|ogv|m3u8|webm|webmv|flv|wmv|mpeg|mov)/gi.test(b) ? "video/" : "audio/";
        return this.getTypeFromExtension(b, c);
    },
    getTypeFromExtension: function(a, b) {
        switch (b = b || "", a) {
          case "mp4":
          case "m4v":
          case "m4a":
          case "f4v":
          case "f4a":
            return b + "mp4";

          case "flv":
            return b + "x-flv";

          case "webm":
          case "webma":
          case "webmv":
            return b + "webm";

          case "ogg":
          case "oga":
          case "ogv":
            return b + "ogg";

          case "m3u8":
            return "application/x-mpegurl";

          case "ts":
            return b + "mp2t";

          default:
            return b + a;
        }
    },
    createErrorMessage: function(a, b, c) {
        var d = a.htmlMediaElement, e = document.createElement("div"), f = b.customError;
        e.className = "me-cannotplay";
        try {
            e.style.width = d.width + "px", e.style.height = d.height + "px";
        } catch (g) {}
        f || (f = '<a href="' + a.url + '">', "" !== c && (f += '<img src="' + c + '" width="100%" height="100%" alt="" />'), 
        f += "<span>" + mejs.i18n.t("mejs.download-file") + "</span></a>"), e.innerHTML = f, 
        d.parentNode.insertBefore(e, d), d.style.display = "none", b.error(d);
    },
    createPlugin: function(a, b, c, d, e, f) {
        var g, h, i, j = a.htmlMediaElement, k = 1, l = 1, m = "me_" + a.method + "_" + mejs.meIndex++, n = new mejs.PluginMediaElement(m, a.method, a.url), o = document.createElement("div");
        n.tagName = j.tagName;
        for (var p = 0; p < j.attributes.length; p++) {
            var q = j.attributes[p];
            q.specified && n.setAttribute(q.name, q.value);
        }
        for (h = j.parentNode; null !== h && null != h.tagName && "body" !== h.tagName.toLowerCase() && null != h.parentNode && null != h.parentNode.tagName && null != h.parentNode.constructor && "ShadowRoot" === h.parentNode.constructor.name; ) {
            if ("p" === h.parentNode.tagName.toLowerCase()) {
                h.parentNode.parentNode.insertBefore(h, h.parentNode);
                break;
            }
            h = h.parentNode;
        }
        if (a.isVideo ? (k = b.pluginWidth > 0 ? b.pluginWidth : b.videoWidth > 0 ? b.videoWidth : null !== j.getAttribute("width") ? j.getAttribute("width") : b.defaultVideoWidth, 
        l = b.pluginHeight > 0 ? b.pluginHeight : b.videoHeight > 0 ? b.videoHeight : null !== j.getAttribute("height") ? j.getAttribute("height") : b.defaultVideoHeight, 
        k = mejs.Utility.encodeUrl(k), l = mejs.Utility.encodeUrl(l)) : b.enablePluginDebug && (k = 320, 
        l = 240), n.success = b.success, o.className = "me-plugin", o.id = m + "_container", 
        a.isVideo ? j.parentNode.insertBefore(o, j) : document.body.insertBefore(o, document.body.childNodes[0]), 
        "flash" === a.method || "silverlight" === a.method) {
            var r = "audio/mp4" === j.getAttribute("type"), s = j.getElementsByTagName("source");
            if (s && !r) for (var p = 0, t = s.length; t > p; p++) "audio/mp4" === s[p].getAttribute("type") && (r = !0);
            i = [ "id=" + m, "isvideo=" + (a.isVideo || r ? "true" : "false"), "autoplay=" + (d ? "true" : "false"), "preload=" + e, "width=" + k, "startvolume=" + b.startVolume, "timerrate=" + b.timerRate, "flashstreamer=" + b.flashStreamer, "height=" + l, "pseudostreamstart=" + b.pseudoStreamingStartQueryParam ], 
            null !== a.url && ("flash" == a.method ? i.push("file=" + mejs.Utility.encodeUrl(a.url)) : i.push("file=" + a.url)), 
            b.enablePluginDebug && i.push("debug=true"), b.enablePluginSmoothing && i.push("smoothing=true"), 
            b.enablePseudoStreaming && i.push("pseudostreaming=true"), f && i.push("controls=true"), 
            b.pluginVars && (i = i.concat(b.pluginVars)), window[m + "_init"] = function() {
                switch (n.pluginType) {
                  case "flash":
                    n.pluginElement = n.pluginApi = document.getElementById(m);
                    break;

                  case "silverlight":
                    n.pluginElement = document.getElementById(n.id), n.pluginApi = n.pluginElement.Content.MediaElementJS;
                }
                null != n.pluginApi && n.success && n.success(n, j);
            }, window[m + "_event"] = function(a, b) {
                var c, d, e;
                c = {
                    type: a,
                    target: n
                };
                for (d in b) n[d] = b[d], c[d] = b[d];
                e = b.bufferedTime || 0, c.target.buffered = c.buffered = {
                    start: function(a) {
                        return 0;
                    },
                    end: function(a) {
                        return e;
                    },
                    length: 1
                }, n.dispatchEvent(c);
            };
        }
        switch (a.method) {
          case "silverlight":
            o.innerHTML = '<object data="data:application/x-silverlight-2," type="application/x-silverlight-2" id="' + m + '" name="' + m + '" width="' + k + '" height="' + l + '" class="mejs-shim"><param name="initParams" value="' + i.join(",") + '" /><param name="windowless" value="true" /><param name="background" value="black" /><param name="minRuntimeVersion" value="3.0.0.0" /><param name="autoUpgrade" value="true" /><param name="source" value="' + b.pluginPath + b.silverlightName + '" /></object>';
            break;

          case "flash":
            mejs.MediaFeatures.isIE ? (g = document.createElement("div"), o.appendChild(g), 
            g.outerHTML = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="//download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab" id="' + m + '" width="' + k + '" height="' + l + '" class="mejs-shim"><param name="movie" value="' + b.pluginPath + b.flashName + "?" + new Date().getTime() + '" /><param name="flashvars" value="' + i.join("&amp;") + '" /><param name="quality" value="high" /><param name="bgcolor" value="#000000" /><param name="wmode" value="transparent" /><param name="allowScriptAccess" value="' + b.flashScriptAccess + '" /><param name="allowFullScreen" value="true" /><param name="scale" value="default" /></object>') : o.innerHTML = '<embed id="' + m + '" name="' + m + '" play="true" loop="false" quality="high" bgcolor="#000000" wmode="transparent" allowScriptAccess="' + b.flashScriptAccess + '" allowFullScreen="true" type="application/x-shockwave-flash" pluginspage="//www.macromedia.com/go/getflashplayer" src="' + b.pluginPath + b.flashName + '" flashvars="' + i.join("&") + '" width="' + k + '" height="' + l + '" scale="default"class="mejs-shim"></embed>';
            break;

          case "youtube":
            var u;
            if (-1 != a.url.lastIndexOf("youtu.be")) u = a.url.substr(a.url.lastIndexOf("/") + 1), 
            -1 != u.indexOf("?") && (u = u.substr(0, u.indexOf("?"))); else {
                var v = a.url.match(/[?&]v=([^&#]+)|&|#|$/);
                v && (u = v[1]);
            }
            youtubeSettings = {
                container: o,
                containerId: o.id,
                pluginMediaElement: n,
                pluginId: m,
                videoId: u,
                height: l,
                width: k,
                scheme: a.scheme,
                variables: b.youtubeIframeVars
            }, window.postMessage ? mejs.YouTubeApi.enqueueIframe(youtubeSettings) : mejs.PluginDetector.hasPluginVersion("flash", [ 10, 0, 0 ]) && mejs.YouTubeApi.createFlash(youtubeSettings, b);
            break;

          case "vimeo":
            var w = m + "_player";
            if (n.vimeoid = a.url.substr(a.url.lastIndexOf("/") + 1), o.innerHTML = '<iframe src="' + a.scheme + "player.vimeo.com/video/" + n.vimeoid + "?api=1&portrait=0&byline=0&title=0&player_id=" + w + '" width="' + k + '" height="' + l + '" frameborder="0" class="mejs-shim" id="' + w + '" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>', 
            "function" == typeof $f) {
                var x = $f(o.childNodes[0]), y = -1;
                x.addEvent("ready", function() {
                    function a(a, b, c, d) {
                        var e = {
                            type: c,
                            target: b
                        };
                        "timeupdate" == c && (b.currentTime = e.currentTime = d.seconds, b.duration = e.duration = d.duration), 
                        b.dispatchEvent(e);
                    }
                    x.playVideo = function() {
                        x.api("play");
                    }, x.stopVideo = function() {
                        x.api("unload");
                    }, x.pauseVideo = function() {
                        x.api("pause");
                    }, x.seekTo = function(a) {
                        x.api("seekTo", a);
                    }, x.setVolume = function(a) {
                        x.api("setVolume", a);
                    }, x.setMuted = function(a) {
                        a ? (x.lastVolume = x.api("getVolume"), x.api("setVolume", 0)) : (x.api("setVolume", x.lastVolume), 
                        delete x.lastVolume);
                    }, x.getPlayerState = function() {
                        return y;
                    }, x.addEvent("play", function() {
                        y = 1, a(x, n, "play"), a(x, n, "playing");
                    }), x.addEvent("pause", function() {
                        y = 2, a(x, n, "pause");
                    }), x.addEvent("finish", function() {
                        y = 0, a(x, n, "ended");
                    }), x.addEvent("playProgress", function(b) {
                        a(x, n, "timeupdate", b);
                    }), x.addEvent("seek", function(b) {
                        y = 3, a(x, n, "seeked", b);
                    }), x.addEvent("loadProgress", function(b) {
                        y = 3, a(x, n, "progress", b);
                    }), n.pluginElement = o, n.pluginApi = x, n.success(n, n.pluginElement);
                });
            } else console.warn("You need to include froogaloop for vimeo to work");
        }
        return j.style.display = "none", j.removeAttribute("autoplay"), n;
    },
    updateNative: function(a, b, c, d) {
        var e, f = a.htmlMediaElement;
        for (e in mejs.HtmlMediaElement) f[e] = mejs.HtmlMediaElement[e];
        return b.success(f, f), f;
    }
}, mejs.YouTubeApi = {
    isIframeStarted: !1,
    isIframeLoaded: !1,
    loadIframeApi: function(a) {
        if (!this.isIframeStarted) {
            var b = document.createElement("script");
            b.src = a.scheme + "www.youtube.com/player_api";
            var c = document.getElementsByTagName("script")[0];
            c.parentNode.insertBefore(b, c), this.isIframeStarted = !0;
        }
    },
    iframeQueue: [],
    enqueueIframe: function(a) {
        this.isLoaded ? this.createIframe(a) : (this.loadIframeApi(a), this.iframeQueue.push(a));
    },
    createIframe: function(a) {
        var b = a.pluginMediaElement, c = {
            controls: 0,
            wmode: "transparent"
        }, d = new YT.Player(a.containerId, {
            height: a.height,
            width: a.width,
            videoId: a.videoId,
            playerVars: mejs.$.extend({}, c, a.variables),
            events: {
                onReady: function(c) {
                    d.setVideoSize = function(a, b) {
                        d.setSize(a, b);
                    }, a.pluginMediaElement.pluginApi = d, a.pluginMediaElement.pluginElement = document.getElementById(a.containerId), 
                    b.success(b, b.pluginElement), mejs.YouTubeApi.createEvent(d, b, "canplay"), setInterval(function() {
                        mejs.YouTubeApi.createEvent(d, b, "timeupdate");
                    }, 250), "undefined" != typeof b.attributes.autoplay && d.playVideo();
                },
                onStateChange: function(a) {
                    mejs.YouTubeApi.handleStateChange(a.data, d, b);
                }
            }
        });
    },
    createEvent: function(a, b, c) {
        var d = {
            type: c,
            target: b
        };
        if (a && a.getDuration) {
            b.currentTime = d.currentTime = a.getCurrentTime(), b.duration = d.duration = a.getDuration(), 
            d.paused = b.paused, d.ended = b.ended, d.muted = a.isMuted(), d.volume = a.getVolume() / 100, 
            d.bytesTotal = a.getVideoBytesTotal(), d.bufferedBytes = a.getVideoBytesLoaded();
            var e = d.bufferedBytes / d.bytesTotal * d.duration;
            d.target.buffered = d.buffered = {
                start: function(a) {
                    return 0;
                },
                end: function(a) {
                    return e;
                },
                length: 1
            };
        }
        b.dispatchEvent(d);
    },
    iFrameReady: function() {
        for (this.isLoaded = !0, this.isIframeLoaded = !0; this.iframeQueue.length > 0; ) {
            var a = this.iframeQueue.pop();
            this.createIframe(a);
        }
    },
    flashPlayers: {},
    createFlash: function(a) {
        this.flashPlayers[a.pluginId] = a;
        var b, c = a.scheme + "www.youtube.com/apiplayer?enablejsapi=1&amp;playerapiid=" + a.pluginId + "&amp;version=3&amp;autoplay=0&amp;controls=0&amp;modestbranding=1&loop=0";
        mejs.MediaFeatures.isIE ? (b = document.createElement("div"), a.container.appendChild(b), 
        b.outerHTML = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="' + a.scheme + 'download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab" id="' + a.pluginId + '" width="' + a.width + '" height="' + a.height + '" class="mejs-shim"><param name="movie" value="' + c + '" /><param name="wmode" value="transparent" /><param name="allowScriptAccess" value="' + options.flashScriptAccess + '" /><param name="allowFullScreen" value="true" /></object>') : a.container.innerHTML = '<object type="application/x-shockwave-flash" id="' + a.pluginId + '" data="' + c + '" width="' + a.width + '" height="' + a.height + '" style="visibility: visible; " class="mejs-shim"><param name="allowScriptAccess" value="' + options.flashScriptAccess + '"><param name="wmode" value="transparent"></object>';
    },
    flashReady: function(a) {
        var b = this.flashPlayers[a], c = document.getElementById(a), d = b.pluginMediaElement;
        d.pluginApi = d.pluginElement = c, b.success(d, d.pluginElement), c.cueVideoById(b.videoId);
        var e = b.containerId + "_callback";
        window[e] = function(a) {
            mejs.YouTubeApi.handleStateChange(a, c, d);
        }, c.addEventListener("onStateChange", e), setInterval(function() {
            mejs.YouTubeApi.createEvent(c, d, "timeupdate");
        }, 250), mejs.YouTubeApi.createEvent(c, d, "canplay");
    },
    handleStateChange: function(a, b, c) {
        switch (a) {
          case -1:
            c.paused = !0, c.ended = !0, mejs.YouTubeApi.createEvent(b, c, "loadedmetadata");
            break;

          case 0:
            c.paused = !1, c.ended = !0, mejs.YouTubeApi.createEvent(b, c, "ended");
            break;

          case 1:
            c.paused = !1, c.ended = !1, mejs.YouTubeApi.createEvent(b, c, "play"), mejs.YouTubeApi.createEvent(b, c, "playing");
            break;

          case 2:
            c.paused = !0, c.ended = !1, mejs.YouTubeApi.createEvent(b, c, "pause");
            break;

          case 3:
            mejs.YouTubeApi.createEvent(b, c, "progress");
            break;

          case 5:
        }
    }
}, window.onYouTubePlayerAPIReady = function() {
    mejs.YouTubeApi.iFrameReady();
}, window.onYouTubePlayerReady = function(a) {
    mejs.YouTubeApi.flashReady(a);
}, window.mejs = mejs, window.MediaElement = mejs.MediaElement, function(a, b, c, d) {
    var e = {
        default: "en",
        locale: {
            language: c.i18n && c.i18n.locale.language || "",
            strings: c.i18n && c.i18n.locale.strings || {}
        },
        pluralForms: [ function() {
            return arguments[1];
        }, function() {
            var a = arguments;
            return 1 === a[0] ? a[1] : a[2];
        }, function() {
            var a = arguments;
            return [ 0, 1 ].indexOf(a[0]) > -1 ? a[1] : a[2];
        }, function() {
            var a = arguments;
            return a[0] % 10 === 1 && a[0] % 100 !== 11 ? a[1] : 0 !== a[0] ? a[2] : a[3];
        }, function() {
            var a = arguments;
            return 1 === a[0] || 11 === a[0] ? a[1] : 2 === a[0] || 12 === a[0] ? a[2] : a[0] > 2 && a[0] < 20 ? a[3] : a[4];
        }, function() {
            return 1 === args[0] ? args[1] : 0 === args[0] || args[0] % 100 > 0 && args[0] % 100 < 20 ? args[2] : args[3];
        }, function() {
            var a = arguments;
            return a[0] % 10 === 1 && a[0] % 100 !== 11 ? a[1] : a[0] % 10 >= 2 && (a[0] % 100 < 10 || a[0] % 100 >= 20) ? a[2] : [ 3 ];
        }, function() {
            var a = arguments;
            return a[0] % 10 === 1 && a[0] % 100 !== 11 ? a[1] : a[0] % 10 >= 2 && a[0] % 10 <= 4 && (a[0] % 100 < 10 || a[0] % 100 >= 20) ? a[2] : a[3];
        }, function() {
            var a = arguments;
            return 1 === a[0] ? a[1] : a[0] >= 2 && a[0] <= 4 ? a[2] : a[3];
        }, function() {
            var a = arguments;
            return 1 === a[0] ? a[1] : a[0] % 10 >= 2 && a[0] % 10 <= 4 && (a[0] % 100 < 10 || a[0] % 100 >= 20) ? a[2] : a[3];
        }, function() {
            var a = arguments;
            return a[0] % 100 === 1 ? a[2] : a[0] % 100 === 2 ? a[3] : a[0] % 100 === 3 || a[0] % 100 === 4 ? a[4] : a[1];
        }, function() {
            var a = arguments;
            return 1 === a[0] ? a[1] : 2 === a[0] ? a[2] : a[0] > 2 && a[0] < 7 ? a[3] : a[0] > 6 && a[0] < 11 ? a[4] : a[5];
        }, function() {
            var a = arguments;
            return 0 === a[0] ? a[1] : 1 === a[0] ? a[2] : 2 === a[0] ? a[3] : a[0] % 100 >= 3 && a[0] % 100 <= 10 ? a[4] : a[0] % 100 >= 11 ? a[5] : a[6];
        }, function() {
            var a = arguments;
            return 1 === a[0] ? a[1] : 0 === a[0] || a[0] % 100 > 1 && a[0] % 100 < 11 ? a[2] : a[0] % 100 > 10 && a[0] % 100 < 20 ? a[3] : a[4];
        }, function() {
            var a = arguments;
            return a[0] % 10 === 1 ? a[1] : a[0] % 10 === 2 ? a[2] : a[3];
        }, function() {
            var a = arguments;
            return 11 !== a[0] && a[0] % 10 === 1 ? a[1] : a[2];
        }, function() {
            var a = arguments;
            return 1 === a[0] ? a[1] : a[0] % 10 >= 2 && a[0] % 10 <= 4 && (a[0] % 100 < 10 || a[0] % 100 >= 20) ? a[2] : a[3];
        }, function() {
            var a = arguments;
            return 1 === a[0] ? a[1] : 2 === a[0] ? a[2] : 8 !== a[0] && 11 !== a[0] ? a[3] : a[4];
        }, function() {
            var a = arguments;
            return 0 === a[0] ? a[1] : a[2];
        }, function() {
            var a = arguments;
            return 1 === a[0] ? a[1] : 2 === a[0] ? a[2] : 3 === a[0] ? a[3] : a[4];
        }, function() {
            var a = arguments;
            return 0 === a[0] ? a[1] : 1 === a[0] ? a[2] : a[3];
        } ],
        getLanguage: function() {
            var a = e.locale.language || e["default"];
            return /^(x\-)?[a-z]{2,}(\-\w{2,})?(\-\w{2,})?$/.exec(a) ? a : e["default"];
        },
        t: function(a, b) {
            if ("string" == typeof a && a.length) {
                var c, d, f = e.getLanguage(), g = function(a, b, c) {
                    return "object" != typeof a || "number" != typeof b || "number" != typeof c ? a : "string" == typeof a ? a : e.pluralForms[c].apply(null, [ b ].concat(a));
                }, h = function(a) {
                    var b = {
                        "&": "&amp;",
                        "<": "&lt;",
                        ">": "&gt;",
                        '"': "&quot;"
                    };
                    return a.replace(/[&<>"]/g, function(a) {
                        return b[a];
                    });
                };
                return e.locale.strings && e.locale.strings[f] && (c = e.locale.strings[f][a], "number" == typeof b && (d = e.locale.strings[f]["mejs.plural-form"], 
                c = g.apply(null, [ c, b, d ]))), !c && e.locale.strings && e.locale.strings[e["default"]] && (c = e.locale.strings[e["default"]][a], 
                "number" == typeof b && (d = e.locale.strings[e["default"]]["mejs.plural-form"], 
                c = g.apply(null, [ c, b, d ]))), c = c || a, "number" == typeof b && (c = c.replace("%1", b)), 
                h(c);
            }
            return a;
        }
    };
    "undefined" != typeof mejsL10n && (e.locale.language = mejsL10n.language), c.i18n = e;
}(document, window, mejs), function(a, b) {
    "use strict";
    "undefined" != typeof mejsL10n && (a[mejsL10n.lang] = mejsL10n.strings);
}(mejs.i18n.locale.strings), function(a) {
    "use strict";
    void 0 === a.en && (a.en = {
        "mejs.plural-form": 1,
        "mejs.download-file": "Download File",
        "mejs.fullscreen-off": "Turn off Fullscreen",
        "mejs.fullscreen-on": "Go Fullscreen",
        "mejs.download-video": "Download Video",
        "mejs.fullscreen": "Fullscreen",
        "mejs.time-jump-forward": [ "Jump forward 1 second", "Jump forward %1 seconds" ],
        "mejs.play": "Play",
        "mejs.pause": "Pause",
        "mejs.close": "Close",
        "mejs.time-slider": "Time Slider",
        "mejs.time-help-text": "Use Left/Right Arrow keys to advance one second, Up/Down arrows to advance ten seconds.",
        "mejs.time-skip-back": [ "Skip back 1 second", "Skip back %1 seconds" ],
        "mejs.captions-subtitles": "Captions/Subtitles",
        "mejs.none": "None",
        "mejs.mute-toggle": "Mute Toggle",
        "mejs.volume-help-text": "Use Up/Down Arrow keys to increase or decrease volume.",
        "mejs.unmute": "Unmute",
        "mejs.mute": "Mute",
        "mejs.volume-slider": "Volume Slider",
        "mejs.video-player": "Video Player",
        "mejs.audio-player": "Audio Player",
        "mejs.ad-skip": "Skip ad",
        "mejs.ad-skip-info": [ "Skip in 1 second", "Skip in %1 seconds" ],
        "mejs.source-chooser": "Source Chooser"
    });
}(mejs.i18n.locale.strings), "undefined" != typeof jQuery ? mejs.$ = jQuery : "undefined" != typeof Zepto ? (mejs.$ = Zepto, 
Zepto.fn.outerWidth = function(a) {
    var b = $(this).width();
    return a && (b += parseInt($(this).css("margin-right"), 10), b += parseInt($(this).css("margin-left"), 10)), 
    b;
}) : "undefined" != typeof ender && (mejs.$ = ender), function(a) {
    mejs.MepDefaults = {
        poster: "",
        showPosterWhenEnded: !1,
        defaultVideoWidth: 480,
        defaultVideoHeight: 270,
        videoWidth: -1,
        videoHeight: -1,
        defaultAudioWidth: 400,
        defaultAudioHeight: 30,
        defaultSeekBackwardInterval: function(a) {
            return .05 * a.duration;
        },
        defaultSeekForwardInterval: function(a) {
            return .05 * a.duration;
        },
        setDimensions: !0,
        audioWidth: -1,
        audioHeight: -1,
        startVolume: .8,
        loop: !1,
        autoRewind: !0,
        enableAutosize: !0,
        timeFormat: "",
        alwaysShowHours: !1,
        showTimecodeFrameCount: !1,
        framesPerSecond: 25,
        autosizeProgress: !0,
        alwaysShowControls: !1,
        hideVideoControlsOnLoad: !1,
        clickToPlayPause: !0,
        controlsTimeoutDefault: 1500,
        controlsTimeoutMouseEnter: 2500,
        controlsTimeoutMouseLeave: 1e3,
        iPadUseNativeControls: !1,
        iPhoneUseNativeControls: !1,
        AndroidUseNativeControls: !1,
        features: [ "playpause", "current", "progress", "duration", "tracks", "volume", "fullscreen" ],
        isVideo: !0,
        stretching: "auto",
        enableKeyboard: !0,
        pauseOtherPlayers: !0,
        keyActions: [ {
            keys: [ 32, 179 ],
            action: function(a, b, c, d) {
                mejs.MediaFeatures.isFirefox || (b.paused || b.ended ? b.play() : b.pause());
            }
        }, {
            keys: [ 38 ],
            action: function(a, b, c, d) {
                a.container.find(".mejs-volume-slider").css("display", "block"), a.isVideo && (a.showControls(), 
                a.startControlsTimer());
                var e = Math.min(b.volume + .1, 1);
                b.setVolume(e);
            }
        }, {
            keys: [ 40 ],
            action: function(a, b, c, d) {
                a.container.find(".mejs-volume-slider").css("display", "block"), a.isVideo && (a.showControls(), 
                a.startControlsTimer());
                var e = Math.max(b.volume - .1, 0);
                b.setVolume(e);
            }
        }, {
            keys: [ 37, 227 ],
            action: function(a, b, c, d) {
                if (!isNaN(b.duration) && b.duration > 0) {
                    a.isVideo && (a.showControls(), a.startControlsTimer());
                    var e = Math.max(b.currentTime - a.options.defaultSeekBackwardInterval(b), 0);
                    b.setCurrentTime(e);
                }
            }
        }, {
            keys: [ 39, 228 ],
            action: function(a, b, c, d) {
                if (!isNaN(b.duration) && b.duration > 0) {
                    a.isVideo && (a.showControls(), a.startControlsTimer());
                    var e = Math.min(b.currentTime + a.options.defaultSeekForwardInterval(b), b.duration);
                    b.setCurrentTime(e);
                }
            }
        }, {
            keys: [ 70 ],
            action: function(a, b, c, d) {
                "undefined" != typeof a.enterFullScreen && (a.isFullScreen ? a.exitFullScreen() : a.enterFullScreen());
            }
        }, {
            keys: [ 77 ],
            action: function(a, b, c, d) {
                a.container.find(".mejs-volume-slider").css("display", "block"), a.isVideo && (a.showControls(), 
                a.startControlsTimer()), a.media.muted ? a.setMuted(!1) : a.setMuted(!0);
            }
        } ]
    }, mejs.mepIndex = 0, mejs.players = {}, mejs.MediaElementPlayer = function(b, c) {
        if (!(this instanceof mejs.MediaElementPlayer)) return new mejs.MediaElementPlayer(b, c);
        var d = this;
        return d.$media = d.$node = a(b), d.node = d.media = d.$media[0], d.node ? "undefined" != typeof d.node.player ? d.node.player : ("undefined" == typeof c && (c = d.$node.data("mejsoptions")), 
        d.options = a.extend({}, mejs.MepDefaults, c), d.options.timeFormat || (d.options.timeFormat = "mm:ss", 
        d.options.alwaysShowHours && (d.options.timeFormat = "hh:mm:ss"), d.options.showTimecodeFrameCount && (d.options.timeFormat += ":ff")), 
        mejs.Utility.calculateTimeFormat(0, d.options, d.options.framesPerSecond || 25), 
        d.id = "mep_" + mejs.mepIndex++, mejs.players[d.id] = d, d.init(), d) : void 0;
    }, mejs.MediaElementPlayer.prototype = {
        hasFocus: !1,
        controlsAreVisible: !0,
        init: function() {
            var b = this, c = mejs.MediaFeatures, d = a.extend(!0, {}, b.options, {
                success: function(a, c) {
                    b.meReady(a, c);
                },
                error: function(a) {
                    b.handleError(a);
                }
            }), e = b.media.tagName.toLowerCase();
            if (b.isDynamic = "audio" !== e && "video" !== e, b.isDynamic ? b.isVideo = b.options.isVideo : b.isVideo = "audio" !== e && b.options.isVideo, 
            c.isiPad && b.options.iPadUseNativeControls || c.isiPhone && b.options.iPhoneUseNativeControls) b.$media.attr("controls", "controls"), 
            c.isiPad && null !== b.media.getAttribute("autoplay") && b.play(); else if (c.isAndroid && b.options.AndroidUseNativeControls) ; else if (b.isVideo || !b.isVideo && b.options.features.length) {
                b.$media.removeAttr("controls");
                var f = b.isVideo ? mejs.i18n.t("mejs.video-player") : mejs.i18n.t("mejs.audio-player");
                a('<span class="mejs-offscreen">' + f + "</span>").insertBefore(b.$media), b.container = a('<div id="' + b.id + '" class="mejs-container ' + (mejs.MediaFeatures.svgAsImg ? "svg" : "no-svg") + '" tabindex="0" role="application" aria-label="' + f + '"><div class="mejs-inner"><div class="mejs-mediaelement"></div><div class="mejs-layers"></div><div class="mejs-controls"></div><div class="mejs-clear"></div></div></div>').addClass(b.$media[0].className).insertBefore(b.$media).focus(function(a) {
                    if (!b.controlsAreVisible && !b.hasFocus && b.controlsEnabled && (b.showControls(!0), 
                    !b.hasMsNativeFullScreen)) {
                        var c = ".mejs-playpause-button > button";
                        mejs.Utility.isNodeAfter(a.relatedTarget, b.container[0]) && (c = ".mejs-controls .mejs-button:last-child > button");
                        var d = b.container.find(c);
                        d.focus();
                    }
                }), b.options.features.length || b.container.css("background", "transparent").find(".mejs-controls").hide(), 
                b.isVideo && "fill" === b.options.stretching && !b.container.parent("mejs-fill-container").length && (b.outerContainer = b.$media.parent(), 
                b.container.wrap('<div class="mejs-fill-container"/>')), b.container.addClass((c.isAndroid ? "mejs-android " : "") + (c.isiOS ? "mejs-ios " : "") + (c.isiPad ? "mejs-ipad " : "") + (c.isiPhone ? "mejs-iphone " : "") + (b.isVideo ? "mejs-video " : "mejs-audio ")), 
                b.container.find(".mejs-mediaelement").append(b.$media), b.node.player = b, b.controls = b.container.find(".mejs-controls"), 
                b.layers = b.container.find(".mejs-layers");
                var g = b.isVideo ? "video" : "audio", h = g.substring(0, 1).toUpperCase() + g.substring(1);
                b.options[g + "Width"] > 0 || b.options[g + "Width"].toString().indexOf("%") > -1 ? b.width = b.options[g + "Width"] : "" !== b.media.style.width && null !== b.media.style.width ? b.width = b.media.style.width : null !== b.media.getAttribute("width") ? b.width = b.$media.attr("width") : b.width = b.options["default" + h + "Width"], 
                b.options[g + "Height"] > 0 || b.options[g + "Height"].toString().indexOf("%") > -1 ? b.height = b.options[g + "Height"] : "" !== b.media.style.height && null !== b.media.style.height ? b.height = b.media.style.height : null !== b.$media[0].getAttribute("height") ? b.height = b.$media.attr("height") : b.height = b.options["default" + h + "Height"], 
                b.setPlayerSize(b.width, b.height), d.pluginWidth = b.width, d.pluginHeight = b.height;
            } else b.isVideo || b.options.features.length || b.$media.hide();
            mejs.MediaElement(b.$media[0], d), "undefined" != typeof b.container && b.options.features.length && b.controlsAreVisible && b.container.trigger("controlsshown");
        },
        showControls: function(a) {
            var b = this;
            a = "undefined" == typeof a || a, b.controlsAreVisible || (a ? (b.controls.removeClass("mejs-offscreen").stop(!0, !0).fadeIn(200, function() {
                b.controlsAreVisible = !0, b.container.trigger("controlsshown");
            }), b.container.find(".mejs-control").removeClass("mejs-offscreen").stop(!0, !0).fadeIn(200, function() {
                b.controlsAreVisible = !0;
            })) : (b.controls.removeClass("mejs-offscreen").css("display", "block"), b.container.find(".mejs-control").removeClass("mejs-offscreen").css("display", "block"), 
            b.controlsAreVisible = !0, b.container.trigger("controlsshown")), b.setControlsSize());
        },
        hideControls: function(b) {
            var c = this;
            b = "undefined" == typeof b || b, !c.controlsAreVisible || c.options.alwaysShowControls || c.keyboardAction || c.media.paused || c.media.ended || (b ? (c.controls.stop(!0, !0).fadeOut(200, function() {
                a(this).addClass("mejs-offscreen").css("display", "block"), c.controlsAreVisible = !1, 
                c.container.trigger("controlshidden");
            }), c.container.find(".mejs-control").stop(!0, !0).fadeOut(200, function() {
                a(this).addClass("mejs-offscreen").css("display", "block");
            })) : (c.controls.addClass("mejs-offscreen").css("display", "block"), c.container.find(".mejs-control").addClass("mejs-offscreen").css("display", "block"), 
            c.controlsAreVisible = !1, c.container.trigger("controlshidden")));
        },
        controlsTimer: null,
        startControlsTimer: function(a) {
            var b = this;
            a = "undefined" != typeof a ? a : b.options.controlsTimeoutDefault, b.killControlsTimer("start"), 
            b.controlsTimer = setTimeout(function() {
                b.hideControls(), b.killControlsTimer("hide");
            }, a);
        },
        killControlsTimer: function(a) {
            var b = this;
            null !== b.controlsTimer && (clearTimeout(b.controlsTimer), delete b.controlsTimer, 
            b.controlsTimer = null);
        },
        controlsEnabled: !0,
        disableControls: function() {
            var a = this;
            a.killControlsTimer(), a.hideControls(!1), this.controlsEnabled = !1;
        },
        enableControls: function() {
            var a = this;
            a.showControls(!1), a.controlsEnabled = !0;
        },
        meReady: function(b, c) {
            var d, e, f = this, g = mejs.MediaFeatures, h = c.getAttribute("autoplay"), i = !("undefined" == typeof h || null === h || "false" === h);
            if (!f.created) {
                if (f.created = !0, f.media = b, f.domNode = c, !(g.isAndroid && f.options.AndroidUseNativeControls || g.isiPad && f.options.iPadUseNativeControls || g.isiPhone && f.options.iPhoneUseNativeControls)) {
                    if (!f.isVideo && !f.options.features.length) return i && "native" == b.pluginType && f.play(), 
                    void (f.options.success && ("string" == typeof f.options.success ? window[f.options.success](f.media, f.domNode, f) : f.options.success(f.media, f.domNode, f)));
                    f.buildposter(f, f.controls, f.layers, f.media), f.buildkeyboard(f, f.controls, f.layers, f.media), 
                    f.buildoverlays(f, f.controls, f.layers, f.media), f.findTracks();
                    for (d in f.options.features) if (e = f.options.features[d], f["build" + e]) try {
                        f["build" + e](f, f.controls, f.layers, f.media);
                    } catch (j) {}
                    f.container.trigger("controlsready"), f.setPlayerSize(f.width, f.height), f.setControlsSize(), 
                    f.isVideo && (mejs.MediaFeatures.hasTouch && !f.options.alwaysShowControls ? f.$media.bind("touchstart", function() {
                        f.controlsAreVisible ? f.hideControls(!1) : f.controlsEnabled && f.showControls(!1);
                    }) : (f.clickToPlayPauseCallback = function() {
                        if (f.options.clickToPlayPause) {
                            f.media.paused ? f.play() : f.pause();
                            var a = f.$media.closest(".mejs-container").find(".mejs-overlay-button"), b = a.attr("aria-pressed");
                            a.attr("aria-pressed", !b);
                        }
                    }, f.media.addEventListener("click", f.clickToPlayPauseCallback, !1), f.container.bind("mouseenter", function() {
                        f.controlsEnabled && (f.options.alwaysShowControls || (f.killControlsTimer("enter"), 
                        f.showControls(), f.startControlsTimer(f.options.controlsTimeoutMouseEnter)));
                    }).bind("mousemove", function() {
                        f.controlsEnabled && (f.controlsAreVisible || f.showControls(), f.options.alwaysShowControls || f.startControlsTimer(f.options.controlsTimeoutMouseEnter));
                    }).bind("mouseleave", function() {
                        f.controlsEnabled && (f.media.paused || f.options.alwaysShowControls || f.startControlsTimer(f.options.controlsTimeoutMouseLeave));
                    })), f.options.hideVideoControlsOnLoad && f.hideControls(!1), i && !f.options.alwaysShowControls && f.hideControls(), 
                    f.options.enableAutosize && f.media.addEventListener("loadedmetadata", function(a) {
                        f.options.videoHeight <= 0 && null === f.domNode.getAttribute("height") && !isNaN(a.target.videoHeight) && (f.setPlayerSize(a.target.videoWidth, a.target.videoHeight), 
                        f.setControlsSize(), f.media.setVideoSize(a.target.videoWidth, a.target.videoHeight));
                    }, !1)), f.media.addEventListener("play", function() {
                        var a;
                        for (a in mejs.players) {
                            var b = mejs.players[a];
                            b.id == f.id || !f.options.pauseOtherPlayers || b.paused || b.ended || b.pause(), 
                            b.hasFocus = !1;
                        }
                        f.hasFocus = !0;
                    }, !1), f.media.addEventListener("ended", function(b) {
                        if (f.options.autoRewind) try {
                            f.media.setCurrentTime(0), window.setTimeout(function() {
                                a(f.container).find(".mejs-overlay-loading").parent().hide();
                            }, 20);
                        } catch (c) {}
                        "youtube" === f.media.pluginType ? f.media.stop() : f.media.pause(), f.setProgressRail && f.setProgressRail(), 
                        f.setCurrentRail && f.setCurrentRail(), f.options.loop ? f.play() : !f.options.alwaysShowControls && f.controlsEnabled && f.showControls();
                    }, !1), f.media.addEventListener("loadedmetadata", function() {
                        mejs.Utility.calculateTimeFormat(f.duration, f.options, f.options.framesPerSecond || 25), 
                        f.updateDuration && f.updateDuration(), f.updateCurrent && f.updateCurrent(), f.isFullScreen || (f.setPlayerSize(f.width, f.height), 
                        f.setControlsSize());
                    }, !1);
                    var k = null;
                    f.media.addEventListener("timeupdate", function() {
                        k !== this.duration && (k = this.duration, mejs.Utility.calculateTimeFormat(k, f.options, f.options.framesPerSecond || 25), 
                        f.updateDuration && f.updateDuration(), f.updateCurrent && f.updateCurrent(), f.setControlsSize());
                    }, !1), f.container.focusout(function(b) {
                        if (b.relatedTarget) {
                            var c = a(b.relatedTarget);
                            f.keyboardAction && 0 === c.parents(".mejs-container").length && (f.keyboardAction = !1, 
                            f.isVideo && !f.options.alwaysShowControls && f.hideControls(!0));
                        }
                    }), setTimeout(function() {
                        f.setPlayerSize(f.width, f.height), f.setControlsSize();
                    }, 50), f.globalBind("resize", function() {
                        f.isFullScreen || mejs.MediaFeatures.hasTrueNativeFullScreen && document.webkitIsFullScreen || f.setPlayerSize(f.width, f.height), 
                        f.setControlsSize();
                    }), "youtube" == f.media.pluginType && (g.isiOS || g.isAndroid) && (f.container.find(".mejs-overlay-play").hide(), 
                    f.container.find(".mejs-poster").hide());
                }
                i && "native" == b.pluginType && f.play(), f.options.success && ("string" == typeof f.options.success ? window[f.options.success](f.media, f.domNode, f) : f.options.success(f.media, f.domNode, f));
            }
        },
        handleError: function(a) {
            var b = this;
            b.controls && b.controls.hide(), b.options.error && b.options.error(a);
        },
        setPlayerSize: function(a, b) {
            var c = this;
            if (!c.options.setDimensions) return !1;
            switch ("undefined" != typeof a && (c.width = a), "undefined" != typeof b && (c.height = b), 
            c.options.stretching) {
              case "fill":
                c.isVideo ? this.setFillMode() : this.setDimensions(c.width, c.height);
                break;

              case "responsive":
                this.setResponsiveMode();
                break;

              case "none":
                this.setDimensions(c.width, c.height);
                break;

              default:
                this.hasFluidMode() === !0 ? this.setResponsiveMode() : this.setDimensions(c.width, c.height);
            }
        },
        hasFluidMode: function() {
            var a = this;
            return a.height.toString().indexOf("%") > 0 || "none" !== a.$node.css("max-width") && "t.width" !== a.$node.css("max-width") || a.$node[0].currentStyle && "100%" === a.$node[0].currentStyle.maxWidth;
        },
        setResponsiveMode: function() {
            var b = this, c = function() {
                return b.isVideo ? b.media.videoWidth && b.media.videoWidth > 0 ? b.media.videoWidth : null !== b.media.getAttribute("width") ? b.media.getAttribute("width") : b.options.defaultVideoWidth : b.options.defaultAudioWidth;
            }(), d = function() {
                return b.isVideo ? b.media.videoHeight && b.media.videoHeight > 0 ? b.media.videoHeight : null !== b.media.getAttribute("height") ? b.media.getAttribute("height") : b.options.defaultVideoHeight : b.options.defaultAudioHeight;
            }(), e = b.container.parent().closest(":visible").width(), f = b.container.parent().closest(":visible").height(), g = b.isVideo || !b.options.autosizeProgress ? parseInt(e * d / c, 10) : d;
            (isNaN(g) || 0 !== f && g > f && f > d) && (g = f), b.container.parent().length > 0 && "body" === b.container.parent()[0].tagName.toLowerCase() && (e = a(window).width(), 
            g = a(window).height()), g && e && (b.container.width(e).height(g), b.$media.add(b.container.find(".mejs-shim")).width("100%").height("100%"), 
            b.isVideo && b.media.setVideoSize && b.media.setVideoSize(e, g), b.layers.children(".mejs-layer").width("100%").height("100%"));
        },
        setFillMode: function() {
            var a = this, b = a.outerContainer;
            b.width() || b.height(a.$media.width()), b.height() || b.height(a.$media.height());
            var c = b.width(), d = b.height();
            a.setDimensions("100%", "100%"), a.container.find(".mejs-poster img").css("display", "block"), 
            targetElement = a.container.find("object, embed, iframe, video");
            var e = a.height, f = a.width, g = c, h = e * c / f, i = f * d / e, j = d, k = !(i > c), l = k ? Math.floor(g) : Math.floor(i), m = k ? Math.floor(h) : Math.floor(j);
            k ? (targetElement.height(m).width(c), a.media.setVideoSize && a.media.setVideoSize(c, m)) : (targetElement.height(d).width(l), 
            a.media.setVideoSize && a.media.setVideoSize(l, d)), targetElement.css({
                "margin-left": Math.floor((c - l) / 2),
                "margin-top": 0
            });
        },
        setDimensions: function(a, b) {
            var c = this;
            c.container.width(a).height(b), c.layers.children(".mejs-layer").width(a).height(b);
        },
        setControlsSize: function() {
            var b = this, c = 0, d = 0, e = b.controls.find(".mejs-time-rail"), f = b.controls.find(".mejs-time-total"), g = e.siblings(), h = g.last(), i = null, j = b.options && !b.options.autosizeProgress;
            if (b.container.is(":visible") && e.length && e.is(":visible")) {
                j && (d = parseInt(e.css("width"), 10)), 0 !== d && d || (g.each(function() {
                    var b = a(this);
                    "absolute" != b.css("position") && b.is(":visible") && (c += a(this).outerWidth(!0));
                }), d = b.controls.width() - c - (e.outerWidth(!0) - e.width()));
                do {
                    j || e.width(d), f.width(d - (f.outerWidth(!0) - f.width())), "absolute" != h.css("position") && (i = h.length ? h.position() : null, 
                    d--);
                } while (null !== i && i.top.toFixed(2) > 0 && d > 0);
                b.container.trigger("controlsresize");
            }
        },
        buildposter: function(b, c, d, e) {
            var f = this, g = a('<div class="mejs-poster mejs-layer"></div>').appendTo(d), h = b.$media.attr("poster");
            "" !== b.options.poster && (h = b.options.poster), h ? f.setPoster(h) : g.hide(), 
            e.addEventListener("play", function() {
                g.hide();
            }, !1), b.options.showPosterWhenEnded && b.options.autoRewind && e.addEventListener("ended", function() {
                g.show();
            }, !1);
        },
        setPoster: function(b) {
            var c = this, d = c.container.find(".mejs-poster"), e = d.find("img");
            0 === e.length && (e = a('<img width="100%" height="100%" alt="" />').appendTo(d)), 
            e.attr("src", b), d.css({
                "background-image": "url(" + b + ")"
            });
        },
        buildoverlays: function(b, c, d, e) {
            var f = this;
            if (b.isVideo) {
                var g = a('<div class="mejs-overlay mejs-layer"><div class="mejs-overlay-loading"><span></span></div></div>').hide().appendTo(d), h = a('<div class="mejs-overlay mejs-layer"><div class="mejs-overlay-error"></div></div>').hide().appendTo(d), i = a('<div class="mejs-overlay mejs-layer mejs-overlay-play"><div class="mejs-overlay-button" role="button" aria-label="' + mejs.i18n.t("mejs.play") + '" aria-pressed="false"></div></div>').appendTo(d).bind("click", function() {
                    if (f.options.clickToPlayPause) {
                        e.paused && e.play();
                        var b = a(this).find(".mejs-overlay-button"), c = b.attr("aria-pressed");
                        b.attr("aria-pressed", !!c);
                    }
                });
                e.addEventListener("play", function() {
                    i.hide(), g.hide(), c.find(".mejs-time-buffering").hide(), h.hide();
                }, !1), e.addEventListener("playing", function() {
                    i.hide(), g.hide(), c.find(".mejs-time-buffering").hide(), h.hide();
                }, !1), e.addEventListener("seeking", function() {
                    g.show(), c.find(".mejs-time-buffering").show();
                }, !1), e.addEventListener("seeked", function() {
                    g.hide(), c.find(".mejs-time-buffering").hide();
                }, !1), e.addEventListener("pause", function() {
                    mejs.MediaFeatures.isiPhone || i.show();
                }, !1), e.addEventListener("waiting", function() {
                    g.show(), c.find(".mejs-time-buffering").show();
                }, !1), e.addEventListener("loadeddata", function() {
                    g.show(), c.find(".mejs-time-buffering").show(), mejs.MediaFeatures.isAndroid && (e.canplayTimeout = window.setTimeout(function() {
                        if (document.createEvent) {
                            var a = document.createEvent("HTMLEvents");
                            return a.initEvent("canplay", !0, !0), e.dispatchEvent(a);
                        }
                    }, 300));
                }, !1), e.addEventListener("canplay", function() {
                    g.hide(), c.find(".mejs-time-buffering").hide(), clearTimeout(e.canplayTimeout);
                }, !1), e.addEventListener("error", function(a) {
                    f.handleError(a), g.hide(), i.hide(), h.show(), h.find(".mejs-overlay-error").html("Error loading this resource");
                }, !1), e.addEventListener("keydown", function(a) {
                    f.onkeydown(b, e, a);
                }, !1);
            }
        },
        buildkeyboard: function(b, c, d, e) {
            var f = this;
            f.container.keydown(function() {
                f.keyboardAction = !0;
            }), f.globalBind("keydown", function(c) {
                return b.hasFocus = 0 !== a(c.target).closest(".mejs-container").length && a(c.target).closest(".mejs-container").attr("id") === b.$media.closest(".mejs-container").attr("id"), 
                f.onkeydown(b, e, c);
            }), f.globalBind("click", function(c) {
                b.hasFocus = 0 !== a(c.target).closest(".mejs-container").length;
            });
        },
        onkeydown: function(a, b, c) {
            if (a.hasFocus && a.options.enableKeyboard) for (var d = 0, e = a.options.keyActions.length; e > d; d++) for (var f = a.options.keyActions[d], g = 0, h = f.keys.length; h > g; g++) if (c.keyCode == f.keys[g]) return "function" == typeof c.preventDefault && c.preventDefault(), 
            f.action(a, b, c.keyCode, c), !1;
            return !0;
        },
        findTracks: function() {
            var b = this, c = b.$media.find("track");
            b.tracks = [], c.each(function(c, d) {
                d = a(d), b.tracks.push({
                    srclang: d.attr("srclang") ? d.attr("srclang").toLowerCase() : "",
                    src: d.attr("src"),
                    kind: d.attr("kind"),
                    label: d.attr("label") || "",
                    entries: [],
                    isLoaded: !1
                });
            });
        },
        changeSkin: function(a) {
            this.container[0].className = "mejs-container " + a, this.setPlayerSize(this.width, this.height), 
            this.setControlsSize();
        },
        play: function() {
            this.load(), this.media.play();
        },
        pause: function() {
            try {
                this.media.pause();
            } catch (a) {}
        },
        load: function() {
            this.isLoaded || this.media.load(), this.isLoaded = !0;
        },
        setMuted: function(a) {
            this.media.setMuted(a);
        },
        setCurrentTime: function(a) {
            this.media.setCurrentTime(a);
        },
        getCurrentTime: function() {
            return this.media.currentTime;
        },
        setVolume: function(a) {
            this.media.setVolume(a);
        },
        getVolume: function() {
            return this.media.volume;
        },
        setSrc: function(a) {
            var b = this;
            if ("youtube" === b.media.pluginType) {
                var c;
                if ("string" != typeof a) {
                    var d, e;
                    for (d = 0; d < a.length; d++) if (e = a[d], this.canPlayType(e.type)) {
                        a = e.src;
                        break;
                    }
                }
                if (-1 !== a.lastIndexOf("youtu.be")) c = a.substr(a.lastIndexOf("/") + 1), -1 !== c.indexOf("?") && (c = c.substr(0, c.indexOf("?"))); else {
                    var f = a.match(/[?&]v=([^&#]+)|&|#|$/);
                    f && (c = f[1]);
                }
                null !== b.media.getAttribute("autoplay") ? b.media.pluginApi.loadVideoById(c) : b.media.pluginApi.cueVideoById(c);
            } else b.media.setSrc(a);
        },
        remove: function() {
            var a, b, c = this;
            c.container.prev(".mejs-offscreen").remove();
            for (a in c.options.features) if (b = c.options.features[a], c["clean" + b]) try {
                c["clean" + b](c);
            } catch (d) {}
            c.isDynamic ? c.$node.insertBefore(c.container) : (c.$media.prop("controls", !0), 
            c.$node.clone().insertBefore(c.container).show(), c.$node.remove()), "native" !== c.media.pluginType && c.media.remove(), 
            delete mejs.players[c.id], "object" == typeof c.container && c.container.remove(), 
            c.globalUnbind(), delete c.node.player;
        },
        rebuildtracks: function() {
            var a = this;
            a.findTracks(), a.buildtracks(a, a.controls, a.layers, a.media);
        },
        resetSize: function() {
            var a = this;
            setTimeout(function() {
                a.setPlayerSize(a.width, a.height), a.setControlsSize();
            }, 50);
        }
    }, function() {
        function b(b, d) {
            var e = {
                d: [],
                w: []
            };
            return a.each((b || "").split(" "), function(a, b) {
                var f = b + "." + d;
                0 === f.indexOf(".") ? (e.d.push(f), e.w.push(f)) : e[c.test(b) ? "w" : "d"].push(f);
            }), e.d = e.d.join(" "), e.w = e.w.join(" "), e;
        }
        var c = /^((after|before)print|(before)?unload|hashchange|message|o(ff|n)line|page(hide|show)|popstate|resize|storage)\b/;
        mejs.MediaElementPlayer.prototype.globalBind = function(c, d, e) {
            var f = this, g = f.node ? f.node.ownerDocument : document;
            c = b(c, f.id), c.d && a(g).bind(c.d, d, e), c.w && a(window).bind(c.w, d, e);
        }, mejs.MediaElementPlayer.prototype.globalUnbind = function(c, d) {
            var e = this, f = e.node ? e.node.ownerDocument : document;
            c = b(c, e.id), c.d && a(f).unbind(c.d, d), c.w && a(window).unbind(c.w, d);
        };
    }(), "undefined" != typeof a && (a.fn.mediaelementplayer = function(b) {
        return b === !1 ? this.each(function() {
            var b = a(this).data("mediaelementplayer");
            b && b.remove(), a(this).removeData("mediaelementplayer");
        }) : this.each(function() {
            a(this).data("mediaelementplayer", new mejs.MediaElementPlayer(this, b));
        }), this;
    }, a(document).ready(function() {
        a(".mejs-player").mediaelementplayer();
    })), window.MediaElementPlayer = mejs.MediaElementPlayer;
}(mejs.$), function(a) {
    a.extend(mejs.MepDefaults, {
        playText: "",
        pauseText: ""
    }), a.extend(MediaElementPlayer.prototype, {
        buildplaypause: function(b, c, d, e) {
            function f(a) {
                "play" === a ? (k.removeClass("mejs-play").addClass("mejs-pause"), l.attr({
                    title: j,
                    "aria-label": j
                })) : (k.removeClass("mejs-pause").addClass("mejs-play"), l.attr({
                    title: i,
                    "aria-label": i
                }));
            }
            var g = this, h = g.options, i = h.playText ? h.playText : mejs.i18n.t("mejs.play"), j = h.pauseText ? h.pauseText : mejs.i18n.t("mejs.pause"), k = a('<div class="mejs-button mejs-playpause-button mejs-play" ><button type="button" aria-controls="' + g.id + '" title="' + i + '" aria-label="' + j + '"></button></div>').appendTo(c).click(function(a) {
                return a.preventDefault(), e.paused ? e.play() : e.pause(), !1;
            }), l = k.find("button");
            f("pse"), e.addEventListener("play", function() {
                f("play");
            }, !1), e.addEventListener("playing", function() {
                f("play");
            }, !1), e.addEventListener("pause", function() {
                f("pse");
            }, !1), e.addEventListener("paused", function() {
                f("pse");
            }, !1);
        }
    });
}(mejs.$), function(a) {
    a.extend(mejs.MepDefaults, {
        stopText: "Stop"
    }), a.extend(MediaElementPlayer.prototype, {
        buildstop: function(b, c, d, e) {
            var f = this;
            a('<div class="mejs-button mejs-stop-button mejs-stop"><button type="button" aria-controls="' + f.id + '" title="' + f.options.stopText + '" aria-label="' + f.options.stopText + '"></button></div>').appendTo(c).click(function() {
                e.paused || e.pause(), e.currentTime > 0 && (e.setCurrentTime(0), e.pause(), c.find(".mejs-time-current").width("0px"), 
                c.find(".mejs-time-handle").css("left", "0px"), c.find(".mejs-time-float-current").html(mejs.Utility.secondsToTimeCode(0, b.options)), 
                c.find(".mejs-currenttime").html(mejs.Utility.secondsToTimeCode(0, b.options)), 
                d.find(".mejs-poster").show());
            });
        }
    });
}(mejs.$), function(a) {
    a.extend(mejs.MepDefaults, {
        enableProgressTooltip: !0,
        progressHelpText: ""
    }), a.extend(MediaElementPlayer.prototype, {
        buildprogress: function(b, c, d, e) {
            var f = this, g = !1, h = !1, i = 0, j = !1, k = b.options.autoRewind, l = (f.options.progressHelpText ? f.options.progressHelpText : mejs.i18n.t("mejs.time-help-text"), 
            b.options.enableProgressTooltip ? '<span class="mejs-time-float"><span class="mejs-time-float-current">00:00</span><span class="mejs-time-float-corner"></span></span>' : "");
            a('<div class="mejs-time-rail"><span  class="mejs-time-total mejs-time-slider"><span class="mejs-time-buffering"></span><span class="mejs-time-loaded"></span><span class="mejs-time-current"></span><span class="mejs-time-handle"></span>' + l + "</span></div>").appendTo(c), 
            c.find(".mejs-time-buffering").hide(), f.total = c.find(".mejs-time-total"), f.loaded = c.find(".mejs-time-loaded"), 
            f.current = c.find(".mejs-time-current"), f.handle = c.find(".mejs-time-handle"), 
            f.timefloat = c.find(".mejs-time-float"), f.timefloatcurrent = c.find(".mejs-time-float-current"), 
            f.slider = c.find(".mejs-time-slider");
            var m = function(a) {
                var c, d = f.total.offset(), h = f.total.width(), i = 0, j = 0, k = 0;
                c = a.originalEvent && a.originalEvent.changedTouches ? a.originalEvent.changedTouches[0].pageX : a.changedTouches ? a.changedTouches[0].pageX : a.pageX, 
                e.duration && (c < d.left ? c = d.left : c > h + d.left && (c = h + d.left), k = c - d.left, 
                i = k / h, j = .02 >= i ? 0 : i * e.duration, g && j !== e.currentTime && e.setCurrentTime(j), 
                mejs.MediaFeatures.hasTouch || (f.timefloat.css("left", k), f.timefloatcurrent.html(mejs.Utility.secondsToTimeCode(j, b.options)), 
                f.timefloat.show()));
            }, n = function(a) {
                var c = e.currentTime, d = mejs.i18n.t("mejs.time-slider"), g = mejs.Utility.secondsToTimeCode(c, b.options), h = e.duration;
                f.slider.attr({
                    "aria-label": d,
                    "aria-valuemin": 0,
                    "aria-valuemax": h,
                    "aria-valuenow": c,
                    "aria-valuetext": g,
                    role: "slider",
                    tabindex: 0
                });
            }, o = function() {
                var a = new Date();
                a - i >= 1e3 && e.play();
            };
            f.slider.bind("focus", function(a) {
                b.options.autoRewind = !1;
            }), f.slider.bind("blur", function(a) {
                b.options.autoRewind = k;
            }), f.slider.bind("keydown", function(a) {
                new Date() - i >= 1e3 && (j = e.paused);
                var c = a.keyCode, d = e.duration, f = e.currentTime, g = b.options.defaultSeekForwardInterval(e), h = b.options.defaultSeekBackwardInterval(e);
                switch (c) {
                  case 37:
                  case 40:
                    f -= h;
                    break;

                  case 39:
                  case 38:
                    f += g;
                    break;

                  case 36:
                    f = 0;
                    break;

                  case 35:
                    f = d;
                    break;

                  case 32:
                  case 13:
                    return void (e.paused ? e.play() : e.pause());

                  default:
                    return;
                }
                return f = 0 > f ? 0 : f >= d ? d : Math.floor(f), i = new Date(), j || e.pause(), 
                f < e.duration && !j && setTimeout(o, 1100), e.setCurrentTime(f), a.preventDefault(), 
                a.stopPropagation(), !1;
            }), f.total.bind("mousedown touchstart", function(a) {
                (1 === a.which || 0 === a.which) && (g = !0, m(a), f.globalBind("mousemove.dur touchmove.dur", function(a) {
                    m(a);
                }), f.globalBind("mouseup.dur touchend.dur", function(a) {
                    g = !1, "undefined" != typeof f.timefloat && f.timefloat.hide(), f.globalUnbind(".dur");
                }));
            }).bind("mouseenter", function(a) {
                h = !0, f.globalBind("mousemove.dur", function(a) {
                    m(a);
                }), "undefined" == typeof f.timefloat || mejs.MediaFeatures.hasTouch || f.timefloat.show();
            }).bind("mouseleave", function(a) {
                h = !1, g || (f.globalUnbind(".dur"), "undefined" != typeof f.timefloat && f.timefloat.hide());
            }), e.addEventListener("progress", function(a) {
                b.setProgressRail(a), b.setCurrentRail(a);
            }, !1), e.addEventListener("timeupdate", function(a) {
                b.setProgressRail(a), b.setCurrentRail(a), n(a);
            }, !1), f.container.on("controlsresize", function(a) {
                b.setProgressRail(a), b.setCurrentRail(a);
            });
        },
        setProgressRail: function(a) {
            var b = this, c = void 0 !== a ? a.target : b.media, d = null;
            c && c.buffered && c.buffered.length > 0 && c.buffered.end && c.duration ? d = c.buffered.end(c.buffered.length - 1) / c.duration : c && void 0 !== c.bytesTotal && c.bytesTotal > 0 && void 0 !== c.bufferedBytes ? d = c.bufferedBytes / c.bytesTotal : a && a.lengthComputable && 0 !== a.total && (d = a.loaded / a.total), 
            null !== d && (d = Math.min(1, Math.max(0, d)), b.loaded && b.total && b.loaded.width(b.total.width() * d));
        },
        setCurrentRail: function() {
            var a = this;
            if (void 0 !== a.media.currentTime && a.media.duration && a.total && a.handle) {
                var b = Math.round(a.total.width() * a.media.currentTime / a.media.duration), c = b - Math.round(a.handle.outerWidth(!0) / 2);
                a.current.width(b), a.handle.css("left", c);
            }
        }
    });
}(mejs.$), function(a) {
    a.extend(mejs.MepDefaults, {
        duration: -1,
        timeAndDurationSeparator: "<span> | </span>"
    }), a.extend(MediaElementPlayer.prototype, {
        buildcurrent: function(b, c, d, e) {
            var f = this;
            a('<div class="mejs-time" role="timer" aria-live="off"><span class="mejs-currenttime">' + mejs.Utility.secondsToTimeCode(0, b.options) + "</span></div>").appendTo(c), 
            f.currenttime = f.controls.find(".mejs-currenttime"), e.addEventListener("timeupdate", function() {
                f.controlsAreVisible && b.updateCurrent();
            }, !1);
        },
        buildduration: function(b, c, d, e) {
            var f = this;
            c.children().last().find(".mejs-currenttime").length > 0 ? a(f.options.timeAndDurationSeparator + '<span class="mejs-duration">' + mejs.Utility.secondsToTimeCode(f.options.duration, f.options) + "</span>").appendTo(c.find(".mejs-time")) : (c.find(".mejs-currenttime").parent().addClass("mejs-currenttime-container"), 
            a('<div class="mejs-time mejs-duration-container"><span class="mejs-duration">' + mejs.Utility.secondsToTimeCode(f.options.duration, f.options) + "</span></div>").appendTo(c)), 
            f.durationD = f.controls.find(".mejs-duration"), e.addEventListener("timeupdate", function() {
                f.controlsAreVisible && b.updateDuration();
            }, !1);
        },
        updateCurrent: function() {
            var a = this, b = a.media.currentTime;
            isNaN(b) && (b = 0), a.currenttime && a.currenttime.html(mejs.Utility.secondsToTimeCode(b, a.options));
        },
        updateDuration: function() {
            var a = this, b = a.media.duration;
            a.options.duration > 0 && (b = a.options.duration), isNaN(b) && (b = 0), a.container.toggleClass("mejs-long-video", b > 3600), 
            a.durationD && b > 0 && a.durationD.html(mejs.Utility.secondsToTimeCode(b, a.options));
        }
    });
}(mejs.$), function(a) {
    a.extend(mejs.MepDefaults, {
        muteText: mejs.i18n.t("mejs.mute-toggle"),
        allyVolumeControlText: mejs.i18n.t("mejs.volume-help-text"),
        hideVolumeOnTouchDevices: !0,
        audioVolume: "horizontal",
        videoVolume: "vertical"
    }), a.extend(MediaElementPlayer.prototype, {
        buildvolume: function(b, c, d, e) {
            if (!mejs.MediaFeatures.isAndroid && !mejs.MediaFeatures.isiOS || !this.options.hideVolumeOnTouchDevices) {
                var f = this, g = f.isVideo ? f.options.videoVolume : f.options.audioVolume, h = "horizontal" == g ? a('<div class="mejs-button mejs-volume-button mejs-mute"><button type="button" aria-controls="' + f.id + '" title="' + f.options.muteText + '" aria-label="' + f.options.muteText + '"></button></div><a href="javascript:void(0);" class="mejs-horizontal-volume-slider"><span class="mejs-offscreen">' + f.options.allyVolumeControlText + '</span><div class="mejs-horizontal-volume-total"></div><div class="mejs-horizontal-volume-current"></div><div class="mejs-horizontal-volume-handle"></div></a>').appendTo(c) : a('<div class="mejs-button mejs-volume-button mejs-mute"><button type="button" aria-controls="' + f.id + '" title="' + f.options.muteText + '" aria-label="' + f.options.muteText + '"></button><a href="javascript:void(0);" class="mejs-volume-slider"><span class="mejs-offscreen">' + f.options.allyVolumeControlText + '</span><div class="mejs-volume-total"></div><div class="mejs-volume-current"></div><div class="mejs-volume-handle"></div></a></div>').appendTo(c), i = f.container.find(".mejs-volume-slider, .mejs-horizontal-volume-slider"), j = f.container.find(".mejs-volume-total, .mejs-horizontal-volume-total"), k = f.container.find(".mejs-volume-current, .mejs-horizontal-volume-current"), l = f.container.find(".mejs-volume-handle, .mejs-horizontal-volume-handle"), m = function(a, b) {
                    if (!i.is(":visible") && "undefined" == typeof b) return i.show(), m(a, !0), void i.hide();
                    a = Math.max(0, a), a = Math.min(a, 1), 0 === a ? (h.removeClass("mejs-mute").addClass("mejs-unmute"), 
                    h.children("button").attr("title", mejs.i18n.t("mejs.unmute")).attr("aria-label", mejs.i18n.t("mejs.unmute"))) : (h.removeClass("mejs-unmute").addClass("mejs-mute"), 
                    h.children("button").attr("title", mejs.i18n.t("mejs.mute")).attr("aria-label", mejs.i18n.t("mejs.mute")));
                    var c = j.position();
                    if ("vertical" == g) {
                        var d = j.height(), e = d - d * a;
                        l.css("top", Math.round(c.top + e - l.height() / 2)), k.height(d - e), k.css("top", c.top + e);
                    } else {
                        var f = j.width(), n = f * a;
                        l.css("left", Math.round(c.left + n - l.width() / 2)), k.width(Math.round(n));
                    }
                }, n = function(a) {
                    var b = null, c = j.offset();
                    if ("vertical" === g) {
                        var d = j.height(), f = a.pageY - c.top;
                        if (b = (d - f) / d, 0 === c.top || 0 === c.left) return;
                    } else {
                        var h = j.width(), i = a.pageX - c.left;
                        b = i / h;
                    }
                    b = Math.max(0, b), b = Math.min(b, 1), m(b), 0 === b ? e.setMuted(!0) : e.setMuted(!1), 
                    e.setVolume(b);
                }, o = !1, p = !1;
                h.hover(function() {
                    i.show(), p = !0;
                }, function() {
                    p = !1, o || "vertical" != g || i.hide();
                });
                var q = function(a) {
                    var b = Math.floor(100 * e.volume);
                    i.attr({
                        "aria-label": mejs.i18n.t("mejs.volume-slider"),
                        "aria-valuemin": 0,
                        "aria-valuemax": 100,
                        "aria-valuenow": b,
                        "aria-valuetext": b + "%",
                        role: "slider",
                        tabindex: 0
                    });
                };
                i.bind("mouseover", function() {
                    p = !0;
                }).bind("mousedown", function(a) {
                    return n(a), f.globalBind("mousemove.vol", function(a) {
                        n(a);
                    }), f.globalBind("mouseup.vol", function() {
                        o = !1, f.globalUnbind(".vol"), p || "vertical" != g || i.hide();
                    }), o = !0, !1;
                }).bind("keydown", function(a) {
                    var b = a.keyCode, c = e.volume;
                    switch (b) {
                      case 38:
                        c = Math.min(c + .1, 1);
                        break;

                      case 40:
                        c = Math.max(0, c - .1);
                        break;

                      default:
                        return !0;
                    }
                    return o = !1, m(c), e.setVolume(c), !1;
                }), h.find("button").click(function() {
                    e.setMuted(!e.muted);
                }), h.find("button").bind("focus", function() {
                    i.show();
                }), e.addEventListener("volumechange", function(a) {
                    o || (e.muted ? (m(0), h.removeClass("mejs-mute").addClass("mejs-unmute")) : (m(e.volume), 
                    h.removeClass("mejs-unmute").addClass("mejs-mute"))), q(a);
                }, !1), 0 === b.options.startVolume && e.setMuted(!0), "native" === e.pluginType && e.setVolume(b.options.startVolume), 
                f.container.on("controlsresize", function() {
                    e.muted ? (m(0), h.removeClass("mejs-mute").addClass("mejs-unmute")) : (m(e.volume), 
                    h.removeClass("mejs-unmute").addClass("mejs-mute"));
                });
            }
        }
    });
}(mejs.$), function(a) {
    a.extend(mejs.MepDefaults, {
        usePluginFullScreen: !0,
        newWindowCallback: function() {
            return "";
        },
        fullscreenText: ""
    }), a.extend(MediaElementPlayer.prototype, {
        isFullScreen: !1,
        isNativeFullScreen: !1,
        isInIframe: !1,
        fullscreenMode: "",
        buildfullscreen: function(b, c, d, e) {
            if (b.isVideo) {
                b.isInIframe = window.location != window.parent.location, e.addEventListener("loadstart", function() {
                    b.detectFullscreenMode();
                });
                var f = this, g = null, h = f.options.fullscreenText ? f.options.fullscreenText : mejs.i18n.t("mejs.fullscreen"), i = a('<div class="mejs-button mejs-fullscreen-button"><button type="button" aria-controls="' + f.id + '" title="' + h + '" aria-label="' + h + '"></button></div>').appendTo(c).on("click", function() {
                    var a = mejs.MediaFeatures.hasTrueNativeFullScreen && mejs.MediaFeatures.isFullScreen() || b.isFullScreen;
                    a ? b.exitFullScreen() : b.enterFullScreen();
                }).on("mouseover", function() {
                    if ("plugin-hover" == f.fullscreenMode) {
                        null !== g && (clearTimeout(g), delete g);
                        var a = i.offset(), c = b.container.offset();
                        e.positionFullscreenButton(a.left - c.left, a.top - c.top, !0);
                    }
                }).on("mouseout", function() {
                    "plugin-hover" == f.fullscreenMode && (null !== g && (clearTimeout(g), delete g), 
                    g = setTimeout(function() {
                        e.hideFullscreenButton();
                    }, 1500));
                });
                if (b.fullscreenBtn = i, f.globalBind("keydown", function(a) {
                    27 == a.keyCode && (mejs.MediaFeatures.hasTrueNativeFullScreen && mejs.MediaFeatures.isFullScreen() || f.isFullScreen) && b.exitFullScreen();
                }), f.normalHeight = 0, f.normalWidth = 0, mejs.MediaFeatures.hasTrueNativeFullScreen) {
                    var j = function(a) {
                        b.isFullScreen && (mejs.MediaFeatures.isFullScreen() ? (b.isNativeFullScreen = !0, 
                        b.setControlsSize()) : (b.isNativeFullScreen = !1, b.exitFullScreen()));
                    };
                    b.globalBind(mejs.MediaFeatures.fullScreenEventName, j);
                }
            }
        },
        detectFullscreenMode: function() {
            var a = this, b = "", c = mejs.MediaFeatures;
            return c.hasTrueNativeFullScreen && "native" === a.media.pluginType ? b = "native-native" : c.hasTrueNativeFullScreen && "native" !== a.media.pluginType && !c.hasFirefoxPluginMovingProblem ? b = "plugin-native" : a.usePluginFullScreen ? mejs.MediaFeatures.supportsPointerEvents ? (b = "plugin-click", 
            a.createPluginClickThrough()) : b = "plugin-hover" : b = "fullwindow", a.fullscreenMode = b, 
            b;
        },
        isPluginClickThroughCreated: !1,
        createPluginClickThrough: function() {
            var b = this;
            if (!b.isPluginClickThroughCreated) {
                var c, d, e = !1, f = function() {
                    if (e) {
                        for (var a in g) g[a].hide();
                        b.fullscreenBtn.css("pointer-events", ""), b.controls.css("pointer-events", ""), 
                        b.media.removeEventListener("click", b.clickToPlayPauseCallback), e = !1;
                    }
                }, g = {}, h = [ "top", "left", "right", "bottom" ], i = function() {
                    var a = fullscreenBtn.offset().left - b.container.offset().left, d = fullscreenBtn.offset().top - b.container.offset().top, e = fullscreenBtn.outerWidth(!0), f = fullscreenBtn.outerHeight(!0), h = b.container.width(), i = b.container.height();
                    for (c in g) g[c].css({
                        position: "absolute",
                        top: 0,
                        left: 0
                    });
                    g.top.width(h).height(d), g.left.width(a).height(f).css({
                        top: d
                    }), g.right.width(h - a - e).height(f).css({
                        top: d,
                        left: a + e
                    }), g.bottom.width(h).height(i - f - d).css({
                        top: d + f
                    });
                };
                for (b.globalBind("resize", function() {
                    i();
                }), c = 0, d = h.length; d > c; c++) g[h[c]] = a('<div class="mejs-fullscreen-hover" />').appendTo(b.container).mouseover(f).hide();
                fullscreenBtn.on("mouseover", function() {
                    if (!b.isFullScreen) {
                        var a = fullscreenBtn.offset(), d = player.container.offset();
                        media.positionFullscreenButton(a.left - d.left, a.top - d.top, !1), b.fullscreenBtn.css("pointer-events", "none"), 
                        b.controls.css("pointer-events", "none"), b.media.addEventListener("click", b.clickToPlayPauseCallback);
                        for (c in g) g[c].show();
                        i(), e = !0;
                    }
                }), media.addEventListener("fullscreenchange", function(a) {
                    b.isFullScreen = !b.isFullScreen, b.isFullScreen ? b.media.removeEventListener("click", b.clickToPlayPauseCallback) : b.media.addEventListener("click", b.clickToPlayPauseCallback), 
                    f();
                }), b.globalBind("mousemove", function(a) {
                    if (e) {
                        var c = fullscreenBtn.offset();
                        (a.pageY < c.top || a.pageY > c.top + fullscreenBtn.outerHeight(!0) || a.pageX < c.left || a.pageX > c.left + fullscreenBtn.outerWidth(!0)) && (fullscreenBtn.css("pointer-events", ""), 
                        b.controls.css("pointer-events", ""), e = !1);
                    }
                }), b.isPluginClickThroughCreated = !0;
            }
        },
        cleanfullscreen: function(a) {
            a.exitFullScreen();
        },
        containerSizeTimeout: null,
        enterFullScreen: function() {
            var b = this;
            return mejs.MediaFeatures.isiOS && mejs.MediaFeatures.hasiOSFullScreen && "function" == typeof b.media.webkitEnterFullscreen ? void b.media.webkitEnterFullscreen() : (a(document.documentElement).addClass("mejs-fullscreen"), 
            b.normalHeight = b.container.height(), b.normalWidth = b.container.width(), "native-native" === b.fullscreenMode || "plugin-native" === b.fullscreenMode ? (mejs.MediaFeatures.requestFullScreen(b.container[0]), 
            b.isInIframe && setTimeout(function c() {
                if (b.isNativeFullScreen) {
                    var d = .002, e = a(window).width(), f = screen.width, g = Math.abs(f - e), h = f * d;
                    g > h ? b.exitFullScreen() : setTimeout(c, 500);
                }
            }, 1e3)) : "fullwindow" == b.fullscreeMode, b.container.addClass("mejs-container-fullscreen").width("100%").height("100%"), 
            b.containerSizeTimeout = setTimeout(function() {
                b.container.css({
                    width: "100%",
                    height: "100%"
                }), b.setControlsSize();
            }, 500), "native" === b.media.pluginType ? b.$media.width("100%").height("100%") : (b.container.find(".mejs-shim").width("100%").height("100%"), 
            setTimeout(function() {
                var c = a(window), d = c.width(), e = c.height();
                b.media.setVideoSize(d, e);
            }, 500)), b.layers.children("div").width("100%").height("100%"), b.fullscreenBtn && b.fullscreenBtn.removeClass("mejs-fullscreen").addClass("mejs-unfullscreen"), 
            b.setControlsSize(), b.isFullScreen = !0, b.container.find(".mejs-captions-text").css("font-size", screen.width / b.width * 1 * 100 + "%"), 
            b.container.find(".mejs-captions-position").css("bottom", "45px"), void b.container.trigger("enteredfullscreen"));
        },
        exitFullScreen: function() {
            var b = this;
            clearTimeout(b.containerSizeTimeout), mejs.MediaFeatures.hasTrueNativeFullScreen && (mejs.MediaFeatures.isFullScreen() || b.isFullScreen) && mejs.MediaFeatures.cancelFullScreen(), 
            a(document.documentElement).removeClass("mejs-fullscreen"), b.container.removeClass("mejs-container-fullscreen").width(b.normalWidth).height(b.normalHeight), 
            "native" === b.media.pluginType ? b.$media.width(b.normalWidth).height(b.normalHeight) : (b.container.find(".mejs-shim").width(b.normalWidth).height(b.normalHeight), 
            b.media.setVideoSize(b.normalWidth, b.normalHeight)), b.layers.children("div").width(b.normalWidth).height(b.normalHeight), 
            b.fullscreenBtn.removeClass("mejs-unfullscreen").addClass("mejs-fullscreen"), b.setControlsSize(), 
            b.isFullScreen = !1, b.container.find(".mejs-captions-text").css("font-size", ""), 
            b.container.find(".mejs-captions-position").css("bottom", ""), b.container.trigger("exitedfullscreen");
        }
    });
}(mejs.$), function(a) {
    a.extend(mejs.MepDefaults, {
        speeds: [ "2.00", "1.50", "1.25", "1.00", "0.75" ],
        defaultSpeed: "1.00",
        speedChar: "x"
    }), a.extend(MediaElementPlayer.prototype, {
        buildspeed: function(b, c, d, e) {
            var f = this;
            if ("native" == f.media.pluginType) {
                for (var g = null, h = null, i = null, j = null, k = [], l = !1, m = 0, n = f.options.speeds.length; n > m; m++) {
                    var o = f.options.speeds[m];
                    "string" == typeof o ? (k.push({
                        name: o + f.options.speedChar,
                        value: o
                    }), o === f.options.defaultSpeed && (l = !0)) : (k.push(o), o.value === f.options.defaultSpeed && (l = !0));
                }
                l || k.push({
                    name: f.options.defaultSpeed + f.options.speedChar,
                    value: f.options.defaultSpeed
                }), k.sort(function(a, b) {
                    return parseFloat(b.value) - parseFloat(a.value);
                });
                var p = function(a) {
                    for (m = 0, n = k.length; n > m; m++) if (k[m].value === a) return k[m].name;
                }, q = '<div class="mejs-button mejs-speed-button"><button type="button">' + p(f.options.defaultSpeed) + '</button><div class="mejs-speed-selector"><ul>';
                for (m = 0, il = k.length; m < il; m++) j = f.id + "-speed-" + k[m].value, q += '<li><input type="radio" name="speed" value="' + k[m].value + '" id="' + j + '" ' + (k[m].value === f.options.defaultSpeed ? " checked" : "") + ' /><label for="' + j + '" ' + (k[m].value === f.options.defaultSpeed ? ' class="mejs-speed-selected"' : "") + ">" + k[m].name + "</label></li>";
                q += "</ul></div></div>", g = a(q).appendTo(c), h = g.find(".mejs-speed-selector"), 
                i = f.options.defaultSpeed, e.addEventListener("loadedmetadata", function(a) {
                    i && (e.playbackRate = parseFloat(i));
                }, !0), h.on("click", 'input[type="radio"]', function() {
                    var b = a(this).attr("value");
                    i = b, e.playbackRate = parseFloat(b), g.find("button").html(p(b)), g.find(".mejs-speed-selected").removeClass("mejs-speed-selected"), 
                    g.find('input[type="radio"]:checked').next().addClass("mejs-speed-selected");
                }), g.one("mouseenter focusin", function() {
                    h.height(g.find(".mejs-speed-selector ul").outerHeight(!0) + g.find(".mejs-speed-translations").outerHeight(!0)).css("top", -1 * h.height() + "px");
                });
            }
        }
    });
}(mejs.$), function(a) {
    a.extend(mejs.MepDefaults, {
        startLanguage: "",
        tracksText: "",
        tracksAriaLive: !1,
        hideCaptionsButtonWhenEmpty: !0,
        toggleCaptionsButtonWhenOnlyOne: !1,
        slidesSelector: ""
    }), a.extend(MediaElementPlayer.prototype, {
        hasChapters: !1,
        cleartracks: function(a, b, c, d) {
            a && (a.captions && a.captions.remove(), a.chapters && a.chapters.remove(), a.captionsText && a.captionsText.remove(), 
            a.captionsButton && a.captionsButton.remove());
        },
        buildtracks: function(b, c, d, e) {
            if (0 !== b.tracks.length) {
                var f, g, h = this, i = h.options.tracksAriaLive ? 'role="log" aria-live="assertive" aria-atomic="false"' : "", j = h.options.tracksText ? h.options.tracksText : mejs.i18n.t("mejs.captions-subtitles");
                if (h.domNode.textTracks) for (f = h.domNode.textTracks.length - 1; f >= 0; f--) h.domNode.textTracks[f].mode = "hidden";
                h.cleartracks(b, c, d, e), b.chapters = a('<div class="mejs-chapters mejs-layer"></div>').prependTo(d).hide(), 
                b.captions = a('<div class="mejs-captions-layer mejs-layer"><div class="mejs-captions-position mejs-captions-position-hover" ' + i + '><span class="mejs-captions-text"></span></div></div>').prependTo(d).hide(), 
                b.captionsText = b.captions.find(".mejs-captions-text"), b.captionsButton = a('<div class="mejs-button mejs-captions-button"><button type="button" aria-controls="' + h.id + '" title="' + j + '" aria-label="' + j + '"></button><div class="mejs-captions-selector"><ul><li><input type="radio" name="' + b.id + '_captions" id="' + b.id + '_captions_none" value="none" checked="checked" /><label for="' + b.id + '_captions_none">' + mejs.i18n.t("mejs.none") + "</label></li></ul></div></div>").appendTo(c);
                var k = 0;
                for (f = 0; f < b.tracks.length; f++) g = b.tracks[f].kind, ("subtitles" === g || "captions" === g) && k++;
                for (h.options.toggleCaptionsButtonWhenOnlyOne && 1 == k ? b.captionsButton.on("click", function() {
                    null === b.selectedTrack ? lang = b.tracks[0].srclang : lang = "none", b.setTrack(lang);
                }) : (b.captionsButton.on("mouseenter focusin", function() {
                    a(this).find(".mejs-captions-selector").removeClass("mejs-offscreen");
                }).on("click", "input[type=radio]", function() {
                    lang = this.value, b.setTrack(lang);
                }), b.captionsButton.on("mouseleave focusout", function() {
                    a(this).find(".mejs-captions-selector").addClass("mejs-offscreen");
                })), b.options.alwaysShowControls ? b.container.find(".mejs-captions-position").addClass("mejs-captions-position-hover") : b.container.bind("controlsshown", function() {
                    b.container.find(".mejs-captions-position").addClass("mejs-captions-position-hover");
                }).bind("controlshidden", function() {
                    e.paused || b.container.find(".mejs-captions-position").removeClass("mejs-captions-position-hover");
                }), b.trackToLoad = -1, b.selectedTrack = null, b.isLoadingTrack = !1, f = 0; f < b.tracks.length; f++) g = b.tracks[f].kind, 
                ("subtitles" === g || "captions" === g) && b.addTrackButton(b.tracks[f].srclang, b.tracks[f].label);
                b.loadNextTrack(), e.addEventListener("timeupdate", function() {
                    b.displayCaptions();
                }, !1), "" !== b.options.slidesSelector && (b.slidesContainer = a(b.options.slidesSelector), 
                e.addEventListener("timeupdate", function() {
                    b.displaySlides();
                }, !1)), e.addEventListener("loadedmetadata", function() {
                    b.displayChapters();
                }, !1), b.container.hover(function() {
                    b.hasChapters && (b.chapters.removeClass("mejs-offscreen"), b.chapters.fadeIn(200).height(b.chapters.find(".mejs-chapter").outerHeight()));
                }, function() {
                    b.hasChapters && !e.paused && b.chapters.fadeOut(200, function() {
                        a(this).addClass("mejs-offscreen"), a(this).css("display", "block");
                    });
                }), h.container.on("controlsresize", function() {
                    h.adjustLanguageBox();
                }), null !== b.node.getAttribute("autoplay") && b.chapters.addClass("mejs-offscreen");
            }
        },
        setTrack: function(a) {
            var b, c = this;
            if ("none" == a) c.selectedTrack = null, c.captionsButton.removeClass("mejs-captions-enabled"); else for (b = 0; b < c.tracks.length; b++) if (c.tracks[b].srclang == a) {
                null === c.selectedTrack && c.captionsButton.addClass("mejs-captions-enabled"), 
                c.selectedTrack = c.tracks[b], c.captions.attr("lang", c.selectedTrack.srclang), 
                c.displayCaptions();
                break;
            }
        },
        loadNextTrack: function() {
            var a = this;
            a.trackToLoad++, a.trackToLoad < a.tracks.length ? (a.isLoadingTrack = !0, a.loadTrack(a.trackToLoad)) : (a.isLoadingTrack = !1, 
            a.checkForTracks());
        },
        loadTrack: function(b) {
            var c = this, d = c.tracks[b], e = function() {
                d.isLoaded = !0, c.enableTrackButton(d.srclang, d.label), c.loadNextTrack();
            };
            a.ajax({
                url: d.src,
                dataType: "text",
                success: function(a) {
                    "string" == typeof a && /<tt\s+xml/gi.exec(a) ? d.entries = mejs.TrackFormatParser.dfxp.parse(a) : d.entries = mejs.TrackFormatParser.webvtt.parse(a), 
                    e(), "chapters" == d.kind && c.media.addEventListener("play", function() {
                        c.media.duration > 0 && c.displayChapters(d);
                    }, !1), "slides" == d.kind && c.setupSlides(d);
                },
                error: function() {
                    c.removeTrackButton(d.srclang), c.loadNextTrack();
                }
            });
        },
        enableTrackButton: function(b, c) {
            var d = this;
            "" === c && (c = mejs.language.codes[b] || b), d.captionsButton.find("input[value=" + b + "]").prop("disabled", !1).siblings("label").html(c), 
            d.options.startLanguage == b && a("#" + d.id + "_captions_" + b).prop("checked", !0).trigger("click"), 
            d.adjustLanguageBox();
        },
        removeTrackButton: function(a) {
            var b = this;
            b.captionsButton.find("input[value=" + a + "]").closest("li").remove(), b.adjustLanguageBox();
        },
        addTrackButton: function(b, c) {
            var d = this;
            "" === c && (c = mejs.language.codes[b] || b), d.captionsButton.find("ul").append(a('<li><input type="radio" name="' + d.id + '_captions" id="' + d.id + "_captions_" + b + '" value="' + b + '" disabled="disabled" /><label for="' + d.id + "_captions_" + b + '">' + c + " (loading)</label></li>")), 
            d.adjustLanguageBox(), d.container.find(".mejs-captions-translations option[value=" + b + "]").remove();
        },
        adjustLanguageBox: function() {
            var a = this;
            a.captionsButton.find(".mejs-captions-selector").height(a.captionsButton.find(".mejs-captions-selector ul").outerHeight(!0) + a.captionsButton.find(".mejs-captions-translations").outerHeight(!0));
        },
        checkForTracks: function() {
            var a = this, b = !1;
            if (a.options.hideCaptionsButtonWhenEmpty) {
                for (var c = 0; c < a.tracks.length; c++) {
                    var d = a.tracks[c].kind;
                    if (("subtitles" === d || "captions" === d) && a.tracks[c].isLoaded) {
                        b = !0;
                        break;
                    }
                }
                b || (a.captionsButton.hide(), a.setControlsSize());
            }
        },
        displayCaptions: function() {
            if ("undefined" != typeof this.tracks) {
                var a, b = this, c = b.selectedTrack;
                if (null !== c && c.isLoaded) {
                    for (a = 0; a < c.entries.times.length; a++) if (b.media.currentTime >= c.entries.times[a].start && b.media.currentTime <= c.entries.times[a].stop) return b.captionsText.html(c.entries.text[a]).attr("class", "mejs-captions-text " + (c.entries.times[a].identifier || "")), 
                    void b.captions.show().height(0);
                    b.captions.hide();
                } else b.captions.hide();
            }
        },
        setupSlides: function(a) {
            var b = this;
            b.slides = a, b.slides.entries.imgs = [ b.slides.entries.text.length ], b.showSlide(0);
        },
        showSlide: function(b) {
            if ("undefined" != typeof this.tracks && "undefined" != typeof this.slidesContainer) {
                var c = this, d = c.slides.entries.text[b], e = c.slides.entries.imgs[b];
                "undefined" == typeof e || "undefined" == typeof e.fadeIn ? c.slides.entries.imgs[b] = e = a('<img src="' + d + '">').on("load", function() {
                    e.appendTo(c.slidesContainer).hide().fadeIn().siblings(":visible").fadeOut();
                }) : e.is(":visible") || e.is(":animated") || e.fadeIn().siblings(":visible").fadeOut();
            }
        },
        displaySlides: function() {
            if ("undefined" != typeof this.slides) {
                var a, b = this, c = b.slides;
                for (a = 0; a < c.entries.times.length; a++) if (b.media.currentTime >= c.entries.times[a].start && b.media.currentTime <= c.entries.times[a].stop) return void b.showSlide(a);
            }
        },
        displayChapters: function() {
            var a, b = this;
            for (a = 0; a < b.tracks.length; a++) if ("chapters" == b.tracks[a].kind && b.tracks[a].isLoaded) {
                b.drawChapters(b.tracks[a]), b.hasChapters = !0;
                break;
            }
        },
        drawChapters: function(b) {
            var c, d, e = this, f = 0, g = 0;
            for (e.chapters.empty(), c = 0; c < b.entries.times.length; c++) d = b.entries.times[c].stop - b.entries.times[c].start, 
            f = Math.floor(d / e.media.duration * 100), (f + g > 100 || c == b.entries.times.length - 1 && 100 > f + g) && (f = 100 - g), 
            e.chapters.append(a('<div class="mejs-chapter" rel="' + b.entries.times[c].start + '" style="left: ' + g.toString() + "%;width: " + f.toString() + '%;"><div class="mejs-chapter-block' + (c == b.entries.times.length - 1 ? " mejs-chapter-block-last" : "") + '"><span class="ch-title">' + b.entries.text[c] + '</span><span class="ch-time">' + mejs.Utility.secondsToTimeCode(b.entries.times[c].start, e.options) + "&ndash;" + mejs.Utility.secondsToTimeCode(b.entries.times[c].stop, e.options) + "</span></div></div>")), 
            g += f;
            e.chapters.find("div.mejs-chapter").click(function() {
                e.media.setCurrentTime(parseFloat(a(this).attr("rel"))), e.media.paused && e.media.play();
            }), e.chapters.show();
        }
    }), mejs.language = {
        codes: {
            af: "Afrikaans",
            sq: "Albanian",
            ar: "Arabic",
            be: "Belarusian",
            bg: "Bulgarian",
            ca: "Catalan",
            zh: "Chinese",
            "zh-cn": "Chinese Simplified",
            "zh-tw": "Chinese Traditional",
            hr: "Croatian",
            cs: "Czech",
            da: "Danish",
            nl: "Dutch",
            en: "English",
            et: "Estonian",
            fl: "Filipino",
            fi: "Finnish",
            fr: "French",
            gl: "Galician",
            de: "German",
            el: "Greek",
            ht: "Haitian Creole",
            iw: "Hebrew",
            hi: "Hindi",
            hu: "Hungarian",
            is: "Icelandic",
            id: "Indonesian",
            ga: "Irish",
            it: "Italian",
            ja: "Japanese",
            ko: "Korean",
            lv: "Latvian",
            lt: "Lithuanian",
            mk: "Macedonian",
            ms: "Malay",
            mt: "Maltese",
            no: "Norwegian",
            fa: "Persian",
            pl: "Polish",
            pt: "Portuguese",
            ro: "Romanian",
            ru: "Russian",
            sr: "Serbian",
            sk: "Slovak",
            sl: "Slovenian",
            es: "Spanish",
            sw: "Swahili",
            sv: "Swedish",
            tl: "Tagalog",
            th: "Thai",
            tr: "Turkish",
            uk: "Ukrainian",
            vi: "Vietnamese",
            cy: "Welsh",
            yi: "Yiddish"
        }
    }, mejs.TrackFormatParser = {
        webvtt: {
            pattern_timecode: /^((?:[0-9]{1,2}:)?[0-9]{2}:[0-9]{2}([,.][0-9]{1,3})?) --\> ((?:[0-9]{1,2}:)?[0-9]{2}:[0-9]{2}([,.][0-9]{3})?)(.*)$/,
            parse: function(b) {
                for (var c, d, e, f = 0, g = mejs.TrackFormatParser.split2(b, /\r?\n/), h = {
                    text: [],
                    times: []
                }; f < g.length; f++) {
                    if (c = this.pattern_timecode.exec(g[f]), c && f < g.length) {
                        for (f - 1 >= 0 && "" !== g[f - 1] && (e = g[f - 1]), f++, d = g[f], f++; "" !== g[f] && f < g.length; ) d = d + "\n" + g[f], 
                        f++;
                        d = a.trim(d).replace(/(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gi, "<a href='$1' target='_blank'>$1</a>"), 
                        h.text.push(d), h.times.push({
                            identifier: e,
                            start: 0 === mejs.Utility.convertSMPTEtoSeconds(c[1]) ? .2 : mejs.Utility.convertSMPTEtoSeconds(c[1]),
                            stop: mejs.Utility.convertSMPTEtoSeconds(c[3]),
                            settings: c[5]
                        });
                    }
                    e = "";
                }
                return h;
            }
        },
        dfxp: {
            parse: function(b) {
                b = a(b).filter("tt");
                var c, d, e = 0, f = b.children("div").eq(0), g = f.find("p"), h = b.find("#" + f.attr("style")), i = {
                    text: [],
                    times: []
                };
                if (h.length) {
                    var j = h.removeAttr("id").get(0).attributes;
                    if (j.length) for (c = {}, e = 0; e < j.length; e++) c[j[e].name.split(":")[1]] = j[e].value;
                }
                for (e = 0; e < g.length; e++) {
                    var k, l = {
                        start: null,
                        stop: null,
                        style: null
                    };
                    if (g.eq(e).attr("begin") && (l.start = mejs.Utility.convertSMPTEtoSeconds(g.eq(e).attr("begin"))), 
                    !l.start && g.eq(e - 1).attr("end") && (l.start = mejs.Utility.convertSMPTEtoSeconds(g.eq(e - 1).attr("end"))), 
                    g.eq(e).attr("end") && (l.stop = mejs.Utility.convertSMPTEtoSeconds(g.eq(e).attr("end"))), 
                    !l.stop && g.eq(e + 1).attr("begin") && (l.stop = mejs.Utility.convertSMPTEtoSeconds(g.eq(e + 1).attr("begin"))), 
                    c) {
                        k = "";
                        for (var m in c) k += m + ":" + c[m] + ";";
                    }
                    k && (l.style = k), 0 === l.start && (l.start = .2), i.times.push(l), d = a.trim(g.eq(e).html()).replace(/(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gi, "<a href='$1' target='_blank'>$1</a>"), 
                    i.text.push(d);
                }
                return i;
            }
        },
        split2: function(a, b) {
            return a.split(b);
        }
    }, 3 != "x\n\ny".split(/\n/gi).length && (mejs.TrackFormatParser.split2 = function(a, b) {
        var c, d = [], e = "";
        for (c = 0; c < a.length; c++) e += a.substring(c, c + 1), b.test(e) && (d.push(e.replace(b, "")), 
        e = "");
        return d.push(e), d;
    });
}(mejs.$), function(a) {
    a.extend(mejs.MepDefaults, {
        sourcechooserText: ""
    }), a.extend(MediaElementPlayer.prototype, {
        buildsourcechooser: function(b, c, d, e) {
            var f, g = this, h = g.options.sourcechooserText ? g.options.sourcechooserText : mejs.i18n.t("mejs.source-chooser");
            b.sourcechooserButton = a('<div class="mejs-button mejs-sourcechooser-button"><button type="button" role="button" aria-haspopup="true" aria-owns="' + g.id + '" title="' + h + '" aria-label="' + h + '"></button><div class="mejs-sourcechooser-selector mejs-offscreen" role="menu" aria-expanded="false" aria-hidden="true"><ul></ul></div></div>').appendTo(c).hover(function() {
                clearTimeout(f), b.showSourcechooserSelector();
            }, function() {
                a(this);
                f = setTimeout(function() {
                    b.hideSourcechooserSelector();
                }, 500);
            }).on("keydown", function(c) {
                var d = c.keyCode;
                switch (d) {
                  case 32:
                    mejs.MediaFeatures.isFirefox || b.showSourcechooserSelector(), a(this).find(".mejs-sourcechooser-selector").find("input[type=radio]:checked").first().focus();
                    break;

                  case 13:
                    b.showSourcechooserSelector(), a(this).find(".mejs-sourcechooser-selector").find("input[type=radio]:checked").first().focus();
                    break;

                  case 27:
                    b.hideSourcechooserSelector(), a(this).find("button").focus();
                    break;

                  default:
                    return !0;
                }
            }).on("focusout", mejs.Utility.debounce(function(c) {
                setTimeout(function() {
                    var c = a(document.activeElement).closest(".mejs-sourcechooser-selector");
                    c.length || b.hideSourcechooserSelector();
                }, 0);
            }, 100)).delegate("input[type=radio]", "click", function() {
                a(this).attr("aria-selected", !0).attr("checked", "checked"), a(this).closest(".mejs-sourcechooser-selector").find("input[type=radio]").not(this).attr("aria-selected", "false").removeAttr("checked");
                var b = this.value;
                if (e.currentSrc != b) {
                    var c = e.currentTime, d = e.paused;
                    e.pause(), e.setSrc(b), e.addEventListener("loadedmetadata", function(a) {
                        e.currentTime = c;
                    }, !0);
                    var f = function(a) {
                        d || e.play(), e.removeEventListener("canplay", f, !0);
                    };
                    e.addEventListener("canplay", f, !0), e.load();
                }
            }).delegate("button", "click", function(c) {
                a(this).siblings(".mejs-sourcechooser-selector").hasClass("mejs-offscreen") ? (b.showSourcechooserSelector(), 
                a(this).siblings(".mejs-sourcechooser-selector").find("input[type=radio]:checked").first().focus()) : b.hideSourcechooserSelector();
            });
            for (var i in this.node.children) {
                var j = this.node.children[i];
                "SOURCE" !== j.nodeName || "probably" != e.canPlayType(j.type) && "maybe" != e.canPlayType(j.type) || b.addSourceButton(j.src, j.title, j.type, e.src == j.src);
            }
        },
        addSourceButton: function(b, c, d, e) {
            var f = this;
            ("" === c || void 0 == c) && (c = b), d = d.split("/")[1], f.sourcechooserButton.find("ul").append(a('<li><input type="radio" name="' + f.id + '_sourcechooser" id="' + f.id + "_sourcechooser_" + c + d + '" role="menuitemradio" value="' + b + '" ' + (e ? 'checked="checked"' : "") + 'aria-selected="' + e + '" /><label for="' + f.id + "_sourcechooser_" + c + d + '" aria-hidden="true">' + c + " (" + d + ")</label></li>")), 
            f.adjustSourcechooserBox();
        },
        adjustSourcechooserBox: function() {
            var a = this;
            a.sourcechooserButton.find(".mejs-sourcechooser-selector").height(a.sourcechooserButton.find(".mejs-sourcechooser-selector ul").outerHeight(!0));
        },
        hideSourcechooserSelector: function() {
            this.sourcechooserButton.find(".mejs-sourcechooser-selector").addClass("mejs-offscreen").attr("aria-expanded", "false").attr("aria-hidden", "true").find("input[type=radio]").attr("tabindex", "-1");
        },
        showSourcechooserSelector: function() {
            this.sourcechooserButton.find(".mejs-sourcechooser-selector").removeClass("mejs-offscreen").attr("aria-expanded", "true").attr("aria-hidden", "false").find("input[type=radio]").attr("tabindex", "0");
        }
    });
}(mejs.$), function(a) {
    a.extend(mejs.MepDefaults, {
        contextMenuItems: [ {
            render: function(a) {
                return "undefined" == typeof a.enterFullScreen ? null : a.isFullScreen ? mejs.i18n.t("mejs.fullscreen-off") : mejs.i18n.t("mejs.fullscreen-on");
            },
            click: function(a) {
                a.isFullScreen ? a.exitFullScreen() : a.enterFullScreen();
            }
        }, {
            render: function(a) {
                return a.media.muted ? mejs.i18n.t("mejs.unmute") : mejs.i18n.t("mejs.mute");
            },
            click: function(a) {
                a.media.muted ? a.setMuted(!1) : a.setMuted(!0);
            }
        }, {
            isSeparator: !0
        }, {
            render: function(a) {
                return mejs.i18n.t("mejs.download-video");
            },
            click: function(a) {
                window.location.href = a.media.currentSrc;
            }
        } ]
    }), a.extend(MediaElementPlayer.prototype, {
        buildcontextmenu: function(b, c, d, e) {
            b.contextMenu = a('<div class="mejs-contextmenu"></div>').appendTo(a("body")).hide(), 
            b.container.bind("contextmenu", function(a) {
                return b.isContextMenuEnabled ? (a.preventDefault(), b.renderContextMenu(a.clientX - 1, a.clientY - 1), 
                !1) : void 0;
            }), b.container.bind("click", function() {
                b.contextMenu.hide();
            }), b.contextMenu.bind("mouseleave", function() {
                b.startContextMenuTimer();
            });
        },
        cleancontextmenu: function(a) {
            a.contextMenu.remove();
        },
        isContextMenuEnabled: !0,
        enableContextMenu: function() {
            this.isContextMenuEnabled = !0;
        },
        disableContextMenu: function() {
            this.isContextMenuEnabled = !1;
        },
        contextMenuTimeout: null,
        startContextMenuTimer: function() {
            var a = this;
            a.killContextMenuTimer(), a.contextMenuTimer = setTimeout(function() {
                a.hideContextMenu(), a.killContextMenuTimer();
            }, 750);
        },
        killContextMenuTimer: function() {
            var a = this.contextMenuTimer;
            null != a && (clearTimeout(a), delete a, a = null);
        },
        hideContextMenu: function() {
            this.contextMenu.hide();
        },
        renderContextMenu: function(b, c) {
            for (var d = this, e = "", f = d.options.contextMenuItems, g = 0, h = f.length; h > g; g++) if (f[g].isSeparator) e += '<div class="mejs-contextmenu-separator"></div>'; else {
                var i = f[g].render(d);
                null != i && (e += '<div class="mejs-contextmenu-item" data-itemindex="' + g + '" id="element-' + 1e6 * Math.random() + '">' + i + "</div>");
            }
            d.contextMenu.empty().append(a(e)).css({
                top: c,
                left: b
            }).show(), d.contextMenu.find(".mejs-contextmenu-item").each(function() {
                var b = a(this), c = parseInt(b.data("itemindex"), 10), e = d.options.contextMenuItems[c];
                "undefined" != typeof e.show && e.show(b, d), b.click(function() {
                    "undefined" != typeof e.click && e.click(d), d.contextMenu.hide();
                });
            }), setTimeout(function() {
                d.killControlsTimer("rev3");
            }, 100);
        }
    });
}(mejs.$), function(a) {
    a.extend(mejs.MepDefaults, {
        skipBackInterval: 30,
        skipBackText: ""
    }), a.extend(MediaElementPlayer.prototype, {
        buildskipback: function(b, c, d, e) {
            var f = this, g = mejs.i18n.t("mejs.time-skip-back", f.options.skipBackInterval), h = f.options.skipBackText ? f.options.skipBackText : g;
            a('<div class="mejs-button mejs-skip-back-button"><button type="button" aria-controls="' + f.id + '" title="' + h + '" aria-label="' + h + '">' + f.options.skipBackInterval + "</button></div>").appendTo(c).click(function() {
                e.setCurrentTime(Math.max(e.currentTime - f.options.skipBackInterval, 0)), a(this).find("button").blur();
            });
        }
    });
}(mejs.$), function(a) {
    a.extend(mejs.MepDefaults, {
        postrollCloseText: ""
    }), a.extend(MediaElementPlayer.prototype, {
        buildpostroll: function(b, c, d, e) {
            var f = this, g = f.options.postrollCloseText ? f.options.postrollCloseText : mejs.i18n.t("mejs.close"), h = f.container.find('link[rel="postroll"]').attr("href");
            "undefined" != typeof h && (b.postroll = a('<div class="mejs-postroll-layer mejs-layer"><a class="mejs-postroll-close" onclick="$(this).parent().hide();return false;">' + g + '</a><div class="mejs-postroll-layer-content"></div></div>').prependTo(d).hide(), 
            f.media.addEventListener("ended", function(c) {
                a.ajax({
                    dataType: "html",
                    url: h,
                    success: function(a, b) {
                        d.find(".mejs-postroll-layer-content").html(a);
                    }
                }), b.postroll.show();
            }, !1));
        }
    });
}(mejs.$), function(a) {
    a.extend(mejs.MepDefaults, {
        markerColor: "#E9BC3D",
        markers: [],
        markerCallback: function() {}
    }), a.extend(MediaElementPlayer.prototype, {
        buildmarkers: function(a, b, c, d) {
            var e = 0, f = -1, g = -1, h = -1, i = -1;
            for (e = 0; e < a.options.markers.length; ++e) b.find(".mejs-time-total").append('<span class="mejs-time-marker"></span>');
            d.addEventListener("durationchange", function(c) {
                a.setmarkers(b);
            }), d.addEventListener("timeupdate", function(b) {
                for (f = Math.floor(d.currentTime), h > f ? i > f && (i = -1) : h = f, e = 0; e < a.options.markers.length; ++e) g = Math.floor(a.options.markers[e]), 
                f === g && g !== i && (a.options.markerCallback(d, d.currentTime), i = g);
            }, !1);
        },
        setmarkers: function(b) {
            var c, d = this, e = 0;
            for (e = 0; e < d.options.markers.length; ++e) Math.floor(d.options.markers[e]) <= d.media.duration && Math.floor(d.options.markers[e]) >= 0 && (c = 100 * Math.floor(d.options.markers[e]) / d.media.duration, 
            a(b.find(".mejs-time-marker")[e]).css({
                width: "1px",
                left: c + "%",
                background: d.options.markerColor
            }));
        }
    });
}(mejs.$);

/*!
 * VERSION: 1.19.0
 * DATE: 2016-07-14
 * UPDATES AND DOCS AT: http://greensock.com
 * 
 * Includes all of the following: TweenLite, TweenMax, TimelineLite, TimelineMax, EasePack, CSSPlugin, RoundPropsPlugin, BezierPlugin, AttrPlugin, DirectionalRotationPlugin
 *
 * @license Copyright (c) 2008-2016, GreenSock. All rights reserved.
 * This work is subject to the terms at http://greensock.com/standard-license or for
 * Club GreenSock members, the software agreement that was issued with your membership.
 * 
 * @author: Jack Doyle, jack@greensock.com
 **/
var _gsScope = "undefined" != typeof module && module.exports && "undefined" != typeof global ? global : this || window;

(_gsScope._gsQueue || (_gsScope._gsQueue = [])).push(function() {
    "use strict";
    _gsScope._gsDefine("TweenMax", [ "core.Animation", "core.SimpleTimeline", "TweenLite" ], function(a, b, c) {
        var d = function(a) {
            var b, c = [], d = a.length;
            for (b = 0; b !== d; c.push(a[b++])) ;
            return c;
        }, e = function(a, b, c) {
            var d, e, f = a.cycle;
            for (d in f) e = f[d], a[d] = "function" == typeof e ? e(c, b[c]) : e[c % e.length];
            delete a.cycle;
        }, f = function(a, b, d) {
            c.call(this, a, b, d), this._cycle = 0, this._yoyo = this.vars.yoyo === !0, this._repeat = this.vars.repeat || 0, 
            this._repeatDelay = this.vars.repeatDelay || 0, this._dirty = !0, this.render = f.prototype.render;
        }, g = 1e-10, h = c._internals, i = h.isSelector, j = h.isArray, k = f.prototype = c.to({}, .1, {}), l = [];
        f.version = "1.19.0", k.constructor = f, k.kill()._gc = !1, f.killTweensOf = f.killDelayedCallsTo = c.killTweensOf, 
        f.getTweensOf = c.getTweensOf, f.lagSmoothing = c.lagSmoothing, f.ticker = c.ticker, 
        f.render = c.render, k.invalidate = function() {
            return this._yoyo = this.vars.yoyo === !0, this._repeat = this.vars.repeat || 0, 
            this._repeatDelay = this.vars.repeatDelay || 0, this._uncache(!0), c.prototype.invalidate.call(this);
        }, k.updateTo = function(a, b) {
            var d, e = this.ratio, f = this.vars.immediateRender || a.immediateRender;
            b && this._startTime < this._timeline._time && (this._startTime = this._timeline._time, 
            this._uncache(!1), this._gc ? this._enabled(!0, !1) : this._timeline.insert(this, this._startTime - this._delay));
            for (d in a) this.vars[d] = a[d];
            if (this._initted || f) if (b) this._initted = !1, f && this.render(0, !0, !0); else if (this._gc && this._enabled(!0, !1), 
            this._notifyPluginsOfEnabled && this._firstPT && c._onPluginEvent("_onDisable", this), 
            this._time / this._duration > .998) {
                var g = this._totalTime;
                this.render(0, !0, !1), this._initted = !1, this.render(g, !0, !1);
            } else if (this._initted = !1, this._init(), this._time > 0 || f) for (var h, i = 1 / (1 - e), j = this._firstPT; j; ) h = j.s + j.c, 
            j.c *= i, j.s = h - j.c, j = j._next;
            return this;
        }, k.render = function(a, b, c) {
            this._initted || 0 === this._duration && this.vars.repeat && this.invalidate();
            var d, e, f, i, j, k, l, m, n = this._dirty ? this.totalDuration() : this._totalDuration, o = this._time, p = this._totalTime, q = this._cycle, r = this._duration, s = this._rawPrevTime;
            if (a >= n - 1e-7 ? (this._totalTime = n, this._cycle = this._repeat, this._yoyo && 0 !== (1 & this._cycle) ? (this._time = 0, 
            this.ratio = this._ease._calcEnd ? this._ease.getRatio(0) : 0) : (this._time = r, 
            this.ratio = this._ease._calcEnd ? this._ease.getRatio(1) : 1), this._reversed || (d = !0, 
            e = "onComplete", c = c || this._timeline.autoRemoveChildren), 0 === r && (this._initted || !this.vars.lazy || c) && (this._startTime === this._timeline._duration && (a = 0), 
            (0 > s || 0 >= a && a >= -1e-7 || s === g && "isPause" !== this.data) && s !== a && (c = !0, 
            s > g && (e = "onReverseComplete")), this._rawPrevTime = m = !b || a || s === a ? a : g)) : 1e-7 > a ? (this._totalTime = this._time = this._cycle = 0, 
            this.ratio = this._ease._calcEnd ? this._ease.getRatio(0) : 0, (0 !== p || 0 === r && s > 0) && (e = "onReverseComplete", 
            d = this._reversed), 0 > a && (this._active = !1, 0 === r && (this._initted || !this.vars.lazy || c) && (s >= 0 && (c = !0), 
            this._rawPrevTime = m = !b || a || s === a ? a : g)), this._initted || (c = !0)) : (this._totalTime = this._time = a, 
            0 !== this._repeat && (i = r + this._repeatDelay, this._cycle = this._totalTime / i >> 0, 
            0 !== this._cycle && this._cycle === this._totalTime / i && a >= p && this._cycle--, 
            this._time = this._totalTime - this._cycle * i, this._yoyo && 0 !== (1 & this._cycle) && (this._time = r - this._time), 
            this._time > r ? this._time = r : this._time < 0 && (this._time = 0)), this._easeType ? (j = this._time / r, 
            k = this._easeType, l = this._easePower, (1 === k || 3 === k && j >= .5) && (j = 1 - j), 
            3 === k && (j *= 2), 1 === l ? j *= j : 2 === l ? j *= j * j : 3 === l ? j *= j * j * j : 4 === l && (j *= j * j * j * j), 
            1 === k ? this.ratio = 1 - j : 2 === k ? this.ratio = j : this._time / r < .5 ? this.ratio = j / 2 : this.ratio = 1 - j / 2) : this.ratio = this._ease.getRatio(this._time / r)), 
            o === this._time && !c && q === this._cycle) return void (p !== this._totalTime && this._onUpdate && (b || this._callback("onUpdate")));
            if (!this._initted) {
                if (this._init(), !this._initted || this._gc) return;
                if (!c && this._firstPT && (this.vars.lazy !== !1 && this._duration || this.vars.lazy && !this._duration)) return this._time = o, 
                this._totalTime = p, this._rawPrevTime = s, this._cycle = q, h.lazyTweens.push(this), 
                void (this._lazy = [ a, b ]);
                this._time && !d ? this.ratio = this._ease.getRatio(this._time / r) : d && this._ease._calcEnd && (this.ratio = this._ease.getRatio(0 === this._time ? 0 : 1));
            }
            for (this._lazy !== !1 && (this._lazy = !1), this._active || !this._paused && this._time !== o && a >= 0 && (this._active = !0), 
            0 === p && (2 === this._initted && a > 0 && this._init(), this._startAt && (a >= 0 ? this._startAt.render(a, b, c) : e || (e = "_dummyGS")), 
            this.vars.onStart && (0 !== this._totalTime || 0 === r) && (b || this._callback("onStart"))), 
            f = this._firstPT; f; ) f.f ? f.t[f.p](f.c * this.ratio + f.s) : f.t[f.p] = f.c * this.ratio + f.s, 
            f = f._next;
            this._onUpdate && (0 > a && this._startAt && this._startTime && this._startAt.render(a, b, c), 
            b || (this._totalTime !== p || e) && this._callback("onUpdate")), this._cycle !== q && (b || this._gc || this.vars.onRepeat && this._callback("onRepeat")), 
            e && (!this._gc || c) && (0 > a && this._startAt && !this._onUpdate && this._startTime && this._startAt.render(a, b, c), 
            d && (this._timeline.autoRemoveChildren && this._enabled(!1, !1), this._active = !1), 
            !b && this.vars[e] && this._callback(e), 0 === r && this._rawPrevTime === g && m !== g && (this._rawPrevTime = 0));
        }, f.to = function(a, b, c) {
            return new f(a, b, c);
        }, f.from = function(a, b, c) {
            return c.runBackwards = !0, c.immediateRender = 0 != c.immediateRender, new f(a, b, c);
        }, f.fromTo = function(a, b, c, d) {
            return d.startAt = c, d.immediateRender = 0 != d.immediateRender && 0 != c.immediateRender, 
            new f(a, b, d);
        }, f.staggerTo = f.allTo = function(a, b, g, h, k, m, n) {
            h = h || 0;
            var o, p, q, r, s = 0, t = [], u = function() {
                g.onComplete && g.onComplete.apply(g.onCompleteScope || this, arguments), k.apply(n || g.callbackScope || this, m || l);
            }, v = g.cycle, w = g.startAt && g.startAt.cycle;
            for (j(a) || ("string" == typeof a && (a = c.selector(a) || a), i(a) && (a = d(a))), 
            a = a || [], 0 > h && (a = d(a), a.reverse(), h *= -1), o = a.length - 1, q = 0; o >= q; q++) {
                p = {};
                for (r in g) p[r] = g[r];
                if (v && (e(p, a, q), null != p.duration && (b = p.duration, delete p.duration)), 
                w) {
                    w = p.startAt = {};
                    for (r in g.startAt) w[r] = g.startAt[r];
                    e(p.startAt, a, q);
                }
                p.delay = s + (p.delay || 0), q === o && k && (p.onComplete = u), t[q] = new f(a[q], b, p), 
                s += h;
            }
            return t;
        }, f.staggerFrom = f.allFrom = function(a, b, c, d, e, g, h) {
            return c.runBackwards = !0, c.immediateRender = 0 != c.immediateRender, f.staggerTo(a, b, c, d, e, g, h);
        }, f.staggerFromTo = f.allFromTo = function(a, b, c, d, e, g, h, i) {
            return d.startAt = c, d.immediateRender = 0 != d.immediateRender && 0 != c.immediateRender, 
            f.staggerTo(a, b, d, e, g, h, i);
        }, f.delayedCall = function(a, b, c, d, e) {
            return new f(b, 0, {
                delay: a,
                onComplete: b,
                onCompleteParams: c,
                callbackScope: d,
                onReverseComplete: b,
                onReverseCompleteParams: c,
                immediateRender: !1,
                useFrames: e,
                overwrite: 0
            });
        }, f.set = function(a, b) {
            return new f(a, 0, b);
        }, f.isTweening = function(a) {
            return c.getTweensOf(a, !0).length > 0;
        };
        var m = function(a, b) {
            for (var d = [], e = 0, f = a._first; f; ) f instanceof c ? d[e++] = f : (b && (d[e++] = f), 
            d = d.concat(m(f, b)), e = d.length), f = f._next;
            return d;
        }, n = f.getAllTweens = function(b) {
            return m(a._rootTimeline, b).concat(m(a._rootFramesTimeline, b));
        };
        f.killAll = function(a, c, d, e) {
            null == c && (c = !0), null == d && (d = !0);
            var f, g, h, i = n(0 != e), j = i.length, k = c && d && e;
            for (h = 0; j > h; h++) g = i[h], (k || g instanceof b || (f = g.target === g.vars.onComplete) && d || c && !f) && (a ? g.totalTime(g._reversed ? 0 : g.totalDuration()) : g._enabled(!1, !1));
        }, f.killChildTweensOf = function(a, b) {
            if (null != a) {
                var e, g, k, l, m, n = h.tweenLookup;
                if ("string" == typeof a && (a = c.selector(a) || a), i(a) && (a = d(a)), j(a)) for (l = a.length; --l > -1; ) f.killChildTweensOf(a[l], b); else {
                    e = [];
                    for (k in n) for (g = n[k].target.parentNode; g; ) g === a && (e = e.concat(n[k].tweens)), 
                    g = g.parentNode;
                    for (m = e.length, l = 0; m > l; l++) b && e[l].totalTime(e[l].totalDuration()), 
                    e[l]._enabled(!1, !1);
                }
            }
        };
        var o = function(a, c, d, e) {
            c = c !== !1, d = d !== !1, e = e !== !1;
            for (var f, g, h = n(e), i = c && d && e, j = h.length; --j > -1; ) g = h[j], (i || g instanceof b || (f = g.target === g.vars.onComplete) && d || c && !f) && g.paused(a);
        };
        return f.pauseAll = function(a, b, c) {
            o(!0, a, b, c);
        }, f.resumeAll = function(a, b, c) {
            o(!1, a, b, c);
        }, f.globalTimeScale = function(b) {
            var d = a._rootTimeline, e = c.ticker.time;
            return arguments.length ? (b = b || g, d._startTime = e - (e - d._startTime) * d._timeScale / b, 
            d = a._rootFramesTimeline, e = c.ticker.frame, d._startTime = e - (e - d._startTime) * d._timeScale / b, 
            d._timeScale = a._rootTimeline._timeScale = b, b) : d._timeScale;
        }, k.progress = function(a, b) {
            return arguments.length ? this.totalTime(this.duration() * (this._yoyo && 0 !== (1 & this._cycle) ? 1 - a : a) + this._cycle * (this._duration + this._repeatDelay), b) : this._time / this.duration();
        }, k.totalProgress = function(a, b) {
            return arguments.length ? this.totalTime(this.totalDuration() * a, b) : this._totalTime / this.totalDuration();
        }, k.time = function(a, b) {
            return arguments.length ? (this._dirty && this.totalDuration(), a > this._duration && (a = this._duration), 
            this._yoyo && 0 !== (1 & this._cycle) ? a = this._duration - a + this._cycle * (this._duration + this._repeatDelay) : 0 !== this._repeat && (a += this._cycle * (this._duration + this._repeatDelay)), 
            this.totalTime(a, b)) : this._time;
        }, k.duration = function(b) {
            return arguments.length ? a.prototype.duration.call(this, b) : this._duration;
        }, k.totalDuration = function(a) {
            return arguments.length ? -1 === this._repeat ? this : this.duration((a - this._repeat * this._repeatDelay) / (this._repeat + 1)) : (this._dirty && (this._totalDuration = -1 === this._repeat ? 999999999999 : this._duration * (this._repeat + 1) + this._repeatDelay * this._repeat, 
            this._dirty = !1), this._totalDuration);
        }, k.repeat = function(a) {
            return arguments.length ? (this._repeat = a, this._uncache(!0)) : this._repeat;
        }, k.repeatDelay = function(a) {
            return arguments.length ? (this._repeatDelay = a, this._uncache(!0)) : this._repeatDelay;
        }, k.yoyo = function(a) {
            return arguments.length ? (this._yoyo = a, this) : this._yoyo;
        }, f;
    }, !0), _gsScope._gsDefine("TimelineLite", [ "core.Animation", "core.SimpleTimeline", "TweenLite" ], function(a, b, c) {
        var d = function(a) {
            b.call(this, a), this._labels = {}, this.autoRemoveChildren = this.vars.autoRemoveChildren === !0, 
            this.smoothChildTiming = this.vars.smoothChildTiming === !0, this._sortChildren = !0, 
            this._onUpdate = this.vars.onUpdate;
            var c, d, e = this.vars;
            for (d in e) c = e[d], i(c) && -1 !== c.join("").indexOf("{self}") && (e[d] = this._swapSelfInParams(c));
            i(e.tweens) && this.add(e.tweens, 0, e.align, e.stagger);
        }, e = 1e-10, f = c._internals, g = d._internals = {}, h = f.isSelector, i = f.isArray, j = f.lazyTweens, k = f.lazyRender, l = _gsScope._gsDefine.globals, m = function(a) {
            var b, c = {};
            for (b in a) c[b] = a[b];
            return c;
        }, n = function(a, b, c) {
            var d, e, f = a.cycle;
            for (d in f) e = f[d], a[d] = "function" == typeof e ? e.call(b[c], c) : e[c % e.length];
            delete a.cycle;
        }, o = g.pauseCallback = function() {}, p = function(a) {
            var b, c = [], d = a.length;
            for (b = 0; b !== d; c.push(a[b++])) ;
            return c;
        }, q = d.prototype = new b();
        return d.version = "1.19.0", q.constructor = d, q.kill()._gc = q._forcingPlayhead = q._hasPause = !1, 
        q.to = function(a, b, d, e) {
            var f = d.repeat && l.TweenMax || c;
            return b ? this.add(new f(a, b, d), e) : this.set(a, d, e);
        }, q.from = function(a, b, d, e) {
            return this.add((d.repeat && l.TweenMax || c).from(a, b, d), e);
        }, q.fromTo = function(a, b, d, e, f) {
            var g = e.repeat && l.TweenMax || c;
            return b ? this.add(g.fromTo(a, b, d, e), f) : this.set(a, e, f);
        }, q.staggerTo = function(a, b, e, f, g, i, j, k) {
            var l, o, q = new d({
                onComplete: i,
                onCompleteParams: j,
                callbackScope: k,
                smoothChildTiming: this.smoothChildTiming
            }), r = e.cycle;
            for ("string" == typeof a && (a = c.selector(a) || a), a = a || [], h(a) && (a = p(a)), 
            f = f || 0, 0 > f && (a = p(a), a.reverse(), f *= -1), o = 0; o < a.length; o++) l = m(e), 
            l.startAt && (l.startAt = m(l.startAt), l.startAt.cycle && n(l.startAt, a, o)), 
            r && (n(l, a, o), null != l.duration && (b = l.duration, delete l.duration)), q.to(a[o], b, l, o * f);
            return this.add(q, g);
        }, q.staggerFrom = function(a, b, c, d, e, f, g, h) {
            return c.immediateRender = 0 != c.immediateRender, c.runBackwards = !0, this.staggerTo(a, b, c, d, e, f, g, h);
        }, q.staggerFromTo = function(a, b, c, d, e, f, g, h, i) {
            return d.startAt = c, d.immediateRender = 0 != d.immediateRender && 0 != c.immediateRender, 
            this.staggerTo(a, b, d, e, f, g, h, i);
        }, q.call = function(a, b, d, e) {
            return this.add(c.delayedCall(0, a, b, d), e);
        }, q.set = function(a, b, d) {
            return d = this._parseTimeOrLabel(d, 0, !0), null == b.immediateRender && (b.immediateRender = d === this._time && !this._paused), 
            this.add(new c(a, 0, b), d);
        }, d.exportRoot = function(a, b) {
            a = a || {}, null == a.smoothChildTiming && (a.smoothChildTiming = !0);
            var e, f, g = new d(a), h = g._timeline;
            for (null == b && (b = !0), h._remove(g, !0), g._startTime = 0, g._rawPrevTime = g._time = g._totalTime = h._time, 
            e = h._first; e; ) f = e._next, b && e instanceof c && e.target === e.vars.onComplete || g.add(e, e._startTime - e._delay), 
            e = f;
            return h.add(g, 0), g;
        }, q.add = function(e, f, g, h) {
            var j, k, l, m, n, o;
            if ("number" != typeof f && (f = this._parseTimeOrLabel(f, 0, !0, e)), !(e instanceof a)) {
                if (e instanceof Array || e && e.push && i(e)) {
                    for (g = g || "normal", h = h || 0, j = f, k = e.length, l = 0; k > l; l++) i(m = e[l]) && (m = new d({
                        tweens: m
                    })), this.add(m, j), "string" != typeof m && "function" != typeof m && ("sequence" === g ? j = m._startTime + m.totalDuration() / m._timeScale : "start" === g && (m._startTime -= m.delay())), 
                    j += h;
                    return this._uncache(!0);
                }
                if ("string" == typeof e) return this.addLabel(e, f);
                if ("function" != typeof e) throw "Cannot add " + e + " into the timeline; it is not a tween, timeline, function, or string.";
                e = c.delayedCall(0, e);
            }
            if (b.prototype.add.call(this, e, f), (this._gc || this._time === this._duration) && !this._paused && this._duration < this.duration()) for (n = this, 
            o = n.rawTime() > e._startTime; n._timeline; ) o && n._timeline.smoothChildTiming ? n.totalTime(n._totalTime, !0) : n._gc && n._enabled(!0, !1), 
            n = n._timeline;
            return this;
        }, q.remove = function(b) {
            if (b instanceof a) {
                this._remove(b, !1);
                var c = b._timeline = b.vars.useFrames ? a._rootFramesTimeline : a._rootTimeline;
                return b._startTime = (b._paused ? b._pauseTime : c._time) - (b._reversed ? b.totalDuration() - b._totalTime : b._totalTime) / b._timeScale, 
                this;
            }
            if (b instanceof Array || b && b.push && i(b)) {
                for (var d = b.length; --d > -1; ) this.remove(b[d]);
                return this;
            }
            return "string" == typeof b ? this.removeLabel(b) : this.kill(null, b);
        }, q._remove = function(a, c) {
            b.prototype._remove.call(this, a, c);
            var d = this._last;
            return d ? this._time > d._startTime + d._totalDuration / d._timeScale && (this._time = this.duration(), 
            this._totalTime = this._totalDuration) : this._time = this._totalTime = this._duration = this._totalDuration = 0, 
            this;
        }, q.append = function(a, b) {
            return this.add(a, this._parseTimeOrLabel(null, b, !0, a));
        }, q.insert = q.insertMultiple = function(a, b, c, d) {
            return this.add(a, b || 0, c, d);
        }, q.appendMultiple = function(a, b, c, d) {
            return this.add(a, this._parseTimeOrLabel(null, b, !0, a), c, d);
        }, q.addLabel = function(a, b) {
            return this._labels[a] = this._parseTimeOrLabel(b), this;
        }, q.addPause = function(a, b, d, e) {
            var f = c.delayedCall(0, o, d, e || this);
            return f.vars.onComplete = f.vars.onReverseComplete = b, f.data = "isPause", this._hasPause = !0, 
            this.add(f, a);
        }, q.removeLabel = function(a) {
            return delete this._labels[a], this;
        }, q.getLabelTime = function(a) {
            return null != this._labels[a] ? this._labels[a] : -1;
        }, q._parseTimeOrLabel = function(b, c, d, e) {
            var f;
            if (e instanceof a && e.timeline === this) this.remove(e); else if (e && (e instanceof Array || e.push && i(e))) for (f = e.length; --f > -1; ) e[f] instanceof a && e[f].timeline === this && this.remove(e[f]);
            if ("string" == typeof c) return this._parseTimeOrLabel(c, d && "number" == typeof b && null == this._labels[c] ? b - this.duration() : 0, d);
            if (c = c || 0, "string" != typeof b || !isNaN(b) && null == this._labels[b]) null == b && (b = this.duration()); else {
                if (f = b.indexOf("="), -1 === f) return null == this._labels[b] ? d ? this._labels[b] = this.duration() + c : c : this._labels[b] + c;
                c = parseInt(b.charAt(f - 1) + "1", 10) * Number(b.substr(f + 1)), b = f > 1 ? this._parseTimeOrLabel(b.substr(0, f - 1), 0, d) : this.duration();
            }
            return Number(b) + c;
        }, q.seek = function(a, b) {
            return this.totalTime("number" == typeof a ? a : this._parseTimeOrLabel(a), b !== !1);
        }, q.stop = function() {
            return this.paused(!0);
        }, q.gotoAndPlay = function(a, b) {
            return this.play(a, b);
        }, q.gotoAndStop = function(a, b) {
            return this.pause(a, b);
        }, q.render = function(a, b, c) {
            this._gc && this._enabled(!0, !1);
            var d, f, g, h, i, l, m, n = this._dirty ? this.totalDuration() : this._totalDuration, o = this._time, p = this._startTime, q = this._timeScale, r = this._paused;
            if (a >= n - 1e-7) this._totalTime = this._time = n, this._reversed || this._hasPausedChild() || (f = !0, 
            h = "onComplete", i = !!this._timeline.autoRemoveChildren, 0 === this._duration && (0 >= a && a >= -1e-7 || this._rawPrevTime < 0 || this._rawPrevTime === e) && this._rawPrevTime !== a && this._first && (i = !0, 
            this._rawPrevTime > e && (h = "onReverseComplete"))), this._rawPrevTime = this._duration || !b || a || this._rawPrevTime === a ? a : e, 
            a = n + 1e-4; else if (1e-7 > a) if (this._totalTime = this._time = 0, (0 !== o || 0 === this._duration && this._rawPrevTime !== e && (this._rawPrevTime > 0 || 0 > a && this._rawPrevTime >= 0)) && (h = "onReverseComplete", 
            f = this._reversed), 0 > a) this._active = !1, this._timeline.autoRemoveChildren && this._reversed ? (i = f = !0, 
            h = "onReverseComplete") : this._rawPrevTime >= 0 && this._first && (i = !0), this._rawPrevTime = a; else {
                if (this._rawPrevTime = this._duration || !b || a || this._rawPrevTime === a ? a : e, 
                0 === a && f) for (d = this._first; d && 0 === d._startTime; ) d._duration || (f = !1), 
                d = d._next;
                a = 0, this._initted || (i = !0);
            } else {
                if (this._hasPause && !this._forcingPlayhead && !b) {
                    if (a >= o) for (d = this._first; d && d._startTime <= a && !l; ) d._duration || "isPause" !== d.data || d.ratio || 0 === d._startTime && 0 === this._rawPrevTime || (l = d), 
                    d = d._next; else for (d = this._last; d && d._startTime >= a && !l; ) d._duration || "isPause" === d.data && d._rawPrevTime > 0 && (l = d), 
                    d = d._prev;
                    l && (this._time = a = l._startTime, this._totalTime = a + this._cycle * (this._totalDuration + this._repeatDelay));
                }
                this._totalTime = this._time = this._rawPrevTime = a;
            }
            if (this._time !== o && this._first || c || i || l) {
                if (this._initted || (this._initted = !0), this._active || !this._paused && this._time !== o && a > 0 && (this._active = !0), 
                0 === o && this.vars.onStart && (0 === this._time && this._duration || b || this._callback("onStart")), 
                m = this._time, m >= o) for (d = this._first; d && (g = d._next, m === this._time && (!this._paused || r)); ) (d._active || d._startTime <= m && !d._paused && !d._gc) && (l === d && this.pause(), 
                d._reversed ? d.render((d._dirty ? d.totalDuration() : d._totalDuration) - (a - d._startTime) * d._timeScale, b, c) : d.render((a - d._startTime) * d._timeScale, b, c)), 
                d = g; else for (d = this._last; d && (g = d._prev, m === this._time && (!this._paused || r)); ) {
                    if (d._active || d._startTime <= o && !d._paused && !d._gc) {
                        if (l === d) {
                            for (l = d._prev; l && l.endTime() > this._time; ) l.render(l._reversed ? l.totalDuration() - (a - l._startTime) * l._timeScale : (a - l._startTime) * l._timeScale, b, c), 
                            l = l._prev;
                            l = null, this.pause();
                        }
                        d._reversed ? d.render((d._dirty ? d.totalDuration() : d._totalDuration) - (a - d._startTime) * d._timeScale, b, c) : d.render((a - d._startTime) * d._timeScale, b, c);
                    }
                    d = g;
                }
                this._onUpdate && (b || (j.length && k(), this._callback("onUpdate"))), h && (this._gc || (p === this._startTime || q !== this._timeScale) && (0 === this._time || n >= this.totalDuration()) && (f && (j.length && k(), 
                this._timeline.autoRemoveChildren && this._enabled(!1, !1), this._active = !1), 
                !b && this.vars[h] && this._callback(h)));
            }
        }, q._hasPausedChild = function() {
            for (var a = this._first; a; ) {
                if (a._paused || a instanceof d && a._hasPausedChild()) return !0;
                a = a._next;
            }
            return !1;
        }, q.getChildren = function(a, b, d, e) {
            e = e || -9999999999;
            for (var f = [], g = this._first, h = 0; g; ) g._startTime < e || (g instanceof c ? b !== !1 && (f[h++] = g) : (d !== !1 && (f[h++] = g), 
            a !== !1 && (f = f.concat(g.getChildren(!0, b, d)), h = f.length))), g = g._next;
            return f;
        }, q.getTweensOf = function(a, b) {
            var d, e, f = this._gc, g = [], h = 0;
            for (f && this._enabled(!0, !0), d = c.getTweensOf(a), e = d.length; --e > -1; ) (d[e].timeline === this || b && this._contains(d[e])) && (g[h++] = d[e]);
            return f && this._enabled(!1, !0), g;
        }, q.recent = function() {
            return this._recent;
        }, q._contains = function(a) {
            for (var b = a.timeline; b; ) {
                if (b === this) return !0;
                b = b.timeline;
            }
            return !1;
        }, q.shiftChildren = function(a, b, c) {
            c = c || 0;
            for (var d, e = this._first, f = this._labels; e; ) e._startTime >= c && (e._startTime += a), 
            e = e._next;
            if (b) for (d in f) f[d] >= c && (f[d] += a);
            return this._uncache(!0);
        }, q._kill = function(a, b) {
            if (!a && !b) return this._enabled(!1, !1);
            for (var c = b ? this.getTweensOf(b) : this.getChildren(!0, !0, !1), d = c.length, e = !1; --d > -1; ) c[d]._kill(a, b) && (e = !0);
            return e;
        }, q.clear = function(a) {
            var b = this.getChildren(!1, !0, !0), c = b.length;
            for (this._time = this._totalTime = 0; --c > -1; ) b[c]._enabled(!1, !1);
            return a !== !1 && (this._labels = {}), this._uncache(!0);
        }, q.invalidate = function() {
            for (var b = this._first; b; ) b.invalidate(), b = b._next;
            return a.prototype.invalidate.call(this);
        }, q._enabled = function(a, c) {
            if (a === this._gc) for (var d = this._first; d; ) d._enabled(a, !0), d = d._next;
            return b.prototype._enabled.call(this, a, c);
        }, q.totalTime = function(b, c, d) {
            this._forcingPlayhead = !0;
            var e = a.prototype.totalTime.apply(this, arguments);
            return this._forcingPlayhead = !1, e;
        }, q.duration = function(a) {
            return arguments.length ? (0 !== this.duration() && 0 !== a && this.timeScale(this._duration / a), 
            this) : (this._dirty && this.totalDuration(), this._duration);
        }, q.totalDuration = function(a) {
            if (!arguments.length) {
                if (this._dirty) {
                    for (var b, c, d = 0, e = this._last, f = 999999999999; e; ) b = e._prev, e._dirty && e.totalDuration(), 
                    e._startTime > f && this._sortChildren && !e._paused ? this.add(e, e._startTime - e._delay) : f = e._startTime, 
                    e._startTime < 0 && !e._paused && (d -= e._startTime, this._timeline.smoothChildTiming && (this._startTime += e._startTime / this._timeScale), 
                    this.shiftChildren(-e._startTime, !1, -9999999999), f = 0), c = e._startTime + e._totalDuration / e._timeScale, 
                    c > d && (d = c), e = b;
                    this._duration = this._totalDuration = d, this._dirty = !1;
                }
                return this._totalDuration;
            }
            return a && this.totalDuration() ? this.timeScale(this._totalDuration / a) : this;
        }, q.paused = function(b) {
            if (!b) for (var c = this._first, d = this._time; c; ) c._startTime === d && "isPause" === c.data && (c._rawPrevTime = 0), 
            c = c._next;
            return a.prototype.paused.apply(this, arguments);
        }, q.usesFrames = function() {
            for (var b = this._timeline; b._timeline; ) b = b._timeline;
            return b === a._rootFramesTimeline;
        }, q.rawTime = function() {
            return this._paused ? this._totalTime : (this._timeline.rawTime() - this._startTime) * this._timeScale;
        }, d;
    }, !0), _gsScope._gsDefine("TimelineMax", [ "TimelineLite", "TweenLite", "easing.Ease" ], function(a, b, c) {
        var d = function(b) {
            a.call(this, b), this._repeat = this.vars.repeat || 0, this._repeatDelay = this.vars.repeatDelay || 0, 
            this._cycle = 0, this._yoyo = this.vars.yoyo === !0, this._dirty = !0;
        }, e = 1e-10, f = b._internals, g = f.lazyTweens, h = f.lazyRender, i = _gsScope._gsDefine.globals, j = new c(null, null, 1, 0), k = d.prototype = new a();
        return k.constructor = d, k.kill()._gc = !1, d.version = "1.19.0", k.invalidate = function() {
            return this._yoyo = this.vars.yoyo === !0, this._repeat = this.vars.repeat || 0, 
            this._repeatDelay = this.vars.repeatDelay || 0, this._uncache(!0), a.prototype.invalidate.call(this);
        }, k.addCallback = function(a, c, d, e) {
            return this.add(b.delayedCall(0, a, d, e), c);
        }, k.removeCallback = function(a, b) {
            if (a) if (null == b) this._kill(null, a); else for (var c = this.getTweensOf(a, !1), d = c.length, e = this._parseTimeOrLabel(b); --d > -1; ) c[d]._startTime === e && c[d]._enabled(!1, !1);
            return this;
        }, k.removePause = function(b) {
            return this.removeCallback(a._internals.pauseCallback, b);
        }, k.tweenTo = function(a, c) {
            c = c || {};
            var d, e, f, g = {
                ease: j,
                useFrames: this.usesFrames(),
                immediateRender: !1
            }, h = c.repeat && i.TweenMax || b;
            for (e in c) g[e] = c[e];
            return g.time = this._parseTimeOrLabel(a), d = Math.abs(Number(g.time) - this._time) / this._timeScale || .001, 
            f = new h(this, d, g), g.onStart = function() {
                f.target.paused(!0), f.vars.time !== f.target.time() && d === f.duration() && f.duration(Math.abs(f.vars.time - f.target.time()) / f.target._timeScale), 
                c.onStart && f._callback("onStart");
            }, f;
        }, k.tweenFromTo = function(a, b, c) {
            c = c || {}, a = this._parseTimeOrLabel(a), c.startAt = {
                onComplete: this.seek,
                onCompleteParams: [ a ],
                callbackScope: this
            }, c.immediateRender = c.immediateRender !== !1;
            var d = this.tweenTo(b, c);
            return d.duration(Math.abs(d.vars.time - a) / this._timeScale || .001);
        }, k.render = function(a, b, c) {
            this._gc && this._enabled(!0, !1);
            var d, f, i, j, k, l, m, n, o = this._dirty ? this.totalDuration() : this._totalDuration, p = this._duration, q = this._time, r = this._totalTime, s = this._startTime, t = this._timeScale, u = this._rawPrevTime, v = this._paused, w = this._cycle;
            if (a >= o - 1e-7) this._locked || (this._totalTime = o, this._cycle = this._repeat), 
            this._reversed || this._hasPausedChild() || (f = !0, j = "onComplete", k = !!this._timeline.autoRemoveChildren, 
            0 === this._duration && (0 >= a && a >= -1e-7 || 0 > u || u === e) && u !== a && this._first && (k = !0, 
            u > e && (j = "onReverseComplete"))), this._rawPrevTime = this._duration || !b || a || this._rawPrevTime === a ? a : e, 
            this._yoyo && 0 !== (1 & this._cycle) ? this._time = a = 0 : (this._time = p, a = p + 1e-4); else if (1e-7 > a) if (this._locked || (this._totalTime = this._cycle = 0), 
            this._time = 0, (0 !== q || 0 === p && u !== e && (u > 0 || 0 > a && u >= 0) && !this._locked) && (j = "onReverseComplete", 
            f = this._reversed), 0 > a) this._active = !1, this._timeline.autoRemoveChildren && this._reversed ? (k = f = !0, 
            j = "onReverseComplete") : u >= 0 && this._first && (k = !0), this._rawPrevTime = a; else {
                if (this._rawPrevTime = p || !b || a || this._rawPrevTime === a ? a : e, 0 === a && f) for (d = this._first; d && 0 === d._startTime; ) d._duration || (f = !1), 
                d = d._next;
                a = 0, this._initted || (k = !0);
            } else if (0 === p && 0 > u && (k = !0), this._time = this._rawPrevTime = a, this._locked || (this._totalTime = a, 
            0 !== this._repeat && (l = p + this._repeatDelay, this._cycle = this._totalTime / l >> 0, 
            0 !== this._cycle && this._cycle === this._totalTime / l && a >= r && this._cycle--, 
            this._time = this._totalTime - this._cycle * l, this._yoyo && 0 !== (1 & this._cycle) && (this._time = p - this._time), 
            this._time > p ? (this._time = p, a = p + 1e-4) : this._time < 0 ? this._time = a = 0 : a = this._time)), 
            this._hasPause && !this._forcingPlayhead && !b) {
                if (a = this._time, a >= q) for (d = this._first; d && d._startTime <= a && !m; ) d._duration || "isPause" !== d.data || d.ratio || 0 === d._startTime && 0 === this._rawPrevTime || (m = d), 
                d = d._next; else for (d = this._last; d && d._startTime >= a && !m; ) d._duration || "isPause" === d.data && d._rawPrevTime > 0 && (m = d), 
                d = d._prev;
                m && (this._time = a = m._startTime, this._totalTime = a + this._cycle * (this._totalDuration + this._repeatDelay));
            }
            if (this._cycle !== w && !this._locked) {
                var x = this._yoyo && 0 !== (1 & w), y = x === (this._yoyo && 0 !== (1 & this._cycle)), z = this._totalTime, A = this._cycle, B = this._rawPrevTime, C = this._time;
                if (this._totalTime = w * p, this._cycle < w ? x = !x : this._totalTime += p, this._time = q, 
                this._rawPrevTime = 0 === p ? u - 1e-4 : u, this._cycle = w, this._locked = !0, 
                q = x ? 0 : p, this.render(q, b, 0 === p), b || this._gc || this.vars.onRepeat && this._callback("onRepeat"), 
                q !== this._time) return;
                if (y && (q = x ? p + 1e-4 : -1e-4, this.render(q, !0, !1)), this._locked = !1, 
                this._paused && !v) return;
                this._time = C, this._totalTime = z, this._cycle = A, this._rawPrevTime = B;
            }
            if (!(this._time !== q && this._first || c || k || m)) return void (r !== this._totalTime && this._onUpdate && (b || this._callback("onUpdate")));
            if (this._initted || (this._initted = !0), this._active || !this._paused && this._totalTime !== r && a > 0 && (this._active = !0), 
            0 === r && this.vars.onStart && (0 === this._totalTime && this._totalDuration || b || this._callback("onStart")), 
            n = this._time, n >= q) for (d = this._first; d && (i = d._next, n === this._time && (!this._paused || v)); ) (d._active || d._startTime <= this._time && !d._paused && !d._gc) && (m === d && this.pause(), 
            d._reversed ? d.render((d._dirty ? d.totalDuration() : d._totalDuration) - (a - d._startTime) * d._timeScale, b, c) : d.render((a - d._startTime) * d._timeScale, b, c)), 
            d = i; else for (d = this._last; d && (i = d._prev, n === this._time && (!this._paused || v)); ) {
                if (d._active || d._startTime <= q && !d._paused && !d._gc) {
                    if (m === d) {
                        for (m = d._prev; m && m.endTime() > this._time; ) m.render(m._reversed ? m.totalDuration() - (a - m._startTime) * m._timeScale : (a - m._startTime) * m._timeScale, b, c), 
                        m = m._prev;
                        m = null, this.pause();
                    }
                    d._reversed ? d.render((d._dirty ? d.totalDuration() : d._totalDuration) - (a - d._startTime) * d._timeScale, b, c) : d.render((a - d._startTime) * d._timeScale, b, c);
                }
                d = i;
            }
            this._onUpdate && (b || (g.length && h(), this._callback("onUpdate"))), j && (this._locked || this._gc || (s === this._startTime || t !== this._timeScale) && (0 === this._time || o >= this.totalDuration()) && (f && (g.length && h(), 
            this._timeline.autoRemoveChildren && this._enabled(!1, !1), this._active = !1), 
            !b && this.vars[j] && this._callback(j)));
        }, k.getActive = function(a, b, c) {
            null == a && (a = !0), null == b && (b = !0), null == c && (c = !1);
            var d, e, f = [], g = this.getChildren(a, b, c), h = 0, i = g.length;
            for (d = 0; i > d; d++) e = g[d], e.isActive() && (f[h++] = e);
            return f;
        }, k.getLabelAfter = function(a) {
            a || 0 !== a && (a = this._time);
            var b, c = this.getLabelsArray(), d = c.length;
            for (b = 0; d > b; b++) if (c[b].time > a) return c[b].name;
            return null;
        }, k.getLabelBefore = function(a) {
            null == a && (a = this._time);
            for (var b = this.getLabelsArray(), c = b.length; --c > -1; ) if (b[c].time < a) return b[c].name;
            return null;
        }, k.getLabelsArray = function() {
            var a, b = [], c = 0;
            for (a in this._labels) b[c++] = {
                time: this._labels[a],
                name: a
            };
            return b.sort(function(a, b) {
                return a.time - b.time;
            }), b;
        }, k.progress = function(a, b) {
            return arguments.length ? this.totalTime(this.duration() * (this._yoyo && 0 !== (1 & this._cycle) ? 1 - a : a) + this._cycle * (this._duration + this._repeatDelay), b) : this._time / this.duration();
        }, k.totalProgress = function(a, b) {
            return arguments.length ? this.totalTime(this.totalDuration() * a, b) : this._totalTime / this.totalDuration();
        }, k.totalDuration = function(b) {
            return arguments.length ? -1 !== this._repeat && b ? this.timeScale(this.totalDuration() / b) : this : (this._dirty && (a.prototype.totalDuration.call(this), 
            this._totalDuration = -1 === this._repeat ? 999999999999 : this._duration * (this._repeat + 1) + this._repeatDelay * this._repeat), 
            this._totalDuration);
        }, k.time = function(a, b) {
            return arguments.length ? (this._dirty && this.totalDuration(), a > this._duration && (a = this._duration), 
            this._yoyo && 0 !== (1 & this._cycle) ? a = this._duration - a + this._cycle * (this._duration + this._repeatDelay) : 0 !== this._repeat && (a += this._cycle * (this._duration + this._repeatDelay)), 
            this.totalTime(a, b)) : this._time;
        }, k.repeat = function(a) {
            return arguments.length ? (this._repeat = a, this._uncache(!0)) : this._repeat;
        }, k.repeatDelay = function(a) {
            return arguments.length ? (this._repeatDelay = a, this._uncache(!0)) : this._repeatDelay;
        }, k.yoyo = function(a) {
            return arguments.length ? (this._yoyo = a, this) : this._yoyo;
        }, k.currentLabel = function(a) {
            return arguments.length ? this.seek(a, !0) : this.getLabelBefore(this._time + 1e-8);
        }, d;
    }, !0), function() {
        var a = 180 / Math.PI, b = [], c = [], d = [], e = {}, f = _gsScope._gsDefine.globals, g = function(a, b, c, d) {
            c === d && (c = d - (d - b) / 1e6), a === b && (b = a + (c - a) / 1e6), this.a = a, 
            this.b = b, this.c = c, this.d = d, this.da = d - a, this.ca = c - a, this.ba = b - a;
        }, h = ",x,y,z,left,top,right,bottom,marginTop,marginLeft,marginRight,marginBottom,paddingLeft,paddingTop,paddingRight,paddingBottom,backgroundPosition,backgroundPosition_y,", i = function(a, b, c, d) {
            var e = {
                a: a
            }, f = {}, g = {}, h = {
                c: d
            }, i = (a + b) / 2, j = (b + c) / 2, k = (c + d) / 2, l = (i + j) / 2, m = (j + k) / 2, n = (m - l) / 8;
            return e.b = i + (a - i) / 4, f.b = l + n, e.c = f.a = (e.b + f.b) / 2, f.c = g.a = (l + m) / 2, 
            g.b = m - n, h.b = k + (d - k) / 4, g.c = h.a = (g.b + h.b) / 2, [ e, f, g, h ];
        }, j = function(a, e, f, g, h) {
            var j, k, l, m, n, o, p, q, r, s, t, u, v, w = a.length - 1, x = 0, y = a[0].a;
            for (j = 0; w > j; j++) n = a[x], k = n.a, l = n.d, m = a[x + 1].d, h ? (t = b[j], 
            u = c[j], v = (u + t) * e * .25 / (g ? .5 : d[j] || .5), o = l - (l - k) * (g ? .5 * e : 0 !== t ? v / t : 0), 
            p = l + (m - l) * (g ? .5 * e : 0 !== u ? v / u : 0), q = l - (o + ((p - o) * (3 * t / (t + u) + .5) / 4 || 0))) : (o = l - (l - k) * e * .5, 
            p = l + (m - l) * e * .5, q = l - (o + p) / 2), o += q, p += q, n.c = r = o, 0 !== j ? n.b = y : n.b = y = n.a + .6 * (n.c - n.a), 
            n.da = l - k, n.ca = r - k, n.ba = y - k, f ? (s = i(k, y, r, l), a.splice(x, 1, s[0], s[1], s[2], s[3]), 
            x += 4) : x++, y = p;
            n = a[x], n.b = y, n.c = y + .4 * (n.d - y), n.da = n.d - n.a, n.ca = n.c - n.a, 
            n.ba = y - n.a, f && (s = i(n.a, y, n.c, n.d), a.splice(x, 1, s[0], s[1], s[2], s[3]));
        }, k = function(a, d, e, f) {
            var h, i, j, k, l, m, n = [];
            if (f) for (a = [ f ].concat(a), i = a.length; --i > -1; ) "string" == typeof (m = a[i][d]) && "=" === m.charAt(1) && (a[i][d] = f[d] + Number(m.charAt(0) + m.substr(2)));
            if (h = a.length - 2, 0 > h) return n[0] = new g(a[0][d], 0, 0, a[-1 > h ? 0 : 1][d]), 
            n;
            for (i = 0; h > i; i++) j = a[i][d], k = a[i + 1][d], n[i] = new g(j, 0, 0, k), 
            e && (l = a[i + 2][d], b[i] = (b[i] || 0) + (k - j) * (k - j), c[i] = (c[i] || 0) + (l - k) * (l - k));
            return n[i] = new g(a[i][d], 0, 0, a[i + 1][d]), n;
        }, l = function(a, f, g, i, l, m) {
            var n, o, p, q, r, s, t, u, v = {}, w = [], x = m || a[0];
            l = "string" == typeof l ? "," + l + "," : h, null == f && (f = 1);
            for (o in a[0]) w.push(o);
            if (a.length > 1) {
                for (u = a[a.length - 1], t = !0, n = w.length; --n > -1; ) if (o = w[n], Math.abs(x[o] - u[o]) > .05) {
                    t = !1;
                    break;
                }
                t && (a = a.concat(), m && a.unshift(m), a.push(a[1]), m = a[a.length - 3]);
            }
            for (b.length = c.length = d.length = 0, n = w.length; --n > -1; ) o = w[n], e[o] = -1 !== l.indexOf("," + o + ","), 
            v[o] = k(a, o, e[o], m);
            for (n = b.length; --n > -1; ) b[n] = Math.sqrt(b[n]), c[n] = Math.sqrt(c[n]);
            if (!i) {
                for (n = w.length; --n > -1; ) if (e[o]) for (p = v[w[n]], s = p.length - 1, q = 0; s > q; q++) r = p[q + 1].da / c[q] + p[q].da / b[q] || 0, 
                d[q] = (d[q] || 0) + r * r;
                for (n = d.length; --n > -1; ) d[n] = Math.sqrt(d[n]);
            }
            for (n = w.length, q = g ? 4 : 1; --n > -1; ) o = w[n], p = v[o], j(p, f, g, i, e[o]), 
            t && (p.splice(0, q), p.splice(p.length - q, q));
            return v;
        }, m = function(a, b, c) {
            b = b || "soft";
            var d, e, f, h, i, j, k, l, m, n, o, p = {}, q = "cubic" === b ? 3 : 2, r = "soft" === b, s = [];
            if (r && c && (a = [ c ].concat(a)), null == a || a.length < q + 1) throw "invalid Bezier data";
            for (m in a[0]) s.push(m);
            for (j = s.length; --j > -1; ) {
                for (m = s[j], p[m] = i = [], n = 0, l = a.length, k = 0; l > k; k++) d = null == c ? a[k][m] : "string" == typeof (o = a[k][m]) && "=" === o.charAt(1) ? c[m] + Number(o.charAt(0) + o.substr(2)) : Number(o), 
                r && k > 1 && l - 1 > k && (i[n++] = (d + i[n - 2]) / 2), i[n++] = d;
                for (l = n - q + 1, n = 0, k = 0; l > k; k += q) d = i[k], e = i[k + 1], f = i[k + 2], 
                h = 2 === q ? 0 : i[k + 3], i[n++] = o = 3 === q ? new g(d, e, f, h) : new g(d, (2 * e + d) / 3, (2 * e + f) / 3, f);
                i.length = n;
            }
            return p;
        }, n = function(a, b, c) {
            for (var d, e, f, g, h, i, j, k, l, m, n, o = 1 / c, p = a.length; --p > -1; ) for (m = a[p], 
            f = m.a, g = m.d - f, h = m.c - f, i = m.b - f, d = e = 0, k = 1; c >= k; k++) j = o * k, 
            l = 1 - j, d = e - (e = (j * j * g + 3 * l * (j * h + l * i)) * j), n = p * c + k - 1, 
            b[n] = (b[n] || 0) + d * d;
        }, o = function(a, b) {
            b = b >> 0 || 6;
            var c, d, e, f, g = [], h = [], i = 0, j = 0, k = b - 1, l = [], m = [];
            for (c in a) n(a[c], g, b);
            for (e = g.length, d = 0; e > d; d++) i += Math.sqrt(g[d]), f = d % b, m[f] = i, 
            f === k && (j += i, f = d / b >> 0, l[f] = m, h[f] = j, i = 0, m = []);
            return {
                length: j,
                lengths: h,
                segments: l
            };
        }, p = _gsScope._gsDefine.plugin({
            propName: "bezier",
            priority: -1,
            version: "1.3.7",
            API: 2,
            global: !0,
            init: function(a, b, c) {
                this._target = a, b instanceof Array && (b = {
                    values: b
                }), this._func = {}, this._mod = {}, this._props = [], this._timeRes = null == b.timeResolution ? 6 : parseInt(b.timeResolution, 10);
                var d, e, f, g, h, i = b.values || [], j = {}, k = i[0], n = b.autoRotate || c.vars.orientToBezier;
                this._autoRotate = n ? n instanceof Array ? n : [ [ "x", "y", "rotation", n === !0 ? 0 : Number(n) || 0 ] ] : null;
                for (d in k) this._props.push(d);
                for (f = this._props.length; --f > -1; ) d = this._props[f], this._overwriteProps.push(d), 
                e = this._func[d] = "function" == typeof a[d], j[d] = e ? a[d.indexOf("set") || "function" != typeof a["get" + d.substr(3)] ? d : "get" + d.substr(3)]() : parseFloat(a[d]), 
                h || j[d] !== i[0][d] && (h = j);
                if (this._beziers = "cubic" !== b.type && "quadratic" !== b.type && "soft" !== b.type ? l(i, isNaN(b.curviness) ? 1 : b.curviness, !1, "thruBasic" === b.type, b.correlate, h) : m(i, b.type, j), 
                this._segCount = this._beziers[d].length, this._timeRes) {
                    var p = o(this._beziers, this._timeRes);
                    this._length = p.length, this._lengths = p.lengths, this._segments = p.segments, 
                    this._l1 = this._li = this._s1 = this._si = 0, this._l2 = this._lengths[0], this._curSeg = this._segments[0], 
                    this._s2 = this._curSeg[0], this._prec = 1 / this._curSeg.length;
                }
                if (n = this._autoRotate) for (this._initialRotations = [], n[0] instanceof Array || (this._autoRotate = n = [ n ]), 
                f = n.length; --f > -1; ) {
                    for (g = 0; 3 > g; g++) d = n[f][g], this._func[d] = "function" == typeof a[d] ? a[d.indexOf("set") || "function" != typeof a["get" + d.substr(3)] ? d : "get" + d.substr(3)] : !1;
                    d = n[f][2], this._initialRotations[f] = (this._func[d] ? this._func[d].call(this._target) : this._target[d]) || 0, 
                    this._overwriteProps.push(d);
                }
                return this._startRatio = c.vars.runBackwards ? 1 : 0, !0;
            },
            set: function(b) {
                var c, d, e, f, g, h, i, j, k, l, m = this._segCount, n = this._func, o = this._target, p = b !== this._startRatio;
                if (this._timeRes) {
                    if (k = this._lengths, l = this._curSeg, b *= this._length, e = this._li, b > this._l2 && m - 1 > e) {
                        for (j = m - 1; j > e && (this._l2 = k[++e]) <= b; ) ;
                        this._l1 = k[e - 1], this._li = e, this._curSeg = l = this._segments[e], this._s2 = l[this._s1 = this._si = 0];
                    } else if (b < this._l1 && e > 0) {
                        for (;e > 0 && (this._l1 = k[--e]) >= b; ) ;
                        0 === e && b < this._l1 ? this._l1 = 0 : e++, this._l2 = k[e], this._li = e, this._curSeg = l = this._segments[e], 
                        this._s1 = l[(this._si = l.length - 1) - 1] || 0, this._s2 = l[this._si];
                    }
                    if (c = e, b -= this._l1, e = this._si, b > this._s2 && e < l.length - 1) {
                        for (j = l.length - 1; j > e && (this._s2 = l[++e]) <= b; ) ;
                        this._s1 = l[e - 1], this._si = e;
                    } else if (b < this._s1 && e > 0) {
                        for (;e > 0 && (this._s1 = l[--e]) >= b; ) ;
                        0 === e && b < this._s1 ? this._s1 = 0 : e++, this._s2 = l[e], this._si = e;
                    }
                    h = (e + (b - this._s1) / (this._s2 - this._s1)) * this._prec || 0;
                } else c = 0 > b ? 0 : b >= 1 ? m - 1 : m * b >> 0, h = (b - c * (1 / m)) * m;
                for (d = 1 - h, e = this._props.length; --e > -1; ) f = this._props[e], g = this._beziers[f][c], 
                i = (h * h * g.da + 3 * d * (h * g.ca + d * g.ba)) * h + g.a, this._mod[f] && (i = this._mod[f](i, o)), 
                n[f] ? o[f](i) : o[f] = i;
                if (this._autoRotate) {
                    var q, r, s, t, u, v, w, x = this._autoRotate;
                    for (e = x.length; --e > -1; ) f = x[e][2], v = x[e][3] || 0, w = x[e][4] === !0 ? 1 : a, 
                    g = this._beziers[x[e][0]], q = this._beziers[x[e][1]], g && q && (g = g[c], q = q[c], 
                    r = g.a + (g.b - g.a) * h, t = g.b + (g.c - g.b) * h, r += (t - r) * h, t += (g.c + (g.d - g.c) * h - t) * h, 
                    s = q.a + (q.b - q.a) * h, u = q.b + (q.c - q.b) * h, s += (u - s) * h, u += (q.c + (q.d - q.c) * h - u) * h, 
                    i = p ? Math.atan2(u - s, t - r) * w + v : this._initialRotations[e], this._mod[f] && (i = this._mod[f](i, o)), 
                    n[f] ? o[f](i) : o[f] = i);
                }
            }
        }), q = p.prototype;
        p.bezierThrough = l, p.cubicToQuadratic = i, p._autoCSS = !0, p.quadraticToCubic = function(a, b, c) {
            return new g(a, (2 * b + a) / 3, (2 * b + c) / 3, c);
        }, p._cssRegister = function() {
            var a = f.CSSPlugin;
            if (a) {
                var b = a._internals, c = b._parseToProxy, d = b._setPluginRatio, e = b.CSSPropTween;
                b._registerComplexSpecialProp("bezier", {
                    parser: function(a, b, f, g, h, i) {
                        b instanceof Array && (b = {
                            values: b
                        }), i = new p();
                        var j, k, l, m = b.values, n = m.length - 1, o = [], q = {};
                        if (0 > n) return h;
                        for (j = 0; n >= j; j++) l = c(a, m[j], g, h, i, n !== j), o[j] = l.end;
                        for (k in b) q[k] = b[k];
                        return q.values = o, h = new e(a, "bezier", 0, 0, l.pt, 2), h.data = l, h.plugin = i, 
                        h.setRatio = d, 0 === q.autoRotate && (q.autoRotate = !0), !q.autoRotate || q.autoRotate instanceof Array || (j = q.autoRotate === !0 ? 0 : Number(q.autoRotate), 
                        q.autoRotate = null != l.end.left ? [ [ "left", "top", "rotation", j, !1 ] ] : null != l.end.x ? [ [ "x", "y", "rotation", j, !1 ] ] : !1), 
                        q.autoRotate && (g._transform || g._enableTransforms(!1), l.autoRotate = g._target._gsTransform, 
                        l.proxy.rotation = l.autoRotate.rotation || 0, g._overwriteProps.push("rotation")), 
                        i._onInitTween(l.proxy, q, g._tween), h;
                    }
                });
            }
        }, q._mod = function(a) {
            for (var b, c = this._overwriteProps, d = c.length; --d > -1; ) b = a[c[d]], b && "function" == typeof b && (this._mod[c[d]] = b);
        }, q._kill = function(a) {
            var b, c, d = this._props;
            for (b in this._beziers) if (b in a) for (delete this._beziers[b], delete this._func[b], 
            c = d.length; --c > -1; ) d[c] === b && d.splice(c, 1);
            if (d = this._autoRotate) for (c = d.length; --c > -1; ) a[d[c][2]] && d.splice(c, 1);
            return this._super._kill.call(this, a);
        };
    }(), _gsScope._gsDefine("plugins.CSSPlugin", [ "plugins.TweenPlugin", "TweenLite" ], function(a, b) {
        var c, d, e, f, g = function() {
            a.call(this, "css"), this._overwriteProps.length = 0, this.setRatio = g.prototype.setRatio;
        }, h = _gsScope._gsDefine.globals, i = {}, j = g.prototype = new a("css");
        j.constructor = g, g.version = "1.19.0", g.API = 2, g.defaultTransformPerspective = 0, 
        g.defaultSkewType = "compensated", g.defaultSmoothOrigin = !0, j = "px", g.suffixMap = {
            top: j,
            right: j,
            bottom: j,
            left: j,
            width: j,
            height: j,
            fontSize: j,
            padding: j,
            margin: j,
            perspective: j,
            lineHeight: ""
        };
        var k, l, m, n, o, p, q, r, s = /(?:\-|\.|\b)(\d|\.|e\-)+/g, t = /(?:\d|\-\d|\.\d|\-\.\d|\+=\d|\-=\d|\+=.\d|\-=\.\d)+/g, u = /(?:\+=|\-=|\-|\b)[\d\-\.]+[a-zA-Z0-9]*(?:%|\b)/gi, v = /(?![+-]?\d*\.?\d+|[+-]|e[+-]\d+)[^0-9]/g, w = /(?:\d|\-|\+|=|#|\.)*/g, x = /opacity *= *([^)]*)/i, y = /opacity:([^;]*)/i, z = /alpha\(opacity *=.+?\)/i, A = /^(rgb|hsl)/, B = /([A-Z])/g, C = /-([a-z])/gi, D = /(^(?:url\(\"|url\())|(?:(\"\))$|\)$)/gi, E = function(a, b) {
            return b.toUpperCase();
        }, F = /(?:Left|Right|Width)/i, G = /(M11|M12|M21|M22)=[\d\-\.e]+/gi, H = /progid\:DXImageTransform\.Microsoft\.Matrix\(.+?\)/i, I = /,(?=[^\)]*(?:\(|$))/gi, J = /[\s,\(]/i, K = Math.PI / 180, L = 180 / Math.PI, M = {}, N = document, O = function(a) {
            return N.createElementNS ? N.createElementNS("http://www.w3.org/1999/xhtml", a) : N.createElement(a);
        }, P = O("div"), Q = O("img"), R = g._internals = {
            _specialProps: i
        }, S = navigator.userAgent, T = function() {
            var a = S.indexOf("Android"), b = O("a");
            return m = -1 !== S.indexOf("Safari") && -1 === S.indexOf("Chrome") && (-1 === a || Number(S.substr(a + 8, 1)) > 3), 
            o = m && Number(S.substr(S.indexOf("Version/") + 8, 1)) < 6, n = -1 !== S.indexOf("Firefox"), 
            (/MSIE ([0-9]{1,}[\.0-9]{0,})/.exec(S) || /Trident\/.*rv:([0-9]{1,}[\.0-9]{0,})/.exec(S)) && (p = parseFloat(RegExp.$1)), 
            b ? (b.style.cssText = "top:1px;opacity:.55;", /^0.55/.test(b.style.opacity)) : !1;
        }(), U = function(a) {
            return x.test("string" == typeof a ? a : (a.currentStyle ? a.currentStyle.filter : a.style.filter) || "") ? parseFloat(RegExp.$1) / 100 : 1;
        }, V = function(a) {
            window.console && console.log(a);
        }, W = "", X = "", Y = function(a, b) {
            b = b || P;
            var c, d, e = b.style;
            if (void 0 !== e[a]) return a;
            for (a = a.charAt(0).toUpperCase() + a.substr(1), c = [ "O", "Moz", "ms", "Ms", "Webkit" ], 
            d = 5; --d > -1 && void 0 === e[c[d] + a]; ) ;
            return d >= 0 ? (X = 3 === d ? "ms" : c[d], W = "-" + X.toLowerCase() + "-", X + a) : null;
        }, Z = N.defaultView ? N.defaultView.getComputedStyle : function() {}, $ = g.getStyle = function(a, b, c, d, e) {
            var f;
            return T || "opacity" !== b ? (!d && a.style[b] ? f = a.style[b] : (c = c || Z(a)) ? f = c[b] || c.getPropertyValue(b) || c.getPropertyValue(b.replace(B, "-$1").toLowerCase()) : a.currentStyle && (f = a.currentStyle[b]), 
            null == e || f && "none" !== f && "auto" !== f && "auto auto" !== f ? f : e) : U(a);
        }, _ = R.convertToPixels = function(a, c, d, e, f) {
            if ("px" === e || !e) return d;
            if ("auto" === e || !d) return 0;
            var h, i, j, k = F.test(c), l = a, m = P.style, n = 0 > d, o = 1 === d;
            if (n && (d = -d), o && (d *= 100), "%" === e && -1 !== c.indexOf("border")) h = d / 100 * (k ? a.clientWidth : a.clientHeight); else {
                if (m.cssText = "border:0 solid red;position:" + $(a, "position") + ";line-height:0;", 
                "%" !== e && l.appendChild && "v" !== e.charAt(0) && "rem" !== e) m[k ? "borderLeftWidth" : "borderTopWidth"] = d + e; else {
                    if (l = a.parentNode || N.body, i = l._gsCache, j = b.ticker.frame, i && k && i.time === j) return i.width * d / 100;
                    m[k ? "width" : "height"] = d + e;
                }
                l.appendChild(P), h = parseFloat(P[k ? "offsetWidth" : "offsetHeight"]), l.removeChild(P), 
                k && "%" === e && g.cacheWidths !== !1 && (i = l._gsCache = l._gsCache || {}, i.time = j, 
                i.width = h / d * 100), 0 !== h || f || (h = _(a, c, d, e, !0));
            }
            return o && (h /= 100), n ? -h : h;
        }, aa = R.calculateOffset = function(a, b, c) {
            if ("absolute" !== $(a, "position", c)) return 0;
            var d = "left" === b ? "Left" : "Top", e = $(a, "margin" + d, c);
            return a["offset" + d] - (_(a, b, parseFloat(e), e.replace(w, "")) || 0);
        }, ba = function(a, b) {
            var c, d, e, f = {};
            if (b = b || Z(a, null)) if (c = b.length) for (;--c > -1; ) e = b[c], (-1 === e.indexOf("-transform") || Ca === e) && (f[e.replace(C, E)] = b.getPropertyValue(e)); else for (c in b) (-1 === c.indexOf("Transform") || Ba === c) && (f[c] = b[c]); else if (b = a.currentStyle || a.style) for (c in b) "string" == typeof c && void 0 === f[c] && (f[c.replace(C, E)] = b[c]);
            return T || (f.opacity = U(a)), d = Pa(a, b, !1), f.rotation = d.rotation, f.skewX = d.skewX, 
            f.scaleX = d.scaleX, f.scaleY = d.scaleY, f.x = d.x, f.y = d.y, Ea && (f.z = d.z, 
            f.rotationX = d.rotationX, f.rotationY = d.rotationY, f.scaleZ = d.scaleZ), f.filters && delete f.filters, 
            f;
        }, ca = function(a, b, c, d, e) {
            var f, g, h, i = {}, j = a.style;
            for (g in c) "cssText" !== g && "length" !== g && isNaN(g) && (b[g] !== (f = c[g]) || e && e[g]) && -1 === g.indexOf("Origin") && ("number" == typeof f || "string" == typeof f) && (i[g] = "auto" !== f || "left" !== g && "top" !== g ? "" !== f && "auto" !== f && "none" !== f || "string" != typeof b[g] || "" === b[g].replace(v, "") ? f : 0 : aa(a, g), 
            void 0 !== j[g] && (h = new ra(j, g, j[g], h)));
            if (d) for (g in d) "className" !== g && (i[g] = d[g]);
            return {
                difs: i,
                firstMPT: h
            };
        }, da = {
            width: [ "Left", "Right" ],
            height: [ "Top", "Bottom" ]
        }, ea = [ "marginLeft", "marginRight", "marginTop", "marginBottom" ], fa = function(a, b, c) {
            if ("svg" === (a.nodeName + "").toLowerCase()) return (c || Z(a))[b] || 0;
            if (a.getBBox && Ma(a)) return a.getBBox()[b] || 0;
            var d = parseFloat("width" === b ? a.offsetWidth : a.offsetHeight), e = da[b], f = e.length;
            for (c = c || Z(a, null); --f > -1; ) d -= parseFloat($(a, "padding" + e[f], c, !0)) || 0, 
            d -= parseFloat($(a, "border" + e[f] + "Width", c, !0)) || 0;
            return d;
        }, ga = function(a, b) {
            if ("contain" === a || "auto" === a || "auto auto" === a) return a + " ";
            (null == a || "" === a) && (a = "0 0");
            var c, d = a.split(" "), e = -1 !== a.indexOf("left") ? "0%" : -1 !== a.indexOf("right") ? "100%" : d[0], f = -1 !== a.indexOf("top") ? "0%" : -1 !== a.indexOf("bottom") ? "100%" : d[1];
            if (d.length > 3 && !b) {
                for (d = a.split(", ").join(",").split(","), a = [], c = 0; c < d.length; c++) a.push(ga(d[c]));
                return a.join(",");
            }
            return null == f ? f = "center" === e ? "50%" : "0" : "center" === f && (f = "50%"), 
            ("center" === e || isNaN(parseFloat(e)) && -1 === (e + "").indexOf("=")) && (e = "50%"), 
            a = e + " " + f + (d.length > 2 ? " " + d[2] : ""), b && (b.oxp = -1 !== e.indexOf("%"), 
            b.oyp = -1 !== f.indexOf("%"), b.oxr = "=" === e.charAt(1), b.oyr = "=" === f.charAt(1), 
            b.ox = parseFloat(e.replace(v, "")), b.oy = parseFloat(f.replace(v, "")), b.v = a), 
            b || a;
        }, ha = function(a, b) {
            return "function" == typeof a && (a = a(r, q)), "string" == typeof a && "=" === a.charAt(1) ? parseInt(a.charAt(0) + "1", 10) * parseFloat(a.substr(2)) : parseFloat(a) - parseFloat(b) || 0;
        }, ia = function(a, b) {
            return "function" == typeof a && (a = a(r, q)), null == a ? b : "string" == typeof a && "=" === a.charAt(1) ? parseInt(a.charAt(0) + "1", 10) * parseFloat(a.substr(2)) + b : parseFloat(a) || 0;
        }, ja = function(a, b, c, d) {
            var e, f, g, h, i, j = 1e-6;
            return "function" == typeof a && (a = a(r, q)), null == a ? h = b : "number" == typeof a ? h = a : (e = 360, 
            f = a.split("_"), i = "=" === a.charAt(1), g = (i ? parseInt(a.charAt(0) + "1", 10) * parseFloat(f[0].substr(2)) : parseFloat(f[0])) * (-1 === a.indexOf("rad") ? 1 : L) - (i ? 0 : b), 
            f.length && (d && (d[c] = b + g), -1 !== a.indexOf("short") && (g %= e, g !== g % (e / 2) && (g = 0 > g ? g + e : g - e)), 
            -1 !== a.indexOf("_cw") && 0 > g ? g = (g + 9999999999 * e) % e - (g / e | 0) * e : -1 !== a.indexOf("ccw") && g > 0 && (g = (g - 9999999999 * e) % e - (g / e | 0) * e)), 
            h = b + g), j > h && h > -j && (h = 0), h;
        }, ka = {
            aqua: [ 0, 255, 255 ],
            lime: [ 0, 255, 0 ],
            silver: [ 192, 192, 192 ],
            black: [ 0, 0, 0 ],
            maroon: [ 128, 0, 0 ],
            teal: [ 0, 128, 128 ],
            blue: [ 0, 0, 255 ],
            navy: [ 0, 0, 128 ],
            white: [ 255, 255, 255 ],
            fuchsia: [ 255, 0, 255 ],
            olive: [ 128, 128, 0 ],
            yellow: [ 255, 255, 0 ],
            orange: [ 255, 165, 0 ],
            gray: [ 128, 128, 128 ],
            purple: [ 128, 0, 128 ],
            green: [ 0, 128, 0 ],
            red: [ 255, 0, 0 ],
            pink: [ 255, 192, 203 ],
            cyan: [ 0, 255, 255 ],
            transparent: [ 255, 255, 255, 0 ]
        }, la = function(a, b, c) {
            return a = 0 > a ? a + 1 : a > 1 ? a - 1 : a, 255 * (1 > 6 * a ? b + (c - b) * a * 6 : .5 > a ? c : 2 > 3 * a ? b + (c - b) * (2 / 3 - a) * 6 : b) + .5 | 0;
        }, ma = g.parseColor = function(a, b) {
            var c, d, e, f, g, h, i, j, k, l, m;
            if (a) if ("number" == typeof a) c = [ a >> 16, a >> 8 & 255, 255 & a ]; else {
                if ("," === a.charAt(a.length - 1) && (a = a.substr(0, a.length - 1)), ka[a]) c = ka[a]; else if ("#" === a.charAt(0)) 4 === a.length && (d = a.charAt(1), 
                e = a.charAt(2), f = a.charAt(3), a = "#" + d + d + e + e + f + f), a = parseInt(a.substr(1), 16), 
                c = [ a >> 16, a >> 8 & 255, 255 & a ]; else if ("hsl" === a.substr(0, 3)) if (c = m = a.match(s), 
                b) {
                    if (-1 !== a.indexOf("=")) return a.match(t);
                } else g = Number(c[0]) % 360 / 360, h = Number(c[1]) / 100, i = Number(c[2]) / 100, 
                e = .5 >= i ? i * (h + 1) : i + h - i * h, d = 2 * i - e, c.length > 3 && (c[3] = Number(a[3])), 
                c[0] = la(g + 1 / 3, d, e), c[1] = la(g, d, e), c[2] = la(g - 1 / 3, d, e); else c = a.match(s) || ka.transparent;
                c[0] = Number(c[0]), c[1] = Number(c[1]), c[2] = Number(c[2]), c.length > 3 && (c[3] = Number(c[3]));
            } else c = ka.black;
            return b && !m && (d = c[0] / 255, e = c[1] / 255, f = c[2] / 255, j = Math.max(d, e, f), 
            k = Math.min(d, e, f), i = (j + k) / 2, j === k ? g = h = 0 : (l = j - k, h = i > .5 ? l / (2 - j - k) : l / (j + k), 
            g = j === d ? (e - f) / l + (f > e ? 6 : 0) : j === e ? (f - d) / l + 2 : (d - e) / l + 4, 
            g *= 60), c[0] = g + .5 | 0, c[1] = 100 * h + .5 | 0, c[2] = 100 * i + .5 | 0), 
            c;
        }, na = function(a, b) {
            var c, d, e, f = a.match(oa) || [], g = 0, h = f.length ? "" : a;
            for (c = 0; c < f.length; c++) d = f[c], e = a.substr(g, a.indexOf(d, g) - g), g += e.length + d.length, 
            d = ma(d, b), 3 === d.length && d.push(1), h += e + (b ? "hsla(" + d[0] + "," + d[1] + "%," + d[2] + "%," + d[3] : "rgba(" + d.join(",")) + ")";
            return h + a.substr(g);
        }, oa = "(?:\\b(?:(?:rgb|rgba|hsl|hsla)\\(.+?\\))|\\B#(?:[0-9a-f]{3}){1,2}\\b";
        for (j in ka) oa += "|" + j + "\\b";
        oa = new RegExp(oa + ")", "gi"), g.colorStringFilter = function(a) {
            var b, c = a[0] + a[1];
            oa.test(c) && (b = -1 !== c.indexOf("hsl(") || -1 !== c.indexOf("hsla("), a[0] = na(a[0], b), 
            a[1] = na(a[1], b)), oa.lastIndex = 0;
        }, b.defaultStringFilter || (b.defaultStringFilter = g.colorStringFilter);
        var pa = function(a, b, c, d) {
            if (null == a) return function(a) {
                return a;
            };
            var e, f = b ? (a.match(oa) || [ "" ])[0] : "", g = a.split(f).join("").match(u) || [], h = a.substr(0, a.indexOf(g[0])), i = ")" === a.charAt(a.length - 1) ? ")" : "", j = -1 !== a.indexOf(" ") ? " " : ",", k = g.length, l = k > 0 ? g[0].replace(s, "") : "";
            return k ? e = b ? function(a) {
                var b, m, n, o;
                if ("number" == typeof a) a += l; else if (d && I.test(a)) {
                    for (o = a.replace(I, "|").split("|"), n = 0; n < o.length; n++) o[n] = e(o[n]);
                    return o.join(",");
                }
                if (b = (a.match(oa) || [ f ])[0], m = a.split(b).join("").match(u) || [], n = m.length, 
                k > n--) for (;++n < k; ) m[n] = c ? m[(n - 1) / 2 | 0] : g[n];
                return h + m.join(j) + j + b + i + (-1 !== a.indexOf("inset") ? " inset" : "");
            } : function(a) {
                var b, f, m;
                if ("number" == typeof a) a += l; else if (d && I.test(a)) {
                    for (f = a.replace(I, "|").split("|"), m = 0; m < f.length; m++) f[m] = e(f[m]);
                    return f.join(",");
                }
                if (b = a.match(u) || [], m = b.length, k > m--) for (;++m < k; ) b[m] = c ? b[(m - 1) / 2 | 0] : g[m];
                return h + b.join(j) + i;
            } : function(a) {
                return a;
            };
        }, qa = function(a) {
            return a = a.split(","), function(b, c, d, e, f, g, h) {
                var i, j = (c + "").split(" ");
                for (h = {}, i = 0; 4 > i; i++) h[a[i]] = j[i] = j[i] || j[(i - 1) / 2 >> 0];
                return e.parse(b, h, f, g);
            };
        }, ra = (R._setPluginRatio = function(a) {
            this.plugin.setRatio(a);
            for (var b, c, d, e, f, g = this.data, h = g.proxy, i = g.firstMPT, j = 1e-6; i; ) b = h[i.v], 
            i.r ? b = Math.round(b) : j > b && b > -j && (b = 0), i.t[i.p] = b, i = i._next;
            if (g.autoRotate && (g.autoRotate.rotation = g.mod ? g.mod(h.rotation, this.t) : h.rotation), 
            1 === a || 0 === a) for (i = g.firstMPT, f = 1 === a ? "e" : "b"; i; ) {
                if (c = i.t, c.type) {
                    if (1 === c.type) {
                        for (e = c.xs0 + c.s + c.xs1, d = 1; d < c.l; d++) e += c["xn" + d] + c["xs" + (d + 1)];
                        c[f] = e;
                    }
                } else c[f] = c.s + c.xs0;
                i = i._next;
            }
        }, function(a, b, c, d, e) {
            this.t = a, this.p = b, this.v = c, this.r = e, d && (d._prev = this, this._next = d);
        }), sa = (R._parseToProxy = function(a, b, c, d, e, f) {
            var g, h, i, j, k, l = d, m = {}, n = {}, o = c._transform, p = M;
            for (c._transform = null, M = b, d = k = c.parse(a, b, d, e), M = p, f && (c._transform = o, 
            l && (l._prev = null, l._prev && (l._prev._next = null))); d && d !== l; ) {
                if (d.type <= 1 && (h = d.p, n[h] = d.s + d.c, m[h] = d.s, f || (j = new ra(d, "s", h, j, d.r), 
                d.c = 0), 1 === d.type)) for (g = d.l; --g > 0; ) i = "xn" + g, h = d.p + "_" + i, 
                n[h] = d.data[i], m[h] = d[i], f || (j = new ra(d, i, h, j, d.rxp[i]));
                d = d._next;
            }
            return {
                proxy: m,
                end: n,
                firstMPT: j,
                pt: k
            };
        }, R.CSSPropTween = function(a, b, d, e, g, h, i, j, k, l, m) {
            this.t = a, this.p = b, this.s = d, this.c = e, this.n = i || b, a instanceof sa || f.push(this.n), 
            this.r = j, this.type = h || 0, k && (this.pr = k, c = !0), this.b = void 0 === l ? d : l, 
            this.e = void 0 === m ? d + e : m, g && (this._next = g, g._prev = this);
        }), ta = function(a, b, c, d, e, f) {
            var g = new sa(a, b, c, d - c, e, -1, f);
            return g.b = c, g.e = g.xs0 = d, g;
        }, ua = g.parseComplex = function(a, b, c, d, e, f, h, i, j, l) {
            c = c || f || "", "function" == typeof d && (d = d(r, q)), h = new sa(a, b, 0, 0, h, l ? 2 : 1, null, !1, i, c, d), 
            d += "", e && oa.test(d + c) && (d = [ c, d ], g.colorStringFilter(d), c = d[0], 
            d = d[1]);
            var m, n, o, p, u, v, w, x, y, z, A, B, C, D = c.split(", ").join(",").split(" "), E = d.split(", ").join(",").split(" "), F = D.length, G = k !== !1;
            for ((-1 !== d.indexOf(",") || -1 !== c.indexOf(",")) && (D = D.join(" ").replace(I, ", ").split(" "), 
            E = E.join(" ").replace(I, ", ").split(" "), F = D.length), F !== E.length && (D = (f || "").split(" "), 
            F = D.length), h.plugin = j, h.setRatio = l, oa.lastIndex = 0, m = 0; F > m; m++) if (p = D[m], 
            u = E[m], x = parseFloat(p), x || 0 === x) h.appendXtra("", x, ha(u, x), u.replace(t, ""), G && -1 !== u.indexOf("px"), !0); else if (e && oa.test(p)) B = u.indexOf(")") + 1, 
            B = ")" + (B ? u.substr(B) : ""), C = -1 !== u.indexOf("hsl") && T, p = ma(p, C), 
            u = ma(u, C), y = p.length + u.length > 6, y && !T && 0 === u[3] ? (h["xs" + h.l] += h.l ? " transparent" : "transparent", 
            h.e = h.e.split(E[m]).join("transparent")) : (T || (y = !1), C ? h.appendXtra(y ? "hsla(" : "hsl(", p[0], ha(u[0], p[0]), ",", !1, !0).appendXtra("", p[1], ha(u[1], p[1]), "%,", !1).appendXtra("", p[2], ha(u[2], p[2]), y ? "%," : "%" + B, !1) : h.appendXtra(y ? "rgba(" : "rgb(", p[0], u[0] - p[0], ",", !0, !0).appendXtra("", p[1], u[1] - p[1], ",", !0).appendXtra("", p[2], u[2] - p[2], y ? "," : B, !0), 
            y && (p = p.length < 4 ? 1 : p[3], h.appendXtra("", p, (u.length < 4 ? 1 : u[3]) - p, B, !1))), 
            oa.lastIndex = 0; else if (v = p.match(s)) {
                if (w = u.match(t), !w || w.length !== v.length) return h;
                for (o = 0, n = 0; n < v.length; n++) A = v[n], z = p.indexOf(A, o), h.appendXtra(p.substr(o, z - o), Number(A), ha(w[n], A), "", G && "px" === p.substr(z + A.length, 2), 0 === n), 
                o = z + A.length;
                h["xs" + h.l] += p.substr(o);
            } else h["xs" + h.l] += h.l || h["xs" + h.l] ? " " + u : u;
            if (-1 !== d.indexOf("=") && h.data) {
                for (B = h.xs0 + h.data.s, m = 1; m < h.l; m++) B += h["xs" + m] + h.data["xn" + m];
                h.e = B + h["xs" + m];
            }
            return h.l || (h.type = -1, h.xs0 = h.e), h.xfirst || h;
        }, va = 9;
        for (j = sa.prototype, j.l = j.pr = 0; --va > 0; ) j["xn" + va] = 0, j["xs" + va] = "";
        j.xs0 = "", j._next = j._prev = j.xfirst = j.data = j.plugin = j.setRatio = j.rxp = null, 
        j.appendXtra = function(a, b, c, d, e, f) {
            var g = this, h = g.l;
            return g["xs" + h] += f && (h || g["xs" + h]) ? " " + a : a || "", c || 0 === h || g.plugin ? (g.l++, 
            g.type = g.setRatio ? 2 : 1, g["xs" + g.l] = d || "", h > 0 ? (g.data["xn" + h] = b + c, 
            g.rxp["xn" + h] = e, g["xn" + h] = b, g.plugin || (g.xfirst = new sa(g, "xn" + h, b, c, g.xfirst || g, 0, g.n, e, g.pr), 
            g.xfirst.xs0 = 0), g) : (g.data = {
                s: b + c
            }, g.rxp = {}, g.s = b, g.c = c, g.r = e, g)) : (g["xs" + h] += b + (d || ""), g);
        };
        var wa = function(a, b) {
            b = b || {}, this.p = b.prefix ? Y(a) || a : a, i[a] = i[this.p] = this, this.format = b.formatter || pa(b.defaultValue, b.color, b.collapsible, b.multi), 
            b.parser && (this.parse = b.parser), this.clrs = b.color, this.multi = b.multi, 
            this.keyword = b.keyword, this.dflt = b.defaultValue, this.pr = b.priority || 0;
        }, xa = R._registerComplexSpecialProp = function(a, b, c) {
            "object" != typeof b && (b = {
                parser: c
            });
            var d, e, f = a.split(","), g = b.defaultValue;
            for (c = c || [ g ], d = 0; d < f.length; d++) b.prefix = 0 === d && b.prefix, b.defaultValue = c[d] || g, 
            e = new wa(f[d], b);
        }, ya = R._registerPluginProp = function(a) {
            if (!i[a]) {
                var b = a.charAt(0).toUpperCase() + a.substr(1) + "Plugin";
                xa(a, {
                    parser: function(a, c, d, e, f, g, j) {
                        var k = h.com.greensock.plugins[b];
                        return k ? (k._cssRegister(), i[d].parse(a, c, d, e, f, g, j)) : (V("Error: " + b + " js file not loaded."), 
                        f);
                    }
                });
            }
        };
        j = wa.prototype, j.parseComplex = function(a, b, c, d, e, f) {
            var g, h, i, j, k, l, m = this.keyword;
            if (this.multi && (I.test(c) || I.test(b) ? (h = b.replace(I, "|").split("|"), i = c.replace(I, "|").split("|")) : m && (h = [ b ], 
            i = [ c ])), i) {
                for (j = i.length > h.length ? i.length : h.length, g = 0; j > g; g++) b = h[g] = h[g] || this.dflt, 
                c = i[g] = i[g] || this.dflt, m && (k = b.indexOf(m), l = c.indexOf(m), k !== l && (-1 === l ? h[g] = h[g].split(m).join("") : -1 === k && (h[g] += " " + m)));
                b = h.join(", "), c = i.join(", ");
            }
            return ua(a, this.p, b, c, this.clrs, this.dflt, d, this.pr, e, f);
        }, j.parse = function(a, b, c, d, f, g, h) {
            return this.parseComplex(a.style, this.format($(a, this.p, e, !1, this.dflt)), this.format(b), f, g);
        }, g.registerSpecialProp = function(a, b, c) {
            xa(a, {
                parser: function(a, d, e, f, g, h, i) {
                    var j = new sa(a, e, 0, 0, g, 2, e, !1, c);
                    return j.plugin = h, j.setRatio = b(a, d, f._tween, e), j;
                },
                priority: c
            });
        }, g.useSVGTransformAttr = m || n;
        var za, Aa = "scaleX,scaleY,scaleZ,x,y,z,skewX,skewY,rotation,rotationX,rotationY,perspective,xPercent,yPercent".split(","), Ba = Y("transform"), Ca = W + "transform", Da = Y("transformOrigin"), Ea = null !== Y("perspective"), Fa = R.Transform = function() {
            this.perspective = parseFloat(g.defaultTransformPerspective) || 0, this.force3D = g.defaultForce3D !== !1 && Ea ? g.defaultForce3D || "auto" : !1;
        }, Ga = window.SVGElement, Ha = function(a, b, c) {
            var d, e = N.createElementNS("http://www.w3.org/2000/svg", a), f = /([a-z])([A-Z])/g;
            for (d in c) e.setAttributeNS(null, d.replace(f, "$1-$2").toLowerCase(), c[d]);
            return b.appendChild(e), e;
        }, Ia = N.documentElement, Ja = function() {
            var a, b, c, d = p || /Android/i.test(S) && !window.chrome;
            return N.createElementNS && !d && (a = Ha("svg", Ia), b = Ha("rect", a, {
                width: 100,
                height: 50,
                x: 100
            }), c = b.getBoundingClientRect().width, b.style[Da] = "50% 50%", b.style[Ba] = "scaleX(0.5)", 
            d = c === b.getBoundingClientRect().width && !(n && Ea), Ia.removeChild(a)), d;
        }(), Ka = function(a, b, c, d, e, f) {
            var h, i, j, k, l, m, n, o, p, q, r, s, t, u, v = a._gsTransform, w = Oa(a, !0);
            v && (t = v.xOrigin, u = v.yOrigin), (!d || (h = d.split(" ")).length < 2) && (n = a.getBBox(), 
            b = ga(b).split(" "), h = [ (-1 !== b[0].indexOf("%") ? parseFloat(b[0]) / 100 * n.width : parseFloat(b[0])) + n.x, (-1 !== b[1].indexOf("%") ? parseFloat(b[1]) / 100 * n.height : parseFloat(b[1])) + n.y ]), 
            c.xOrigin = k = parseFloat(h[0]), c.yOrigin = l = parseFloat(h[1]), d && w !== Na && (m = w[0], 
            n = w[1], o = w[2], p = w[3], q = w[4], r = w[5], s = m * p - n * o, i = k * (p / s) + l * (-o / s) + (o * r - p * q) / s, 
            j = k * (-n / s) + l * (m / s) - (m * r - n * q) / s, k = c.xOrigin = h[0] = i, 
            l = c.yOrigin = h[1] = j), v && (f && (c.xOffset = v.xOffset, c.yOffset = v.yOffset, 
            v = c), e || e !== !1 && g.defaultSmoothOrigin !== !1 ? (i = k - t, j = l - u, v.xOffset += i * w[0] + j * w[2] - i, 
            v.yOffset += i * w[1] + j * w[3] - j) : v.xOffset = v.yOffset = 0), f || a.setAttribute("data-svg-origin", h.join(" "));
        }, La = function(a) {
            try {
                return a.getBBox();
            } catch (a) {}
        }, Ma = function(a) {
            return !!(Ga && a.getBBox && a.getCTM && La(a) && (!a.parentNode || a.parentNode.getBBox && a.parentNode.getCTM));
        }, Na = [ 1, 0, 0, 1, 0, 0 ], Oa = function(a, b) {
            var c, d, e, f, g, h, i = a._gsTransform || new Fa(), j = 1e5, k = a.style;
            if (Ba ? d = $(a, Ca, null, !0) : a.currentStyle && (d = a.currentStyle.filter.match(G), 
            d = d && 4 === d.length ? [ d[0].substr(4), Number(d[2].substr(4)), Number(d[1].substr(4)), d[3].substr(4), i.x || 0, i.y || 0 ].join(",") : ""), 
            c = !d || "none" === d || "matrix(1, 0, 0, 1, 0, 0)" === d, c && Ba && ((h = "none" === Z(a).display) || !a.parentNode) && (h && (f = k.display, 
            k.display = "block"), a.parentNode || (g = 1, Ia.appendChild(a)), d = $(a, Ca, null, !0), 
            c = !d || "none" === d || "matrix(1, 0, 0, 1, 0, 0)" === d, f ? k.display = f : h && Ta(k, "display"), 
            g && Ia.removeChild(a)), (i.svg || a.getBBox && Ma(a)) && (c && -1 !== (k[Ba] + "").indexOf("matrix") && (d = k[Ba], 
            c = 0), e = a.getAttribute("transform"), c && e && (-1 !== e.indexOf("matrix") ? (d = e, 
            c = 0) : -1 !== e.indexOf("translate") && (d = "matrix(1,0,0,1," + e.match(/(?:\-|\b)[\d\-\.e]+\b/gi).join(",") + ")", 
            c = 0))), c) return Na;
            for (e = (d || "").match(s) || [], va = e.length; --va > -1; ) f = Number(e[va]), 
            e[va] = (g = f - (f |= 0)) ? (g * j + (0 > g ? -.5 : .5) | 0) / j + f : f;
            return b && e.length > 6 ? [ e[0], e[1], e[4], e[5], e[12], e[13] ] : e;
        }, Pa = R.getTransform = function(a, c, d, e) {
            if (a._gsTransform && d && !e) return a._gsTransform;
            var f, h, i, j, k, l, m = d ? a._gsTransform || new Fa() : new Fa(), n = m.scaleX < 0, o = 2e-5, p = 1e5, q = Ea ? parseFloat($(a, Da, c, !1, "0 0 0").split(" ")[2]) || m.zOrigin || 0 : 0, r = parseFloat(g.defaultTransformPerspective) || 0;
            if (m.svg = !(!a.getBBox || !Ma(a)), m.svg && (Ka(a, $(a, Da, c, !1, "50% 50%") + "", m, a.getAttribute("data-svg-origin")), 
            za = g.useSVGTransformAttr || Ja), f = Oa(a), f !== Na) {
                if (16 === f.length) {
                    var s, t, u, v, w, x = f[0], y = f[1], z = f[2], A = f[3], B = f[4], C = f[5], D = f[6], E = f[7], F = f[8], G = f[9], H = f[10], I = f[12], J = f[13], K = f[14], M = f[11], N = Math.atan2(D, H);
                    m.zOrigin && (K = -m.zOrigin, I = F * K - f[12], J = G * K - f[13], K = H * K + m.zOrigin - f[14]), 
                    m.rotationX = N * L, N && (v = Math.cos(-N), w = Math.sin(-N), s = B * v + F * w, 
                    t = C * v + G * w, u = D * v + H * w, F = B * -w + F * v, G = C * -w + G * v, H = D * -w + H * v, 
                    M = E * -w + M * v, B = s, C = t, D = u), N = Math.atan2(-z, H), m.rotationY = N * L, 
                    N && (v = Math.cos(-N), w = Math.sin(-N), s = x * v - F * w, t = y * v - G * w, 
                    u = z * v - H * w, G = y * w + G * v, H = z * w + H * v, M = A * w + M * v, x = s, 
                    y = t, z = u), N = Math.atan2(y, x), m.rotation = N * L, N && (v = Math.cos(-N), 
                    w = Math.sin(-N), x = x * v + B * w, t = y * v + C * w, C = y * -w + C * v, D = z * -w + D * v, 
                    y = t), m.rotationX && Math.abs(m.rotationX) + Math.abs(m.rotation) > 359.9 && (m.rotationX = m.rotation = 0, 
                    m.rotationY = 180 - m.rotationY), m.scaleX = (Math.sqrt(x * x + y * y) * p + .5 | 0) / p, 
                    m.scaleY = (Math.sqrt(C * C + G * G) * p + .5 | 0) / p, m.scaleZ = (Math.sqrt(D * D + H * H) * p + .5 | 0) / p, 
                    m.rotationX || m.rotationY ? m.skewX = 0 : (m.skewX = B || C ? Math.atan2(B, C) * L + m.rotation : m.skewX || 0, 
                    Math.abs(m.skewX) > 90 && Math.abs(m.skewX) < 270 && (n ? (m.scaleX *= -1, m.skewX += m.rotation <= 0 ? 180 : -180, 
                    m.rotation += m.rotation <= 0 ? 180 : -180) : (m.scaleY *= -1, m.skewX += m.skewX <= 0 ? 180 : -180))), 
                    m.perspective = M ? 1 / (0 > M ? -M : M) : 0, m.x = I, m.y = J, m.z = K, m.svg && (m.x -= m.xOrigin - (m.xOrigin * x - m.yOrigin * B), 
                    m.y -= m.yOrigin - (m.yOrigin * y - m.xOrigin * C));
                } else if (!Ea || e || !f.length || m.x !== f[4] || m.y !== f[5] || !m.rotationX && !m.rotationY) {
                    var O = f.length >= 6, P = O ? f[0] : 1, Q = f[1] || 0, R = f[2] || 0, S = O ? f[3] : 1;
                    m.x = f[4] || 0, m.y = f[5] || 0, i = Math.sqrt(P * P + Q * Q), j = Math.sqrt(S * S + R * R), 
                    k = P || Q ? Math.atan2(Q, P) * L : m.rotation || 0, l = R || S ? Math.atan2(R, S) * L + k : m.skewX || 0, 
                    Math.abs(l) > 90 && Math.abs(l) < 270 && (n ? (i *= -1, l += 0 >= k ? 180 : -180, 
                    k += 0 >= k ? 180 : -180) : (j *= -1, l += 0 >= l ? 180 : -180)), m.scaleX = i, 
                    m.scaleY = j, m.rotation = k, m.skewX = l, Ea && (m.rotationX = m.rotationY = m.z = 0, 
                    m.perspective = r, m.scaleZ = 1), m.svg && (m.x -= m.xOrigin - (m.xOrigin * P + m.yOrigin * R), 
                    m.y -= m.yOrigin - (m.xOrigin * Q + m.yOrigin * S));
                }
                m.zOrigin = q;
                for (h in m) m[h] < o && m[h] > -o && (m[h] = 0);
            }
            return d && (a._gsTransform = m, m.svg && (za && a.style[Ba] ? b.delayedCall(.001, function() {
                Ta(a.style, Ba);
            }) : !za && a.getAttribute("transform") && b.delayedCall(.001, function() {
                a.removeAttribute("transform");
            }))), m;
        }, Qa = function(a) {
            var b, c, d = this.data, e = -d.rotation * K, f = e + d.skewX * K, g = 1e5, h = (Math.cos(e) * d.scaleX * g | 0) / g, i = (Math.sin(e) * d.scaleX * g | 0) / g, j = (Math.sin(f) * -d.scaleY * g | 0) / g, k = (Math.cos(f) * d.scaleY * g | 0) / g, l = this.t.style, m = this.t.currentStyle;
            if (m) {
                c = i, i = -j, j = -c, b = m.filter, l.filter = "";
                var n, o, q = this.t.offsetWidth, r = this.t.offsetHeight, s = "absolute" !== m.position, t = "progid:DXImageTransform.Microsoft.Matrix(M11=" + h + ", M12=" + i + ", M21=" + j + ", M22=" + k, u = d.x + q * d.xPercent / 100, v = d.y + r * d.yPercent / 100;
                if (null != d.ox && (n = (d.oxp ? q * d.ox * .01 : d.ox) - q / 2, o = (d.oyp ? r * d.oy * .01 : d.oy) - r / 2, 
                u += n - (n * h + o * i), v += o - (n * j + o * k)), s ? (n = q / 2, o = r / 2, 
                t += ", Dx=" + (n - (n * h + o * i) + u) + ", Dy=" + (o - (n * j + o * k) + v) + ")") : t += ", sizingMethod='auto expand')", 
                -1 !== b.indexOf("DXImageTransform.Microsoft.Matrix(") ? l.filter = b.replace(H, t) : l.filter = t + " " + b, 
                (0 === a || 1 === a) && 1 === h && 0 === i && 0 === j && 1 === k && (s && -1 === t.indexOf("Dx=0, Dy=0") || x.test(b) && 100 !== parseFloat(RegExp.$1) || -1 === b.indexOf(b.indexOf("Alpha")) && l.removeAttribute("filter")), 
                !s) {
                    var y, z, A, B = 8 > p ? 1 : -1;
                    for (n = d.ieOffsetX || 0, o = d.ieOffsetY || 0, d.ieOffsetX = Math.round((q - ((0 > h ? -h : h) * q + (0 > i ? -i : i) * r)) / 2 + u), 
                    d.ieOffsetY = Math.round((r - ((0 > k ? -k : k) * r + (0 > j ? -j : j) * q)) / 2 + v), 
                    va = 0; 4 > va; va++) z = ea[va], y = m[z], c = -1 !== y.indexOf("px") ? parseFloat(y) : _(this.t, z, parseFloat(y), y.replace(w, "")) || 0, 
                    A = c !== d[z] ? 2 > va ? -d.ieOffsetX : -d.ieOffsetY : 2 > va ? n - d.ieOffsetX : o - d.ieOffsetY, 
                    l[z] = (d[z] = Math.round(c - A * (0 === va || 2 === va ? 1 : B))) + "px";
                }
            }
        }, Ra = R.set3DTransformRatio = R.setTransformRatio = function(a) {
            var b, c, d, e, f, g, h, i, j, k, l, m, o, p, q, r, s, t, u, v, w, x, y, z = this.data, A = this.t.style, B = z.rotation, C = z.rotationX, D = z.rotationY, E = z.scaleX, F = z.scaleY, G = z.scaleZ, H = z.x, I = z.y, J = z.z, L = z.svg, M = z.perspective, N = z.force3D;
            if (((1 === a || 0 === a) && "auto" === N && (this.tween._totalTime === this.tween._totalDuration || !this.tween._totalTime) || !N) && !J && !M && !D && !C && 1 === G || za && L || !Ea) return void (B || z.skewX || L ? (B *= K, 
            x = z.skewX * K, y = 1e5, b = Math.cos(B) * E, e = Math.sin(B) * E, c = Math.sin(B - x) * -F, 
            f = Math.cos(B - x) * F, x && "simple" === z.skewType && (s = Math.tan(x - z.skewY * K), 
            s = Math.sqrt(1 + s * s), c *= s, f *= s, z.skewY && (s = Math.tan(z.skewY * K), 
            s = Math.sqrt(1 + s * s), b *= s, e *= s)), L && (H += z.xOrigin - (z.xOrigin * b + z.yOrigin * c) + z.xOffset, 
            I += z.yOrigin - (z.xOrigin * e + z.yOrigin * f) + z.yOffset, za && (z.xPercent || z.yPercent) && (p = this.t.getBBox(), 
            H += .01 * z.xPercent * p.width, I += .01 * z.yPercent * p.height), p = 1e-6, p > H && H > -p && (H = 0), 
            p > I && I > -p && (I = 0)), u = (b * y | 0) / y + "," + (e * y | 0) / y + "," + (c * y | 0) / y + "," + (f * y | 0) / y + "," + H + "," + I + ")", 
            L && za ? this.t.setAttribute("transform", "matrix(" + u) : A[Ba] = (z.xPercent || z.yPercent ? "translate(" + z.xPercent + "%," + z.yPercent + "%) matrix(" : "matrix(") + u) : A[Ba] = (z.xPercent || z.yPercent ? "translate(" + z.xPercent + "%," + z.yPercent + "%) matrix(" : "matrix(") + E + ",0,0," + F + "," + H + "," + I + ")");
            if (n && (p = 1e-4, p > E && E > -p && (E = G = 2e-5), p > F && F > -p && (F = G = 2e-5), 
            !M || z.z || z.rotationX || z.rotationY || (M = 0)), B || z.skewX) B *= K, q = b = Math.cos(B), 
            r = e = Math.sin(B), z.skewX && (B -= z.skewX * K, q = Math.cos(B), r = Math.sin(B), 
            "simple" === z.skewType && (s = Math.tan((z.skewX - z.skewY) * K), s = Math.sqrt(1 + s * s), 
            q *= s, r *= s, z.skewY && (s = Math.tan(z.skewY * K), s = Math.sqrt(1 + s * s), 
            b *= s, e *= s))), c = -r, f = q; else {
                if (!(D || C || 1 !== G || M || L)) return void (A[Ba] = (z.xPercent || z.yPercent ? "translate(" + z.xPercent + "%," + z.yPercent + "%) translate3d(" : "translate3d(") + H + "px," + I + "px," + J + "px)" + (1 !== E || 1 !== F ? " scale(" + E + "," + F + ")" : ""));
                b = f = 1, c = e = 0;
            }
            j = 1, d = g = h = i = k = l = 0, m = M ? -1 / M : 0, o = z.zOrigin, p = 1e-6, v = ",", 
            w = "0", B = D * K, B && (q = Math.cos(B), r = Math.sin(B), h = -r, k = m * -r, 
            d = b * r, g = e * r, j = q, m *= q, b *= q, e *= q), B = C * K, B && (q = Math.cos(B), 
            r = Math.sin(B), s = c * q + d * r, t = f * q + g * r, i = j * r, l = m * r, d = c * -r + d * q, 
            g = f * -r + g * q, j *= q, m *= q, c = s, f = t), 1 !== G && (d *= G, g *= G, j *= G, 
            m *= G), 1 !== F && (c *= F, f *= F, i *= F, l *= F), 1 !== E && (b *= E, e *= E, 
            h *= E, k *= E), (o || L) && (o && (H += d * -o, I += g * -o, J += j * -o + o), 
            L && (H += z.xOrigin - (z.xOrigin * b + z.yOrigin * c) + z.xOffset, I += z.yOrigin - (z.xOrigin * e + z.yOrigin * f) + z.yOffset), 
            p > H && H > -p && (H = w), p > I && I > -p && (I = w), p > J && J > -p && (J = 0)), 
            u = z.xPercent || z.yPercent ? "translate(" + z.xPercent + "%," + z.yPercent + "%) matrix3d(" : "matrix3d(", 
            u += (p > b && b > -p ? w : b) + v + (p > e && e > -p ? w : e) + v + (p > h && h > -p ? w : h), 
            u += v + (p > k && k > -p ? w : k) + v + (p > c && c > -p ? w : c) + v + (p > f && f > -p ? w : f), 
            C || D || 1 !== G ? (u += v + (p > i && i > -p ? w : i) + v + (p > l && l > -p ? w : l) + v + (p > d && d > -p ? w : d), 
            u += v + (p > g && g > -p ? w : g) + v + (p > j && j > -p ? w : j) + v + (p > m && m > -p ? w : m) + v) : u += ",0,0,0,0,1,0,", 
            u += H + v + I + v + J + v + (M ? 1 + -J / M : 1) + ")", A[Ba] = u;
        };
        j = Fa.prototype, j.x = j.y = j.z = j.skewX = j.skewY = j.rotation = j.rotationX = j.rotationY = j.zOrigin = j.xPercent = j.yPercent = j.xOffset = j.yOffset = 0, 
        j.scaleX = j.scaleY = j.scaleZ = 1, xa("transform,scale,scaleX,scaleY,scaleZ,x,y,z,rotation,rotationX,rotationY,rotationZ,skewX,skewY,shortRotation,shortRotationX,shortRotationY,shortRotationZ,transformOrigin,svgOrigin,transformPerspective,directionalRotation,parseTransform,force3D,skewType,xPercent,yPercent,smoothOrigin", {
            parser: function(a, b, c, d, f, h, i) {
                if (d._lastParsedTransform === i) return f;
                d._lastParsedTransform = i;
                var j;
                "function" == typeof i[c] && (j = i[c], i[c] = b);
                var k, l, m, n, o, p, s, t, u, v = a._gsTransform, w = a.style, x = 1e-6, y = Aa.length, z = i, A = {}, B = "transformOrigin", C = Pa(a, e, !0, z.parseTransform), D = z.transform && ("function" == typeof z.transform ? z.transform(r, q) : z.transform);
                if (d._transform = C, D && "string" == typeof D && Ba) l = P.style, l[Ba] = D, l.display = "block", 
                l.position = "absolute", N.body.appendChild(P), k = Pa(P, null, !1), C.svg && (p = C.xOrigin, 
                s = C.yOrigin, k.x -= C.xOffset, k.y -= C.yOffset, (z.transformOrigin || z.svgOrigin) && (D = {}, 
                Ka(a, ga(z.transformOrigin), D, z.svgOrigin, z.smoothOrigin, !0), p = D.xOrigin, 
                s = D.yOrigin, k.x -= D.xOffset - C.xOffset, k.y -= D.yOffset - C.yOffset), (p || s) && (t = Oa(P, !0), 
                k.x -= p - (p * t[0] + s * t[2]), k.y -= s - (p * t[1] + s * t[3]))), N.body.removeChild(P), 
                k.perspective || (k.perspective = C.perspective), null != z.xPercent && (k.xPercent = ia(z.xPercent, C.xPercent)), 
                null != z.yPercent && (k.yPercent = ia(z.yPercent, C.yPercent)); else if ("object" == typeof z) {
                    if (k = {
                        scaleX: ia(null != z.scaleX ? z.scaleX : z.scale, C.scaleX),
                        scaleY: ia(null != z.scaleY ? z.scaleY : z.scale, C.scaleY),
                        scaleZ: ia(z.scaleZ, C.scaleZ),
                        x: ia(z.x, C.x),
                        y: ia(z.y, C.y),
                        z: ia(z.z, C.z),
                        xPercent: ia(z.xPercent, C.xPercent),
                        yPercent: ia(z.yPercent, C.yPercent),
                        perspective: ia(z.transformPerspective, C.perspective)
                    }, o = z.directionalRotation, null != o) if ("object" == typeof o) for (l in o) z[l] = o[l]; else z.rotation = o;
                    "string" == typeof z.x && -1 !== z.x.indexOf("%") && (k.x = 0, k.xPercent = ia(z.x, C.xPercent)), 
                    "string" == typeof z.y && -1 !== z.y.indexOf("%") && (k.y = 0, k.yPercent = ia(z.y, C.yPercent)), 
                    k.rotation = ja("rotation" in z ? z.rotation : "shortRotation" in z ? z.shortRotation + "_short" : "rotationZ" in z ? z.rotationZ : C.rotation - C.skewY, C.rotation - C.skewY, "rotation", A), 
                    Ea && (k.rotationX = ja("rotationX" in z ? z.rotationX : "shortRotationX" in z ? z.shortRotationX + "_short" : C.rotationX || 0, C.rotationX, "rotationX", A), 
                    k.rotationY = ja("rotationY" in z ? z.rotationY : "shortRotationY" in z ? z.shortRotationY + "_short" : C.rotationY || 0, C.rotationY, "rotationY", A)), 
                    k.skewX = ja(z.skewX, C.skewX - C.skewY), (k.skewY = ja(z.skewY, C.skewY)) && (k.skewX += k.skewY, 
                    k.rotation += k.skewY);
                }
                for (Ea && null != z.force3D && (C.force3D = z.force3D, n = !0), C.skewType = z.skewType || C.skewType || g.defaultSkewType, 
                m = C.force3D || C.z || C.rotationX || C.rotationY || k.z || k.rotationX || k.rotationY || k.perspective, 
                m || null == z.scale || (k.scaleZ = 1); --y > -1; ) u = Aa[y], D = k[u] - C[u], 
                (D > x || -x > D || null != z[u] || null != M[u]) && (n = !0, f = new sa(C, u, C[u], D, f), 
                u in A && (f.e = A[u]), f.xs0 = 0, f.plugin = h, d._overwriteProps.push(f.n));
                return D = z.transformOrigin, C.svg && (D || z.svgOrigin) && (p = C.xOffset, s = C.yOffset, 
                Ka(a, ga(D), k, z.svgOrigin, z.smoothOrigin), f = ta(C, "xOrigin", (v ? C : k).xOrigin, k.xOrigin, f, B), 
                f = ta(C, "yOrigin", (v ? C : k).yOrigin, k.yOrigin, f, B), (p !== C.xOffset || s !== C.yOffset) && (f = ta(C, "xOffset", v ? p : C.xOffset, C.xOffset, f, B), 
                f = ta(C, "yOffset", v ? s : C.yOffset, C.yOffset, f, B)), D = za ? null : "0px 0px"), 
                (D || Ea && m && C.zOrigin) && (Ba ? (n = !0, u = Da, D = (D || $(a, u, e, !1, "50% 50%")) + "", 
                f = new sa(w, u, 0, 0, f, -1, B), f.b = w[u], f.plugin = h, Ea ? (l = C.zOrigin, 
                D = D.split(" "), C.zOrigin = (D.length > 2 && (0 === l || "0px" !== D[2]) ? parseFloat(D[2]) : l) || 0, 
                f.xs0 = f.e = D[0] + " " + (D[1] || "50%") + " 0px", f = new sa(C, "zOrigin", 0, 0, f, -1, f.n), 
                f.b = l, f.xs0 = f.e = C.zOrigin) : f.xs0 = f.e = D) : ga(D + "", C)), n && (d._transformType = C.svg && za || !m && 3 !== this._transformType ? 2 : 3), 
                j && (i[c] = j), f;
            },
            prefix: !0
        }), xa("boxShadow", {
            defaultValue: "0px 0px 0px 0px #999",
            prefix: !0,
            color: !0,
            multi: !0,
            keyword: "inset"
        }), xa("borderRadius", {
            defaultValue: "0px",
            parser: function(a, b, c, f, g, h) {
                b = this.format(b);
                var i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y = [ "borderTopLeftRadius", "borderTopRightRadius", "borderBottomRightRadius", "borderBottomLeftRadius" ], z = a.style;
                for (q = parseFloat(a.offsetWidth), r = parseFloat(a.offsetHeight), i = b.split(" "), 
                j = 0; j < y.length; j++) this.p.indexOf("border") && (y[j] = Y(y[j])), m = l = $(a, y[j], e, !1, "0px"), 
                -1 !== m.indexOf(" ") && (l = m.split(" "), m = l[0], l = l[1]), n = k = i[j], o = parseFloat(m), 
                t = m.substr((o + "").length), u = "=" === n.charAt(1), u ? (p = parseInt(n.charAt(0) + "1", 10), 
                n = n.substr(2), p *= parseFloat(n), s = n.substr((p + "").length - (0 > p ? 1 : 0)) || "") : (p = parseFloat(n), 
                s = n.substr((p + "").length)), "" === s && (s = d[c] || t), s !== t && (v = _(a, "borderLeft", o, t), 
                w = _(a, "borderTop", o, t), "%" === s ? (m = v / q * 100 + "%", l = w / r * 100 + "%") : "em" === s ? (x = _(a, "borderLeft", 1, "em"), 
                m = v / x + "em", l = w / x + "em") : (m = v + "px", l = w + "px"), u && (n = parseFloat(m) + p + s, 
                k = parseFloat(l) + p + s)), g = ua(z, y[j], m + " " + l, n + " " + k, !1, "0px", g);
                return g;
            },
            prefix: !0,
            formatter: pa("0px 0px 0px 0px", !1, !0)
        }), xa("borderBottomLeftRadius,borderBottomRightRadius,borderTopLeftRadius,borderTopRightRadius", {
            defaultValue: "0px",
            parser: function(a, b, c, d, f, g) {
                return ua(a.style, c, this.format($(a, c, e, !1, "0px 0px")), this.format(b), !1, "0px", f);
            },
            prefix: !0,
            formatter: pa("0px 0px", !1, !0)
        }), xa("backgroundPosition", {
            defaultValue: "0 0",
            parser: function(a, b, c, d, f, g) {
                var h, i, j, k, l, m, n = "background-position", o = e || Z(a, null), q = this.format((o ? p ? o.getPropertyValue(n + "-x") + " " + o.getPropertyValue(n + "-y") : o.getPropertyValue(n) : a.currentStyle.backgroundPositionX + " " + a.currentStyle.backgroundPositionY) || "0 0"), r = this.format(b);
                if (-1 !== q.indexOf("%") != (-1 !== r.indexOf("%")) && r.split(",").length < 2 && (m = $(a, "backgroundImage").replace(D, ""), 
                m && "none" !== m)) {
                    for (h = q.split(" "), i = r.split(" "), Q.setAttribute("src", m), j = 2; --j > -1; ) q = h[j], 
                    k = -1 !== q.indexOf("%"), k !== (-1 !== i[j].indexOf("%")) && (l = 0 === j ? a.offsetWidth - Q.width : a.offsetHeight - Q.height, 
                    h[j] = k ? parseFloat(q) / 100 * l + "px" : parseFloat(q) / l * 100 + "%");
                    q = h.join(" ");
                }
                return this.parseComplex(a.style, q, r, f, g);
            },
            formatter: ga
        }), xa("backgroundSize", {
            defaultValue: "0 0",
            formatter: function(a) {
                return a += "", ga(-1 === a.indexOf(" ") ? a + " " + a : a);
            }
        }), xa("perspective", {
            defaultValue: "0px",
            prefix: !0
        }), xa("perspectiveOrigin", {
            defaultValue: "50% 50%",
            prefix: !0
        }), xa("transformStyle", {
            prefix: !0
        }), xa("backfaceVisibility", {
            prefix: !0
        }), xa("userSelect", {
            prefix: !0
        }), xa("margin", {
            parser: qa("marginTop,marginRight,marginBottom,marginLeft")
        }), xa("padding", {
            parser: qa("paddingTop,paddingRight,paddingBottom,paddingLeft")
        }), xa("clip", {
            defaultValue: "rect(0px,0px,0px,0px)",
            parser: function(a, b, c, d, f, g) {
                var h, i, j;
                return 9 > p ? (i = a.currentStyle, j = 8 > p ? " " : ",", h = "rect(" + i.clipTop + j + i.clipRight + j + i.clipBottom + j + i.clipLeft + ")", 
                b = this.format(b).split(",").join(j)) : (h = this.format($(a, this.p, e, !1, this.dflt)), 
                b = this.format(b)), this.parseComplex(a.style, h, b, f, g);
            }
        }), xa("textShadow", {
            defaultValue: "0px 0px 0px #999",
            color: !0,
            multi: !0
        }), xa("autoRound,strictUnits", {
            parser: function(a, b, c, d, e) {
                return e;
            }
        }), xa("border", {
            defaultValue: "0px solid #000",
            parser: function(a, b, c, d, f, g) {
                var h = $(a, "borderTopWidth", e, !1, "0px"), i = this.format(b).split(" "), j = i[0].replace(w, "");
                return "px" !== j && (h = parseFloat(h) / _(a, "borderTopWidth", 1, j) + j), this.parseComplex(a.style, this.format(h + " " + $(a, "borderTopStyle", e, !1, "solid") + " " + $(a, "borderTopColor", e, !1, "#000")), i.join(" "), f, g);
            },
            color: !0,
            formatter: function(a) {
                var b = a.split(" ");
                return b[0] + " " + (b[1] || "solid") + " " + (a.match(oa) || [ "#000" ])[0];
            }
        }), xa("borderWidth", {
            parser: qa("borderTopWidth,borderRightWidth,borderBottomWidth,borderLeftWidth")
        }), xa("float,cssFloat,styleFloat", {
            parser: function(a, b, c, d, e, f) {
                var g = a.style, h = "cssFloat" in g ? "cssFloat" : "styleFloat";
                return new sa(g, h, 0, 0, e, -1, c, !1, 0, g[h], b);
            }
        });
        var Sa = function(a) {
            var b, c = this.t, d = c.filter || $(this.data, "filter") || "", e = this.s + this.c * a | 0;
            100 === e && (-1 === d.indexOf("atrix(") && -1 === d.indexOf("radient(") && -1 === d.indexOf("oader(") ? (c.removeAttribute("filter"), 
            b = !$(this.data, "filter")) : (c.filter = d.replace(z, ""), b = !0)), b || (this.xn1 && (c.filter = d = d || "alpha(opacity=" + e + ")"), 
            -1 === d.indexOf("pacity") ? 0 === e && this.xn1 || (c.filter = d + " alpha(opacity=" + e + ")") : c.filter = d.replace(x, "opacity=" + e));
        };
        xa("opacity,alpha,autoAlpha", {
            defaultValue: "1",
            parser: function(a, b, c, d, f, g) {
                var h = parseFloat($(a, "opacity", e, !1, "1")), i = a.style, j = "autoAlpha" === c;
                return "string" == typeof b && "=" === b.charAt(1) && (b = ("-" === b.charAt(0) ? -1 : 1) * parseFloat(b.substr(2)) + h), 
                j && 1 === h && "hidden" === $(a, "visibility", e) && 0 !== b && (h = 0), T ? f = new sa(i, "opacity", h, b - h, f) : (f = new sa(i, "opacity", 100 * h, 100 * (b - h), f), 
                f.xn1 = j ? 1 : 0, i.zoom = 1, f.type = 2, f.b = "alpha(opacity=" + f.s + ")", f.e = "alpha(opacity=" + (f.s + f.c) + ")", 
                f.data = a, f.plugin = g, f.setRatio = Sa), j && (f = new sa(i, "visibility", 0, 0, f, -1, null, !1, 0, 0 !== h ? "inherit" : "hidden", 0 === b ? "hidden" : "inherit"), 
                f.xs0 = "inherit", d._overwriteProps.push(f.n), d._overwriteProps.push(c)), f;
            }
        });
        var Ta = function(a, b) {
            b && (a.removeProperty ? (("ms" === b.substr(0, 2) || "webkit" === b.substr(0, 6)) && (b = "-" + b), 
            a.removeProperty(b.replace(B, "-$1").toLowerCase())) : a.removeAttribute(b));
        }, Ua = function(a) {
            if (this.t._gsClassPT = this, 1 === a || 0 === a) {
                this.t.setAttribute("class", 0 === a ? this.b : this.e);
                for (var b = this.data, c = this.t.style; b; ) b.v ? c[b.p] = b.v : Ta(c, b.p), 
                b = b._next;
                1 === a && this.t._gsClassPT === this && (this.t._gsClassPT = null);
            } else this.t.getAttribute("class") !== this.e && this.t.setAttribute("class", this.e);
        };
        xa("className", {
            parser: function(a, b, d, f, g, h, i) {
                var j, k, l, m, n, o = a.getAttribute("class") || "", p = a.style.cssText;
                if (g = f._classNamePT = new sa(a, d, 0, 0, g, 2), g.setRatio = Ua, g.pr = -11, 
                c = !0, g.b = o, k = ba(a, e), l = a._gsClassPT) {
                    for (m = {}, n = l.data; n; ) m[n.p] = 1, n = n._next;
                    l.setRatio(1);
                }
                return a._gsClassPT = g, g.e = "=" !== b.charAt(1) ? b : o.replace(new RegExp("(?:\\s|^)" + b.substr(2) + "(?![\\w-])"), "") + ("+" === b.charAt(0) ? " " + b.substr(2) : ""), 
                a.setAttribute("class", g.e), j = ca(a, k, ba(a), i, m), a.setAttribute("class", o), 
                g.data = j.firstMPT, a.style.cssText = p, g = g.xfirst = f.parse(a, j.difs, g, h);
            }
        });
        var Va = function(a) {
            if ((1 === a || 0 === a) && this.data._totalTime === this.data._totalDuration && "isFromStart" !== this.data.data) {
                var b, c, d, e, f, g = this.t.style, h = i.transform.parse;
                if ("all" === this.e) g.cssText = "", e = !0; else for (b = this.e.split(" ").join("").split(","), 
                d = b.length; --d > -1; ) c = b[d], i[c] && (i[c].parse === h ? e = !0 : c = "transformOrigin" === c ? Da : i[c].p), 
                Ta(g, c);
                e && (Ta(g, Ba), f = this.t._gsTransform, f && (f.svg && (this.t.removeAttribute("data-svg-origin"), 
                this.t.removeAttribute("transform")), delete this.t._gsTransform));
            }
        };
        for (xa("clearProps", {
            parser: function(a, b, d, e, f) {
                return f = new sa(a, d, 0, 0, f, 2), f.setRatio = Va, f.e = b, f.pr = -10, f.data = e._tween, 
                c = !0, f;
            }
        }), j = "bezier,throwProps,physicsProps,physics2D".split(","), va = j.length; va--; ) ya(j[va]);
        j = g.prototype, j._firstPT = j._lastParsedTransform = j._transform = null, j._onInitTween = function(a, b, h, j) {
            if (!a.nodeType) return !1;
            this._target = q = a, this._tween = h, this._vars = b, r = j, k = b.autoRound, c = !1, 
            d = b.suffixMap || g.suffixMap, e = Z(a, ""), f = this._overwriteProps;
            var n, p, s, t, u, v, w, x, z, A = a.style;
            if (l && "" === A.zIndex && (n = $(a, "zIndex", e), ("auto" === n || "" === n) && this._addLazySet(A, "zIndex", 0)), 
            "string" == typeof b && (t = A.cssText, n = ba(a, e), A.cssText = t + ";" + b, n = ca(a, n, ba(a)).difs, 
            !T && y.test(b) && (n.opacity = parseFloat(RegExp.$1)), b = n, A.cssText = t), b.className ? this._firstPT = p = i.className.parse(a, b.className, "className", this, null, null, b) : this._firstPT = p = this.parse(a, b, null), 
            this._transformType) {
                for (z = 3 === this._transformType, Ba ? m && (l = !0, "" === A.zIndex && (w = $(a, "zIndex", e), 
                ("auto" === w || "" === w) && this._addLazySet(A, "zIndex", 0)), o && this._addLazySet(A, "WebkitBackfaceVisibility", this._vars.WebkitBackfaceVisibility || (z ? "visible" : "hidden"))) : A.zoom = 1, 
                s = p; s && s._next; ) s = s._next;
                x = new sa(a, "transform", 0, 0, null, 2), this._linkCSSP(x, null, s), x.setRatio = Ba ? Ra : Qa, 
                x.data = this._transform || Pa(a, e, !0), x.tween = h, x.pr = -1, f.pop();
            }
            if (c) {
                for (;p; ) {
                    for (v = p._next, s = t; s && s.pr > p.pr; ) s = s._next;
                    (p._prev = s ? s._prev : u) ? p._prev._next = p : t = p, (p._next = s) ? s._prev = p : u = p, 
                    p = v;
                }
                this._firstPT = t;
            }
            return !0;
        }, j.parse = function(a, b, c, f) {
            var g, h, j, l, m, n, o, p, s, t, u = a.style;
            for (g in b) n = b[g], "function" == typeof n && (n = n(r, q)), h = i[g], h ? c = h.parse(a, n, g, this, c, f, b) : (m = $(a, g, e) + "", 
            s = "string" == typeof n, "color" === g || "fill" === g || "stroke" === g || -1 !== g.indexOf("Color") || s && A.test(n) ? (s || (n = ma(n), 
            n = (n.length > 3 ? "rgba(" : "rgb(") + n.join(",") + ")"), c = ua(u, g, m, n, !0, "transparent", c, 0, f)) : s && J.test(n) ? c = ua(u, g, m, n, !0, null, c, 0, f) : (j = parseFloat(m), 
            o = j || 0 === j ? m.substr((j + "").length) : "", ("" === m || "auto" === m) && ("width" === g || "height" === g ? (j = fa(a, g, e), 
            o = "px") : "left" === g || "top" === g ? (j = aa(a, g, e), o = "px") : (j = "opacity" !== g ? 0 : 1, 
            o = "")), t = s && "=" === n.charAt(1), t ? (l = parseInt(n.charAt(0) + "1", 10), 
            n = n.substr(2), l *= parseFloat(n), p = n.replace(w, "")) : (l = parseFloat(n), 
            p = s ? n.replace(w, "") : ""), "" === p && (p = g in d ? d[g] : o), n = l || 0 === l ? (t ? l + j : l) + p : b[g], 
            o !== p && "" !== p && (l || 0 === l) && j && (j = _(a, g, j, o), "%" === p ? (j /= _(a, g, 100, "%") / 100, 
            b.strictUnits !== !0 && (m = j + "%")) : "em" === p || "rem" === p || "vw" === p || "vh" === p ? j /= _(a, g, 1, p) : "px" !== p && (l = _(a, g, l, p), 
            p = "px"), t && (l || 0 === l) && (n = l + j + p)), t && (l += j), !j && 0 !== j || !l && 0 !== l ? void 0 !== u[g] && (n || n + "" != "NaN" && null != n) ? (c = new sa(u, g, l || j || 0, 0, c, -1, g, !1, 0, m, n), 
            c.xs0 = "none" !== n || "display" !== g && -1 === g.indexOf("Style") ? n : m) : V("invalid " + g + " tween value: " + b[g]) : (c = new sa(u, g, j, l - j, c, 0, g, k !== !1 && ("px" === p || "zIndex" === g), 0, m, n), 
            c.xs0 = p))), f && c && !c.plugin && (c.plugin = f);
            return c;
        }, j.setRatio = function(a) {
            var b, c, d, e = this._firstPT, f = 1e-6;
            if (1 !== a || this._tween._time !== this._tween._duration && 0 !== this._tween._time) if (a || this._tween._time !== this._tween._duration && 0 !== this._tween._time || this._tween._rawPrevTime === -1e-6) for (;e; ) {
                if (b = e.c * a + e.s, e.r ? b = Math.round(b) : f > b && b > -f && (b = 0), e.type) if (1 === e.type) if (d = e.l, 
                2 === d) e.t[e.p] = e.xs0 + b + e.xs1 + e.xn1 + e.xs2; else if (3 === d) e.t[e.p] = e.xs0 + b + e.xs1 + e.xn1 + e.xs2 + e.xn2 + e.xs3; else if (4 === d) e.t[e.p] = e.xs0 + b + e.xs1 + e.xn1 + e.xs2 + e.xn2 + e.xs3 + e.xn3 + e.xs4; else if (5 === d) e.t[e.p] = e.xs0 + b + e.xs1 + e.xn1 + e.xs2 + e.xn2 + e.xs3 + e.xn3 + e.xs4 + e.xn4 + e.xs5; else {
                    for (c = e.xs0 + b + e.xs1, d = 1; d < e.l; d++) c += e["xn" + d] + e["xs" + (d + 1)];
                    e.t[e.p] = c;
                } else -1 === e.type ? e.t[e.p] = e.xs0 : e.setRatio && e.setRatio(a); else e.t[e.p] = b + e.xs0;
                e = e._next;
            } else for (;e; ) 2 !== e.type ? e.t[e.p] = e.b : e.setRatio(a), e = e._next; else for (;e; ) {
                if (2 !== e.type) if (e.r && -1 !== e.type) if (b = Math.round(e.s + e.c), e.type) {
                    if (1 === e.type) {
                        for (d = e.l, c = e.xs0 + b + e.xs1, d = 1; d < e.l; d++) c += e["xn" + d] + e["xs" + (d + 1)];
                        e.t[e.p] = c;
                    }
                } else e.t[e.p] = b + e.xs0; else e.t[e.p] = e.e; else e.setRatio(a);
                e = e._next;
            }
        }, j._enableTransforms = function(a) {
            this._transform = this._transform || Pa(this._target, e, !0), this._transformType = this._transform.svg && za || !a && 3 !== this._transformType ? 2 : 3;
        };
        var Wa = function(a) {
            this.t[this.p] = this.e, this.data._linkCSSP(this, this._next, null, !0);
        };
        j._addLazySet = function(a, b, c) {
            var d = this._firstPT = new sa(a, b, 0, 0, this._firstPT, 2);
            d.e = c, d.setRatio = Wa, d.data = this;
        }, j._linkCSSP = function(a, b, c, d) {
            return a && (b && (b._prev = a), a._next && (a._next._prev = a._prev), a._prev ? a._prev._next = a._next : this._firstPT === a && (this._firstPT = a._next, 
            d = !0), c ? c._next = a : d || null !== this._firstPT || (this._firstPT = a), a._next = b, 
            a._prev = c), a;
        }, j._mod = function(a) {
            for (var b = this._firstPT; b; ) "function" == typeof a[b.p] && a[b.p] === Math.round && (b.r = 1), 
            b = b._next;
        }, j._kill = function(b) {
            var c, d, e, f = b;
            if (b.autoAlpha || b.alpha) {
                f = {};
                for (d in b) f[d] = b[d];
                f.opacity = 1, f.autoAlpha && (f.visibility = 1);
            }
            for (b.className && (c = this._classNamePT) && (e = c.xfirst, e && e._prev ? this._linkCSSP(e._prev, c._next, e._prev._prev) : e === this._firstPT && (this._firstPT = c._next), 
            c._next && this._linkCSSP(c._next, c._next._next, e._prev), this._classNamePT = null), 
            c = this._firstPT; c; ) c.plugin && c.plugin !== d && c.plugin._kill && (c.plugin._kill(b), 
            d = c.plugin), c = c._next;
            return a.prototype._kill.call(this, f);
        };
        var Xa = function(a, b, c) {
            var d, e, f, g;
            if (a.slice) for (e = a.length; --e > -1; ) Xa(a[e], b, c); else for (d = a.childNodes, 
            e = d.length; --e > -1; ) f = d[e], g = f.type, f.style && (b.push(ba(f)), c && c.push(f)), 
            1 !== g && 9 !== g && 11 !== g || !f.childNodes.length || Xa(f, b, c);
        };
        return g.cascadeTo = function(a, c, d) {
            var e, f, g, h, i = b.to(a, c, d), j = [ i ], k = [], l = [], m = [], n = b._internals.reservedProps;
            for (a = i._targets || i.target, Xa(a, k, m), i.render(c, !0, !0), Xa(a, l), i.render(0, !0, !0), 
            i._enabled(!0), e = m.length; --e > -1; ) if (f = ca(m[e], k[e], l[e]), f.firstMPT) {
                f = f.difs;
                for (g in d) n[g] && (f[g] = d[g]);
                h = {};
                for (g in f) h[g] = k[e][g];
                j.push(b.fromTo(m[e], c, h, f));
            }
            return j;
        }, a.activate([ g ]), g;
    }, !0), function() {
        var a = _gsScope._gsDefine.plugin({
            propName: "roundProps",
            version: "1.6.0",
            priority: -1,
            API: 2,
            init: function(a, b, c) {
                return this._tween = c, !0;
            }
        }), b = function(a) {
            for (;a; ) a.f || a.blob || (a.m = Math.round), a = a._next;
        }, c = a.prototype;
        c._onInitAllProps = function() {
            for (var a, c, d, e = this._tween, f = e.vars.roundProps.join ? e.vars.roundProps : e.vars.roundProps.split(","), g = f.length, h = {}, i = e._propLookup.roundProps; --g > -1; ) h[f[g]] = Math.round;
            for (g = f.length; --g > -1; ) for (a = f[g], c = e._firstPT; c; ) d = c._next, 
            c.pg ? c.t._mod(h) : c.n === a && (2 === c.f && c.t ? b(c.t._firstPT) : (this._add(c.t, a, c.s, c.c), 
            d && (d._prev = c._prev), c._prev ? c._prev._next = d : e._firstPT === c && (e._firstPT = d), 
            c._next = c._prev = null, e._propLookup[a] = i)), c = d;
            return !1;
        }, c._add = function(a, b, c, d) {
            this._addTween(a, b, c, c + d, b, Math.round), this._overwriteProps.push(b);
        };
    }(), function() {
        _gsScope._gsDefine.plugin({
            propName: "attr",
            API: 2,
            version: "0.6.0",
            init: function(a, b, c, d) {
                var e, f;
                if ("function" != typeof a.setAttribute) return !1;
                for (e in b) f = b[e], "function" == typeof f && (f = f(d, a)), this._addTween(a, "setAttribute", a.getAttribute(e) + "", f + "", e, !1, e), 
                this._overwriteProps.push(e);
                return !0;
            }
        });
    }(), _gsScope._gsDefine.plugin({
        propName: "directionalRotation",
        version: "0.3.0",
        API: 2,
        init: function(a, b, c, d) {
            "object" != typeof b && (b = {
                rotation: b
            }), this.finals = {};
            var e, f, g, h, i, j, k = b.useRadians === !0 ? 2 * Math.PI : 360, l = 1e-6;
            for (e in b) "useRadians" !== e && (h = b[e], "function" == typeof h && (h = h(d, a)), 
            j = (h + "").split("_"), f = j[0], g = parseFloat("function" != typeof a[e] ? a[e] : a[e.indexOf("set") || "function" != typeof a["get" + e.substr(3)] ? e : "get" + e.substr(3)]()), 
            h = this.finals[e] = "string" == typeof f && "=" === f.charAt(1) ? g + parseInt(f.charAt(0) + "1", 10) * Number(f.substr(2)) : Number(f) || 0, 
            i = h - g, j.length && (f = j.join("_"), -1 !== f.indexOf("short") && (i %= k, i !== i % (k / 2) && (i = 0 > i ? i + k : i - k)), 
            -1 !== f.indexOf("_cw") && 0 > i ? i = (i + 9999999999 * k) % k - (i / k | 0) * k : -1 !== f.indexOf("ccw") && i > 0 && (i = (i - 9999999999 * k) % k - (i / k | 0) * k)), 
            (i > l || -l > i) && (this._addTween(a, e, g, g + i, e), this._overwriteProps.push(e)));
            return !0;
        },
        set: function(a) {
            var b;
            if (1 !== a) this._super.setRatio.call(this, a); else for (b = this._firstPT; b; ) b.f ? b.t[b.p](this.finals[b.p]) : b.t[b.p] = this.finals[b.p], 
            b = b._next;
        }
    })._autoCSS = !0, _gsScope._gsDefine("easing.Back", [ "easing.Ease" ], function(a) {
        var b, c, d, e = _gsScope.GreenSockGlobals || _gsScope, f = e.com.greensock, g = 2 * Math.PI, h = Math.PI / 2, i = f._class, j = function(b, c) {
            var d = i("easing." + b, function() {}, !0), e = d.prototype = new a();
            return e.constructor = d, e.getRatio = c, d;
        }, k = a.register || function() {}, l = function(a, b, c, d, e) {
            var f = i("easing." + a, {
                easeOut: new b(),
                easeIn: new c(),
                easeInOut: new d()
            }, !0);
            return k(f, a), f;
        }, m = function(a, b, c) {
            this.t = a, this.v = b, c && (this.next = c, c.prev = this, this.c = c.v - b, this.gap = c.t - a);
        }, n = function(b, c) {
            var d = i("easing." + b, function(a) {
                this._p1 = a || 0 === a ? a : 1.70158, this._p2 = 1.525 * this._p1;
            }, !0), e = d.prototype = new a();
            return e.constructor = d, e.getRatio = c, e.config = function(a) {
                return new d(a);
            }, d;
        }, o = l("Back", n("BackOut", function(a) {
            return (a -= 1) * a * ((this._p1 + 1) * a + this._p1) + 1;
        }), n("BackIn", function(a) {
            return a * a * ((this._p1 + 1) * a - this._p1);
        }), n("BackInOut", function(a) {
            return (a *= 2) < 1 ? .5 * a * a * ((this._p2 + 1) * a - this._p2) : .5 * ((a -= 2) * a * ((this._p2 + 1) * a + this._p2) + 2);
        })), p = i("easing.SlowMo", function(a, b, c) {
            b = b || 0 === b ? b : .7, null == a ? a = .7 : a > 1 && (a = 1), this._p = 1 !== a ? b : 0, 
            this._p1 = (1 - a) / 2, this._p2 = a, this._p3 = this._p1 + this._p2, this._calcEnd = c === !0;
        }, !0), q = p.prototype = new a();
        return q.constructor = p, q.getRatio = function(a) {
            var b = a + (.5 - a) * this._p;
            return a < this._p1 ? this._calcEnd ? 1 - (a = 1 - a / this._p1) * a : b - (a = 1 - a / this._p1) * a * a * a * b : a > this._p3 ? this._calcEnd ? 1 - (a = (a - this._p3) / this._p1) * a : b + (a - b) * (a = (a - this._p3) / this._p1) * a * a * a : this._calcEnd ? 1 : b;
        }, p.ease = new p(.7, .7), q.config = p.config = function(a, b, c) {
            return new p(a, b, c);
        }, b = i("easing.SteppedEase", function(a) {
            a = a || 1, this._p1 = 1 / a, this._p2 = a + 1;
        }, !0), q = b.prototype = new a(), q.constructor = b, q.getRatio = function(a) {
            return 0 > a ? a = 0 : a >= 1 && (a = .999999999), (this._p2 * a >> 0) * this._p1;
        }, q.config = b.config = function(a) {
            return new b(a);
        }, c = i("easing.RoughEase", function(b) {
            b = b || {};
            for (var c, d, e, f, g, h, i = b.taper || "none", j = [], k = 0, l = 0 | (b.points || 20), n = l, o = b.randomize !== !1, p = b.clamp === !0, q = b.template instanceof a ? b.template : null, r = "number" == typeof b.strength ? .4 * b.strength : .4; --n > -1; ) c = o ? Math.random() : 1 / l * n, 
            d = q ? q.getRatio(c) : c, "none" === i ? e = r : "out" === i ? (f = 1 - c, e = f * f * r) : "in" === i ? e = c * c * r : .5 > c ? (f = 2 * c, 
            e = f * f * .5 * r) : (f = 2 * (1 - c), e = f * f * .5 * r), o ? d += Math.random() * e - .5 * e : n % 2 ? d += .5 * e : d -= .5 * e, 
            p && (d > 1 ? d = 1 : 0 > d && (d = 0)), j[k++] = {
                x: c,
                y: d
            };
            for (j.sort(function(a, b) {
                return a.x - b.x;
            }), h = new m(1, 1, null), n = l; --n > -1; ) g = j[n], h = new m(g.x, g.y, h);
            this._prev = new m(0, 0, 0 !== h.t ? h : h.next);
        }, !0), q = c.prototype = new a(), q.constructor = c, q.getRatio = function(a) {
            var b = this._prev;
            if (a > b.t) {
                for (;b.next && a >= b.t; ) b = b.next;
                b = b.prev;
            } else for (;b.prev && a <= b.t; ) b = b.prev;
            return this._prev = b, b.v + (a - b.t) / b.gap * b.c;
        }, q.config = function(a) {
            return new c(a);
        }, c.ease = new c(), l("Bounce", j("BounceOut", function(a) {
            return 1 / 2.75 > a ? 7.5625 * a * a : 2 / 2.75 > a ? 7.5625 * (a -= 1.5 / 2.75) * a + .75 : 2.5 / 2.75 > a ? 7.5625 * (a -= 2.25 / 2.75) * a + .9375 : 7.5625 * (a -= 2.625 / 2.75) * a + .984375;
        }), j("BounceIn", function(a) {
            return (a = 1 - a) < 1 / 2.75 ? 1 - 7.5625 * a * a : 2 / 2.75 > a ? 1 - (7.5625 * (a -= 1.5 / 2.75) * a + .75) : 2.5 / 2.75 > a ? 1 - (7.5625 * (a -= 2.25 / 2.75) * a + .9375) : 1 - (7.5625 * (a -= 2.625 / 2.75) * a + .984375);
        }), j("BounceInOut", function(a) {
            var b = .5 > a;
            return a = b ? 1 - 2 * a : 2 * a - 1, a = 1 / 2.75 > a ? 7.5625 * a * a : 2 / 2.75 > a ? 7.5625 * (a -= 1.5 / 2.75) * a + .75 : 2.5 / 2.75 > a ? 7.5625 * (a -= 2.25 / 2.75) * a + .9375 : 7.5625 * (a -= 2.625 / 2.75) * a + .984375, 
            b ? .5 * (1 - a) : .5 * a + .5;
        })), l("Circ", j("CircOut", function(a) {
            return Math.sqrt(1 - (a -= 1) * a);
        }), j("CircIn", function(a) {
            return -(Math.sqrt(1 - a * a) - 1);
        }), j("CircInOut", function(a) {
            return (a *= 2) < 1 ? -.5 * (Math.sqrt(1 - a * a) - 1) : .5 * (Math.sqrt(1 - (a -= 2) * a) + 1);
        })), d = function(b, c, d) {
            var e = i("easing." + b, function(a, b) {
                this._p1 = a >= 1 ? a : 1, this._p2 = (b || d) / (1 > a ? a : 1), this._p3 = this._p2 / g * (Math.asin(1 / this._p1) || 0), 
                this._p2 = g / this._p2;
            }, !0), f = e.prototype = new a();
            return f.constructor = e, f.getRatio = c, f.config = function(a, b) {
                return new e(a, b);
            }, e;
        }, l("Elastic", d("ElasticOut", function(a) {
            return this._p1 * Math.pow(2, -10 * a) * Math.sin((a - this._p3) * this._p2) + 1;
        }, .3), d("ElasticIn", function(a) {
            return -(this._p1 * Math.pow(2, 10 * (a -= 1)) * Math.sin((a - this._p3) * this._p2));
        }, .3), d("ElasticInOut", function(a) {
            return (a *= 2) < 1 ? -.5 * (this._p1 * Math.pow(2, 10 * (a -= 1)) * Math.sin((a - this._p3) * this._p2)) : this._p1 * Math.pow(2, -10 * (a -= 1)) * Math.sin((a - this._p3) * this._p2) * .5 + 1;
        }, .45)), l("Expo", j("ExpoOut", function(a) {
            return 1 - Math.pow(2, -10 * a);
        }), j("ExpoIn", function(a) {
            return Math.pow(2, 10 * (a - 1)) - .001;
        }), j("ExpoInOut", function(a) {
            return (a *= 2) < 1 ? .5 * Math.pow(2, 10 * (a - 1)) : .5 * (2 - Math.pow(2, -10 * (a - 1)));
        })), l("Sine", j("SineOut", function(a) {
            return Math.sin(a * h);
        }), j("SineIn", function(a) {
            return -Math.cos(a * h) + 1;
        }), j("SineInOut", function(a) {
            return -.5 * (Math.cos(Math.PI * a) - 1);
        })), i("easing.EaseLookup", {
            find: function(b) {
                return a.map[b];
            }
        }, !0), k(e.SlowMo, "SlowMo", "ease,"), k(c, "RoughEase", "ease,"), k(b, "SteppedEase", "ease,"), 
        o;
    }, !0);
}), _gsScope._gsDefine && _gsScope._gsQueue.pop()(), function(a, b) {
    "use strict";
    var c = {}, d = a.GreenSockGlobals = a.GreenSockGlobals || a;
    if (!d.TweenLite) {
        var e, f, g, h, i, j = function(a) {
            var b, c = a.split("."), e = d;
            for (b = 0; b < c.length; b++) e[c[b]] = e = e[c[b]] || {};
            return e;
        }, k = j("com.greensock"), l = 1e-10, m = function(a) {
            var b, c = [], d = a.length;
            for (b = 0; b !== d; c.push(a[b++])) ;
            return c;
        }, n = function() {}, o = function() {
            var a = Object.prototype.toString, b = a.call([]);
            return function(c) {
                return null != c && (c instanceof Array || "object" == typeof c && !!c.push && a.call(c) === b);
            };
        }(), p = {}, q = function(e, f, g, h) {
            this.sc = p[e] ? p[e].sc : [], p[e] = this, this.gsClass = null, this.func = g;
            var i = [];
            this.check = function(k) {
                for (var l, m, n, o, r, s = f.length, t = s; --s > -1; ) (l = p[f[s]] || new q(f[s], [])).gsClass ? (i[s] = l.gsClass, 
                t--) : k && l.sc.push(this);
                if (0 === t && g) {
                    if (m = ("com.greensock." + e).split("."), n = m.pop(), o = j(m.join("."))[n] = this.gsClass = g.apply(g, i), 
                    h) if (d[n] = c[n] = o, r = "undefined" != typeof module && module.exports, !r && "function" == typeof define && define.amd) define((a.GreenSockAMDPath ? a.GreenSockAMDPath + "/" : "") + e.split(".").pop(), [], function() {
                        return o;
                    }); else if (r) if (e === b) {
                        module.exports = c[b] = o;
                        for (s in c) o[s] = c[s];
                    } else c[b] && (c[b][n] = o);
                    for (s = 0; s < this.sc.length; s++) this.sc[s].check();
                }
            }, this.check(!0);
        }, r = a._gsDefine = function(a, b, c, d) {
            return new q(a, b, c, d);
        }, s = k._class = function(a, b, c) {
            return b = b || function() {}, r(a, [], function() {
                return b;
            }, c), b;
        };
        r.globals = d;
        var t = [ 0, 0, 1, 1 ], u = s("easing.Ease", function(a, b, c, d) {
            this._func = a, this._type = c || 0, this._power = d || 0, this._params = b ? t.concat(b) : t;
        }, !0), v = u.map = {}, w = u.register = function(a, b, c, d) {
            for (var e, f, g, h, i = b.split(","), j = i.length, l = (c || "easeIn,easeOut,easeInOut").split(","); --j > -1; ) for (f = i[j], 
            e = d ? s("easing." + f, null, !0) : k.easing[f] || {}, g = l.length; --g > -1; ) h = l[g], 
            v[f + "." + h] = v[h + f] = e[h] = a.getRatio ? a : a[h] || new a();
        };
        for (g = u.prototype, g._calcEnd = !1, g.getRatio = function(a) {
            if (this._func) return this._params[0] = a, this._func.apply(null, this._params);
            var b = this._type, c = this._power, d = 1 === b ? 1 - a : 2 === b ? a : .5 > a ? 2 * a : 2 * (1 - a);
            return 1 === c ? d *= d : 2 === c ? d *= d * d : 3 === c ? d *= d * d * d : 4 === c && (d *= d * d * d * d), 
            1 === b ? 1 - d : 2 === b ? d : .5 > a ? d / 2 : 1 - d / 2;
        }, e = [ "Linear", "Quad", "Cubic", "Quart", "Quint,Strong" ], f = e.length; --f > -1; ) g = e[f] + ",Power" + f, 
        w(new u(null, null, 1, f), g, "easeOut", !0), w(new u(null, null, 2, f), g, "easeIn" + (0 === f ? ",easeNone" : "")), 
        w(new u(null, null, 3, f), g, "easeInOut");
        v.linear = k.easing.Linear.easeIn, v.swing = k.easing.Quad.easeInOut;
        var x = s("events.EventDispatcher", function(a) {
            this._listeners = {}, this._eventTarget = a || this;
        });
        g = x.prototype, g.addEventListener = function(a, b, c, d, e) {
            e = e || 0;
            var f, g, j = this._listeners[a], k = 0;
            for (this !== h || i || h.wake(), null == j && (this._listeners[a] = j = []), g = j.length; --g > -1; ) f = j[g], 
            f.c === b && f.s === c ? j.splice(g, 1) : 0 === k && f.pr < e && (k = g + 1);
            j.splice(k, 0, {
                c: b,
                s: c,
                up: d,
                pr: e
            });
        }, g.removeEventListener = function(a, b) {
            var c, d = this._listeners[a];
            if (d) for (c = d.length; --c > -1; ) if (d[c].c === b) return void d.splice(c, 1);
        }, g.dispatchEvent = function(a) {
            var b, c, d, e = this._listeners[a];
            if (e) for (b = e.length, b > 1 && (e = e.slice(0)), c = this._eventTarget; --b > -1; ) d = e[b], 
            d && (d.up ? d.c.call(d.s || c, {
                type: a,
                target: c
            }) : d.c.call(d.s || c));
        };
        var y = a.requestAnimationFrame, z = a.cancelAnimationFrame, A = Date.now || function() {
            return new Date().getTime();
        }, B = A();
        for (e = [ "ms", "moz", "webkit", "o" ], f = e.length; --f > -1 && !y; ) y = a[e[f] + "RequestAnimationFrame"], 
        z = a[e[f] + "CancelAnimationFrame"] || a[e[f] + "CancelRequestAnimationFrame"];
        s("Ticker", function(a, b) {
            var c, d, e, f, g, j = this, k = A(), m = b !== !1 && y ? "auto" : !1, o = 500, p = 33, q = "tick", r = function(a) {
                var b, h, i = A() - B;
                i > o && (k += i - p), B += i, j.time = (B - k) / 1e3, b = j.time - g, (!c || b > 0 || a === !0) && (j.frame++, 
                g += b + (b >= f ? .004 : f - b), h = !0), a !== !0 && (e = d(r)), h && j.dispatchEvent(q);
            };
            x.call(j), j.time = j.frame = 0, j.tick = function() {
                r(!0);
            }, j.lagSmoothing = function(a, b) {
                o = a || 1 / l, p = Math.min(b, o, 0);
            }, j.sleep = function() {
                null != e && (m && z ? z(e) : clearTimeout(e), d = n, e = null, j === h && (i = !1));
            }, j.wake = function(a) {
                null !== e ? j.sleep() : a ? k += -B + (B = A()) : j.frame > 10 && (B = A() - o + 5), 
                d = 0 === c ? n : m && y ? y : function(a) {
                    return setTimeout(a, 1e3 * (g - j.time) + 1 | 0);
                }, j === h && (i = !0), r(2);
            }, j.fps = function(a) {
                return arguments.length ? (c = a, f = 1 / (c || 60), g = this.time + f, void j.wake()) : c;
            }, j.useRAF = function(a) {
                return arguments.length ? (j.sleep(), m = a, void j.fps(c)) : m;
            }, j.fps(a), setTimeout(function() {
                "auto" === m && j.frame < 5 && "hidden" !== document.visibilityState && j.useRAF(!1);
            }, 1500);
        }), g = k.Ticker.prototype = new k.events.EventDispatcher(), g.constructor = k.Ticker;
        var C = s("core.Animation", function(a, b) {
            if (this.vars = b = b || {}, this._duration = this._totalDuration = a || 0, this._delay = Number(b.delay) || 0, 
            this._timeScale = 1, this._active = b.immediateRender === !0, this.data = b.data, 
            this._reversed = b.reversed === !0, V) {
                i || h.wake();
                var c = this.vars.useFrames ? U : V;
                c.add(this, c._time), this.vars.paused && this.paused(!0);
            }
        });
        h = C.ticker = new k.Ticker(), g = C.prototype, g._dirty = g._gc = g._initted = g._paused = !1, 
        g._totalTime = g._time = 0, g._rawPrevTime = -1, g._next = g._last = g._onUpdate = g._timeline = g.timeline = null, 
        g._paused = !1;
        var D = function() {
            i && A() - B > 2e3 && h.wake(), setTimeout(D, 2e3);
        };
        D(), g.play = function(a, b) {
            return null != a && this.seek(a, b), this.reversed(!1).paused(!1);
        }, g.pause = function(a, b) {
            return null != a && this.seek(a, b), this.paused(!0);
        }, g.resume = function(a, b) {
            return null != a && this.seek(a, b), this.paused(!1);
        }, g.seek = function(a, b) {
            return this.totalTime(Number(a), b !== !1);
        }, g.restart = function(a, b) {
            return this.reversed(!1).paused(!1).totalTime(a ? -this._delay : 0, b !== !1, !0);
        }, g.reverse = function(a, b) {
            return null != a && this.seek(a || this.totalDuration(), b), this.reversed(!0).paused(!1);
        }, g.render = function(a, b, c) {}, g.invalidate = function() {
            return this._time = this._totalTime = 0, this._initted = this._gc = !1, this._rawPrevTime = -1, 
            (this._gc || !this.timeline) && this._enabled(!0), this;
        }, g.isActive = function() {
            var a, b = this._timeline, c = this._startTime;
            return !b || !this._gc && !this._paused && b.isActive() && (a = b.rawTime()) >= c && a < c + this.totalDuration() / this._timeScale;
        }, g._enabled = function(a, b) {
            return i || h.wake(), this._gc = !a, this._active = this.isActive(), b !== !0 && (a && !this.timeline ? this._timeline.add(this, this._startTime - this._delay) : !a && this.timeline && this._timeline._remove(this, !0)), 
            !1;
        }, g._kill = function(a, b) {
            return this._enabled(!1, !1);
        }, g.kill = function(a, b) {
            return this._kill(a, b), this;
        }, g._uncache = function(a) {
            for (var b = a ? this : this.timeline; b; ) b._dirty = !0, b = b.timeline;
            return this;
        }, g._swapSelfInParams = function(a) {
            for (var b = a.length, c = a.concat(); --b > -1; ) "{self}" === a[b] && (c[b] = this);
            return c;
        }, g._callback = function(a) {
            var b = this.vars, c = b[a], d = b[a + "Params"], e = b[a + "Scope"] || b.callbackScope || this, f = d ? d.length : 0;
            switch (f) {
              case 0:
                c.call(e);
                break;

              case 1:
                c.call(e, d[0]);
                break;

              case 2:
                c.call(e, d[0], d[1]);
                break;

              default:
                c.apply(e, d);
            }
        }, g.eventCallback = function(a, b, c, d) {
            if ("on" === (a || "").substr(0, 2)) {
                var e = this.vars;
                if (1 === arguments.length) return e[a];
                null == b ? delete e[a] : (e[a] = b, e[a + "Params"] = o(c) && -1 !== c.join("").indexOf("{self}") ? this._swapSelfInParams(c) : c, 
                e[a + "Scope"] = d), "onUpdate" === a && (this._onUpdate = b);
            }
            return this;
        }, g.delay = function(a) {
            return arguments.length ? (this._timeline.smoothChildTiming && this.startTime(this._startTime + a - this._delay), 
            this._delay = a, this) : this._delay;
        }, g.duration = function(a) {
            return arguments.length ? (this._duration = this._totalDuration = a, this._uncache(!0), 
            this._timeline.smoothChildTiming && this._time > 0 && this._time < this._duration && 0 !== a && this.totalTime(this._totalTime * (a / this._duration), !0), 
            this) : (this._dirty = !1, this._duration);
        }, g.totalDuration = function(a) {
            return this._dirty = !1, arguments.length ? this.duration(a) : this._totalDuration;
        }, g.time = function(a, b) {
            return arguments.length ? (this._dirty && this.totalDuration(), this.totalTime(a > this._duration ? this._duration : a, b)) : this._time;
        }, g.totalTime = function(a, b, c) {
            if (i || h.wake(), !arguments.length) return this._totalTime;
            if (this._timeline) {
                if (0 > a && !c && (a += this.totalDuration()), this._timeline.smoothChildTiming) {
                    this._dirty && this.totalDuration();
                    var d = this._totalDuration, e = this._timeline;
                    if (a > d && !c && (a = d), this._startTime = (this._paused ? this._pauseTime : e._time) - (this._reversed ? d - a : a) / this._timeScale, 
                    e._dirty || this._uncache(!1), e._timeline) for (;e._timeline; ) e._timeline._time !== (e._startTime + e._totalTime) / e._timeScale && e.totalTime(e._totalTime, !0), 
                    e = e._timeline;
                }
                this._gc && this._enabled(!0, !1), (this._totalTime !== a || 0 === this._duration) && (I.length && X(), 
                this.render(a, b, !1), I.length && X());
            }
            return this;
        }, g.progress = g.totalProgress = function(a, b) {
            var c = this.duration();
            return arguments.length ? this.totalTime(c * a, b) : c ? this._time / c : this.ratio;
        }, g.startTime = function(a) {
            return arguments.length ? (a !== this._startTime && (this._startTime = a, this.timeline && this.timeline._sortChildren && this.timeline.add(this, a - this._delay)), 
            this) : this._startTime;
        }, g.endTime = function(a) {
            return this._startTime + (0 != a ? this.totalDuration() : this.duration()) / this._timeScale;
        }, g.timeScale = function(a) {
            if (!arguments.length) return this._timeScale;
            if (a = a || l, this._timeline && this._timeline.smoothChildTiming) {
                var b = this._pauseTime, c = b || 0 === b ? b : this._timeline.totalTime();
                this._startTime = c - (c - this._startTime) * this._timeScale / a;
            }
            return this._timeScale = a, this._uncache(!1);
        }, g.reversed = function(a) {
            return arguments.length ? (a != this._reversed && (this._reversed = a, this.totalTime(this._timeline && !this._timeline.smoothChildTiming ? this.totalDuration() - this._totalTime : this._totalTime, !0)), 
            this) : this._reversed;
        }, g.paused = function(a) {
            if (!arguments.length) return this._paused;
            var b, c, d = this._timeline;
            return a != this._paused && d && (i || a || h.wake(), b = d.rawTime(), c = b - this._pauseTime, 
            !a && d.smoothChildTiming && (this._startTime += c, this._uncache(!1)), this._pauseTime = a ? b : null, 
            this._paused = a, this._active = this.isActive(), !a && 0 !== c && this._initted && this.duration() && (b = d.smoothChildTiming ? this._totalTime : (b - this._startTime) / this._timeScale, 
            this.render(b, b === this._totalTime, !0))), this._gc && !a && this._enabled(!0, !1), 
            this;
        };
        var E = s("core.SimpleTimeline", function(a) {
            C.call(this, 0, a), this.autoRemoveChildren = this.smoothChildTiming = !0;
        });
        g = E.prototype = new C(), g.constructor = E, g.kill()._gc = !1, g._first = g._last = g._recent = null, 
        g._sortChildren = !1, g.add = g.insert = function(a, b, c, d) {
            var e, f;
            if (a._startTime = Number(b || 0) + a._delay, a._paused && this !== a._timeline && (a._pauseTime = a._startTime + (this.rawTime() - a._startTime) / a._timeScale), 
            a.timeline && a.timeline._remove(a, !0), a.timeline = a._timeline = this, a._gc && a._enabled(!0, !0), 
            e = this._last, this._sortChildren) for (f = a._startTime; e && e._startTime > f; ) e = e._prev;
            return e ? (a._next = e._next, e._next = a) : (a._next = this._first, this._first = a), 
            a._next ? a._next._prev = a : this._last = a, a._prev = e, this._recent = a, this._timeline && this._uncache(!0), 
            this;
        }, g._remove = function(a, b) {
            return a.timeline === this && (b || a._enabled(!1, !0), a._prev ? a._prev._next = a._next : this._first === a && (this._first = a._next), 
            a._next ? a._next._prev = a._prev : this._last === a && (this._last = a._prev), 
            a._next = a._prev = a.timeline = null, a === this._recent && (this._recent = this._last), 
            this._timeline && this._uncache(!0)), this;
        }, g.render = function(a, b, c) {
            var d, e = this._first;
            for (this._totalTime = this._time = this._rawPrevTime = a; e; ) d = e._next, (e._active || a >= e._startTime && !e._paused) && (e._reversed ? e.render((e._dirty ? e.totalDuration() : e._totalDuration) - (a - e._startTime) * e._timeScale, b, c) : e.render((a - e._startTime) * e._timeScale, b, c)), 
            e = d;
        }, g.rawTime = function() {
            return i || h.wake(), this._totalTime;
        };
        var F = s("TweenLite", function(b, c, d) {
            if (C.call(this, c, d), this.render = F.prototype.render, null == b) throw "Cannot tween a null target.";
            this.target = b = "string" != typeof b ? b : F.selector(b) || b;
            var e, f, g, h = b.jquery || b.length && b !== a && b[0] && (b[0] === a || b[0].nodeType && b[0].style && !b.nodeType), i = this.vars.overwrite;
            if (this._overwrite = i = null == i ? T[F.defaultOverwrite] : "number" == typeof i ? i >> 0 : T[i], 
            (h || b instanceof Array || b.push && o(b)) && "number" != typeof b[0]) for (this._targets = g = m(b), 
            this._propLookup = [], this._siblings = [], e = 0; e < g.length; e++) f = g[e], 
            f ? "string" != typeof f ? f.length && f !== a && f[0] && (f[0] === a || f[0].nodeType && f[0].style && !f.nodeType) ? (g.splice(e--, 1), 
            this._targets = g = g.concat(m(f))) : (this._siblings[e] = Y(f, this, !1), 1 === i && this._siblings[e].length > 1 && $(f, this, null, 1, this._siblings[e])) : (f = g[e--] = F.selector(f), 
            "string" == typeof f && g.splice(e + 1, 1)) : g.splice(e--, 1); else this._propLookup = {}, 
            this._siblings = Y(b, this, !1), 1 === i && this._siblings.length > 1 && $(b, this, null, 1, this._siblings);
            (this.vars.immediateRender || 0 === c && 0 === this._delay && this.vars.immediateRender !== !1) && (this._time = -l, 
            this.render(Math.min(0, -this._delay)));
        }, !0), G = function(b) {
            return b && b.length && b !== a && b[0] && (b[0] === a || b[0].nodeType && b[0].style && !b.nodeType);
        }, H = function(a, b) {
            var c, d = {};
            for (c in a) S[c] || c in b && "transform" !== c && "x" !== c && "y" !== c && "width" !== c && "height" !== c && "className" !== c && "border" !== c || !(!P[c] || P[c] && P[c]._autoCSS) || (d[c] = a[c], 
            delete a[c]);
            a.css = d;
        };
        g = F.prototype = new C(), g.constructor = F, g.kill()._gc = !1, g.ratio = 0, g._firstPT = g._targets = g._overwrittenProps = g._startAt = null, 
        g._notifyPluginsOfEnabled = g._lazy = !1, F.version = "1.19.0", F.defaultEase = g._ease = new u(null, null, 1, 1), 
        F.defaultOverwrite = "auto", F.ticker = h, F.autoSleep = 120, F.lagSmoothing = function(a, b) {
            h.lagSmoothing(a, b);
        }, F.selector = a.$ || a.jQuery || function(b) {
            var c = a.$ || a.jQuery;
            return c ? (F.selector = c, c(b)) : "undefined" == typeof document ? b : document.querySelectorAll ? document.querySelectorAll(b) : document.getElementById("#" === b.charAt(0) ? b.substr(1) : b);
        };
        var I = [], J = {}, K = /(?:(-|-=|\+=)?\d*\.?\d*(?:e[\-+]?\d+)?)[0-9]/gi, L = function(a) {
            for (var b, c = this._firstPT, d = 1e-6; c; ) b = c.blob ? a ? this.join("") : this.start : c.c * a + c.s, 
            c.m ? b = c.m(b, this._target || c.t) : d > b && b > -d && (b = 0), c.f ? c.fp ? c.t[c.p](c.fp, b) : c.t[c.p](b) : c.t[c.p] = b, 
            c = c._next;
        }, M = function(a, b, c, d) {
            var e, f, g, h, i, j, k, l = [ a, b ], m = 0, n = "", o = 0;
            for (l.start = a, c && (c(l), a = l[0], b = l[1]), l.length = 0, e = a.match(K) || [], 
            f = b.match(K) || [], d && (d._next = null, d.blob = 1, l._firstPT = l._applyPT = d), 
            i = f.length, h = 0; i > h; h++) k = f[h], j = b.substr(m, b.indexOf(k, m) - m), 
            n += j || !h ? j : ",", m += j.length, o ? o = (o + 1) % 5 : "rgba(" === j.substr(-5) && (o = 1), 
            k === e[h] || e.length <= h ? n += k : (n && (l.push(n), n = ""), g = parseFloat(e[h]), 
            l.push(g), l._firstPT = {
                _next: l._firstPT,
                t: l,
                p: l.length - 1,
                s: g,
                c: ("=" === k.charAt(1) ? parseInt(k.charAt(0) + "1", 10) * parseFloat(k.substr(2)) : parseFloat(k) - g) || 0,
                f: 0,
                m: o && 4 > o ? Math.round : 0
            }), m += k.length;
            return n += b.substr(m), n && l.push(n), l.setRatio = L, l;
        }, N = function(a, b, c, d, e, f, g, h, i) {
            "function" == typeof d && (d = d(i || 0, a));
            var j, k, l = "get" === c ? a[b] : c, m = typeof a[b], n = "string" == typeof d && "=" === d.charAt(1), o = {
                t: a,
                p: b,
                s: l,
                f: "function" === m,
                pg: 0,
                n: e || b,
                m: f ? "function" == typeof f ? f : Math.round : 0,
                pr: 0,
                c: n ? parseInt(d.charAt(0) + "1", 10) * parseFloat(d.substr(2)) : parseFloat(d) - l || 0
            };
            return "number" !== m && ("function" === m && "get" === c && (k = b.indexOf("set") || "function" != typeof a["get" + b.substr(3)] ? b : "get" + b.substr(3), 
            o.s = l = g ? a[k](g) : a[k]()), "string" == typeof l && (g || isNaN(l)) ? (o.fp = g, 
            j = M(l, d, h || F.defaultStringFilter, o), o = {
                t: j,
                p: "setRatio",
                s: 0,
                c: 1,
                f: 2,
                pg: 0,
                n: e || b,
                pr: 0,
                m: 0
            }) : n || (o.s = parseFloat(l), o.c = parseFloat(d) - o.s || 0)), o.c ? ((o._next = this._firstPT) && (o._next._prev = o), 
            this._firstPT = o, o) : void 0;
        }, O = F._internals = {
            isArray: o,
            isSelector: G,
            lazyTweens: I,
            blobDif: M
        }, P = F._plugins = {}, Q = O.tweenLookup = {}, R = 0, S = O.reservedProps = {
            ease: 1,
            delay: 1,
            overwrite: 1,
            onComplete: 1,
            onCompleteParams: 1,
            onCompleteScope: 1,
            useFrames: 1,
            runBackwards: 1,
            startAt: 1,
            onUpdate: 1,
            onUpdateParams: 1,
            onUpdateScope: 1,
            onStart: 1,
            onStartParams: 1,
            onStartScope: 1,
            onReverseComplete: 1,
            onReverseCompleteParams: 1,
            onReverseCompleteScope: 1,
            onRepeat: 1,
            onRepeatParams: 1,
            onRepeatScope: 1,
            easeParams: 1,
            yoyo: 1,
            immediateRender: 1,
            repeat: 1,
            repeatDelay: 1,
            data: 1,
            paused: 1,
            reversed: 1,
            autoCSS: 1,
            lazy: 1,
            onOverwrite: 1,
            callbackScope: 1,
            stringFilter: 1,
            id: 1
        }, T = {
            none: 0,
            all: 1,
            auto: 2,
            concurrent: 3,
            allOnStart: 4,
            preexisting: 5,
            true: 1,
            false: 0
        }, U = C._rootFramesTimeline = new E(), V = C._rootTimeline = new E(), W = 30, X = O.lazyRender = function() {
            var a, b = I.length;
            for (J = {}; --b > -1; ) a = I[b], a && a._lazy !== !1 && (a.render(a._lazy[0], a._lazy[1], !0), 
            a._lazy = !1);
            I.length = 0;
        };
        V._startTime = h.time, U._startTime = h.frame, V._active = U._active = !0, setTimeout(X, 1), 
        C._updateRoot = F.render = function() {
            var a, b, c;
            if (I.length && X(), V.render((h.time - V._startTime) * V._timeScale, !1, !1), U.render((h.frame - U._startTime) * U._timeScale, !1, !1), 
            I.length && X(), h.frame >= W) {
                W = h.frame + (parseInt(F.autoSleep, 10) || 120);
                for (c in Q) {
                    for (b = Q[c].tweens, a = b.length; --a > -1; ) b[a]._gc && b.splice(a, 1);
                    0 === b.length && delete Q[c];
                }
                if (c = V._first, (!c || c._paused) && F.autoSleep && !U._first && 1 === h._listeners.tick.length) {
                    for (;c && c._paused; ) c = c._next;
                    c || h.sleep();
                }
            }
        }, h.addEventListener("tick", C._updateRoot);
        var Y = function(a, b, c) {
            var d, e, f = a._gsTweenID;
            if (Q[f || (a._gsTweenID = f = "t" + R++)] || (Q[f] = {
                target: a,
                tweens: []
            }), b && (d = Q[f].tweens, d[e = d.length] = b, c)) for (;--e > -1; ) d[e] === b && d.splice(e, 1);
            return Q[f].tweens;
        }, Z = function(a, b, c, d) {
            var e, f, g = a.vars.onOverwrite;
            return g && (e = g(a, b, c, d)), g = F.onOverwrite, g && (f = g(a, b, c, d)), e !== !1 && f !== !1;
        }, $ = function(a, b, c, d, e) {
            var f, g, h, i;
            if (1 === d || d >= 4) {
                for (i = e.length, f = 0; i > f; f++) if ((h = e[f]) !== b) h._gc || h._kill(null, a, b) && (g = !0); else if (5 === d) break;
                return g;
            }
            var j, k = b._startTime + l, m = [], n = 0, o = 0 === b._duration;
            for (f = e.length; --f > -1; ) (h = e[f]) === b || h._gc || h._paused || (h._timeline !== b._timeline ? (j = j || _(b, 0, o), 
            0 === _(h, j, o) && (m[n++] = h)) : h._startTime <= k && h._startTime + h.totalDuration() / h._timeScale > k && ((o || !h._initted) && k - h._startTime <= 2e-10 || (m[n++] = h)));
            for (f = n; --f > -1; ) if (h = m[f], 2 === d && h._kill(c, a, b) && (g = !0), 2 !== d || !h._firstPT && h._initted) {
                if (2 !== d && !Z(h, b)) continue;
                h._enabled(!1, !1) && (g = !0);
            }
            return g;
        }, _ = function(a, b, c) {
            for (var d = a._timeline, e = d._timeScale, f = a._startTime; d._timeline; ) {
                if (f += d._startTime, e *= d._timeScale, d._paused) return -100;
                d = d._timeline;
            }
            return f /= e, f > b ? f - b : c && f === b || !a._initted && 2 * l > f - b ? l : (f += a.totalDuration() / a._timeScale / e) > b + l ? 0 : f - b - l;
        };
        g._init = function() {
            var a, b, c, d, e, f, g = this.vars, h = this._overwrittenProps, i = this._duration, j = !!g.immediateRender, k = g.ease;
            if (g.startAt) {
                this._startAt && (this._startAt.render(-1, !0), this._startAt.kill()), e = {};
                for (d in g.startAt) e[d] = g.startAt[d];
                if (e.overwrite = !1, e.immediateRender = !0, e.lazy = j && g.lazy !== !1, e.startAt = e.delay = null, 
                this._startAt = F.to(this.target, 0, e), j) if (this._time > 0) this._startAt = null; else if (0 !== i) return;
            } else if (g.runBackwards && 0 !== i) if (this._startAt) this._startAt.render(-1, !0), 
            this._startAt.kill(), this._startAt = null; else {
                0 !== this._time && (j = !1), c = {};
                for (d in g) S[d] && "autoCSS" !== d || (c[d] = g[d]);
                if (c.overwrite = 0, c.data = "isFromStart", c.lazy = j && g.lazy !== !1, c.immediateRender = j, 
                this._startAt = F.to(this.target, 0, c), j) {
                    if (0 === this._time) return;
                } else this._startAt._init(), this._startAt._enabled(!1), this.vars.immediateRender && (this._startAt = null);
            }
            if (this._ease = k = k ? k instanceof u ? k : "function" == typeof k ? new u(k, g.easeParams) : v[k] || F.defaultEase : F.defaultEase, 
            g.easeParams instanceof Array && k.config && (this._ease = k.config.apply(k, g.easeParams)), 
            this._easeType = this._ease._type, this._easePower = this._ease._power, this._firstPT = null, 
            this._targets) for (f = this._targets.length, a = 0; f > a; a++) this._initProps(this._targets[a], this._propLookup[a] = {}, this._siblings[a], h ? h[a] : null, a) && (b = !0); else b = this._initProps(this.target, this._propLookup, this._siblings, h, 0);
            if (b && F._onPluginEvent("_onInitAllProps", this), h && (this._firstPT || "function" != typeof this.target && this._enabled(!1, !1)), 
            g.runBackwards) for (c = this._firstPT; c; ) c.s += c.c, c.c = -c.c, c = c._next;
            this._onUpdate = g.onUpdate, this._initted = !0;
        }, g._initProps = function(b, c, d, e, f) {
            var g, h, i, j, k, l;
            if (null == b) return !1;
            J[b._gsTweenID] && X(), this.vars.css || b.style && b !== a && b.nodeType && P.css && this.vars.autoCSS !== !1 && H(this.vars, b);
            for (g in this.vars) if (l = this.vars[g], S[g]) l && (l instanceof Array || l.push && o(l)) && -1 !== l.join("").indexOf("{self}") && (this.vars[g] = l = this._swapSelfInParams(l, this)); else if (P[g] && (j = new P[g]())._onInitTween(b, this.vars[g], this, f)) {
                for (this._firstPT = k = {
                    _next: this._firstPT,
                    t: j,
                    p: "setRatio",
                    s: 0,
                    c: 1,
                    f: 1,
                    n: g,
                    pg: 1,
                    pr: j._priority,
                    m: 0
                }, h = j._overwriteProps.length; --h > -1; ) c[j._overwriteProps[h]] = this._firstPT;
                (j._priority || j._onInitAllProps) && (i = !0), (j._onDisable || j._onEnable) && (this._notifyPluginsOfEnabled = !0), 
                k._next && (k._next._prev = k);
            } else c[g] = N.call(this, b, g, "get", l, g, 0, null, this.vars.stringFilter, f);
            return e && this._kill(e, b) ? this._initProps(b, c, d, e, f) : this._overwrite > 1 && this._firstPT && d.length > 1 && $(b, this, c, this._overwrite, d) ? (this._kill(c, b), 
            this._initProps(b, c, d, e, f)) : (this._firstPT && (this.vars.lazy !== !1 && this._duration || this.vars.lazy && !this._duration) && (J[b._gsTweenID] = !0), 
            i);
        }, g.render = function(a, b, c) {
            var d, e, f, g, h = this._time, i = this._duration, j = this._rawPrevTime;
            if (a >= i - 1e-7) this._totalTime = this._time = i, this.ratio = this._ease._calcEnd ? this._ease.getRatio(1) : 1, 
            this._reversed || (d = !0, e = "onComplete", c = c || this._timeline.autoRemoveChildren), 
            0 === i && (this._initted || !this.vars.lazy || c) && (this._startTime === this._timeline._duration && (a = 0), 
            (0 > j || 0 >= a && a >= -1e-7 || j === l && "isPause" !== this.data) && j !== a && (c = !0, 
            j > l && (e = "onReverseComplete")), this._rawPrevTime = g = !b || a || j === a ? a : l); else if (1e-7 > a) this._totalTime = this._time = 0, 
            this.ratio = this._ease._calcEnd ? this._ease.getRatio(0) : 0, (0 !== h || 0 === i && j > 0) && (e = "onReverseComplete", 
            d = this._reversed), 0 > a && (this._active = !1, 0 === i && (this._initted || !this.vars.lazy || c) && (j >= 0 && (j !== l || "isPause" !== this.data) && (c = !0), 
            this._rawPrevTime = g = !b || a || j === a ? a : l)), this._initted || (c = !0); else if (this._totalTime = this._time = a, 
            this._easeType) {
                var k = a / i, m = this._easeType, n = this._easePower;
                (1 === m || 3 === m && k >= .5) && (k = 1 - k), 3 === m && (k *= 2), 1 === n ? k *= k : 2 === n ? k *= k * k : 3 === n ? k *= k * k * k : 4 === n && (k *= k * k * k * k), 
                1 === m ? this.ratio = 1 - k : 2 === m ? this.ratio = k : .5 > a / i ? this.ratio = k / 2 : this.ratio = 1 - k / 2;
            } else this.ratio = this._ease.getRatio(a / i);
            if (this._time !== h || c) {
                if (!this._initted) {
                    if (this._init(), !this._initted || this._gc) return;
                    if (!c && this._firstPT && (this.vars.lazy !== !1 && this._duration || this.vars.lazy && !this._duration)) return this._time = this._totalTime = h, 
                    this._rawPrevTime = j, I.push(this), void (this._lazy = [ a, b ]);
                    this._time && !d ? this.ratio = this._ease.getRatio(this._time / i) : d && this._ease._calcEnd && (this.ratio = this._ease.getRatio(0 === this._time ? 0 : 1));
                }
                for (this._lazy !== !1 && (this._lazy = !1), this._active || !this._paused && this._time !== h && a >= 0 && (this._active = !0), 
                0 === h && (this._startAt && (a >= 0 ? this._startAt.render(a, b, c) : e || (e = "_dummyGS")), 
                this.vars.onStart && (0 !== this._time || 0 === i) && (b || this._callback("onStart"))), 
                f = this._firstPT; f; ) f.f ? f.t[f.p](f.c * this.ratio + f.s) : f.t[f.p] = f.c * this.ratio + f.s, 
                f = f._next;
                this._onUpdate && (0 > a && this._startAt && a !== -1e-4 && this._startAt.render(a, b, c), 
                b || (this._time !== h || d || c) && this._callback("onUpdate")), e && (!this._gc || c) && (0 > a && this._startAt && !this._onUpdate && a !== -1e-4 && this._startAt.render(a, b, c), 
                d && (this._timeline.autoRemoveChildren && this._enabled(!1, !1), this._active = !1), 
                !b && this.vars[e] && this._callback(e), 0 === i && this._rawPrevTime === l && g !== l && (this._rawPrevTime = 0));
            }
        }, g._kill = function(a, b, c) {
            if ("all" === a && (a = null), null == a && (null == b || b === this.target)) return this._lazy = !1, 
            this._enabled(!1, !1);
            b = "string" != typeof b ? b || this._targets || this.target : F.selector(b) || b;
            var d, e, f, g, h, i, j, k, l, m = c && this._time && c._startTime === this._startTime && this._timeline === c._timeline;
            if ((o(b) || G(b)) && "number" != typeof b[0]) for (d = b.length; --d > -1; ) this._kill(a, b[d], c) && (i = !0); else {
                if (this._targets) {
                    for (d = this._targets.length; --d > -1; ) if (b === this._targets[d]) {
                        h = this._propLookup[d] || {}, this._overwrittenProps = this._overwrittenProps || [], 
                        e = this._overwrittenProps[d] = a ? this._overwrittenProps[d] || {} : "all";
                        break;
                    }
                } else {
                    if (b !== this.target) return !1;
                    h = this._propLookup, e = this._overwrittenProps = a ? this._overwrittenProps || {} : "all";
                }
                if (h) {
                    if (j = a || h, k = a !== e && "all" !== e && a !== h && ("object" != typeof a || !a._tempKill), 
                    c && (F.onOverwrite || this.vars.onOverwrite)) {
                        for (f in j) h[f] && (l || (l = []), l.push(f));
                        if ((l || !a) && !Z(this, c, b, l)) return !1;
                    }
                    for (f in j) (g = h[f]) && (m && (g.f ? g.t[g.p](g.s) : g.t[g.p] = g.s, i = !0), 
                    g.pg && g.t._kill(j) && (i = !0), g.pg && 0 !== g.t._overwriteProps.length || (g._prev ? g._prev._next = g._next : g === this._firstPT && (this._firstPT = g._next), 
                    g._next && (g._next._prev = g._prev), g._next = g._prev = null), delete h[f]), k && (e[f] = 1);
                    !this._firstPT && this._initted && this._enabled(!1, !1);
                }
            }
            return i;
        }, g.invalidate = function() {
            return this._notifyPluginsOfEnabled && F._onPluginEvent("_onDisable", this), this._firstPT = this._overwrittenProps = this._startAt = this._onUpdate = null, 
            this._notifyPluginsOfEnabled = this._active = this._lazy = !1, this._propLookup = this._targets ? {} : [], 
            C.prototype.invalidate.call(this), this.vars.immediateRender && (this._time = -l, 
            this.render(Math.min(0, -this._delay))), this;
        }, g._enabled = function(a, b) {
            if (i || h.wake(), a && this._gc) {
                var c, d = this._targets;
                if (d) for (c = d.length; --c > -1; ) this._siblings[c] = Y(d[c], this, !0); else this._siblings = Y(this.target, this, !0);
            }
            return C.prototype._enabled.call(this, a, b), this._notifyPluginsOfEnabled && this._firstPT ? F._onPluginEvent(a ? "_onEnable" : "_onDisable", this) : !1;
        }, F.to = function(a, b, c) {
            return new F(a, b, c);
        }, F.from = function(a, b, c) {
            return c.runBackwards = !0, c.immediateRender = 0 != c.immediateRender, new F(a, b, c);
        }, F.fromTo = function(a, b, c, d) {
            return d.startAt = c, d.immediateRender = 0 != d.immediateRender && 0 != c.immediateRender, 
            new F(a, b, d);
        }, F.delayedCall = function(a, b, c, d, e) {
            return new F(b, 0, {
                delay: a,
                onComplete: b,
                onCompleteParams: c,
                callbackScope: d,
                onReverseComplete: b,
                onReverseCompleteParams: c,
                immediateRender: !1,
                lazy: !1,
                useFrames: e,
                overwrite: 0
            });
        }, F.set = function(a, b) {
            return new F(a, 0, b);
        }, F.getTweensOf = function(a, b) {
            if (null == a) return [];
            a = "string" != typeof a ? a : F.selector(a) || a;
            var c, d, e, f;
            if ((o(a) || G(a)) && "number" != typeof a[0]) {
                for (c = a.length, d = []; --c > -1; ) d = d.concat(F.getTweensOf(a[c], b));
                for (c = d.length; --c > -1; ) for (f = d[c], e = c; --e > -1; ) f === d[e] && d.splice(c, 1);
            } else for (d = Y(a).concat(), c = d.length; --c > -1; ) (d[c]._gc || b && !d[c].isActive()) && d.splice(c, 1);
            return d;
        }, F.killTweensOf = F.killDelayedCallsTo = function(a, b, c) {
            "object" == typeof b && (c = b, b = !1);
            for (var d = F.getTweensOf(a, b), e = d.length; --e > -1; ) d[e]._kill(c, a);
        };
        var aa = s("plugins.TweenPlugin", function(a, b) {
            this._overwriteProps = (a || "").split(","), this._propName = this._overwriteProps[0], 
            this._priority = b || 0, this._super = aa.prototype;
        }, !0);
        if (g = aa.prototype, aa.version = "1.19.0", aa.API = 2, g._firstPT = null, g._addTween = N, 
        g.setRatio = L, g._kill = function(a) {
            var b, c = this._overwriteProps, d = this._firstPT;
            if (null != a[this._propName]) this._overwriteProps = []; else for (b = c.length; --b > -1; ) null != a[c[b]] && c.splice(b, 1);
            for (;d; ) null != a[d.n] && (d._next && (d._next._prev = d._prev), d._prev ? (d._prev._next = d._next, 
            d._prev = null) : this._firstPT === d && (this._firstPT = d._next)), d = d._next;
            return !1;
        }, g._mod = g._roundProps = function(a) {
            for (var b, c = this._firstPT; c; ) b = a[this._propName] || null != c.n && a[c.n.split(this._propName + "_").join("")], 
            b && "function" == typeof b && (2 === c.f ? c.t._applyPT.m = b : c.m = b), c = c._next;
        }, F._onPluginEvent = function(a, b) {
            var c, d, e, f, g, h = b._firstPT;
            if ("_onInitAllProps" === a) {
                for (;h; ) {
                    for (g = h._next, d = e; d && d.pr > h.pr; ) d = d._next;
                    (h._prev = d ? d._prev : f) ? h._prev._next = h : e = h, (h._next = d) ? d._prev = h : f = h, 
                    h = g;
                }
                h = b._firstPT = e;
            }
            for (;h; ) h.pg && "function" == typeof h.t[a] && h.t[a]() && (c = !0), h = h._next;
            return c;
        }, aa.activate = function(a) {
            for (var b = a.length; --b > -1; ) a[b].API === aa.API && (P[new a[b]()._propName] = a[b]);
            return !0;
        }, r.plugin = function(a) {
            if (!(a && a.propName && a.init && a.API)) throw "illegal plugin definition.";
            var b, c = a.propName, d = a.priority || 0, e = a.overwriteProps, f = {
                init: "_onInitTween",
                set: "setRatio",
                kill: "_kill",
                round: "_mod",
                mod: "_mod",
                initAll: "_onInitAllProps"
            }, g = s("plugins." + c.charAt(0).toUpperCase() + c.substr(1) + "Plugin", function() {
                aa.call(this, c, d), this._overwriteProps = e || [];
            }, a.global === !0), h = g.prototype = new aa(c);
            h.constructor = g, g.API = a.API;
            for (b in f) "function" == typeof a[b] && (h[f[b]] = a[b]);
            return g.version = a.version, aa.activate([ g ]), g;
        }, e = a._gsQueue) {
            for (f = 0; f < e.length; f++) e[f]();
            for (g in p) p[g].func || a.console.log("GSAP encountered missing dependency: " + g);
        }
        i = !1;
    }
}("undefined" != typeof module && module.exports && "undefined" != typeof global ? global : this || window, "TweenMax");

/*!
 * VERSION: 1.18.6
 * DATE: 2016-07-12
 * UPDATES AND DOCS AT: http://greensock.com
 *
 * @license Copyright (c) 2008-2016, GreenSock. All rights reserved.
 * This work is subject to the terms at http://greensock.com/standard-license or for
 * Club GreenSock members, the software agreement that was issued with your membership.
 * 
 * @author: Jack Doyle, jack@greensock.com
 */
var _gsScope = "undefined" != typeof module && module.exports && "undefined" != typeof global ? global : this || window;

(_gsScope._gsQueue || (_gsScope._gsQueue = [])).push(function() {
    "use strict";
    _gsScope._gsDefine("TimelineMax", [ "TimelineLite", "TweenLite", "easing.Ease" ], function(a, b, c) {
        var d = function(b) {
            a.call(this, b), this._repeat = this.vars.repeat || 0, this._repeatDelay = this.vars.repeatDelay || 0, 
            this._cycle = 0, this._yoyo = this.vars.yoyo === !0, this._dirty = !0;
        }, e = 1e-10, f = b._internals, g = f.lazyTweens, h = f.lazyRender, i = _gsScope._gsDefine.globals, j = new c(null, null, 1, 0), k = d.prototype = new a();
        return k.constructor = d, k.kill()._gc = !1, d.version = "1.19.0", k.invalidate = function() {
            return this._yoyo = this.vars.yoyo === !0, this._repeat = this.vars.repeat || 0, 
            this._repeatDelay = this.vars.repeatDelay || 0, this._uncache(!0), a.prototype.invalidate.call(this);
        }, k.addCallback = function(a, c, d, e) {
            return this.add(b.delayedCall(0, a, d, e), c);
        }, k.removeCallback = function(a, b) {
            if (a) if (null == b) this._kill(null, a); else for (var c = this.getTweensOf(a, !1), d = c.length, e = this._parseTimeOrLabel(b); --d > -1; ) c[d]._startTime === e && c[d]._enabled(!1, !1);
            return this;
        }, k.removePause = function(b) {
            return this.removeCallback(a._internals.pauseCallback, b);
        }, k.tweenTo = function(a, c) {
            c = c || {};
            var d, e, f, g = {
                ease: j,
                useFrames: this.usesFrames(),
                immediateRender: !1
            }, h = c.repeat && i.TweenMax || b;
            for (e in c) g[e] = c[e];
            return g.time = this._parseTimeOrLabel(a), d = Math.abs(Number(g.time) - this._time) / this._timeScale || .001, 
            f = new h(this, d, g), g.onStart = function() {
                f.target.paused(!0), f.vars.time !== f.target.time() && d === f.duration() && f.duration(Math.abs(f.vars.time - f.target.time()) / f.target._timeScale), 
                c.onStart && f._callback("onStart");
            }, f;
        }, k.tweenFromTo = function(a, b, c) {
            c = c || {}, a = this._parseTimeOrLabel(a), c.startAt = {
                onComplete: this.seek,
                onCompleteParams: [ a ],
                callbackScope: this
            }, c.immediateRender = c.immediateRender !== !1;
            var d = this.tweenTo(b, c);
            return d.duration(Math.abs(d.vars.time - a) / this._timeScale || .001);
        }, k.render = function(a, b, c) {
            this._gc && this._enabled(!0, !1);
            var d, f, i, j, k, l, m, n, o = this._dirty ? this.totalDuration() : this._totalDuration, p = this._duration, q = this._time, r = this._totalTime, s = this._startTime, t = this._timeScale, u = this._rawPrevTime, v = this._paused, w = this._cycle;
            if (a >= o - 1e-7) this._locked || (this._totalTime = o, this._cycle = this._repeat), 
            this._reversed || this._hasPausedChild() || (f = !0, j = "onComplete", k = !!this._timeline.autoRemoveChildren, 
            0 === this._duration && (0 >= a && a >= -1e-7 || 0 > u || u === e) && u !== a && this._first && (k = !0, 
            u > e && (j = "onReverseComplete"))), this._rawPrevTime = this._duration || !b || a || this._rawPrevTime === a ? a : e, 
            this._yoyo && 0 !== (1 & this._cycle) ? this._time = a = 0 : (this._time = p, a = p + 1e-4); else if (1e-7 > a) if (this._locked || (this._totalTime = this._cycle = 0), 
            this._time = 0, (0 !== q || 0 === p && u !== e && (u > 0 || 0 > a && u >= 0) && !this._locked) && (j = "onReverseComplete", 
            f = this._reversed), 0 > a) this._active = !1, this._timeline.autoRemoveChildren && this._reversed ? (k = f = !0, 
            j = "onReverseComplete") : u >= 0 && this._first && (k = !0), this._rawPrevTime = a; else {
                if (this._rawPrevTime = p || !b || a || this._rawPrevTime === a ? a : e, 0 === a && f) for (d = this._first; d && 0 === d._startTime; ) d._duration || (f = !1), 
                d = d._next;
                a = 0, this._initted || (k = !0);
            } else if (0 === p && 0 > u && (k = !0), this._time = this._rawPrevTime = a, this._locked || (this._totalTime = a, 
            0 !== this._repeat && (l = p + this._repeatDelay, this._cycle = this._totalTime / l >> 0, 
            0 !== this._cycle && this._cycle === this._totalTime / l && a >= r && this._cycle--, 
            this._time = this._totalTime - this._cycle * l, this._yoyo && 0 !== (1 & this._cycle) && (this._time = p - this._time), 
            this._time > p ? (this._time = p, a = p + 1e-4) : this._time < 0 ? this._time = a = 0 : a = this._time)), 
            this._hasPause && !this._forcingPlayhead && !b) {
                if (a = this._time, a >= q) for (d = this._first; d && d._startTime <= a && !m; ) d._duration || "isPause" !== d.data || d.ratio || 0 === d._startTime && 0 === this._rawPrevTime || (m = d), 
                d = d._next; else for (d = this._last; d && d._startTime >= a && !m; ) d._duration || "isPause" === d.data && d._rawPrevTime > 0 && (m = d), 
                d = d._prev;
                m && (this._time = a = m._startTime, this._totalTime = a + this._cycle * (this._totalDuration + this._repeatDelay));
            }
            if (this._cycle !== w && !this._locked) {
                var x = this._yoyo && 0 !== (1 & w), y = x === (this._yoyo && 0 !== (1 & this._cycle)), z = this._totalTime, A = this._cycle, B = this._rawPrevTime, C = this._time;
                if (this._totalTime = w * p, this._cycle < w ? x = !x : this._totalTime += p, this._time = q, 
                this._rawPrevTime = 0 === p ? u - 1e-4 : u, this._cycle = w, this._locked = !0, 
                q = x ? 0 : p, this.render(q, b, 0 === p), b || this._gc || this.vars.onRepeat && this._callback("onRepeat"), 
                q !== this._time) return;
                if (y && (q = x ? p + 1e-4 : -1e-4, this.render(q, !0, !1)), this._locked = !1, 
                this._paused && !v) return;
                this._time = C, this._totalTime = z, this._cycle = A, this._rawPrevTime = B;
            }
            if (!(this._time !== q && this._first || c || k || m)) return void (r !== this._totalTime && this._onUpdate && (b || this._callback("onUpdate")));
            if (this._initted || (this._initted = !0), this._active || !this._paused && this._totalTime !== r && a > 0 && (this._active = !0), 
            0 === r && this.vars.onStart && (0 === this._totalTime && this._totalDuration || b || this._callback("onStart")), 
            n = this._time, n >= q) for (d = this._first; d && (i = d._next, n === this._time && (!this._paused || v)); ) (d._active || d._startTime <= this._time && !d._paused && !d._gc) && (m === d && this.pause(), 
            d._reversed ? d.render((d._dirty ? d.totalDuration() : d._totalDuration) - (a - d._startTime) * d._timeScale, b, c) : d.render((a - d._startTime) * d._timeScale, b, c)), 
            d = i; else for (d = this._last; d && (i = d._prev, n === this._time && (!this._paused || v)); ) {
                if (d._active || d._startTime <= q && !d._paused && !d._gc) {
                    if (m === d) {
                        for (m = d._prev; m && m.endTime() > this._time; ) m.render(m._reversed ? m.totalDuration() - (a - m._startTime) * m._timeScale : (a - m._startTime) * m._timeScale, b, c), 
                        m = m._prev;
                        m = null, this.pause();
                    }
                    d._reversed ? d.render((d._dirty ? d.totalDuration() : d._totalDuration) - (a - d._startTime) * d._timeScale, b, c) : d.render((a - d._startTime) * d._timeScale, b, c);
                }
                d = i;
            }
            this._onUpdate && (b || (g.length && h(), this._callback("onUpdate"))), j && (this._locked || this._gc || (s === this._startTime || t !== this._timeScale) && (0 === this._time || o >= this.totalDuration()) && (f && (g.length && h(), 
            this._timeline.autoRemoveChildren && this._enabled(!1, !1), this._active = !1), 
            !b && this.vars[j] && this._callback(j)));
        }, k.getActive = function(a, b, c) {
            null == a && (a = !0), null == b && (b = !0), null == c && (c = !1);
            var d, e, f = [], g = this.getChildren(a, b, c), h = 0, i = g.length;
            for (d = 0; i > d; d++) e = g[d], e.isActive() && (f[h++] = e);
            return f;
        }, k.getLabelAfter = function(a) {
            a || 0 !== a && (a = this._time);
            var b, c = this.getLabelsArray(), d = c.length;
            for (b = 0; d > b; b++) if (c[b].time > a) return c[b].name;
            return null;
        }, k.getLabelBefore = function(a) {
            null == a && (a = this._time);
            for (var b = this.getLabelsArray(), c = b.length; --c > -1; ) if (b[c].time < a) return b[c].name;
            return null;
        }, k.getLabelsArray = function() {
            var a, b = [], c = 0;
            for (a in this._labels) b[c++] = {
                time: this._labels[a],
                name: a
            };
            return b.sort(function(a, b) {
                return a.time - b.time;
            }), b;
        }, k.progress = function(a, b) {
            return arguments.length ? this.totalTime(this.duration() * (this._yoyo && 0 !== (1 & this._cycle) ? 1 - a : a) + this._cycle * (this._duration + this._repeatDelay), b) : this._time / this.duration();
        }, k.totalProgress = function(a, b) {
            return arguments.length ? this.totalTime(this.totalDuration() * a, b) : this._totalTime / this.totalDuration();
        }, k.totalDuration = function(b) {
            return arguments.length ? -1 !== this._repeat && b ? this.timeScale(this.totalDuration() / b) : this : (this._dirty && (a.prototype.totalDuration.call(this), 
            this._totalDuration = -1 === this._repeat ? 999999999999 : this._duration * (this._repeat + 1) + this._repeatDelay * this._repeat), 
            this._totalDuration);
        }, k.time = function(a, b) {
            return arguments.length ? (this._dirty && this.totalDuration(), a > this._duration && (a = this._duration), 
            this._yoyo && 0 !== (1 & this._cycle) ? a = this._duration - a + this._cycle * (this._duration + this._repeatDelay) : 0 !== this._repeat && (a += this._cycle * (this._duration + this._repeatDelay)), 
            this.totalTime(a, b)) : this._time;
        }, k.repeat = function(a) {
            return arguments.length ? (this._repeat = a, this._uncache(!0)) : this._repeat;
        }, k.repeatDelay = function(a) {
            return arguments.length ? (this._repeatDelay = a, this._uncache(!0)) : this._repeatDelay;
        }, k.yoyo = function(a) {
            return arguments.length ? (this._yoyo = a, this) : this._yoyo;
        }, k.currentLabel = function(a) {
            return arguments.length ? this.seek(a, !0) : this.getLabelBefore(this._time + 1e-8);
        }, d;
    }, !0), _gsScope._gsDefine("TimelineLite", [ "core.Animation", "core.SimpleTimeline", "TweenLite" ], function(a, b, c) {
        var d = function(a) {
            b.call(this, a), this._labels = {}, this.autoRemoveChildren = this.vars.autoRemoveChildren === !0, 
            this.smoothChildTiming = this.vars.smoothChildTiming === !0, this._sortChildren = !0, 
            this._onUpdate = this.vars.onUpdate;
            var c, d, e = this.vars;
            for (d in e) c = e[d], i(c) && -1 !== c.join("").indexOf("{self}") && (e[d] = this._swapSelfInParams(c));
            i(e.tweens) && this.add(e.tweens, 0, e.align, e.stagger);
        }, e = 1e-10, f = c._internals, g = d._internals = {}, h = f.isSelector, i = f.isArray, j = f.lazyTweens, k = f.lazyRender, l = _gsScope._gsDefine.globals, m = function(a) {
            var b, c = {};
            for (b in a) c[b] = a[b];
            return c;
        }, n = function(a, b, c) {
            var d, e, f = a.cycle;
            for (d in f) e = f[d], a[d] = "function" == typeof e ? e.call(b[c], c) : e[c % e.length];
            delete a.cycle;
        }, o = g.pauseCallback = function() {}, p = function(a) {
            var b, c = [], d = a.length;
            for (b = 0; b !== d; c.push(a[b++])) ;
            return c;
        }, q = d.prototype = new b();
        return d.version = "1.19.0", q.constructor = d, q.kill()._gc = q._forcingPlayhead = q._hasPause = !1, 
        q.to = function(a, b, d, e) {
            var f = d.repeat && l.TweenMax || c;
            return b ? this.add(new f(a, b, d), e) : this.set(a, d, e);
        }, q.from = function(a, b, d, e) {
            return this.add((d.repeat && l.TweenMax || c).from(a, b, d), e);
        }, q.fromTo = function(a, b, d, e, f) {
            var g = e.repeat && l.TweenMax || c;
            return b ? this.add(g.fromTo(a, b, d, e), f) : this.set(a, e, f);
        }, q.staggerTo = function(a, b, e, f, g, i, j, k) {
            var l, o, q = new d({
                onComplete: i,
                onCompleteParams: j,
                callbackScope: k,
                smoothChildTiming: this.smoothChildTiming
            }), r = e.cycle;
            for ("string" == typeof a && (a = c.selector(a) || a), a = a || [], h(a) && (a = p(a)), 
            f = f || 0, 0 > f && (a = p(a), a.reverse(), f *= -1), o = 0; o < a.length; o++) l = m(e), 
            l.startAt && (l.startAt = m(l.startAt), l.startAt.cycle && n(l.startAt, a, o)), 
            r && (n(l, a, o), null != l.duration && (b = l.duration, delete l.duration)), q.to(a[o], b, l, o * f);
            return this.add(q, g);
        }, q.staggerFrom = function(a, b, c, d, e, f, g, h) {
            return c.immediateRender = 0 != c.immediateRender, c.runBackwards = !0, this.staggerTo(a, b, c, d, e, f, g, h);
        }, q.staggerFromTo = function(a, b, c, d, e, f, g, h, i) {
            return d.startAt = c, d.immediateRender = 0 != d.immediateRender && 0 != c.immediateRender, 
            this.staggerTo(a, b, d, e, f, g, h, i);
        }, q.call = function(a, b, d, e) {
            return this.add(c.delayedCall(0, a, b, d), e);
        }, q.set = function(a, b, d) {
            return d = this._parseTimeOrLabel(d, 0, !0), null == b.immediateRender && (b.immediateRender = d === this._time && !this._paused), 
            this.add(new c(a, 0, b), d);
        }, d.exportRoot = function(a, b) {
            a = a || {}, null == a.smoothChildTiming && (a.smoothChildTiming = !0);
            var e, f, g = new d(a), h = g._timeline;
            for (null == b && (b = !0), h._remove(g, !0), g._startTime = 0, g._rawPrevTime = g._time = g._totalTime = h._time, 
            e = h._first; e; ) f = e._next, b && e instanceof c && e.target === e.vars.onComplete || g.add(e, e._startTime - e._delay), 
            e = f;
            return h.add(g, 0), g;
        }, q.add = function(e, f, g, h) {
            var j, k, l, m, n, o;
            if ("number" != typeof f && (f = this._parseTimeOrLabel(f, 0, !0, e)), !(e instanceof a)) {
                if (e instanceof Array || e && e.push && i(e)) {
                    for (g = g || "normal", h = h || 0, j = f, k = e.length, l = 0; k > l; l++) i(m = e[l]) && (m = new d({
                        tweens: m
                    })), this.add(m, j), "string" != typeof m && "function" != typeof m && ("sequence" === g ? j = m._startTime + m.totalDuration() / m._timeScale : "start" === g && (m._startTime -= m.delay())), 
                    j += h;
                    return this._uncache(!0);
                }
                if ("string" == typeof e) return this.addLabel(e, f);
                if ("function" != typeof e) throw "Cannot add " + e + " into the timeline; it is not a tween, timeline, function, or string.";
                e = c.delayedCall(0, e);
            }
            if (b.prototype.add.call(this, e, f), (this._gc || this._time === this._duration) && !this._paused && this._duration < this.duration()) for (n = this, 
            o = n.rawTime() > e._startTime; n._timeline; ) o && n._timeline.smoothChildTiming ? n.totalTime(n._totalTime, !0) : n._gc && n._enabled(!0, !1), 
            n = n._timeline;
            return this;
        }, q.remove = function(b) {
            if (b instanceof a) {
                this._remove(b, !1);
                var c = b._timeline = b.vars.useFrames ? a._rootFramesTimeline : a._rootTimeline;
                return b._startTime = (b._paused ? b._pauseTime : c._time) - (b._reversed ? b.totalDuration() - b._totalTime : b._totalTime) / b._timeScale, 
                this;
            }
            if (b instanceof Array || b && b.push && i(b)) {
                for (var d = b.length; --d > -1; ) this.remove(b[d]);
                return this;
            }
            return "string" == typeof b ? this.removeLabel(b) : this.kill(null, b);
        }, q._remove = function(a, c) {
            b.prototype._remove.call(this, a, c);
            var d = this._last;
            return d ? this._time > d._startTime + d._totalDuration / d._timeScale && (this._time = this.duration(), 
            this._totalTime = this._totalDuration) : this._time = this._totalTime = this._duration = this._totalDuration = 0, 
            this;
        }, q.append = function(a, b) {
            return this.add(a, this._parseTimeOrLabel(null, b, !0, a));
        }, q.insert = q.insertMultiple = function(a, b, c, d) {
            return this.add(a, b || 0, c, d);
        }, q.appendMultiple = function(a, b, c, d) {
            return this.add(a, this._parseTimeOrLabel(null, b, !0, a), c, d);
        }, q.addLabel = function(a, b) {
            return this._labels[a] = this._parseTimeOrLabel(b), this;
        }, q.addPause = function(a, b, d, e) {
            var f = c.delayedCall(0, o, d, e || this);
            return f.vars.onComplete = f.vars.onReverseComplete = b, f.data = "isPause", this._hasPause = !0, 
            this.add(f, a);
        }, q.removeLabel = function(a) {
            return delete this._labels[a], this;
        }, q.getLabelTime = function(a) {
            return null != this._labels[a] ? this._labels[a] : -1;
        }, q._parseTimeOrLabel = function(b, c, d, e) {
            var f;
            if (e instanceof a && e.timeline === this) this.remove(e); else if (e && (e instanceof Array || e.push && i(e))) for (f = e.length; --f > -1; ) e[f] instanceof a && e[f].timeline === this && this.remove(e[f]);
            if ("string" == typeof c) return this._parseTimeOrLabel(c, d && "number" == typeof b && null == this._labels[c] ? b - this.duration() : 0, d);
            if (c = c || 0, "string" != typeof b || !isNaN(b) && null == this._labels[b]) null == b && (b = this.duration()); else {
                if (f = b.indexOf("="), -1 === f) return null == this._labels[b] ? d ? this._labels[b] = this.duration() + c : c : this._labels[b] + c;
                c = parseInt(b.charAt(f - 1) + "1", 10) * Number(b.substr(f + 1)), b = f > 1 ? this._parseTimeOrLabel(b.substr(0, f - 1), 0, d) : this.duration();
            }
            return Number(b) + c;
        }, q.seek = function(a, b) {
            return this.totalTime("number" == typeof a ? a : this._parseTimeOrLabel(a), b !== !1);
        }, q.stop = function() {
            return this.paused(!0);
        }, q.gotoAndPlay = function(a, b) {
            return this.play(a, b);
        }, q.gotoAndStop = function(a, b) {
            return this.pause(a, b);
        }, q.render = function(a, b, c) {
            this._gc && this._enabled(!0, !1);
            var d, f, g, h, i, l, m, n = this._dirty ? this.totalDuration() : this._totalDuration, o = this._time, p = this._startTime, q = this._timeScale, r = this._paused;
            if (a >= n - 1e-7) this._totalTime = this._time = n, this._reversed || this._hasPausedChild() || (f = !0, 
            h = "onComplete", i = !!this._timeline.autoRemoveChildren, 0 === this._duration && (0 >= a && a >= -1e-7 || this._rawPrevTime < 0 || this._rawPrevTime === e) && this._rawPrevTime !== a && this._first && (i = !0, 
            this._rawPrevTime > e && (h = "onReverseComplete"))), this._rawPrevTime = this._duration || !b || a || this._rawPrevTime === a ? a : e, 
            a = n + 1e-4; else if (1e-7 > a) if (this._totalTime = this._time = 0, (0 !== o || 0 === this._duration && this._rawPrevTime !== e && (this._rawPrevTime > 0 || 0 > a && this._rawPrevTime >= 0)) && (h = "onReverseComplete", 
            f = this._reversed), 0 > a) this._active = !1, this._timeline.autoRemoveChildren && this._reversed ? (i = f = !0, 
            h = "onReverseComplete") : this._rawPrevTime >= 0 && this._first && (i = !0), this._rawPrevTime = a; else {
                if (this._rawPrevTime = this._duration || !b || a || this._rawPrevTime === a ? a : e, 
                0 === a && f) for (d = this._first; d && 0 === d._startTime; ) d._duration || (f = !1), 
                d = d._next;
                a = 0, this._initted || (i = !0);
            } else {
                if (this._hasPause && !this._forcingPlayhead && !b) {
                    if (a >= o) for (d = this._first; d && d._startTime <= a && !l; ) d._duration || "isPause" !== d.data || d.ratio || 0 === d._startTime && 0 === this._rawPrevTime || (l = d), 
                    d = d._next; else for (d = this._last; d && d._startTime >= a && !l; ) d._duration || "isPause" === d.data && d._rawPrevTime > 0 && (l = d), 
                    d = d._prev;
                    l && (this._time = a = l._startTime, this._totalTime = a + this._cycle * (this._totalDuration + this._repeatDelay));
                }
                this._totalTime = this._time = this._rawPrevTime = a;
            }
            if (this._time !== o && this._first || c || i || l) {
                if (this._initted || (this._initted = !0), this._active || !this._paused && this._time !== o && a > 0 && (this._active = !0), 
                0 === o && this.vars.onStart && (0 === this._time && this._duration || b || this._callback("onStart")), 
                m = this._time, m >= o) for (d = this._first; d && (g = d._next, m === this._time && (!this._paused || r)); ) (d._active || d._startTime <= m && !d._paused && !d._gc) && (l === d && this.pause(), 
                d._reversed ? d.render((d._dirty ? d.totalDuration() : d._totalDuration) - (a - d._startTime) * d._timeScale, b, c) : d.render((a - d._startTime) * d._timeScale, b, c)), 
                d = g; else for (d = this._last; d && (g = d._prev, m === this._time && (!this._paused || r)); ) {
                    if (d._active || d._startTime <= o && !d._paused && !d._gc) {
                        if (l === d) {
                            for (l = d._prev; l && l.endTime() > this._time; ) l.render(l._reversed ? l.totalDuration() - (a - l._startTime) * l._timeScale : (a - l._startTime) * l._timeScale, b, c), 
                            l = l._prev;
                            l = null, this.pause();
                        }
                        d._reversed ? d.render((d._dirty ? d.totalDuration() : d._totalDuration) - (a - d._startTime) * d._timeScale, b, c) : d.render((a - d._startTime) * d._timeScale, b, c);
                    }
                    d = g;
                }
                this._onUpdate && (b || (j.length && k(), this._callback("onUpdate"))), h && (this._gc || (p === this._startTime || q !== this._timeScale) && (0 === this._time || n >= this.totalDuration()) && (f && (j.length && k(), 
                this._timeline.autoRemoveChildren && this._enabled(!1, !1), this._active = !1), 
                !b && this.vars[h] && this._callback(h)));
            }
        }, q._hasPausedChild = function() {
            for (var a = this._first; a; ) {
                if (a._paused || a instanceof d && a._hasPausedChild()) return !0;
                a = a._next;
            }
            return !1;
        }, q.getChildren = function(a, b, d, e) {
            e = e || -9999999999;
            for (var f = [], g = this._first, h = 0; g; ) g._startTime < e || (g instanceof c ? b !== !1 && (f[h++] = g) : (d !== !1 && (f[h++] = g), 
            a !== !1 && (f = f.concat(g.getChildren(!0, b, d)), h = f.length))), g = g._next;
            return f;
        }, q.getTweensOf = function(a, b) {
            var d, e, f = this._gc, g = [], h = 0;
            for (f && this._enabled(!0, !0), d = c.getTweensOf(a), e = d.length; --e > -1; ) (d[e].timeline === this || b && this._contains(d[e])) && (g[h++] = d[e]);
            return f && this._enabled(!1, !0), g;
        }, q.recent = function() {
            return this._recent;
        }, q._contains = function(a) {
            for (var b = a.timeline; b; ) {
                if (b === this) return !0;
                b = b.timeline;
            }
            return !1;
        }, q.shiftChildren = function(a, b, c) {
            c = c || 0;
            for (var d, e = this._first, f = this._labels; e; ) e._startTime >= c && (e._startTime += a), 
            e = e._next;
            if (b) for (d in f) f[d] >= c && (f[d] += a);
            return this._uncache(!0);
        }, q._kill = function(a, b) {
            if (!a && !b) return this._enabled(!1, !1);
            for (var c = b ? this.getTweensOf(b) : this.getChildren(!0, !0, !1), d = c.length, e = !1; --d > -1; ) c[d]._kill(a, b) && (e = !0);
            return e;
        }, q.clear = function(a) {
            var b = this.getChildren(!1, !0, !0), c = b.length;
            for (this._time = this._totalTime = 0; --c > -1; ) b[c]._enabled(!1, !1);
            return a !== !1 && (this._labels = {}), this._uncache(!0);
        }, q.invalidate = function() {
            for (var b = this._first; b; ) b.invalidate(), b = b._next;
            return a.prototype.invalidate.call(this);
        }, q._enabled = function(a, c) {
            if (a === this._gc) for (var d = this._first; d; ) d._enabled(a, !0), d = d._next;
            return b.prototype._enabled.call(this, a, c);
        }, q.totalTime = function(b, c, d) {
            this._forcingPlayhead = !0;
            var e = a.prototype.totalTime.apply(this, arguments);
            return this._forcingPlayhead = !1, e;
        }, q.duration = function(a) {
            return arguments.length ? (0 !== this.duration() && 0 !== a && this.timeScale(this._duration / a), 
            this) : (this._dirty && this.totalDuration(), this._duration);
        }, q.totalDuration = function(a) {
            if (!arguments.length) {
                if (this._dirty) {
                    for (var b, c, d = 0, e = this._last, f = 999999999999; e; ) b = e._prev, e._dirty && e.totalDuration(), 
                    e._startTime > f && this._sortChildren && !e._paused ? this.add(e, e._startTime - e._delay) : f = e._startTime, 
                    e._startTime < 0 && !e._paused && (d -= e._startTime, this._timeline.smoothChildTiming && (this._startTime += e._startTime / this._timeScale), 
                    this.shiftChildren(-e._startTime, !1, -9999999999), f = 0), c = e._startTime + e._totalDuration / e._timeScale, 
                    c > d && (d = c), e = b;
                    this._duration = this._totalDuration = d, this._dirty = !1;
                }
                return this._totalDuration;
            }
            return a && this.totalDuration() ? this.timeScale(this._totalDuration / a) : this;
        }, q.paused = function(b) {
            if (!b) for (var c = this._first, d = this._time; c; ) c._startTime === d && "isPause" === c.data && (c._rawPrevTime = 0), 
            c = c._next;
            return a.prototype.paused.apply(this, arguments);
        }, q.usesFrames = function() {
            for (var b = this._timeline; b._timeline; ) b = b._timeline;
            return b === a._rootFramesTimeline;
        }, q.rawTime = function() {
            return this._paused ? this._totalTime : (this._timeline.rawTime() - this._startTime) * this._timeScale;
        }, d;
    }, !0);
}), _gsScope._gsDefine && _gsScope._gsQueue.pop()(), function(a) {
    "use strict";
    var b = function() {
        return (_gsScope.GreenSockGlobals || _gsScope)[a];
    };
    "function" == typeof define && define.amd ? define([ "TweenLite" ], b) : "undefined" != typeof module && module.exports && (require("./TweenLite.js"), 
    module.exports = b());
}("TimelineMax");

/*!
 * VERSION: 0.5.6
 * DATE: 2017-01-17
 * UPDATES AND DOCS AT: http://greensock.com
 *
 * @license Copyright (c) 2008-2017, GreenSock. All rights reserved.
 * SplitText is a Club GreenSock membership benefit; You must have a valid membership to use
 * this code without violating the terms of use. Visit http://greensock.com/club/ to sign up or get more details.
 * This work is subject to the software agreement that was issued with your membership.
 * 
 * @author: Jack Doyle, jack@greensock.com
 */
var _gsScope = "undefined" != typeof module && module.exports && "undefined" != typeof global ? global : this || window;

!function(a) {
    "use strict";
    var b = a.GreenSockGlobals || a, c = function(a) {
        var c, d = a.split("."), e = b;
        for (c = 0; c < d.length; c++) e[d[c]] = e = e[d[c]] || {};
        return e;
    }, d = c("com.greensock.utils"), e = function(a) {
        var b = a.nodeType, c = "";
        if (1 === b || 9 === b || 11 === b) {
            if ("string" == typeof a.textContent) return a.textContent;
            for (a = a.firstChild; a; a = a.nextSibling) c += e(a);
        } else if (3 === b || 4 === b) return a.nodeValue;
        return c;
    }, f = document, g = f.defaultView ? f.defaultView.getComputedStyle : function() {}, h = /([A-Z])/g, i = function(a, b, c, d) {
        var e;
        return (c = c || g(a, null)) ? (a = c.getPropertyValue(b.replace(h, "-$1").toLowerCase()), 
        e = a || c.length ? a : c[b]) : a.currentStyle && (c = a.currentStyle, e = c[b]), 
        d ? e : parseInt(e, 10) || 0;
    }, j = function(a) {
        return a.length && a[0] && (a[0].nodeType && a[0].style && !a.nodeType || a[0].length && a[0][0]) ? !0 : !1;
    }, k = function(a) {
        var b, c, d, e = [], f = a.length;
        for (b = 0; f > b; b++) if (c = a[b], j(c)) for (d = c.length, d = 0; d < c.length; d++) e.push(c[d]); else e.push(c);
        return e;
    }, l = /(?:\r|\n|\t\t)/g, m = /(?:\s\s+)/g, n = 55296, o = 56319, p = 56320, q = 127462, r = 127487, s = 127995, t = 127999, u = function(a) {
        return (a.charCodeAt(0) - n << 10) + (a.charCodeAt(1) - p) + 65536;
    }, v = f.all && !f.addEventListener, w = " style='position:relative;display:inline-block;" + (v ? "*display:inline;*zoom:1;'" : "'"), x = function(a, b) {
        a = a || "";
        var c = -1 !== a.indexOf("++"), d = 1;
        return c && (a = a.split("++").join("")), function() {
            return "<" + b + w + (a ? " class='" + a + (c ? d++ : "") + "'>" : ">");
        };
    }, y = d.SplitText = b.SplitText = function(a, b) {
        if ("string" == typeof a && (a = y.selector(a)), !a) throw "cannot split a null element.";
        this.elements = j(a) ? k(a) : [ a ], this.chars = [], this.words = [], this.lines = [], 
        this._originals = [], this.vars = b || {}, this.split(b);
    }, z = function(a, b, c) {
        var d = a.nodeType;
        if (1 === d || 9 === d || 11 === d) for (a = a.firstChild; a; a = a.nextSibling) z(a, b, c); else (3 === d || 4 === d) && (a.nodeValue = a.nodeValue.split(b).join(c));
    }, A = function(a, b) {
        for (var c = b.length; --c > -1; ) a.push(b[c]);
    }, B = function(a) {
        var b, c = [], d = a.length;
        for (b = 0; b !== d; c.push(a[b++])) ;
        return c;
    }, C = function(a, b, c) {
        for (var d; a && a !== b; ) {
            if (d = a._next || a.nextSibling) return d.textContent.charAt(0) === c;
            a = a.parentNode || a._parent;
        }
        return !1;
    }, D = function(a) {
        var b, c, d = B(a.childNodes), e = d.length;
        for (b = 0; e > b; b++) c = d[b], c._isSplit ? D(c) : (b && 3 === c.previousSibling.nodeType ? c.previousSibling.nodeValue += 3 === c.nodeType ? c.nodeValue : c.firstChild.nodeValue : 3 !== c.nodeType && a.insertBefore(c.firstChild, c), 
        a.removeChild(c));
    }, E = function(a, b, c, d, e, h, j) {
        var k, l, m, n, o, p, q, r, s, t, u, v, w = g(a), x = i(a, "paddingLeft", w), y = -999, B = i(a, "borderBottomWidth", w) + i(a, "borderTopWidth", w), E = i(a, "borderLeftWidth", w) + i(a, "borderRightWidth", w), F = i(a, "paddingTop", w) + i(a, "paddingBottom", w), G = i(a, "paddingLeft", w) + i(a, "paddingRight", w), H = .2 * i(a, "fontSize"), I = i(a, "textAlign", w, !0), J = [], K = [], L = [], M = b.wordDelimiter || " ", N = b.span ? "span" : "div", O = b.type || b.split || "chars,words,lines", P = e && -1 !== O.indexOf("lines") ? [] : null, Q = -1 !== O.indexOf("words"), R = -1 !== O.indexOf("chars"), S = "absolute" === b.position || b.absolute === !0, T = b.linesClass, U = -1 !== (T || "").indexOf("++"), V = [];
        for (P && 1 === a.children.length && a.children[0]._isSplit && (a = a.children[0]), 
        U && (T = T.split("++").join("")), l = a.getElementsByTagName("*"), m = l.length, 
        o = [], k = 0; m > k; k++) o[k] = l[k];
        if (P || S) for (k = 0; m > k; k++) n = o[k], p = n.parentNode === a, (p || S || R && !Q) && (v = n.offsetTop, 
        P && p && Math.abs(v - y) > H && "BR" !== n.nodeName && (q = [], P.push(q), y = v), 
        S && (n._x = n.offsetLeft, n._y = v, n._w = n.offsetWidth, n._h = n.offsetHeight), 
        P && ((n._isSplit && p || !R && p || Q && p || !Q && n.parentNode.parentNode === a && !n.parentNode._isSplit) && (q.push(n), 
        n._x -= x, C(n, a, M) && (n._wordEnd = !0)), "BR" === n.nodeName && n.nextSibling && "BR" === n.nextSibling.nodeName && P.push([])));
        for (k = 0; m > k; k++) n = o[k], p = n.parentNode === a, "BR" !== n.nodeName ? (S && (s = n.style, 
        Q || p || (n._x += n.parentNode._x, n._y += n.parentNode._y), s.left = n._x + "px", 
        s.top = n._y + "px", s.position = "absolute", s.display = "block", s.width = n._w + 1 + "px", 
        s.height = n._h + "px"), !Q && R ? n._isSplit ? (n._next = n.nextSibling, n.parentNode.appendChild(n)) : n.parentNode._isSplit ? (n._parent = n.parentNode, 
        !n.previousSibling && n.firstChild && (n.firstChild._isFirst = !0), n.nextSibling && " " === n.nextSibling.textContent && !n.nextSibling.nextSibling && V.push(n.nextSibling), 
        n._next = n.nextSibling && n.nextSibling._isFirst ? null : n.nextSibling, n.parentNode.removeChild(n), 
        o.splice(k--, 1), m--) : p || (v = !n.nextSibling && C(n.parentNode, a, M), n.parentNode._parent && n.parentNode._parent.appendChild(n), 
        v && n.parentNode.appendChild(f.createTextNode(" ")), b.span && (n.style.display = "inline"), 
        J.push(n)) : n.parentNode._isSplit && !n._isSplit && "" !== n.innerHTML ? K.push(n) : R && !n._isSplit && (b.span && (n.style.display = "inline"), 
        J.push(n))) : P || S ? (n.parentNode && n.parentNode.removeChild(n), o.splice(k--, 1), 
        m--) : Q || a.appendChild(n);
        for (k = V.length; --k > -1; ) V[k].parentNode.removeChild(V[k]);
        if (P) {
            for (S && (t = f.createElement(N), a.appendChild(t), u = t.offsetWidth + "px", v = t.offsetParent === a ? 0 : a.offsetLeft, 
            a.removeChild(t)), s = a.style.cssText, a.style.cssText = "display:none;"; a.firstChild; ) a.removeChild(a.firstChild);
            for (r = " " === M && (!S || !Q && !R), k = 0; k < P.length; k++) {
                for (q = P[k], t = f.createElement(N), t.style.cssText = "display:block;text-align:" + I + ";position:" + (S ? "absolute;" : "relative;"), 
                T && (t.className = T + (U ? k + 1 : "")), L.push(t), m = q.length, l = 0; m > l; l++) "BR" !== q[l].nodeName && (n = q[l], 
                t.appendChild(n), r && n._wordEnd && t.appendChild(f.createTextNode(" ")), S && (0 === l && (t.style.top = n._y + "px", 
                t.style.left = x + v + "px"), n.style.top = "0px", v && (n.style.left = n._x - v + "px")));
                0 === m ? t.innerHTML = "&nbsp;" : Q || R || (D(t), z(t, String.fromCharCode(160), " ")), 
                S && (t.style.width = u, t.style.height = n._h + "px"), a.appendChild(t);
            }
            a.style.cssText = s;
        }
        S && (j > a.clientHeight && (a.style.height = j - F + "px", a.clientHeight < j && (a.style.height = j + B + "px")), 
        h > a.clientWidth && (a.style.width = h - G + "px", a.clientWidth < h && (a.style.width = h + E + "px"))), 
        A(c, J), A(d, K), A(e, L);
    }, F = function(a, b, c, d) {
        var g, h, i, j, k, p, v, w, x, y = b.span ? "span" : "div", A = b.type || b.split || "chars,words,lines", B = (-1 !== A.indexOf("words"), 
        -1 !== A.indexOf("chars")), C = "absolute" === b.position || b.absolute === !0, D = b.wordDelimiter || " ", E = " " !== D ? "" : C ? "&#173; " : " ", F = b.span ? "</span>" : "</div>", G = !0, H = f.createElement("div"), I = a.parentNode;
        for (I.insertBefore(H, a), H.textContent = a.nodeValue, I.removeChild(a), a = H, 
        g = e(a), v = -1 !== g.indexOf("<"), b.reduceWhiteSpace !== !1 && (g = g.replace(m, " ").replace(l, "")), 
        v && (g = g.split("<").join("{{LT}}")), k = g.length, h = (" " === g.charAt(0) ? E : "") + c(), 
        i = 0; k > i; i++) if (p = g.charAt(i), p === D && g.charAt(i - 1) !== D && i) {
            for (h += G ? F : "", G = !1; g.charAt(i + 1) === D; ) h += E, i++;
            i === k - 1 ? h += E : ")" !== g.charAt(i + 1) && (h += E + c(), G = !0);
        } else "{" === p && "{{LT}}" === g.substr(i, 6) ? (h += B ? d() + "{{LT}}</" + y + ">" : "{{LT}}", 
        i += 5) : p.charCodeAt(0) >= n && p.charCodeAt(0) <= o || g.charCodeAt(i + 1) >= 65024 && g.charCodeAt(i + 1) <= 65039 ? (w = u(g.substr(i, 2)), 
        x = u(g.substr(i + 2, 2)), j = w >= q && r >= w && x >= q && r >= x || x >= s && t >= x ? 4 : 2, 
        h += B && " " !== p ? d() + g.substr(i, j) + "</" + y + ">" : g.substr(i, j), i += j - 1) : h += B && " " !== p ? d() + p + "</" + y + ">" : p;
        a.outerHTML = h + (G ? F : ""), v && z(I, "{{LT}}", "<");
    }, G = function(a, b, c, d) {
        var e, f, g = B(a.childNodes), h = g.length, j = "absolute" === b.position || b.absolute === !0;
        if (3 !== a.nodeType || h > 1) {
            for (b.absolute = !1, e = 0; h > e; e++) f = g[e], (3 !== f.nodeType || /\S+/.test(f.nodeValue)) && (j && 3 !== f.nodeType && "inline" === i(f, "display", null, !0) && (f.style.display = "inline-block", 
            f.style.position = "relative"), f._isSplit = !0, G(f, b, c, d));
            return b.absolute = j, void (a._isSplit = !0);
        }
        F(a, b, c, d);
    }, H = y.prototype;
    H.split = function(a) {
        this.isSplit && this.revert(), this.vars = a = a || this.vars, this._originals.length = this.chars.length = this.words.length = this.lines.length = 0;
        for (var b, c, d, e = this.elements.length, f = a.span ? "span" : "div", g = ("absolute" === a.position || a.absolute === !0, 
        x(a.wordsClass, f)), h = x(a.charsClass, f); --e > -1; ) d = this.elements[e], this._originals[e] = d.innerHTML, 
        b = d.clientHeight, c = d.clientWidth, G(d, a, g, h), E(d, a, this.chars, this.words, this.lines, c, b);
        return this.chars.reverse(), this.words.reverse(), this.lines.reverse(), this.isSplit = !0, 
        this;
    }, H.revert = function() {
        if (!this._originals) throw "revert() call wasn't scoped properly.";
        for (var a = this._originals.length; --a > -1; ) this.elements[a].innerHTML = this._originals[a];
        return this.chars = [], this.words = [], this.lines = [], this.isSplit = !1, this;
    }, y.selector = a.$ || a.jQuery || function(b) {
        var c = a.$ || a.jQuery;
        return c ? (y.selector = c, c(b)) : "undefined" == typeof document ? b : document.querySelectorAll ? document.querySelectorAll(b) : document.getElementById("#" === b.charAt(0) ? b.substr(1) : b);
    }, y.version = "0.5.6";
}(_gsScope), function(a) {
    "use strict";
    var b = function() {
        return (_gsScope.GreenSockGlobals || _gsScope)[a];
    };
    "function" == typeof define && define.amd ? define([], b) : "undefined" != typeof module && module.exports && (module.exports = b());
}("SplitText");

!function(e, t) {
    "function" == typeof define && define.amd ? define(t) : "object" == typeof exports ? module.exports = t() : e.ScrollMagic = t();
}(this, function() {
    "use strict";
    var e = function() {};
    e.version = "2.0.5", window.addEventListener("mousewheel", function() {});
    var t = "data-scrollmagic-pin-spacer";
    e.Controller = function(r) {
        var o, s, a = "ScrollMagic.Controller", l = "FORWARD", c = "REVERSE", u = "PAUSED", f = n.defaults, d = this, h = i.extend({}, f, r), g = [], p = !1, v = 0, m = u, w = !0, y = 0, S = !0, b = function() {
            for (var e in h) f.hasOwnProperty(e) || delete h[e];
            if (h.container = i.get.elements(h.container)[0], !h.container) throw a + " init failed.";
            w = h.container === window || h.container === document.body || !document.body.contains(h.container), 
            w && (h.container = window), y = z(), h.container.addEventListener("resize", T), 
            h.container.addEventListener("scroll", T), h.refreshInterval = parseInt(h.refreshInterval) || f.refreshInterval, 
            E();
        }, E = function() {
            h.refreshInterval > 0 && (s = window.setTimeout(A, h.refreshInterval));
        }, x = function() {
            return h.vertical ? i.get.scrollTop(h.container) : i.get.scrollLeft(h.container);
        }, z = function() {
            return h.vertical ? i.get.height(h.container) : i.get.width(h.container);
        }, C = this._setScrollPos = function(e) {
            h.vertical ? w ? window.scrollTo(i.get.scrollLeft(), e) : h.container.scrollTop = e : w ? window.scrollTo(e, i.get.scrollTop()) : h.container.scrollLeft = e;
        }, F = function() {
            if (S && p) {
                var e = i.type.Array(p) ? p : g.slice(0);
                p = !1;
                var t = v;
                v = d.scrollPos();
                var n = v - t;
                0 !== n && (m = n > 0 ? l : c), m === c && e.reverse(), e.forEach(function(e) {
                    e.update(!0);
                });
            }
        }, L = function() {
            o = i.rAF(F);
        }, T = function(e) {
            "resize" == e.type && (y = z(), m = u), p !== !0 && (p = !0, L());
        }, A = function() {
            if (!w && y != z()) {
                var e;
                try {
                    e = new Event("resize", {
                        bubbles: !1,
                        cancelable: !1
                    });
                } catch (t) {
                    e = document.createEvent("Event"), e.initEvent("resize", !1, !1);
                }
                h.container.dispatchEvent(e);
            }
            g.forEach(function(e) {
                e.refresh();
            }), E();
        };
        this._options = h;
        var O = function(e) {
            if (e.length <= 1) return e;
            var t = e.slice(0);
            return t.sort(function(e, t) {
                return e.scrollOffset() > t.scrollOffset() ? 1 : -1;
            }), t;
        };
        return this.addScene = function(t) {
            if (i.type.Array(t)) t.forEach(function(e) {
                d.addScene(e);
            }); else if (t instanceof e.Scene) if (t.controller() !== d) t.addTo(d); else if (g.indexOf(t) < 0) {
                g.push(t), g = O(g), t.on("shift.controller_sort", function() {
                    g = O(g);
                });
                for (var n in h.globalSceneOptions) t[n] && t[n].call(t, h.globalSceneOptions[n]);
            }
            return d;
        }, this.removeScene = function(e) {
            if (i.type.Array(e)) e.forEach(function(e) {
                d.removeScene(e);
            }); else {
                var t = g.indexOf(e);
                t > -1 && (e.off("shift.controller_sort"), g.splice(t, 1), e.remove());
            }
            return d;
        }, this.updateScene = function(t, n) {
            return i.type.Array(t) ? t.forEach(function(e) {
                d.updateScene(e, n);
            }) : n ? t.update(!0) : p !== !0 && t instanceof e.Scene && (p = p || [], -1 == p.indexOf(t) && p.push(t), 
            p = O(p), L()), d;
        }, this.update = function(e) {
            return T({
                type: "resize"
            }), e && F(), d;
        }, this.scrollTo = function(n, r) {
            if (i.type.Number(n)) C.call(h.container, n, r); else if (n instanceof e.Scene) n.controller() === d && d.scrollTo(n.scrollOffset(), r); else if (i.type.Function(n)) C = n; else {
                var o = i.get.elements(n)[0];
                if (o) {
                    for (;o.parentNode.hasAttribute(t); ) o = o.parentNode;
                    var s = h.vertical ? "top" : "left", a = i.get.offset(h.container), l = i.get.offset(o);
                    w || (a[s] -= d.scrollPos()), d.scrollTo(l[s] - a[s], r);
                }
            }
            return d;
        }, this.scrollPos = function(e) {
            return arguments.length ? (i.type.Function(e) && (x = e), d) : x.call(d);
        }, this.info = function(e) {
            var t = {
                size: y,
                vertical: h.vertical,
                scrollPos: v,
                scrollDirection: m,
                container: h.container,
                isDocument: w
            };
            return arguments.length ? void 0 !== t[e] ? t[e] : void 0 : t;
        }, this.loglevel = function() {
            return d;
        }, this.enabled = function(e) {
            return arguments.length ? (S != e && (S = !!e, d.updateScene(g, !0)), d) : S;
        }, this.destroy = function(e) {
            window.clearTimeout(s);
            for (var t = g.length; t--; ) g[t].destroy(e);
            return h.container.removeEventListener("resize", T), h.container.removeEventListener("scroll", T), 
            i.cAF(o), null;
        }, b(), d;
    };
    var n = {
        defaults: {
            container: window,
            vertical: !0,
            globalSceneOptions: {},
            loglevel: 2,
            refreshInterval: 100
        }
    };
    e.Controller.addOption = function(e, t) {
        n.defaults[e] = t;
    }, e.Controller.extend = function(t) {
        var n = this;
        e.Controller = function() {
            return n.apply(this, arguments), this.$super = i.extend({}, this), t.apply(this, arguments) || this;
        }, i.extend(e.Controller, n), e.Controller.prototype = n.prototype, e.Controller.prototype.constructor = e.Controller;
    }, e.Scene = function(n) {
        var o, s, a = "BEFORE", l = "DURING", c = "AFTER", u = r.defaults, f = this, d = i.extend({}, u, n), h = a, g = 0, p = {
            start: 0,
            end: 0
        }, v = 0, m = !0, w = function() {
            for (var e in d) u.hasOwnProperty(e) || delete d[e];
            for (var t in u) L(t);
            C();
        }, y = {};
        this.on = function(e, t) {
            return i.type.Function(t) && (e = e.trim().split(" "), e.forEach(function(e) {
                var n = e.split("."), r = n[0], i = n[1];
                "*" != r && (y[r] || (y[r] = []), y[r].push({
                    namespace: i || "",
                    callback: t
                }));
            })), f;
        }, this.off = function(e, t) {
            return e ? (e = e.trim().split(" "), e.forEach(function(e) {
                var n = e.split("."), r = n[0], i = n[1] || "", o = "*" === r ? Object.keys(y) : [ r ];
                o.forEach(function(e) {
                    for (var n = y[e] || [], r = n.length; r--; ) {
                        var o = n[r];
                        !o || i !== o.namespace && "*" !== i || t && t != o.callback || n.splice(r, 1);
                    }
                    n.length || delete y[e];
                });
            }), f) : f;
        }, this.trigger = function(t, n) {
            if (t) {
                var r = t.trim().split("."), i = r[0], o = r[1], s = y[i];
                s && s.forEach(function(t) {
                    o && o !== t.namespace || t.callback.call(f, new e.Event(i, t.namespace, f, n));
                });
            }
            return f;
        }, f.on("change.internal", function(e) {
            "loglevel" !== e.what && "tweenChanges" !== e.what && ("triggerElement" === e.what ? E() : "reverse" === e.what && f.update());
        }).on("shift.internal", function() {
            S(), f.update();
        }), this.addTo = function(t) {
            return t instanceof e.Controller && s != t && (s && s.removeScene(f), s = t, C(), 
            b(!0), E(!0), S(), s.info("container").addEventListener("resize", x), t.addScene(f), 
            f.trigger("add", {
                controller: s
            }), f.update()), f;
        }, this.enabled = function(e) {
            return arguments.length ? (m != e && (m = !!e, f.update(!0)), f) : m;
        }, this.remove = function() {
            if (s) {
                s.info("container").removeEventListener("resize", x);
                var e = s;
                s = void 0, e.removeScene(f), f.trigger("remove");
            }
            return f;
        }, this.destroy = function(e) {
            return f.trigger("destroy", {
                reset: e
            }), f.remove(), f.off("*.*"), null;
        }, this.update = function(e) {
            if (s) if (e) if (s.enabled() && m) {
                var t, n = s.info("scrollPos");
                t = d.duration > 0 ? (n - p.start) / (p.end - p.start) : n >= p.start ? 1 : 0, f.trigger("update", {
                    startPos: p.start,
                    endPos: p.end,
                    scrollPos: n
                }), f.progress(t);
            } else T && h === l && O(!0); else s.updateScene(f, !1);
            return f;
        }, this.refresh = function() {
            return b(), E(), f;
        }, this.progress = function(e) {
            if (arguments.length) {
                var t = !1, n = h, r = s ? s.info("scrollDirection") : "PAUSED", i = d.reverse || e >= g;
                if (0 === d.duration ? (t = g != e, g = 1 > e && i ? 0 : 1, h = 0 === g ? a : l) : 0 > e && h !== a && i ? (g = 0, 
                h = a, t = !0) : e >= 0 && 1 > e && i ? (g = e, h = l, t = !0) : e >= 1 && h !== c ? (g = 1, 
                h = c, t = !0) : h !== l || i || O(), t) {
                    var o = {
                        progress: g,
                        state: h,
                        scrollDirection: r
                    }, u = h != n, p = function(e) {
                        f.trigger(e, o);
                    };
                    u && n !== l && (p("enter"), p(n === a ? "start" : "end")), p("progress"), u && h !== l && (p(h === a ? "start" : "end"), 
                    p("leave"));
                }
                return f;
            }
            return g;
        };
        var S = function() {
            p = {
                start: v + d.offset
            }, s && d.triggerElement && (p.start -= s.info("size") * d.triggerHook), p.end = p.start + d.duration;
        }, b = function(e) {
            if (o) {
                var t = "duration";
                F(t, o.call(f)) && !e && (f.trigger("change", {
                    what: t,
                    newval: d[t]
                }), f.trigger("shift", {
                    reason: t
                }));
            }
        }, E = function(e) {
            var n = 0, r = d.triggerElement;
            if (s && r) {
                for (var o = s.info(), a = i.get.offset(o.container), l = o.vertical ? "top" : "left"; r.parentNode.hasAttribute(t); ) r = r.parentNode;
                var c = i.get.offset(r);
                o.isDocument || (a[l] -= s.scrollPos()), n = c[l] - a[l];
            }
            var u = n != v;
            v = n, u && !e && f.trigger("shift", {
                reason: "triggerElementPosition"
            });
        }, x = function() {
            d.triggerHook > 0 && f.trigger("shift", {
                reason: "containerResize"
            });
        }, z = i.extend(r.validate, {
            duration: function(e) {
                if (i.type.String(e) && e.match(/^(\.|\d)*\d+%$/)) {
                    var t = parseFloat(e) / 100;
                    e = function() {
                        return s ? s.info("size") * t : 0;
                    };
                }
                if (i.type.Function(e)) {
                    o = e;
                    try {
                        e = parseFloat(o());
                    } catch (n) {
                        e = -1;
                    }
                }
                if (e = parseFloat(e), !i.type.Number(e) || 0 > e) throw o ? (o = void 0, 0) : 0;
                return e;
            }
        }), C = function(e) {
            e = arguments.length ? [ e ] : Object.keys(z), e.forEach(function(e) {
                var t;
                if (z[e]) try {
                    t = z[e](d[e]);
                } catch (n) {
                    t = u[e];
                } finally {
                    d[e] = t;
                }
            });
        }, F = function(e, t) {
            var n = !1, r = d[e];
            return d[e] != t && (d[e] = t, C(e), n = r != d[e]), n;
        }, L = function(e) {
            f[e] || (f[e] = function(t) {
                return arguments.length ? ("duration" === e && (o = void 0), F(e, t) && (f.trigger("change", {
                    what: e,
                    newval: d[e]
                }), r.shifts.indexOf(e) > -1 && f.trigger("shift", {
                    reason: e
                })), f) : d[e];
            });
        };
        this.controller = function() {
            return s;
        }, this.state = function() {
            return h;
        }, this.scrollOffset = function() {
            return p.start;
        }, this.triggerPosition = function() {
            var e = d.offset;
            return s && (e += d.triggerElement ? v : s.info("size") * f.triggerHook()), e;
        };
        var T, A;
        f.on("shift.internal", function(e) {
            var t = "duration" === e.reason;
            (h === c && t || h === l && 0 === d.duration) && O(), t && _();
        }).on("progress.internal", function() {
            O();
        }).on("add.internal", function() {
            _();
        }).on("destroy.internal", function(e) {
            f.removePin(e.reset);
        });
        var O = function(e) {
            if (T && s) {
                var t = s.info(), n = A.spacer.firstChild;
                if (e || h !== l) {
                    var r = {
                        position: A.inFlow ? "relative" : "absolute",
                        top: 0,
                        left: 0
                    }, o = i.css(n, "position") != r.position;
                    A.pushFollowers ? d.duration > 0 && (h === c && 0 === parseFloat(i.css(A.spacer, "padding-top")) ? o = !0 : h === a && 0 === parseFloat(i.css(A.spacer, "padding-bottom")) && (o = !0)) : r[t.vertical ? "top" : "left"] = d.duration * g, 
                    i.css(n, r), o && _();
                } else {
                    "fixed" != i.css(n, "position") && (i.css(n, {
                        position: "fixed"
                    }), _());
                    var u = i.get.offset(A.spacer, !0), f = d.reverse || 0 === d.duration ? t.scrollPos - p.start : Math.round(g * d.duration * 10) / 10;
                    u[t.vertical ? "top" : "left"] += f, i.css(A.spacer.firstChild, {
                        top: u.top,
                        left: u.left
                    });
                }
            }
        }, _ = function() {
            if (T && s && A.inFlow) {
                var e = h === l, t = s.info("vertical"), n = A.spacer.firstChild, r = i.isMarginCollapseType(i.css(A.spacer, "display")), o = {};
                A.relSize.width || A.relSize.autoFullWidth ? e ? i.css(T, {
                    width: i.get.width(A.spacer)
                }) : i.css(T, {
                    width: "100%"
                }) : (o["min-width"] = i.get.width(t ? T : n, !0, !0), o.width = e ? o["min-width"] : "auto"), 
                A.relSize.height ? e ? i.css(T, {
                    height: i.get.height(A.spacer) - (A.pushFollowers ? d.duration : 0)
                }) : i.css(T, {
                    height: "100%"
                }) : (o["min-height"] = i.get.height(t ? n : T, !0, !r), o.height = e ? o["min-height"] : "auto"), 
                A.pushFollowers && (o["padding" + (t ? "Top" : "Left")] = d.duration * g, o["padding" + (t ? "Bottom" : "Right")] = d.duration * (1 - g)), 
                i.css(A.spacer, o);
            }
        }, N = function() {
            s && T && h === l && !s.info("isDocument") && O();
        }, P = function() {
            s && T && h === l && ((A.relSize.width || A.relSize.autoFullWidth) && i.get.width(window) != i.get.width(A.spacer.parentNode) || A.relSize.height && i.get.height(window) != i.get.height(A.spacer.parentNode)) && _();
        }, D = function(e) {
            s && T && h === l && !s.info("isDocument") && (e.preventDefault(), s._setScrollPos(s.info("scrollPos") - ((e.wheelDelta || e[s.info("vertical") ? "wheelDeltaY" : "wheelDeltaX"]) / 3 || 30 * -e.detail)));
        };
        this.setPin = function(e, n) {
            var r = {
                pushFollowers: !0,
                spacerClass: "scrollmagic-pin-spacer"
            };
            if (n = i.extend({}, r, n), e = i.get.elements(e)[0], !e) return f;
            if ("fixed" === i.css(e, "position")) return f;
            if (T) {
                if (T === e) return f;
                f.removePin();
            }
            T = e;
            var o = T.parentNode.style.display, s = [ "top", "left", "bottom", "right", "margin", "marginLeft", "marginRight", "marginTop", "marginBottom" ];
            T.parentNode.style.display = "none";
            var a = "absolute" != i.css(T, "position"), l = i.css(T, s.concat([ "display" ])), c = i.css(T, [ "width", "height" ]);
            T.parentNode.style.display = o, !a && n.pushFollowers && (n.pushFollowers = !1);
            var u = T.parentNode.insertBefore(document.createElement("div"), T), d = i.extend(l, {
                position: a ? "relative" : "absolute",
                boxSizing: "content-box",
                mozBoxSizing: "content-box",
                webkitBoxSizing: "content-box"
            });
            if (a || i.extend(d, i.css(T, [ "width", "height" ])), i.css(u, d), u.setAttribute(t, ""), 
            i.addClass(u, n.spacerClass), A = {
                spacer: u,
                relSize: {
                    width: "%" === c.width.slice(-1),
                    height: "%" === c.height.slice(-1),
                    autoFullWidth: "auto" === c.width && a && i.isMarginCollapseType(l.display)
                },
                pushFollowers: n.pushFollowers,
                inFlow: a
            }, !T.___origStyle) {
                T.___origStyle = {};
                var h = T.style, g = s.concat([ "width", "height", "position", "boxSizing", "mozBoxSizing", "webkitBoxSizing" ]);
                g.forEach(function(e) {
                    T.___origStyle[e] = h[e] || "";
                });
            }
            return A.relSize.width && i.css(u, {
                width: c.width
            }), A.relSize.height && i.css(u, {
                height: c.height
            }), u.appendChild(T), i.css(T, {
                position: a ? "relative" : "absolute",
                margin: "auto",
                top: "auto",
                left: "auto",
                bottom: "auto",
                right: "auto"
            }), (A.relSize.width || A.relSize.autoFullWidth) && i.css(T, {
                boxSizing: "border-box",
                mozBoxSizing: "border-box",
                webkitBoxSizing: "border-box"
            }), window.addEventListener("scroll", N), window.addEventListener("resize", N), 
            window.addEventListener("resize", P), T.addEventListener("mousewheel", D), T.addEventListener("DOMMouseScroll", D), 
            O(), f;
        }, this.removePin = function(e) {
            if (T) {
                if (h === l && O(!0), e || !s) {
                    var n = A.spacer.firstChild;
                    if (n.hasAttribute(t)) {
                        var r = A.spacer.style, o = [ "margin", "marginLeft", "marginRight", "marginTop", "marginBottom" ];
                        margins = {}, o.forEach(function(e) {
                            margins[e] = r[e] || "";
                        }), i.css(n, margins);
                    }
                    A.spacer.parentNode.insertBefore(n, A.spacer), A.spacer.parentNode.removeChild(A.spacer), 
                    T.parentNode.hasAttribute(t) || (i.css(T, T.___origStyle), delete T.___origStyle);
                }
                window.removeEventListener("scroll", N), window.removeEventListener("resize", N), 
                window.removeEventListener("resize", P), T.removeEventListener("mousewheel", D), 
                T.removeEventListener("DOMMouseScroll", D), T = void 0;
            }
            return f;
        };
        var R, k = [];
        return f.on("destroy.internal", function(e) {
            f.removeClassToggle(e.reset);
        }), this.setClassToggle = function(e, t) {
            var n = i.get.elements(e);
            return 0 !== n.length && i.type.String(t) ? (k.length > 0 && f.removeClassToggle(), 
            R = t, k = n, f.on("enter.internal_class leave.internal_class", function(e) {
                var t = "enter" === e.type ? i.addClass : i.removeClass;
                k.forEach(function(e) {
                    t(e, R);
                });
            }), f) : f;
        }, this.removeClassToggle = function(e) {
            return e && k.forEach(function(e) {
                i.removeClass(e, R);
            }), f.off("start.internal_class end.internal_class"), R = void 0, k = [], f;
        }, w(), f;
    };
    var r = {
        defaults: {
            duration: 0,
            offset: 0,
            triggerElement: void 0,
            triggerHook: .5,
            reverse: !0,
            loglevel: 2
        },
        validate: {
            offset: function(e) {
                if (e = parseFloat(e), !i.type.Number(e)) throw 0;
                return e;
            },
            triggerElement: function(e) {
                if (e = e || void 0) {
                    var t = i.get.elements(e)[0];
                    if (!t) throw 0;
                    e = t;
                }
                return e;
            },
            triggerHook: function(e) {
                var t = {
                    onCenter: .5,
                    onEnter: 1,
                    onLeave: 0
                };
                if (i.type.Number(e)) e = Math.max(0, Math.min(parseFloat(e), 1)); else {
                    if (!(e in t)) throw 0;
                    e = t[e];
                }
                return e;
            },
            reverse: function(e) {
                return !!e;
            }
        },
        shifts: [ "duration", "offset", "triggerHook" ]
    };
    e.Scene.addOption = function(e, t, n, i) {
        e in r.defaults || (r.defaults[e] = t, r.validate[e] = n, i && r.shifts.push(e));
    }, e.Scene.extend = function(t) {
        var n = this;
        e.Scene = function() {
            return n.apply(this, arguments), this.$super = i.extend({}, this), t.apply(this, arguments) || this;
        }, i.extend(e.Scene, n), e.Scene.prototype = n.prototype, e.Scene.prototype.constructor = e.Scene;
    }, e.Event = function(e, t, n, r) {
        r = r || {};
        for (var i in r) this[i] = r[i];
        return this.type = e, this.target = this.currentTarget = n, this.namespace = t || "", 
        this.timeStamp = this.timestamp = Date.now(), this;
    };
    var i = e._util = function(e) {
        var t, n = {}, r = function(e) {
            return parseFloat(e) || 0;
        }, i = function(t) {
            return t.currentStyle ? t.currentStyle : e.getComputedStyle(t);
        }, o = function(t, n, o, s) {
            if (n = n === document ? e : n, n === e) s = !1; else if (!f.DomElement(n)) return 0;
            t = t.charAt(0).toUpperCase() + t.substr(1).toLowerCase();
            var a = (o ? n["offset" + t] || n["outer" + t] : n["client" + t] || n["inner" + t]) || 0;
            if (o && s) {
                var l = i(n);
                a += "Height" === t ? r(l.marginTop) + r(l.marginBottom) : r(l.marginLeft) + r(l.marginRight);
            }
            return a;
        }, s = function(e) {
            return e.replace(/^[^a-z]+([a-z])/g, "$1").replace(/-([a-z])/g, function(e) {
                return e[1].toUpperCase();
            });
        };
        n.extend = function(e) {
            for (e = e || {}, t = 1; t < arguments.length; t++) if (arguments[t]) for (var n in arguments[t]) arguments[t].hasOwnProperty(n) && (e[n] = arguments[t][n]);
            return e;
        }, n.isMarginCollapseType = function(e) {
            return [ "block", "flex", "list-item", "table", "-webkit-box" ].indexOf(e) > -1;
        };
        var a = 0, l = [ "ms", "moz", "webkit", "o" ], c = e.requestAnimationFrame, u = e.cancelAnimationFrame;
        for (t = 0; !c && t < l.length; ++t) c = e[l[t] + "RequestAnimationFrame"], u = e[l[t] + "CancelAnimationFrame"] || e[l[t] + "CancelRequestAnimationFrame"];
        c || (c = function(t) {
            var n = new Date().getTime(), r = Math.max(0, 16 - (n - a)), i = e.setTimeout(function() {
                t(n + r);
            }, r);
            return a = n + r, i;
        }), u || (u = function(t) {
            e.clearTimeout(t);
        }), n.rAF = c.bind(e), n.cAF = u.bind(e);
        var f = n.type = function(e) {
            return Object.prototype.toString.call(e).replace(/^\[object (.+)\]$/, "$1").toLowerCase();
        };
        f.String = function(e) {
            return "string" === f(e);
        }, f.Function = function(e) {
            return "function" === f(e);
        }, f.Array = function(e) {
            return Array.isArray(e);
        }, f.Number = function(e) {
            return !f.Array(e) && e - parseFloat(e) + 1 >= 0;
        }, f.DomElement = function(e) {
            return "object" == typeof HTMLElement ? e instanceof HTMLElement : e && "object" == typeof e && null !== e && 1 === e.nodeType && "string" == typeof e.nodeName;
        };
        var d = n.get = {};
        return d.elements = function(t) {
            var n = [];
            if (f.String(t)) try {
                t = document.querySelectorAll(t);
            } catch (r) {
                return n;
            }
            if ("nodelist" === f(t) || f.Array(t)) for (var i = 0, o = n.length = t.length; o > i; i++) {
                var s = t[i];
                n[i] = f.DomElement(s) ? s : d.elements(s);
            } else (f.DomElement(t) || t === document || t === e) && (n = [ t ]);
            return n;
        }, d.scrollTop = function(t) {
            return t && "number" == typeof t.scrollTop ? t.scrollTop : e.pageYOffset || 0;
        }, d.scrollLeft = function(t) {
            return t && "number" == typeof t.scrollLeft ? t.scrollLeft : e.pageXOffset || 0;
        }, d.width = function(e, t, n) {
            return o("width", e, t, n);
        }, d.height = function(e, t, n) {
            return o("height", e, t, n);
        }, d.offset = function(e, t) {
            var n = {
                top: 0,
                left: 0
            };
            if (e && e.getBoundingClientRect) {
                var r = e.getBoundingClientRect();
                n.top = r.top, n.left = r.left, t || (n.top += d.scrollTop(), n.left += d.scrollLeft());
            }
            return n;
        }, n.addClass = function(e, t) {
            t && (e.classList ? e.classList.add(t) : e.className += " " + t);
        }, n.removeClass = function(e, t) {
            t && (e.classList ? e.classList.remove(t) : e.className = e.className.replace(RegExp("(^|\\b)" + t.split(" ").join("|") + "(\\b|$)", "gi"), " "));
        }, n.css = function(e, t) {
            if (f.String(t)) return i(e)[s(t)];
            if (f.Array(t)) {
                var n = {}, r = i(e);
                return t.forEach(function(e) {
                    n[e] = r[s(e)];
                }), n;
            }
            for (var o in t) {
                var a = t[o];
                a == parseFloat(a) && (a += "px"), e.style[s(o)] = a;
            }
        }, n;
    }(window || {});
    return e;
});

!function(e, i) {
    "function" == typeof define && define.amd ? define([ "ScrollMagic", "jquery" ], i) : "object" == typeof exports ? i(require("scrollmagic"), require("jquery")) : i(e.ScrollMagic, e.jQuery);
}(this, function(e, i) {
    "use strict";
    e._util.get.elements = function(e) {
        return i(e).toArray();
    }, e._util.addClass = function(e, t) {
        i(e).addClass(t);
    }, e._util.removeClass = function(e, t) {
        i(e).removeClass(t);
    }, i.ScrollMagic = e;
});

!function(e, n) {
    "function" == typeof define && define.amd ? define([ "ScrollMagic", "TweenMax", "TimelineMax" ], n) : "object" == typeof exports ? (require("gsap"), 
    n(require("scrollmagic"), TweenMax, TimelineMax)) : n(e.ScrollMagic || e.jQuery && e.jQuery.ScrollMagic, e.TweenMax || e.TweenLite, e.TimelineMax || e.TimelineLite);
}(this, function(e, n, r) {
    "use strict";
    e.Scene.addOption("tweenChanges", !1, function(e) {
        return !!e;
    }), e.Scene.extend(function() {
        var e, t = this;
        t.on("progress.plugin_gsap", function() {
            i();
        }), t.on("destroy.plugin_gsap", function(e) {
            t.removeTween(e.reset);
        });
        var i = function() {
            if (e) {
                var n = t.progress(), r = t.state();
                e.repeat && -1 === e.repeat() ? "DURING" === r && e.paused() ? e.play() : "DURING" === r || e.paused() || e.pause() : n != e.progress() && (0 === t.duration() ? n > 0 ? e.play() : e.reverse() : t.tweenChanges() && e.tweenTo ? e.tweenTo(n * e.duration()) : e.progress(n).pause());
            }
        };
        t.setTween = function(o, a, s) {
            var u;
            arguments.length > 1 && (arguments.length < 3 && (s = a, a = 1), o = n.to(o, a, s));
            try {
                u = r ? new r({
                    smoothChildTiming: !0
                }).add(o) : o, u.pause();
            } catch (p) {
                return t;
            }
            return e && t.removeTween(), e = u, o.repeat && -1 === o.repeat() && (e.repeat(-1), 
            e.yoyo(o.yoyo())), i(), t;
        }, t.removeTween = function(n) {
            return e && (n && e.progress(0).pause(), e.kill(), e = void 0), t;
        };
    });
});

var objectFitImages = function() {
    "use strict";
    function t(t, e) {
        return "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='" + t + "' height='" + e + "'%3E%3C/svg%3E";
    }
    function e(t) {
        if (t.srcset && !p && window.picturefill) {
            var e = window.picturefill._;
            t[e.ns] && t[e.ns].evaled || e.fillImg(t, {
                reselect: !0
            }), t[e.ns].curSrc || (t[e.ns].supported = !1, e.fillImg(t, {
                reselect: !0
            })), t.currentSrc = t[e.ns].curSrc || t.src;
        }
    }
    function i(t) {
        for (var e, i = getComputedStyle(t).fontFamily, r = {}; null !== (e = u.exec(i)); ) r[e[1]] = e[2];
        return r;
    }
    function r(e, i, r) {
        var n = t(i || 1, r || 0);
        b.call(e, "src") !== n && h.call(e, "src", n);
    }
    function n(t, e) {
        t.naturalWidth ? e(t) : setTimeout(n, 100, t, e);
    }
    function c(t) {
        var c = i(t), o = t[l];
        if (c["object-fit"] = c["object-fit"] || "fill", !o.img) {
            if ("fill" === c["object-fit"]) return;
            if (!o.skipTest && f && !c["object-position"]) return;
        }
        if (!o.img) {
            o.img = new Image(t.width, t.height), o.img.srcset = b.call(t, "data-ofi-srcset") || t.srcset, 
            o.img.src = b.call(t, "data-ofi-src") || t.src, h.call(t, "data-ofi-src", t.src), 
            t.srcset && h.call(t, "data-ofi-srcset", t.srcset), r(t, t.naturalWidth || t.width, t.naturalHeight || t.height), 
            t.srcset && (t.srcset = "");
            try {
                s(t);
            } catch (t) {
                window.console && console.log("http://bit.ly/ofi-old-browser");
            }
        }
        e(o.img), t.style.backgroundImage = 'url("' + (o.img.currentSrc || o.img.src).replace(/"/g, '\\"') + '")', 
        t.style.backgroundPosition = c["object-position"] || "center", t.style.backgroundRepeat = "no-repeat", 
        /scale-down/.test(c["object-fit"]) ? n(o.img, function() {
            o.img.naturalWidth > t.width || o.img.naturalHeight > t.height ? t.style.backgroundSize = "contain" : t.style.backgroundSize = "auto";
        }) : t.style.backgroundSize = c["object-fit"].replace("none", "auto").replace("fill", "100% 100%"), 
        n(o.img, function(e) {
            r(t, e.naturalWidth, e.naturalHeight);
        });
    }
    function s(t) {
        var e = {
            get: function(e) {
                return t[l].img[e ? e : "src"];
            },
            set: function(e, i) {
                return t[l].img[i ? i : "src"] = e, h.call(t, "data-ofi-" + i, e), c(t), e;
            }
        };
        Object.defineProperty(t, "src", e), Object.defineProperty(t, "currentSrc", {
            get: function() {
                return e.get("currentSrc");
            }
        }), Object.defineProperty(t, "srcset", {
            get: function() {
                return e.get("srcset");
            },
            set: function(t) {
                return e.set(t, "srcset");
            }
        });
    }
    function o() {
        function t(t, e) {
            return t[l] && t[l].img && ("src" === e || "srcset" === e) ? t[l].img : t;
        }
        d || (HTMLImageElement.prototype.getAttribute = function(e) {
            return b.call(t(this, e), e);
        }, HTMLImageElement.prototype.setAttribute = function(e, i) {
            return h.call(t(this, e), e, String(i));
        });
    }
    function a(t, e) {
        var i = !y && !t;
        if (e = e || {}, t = t || "img", d && !e.skipTest || !m) return !1;
        "string" == typeof t ? t = document.querySelectorAll(t) : "length" in t || (t = [ t ]);
        for (var r = 0; r < t.length; r++) t[r][l] = t[r][l] || {
            skipTest: e.skipTest
        }, c(t[r]);
        i && (document.body.addEventListener("load", function(t) {
            "IMG" === t.target.tagName && a(t.target, {
                skipTest: e.skipTest
            });
        }, !0), y = !0, t = "img"), e.watchMQ && window.addEventListener("resize", a.bind(null, t, {
            skipTest: e.skipTest
        }));
    }
    var l = "bfred-it:object-fit-images", u = /(object-fit|object-position)\s*:\s*([-\w\s%]+)/g, g = "undefined" == typeof Image ? {
        style: {
            "object-position": 1
        }
    } : new Image(), f = "object-fit" in g.style, d = "object-position" in g.style, m = "background-size" in g.style, p = "string" == typeof g.currentSrc, b = g.getAttribute, h = g.setAttribute, y = !1;
    return a.supportsObjectFit = f, a.supportsObjectPosition = d, o(), a;
}();

!function(a) {
    "function" == typeof define && define.amd ? define([ "jquery" ], a) : a("object" == typeof exports ? require("jquery") : window.jQuery || window.Zepto);
}(function(a) {
    var b, c, d, e, f, g, h = "Close", i = "BeforeClose", j = "AfterClose", k = "BeforeAppend", l = "MarkupParse", m = "Open", n = "Change", o = "mfp", p = "." + o, q = "mfp-ready", r = "mfp-removing", s = "mfp-prevent-close", t = function() {}, u = !!window.jQuery, v = a(window), w = function(a, c) {
        b.ev.on(o + a + p, c);
    }, x = function(b, c, d, e) {
        var f = document.createElement("div");
        return f.className = "mfp-" + b, d && (f.innerHTML = d), e ? c && c.appendChild(f) : (f = a(f), 
        c && f.appendTo(c)), f;
    }, y = function(c, d) {
        b.ev.triggerHandler(o + c, d), b.st.callbacks && (c = c.charAt(0).toLowerCase() + c.slice(1), 
        b.st.callbacks[c] && b.st.callbacks[c].apply(b, a.isArray(d) ? d : [ d ]));
    }, z = function(c) {
        return c === g && b.currTemplate.closeBtn || (b.currTemplate.closeBtn = a(b.st.closeMarkup.replace("%title%", b.st.tClose)), 
        g = c), b.currTemplate.closeBtn;
    }, A = function() {
        a.magnificPopup.instance || (b = new t(), b.init(), a.magnificPopup.instance = b);
    }, B = function() {
        var a = document.createElement("p").style, b = [ "ms", "O", "Moz", "Webkit" ];
        if (void 0 !== a.transition) return !0;
        for (;b.length; ) if (b.pop() + "Transition" in a) return !0;
        return !1;
    };
    t.prototype = {
        constructor: t,
        init: function() {
            var c = navigator.appVersion;
            b.isLowIE = b.isIE8 = document.all && !document.addEventListener, b.isAndroid = /android/gi.test(c), 
            b.isIOS = /iphone|ipad|ipod/gi.test(c), b.supportsTransition = B(), b.probablyMobile = b.isAndroid || b.isIOS || /(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent), 
            d = a(document), b.popupsCache = {};
        },
        open: function(c) {
            var e;
            if (c.isObj === !1) {
                b.items = c.items.toArray(), b.index = 0;
                var g, h = c.items;
                for (e = 0; e < h.length; e++) if (g = h[e], g.parsed && (g = g.el[0]), g === c.el[0]) {
                    b.index = e;
                    break;
                }
            } else b.items = a.isArray(c.items) ? c.items : [ c.items ], b.index = c.index || 0;
            if (b.isOpen) return void b.updateItemHTML();
            b.types = [], f = "", c.mainEl && c.mainEl.length ? b.ev = c.mainEl.eq(0) : b.ev = d, 
            c.key ? (b.popupsCache[c.key] || (b.popupsCache[c.key] = {}), b.currTemplate = b.popupsCache[c.key]) : b.currTemplate = {}, 
            b.st = a.extend(!0, {}, a.magnificPopup.defaults, c), b.fixedContentPos = "auto" === b.st.fixedContentPos ? !b.probablyMobile : b.st.fixedContentPos, 
            b.st.modal && (b.st.closeOnContentClick = !1, b.st.closeOnBgClick = !1, b.st.showCloseBtn = !1, 
            b.st.enableEscapeKey = !1), b.bgOverlay || (b.bgOverlay = x("bg").on("click" + p, function() {
                b.close();
            }), b.wrap = x("wrap").attr("tabindex", -1).on("click" + p, function(a) {
                b._checkIfClose(a.target) && b.close();
            }), b.container = x("container", b.wrap)), b.contentContainer = x("content"), b.st.preloader && (b.preloader = x("preloader", b.container, b.st.tLoading));
            var i = a.magnificPopup.modules;
            for (e = 0; e < i.length; e++) {
                var j = i[e];
                j = j.charAt(0).toUpperCase() + j.slice(1), b["init" + j].call(b);
            }
            y("BeforeOpen"), b.st.showCloseBtn && (b.st.closeBtnInside ? (w(l, function(a, b, c, d) {
                c.close_replaceWith = z(d.type);
            }), f += " mfp-close-btn-in") : b.wrap.append(z())), b.st.alignTop && (f += " mfp-align-top"), 
            b.fixedContentPos ? b.wrap.css({
                overflow: b.st.overflowY,
                overflowX: "hidden",
                overflowY: b.st.overflowY
            }) : b.wrap.css({
                top: v.scrollTop(),
                position: "absolute"
            }), (b.st.fixedBgPos === !1 || "auto" === b.st.fixedBgPos && !b.fixedContentPos) && b.bgOverlay.css({
                height: d.height(),
                position: "absolute"
            }), b.st.enableEscapeKey && d.on("keyup" + p, function(a) {
                27 === a.keyCode && b.close();
            }), v.on("resize" + p, function() {
                b.updateSize();
            }), b.st.closeOnContentClick || (f += " mfp-auto-cursor"), f && b.wrap.addClass(f);
            var k = b.wH = v.height(), n = {};
            if (b.fixedContentPos && b._hasScrollBar(k)) {
                var o = b._getScrollbarSize();
                o && (n.marginRight = o);
            }
            b.fixedContentPos && (b.isIE7 ? a("body, html").css("overflow", "hidden") : n.overflow = "hidden");
            var r = b.st.mainClass;
            return b.isIE7 && (r += " mfp-ie7"), r && b._addClassToMFP(r), b.updateItemHTML(), 
            y("BuildControls"), a("html").css(n), b.bgOverlay.add(b.wrap).prependTo(b.st.prependTo || a(document.body)), 
            b._lastFocusedEl = document.activeElement, setTimeout(function() {
                b.content ? (b._addClassToMFP(q), b._setFocus()) : b.bgOverlay.addClass(q), d.on("focusin" + p, b._onFocusIn);
            }, 16), b.isOpen = !0, b.updateSize(k), y(m), c;
        },
        close: function() {
            b.isOpen && (y(i), b.isOpen = !1, b.st.removalDelay && !b.isLowIE && b.supportsTransition ? (b._addClassToMFP(r), 
            setTimeout(function() {
                b._close();
            }, b.st.removalDelay)) : b._close());
        },
        _close: function() {
            y(h);
            var c = r + " " + q + " ";
            if (b.bgOverlay.detach(), b.wrap.detach(), b.container.empty(), b.st.mainClass && (c += b.st.mainClass + " "), 
            b._removeClassFromMFP(c), b.fixedContentPos) {
                var e = {
                    marginRight: ""
                };
                b.isIE7 ? a("body, html").css("overflow", "") : e.overflow = "", a("html").css(e);
            }
            d.off("keyup" + p + " focusin" + p), b.ev.off(p), b.wrap.attr("class", "mfp-wrap").removeAttr("style"), 
            b.bgOverlay.attr("class", "mfp-bg"), b.container.attr("class", "mfp-container"), 
            !b.st.showCloseBtn || b.st.closeBtnInside && b.currTemplate[b.currItem.type] !== !0 || b.currTemplate.closeBtn && b.currTemplate.closeBtn.detach(), 
            b.st.autoFocusLast && b._lastFocusedEl && a(b._lastFocusedEl).focus(), b.currItem = null, 
            b.content = null, b.currTemplate = null, b.prevHeight = 0, y(j);
        },
        updateSize: function(a) {
            if (b.isIOS) {
                var c = document.documentElement.clientWidth / window.innerWidth, d = window.innerHeight * c;
                b.wrap.css("height", d), b.wH = d;
            } else b.wH = a || v.height();
            b.fixedContentPos || b.wrap.css("height", b.wH), y("Resize");
        },
        updateItemHTML: function() {
            var c = b.items[b.index];
            b.contentContainer.detach(), b.content && b.content.detach(), c.parsed || (c = b.parseEl(b.index));
            var d = c.type;
            if (y("BeforeChange", [ b.currItem ? b.currItem.type : "", d ]), b.currItem = c, 
            !b.currTemplate[d]) {
                var f = b.st[d] ? b.st[d].markup : !1;
                y("FirstMarkupParse", f), f ? b.currTemplate[d] = a(f) : b.currTemplate[d] = !0;
            }
            e && e !== c.type && b.container.removeClass("mfp-" + e + "-holder");
            var g = b["get" + d.charAt(0).toUpperCase() + d.slice(1)](c, b.currTemplate[d]);
            b.appendContent(g, d), c.preloaded = !0, y(n, c), e = c.type, b.container.prepend(b.contentContainer), 
            y("AfterChange");
        },
        appendContent: function(a, c) {
            b.content = a, a ? b.st.showCloseBtn && b.st.closeBtnInside && b.currTemplate[c] === !0 ? b.content.find(".mfp-close").length || b.content.append(z()) : b.content = a : b.content = "", 
            y(k), b.container.addClass("mfp-" + c + "-holder"), b.contentContainer.append(b.content);
        },
        parseEl: function(c) {
            var d, e = b.items[c];
            if (e.tagName ? e = {
                el: a(e)
            } : (d = e.type, e = {
                data: e,
                src: e.src
            }), e.el) {
                for (var f = b.types, g = 0; g < f.length; g++) if (e.el.hasClass("mfp-" + f[g])) {
                    d = f[g];
                    break;
                }
                e.src = e.el.attr("data-mfp-src"), e.src || (e.src = e.el.attr("href"));
            }
            return e.type = d || b.st.type || "inline", e.index = c, e.parsed = !0, b.items[c] = e, 
            y("ElementParse", e), b.items[c];
        },
        addGroup: function(a, c) {
            var d = function(d) {
                d.mfpEl = this, b._openClick(d, a, c);
            };
            c || (c = {});
            var e = "click.magnificPopup";
            c.mainEl = a, c.items ? (c.isObj = !0, a.off(e).on(e, d)) : (c.isObj = !1, c.delegate ? a.off(e).on(e, c.delegate, d) : (c.items = a, 
            a.off(e).on(e, d)));
        },
        _openClick: function(c, d, e) {
            var f = void 0 !== e.midClick ? e.midClick : a.magnificPopup.defaults.midClick;
            if (f || !(2 === c.which || c.ctrlKey || c.metaKey || c.altKey || c.shiftKey)) {
                var g = void 0 !== e.disableOn ? e.disableOn : a.magnificPopup.defaults.disableOn;
                if (g) if (a.isFunction(g)) {
                    if (!g.call(b)) return !0;
                } else if (v.width() < g) return !0;
                c.type && (c.preventDefault(), b.isOpen && c.stopPropagation()), e.el = a(c.mfpEl), 
                e.delegate && (e.items = d.find(e.delegate)), b.open(e);
            }
        },
        updateStatus: function(a, d) {
            if (b.preloader) {
                c !== a && b.container.removeClass("mfp-s-" + c), d || "loading" !== a || (d = b.st.tLoading);
                var e = {
                    status: a,
                    text: d
                };
                y("UpdateStatus", e), a = e.status, d = e.text, b.preloader.html(d), b.preloader.find("a").on("click", function(a) {
                    a.stopImmediatePropagation();
                }), b.container.addClass("mfp-s-" + a), c = a;
            }
        },
        _checkIfClose: function(c) {
            if (!a(c).hasClass(s)) {
                var d = b.st.closeOnContentClick, e = b.st.closeOnBgClick;
                if (d && e) return !0;
                if (!b.content || a(c).hasClass("mfp-close") || b.preloader && c === b.preloader[0]) return !0;
                if (c === b.content[0] || a.contains(b.content[0], c)) {
                    if (d) return !0;
                } else if (e && a.contains(document, c)) return !0;
                return !1;
            }
        },
        _addClassToMFP: function(a) {
            b.bgOverlay.addClass(a), b.wrap.addClass(a);
        },
        _removeClassFromMFP: function(a) {
            this.bgOverlay.removeClass(a), b.wrap.removeClass(a);
        },
        _hasScrollBar: function(a) {
            return (b.isIE7 ? d.height() : document.body.scrollHeight) > (a || v.height());
        },
        _setFocus: function() {
            (b.st.focus ? b.content.find(b.st.focus).eq(0) : b.wrap).focus();
        },
        _onFocusIn: function(c) {
            return c.target === b.wrap[0] || a.contains(b.wrap[0], c.target) ? void 0 : (b._setFocus(), 
            !1);
        },
        _parseMarkup: function(b, c, d) {
            var e;
            d.data && (c = a.extend(d.data, c)), y(l, [ b, c, d ]), a.each(c, function(c, d) {
                if (void 0 === d || d === !1) return !0;
                if (e = c.split("_"), e.length > 1) {
                    var f = b.find(p + "-" + e[0]);
                    if (f.length > 0) {
                        var g = e[1];
                        "replaceWith" === g ? f[0] !== d[0] && f.replaceWith(d) : "img" === g ? f.is("img") ? f.attr("src", d) : f.replaceWith(a("<img>").attr("src", d).attr("class", f.attr("class"))) : f.attr(e[1], d);
                    }
                } else b.find(p + "-" + c).html(d);
            });
        },
        _getScrollbarSize: function() {
            if (void 0 === b.scrollbarSize) {
                var a = document.createElement("div");
                a.style.cssText = "width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;", 
                document.body.appendChild(a), b.scrollbarSize = a.offsetWidth - a.clientWidth, document.body.removeChild(a);
            }
            return b.scrollbarSize;
        }
    }, a.magnificPopup = {
        instance: null,
        proto: t.prototype,
        modules: [],
        open: function(b, c) {
            return A(), b = b ? a.extend(!0, {}, b) : {}, b.isObj = !0, b.index = c || 0, this.instance.open(b);
        },
        close: function() {
            return a.magnificPopup.instance && a.magnificPopup.instance.close();
        },
        registerModule: function(b, c) {
            c.options && (a.magnificPopup.defaults[b] = c.options), a.extend(this.proto, c.proto), 
            this.modules.push(b);
        },
        defaults: {
            disableOn: 0,
            key: null,
            midClick: !1,
            mainClass: "",
            preloader: !0,
            focus: "",
            closeOnContentClick: !1,
            closeOnBgClick: !0,
            closeBtnInside: !0,
            showCloseBtn: !0,
            enableEscapeKey: !0,
            modal: !1,
            alignTop: !1,
            removalDelay: 0,
            prependTo: null,
            fixedContentPos: "auto",
            fixedBgPos: "auto",
            overflowY: "auto",
            closeMarkup: '<button title="%title%" type="button" class="mfp-close">&#215;</button>',
            tClose: "Close (Esc)",
            tLoading: "Loading...",
            autoFocusLast: !0
        }
    }, a.fn.magnificPopup = function(c) {
        A();
        var d = a(this);
        if ("string" == typeof c) if ("open" === c) {
            var e, f = u ? d.data("magnificPopup") : d[0].magnificPopup, g = parseInt(arguments[1], 10) || 0;
            f.items ? e = f.items[g] : (e = d, f.delegate && (e = e.find(f.delegate)), e = e.eq(g)), 
            b._openClick({
                mfpEl: e
            }, d, f);
        } else b.isOpen && b[c].apply(b, Array.prototype.slice.call(arguments, 1)); else c = a.extend(!0, {}, c), 
        u ? d.data("magnificPopup", c) : d[0].magnificPopup = c, b.addGroup(d, c);
        return d;
    };
    var C, D, E, F = "inline", G = function() {
        E && (D.after(E.addClass(C)).detach(), E = null);
    };
    a.magnificPopup.registerModule(F, {
        options: {
            hiddenClass: "hide",
            markup: "",
            tNotFound: "Content not found"
        },
        proto: {
            initInline: function() {
                b.types.push(F), w(h + "." + F, function() {
                    G();
                });
            },
            getInline: function(c, d) {
                if (G(), c.src) {
                    var e = b.st.inline, f = a(c.src);
                    if (f.length) {
                        var g = f[0].parentNode;
                        g && g.tagName && (D || (C = e.hiddenClass, D = x(C), C = "mfp-" + C), E = f.after(D).detach().removeClass(C)), 
                        b.updateStatus("ready");
                    } else b.updateStatus("error", e.tNotFound), f = a("<div>");
                    return c.inlineElement = f, f;
                }
                return b.updateStatus("ready"), b._parseMarkup(d, {}, c), d;
            }
        }
    });
    var H, I = "ajax", J = function() {
        H && a(document.body).removeClass(H);
    }, K = function() {
        J(), b.req && b.req.abort();
    };
    a.magnificPopup.registerModule(I, {
        options: {
            settings: null,
            cursor: "mfp-ajax-cur",
            tError: '<a href="%url%">The content</a> could not be loaded.'
        },
        proto: {
            initAjax: function() {
                b.types.push(I), H = b.st.ajax.cursor, w(h + "." + I, K), w("BeforeChange." + I, K);
            },
            getAjax: function(c) {
                H && a(document.body).addClass(H), b.updateStatus("loading");
                var d = a.extend({
                    url: c.src,
                    success: function(d, e, f) {
                        var g = {
                            data: d,
                            xhr: f
                        };
                        y("ParseAjax", g), b.appendContent(a(g.data), I), c.finished = !0, J(), b._setFocus(), 
                        setTimeout(function() {
                            b.wrap.addClass(q);
                        }, 16), b.updateStatus("ready"), y("AjaxContentAdded");
                    },
                    error: function() {
                        J(), c.finished = c.loadError = !0, b.updateStatus("error", b.st.ajax.tError.replace("%url%", c.src));
                    }
                }, b.st.ajax.settings);
                return b.req = a.ajax(d), "";
            }
        }
    });
    var L, M = function(c) {
        if (c.data && void 0 !== c.data.title) return c.data.title;
        var d = b.st.image.titleSrc;
        if (d) {
            if (a.isFunction(d)) return d.call(b, c);
            if (c.el) return c.el.attr(d) || "";
        }
        return "";
    };
    a.magnificPopup.registerModule("image", {
        options: {
            markup: '<div class="mfp-figure"><div class="mfp-close"></div><figure><div class="mfp-img"></div><figcaption><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></figcaption></figure></div>',
            cursor: "mfp-zoom-out-cur",
            titleSrc: "title",
            verticalFit: !0,
            tError: '<a href="%url%">The image</a> could not be loaded.'
        },
        proto: {
            initImage: function() {
                var c = b.st.image, d = ".image";
                b.types.push("image"), w(m + d, function() {
                    "image" === b.currItem.type && c.cursor && a(document.body).addClass(c.cursor);
                }), w(h + d, function() {
                    c.cursor && a(document.body).removeClass(c.cursor), v.off("resize" + p);
                }), w("Resize" + d, b.resizeImage), b.isLowIE && w("AfterChange", b.resizeImage);
            },
            resizeImage: function() {
                var a = b.currItem;
                if (a && a.img && b.st.image.verticalFit) {
                    var c = 0;
                    b.isLowIE && (c = parseInt(a.img.css("padding-top"), 10) + parseInt(a.img.css("padding-bottom"), 10)), 
                    a.img.css("max-height", b.wH - c);
                }
            },
            _onImageHasSize: function(a) {
                a.img && (a.hasSize = !0, L && clearInterval(L), a.isCheckingImgSize = !1, y("ImageHasSize", a), 
                a.imgHidden && (b.content && b.content.removeClass("mfp-loading"), a.imgHidden = !1));
            },
            findImageSize: function(a) {
                var c = 0, d = a.img[0], e = function(f) {
                    L && clearInterval(L), L = setInterval(function() {
                        return d.naturalWidth > 0 ? void b._onImageHasSize(a) : (c > 200 && clearInterval(L), 
                        c++, void (3 === c ? e(10) : 40 === c ? e(50) : 100 === c && e(500)));
                    }, f);
                };
                e(1);
            },
            getImage: function(c, d) {
                var e = 0, f = function() {
                    c && (c.img[0].complete ? (c.img.off(".mfploader"), c === b.currItem && (b._onImageHasSize(c), 
                    b.updateStatus("ready")), c.hasSize = !0, c.loaded = !0, y("ImageLoadComplete")) : (e++, 
                    200 > e ? setTimeout(f, 100) : g()));
                }, g = function() {
                    c && (c.img.off(".mfploader"), c === b.currItem && (b._onImageHasSize(c), b.updateStatus("error", h.tError.replace("%url%", c.src))), 
                    c.hasSize = !0, c.loaded = !0, c.loadError = !0);
                }, h = b.st.image, i = d.find(".mfp-img");
                if (i.length) {
                    var j = document.createElement("img");
                    j.className = "mfp-img", c.el && c.el.find("img").length && (j.alt = c.el.find("img").attr("alt")), 
                    c.img = a(j).on("load.mfploader", f).on("error.mfploader", g), j.src = c.src, i.is("img") && (c.img = c.img.clone()), 
                    j = c.img[0], j.naturalWidth > 0 ? c.hasSize = !0 : j.width || (c.hasSize = !1);
                }
                return b._parseMarkup(d, {
                    title: M(c),
                    img_replaceWith: c.img
                }, c), b.resizeImage(), c.hasSize ? (L && clearInterval(L), c.loadError ? (d.addClass("mfp-loading"), 
                b.updateStatus("error", h.tError.replace("%url%", c.src))) : (d.removeClass("mfp-loading"), 
                b.updateStatus("ready")), d) : (b.updateStatus("loading"), c.loading = !0, c.hasSize || (c.imgHidden = !0, 
                d.addClass("mfp-loading"), b.findImageSize(c)), d);
            }
        }
    });
    var N, O = function() {
        return void 0 === N && (N = void 0 !== document.createElement("p").style.MozTransform), 
        N;
    };
    a.magnificPopup.registerModule("zoom", {
        options: {
            enabled: !1,
            easing: "ease-in-out",
            duration: 300,
            opener: function(a) {
                return a.is("img") ? a : a.find("img");
            }
        },
        proto: {
            initZoom: function() {
                var a, c = b.st.zoom, d = ".zoom";
                if (c.enabled && b.supportsTransition) {
                    var e, f, g = c.duration, j = function(a) {
                        var b = a.clone().removeAttr("style").removeAttr("class").addClass("mfp-animated-image"), d = "all " + c.duration / 1e3 + "s " + c.easing, e = {
                            position: "fixed",
                            zIndex: 9999,
                            left: 0,
                            top: 0,
                            "-webkit-backface-visibility": "hidden"
                        }, f = "transition";
                        return e["-webkit-" + f] = e["-moz-" + f] = e["-o-" + f] = e[f] = d, b.css(e), b;
                    }, k = function() {
                        b.content.css("visibility", "visible");
                    };
                    w("BuildControls" + d, function() {
                        if (b._allowZoom()) {
                            if (clearTimeout(e), b.content.css("visibility", "hidden"), a = b._getItemToZoom(), 
                            !a) return void k();
                            f = j(a), f.css(b._getOffset()), b.wrap.append(f), e = setTimeout(function() {
                                f.css(b._getOffset(!0)), e = setTimeout(function() {
                                    k(), setTimeout(function() {
                                        f.remove(), a = f = null, y("ZoomAnimationEnded");
                                    }, 16);
                                }, g);
                            }, 16);
                        }
                    }), w(i + d, function() {
                        if (b._allowZoom()) {
                            if (clearTimeout(e), b.st.removalDelay = g, !a) {
                                if (a = b._getItemToZoom(), !a) return;
                                f = j(a);
                            }
                            f.css(b._getOffset(!0)), b.wrap.append(f), b.content.css("visibility", "hidden"), 
                            setTimeout(function() {
                                f.css(b._getOffset());
                            }, 16);
                        }
                    }), w(h + d, function() {
                        b._allowZoom() && (k(), f && f.remove(), a = null);
                    });
                }
            },
            _allowZoom: function() {
                return "image" === b.currItem.type;
            },
            _getItemToZoom: function() {
                return b.currItem.hasSize ? b.currItem.img : !1;
            },
            _getOffset: function(c) {
                var d;
                d = c ? b.currItem.img : b.st.zoom.opener(b.currItem.el || b.currItem);
                var e = d.offset(), f = parseInt(d.css("padding-top"), 10), g = parseInt(d.css("padding-bottom"), 10);
                e.top -= a(window).scrollTop() - f;
                var h = {
                    width: d.width(),
                    height: (u ? d.innerHeight() : d[0].offsetHeight) - g - f
                };
                return O() ? h["-moz-transform"] = h.transform = "translate(" + e.left + "px," + e.top + "px)" : (h.left = e.left, 
                h.top = e.top), h;
            }
        }
    });
    var P = "iframe", Q = "//about:blank", R = function(a) {
        if (b.currTemplate[P]) {
            var c = b.currTemplate[P].find("iframe");
            c.length && (a || (c[0].src = Q), b.isIE8 && c.css("display", a ? "block" : "none"));
        }
    };
    a.magnificPopup.registerModule(P, {
        options: {
            markup: '<div class="mfp-iframe-scaler"><div class="mfp-close"></div><iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe></div>',
            srcAction: "iframe_src",
            patterns: {
                youtube: {
                    index: "youtube.com",
                    id: "v=",
                    src: "//www.youtube.com/embed/%id%?autoplay=1"
                },
                vimeo: {
                    index: "vimeo.com/",
                    id: "/",
                    src: "//player.vimeo.com/video/%id%?autoplay=1"
                },
                gmaps: {
                    index: "//maps.google.",
                    src: "%id%&output=embed"
                }
            }
        },
        proto: {
            initIframe: function() {
                b.types.push(P), w("BeforeChange", function(a, b, c) {
                    b !== c && (b === P ? R() : c === P && R(!0));
                }), w(h + "." + P, function() {
                    R();
                });
            },
            getIframe: function(c, d) {
                var e = c.src, f = b.st.iframe;
                a.each(f.patterns, function() {
                    return e.indexOf(this.index) > -1 ? (this.id && (e = "string" == typeof this.id ? e.substr(e.lastIndexOf(this.id) + this.id.length, e.length) : this.id.call(this, e)), 
                    e = this.src.replace("%id%", e), !1) : void 0;
                });
                var g = {};
                return f.srcAction && (g[f.srcAction] = e), b._parseMarkup(d, g, c), b.updateStatus("ready"), 
                d;
            }
        }
    });
    var S = function(a) {
        var c = b.items.length;
        return a > c - 1 ? a - c : 0 > a ? c + a : a;
    }, T = function(a, b, c) {
        return a.replace(/%curr%/gi, b + 1).replace(/%total%/gi, c);
    };
    a.magnificPopup.registerModule("gallery", {
        options: {
            enabled: !1,
            arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
            preload: [ 0, 2 ],
            navigateByImgClick: !0,
            arrows: !0,
            tPrev: "Previous (Left arrow key)",
            tNext: "Next (Right arrow key)",
            tCounter: "%curr% of %total%"
        },
        proto: {
            initGallery: function() {
                var c = b.st.gallery, e = ".mfp-gallery";
                return b.direction = !0, c && c.enabled ? (f += " mfp-gallery", w(m + e, function() {
                    c.navigateByImgClick && b.wrap.on("click" + e, ".mfp-img", function() {
                        return b.items.length > 1 ? (b.next(), !1) : void 0;
                    }), d.on("keydown" + e, function(a) {
                        37 === a.keyCode ? b.prev() : 39 === a.keyCode && b.next();
                    });
                }), w("UpdateStatus" + e, function(a, c) {
                    c.text && (c.text = T(c.text, b.currItem.index, b.items.length));
                }), w(l + e, function(a, d, e, f) {
                    var g = b.items.length;
                    e.counter = g > 1 ? T(c.tCounter, f.index, g) : "";
                }), w("BuildControls" + e, function() {
                    if (b.items.length > 1 && c.arrows && !b.arrowLeft) {
                        var d = c.arrowMarkup, e = b.arrowLeft = a(d.replace(/%title%/gi, c.tPrev).replace(/%dir%/gi, "left")).addClass(s), f = b.arrowRight = a(d.replace(/%title%/gi, c.tNext).replace(/%dir%/gi, "right")).addClass(s);
                        e.click(function() {
                            b.prev();
                        }), f.click(function() {
                            b.next();
                        }), b.container.append(e.add(f));
                    }
                }), w(n + e, function() {
                    b._preloadTimeout && clearTimeout(b._preloadTimeout), b._preloadTimeout = setTimeout(function() {
                        b.preloadNearbyImages(), b._preloadTimeout = null;
                    }, 16);
                }), void w(h + e, function() {
                    d.off(e), b.wrap.off("click" + e), b.arrowRight = b.arrowLeft = null;
                })) : !1;
            },
            next: function() {
                b.direction = !0, b.index = S(b.index + 1), b.updateItemHTML();
            },
            prev: function() {
                b.direction = !1, b.index = S(b.index - 1), b.updateItemHTML();
            },
            goTo: function(a) {
                b.direction = a >= b.index, b.index = a, b.updateItemHTML();
            },
            preloadNearbyImages: function() {
                var a, c = b.st.gallery.preload, d = Math.min(c[0], b.items.length), e = Math.min(c[1], b.items.length);
                for (a = 1; a <= (b.direction ? e : d); a++) b._preloadItem(b.index + a);
                for (a = 1; a <= (b.direction ? d : e); a++) b._preloadItem(b.index - a);
            },
            _preloadItem: function(c) {
                if (c = S(c), !b.items[c].preloaded) {
                    var d = b.items[c];
                    d.parsed || (d = b.parseEl(c)), y("LazyLoad", d), "image" === d.type && (d.img = a('<img class="mfp-img" />').on("load.mfploader", function() {
                        d.hasSize = !0;
                    }).on("error.mfploader", function() {
                        d.hasSize = !0, d.loadError = !0, y("LazyLoadError", d);
                    }).attr("src", d.src)), d.preloaded = !0;
                }
            }
        }
    });
    var U = "retina";
    a.magnificPopup.registerModule(U, {
        options: {
            replaceSrc: function(a) {
                return a.src.replace(/\.\w+$/, function(a) {
                    return "@2x" + a;
                });
            },
            ratio: 1
        },
        proto: {
            initRetina: function() {
                if (window.devicePixelRatio > 1) {
                    var a = b.st.retina, c = a.ratio;
                    c = isNaN(c) ? c() : c, c > 1 && (w("ImageHasSize." + U, function(a, b) {
                        b.img.css({
                            "max-width": b.img[0].naturalWidth / c,
                            width: "100%"
                        });
                    }), w("ElementParse." + U, function(b, d) {
                        d.src = a.replaceSrc(d, c);
                    }));
                }
            }
        }
    }), A();
});

(function(e, t, n) {
    typeof define == "function" && define.amd ? define([ "jquery" ], function(r) {
        return n(r, e, t), r.mobile;
    }) : n(e.jQuery, e, t);
})(this, document, function(e, t, n, r) {
    (function(e, t, n, r) {
        function T(e) {
            while (e && typeof e.originalEvent != "undefined") e = e.originalEvent;
            return e;
        }
        function N(t, n) {
            var i = t.type, s, o, a, l, c, h, p, d, v;
            t = e.Event(t), t.type = n, s = t.originalEvent, o = e.event.props, i.search(/^(mouse|click)/) > -1 && (o = f);
            if (s) for (p = o.length, l; p; ) l = o[--p], t[l] = s[l];
            i.search(/mouse(down|up)|click/) > -1 && !t.which && (t.which = 1);
            if (i.search(/^touch/) !== -1) {
                a = T(s), i = a.touches, c = a.changedTouches, h = i && i.length ? i[0] : c && c.length ? c[0] : r;
                if (h) for (d = 0, v = u.length; d < v; d++) l = u[d], t[l] = h[l];
            }
            return t;
        }
        function C(t) {
            var n = {}, r, s;
            while (t) {
                r = e.data(t, i);
                for (s in r) r[s] && (n[s] = n.hasVirtualBinding = !0);
                t = t.parentNode;
            }
            return n;
        }
        function k(t, n) {
            var r;
            while (t) {
                r = e.data(t, i);
                if (r && (!n || r[n])) return t;
                t = t.parentNode;
            }
            return null;
        }
        function L() {
            g = !1;
        }
        function A() {
            g = !0;
        }
        function O() {
            E = 0, v.length = 0, m = !1, A();
        }
        function M() {
            L();
        }
        function _() {
            D(), c = setTimeout(function() {
                c = 0, O();
            }, e.vmouse.resetTimerDuration);
        }
        function D() {
            c && (clearTimeout(c), c = 0);
        }
        function P(t, n, r) {
            var i;
            if (r && r[t] || !r && k(n.target, t)) i = N(n, t), e(n.target).trigger(i);
            return i;
        }
        function H(t) {
            var n = e.data(t.target, s), r;
            !m && (!E || E !== n) && (r = P("v" + t.type, t), r && (r.isDefaultPrevented() && t.preventDefault(), 
            r.isPropagationStopped() && t.stopPropagation(), r.isImmediatePropagationStopped() && t.stopImmediatePropagation()));
        }
        function B(t) {
            var n = T(t).touches, r, i, o;
            n && n.length === 1 && (r = t.target, i = C(r), i.hasVirtualBinding && (E = w++, 
            e.data(r, s, E), D(), M(), d = !1, o = T(t).touches[0], h = o.pageX, p = o.pageY, 
            P("vmouseover", t, i), P("vmousedown", t, i)));
        }
        function j(e) {
            if (g) return;
            d || P("vmousecancel", e, C(e.target)), d = !0, _();
        }
        function F(t) {
            if (g) return;
            var n = T(t).touches[0], r = d, i = e.vmouse.moveDistanceThreshold, s = C(t.target);
            d = d || Math.abs(n.pageX - h) > i || Math.abs(n.pageY - p) > i, d && !r && P("vmousecancel", t, s), 
            P("vmousemove", t, s), _();
        }
        function I(e) {
            if (g) return;
            A();
            var t = C(e.target), n, r;
            P("vmouseup", e, t), d || (n = P("vclick", e, t), n && n.isDefaultPrevented() && (r = T(e).changedTouches[0], 
            v.push({
                touchID: E,
                x: r.clientX,
                y: r.clientY
            }), m = !0)), P("vmouseout", e, t), d = !1, _();
        }
        function q(t) {
            var n = e.data(t, i), r;
            if (n) for (r in n) if (n[r]) return !0;
            return !1;
        }
        function R() {}
        function U(t) {
            var n = t.substr(1);
            return {
                setup: function() {
                    q(this) || e.data(this, i, {});
                    var r = e.data(this, i);
                    r[t] = !0, l[t] = (l[t] || 0) + 1, l[t] === 1 && b.bind(n, H), e(this).bind(n, R), 
                    y && (l.touchstart = (l.touchstart || 0) + 1, l.touchstart === 1 && b.bind("touchstart", B).bind("touchend", I).bind("touchmove", F).bind("scroll", j));
                },
                teardown: function() {
                    --l[t], l[t] || b.unbind(n, H), y && (--l.touchstart, l.touchstart || b.unbind("touchstart", B).unbind("touchmove", F).unbind("touchend", I).unbind("scroll", j));
                    var r = e(this), s = e.data(this, i);
                    s && (s[t] = !1), r.unbind(n, R), q(this) || r.removeData(i);
                }
            };
        }
        var i = "virtualMouseBindings", s = "virtualTouchID", o = "vmouseover vmousedown vmousemove vmouseup vclick vmouseout vmousecancel".split(" "), u = "clientX clientY pageX pageY screenX screenY".split(" "), a = e.event.mouseHooks ? e.event.mouseHooks.props : [], f = e.event.props.concat(a), l = {}, c = 0, h = 0, p = 0, d = !1, v = [], m = !1, g = !1, y = "addEventListener" in n, b = e(n), w = 1, E = 0, S, x;
        e.vmouse = {
            moveDistanceThreshold: 10,
            clickDistanceThreshold: 10,
            resetTimerDuration: 1500
        };
        for (x = 0; x < o.length; x++) e.event.special[o[x]] = U(o[x]);
        y && n.addEventListener("click", function(t) {
            var n = v.length, r = t.target, i, o, u, a, f, l;
            if (n) {
                i = t.clientX, o = t.clientY, S = e.vmouse.clickDistanceThreshold, u = r;
                while (u) {
                    for (a = 0; a < n; a++) {
                        f = v[a], l = 0;
                        if (u === r && Math.abs(f.x - i) < S && Math.abs(f.y - o) < S || e.data(u, s) === f.touchID) {
                            t.preventDefault(), t.stopPropagation();
                            return;
                        }
                    }
                    u = u.parentNode;
                }
            }
        }, !0);
    })(e, t, n);
});

jQuery(document).ready(function($) {
    var dragging = false, scrolling = false, resizing = false;
    var imageComparisonContainers = $('.cd-image-container');
    checkPosition(imageComparisonContainers);
    $(window).on('scroll', function() {
        if (!scrolling) {
            scrolling = true;
            !window.requestAnimationFrame ? setTimeout(function() {
                checkPosition(imageComparisonContainers);
            }, 100) : requestAnimationFrame(function() {
                checkPosition(imageComparisonContainers);
            });
        }
    });
    imageComparisonContainers.each(function() {
        var actual = $(this);
        drags(actual.find('.cd-handle'), actual.find('.cd-resize-img'), actual, actual.find('.cd-image-label[data-type="original"]'), actual.find('.cd-image-label[data-type="modified"]'));
    });
    $(window).on('resize', function() {
        if (!resizing) {
            resizing = true;
            !window.requestAnimationFrame ? setTimeout(function() {
                checkLabel(imageComparisonContainers);
            }, 100) : requestAnimationFrame(function() {
                checkLabel(imageComparisonContainers);
            });
        }
    });
    function checkPosition(container) {
        container.each(function() {
            var actualContainer = $(this);
            if ($(window).scrollTop() + $(window).height() * .5 > actualContainer.offset().top) {
                actualContainer.addClass('is-visible');
            }
        });
        scrolling = false;
    }
    function checkLabel(container) {
        container.each(function() {
            var actual = $(this);
            updateLabel(actual.find('.cd-image-label[data-type="modified"]'), actual.find('.cd-resize-img'), 'left');
            updateLabel(actual.find('.cd-image-label[data-type="original"]'), actual.find('.cd-resize-img'), 'right');
        });
        resizing = false;
    }
    function drags(dragElement, resizeElement, container, labelContainer, labelResizeElement) {
        dragElement.on("mousedown vmousedown", function(e) {
            dragElement.addClass('draggable');
            resizeElement.addClass('resizable');
            var dragWidth = dragElement.outerWidth(), xPosition = dragElement.offset().left + dragWidth - e.pageX, containerOffset = container.offset().left, containerWidth = container.outerWidth(), minLeft = containerOffset + 10, maxLeft = containerOffset + containerWidth - dragWidth - 10;
            dragElement.parents().on("mousemove vmousemove", function(e) {
                if (!dragging) {
                    dragging = true;
                    !window.requestAnimationFrame ? setTimeout(function() {
                        animateDraggedHandle(e, xPosition, dragWidth, minLeft, maxLeft, containerOffset, containerWidth, resizeElement, labelContainer, labelResizeElement);
                    }, 100) : requestAnimationFrame(function() {
                        animateDraggedHandle(e, xPosition, dragWidth, minLeft, maxLeft, containerOffset, containerWidth, resizeElement, labelContainer, labelResizeElement);
                    });
                }
            }).on("mouseup vmouseup", function(e) {
                dragElement.removeClass('draggable');
                resizeElement.removeClass('resizable');
            });
            e.preventDefault();
        }).on("mouseup vmouseup", function(e) {
            dragElement.removeClass('draggable');
            resizeElement.removeClass('resizable');
        });
    }
    function animateDraggedHandle(e, xPosition, dragWidth, minLeft, maxLeft, containerOffset, containerWidth, resizeElement, labelContainer, labelResizeElement) {
        var leftValue = e.pageX + xPosition - dragWidth;
        if (leftValue < minLeft) {
            leftValue = minLeft;
        } else if (leftValue > maxLeft) {
            leftValue = maxLeft;
        }
        var widthValue = (leftValue + dragWidth / 2 - containerOffset) * 100 / containerWidth + '%';
        $('.draggable').css('left', widthValue).on("mouseup vmouseup", function() {
            $(this).removeClass('draggable');
            resizeElement.removeClass('resizable');
        });
        $('.resizable').css('width', widthValue);
        updateLabel(labelResizeElement, resizeElement, 'left');
        updateLabel(labelContainer, resizeElement, 'right');
        dragging = false;
    }
    function updateLabel(label, resizeElement, position) {
        if (position == 'left') {
            label.offset().left + label.outerWidth() < resizeElement.offset().left + resizeElement.outerWidth() ? label.removeClass('is-hidden') : label.addClass('is-hidden');
        } else {
            label.offset().left > resizeElement.offset().left + resizeElement.outerWidth() ? label.removeClass('is-hidden') : label.addClass('is-hidden');
        }
    }
});

(function($, window, document, undefined) {
    var pluginName = "panr", defaults = {
        sensitivity: 30,
        scale: true,
        scaleOnHover: false,
        scaleTo: 1.1,
        scaleDuration: .25,
        panY: true,
        panX: true,
        panDuration: 1.25,
        resetPanOnMouseLeave: false,
        onEnter: function() {},
        onLeave: function() {}
    };
    function Plugin(element, options) {
        this.element = element;
        this.settings = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }
    Plugin.prototype = {
        init: function() {
            var settings = this.settings, target = $(this.element), w = target.width(), h = target.height(), targetWidth = target.width() - settings.sensitivity, cx = (w - targetWidth) / targetWidth, x, y, panVars, xPanVars, yPanVars, mouseleaveVars;
            if (settings.scale || !settings.scaleOnHover && settings.scale) {
                TweenMax.set(target, {
                    scale: settings.scaleTo
                });
            }
            if (jQuery.type(settings.moveTarget) === "string") {
                settings.moveTarget = $(this.element).parents(settings.moveTarget);
            }
            if (!settings.moveTarget) {
                settings.moveTarget = $(this.element);
            }
            settings.moveTarget.on('mousemove', function(e) {
                x = e.pageX - target.offset().left;
                y = e.pageY - target.offset().top;
                if (settings.panX) {
                    xPanVars = {
                        x: -cx * x
                    };
                }
                if (settings.panY) {
                    yPanVars = {
                        y: -cx * y
                    };
                }
                panVars = $.extend({}, xPanVars, yPanVars);
                TweenMax.to(target, settings.panDuration, panVars);
            });
            settings.moveTarget.on('mouseenter', function(e) {
                $(this).addClass('mouse-in');
                if (settings.scaleOnHover) {
                    TweenMax.to(target, settings.scaleDuration, {
                        scale: settings.scaleTo
                    });
                }
                settings.onEnter(target);
            });
            if (!settings.scale || !settings.scaleOnHover && !settings.scale) {
                mouseleaveVars = {
                    scale: 1,
                    x: 0,
                    y: 0
                };
            } else {
                if (settings.resetPanOnMouseLeave) {
                    mouseleaveVars = {
                        x: 0,
                        y: 0
                    };
                }
            }
            settings.moveTarget.on('mouseleave', function(e) {
                $(this).removeClass('mouse-in');
                TweenMax.to(target, settings.scaleDuration, mouseleaveVars);
                settings.onLeave(target);
            });
        }
    };
    $.fn[pluginName] = function(options) {
        return this.each(function() {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName, new Plugin(this, options));
            }
        });
    };
})(jQuery, window, document);

!function() {
    "use strict";
    var a = !1;
    window.JQClass = function() {}, JQClass.classes = {}, JQClass.extend = function b(c) {
        function d() {
            !a && this._init && this._init.apply(this, arguments);
        }
        var e = this.prototype;
        a = !0;
        var f = new this();
        a = !1;
        for (var g in c) if ("function" == typeof c[g] && "function" == typeof e[g]) f[g] = function(a, b) {
            return function() {
                var c = this._super;
                this._super = function(b) {
                    return e[a].apply(this, b || []);
                };
                var d = b.apply(this, arguments);
                return this._super = c, d;
            };
        }(g, c[g]); else if ("object" == typeof c[g] && "object" == typeof e[g] && "defaultOptions" === g) {
            var h, i = e[g], j = c[g], k = {};
            for (h in i) k[h] = i[h];
            for (h in j) k[h] = j[h];
            f[g] = k;
        } else f[g] = c[g];
        return d.prototype = f, d.prototype.constructor = d, d.extend = b, d;
    };
}(), function($) {
    "use strict";
    function camelCase(a) {
        return a.replace(/-([a-z])/g, function(a, b) {
            return b.toUpperCase();
        });
    }
    JQClass.classes.JQPlugin = JQClass.extend({
        name: "plugin",
        defaultOptions: {},
        regionalOptions: {},
        deepMerge: !0,
        _getMarker: function() {
            return "is-" + this.name;
        },
        _init: function() {
            $.extend(this.defaultOptions, this.regionalOptions && this.regionalOptions[""] || {});
            var a = camelCase(this.name);
            $[a] = this, $.fn[a] = function(b) {
                var c = Array.prototype.slice.call(arguments, 1), d = this, e = this;
                return this.each(function() {
                    if ("string" == typeof b) {
                        if ("_" === b[0] || !$[a][b]) throw "Unknown method: " + b;
                        var f = $[a][b].apply($[a], [ this ].concat(c));
                        if (f !== d && void 0 !== f) return e = f, !1;
                    } else $[a]._attach(this, b);
                }), e;
            };
        },
        setDefaults: function(a) {
            $.extend(this.defaultOptions, a || {});
        },
        _attach: function(a, b) {
            if (a = $(a), !a.hasClass(this._getMarker())) {
                a.addClass(this._getMarker()), b = $.extend(this.deepMerge, {}, this.defaultOptions, this._getMetadata(a), b || {});
                var c = $.extend({
                    name: this.name,
                    elem: a,
                    options: b
                }, this._instSettings(a, b));
                a.data(this.name, c), this._postAttach(a, c), this.option(a, b);
            }
        },
        _instSettings: function(a, b) {
            return {};
        },
        _postAttach: function(a, b) {},
        _getMetadata: function(elem) {
            try {
                var data = elem.data(this.name.toLowerCase()) || "";
                data = data.replace(/(\\?)'/g, function(a, b) {
                    return b ? "'" : '"';
                }).replace(/([a-zA-Z0-9]+):/g, function(a, b, c) {
                    var d = data.substring(0, c).match(/"/g);
                    return d && d.length % 2 !== 0 ? b + ":" : '"' + b + '":';
                }).replace(/\\:/g, ":"), data = $.parseJSON("{" + data + "}");
                for (var key in data) if (data.hasOwnProperty(key)) {
                    var value = data[key];
                    "string" == typeof value && value.match(/^new Date\(([-0-9,\s]*)\)$/) && (data[key] = eval(value));
                }
                return data;
            } catch (a) {
                return {};
            }
        },
        _getInst: function(a) {
            return $(a).data(this.name) || {};
        },
        option: function(a, b, c) {
            a = $(a);
            var d = a.data(this.name), e = b || {};
            return !b || "string" == typeof b && "undefined" == typeof c ? (e = (d || {}).options, 
            e && b ? e[b] : e) : void (a.hasClass(this._getMarker()) && ("string" == typeof b && (e = {}, 
            e[b] = c), this._optionsChanged(a, d, e), $.extend(d.options, e)));
        },
        _optionsChanged: function(a, b, c) {},
        destroy: function(a) {
            a = $(a), a.hasClass(this._getMarker()) && (this._preDestroy(a, this._getInst(a)), 
            a.removeData(this.name).removeClass(this._getMarker()));
        },
        _preDestroy: function(a, b) {}
    }), $.JQPlugin = {
        createPlugin: function(a, b) {
            "object" == typeof a && (b = a, a = "JQPlugin"), a = camelCase(a);
            var c = camelCase(b.name);
            JQClass.classes[c] = JQClass.classes[a].extend(b), new JQClass.classes[c]();
        }
    };
}(jQuery);

!function(a) {
    "use strict";
    var b = "countdown", c = 0, d = 1, e = 2, f = 3, g = 4, h = 5, i = 6;
    a.JQPlugin.createPlugin({
        name: b,
        defaultOptions: {
            until: null,
            since: null,
            timezone: null,
            serverSync: null,
            format: "dHMS",
            layout: "",
            compact: !1,
            padZeroes: !1,
            significant: 0,
            description: "",
            expiryUrl: "",
            expiryText: "",
            alwaysExpire: !1,
            onExpiry: null,
            onTick: null,
            tickInterval: 1
        },
        regionalOptions: {
            "": {
                labels: [ "Years", "Months", "Weeks", "Days", "Hours", "Minutes", "Seconds" ],
                labels1: [ "Year", "Month", "Week", "Day", "Hour", "Minute", "Second" ],
                compactLabels: [ "y", "m", "w", "d" ],
                whichLabels: null,
                digits: [ "0", "1", "2", "3", "4", "5", "6", "7", "8", "9" ],
                timeSeparator: ":",
                isRTL: !1
            }
        },
        _rtlClass: b + "-rtl",
        _sectionClass: b + "-section",
        _amountClass: b + "-amount",
        _periodClass: b + "-period",
        _rowClass: b + "-row",
        _holdingClass: b + "-holding",
        _showClass: b + "-show",
        _descrClass: b + "-descr",
        _timerElems: [],
        _init: function() {
            function b(a) {
                var h = a < 1e12 ? e ? window.performance.now() + window.performance.timing.navigationStart : d() : a || d();
                h - g >= 1e3 && (c._updateElems(), g = h), f(b);
            }
            var c = this;
            this._super(), this._serverSyncs = [];
            var d = "function" == typeof Date.now ? Date.now : function() {
                return new Date().getTime();
            }, e = window.performance && "function" == typeof window.performance.now, f = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || null, g = 0;
            !f || a.noRequestAnimationFrame ? (a.noRequestAnimationFrame = null, a.countdown._timer = setInterval(function() {
                c._updateElems();
            }, 1e3)) : (g = window.animationStartTime || window.webkitAnimationStartTime || window.mozAnimationStartTime || window.oAnimationStartTime || window.msAnimationStartTime || d(), 
            f(b));
        },
        UTCDate: function(a, b, c, d, e, f, g, h) {
            "object" == typeof b && b instanceof Date && (h = b.getMilliseconds(), g = b.getSeconds(), 
            f = b.getMinutes(), e = b.getHours(), d = b.getDate(), c = b.getMonth(), b = b.getFullYear());
            var i = new Date();
            return i.setUTCFullYear(b), i.setUTCDate(1), i.setUTCMonth(c || 0), i.setUTCDate(d || 1), 
            i.setUTCHours(e || 0), i.setUTCMinutes((f || 0) - (Math.abs(a) < 30 ? 60 * a : a)), 
            i.setUTCSeconds(g || 0), i.setUTCMilliseconds(h || 0), i;
        },
        periodsToSeconds: function(a) {
            return 31557600 * a[0] + 2629800 * a[1] + 604800 * a[2] + 86400 * a[3] + 3600 * a[4] + 60 * a[5] + a[6];
        },
        resync: function() {
            var b = this;
            a("." + this._getMarker()).each(function() {
                var c = a.data(this, b.name);
                if (c.options.serverSync) {
                    for (var d = null, e = 0; e < b._serverSyncs.length; e++) if (b._serverSyncs[e][0] === c.options.serverSync) {
                        d = b._serverSyncs[e];
                        break;
                    }
                    if (b._eqNull(d[2])) {
                        var f = a.isFunction(c.options.serverSync) ? c.options.serverSync.apply(this, []) : null;
                        d[2] = (f ? new Date().getTime() - f.getTime() : 0) - d[1];
                    }
                    c._since && c._since.setMilliseconds(c._since.getMilliseconds() + d[2]), c._until.setMilliseconds(c._until.getMilliseconds() + d[2]);
                }
            });
            for (var c = 0; c < b._serverSyncs.length; c++) b._eqNull(b._serverSyncs[c][2]) || (b._serverSyncs[c][1] += b._serverSyncs[c][2], 
            delete b._serverSyncs[c][2]);
        },
        _instSettings: function(a, b) {
            return {
                _periods: [ 0, 0, 0, 0, 0, 0, 0 ]
            };
        },
        _addElem: function(a) {
            this._hasElem(a) || this._timerElems.push(a);
        },
        _hasElem: function(b) {
            return a.inArray(b, this._timerElems) > -1;
        },
        _removeElem: function(b) {
            this._timerElems = a.map(this._timerElems, function(a) {
                return a === b ? null : a;
            });
        },
        _updateElems: function() {
            for (var a = this._timerElems.length - 1; a >= 0; a--) this._updateCountdown(this._timerElems[a]);
        },
        _optionsChanged: function(b, c, d) {
            d.layout && (d.layout = d.layout.replace(/&lt;/g, "<").replace(/&gt;/g, ">")), this._resetExtraLabels(c.options, d);
            var e = c.options.timezone !== d.timezone;
            a.extend(c.options, d), this._adjustSettings(b, c, !this._eqNull(d.until) || !this._eqNull(d.since) || e);
            var f = new Date();
            (c._since && c._since < f || c._until && c._until > f) && this._addElem(b[0]), this._updateCountdown(b, c);
        },
        _updateCountdown: function(b, c) {
            if (b = b.jquery ? b : a(b), c = c || this._getInst(b)) {
                if (b.html(this._generateHTML(c)).toggleClass(this._rtlClass, c.options.isRTL), 
                "pause" !== c._hold && a.isFunction(c.options.onTick)) {
                    var d = "lap" !== c._hold ? c._periods : this._calculatePeriods(c, c._show, c.options.significant, new Date());
                    1 !== c.options.tickInterval && this.periodsToSeconds(d) % c.options.tickInterval !== 0 || c.options.onTick.apply(b[0], [ d ]);
                }
                var e = "pause" !== c._hold && (c._since ? c._now.getTime() < c._since.getTime() : c._now.getTime() >= c._until.getTime());
                if (e && !c._expiring) {
                    if (c._expiring = !0, this._hasElem(b[0]) || c.options.alwaysExpire) {
                        if (this._removeElem(b[0]), a.isFunction(c.options.onExpiry) && c.options.onExpiry.apply(b[0], []), 
                        c.options.expiryText) {
                            var f = c.options.layout;
                            c.options.layout = c.options.expiryText, this._updateCountdown(b[0], c), c.options.layout = f;
                        }
                        c.options.expiryUrl && (window.location = c.options.expiryUrl);
                    }
                    c._expiring = !1;
                } else "pause" === c._hold && this._removeElem(b[0]);
            }
        },
        _resetExtraLabels: function(a, b) {
            var c = null;
            for (c in b) c.match(/[Ll]abels[02-9]|compactLabels1/) && (a[c] = b[c]);
            for (c in a) c.match(/[Ll]abels[02-9]|compactLabels1/) && "undefined" == typeof b[c] && (a[c] = null);
        },
        _eqNull: function(a) {
            return "undefined" == typeof a || null === a;
        },
        _adjustSettings: function(b, c, d) {
            for (var e = null, f = 0; f < this._serverSyncs.length; f++) if (this._serverSyncs[f][0] === c.options.serverSync) {
                e = this._serverSyncs[f][1];
                break;
            }
            var g = null, h = null;
            if (this._eqNull(e)) {
                var i = a.isFunction(c.options.serverSync) ? c.options.serverSync.apply(b[0], []) : null;
                g = new Date(), h = i ? g.getTime() - i.getTime() : 0, this._serverSyncs.push([ c.options.serverSync, h ]);
            } else g = new Date(), h = c.options.serverSync ? e : 0;
            var j = c.options.timezone;
            j = this._eqNull(j) ? -g.getTimezoneOffset() : j, (d || !d && this._eqNull(c._until) && this._eqNull(c._since)) && (c._since = c.options.since, 
            this._eqNull(c._since) || (c._since = this.UTCDate(j, this._determineTime(c._since, null)), 
            c._since && h && c._since.setMilliseconds(c._since.getMilliseconds() + h)), c._until = this.UTCDate(j, this._determineTime(c.options.until, g)), 
            h && c._until.setMilliseconds(c._until.getMilliseconds() + h)), c._show = this._determineShow(c);
        },
        _preDestroy: function(a, b) {
            this._removeElem(a[0]), a.empty();
        },
        pause: function(a) {
            this._hold(a, "pause");
        },
        lap: function(a) {
            this._hold(a, "lap");
        },
        resume: function(a) {
            this._hold(a, null);
        },
        toggle: function(b) {
            var c = a.data(b, this.name) || {};
            this[c._hold ? "resume" : "pause"](b);
        },
        toggleLap: function(b) {
            var c = a.data(b, this.name) || {};
            this[c._hold ? "resume" : "lap"](b);
        },
        _hold: function(b, c) {
            var d = a.data(b, this.name);
            if (d) {
                if ("pause" === d._hold && !c) {
                    d._periods = d._savePeriods;
                    var e = d._since ? "-" : "+";
                    d[d._since ? "_since" : "_until"] = this._determineTime(e + d._periods[0] + "y" + e + d._periods[1] + "o" + e + d._periods[2] + "w" + e + d._periods[3] + "d" + e + d._periods[4] + "h" + e + d._periods[5] + "m" + e + d._periods[6] + "s"), 
                    this._addElem(b);
                }
                d._hold = c, d._savePeriods = "pause" === c ? d._periods : null, a.data(b, this.name, d), 
                this._updateCountdown(b, d);
            }
        },
        getTimes: function(b) {
            var c = a.data(b, this.name);
            return c ? "pause" === c._hold ? c._savePeriods : c._hold ? this._calculatePeriods(c, c._show, c.options.significant, new Date()) : c._periods : null;
        },
        _determineTime: function(a, b) {
            var c = this, d = function(a) {
                var b = new Date();
                return b.setTime(b.getTime() + 1e3 * a), b;
            }, e = function(a) {
                a = a.toLowerCase();
                for (var b = new Date(), d = b.getFullYear(), e = b.getMonth(), f = b.getDate(), g = b.getHours(), h = b.getMinutes(), i = b.getSeconds(), j = /([+-]?[0-9]+)\s*(s|m|h|d|w|o|y)?/g, k = j.exec(a); k; ) {
                    switch (k[2] || "s") {
                      case "s":
                        i += parseInt(k[1], 10);
                        break;

                      case "m":
                        h += parseInt(k[1], 10);
                        break;

                      case "h":
                        g += parseInt(k[1], 10);
                        break;

                      case "d":
                        f += parseInt(k[1], 10);
                        break;

                      case "w":
                        f += 7 * parseInt(k[1], 10);
                        break;

                      case "o":
                        e += parseInt(k[1], 10), f = Math.min(f, c._getDaysInMonth(d, e));
                        break;

                      case "y":
                        d += parseInt(k[1], 10), f = Math.min(f, c._getDaysInMonth(d, e));
                    }
                    k = j.exec(a);
                }
                return new Date(d, e, f, g, h, i, 0);
            }, f = this._eqNull(a) ? b : "string" == typeof a ? e(a) : "number" == typeof a ? d(a) : a;
            return f && f.setMilliseconds(0), f;
        },
        _getDaysInMonth: function(a, b) {
            return 32 - new Date(a, b, 32).getDate();
        },
        _normalLabels: function(a) {
            return a;
        },
        _generateHTML: function(b) {
            var j = this;
            b._periods = b._hold ? b._periods : this._calculatePeriods(b, b._show, b.options.significant, new Date());
            var k = !1, l = 0, m = b.options.significant, n = a.extend({}, b._show), o = null;
            for (o = c; o <= i; o++) k = k || "?" === b._show[o] && b._periods[o] > 0, n[o] = "?" !== b._show[o] || k ? b._show[o] : null, 
            l += n[o] ? 1 : 0, m -= b._periods[o] > 0 ? 1 : 0;
            var p = [ !1, !1, !1, !1, !1, !1, !1 ];
            for (o = i; o >= c; o--) b._show[o] && (b._periods[o] ? p[o] = !0 : (p[o] = m > 0, 
            m--));
            var q = b.options.compact ? b.options.compactLabels : b.options.labels, r = b.options.whichLabels || this._normalLabels, s = function(a) {
                var c = b.options["compactLabels" + r(b._periods[a])];
                return n[a] ? j._translateDigits(b, b._periods[a]) + (c ? c[a] : q[a]) + " " : "";
            }, t = b.options.padZeroes ? 2 : 1, u = function(a) {
                var c = b.options["labels" + r(b._periods[a])];
                return !b.options.significant && n[a] || b.options.significant && p[a] ? '<span class="' + j._sectionClass + '"><span class="' + j._amountClass + '">' + j._minDigits(b, b._periods[a], t) + '</span><span class="' + j._periodClass + '">' + (c ? c[a] : q[a]) + "</span></span>" : "";
            };
            return b.options.layout ? this._buildLayout(b, n, b.options.layout, b.options.compact, b.options.significant, p) : (b.options.compact ? '<span class="' + this._rowClass + " " + this._amountClass + (b._hold ? " " + this._holdingClass : "") + '">' + s(c) + s(d) + s(e) + s(f) + (n[g] ? this._minDigits(b, b._periods[g], 2) : "") + (n[h] ? (n[g] ? b.options.timeSeparator : "") + this._minDigits(b, b._periods[h], 2) : "") + (n[i] ? (n[g] || n[h] ? b.options.timeSeparator : "") + this._minDigits(b, b._periods[i], 2) : "") : '<span class="' + this._rowClass + " " + this._showClass + (b.options.significant || l) + (b._hold ? " " + this._holdingClass : "") + '">' + u(c) + u(d) + u(e) + u(f) + u(g) + u(h) + u(i)) + "</span>" + (b.options.description ? '<span class="' + this._rowClass + " " + this._descrClass + '">' + b.options.description + "</span>" : "");
        },
        _buildLayout: function(b, j, k, l, m, n) {
            for (var o = b.options[l ? "compactLabels" : "labels"], p = b.options.whichLabels || this._normalLabels, q = function(a) {
                return (b.options[(l ? "compactLabels" : "labels") + p(b._periods[a])] || o)[a];
            }, r = function(a, c) {
                return b.options.digits[Math.floor(a / c) % 10];
            }, s = {
                desc: b.options.description,
                sep: b.options.timeSeparator,
                yl: q(c),
                yn: this._minDigits(b, b._periods[c], 1),
                ynn: this._minDigits(b, b._periods[c], 2),
                ynnn: this._minDigits(b, b._periods[c], 3),
                y1: r(b._periods[c], 1),
                y10: r(b._periods[c], 10),
                y100: r(b._periods[c], 100),
                y1000: r(b._periods[c], 1e3),
                ol: q(d),
                on: this._minDigits(b, b._periods[d], 1),
                onn: this._minDigits(b, b._periods[d], 2),
                onnn: this._minDigits(b, b._periods[d], 3),
                o1: r(b._periods[d], 1),
                o10: r(b._periods[d], 10),
                o100: r(b._periods[d], 100),
                o1000: r(b._periods[d], 1e3),
                wl: q(e),
                wn: this._minDigits(b, b._periods[e], 1),
                wnn: this._minDigits(b, b._periods[e], 2),
                wnnn: this._minDigits(b, b._periods[e], 3),
                w1: r(b._periods[e], 1),
                w10: r(b._periods[e], 10),
                w100: r(b._periods[e], 100),
                w1000: r(b._periods[e], 1e3),
                dl: q(f),
                dn: this._minDigits(b, b._periods[f], 1),
                dnn: this._minDigits(b, b._periods[f], 2),
                dnnn: this._minDigits(b, b._periods[f], 3),
                d1: r(b._periods[f], 1),
                d10: r(b._periods[f], 10),
                d100: r(b._periods[f], 100),
                d1000: r(b._periods[f], 1e3),
                hl: q(g),
                hn: this._minDigits(b, b._periods[g], 1),
                hnn: this._minDigits(b, b._periods[g], 2),
                hnnn: this._minDigits(b, b._periods[g], 3),
                h1: r(b._periods[g], 1),
                h10: r(b._periods[g], 10),
                h100: r(b._periods[g], 100),
                h1000: r(b._periods[g], 1e3),
                ml: q(h),
                mn: this._minDigits(b, b._periods[h], 1),
                mnn: this._minDigits(b, b._periods[h], 2),
                mnnn: this._minDigits(b, b._periods[h], 3),
                m1: r(b._periods[h], 1),
                m10: r(b._periods[h], 10),
                m100: r(b._periods[h], 100),
                m1000: r(b._periods[h], 1e3),
                sl: q(i),
                sn: this._minDigits(b, b._periods[i], 1),
                snn: this._minDigits(b, b._periods[i], 2),
                snnn: this._minDigits(b, b._periods[i], 3),
                s1: r(b._periods[i], 1),
                s10: r(b._periods[i], 10),
                s100: r(b._periods[i], 100),
                s1000: r(b._periods[i], 1e3)
            }, t = k, u = c; u <= i; u++) {
                var v = "yowdhms".charAt(u), w = new RegExp("\\{" + v + "<\\}([\\s\\S]*)\\{" + v + ">\\}", "g");
                t = t.replace(w, !m && j[u] || m && n[u] ? "$1" : "");
            }
            return a.each(s, function(a, b) {
                var c = new RegExp("\\{" + a + "\\}", "g");
                t = t.replace(c, b);
            }), t;
        },
        _minDigits: function(a, b, c) {
            return b = "" + b, b.length >= c ? this._translateDigits(a, b) : (b = "0000000000" + b, 
            this._translateDigits(a, b.substr(b.length - c)));
        },
        _translateDigits: function(a, b) {
            return ("" + b).replace(/[0-9]/g, function(b) {
                return a.options.digits[b];
            });
        },
        _determineShow: function(a) {
            var b = a.options.format, j = [];
            return j[c] = b.match("y") ? "?" : b.match("Y") ? "!" : null, j[d] = b.match("o") ? "?" : b.match("O") ? "!" : null, 
            j[e] = b.match("w") ? "?" : b.match("W") ? "!" : null, j[f] = b.match("d") ? "?" : b.match("D") ? "!" : null, 
            j[g] = b.match("h") ? "?" : b.match("H") ? "!" : null, j[h] = b.match("m") ? "?" : b.match("M") ? "!" : null, 
            j[i] = b.match("s") ? "?" : b.match("S") ? "!" : null, j;
        },
        _calculatePeriods: function(a, b, j, k) {
            a._now = k, a._now.setMilliseconds(0);
            var l = new Date(a._now.getTime());
            a._since ? k.getTime() < a._since.getTime() ? a._now = k = l : k = a._since : (l.setTime(a._until.getTime()), 
            k.getTime() > a._until.getTime() && (a._now = k = l));
            var m = [ 0, 0, 0, 0, 0, 0, 0 ];
            if (b[c] || b[d]) {
                var n = this._getDaysInMonth(k.getFullYear(), k.getMonth()), o = this._getDaysInMonth(l.getFullYear(), l.getMonth()), p = l.getDate() === k.getDate() || l.getDate() >= Math.min(n, o) && k.getDate() >= Math.min(n, o), q = function(a) {
                    return 60 * (60 * a.getHours() + a.getMinutes()) + a.getSeconds();
                }, r = Math.max(0, 12 * (l.getFullYear() - k.getFullYear()) + l.getMonth() - k.getMonth() + (l.getDate() < k.getDate() && !p || p && q(l) < q(k) ? -1 : 0));
                m[c] = b[c] ? Math.floor(r / 12) : 0, m[d] = b[d] ? r - 12 * m[c] : 0, k = new Date(k.getTime());
                var s = k.getDate() === n, t = this._getDaysInMonth(k.getFullYear() + m[c], k.getMonth() + m[d]);
                k.getDate() > t && k.setDate(t), k.setFullYear(k.getFullYear() + m[c]), k.setMonth(k.getMonth() + m[d]), 
                s && k.setDate(t);
            }
            var u = Math.floor((l.getTime() - k.getTime()) / 1e3), v = null, w = function(a, c) {
                m[a] = b[a] ? Math.floor(u / c) : 0, u -= m[a] * c;
            };
            if (w(e, 604800), w(f, 86400), w(g, 3600), w(h, 60), w(i, 1), u > 0 && !a._since) {
                var x = [ 1, 12, 4.3482, 7, 24, 60, 60 ], y = i, z = 1;
                for (v = i; v >= c; v--) b[v] && (m[y] >= z && (m[y] = 0, u = 1), u > 0 && (m[v]++, 
                u = 0, y = v, z = 1)), z *= x[v];
            }
            if (j) for (v = c; v <= i; v++) j && m[v] ? j-- : j || (m[v] = 0);
            return m;
        }
    });
}(jQuery);

!function(t) {
    "use strict";
    var s = function(s, e) {
        this.el = t(s), this.options = t.extend({}, t.fn.typed.defaults, e), this.isInput = this.el.is("input"), 
        this.attr = this.options.attr, this.showCursor = this.isInput ? !1 : this.options.showCursor, 
        this.elContent = this.attr ? this.el.attr(this.attr) : this.el.text(), this.contentType = this.options.contentType, 
        this.typeSpeed = this.options.typeSpeed, this.startDelay = this.options.startDelay, 
        this.backSpeed = this.options.backSpeed, this.backDelay = this.options.backDelay, 
        this.stringsElement = this.options.stringsElement, this.strings = this.options.strings, 
        this.strPos = 0, this.arrayPos = 0, this.stopNum = 0, this.loop = this.options.loop, 
        this.loopCount = this.options.loopCount, this.curLoop = 0, this.stop = !1, this.cursorChar = this.options.cursorChar, 
        this.shuffle = this.options.shuffle, this.sequence = [], this.build();
    };
    s.prototype = {
        constructor: s,
        init: function() {
            var t = this;
            t.timeout = setTimeout(function() {
                for (var s = 0; s < t.strings.length; ++s) t.sequence[s] = s;
                t.shuffle && (t.sequence = t.shuffleArray(t.sequence)), t.typewrite(t.strings[t.sequence[t.arrayPos]], t.strPos);
            }, t.startDelay);
        },
        build: function() {
            var s = this;
            if (this.showCursor === !0 && (this.cursor = t('<span class="typed-cursor">' + this.cursorChar + "</span>"), 
            this.el.after(this.cursor)), this.stringsElement) {
                this.strings = [], this.stringsElement.hide(), console.log(this.stringsElement.children());
                var e = this.stringsElement.children();
                t.each(e, function(e, i) {
                    s.strings.push(t(i).html());
                });
            }
            this.init();
        },
        typewrite: function(t, s) {
            if (this.stop !== !0) {
                var e = Math.round(70 * Math.random()) + this.typeSpeed, i = this;
                i.timeout = setTimeout(function() {
                    var e = 0, r = t.substr(s);
                    if ("^" === r.charAt(0)) {
                        var o = 1;
                        /^\^\d+/.test(r) && (r = /\d+/.exec(r)[0], o += r.length, e = parseInt(r)), t = t.substring(0, s) + t.substring(s + o);
                    }
                    if ("html" === i.contentType) {
                        var n = t.substr(s).charAt(0);
                        if ("<" === n || "&" === n) {
                            var a = "", h = "";
                            for (h = "<" === n ? ">" : ";"; t.substr(s + 1).charAt(0) !== h && (a += t.substr(s).charAt(0), 
                            s++, !(s + 1 > t.length)); ) ;
                            s++, a += h;
                        }
                    }
                    i.timeout = setTimeout(function() {
                        if (s === t.length) {
                            if (i.options.onStringTyped(i.arrayPos), i.arrayPos === i.strings.length - 1 && (i.options.callback(), 
                            i.curLoop++, i.loop === !1 || i.curLoop === i.loopCount)) return;
                            i.timeout = setTimeout(function() {
                                i.backspace(t, s);
                            }, i.backDelay);
                        } else {
                            0 === s && i.options.preStringTyped(i.arrayPos);
                            var e = t.substr(0, s + 1);
                            i.attr ? i.el.attr(i.attr, e) : i.isInput ? i.el.val(e) : "html" === i.contentType ? i.el.html(e) : i.el.text(e), 
                            s++, i.typewrite(t, s);
                        }
                    }, e);
                }, e);
            }
        },
        backspace: function(t, s) {
            if (this.stop !== !0) {
                var e = Math.round(70 * Math.random()) + this.backSpeed, i = this;
                i.timeout = setTimeout(function() {
                    if ("html" === i.contentType && ">" === t.substr(s).charAt(0)) {
                        for (var e = ""; "<" !== t.substr(s - 1).charAt(0) && (e -= t.substr(s).charAt(0), 
                        s--, !(0 > s)); ) ;
                        s--, e += "<";
                    }
                    var r = t.substr(0, s);
                    i.attr ? i.el.attr(i.attr, r) : i.isInput ? i.el.val(r) : "html" === i.contentType ? i.el.html(r) : i.el.text(r), 
                    s > i.stopNum ? (s--, i.backspace(t, s)) : s <= i.stopNum && (i.arrayPos++, i.arrayPos === i.strings.length ? (i.arrayPos = 0, 
                    i.shuffle && (i.sequence = i.shuffleArray(i.sequence)), i.init()) : i.typewrite(i.strings[i.sequence[i.arrayPos]], s));
                }, e);
            }
        },
        shuffleArray: function(t) {
            var s, e, i = t.length;
            if (i) for (;--i; ) e = Math.floor(Math.random() * (i + 1)), s = t[e], t[e] = t[i], 
            t[i] = s;
            return t;
        },
        reset: function() {
            var t = this;
            clearInterval(t.timeout);
            this.el.attr("id");
            this.el.empty(), "undefined" != typeof this.cursor && this.cursor.remove(), this.strPos = 0, 
            this.arrayPos = 0, this.curLoop = 0, this.options.resetCallback();
        }
    }, t.fn.typed = function(e) {
        return this.each(function() {
            var i = t(this), r = i.data("typed"), o = "object" == typeof e && e;
            r && r.reset(), i.data("typed", r = new s(this, o)), "string" == typeof e && r[e]();
        });
    }, t.fn.typed.defaults = {
        strings: [ "These are the default values...", "You know what you should do?", "Use your own!", "Have a great day!" ],
        stringsElement: null,
        typeSpeed: 0,
        startDelay: 0,
        backSpeed: 0,
        shuffle: !1,
        backDelay: 500,
        loop: !1,
        loopCount: !1,
        showCursor: !0,
        cursorChar: "|",
        attr: null,
        contentType: "html",
        callback: function() {},
        preStringTyped: function() {},
        onStringTyped: function() {},
        resetCallback: function() {}
    };
}(window.jQuery);

!function(t, n) {
    "use strict";
    "function" == typeof define && define.amd ? define([], n) : "object" == typeof exports && "undefined" != typeof module ? module.exports = n() : t.Headroom = n();
}(this, function() {
    "use strict";
    function t(t) {
        this.callback = t, this.ticking = !1;
    }
    function n(t) {
        return t && "undefined" != typeof window && (t === window || t.nodeType);
    }
    function o(t) {
        if (arguments.length <= 0) throw new Error("Missing arguments in extend function");
        var i, e, s = t || {};
        for (e = 1; e < arguments.length; e++) {
            var r = arguments[e] || {};
            for (i in r) "object" != typeof s[i] || n(s[i]) ? s[i] = s[i] || r[i] : s[i] = o(s[i], r[i]);
        }
        return s;
    }
    function i(t) {
        return t === Object(t) ? t : {
            down: t,
            up: t
        };
    }
    function e(t, n) {
        n = o(n, e.options), this.lastKnownScrollY = 0, this.elem = t, this.tolerance = i(n.tolerance), 
        this.classes = n.classes, this.offset = n.offset, this.scroller = n.scroller, this.initialised = !1, 
        this.onPin = n.onPin, this.onUnpin = n.onUnpin, this.onTop = n.onTop, this.onNotTop = n.onNotTop, 
        this.onBottom = n.onBottom, this.onNotBottom = n.onNotBottom;
    }
    var s = {
        bind: !!function() {}.bind,
        classList: "classList" in document.documentElement,
        rAF: !!(window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame)
    };
    return window.requestAnimationFrame = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame, 
    t.prototype = {
        constructor: t,
        update: function() {
            this.callback && this.callback(), this.ticking = !1;
        },
        requestTick: function() {
            this.ticking || (requestAnimationFrame(this.rafCallback || (this.rafCallback = this.update.bind(this))), 
            this.ticking = !0);
        },
        handleEvent: function() {
            this.requestTick();
        }
    }, e.prototype = {
        constructor: e,
        init: function() {
            return e.cutsTheMustard ? (this.debouncer = new t(this.update.bind(this)), this.elem.classList.add(this.classes.initial), 
            setTimeout(this.attachEvent.bind(this), 100), this) : void 0;
        },
        destroy: function() {
            var t = this.classes;
            this.initialised = !1, this.elem.classList.remove(t.unpinned, t.pinned, t.top, t.notTop, t.initial), 
            this.scroller.removeEventListener("scroll", this.debouncer, !1);
        },
        attachEvent: function() {
            this.initialised || (this.lastKnownScrollY = this.getScrollY(), this.initialised = !0, 
            this.scroller.addEventListener("scroll", this.debouncer, !1), this.debouncer.handleEvent());
        },
        unpin: function() {
            var t = this.elem.classList, n = this.classes;
            (t.contains(n.pinned) || !t.contains(n.unpinned)) && (t.add(n.unpinned), t.remove(n.pinned), 
            this.onUnpin && this.onUnpin.call(this));
        },
        pin: function() {
            var t = this.elem.classList, n = this.classes;
            t.contains(n.unpinned) && (t.remove(n.unpinned), t.add(n.pinned), this.onPin && this.onPin.call(this));
        },
        top: function() {
            var t = this.elem.classList, n = this.classes;
            t.contains(n.top) || (t.add(n.top), t.remove(n.notTop), this.onTop && this.onTop.call(this));
        },
        notTop: function() {
            var t = this.elem.classList, n = this.classes;
            t.contains(n.notTop) || (t.add(n.notTop), t.remove(n.top), this.onNotTop && this.onNotTop.call(this));
        },
        bottom: function() {
            var t = this.elem.classList, n = this.classes;
            t.contains(n.bottom) || (t.add(n.bottom), t.remove(n.notBottom), this.onBottom && this.onBottom.call(this));
        },
        notBottom: function() {
            var t = this.elem.classList, n = this.classes;
            t.contains(n.notBottom) || (t.add(n.notBottom), t.remove(n.bottom), this.onNotBottom && this.onNotBottom.call(this));
        },
        getScrollY: function() {
            return void 0 !== this.scroller.pageYOffset ? this.scroller.pageYOffset : void 0 !== this.scroller.scrollTop ? this.scroller.scrollTop : (document.documentElement || document.body.parentNode || document.body).scrollTop;
        },
        getViewportHeight: function() {
            return window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
        },
        getElementPhysicalHeight: function(t) {
            return Math.max(t.offsetHeight, t.clientHeight);
        },
        getScrollerPhysicalHeight: function() {
            return this.scroller === window || this.scroller === document.body ? this.getViewportHeight() : this.getElementPhysicalHeight(this.scroller);
        },
        getDocumentHeight: function() {
            var t = document.body, n = document.documentElement;
            return Math.max(t.scrollHeight, n.scrollHeight, t.offsetHeight, n.offsetHeight, t.clientHeight, n.clientHeight);
        },
        getElementHeight: function(t) {
            return Math.max(t.scrollHeight, t.offsetHeight, t.clientHeight);
        },
        getScrollerHeight: function() {
            return this.scroller === window || this.scroller === document.body ? this.getDocumentHeight() : this.getElementHeight(this.scroller);
        },
        isOutOfBounds: function(t) {
            var n = 0 > t, o = t + this.getScrollerPhysicalHeight() > this.getScrollerHeight();
            return n || o;
        },
        toleranceExceeded: function(t, n) {
            return Math.abs(t - this.lastKnownScrollY) >= this.tolerance[n];
        },
        shouldUnpin: function(t, n) {
            var o = t > this.lastKnownScrollY, i = t >= this.offset;
            return o && i && n;
        },
        shouldPin: function(t, n) {
            var o = t < this.lastKnownScrollY, i = t <= this.offset;
            return o && n || i;
        },
        update: function() {
            var t = this.getScrollY(), n = t > this.lastKnownScrollY ? "down" : "up", o = this.toleranceExceeded(t, n);
            this.isOutOfBounds(t) || (t <= this.offset ? this.top() : this.notTop(), t + this.getViewportHeight() >= this.getScrollerHeight() ? this.bottom() : this.notBottom(), 
            this.shouldUnpin(t, o) ? this.unpin() : this.shouldPin(t, o) && this.pin(), this.lastKnownScrollY = t);
        }
    }, e.options = {
        tolerance: {
            up: 0,
            down: 0
        },
        offset: 0,
        scroller: window,
        classes: {
            pinned: "headroom--pinned",
            unpinned: "headroom--unpinned",
            top: "headroom--top",
            notTop: "headroom--not-top",
            bottom: "headroom--bottom",
            notBottom: "headroom--not-bottom",
            initial: "headroom"
        }
    }, e.cutsTheMustard = "undefined" != typeof s && s.rAF && s.bind && s.classList, 
    e;
});

!function(n, i, t) {
    "use strict";
    var e = i.Modernizr, s = n("body");
    n.DLMenu = function(i, t) {
        this.$el = n(t), this._init(i);
    }, n.DLMenu.defaults = {
        animationClasses: {
            classin: "dl-animate-in-1",
            classout: "dl-animate-out-1"
        },
        onLevelClick: function(n, i) {
            return !1;
        },
        onLinkClick: function(n, i) {
            return !1;
        },
        backLabel: "Back",
        useActiveItemAsBackLabel: !1,
        useActiveItemAsLink: !1,
        resetOnClose: !0
    }, n.DLMenu.prototype = {
        _init: function(i) {
            this.options = n.extend(!0, {}, n.DLMenu.defaults, i), this._config();
            var t = {
                WebkitAnimation: "webkitAnimationEnd",
                OAnimation: "oAnimationEnd",
                msAnimation: "MSAnimationEnd",
                animation: "animationend"
            }, s = {
                WebkitTransition: "webkitTransitionEnd",
                MozTransition: "transitionend",
                OTransition: "oTransitionEnd",
                msTransition: "MSTransitionEnd",
                transition: "transitionend"
            };
            this.animEndEventName = t[e.prefixed("animation")] + ".dlmenu", this.transEndEventName = s[e.prefixed("transition")] + ".dlmenu", 
            this.supportAnimations = e.cssanimations, this.supportTransitions = e.csstransitions, 
            this._initEvents();
        },
        _config: function() {
            this.open = !1, this.$trigger = n(".main-bar").children(".module-nav-trigger:not(.hidden-lg)"), 
            this.$menu = n(".main-bar").find("ul.main-nav"), this.$menuitems = this.$menu.find("li:not(.dl-back)"), 
            this.$el.find("ul.nav-item-children").prepend('<li class="dl-back"><a href="#">' + this.options.backLabel + "</a></li>"), 
            this.$back = this.$menu.find("li.dl-back"), this.options.useActiveItemAsBackLabel && this.$back.each(function() {
                var i = n(this), t = i.parents("li:first").find("a:first").text();
                i.find("a").html(t);
            }), this.options.useActiveItemAsLink && this.$el.find("ul.nav-item-children").prepend(function() {
                var i = n(this).parents("li:not(.dl-back):first").find("a:first");
                return '<li class="dl-parent"><a href="' + i.attr("href") + '">' + i.text() + "</a></li>";
            });
        },
        _initEvents: function() {
            var i = this;
            this.$trigger.on("click.dlmenu", function() {
                return i.open ? i._closeMenu() : (i._openMenu(), s.off("click").children().on("click.dlmenu", function() {})), 
                !1;
            }), this.$menuitems.on("click.dlmenu", function(t) {
                t.stopPropagation();
                var e = n(this), s = e.children("ul.nav-item-children");
                if (s.length > 0 && !n(t.currentTarget).hasClass("dl-subviewopen")) {
                    var a = s.clone().css("opacity", 0).insertAfter(i.$menu), o = function() {
                        i.$menu.off(i.animEndEventName).removeClass(i.options.animationClasses.classout).addClass("dl-subview"), 
                        e.addClass("dl-subviewopen").parents(".dl-subviewopen:first").removeClass("dl-subviewopen").addClass("dl-subview"), 
                        a.remove();
                    };
                    return setTimeout(function() {
                        a.addClass(i.options.animationClasses.classin), i.$menu.addClass(i.options.animationClasses.classout), 
                        i.supportAnimations ? i.$menu.on(i.animEndEventName, o) : o.call(), i.options.onLevelClick(e, e.children("a:first").text());
                    }), !1;
                }
                i.options.onLinkClick(e, t);
            }), this.$back.on("click.dlmenu", function(t) {
                var e = n(this), s = e.parents("ul.nav-item-children:first"), a = s.parent(), o = s.clone().insertAfter(i.$menu), l = function() {
                    i.$menu.off(i.animEndEventName).removeClass(i.options.animationClasses.classin), 
                    o.remove();
                };
                return setTimeout(function() {
                    o.addClass(i.options.animationClasses.classout), i.$menu.addClass(i.options.animationClasses.classin), 
                    i.supportAnimations ? i.$menu.on(i.animEndEventName, l) : l.call(), a.removeClass("dl-subviewopen");
                    var n = e.parents(".dl-subview:first");
                    n.is("li") && n.addClass("dl-subviewopen"), n.removeClass("dl-subview");
                }), !1;
            });
        },
        closeMenu: function() {
            this.open && this._closeMenu();
        },
        _closeMenu: function() {
            var n = this, i = function() {
                n.$menu.off(n.transEndEventName), n.options.resetOnClose && n._resetMenu();
            };
            this.$menu.removeClass("dl-menuopen"), this.$menu.addClass("dl-menu-toggle"), this.$trigger.removeClass("dl-active"), 
            this.supportTransitions ? this.$menu.on(this.transEndEventName, i) : i.call(), this.open = !1;
        },
        openMenu: function() {
            this.open || this._openMenu();
        },
        _openMenu: function() {
            s.off("click").on("click.dlmenu", function() {}), this.$menu.addClass("dl-menuopen dl-menu-toggle").on(this.transEndEventName, function() {
                n(this).removeClass("dl-menu-toggle");
            }), this.$trigger.addClass("dl-active"), this.open = !0;
        },
        _resetMenu: function() {
            this.$menu.removeClass("dl-subview"), this.$menuitems.removeClass("dl-subview dl-subviewopen");
        }
    };
    var a = function(n) {
        i.console && i.console.error(n);
    };
    n.fn.dlmenu = function(i) {
        if ("string" == typeof i) {
            var t = Array.prototype.slice.call(arguments, 1);
            this.each(function() {
                var e = n.data(this, "dlmenu");
                return e ? n.isFunction(e[i]) && "_" !== i.charAt(0) ? void e[i].apply(e, t) : void a("no such method '" + i + "' for dlmenu instance") : void a("cannot call methods on dlmenu prior to initialization; attempted to call method '" + i + "'");
            });
        } else this.each(function() {
            var t = n.data(this, "dlmenu");
            t ? t._init() : t = n.data(this, "dlmenu", new n.DLMenu(i, this));
        });
        return this;
    };
}(jQuery, window);

!function() {
    function t(t) {
        var e = parseInt(t, 10);
        return e > s ? s : e;
    }
    function e(t) {
        return t.hasAttribute("data-no-resize") || (0 === t.offsetWidth && 0 === t.offsetHeight ? (t.setAttribute("width", t.naturalWidth), 
        t.setAttribute("height", t.naturalHeight)) : (t.setAttribute("width", t.offsetWidth), 
        t.setAttribute("height", t.offsetHeight))), t;
    }
    function r(t, r) {
        var n = t.nodeName.toLowerCase(), i = document.createElement("img");
        i.addEventListener("load", function() {
            "img" === n ? e(t).setAttribute("src", r) : t.style.backgroundImage = "url(" + r + ")";
        }), i.setAttribute("src", r);
    }
    function n(e, n) {
        var i = arguments.length <= 2 || void 0 === arguments[2] ? 1 : arguments[2], o = t(i);
        if (n && o > 1) {
            var a = n.replace(f, "@" + o + "x$1");
            r(e, a);
        }
    }
    function i(t, e, n) {
        s > 1 && r(t, n);
    }
    function o() {
        return "undefined" != typeof document ? Array.prototype.slice.call(document.querySelectorAll(l)) : [];
    }
    function a(t) {
        return t.style.backgroundImage.replace(c, "$2");
    }
    function u() {
        o().forEach(function(t) {
            var e = "img" === t.nodeName.toLowerCase(), r = e ? t.getAttribute("src") : a(t), o = t.getAttribute("data-rjs"), u = !isNaN(parseInt(o, 10));
            u ? n(t, r, o) : i(t, r, o);
        });
    }
    "undefined" == typeof exports && (exports = {}), Object.defineProperty(exports, "__esModule", {
        value: !0
    });
    var d = "undefined" != typeof window, s = d ? window.devicePixelRatio || 1 : 1, f = /(\.[A-z]{3,4}\/?(\?.*)?)$/, c = /url\(('|")?([^\)'"]+)('|")?\)/i, l = "[data-rjs]";
    d && (window.addEventListener("load", u), window.retinajs = u), exports["default"] = u;
}();

(function() {
    var b, f;
    b = this.jQuery || window.jQuery;
    f = b(window);
    b.fn.stick_in_parent = function(d) {
        var A, w, J, n, B, K, p, q, k, E, t;
        null == d && (d = {});
        t = d.sticky_class;
        B = d.inner_scrolling;
        E = d.recalc_every;
        k = d.parent;
        q = d.offset_top;
        p = d.spacer;
        w = d.bottoming;
        null == q && (q = 0);
        null == k && (k = void 0);
        null == B && (B = !0);
        null == t && (t = "is_stuck");
        A = b(document);
        null == w && (w = !0);
        J = function(a, d, n, C, F, u, r, G) {
            var v, H, m, D, I, c, g, x, y, z, h, l;
            if (!a.data("sticky_kit")) {
                a.data("sticky_kit", !0);
                I = A.height();
                g = a.parent();
                null != k && (g = g.closest(k));
                if (!g.length) throw "failed to find stick parent";
                v = m = !1;
                (h = null != p ? p && a.closest(p) : b("<div />")) && h.css("position", a.css("position"));
                x = function() {
                    var c, f, e;
                    if (!G && (I = A.height(), c = parseInt(g.css("border-top-width"), 10), f = parseInt(g.css("padding-top"), 10), 
                    d = parseInt(g.css("padding-bottom"), 10), n = g.offset().top + c + f, C = g.height(), 
                    m && (v = m = !1, null == p && (a.insertAfter(h), h.detach()), a.css({
                        position: "",
                        top: "",
                        width: "",
                        bottom: ""
                    }).removeClass(t), e = !0), F = a.offset().top - (parseInt(a.css("margin-top"), 10) || 0) - q, 
                    u = a.outerHeight(!0), r = a.css("float"), h && h.css({
                        width: a.outerWidth(!0),
                        height: u,
                        display: a.css("display"),
                        "vertical-align": a.css("vertical-align"),
                        float: r
                    }), e)) return l();
                };
                x();
                if (u !== C) return D = void 0, c = q, z = E, l = function() {
                    var b, l, e, k;
                    if (!G && (e = !1, null != z && (--z, 0 >= z && (z = E, x(), e = !0)), e || A.height() === I || x(), 
                    e = f.scrollTop(), null != D && (l = e - D), D = e, m ? (w && (k = e + u + c > C + n, 
                    v && !k && (v = !1, a.css({
                        position: "fixed",
                        bottom: "",
                        top: c
                    }).trigger("sticky_kit:unbottom"))), e < F && (m = !1, c = q, null == p && ("left" !== r && "right" !== r || a.insertAfter(h), 
                    h.detach()), b = {
                        position: "",
                        width: "",
                        top: ""
                    }, a.css(b).removeClass(t).trigger("sticky_kit:unstick")), B && (b = f.height(), 
                    u + q > b && !v && (c -= l, c = Math.max(b - u, c), c = Math.min(q, c), m && a.css({
                        top: c + "px"
                    })))) : e > F && (m = !0, b = {
                        position: "fixed",
                        top: c
                    }, b.width = "border-box" === a.css("box-sizing") ? a.outerWidth() + "px" : a.width() + "px", 
                    a.css(b).addClass(t), null == p && (a.after(h), "left" !== r && "right" !== r || h.append(a)), 
                    a.trigger("sticky_kit:stick")), m && w && (null == k && (k = e + u + c > C + n), 
                    !v && k))) return v = !0, "static" === g.css("position") && g.css({
                        position: "relative"
                    }), a.css({
                        position: "absolute",
                        bottom: d,
                        top: "auto"
                    }).trigger("sticky_kit:bottom");
                }, y = function() {
                    x();
                    return l();
                }, H = function() {
                    G = !0;
                    f.off("touchmove", l);
                    f.off("scroll", l);
                    f.off("resize", y);
                    b(document.body).off("sticky_kit:recalc", y);
                    a.off("sticky_kit:detach", H);
                    a.removeData("sticky_kit");
                    a.css({
                        position: "",
                        bottom: "",
                        top: "",
                        width: ""
                    });
                    g.position("position", "");
                    if (m) return null == p && ("left" !== r && "right" !== r || a.insertAfter(h), h.remove()), 
                    a.removeClass(t);
                }, f.on("touchmove", l), f.on("scroll", l), f.on("resize", y), b(document.body).on("sticky_kit:recalc", y), 
                a.on("sticky_kit:detach", H), setTimeout(l, 0);
            }
        };
        n = 0;
        for (K = this.length; n < K; n++) d = this[n], J(b(d));
        return this;
    };
}).call(this);