function selectCode(input) {
  let target;

  // Identify call type: event object or DOM node
  if (input && input.type && input.target) {
    target = input.currentTarget || input.target;
  } else if (input && input.nodeType === 1) {
    target = input;
  } else {
    console.warn('selectCode: Unrecognized input:', input);
    return;
  }

  // Find the nearest .codebox and its <code> block
  const codeElement = target.closest('.codebox')?.querySelector('code');
  if (!codeElement) {
    console.warn('selectCode: Code block not found');
    return;
  }

  // Highlight the code for visual feedback
  if (window.getSelection) {
    const selection = window.getSelection();
    const range = document.createRange();
    range.selectNodeContents(codeElement);
    selection.removeAllRanges();
    selection.addRange(range);
  }

  // Fallback for IE (if still needed)
  if (document.selection) {
    const range = document.body.createTextRange();
    range.moveToElementText(codeElement);
    range.select();
  }

  // Try to copy to clipboard
  const codeText = codeElement.textContent;
  if (navigator.clipboard && typeof navigator.clipboard.writeText === 'function') {
    navigator.clipboard.writeText(codeText).catch(err => {
      console.warn('selectCode: Clipboard copy failed', err);
    });
  }
}