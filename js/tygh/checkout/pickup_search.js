(function (_, $) {

    // Define pseudo-selectors in jquery
    $.expr[':'].contains_case_insensitive = $.expr.createPseudo(function(arg) {
        return function( elem ) {
            return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
        };
    });

    $.expr[':'].not_contains_case_insensitive = $.expr.createPseudo(function(arg) {
        return function( elem ) {
            return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) < 0;
        };
    });

    /**
     * Search class.
     * @param {any} o options, { searchInputSelector: 'string', blockSelector: 'string' }
     */
    function Search (o) {
        this.searchInputSelector = o.searchInputSelector;
        this.blockSelector = o.blockSelector;

        return this;
    }

    /**
     * Init method.
     * @param {jQuery} $self DOM Node, that contains search input and blocks
     */
    Search.prototype.init = function searchinit ($self) {
        this.$self        = $self;
        this.$searchInput = $(this.searchInputSelector, $self);

        this.$searchInput.on('input', this.search(this));

        return this;
    }

    Search.prototype.search = function searchsearch (scope) {
        return function (jQevent) {
            var $found    = scope.$self.find(scope.blockSelector + ':contains_case_insensitive('     + $(this).val() + ')');
            var $notFound = scope.$self.find(scope.blockSelector + ':not_contains_case_insensitive(' + $(this).val() + ')');

            $found.toggleClass('hidden', false);
            $notFound.toggleClass('hidden', true);
        }
    }

    $.ceEvent('on', 'ce.commoninit', initSearch);

    function initSearch (context) {
        var _Search = new Search({
            searchInputSelector: '.js-pickup-search-input',
            blockSelector: '.js-pickup-search-block'
        }).init($(context));
    }

    $(_.doc).on('click', '.accordeon-label', function () { toggle($(this)); });

    function toggle ($elm) {
        var $click = $( $elm.data('click') ),
            $disable = $( $elm.data('disable') );

        $elm.toggleClass('accordeon-label--checked', true);
        $disable.toggleClass('accordeon-label--checked', false);

        $click.trigger('click');
    }
})(Tygh, Tygh.$);
