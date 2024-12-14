<div class="container">
    <div class="header-actions">
        <h2>Messages from Users</h2>
    </div>

    <div class="messages-list">
        <?php if (empty($messages)): ?>
            <div>
                <p>No messages received yet.</p>
            </div>
        <?php else: ?>
            <?php foreach ($messages as $message): ?>
                <div class="post-card">
                    <div class="post-header">
                        <h3><?=htmlspecialchars($message['title'])?></h3>
                        <span class="post-meta">
                            From: <?=htmlspecialchars($message['username'])?> | 
                            <?=date('M j, Y g:i A', strtotime($message['time']))?>
                        </span>
                    </div>
                    <div style="padding: 10px;">
                        <p style="color: var(--text-secondary);"><?=nl2br(htmlspecialchars($message['message_content']))?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>