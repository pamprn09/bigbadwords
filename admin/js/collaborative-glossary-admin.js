
wp.domReady(function() {
    if (wp.data.select('core/editor').getCurrentPostType() === 'glossary') {
        
        // Update allowed block types to only paragraph.
        wp.data.dispatch('core/editor').updateSettings({
            allowedBlockTypes: ['core/paragraph']
        });

        // Function to limit content length to 300 characters.
        const limitContentLength = () => {
            const content = wp.data.select('core/editor').getEditedPostAttribute('content');
            if (content.length > 300) {
                wp.data.dispatch('core/editor').editPost({ content: content.slice(0, 300) });
            }
        };

        limitContentLength();

        // Subscribe to content changes to maintain the 300 character limit.
        wp.data.subscribe(limitContentLength);
    }
});
