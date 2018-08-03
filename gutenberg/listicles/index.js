"use strict";

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

(function (wpI18n, wpBlocks, wpElement, wpEditor, wpComponents) {
    var __ = wpI18n.__;
    var Component = wpElement.Component,
        Fragment = wpElement.Fragment;
    var registerBlockType = wpBlocks.registerBlockType;
    var RichText = wpEditor.RichText,
        InnerBlocks = wpEditor.InnerBlocks;
    var BaseControl = wpComponents.BaseControl,
        Dashicon = wpComponents.Dashicon,
        Tooltip = wpComponents.Tooltip;

    var Listicle = function (_Component) {
        _inherits(Listicle, _Component);

        function Listicle() {
            _classCallCheck(this, Listicle);

            var _this = _possibleConstructorReturn(this, (Listicle.__proto__ || Object.getPrototypeOf(Listicle)).apply(this, arguments));

            _this.state = {
                currentListicle: null
            };
            return _this;
        }

        _createClass(Listicle, [{
            key: "componentDidMount",
            value: function componentDidMount() {
                this.initListicle();
            }
        }, {
            key: "componentDidUpdate",
            value: function componentDidUpdate(prevProps) {
                if (prevProps.attributes.items.length < this.props.attributes.items.length) {
                    this.initListicle(true);
                }
            }
        }, {
            key: "initListicle",
            value: function initListicle() {
                var refresh = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;

                if (typeof jQuery !== "undefined") {
                    if (!refresh) {
                        jQuery("#block-" + this.props.id + " .listicle-block").accordion({
                            header: ".listicle-header",
                            heightStyle: "content"
                        });
                    } else {
                        jQuery("#block-" + this.props.id + " .listicle-block").accordion('refresh');
                    }

                    jQuery("#block-" + this.props.id + " .listicle-block h4").on('keydown', function (e) {
                        e.stopPropagation();
                    });
                }
            }
        }, {
            key: "updateListicle",
            value: function updateListicle(value, index) {
                var _this2 = this;

                var _props = this.props,
                    attributes = _props.attributes,
                    setAttributes = _props.setAttributes;
                var items = attributes.items;


                var newItems = items.map(function (item, thisIndex) {
                    if (index === thisIndex) {
                        if (value.body) {
                            if (value.body.length !== item.body.length) {
                                _this2.initListicle(true);
                            }
                        }

                        item = _extends({}, item, value);
                    }

                    return item;
                });

                setAttributes({ items: newItems });
            }
        }, {
            key: "render",
            value: function render() {
                var _this3 = this;

                var _props2 = this.props,
                    isSelected = _props2.isSelected,
                    attributes = _props2.attributes,
                    setAttributes = _props2.setAttributes;
                var items = attributes.items;


                return React.createElement(
                    Fragment,
                    null,
                    React.createElement(
                        "dl",
                        { className: "listicle" },
                        items.map(function (item, index) {
                            return React.createElement(
                                Fragment,
                                { key: index },
                                React.createElement(
                                    "span",
                                    { className: "listicle-header" },
                                    React.createElement(
                                        Tooltip,
                                        { text: __('Remove item') },
                                        React.createElement(
                                            "span",
                                            { className: "listicle-remove",
                                                onClick: function onClick() {
                                                    return setAttributes({ items: items.filter(function (cItem, cIndex) {
                                                            return cIndex !== index;
                                                        }) });
                                                }
                                            },
                                            React.createElement(Dashicon, { icon: "no" })
                                        )
                                    ),
                                    React.createElement(RichText, {
                                        tagName: "dt",
                                        value: item.header,
                                        onChange: function onChange(value) {
                                            return _this3.updateListicle({ header: value }, index);
                                        },
                                        onSplit: function onSplit() {
                                            return null;
                                        },
                                        placeholder: __('Enter title ...')
                                    })
                                ),
                                React.createElement(
                                    "dd",
                                    { className: "listicle-body" },
                                    React.createElement(RichText, {
                                        tagName: "p",
                                        value: item.body,
                                        onChange: function onChange(value) {
                                            return _this3.updateListicle({ body: value }, index);
                                        },
                                        placeholder: __('Enter content ...')
                                    })
                                )
                            );
                        })
                    ),
                    isSelected && React.createElement(
                        "div",
                        { className: "listicle-controls" },
                        React.createElement(
                            "button",
                            { className: "button button-large button-primary",
                                onClick: function onClick() {
                                    return setAttributes({
                                        items: [].concat(_toConsumableArray(items), [{ header: 'New item', body: 'New Description' }])
                                    });
                                }
                            },
                            'Add Item'
                        )
                    )
                );
            }
        }]);

        return Listicle;
    }(Component);

    registerBlockType('lez-library/listicles', {
        title: 'Listicles',
        description: 'A Guteneasy way to create a listicle.',
        icon: 'list-view',
        category: 'layout',
        attributes: {
            items: {
                type: 'array',
                default: [{
                    header: 'Item 1 (yes HTML works here)',
                    body: 'Description 1.'
                }, {
                    header: 'Item 2',
                    body: 'Click "Add Item" to add more.'
                }]
            },
            headerBgColor: {
                type: 'string',
                default: ''
            },
            headerTextColor: {
                type: 'string',
                default: ''
            }
        },
        edit: Listicle,
        save: function save(_ref) {
            var attributes = _ref.attributes;
            var items = attributes.items;

            return React.createElement(
                "dl",
                { className: "listicle" },
                items.map(function (item, index) {
                    return React.createElement(
                        Fragment,
                        { key: index },
                        React.createElement(
                            "dt",
                            { className: "listicle-title" },
                            item.header
                        ),
                        React.createElement(
                            "dd",
                            { className: "listicle-body" },
                            React.createElement(RichText.Content, { tagName: "p", multiline: "p", value: item.body })
                        ),
                    );
                })
            );
        }
    });
})(wp.i18n, wp.blocks, wp.element, wp.editor, wp.components);
