document.addEventListener('DOMContentLoaded', function() {
    // Check if wp.data is available
    if (typeof wp !== 'undefined' && wp.data && wp.data.dispatch) {
        const MAX_CHARACTERS = 300;
        let characterLimitErrorId = null;
        let isDebouncing = false;

        // Function to update character count and manage errors
        function updateCharacterCount() {
            if (isDebouncing) return;
            isDebouncing = true;

            setTimeout(() => {
                const postContent = wp.data.select('core/editor').getEditedPostAttribute('content');
                const charCount = postContent ? postContent.length : 0;
                const remainingChars = MAX_CHARACTERS - charCount;

                // Update the character counter in the metabox
                const charCountElement = document.getElementById('content-character-counter');
                if (charCountElement) {
                    charCountElement.textContent = wp.i18n.sprintf(
                        wp.i18n.__('Characters remaining: %d', 'collaborative-glossary'),
                        remainingChars
                    );
                }

                // Enable or disable the publish/update button based on character count
                const publishButton = document.querySelector('.editor-post-publish-button, .editor-post-save-draft');
                if (publishButton) {
                    publishButton.disabled = charCount > MAX_CHARACTERS;
                }

                // Manage character limit error notice
                if (charCount > MAX_CHARACTERS) {
                    if (!characterLimitErrorId) {
                        characterLimitErrorId = wp.data.dispatch('core/notices').createNotice(
                            'error',
                            wp.i18n.__('The character limit is 300. Please reduce the content.', 'collaborative-glossary'),
                            { isDismissible: true }
                        );
                    }
                } else if (charCount <= MAX_CHARACTERS && characterLimitErrorId) {
                    wp.data.dispatch('core/notices').removeNotice(characterLimitErrorId);
                    characterLimitErrorId = null;
                }

                isDebouncing = false;
            }, 300); // Delay to prevent multiple calls in quick succession
        }

        // Subscribe to content changes to maintain the 300 character limit
        wp.data.subscribe(updateCharacterCount);

        // Initial character count update
        updateCharacterCount();
    }
});
