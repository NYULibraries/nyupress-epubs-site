YUI().use(
    'node', 'event', 'io', 'node-scroll-info', 'handlebars', 'json-parse', 'jsonp', 'jsonp-url', 'gallery-idletimer', 'escape', function(Y) {

        'use strict';

        var body = Y.one('body'),
            container = Y.one('#a'),
            query = Y.one('.query'),
            loadMoreButton = Y.one('.pure-button.loading'),
            datasourceURL = body.getAttribute('data-discovery') + '/select?&wt=json&json.wrf=callback={callback}&hl=true&hl.fl=title,description,text&fl=title,description,author,identifier,coverHref,thumbHref',
            searchString = '*:*',
            transactions = [],
            pager = Y.one('ul.pure-paginator'),
            fold = 200,
            source = Y.one('#list-template').getHTML(),
            template = Y.Handlebars.compile(source);

        function onFailure() {
            Y.log('onFailure'); // leave here for now
        }

        function onTimeout() {
            onFailure();
        }

        function onClick(e) {
            e.preventDefault();
            onScroll();
        }

        function onPaginatorAvailable() {
            if (this.get('region').top - fold < body.get('winHeight')) {
                onScroll();
            }
        }

        function onSubmit(e) {

            e.preventDefault();

            var currentTarget = e.currentTarget,
                value = Y.one('.pure-input');

            location.href = currentTarget.get('action') + '/' + value.get('value');
        }

        function onScroll() {

            var numfound = 0,
                start = 0,
                docslength = 0,
                next = 0,
                href;

            if (body.hasClass('io-done')) return;

            numfound = parseInt(container.getAttribute("data-numfound"), 10);

            start = parseInt(container.getAttribute("data-start"), 10);

            docslength = parseInt(container.getAttribute("data-docslength"), 10);

            next = (start + docslength);

            if (
                next <= numfound
            ) {

                href = datasourceURL + '&start=' + next;

                if (Y.Array.indexOf(transactions, href) < 0 && !body.hasClass('io-loading')) {

                    if (
                        body.scrollInfo.getScrollInfo().atBottom ||
                        (
                            Y.IdleTimer.isIdle() && pager.get('region').top - fold < body.get('winHeight')
                        )
                    ) {

                        body.addClass('io-loading');

                        Y.jsonp(href, {
                            on: {
                                success: onSuccess,
                                failure: onFailure,
                                timeout: onTimeout
                            },
                            timeout: 3000
                        });

                    }
                }

            }

        }

        function onSuccess(response) {

            // try {

                var numfound = parseInt(response.response.numFound, 10),
                    start = parseInt(response.response.start, 10),
                    docslength = parseInt(response.response.docs.length, 10),
                    docs = response.response.docs,
                    href = Y.Node.create('<a href> ...</a>'),
                    description,
                    descriptionLength,
                    node;

                // store called to avoid making the request multiple times
                transactions.push(this.url);

                container.setAttribute("data-numFound", numfound);

                container.setAttribute("data-start", start);

                container.setAttribute("data-docsLength", docslength);

                // render HTML and append to container
                container.append(
                    template({
                        items: response.response.docs
                    })
                );

                description = Y.all('.description.unprocessed');

                // hide ellipse on descriptions under 300 chars and truncate + 300
                description.each(function(i) {

                    node = i._node;
                    descriptionLength = node.innerHTML.length;

                    if (descriptionLength < 300) {
                        node.nextElementSibling.hidden = true;
                    } else if (descriptionLength > 300) {
                        node.innerHTML = node.innerHTML.substring(0, 299);
                    };
                    i.replaceClass('unprocessed', 'processed');
                });

                if (start + docslength === numfound) body.addClass('io-done');

                body.removeClass('io-loading');

                loadMoreButton.removeClass('pure-button-disabled');

            // } catch (e) {
            //     Y.log('error'); // leave here for now
            // }
        }

        Y.IdleTimer.subscribe('idle', onScroll);

        // be opportunistic
        Y.IdleTimer.start(5000);

        // Plug ScrollInfo 
        body.plug(Y.Plugin.ScrollInfo, {
            scrollMargin: fold
        });

        body.scrollInfo.on({
            scroll: onScroll
        });

        // make the first request
        Y.jsonp(datasourceURL, {
            on: {
                success: onSuccess,
                failure: onFailure,
                timeout: onTimeout
            },
            timeout: 3000
        });

        loadMoreButton.on('click', onClick);

        body.delegate('submit', onSubmit, 'form');

        pager.on('available', onPaginatorAvailable);

    });