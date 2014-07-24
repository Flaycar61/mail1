<script id="mail-folder-template" type="text/x-handlebars-template">
	<h2 class="mail_account">{{email}}</h2>
	<ul class="mail_folders" data-account_id="{{id}}">
		{{#each folders}}
		<li data-folder_id="{{id}}"
		{{#if unseen}} class="unread"{{/if}}
		>
		<a>
			{{name}}
			{{#if unseen}}
			<span class="utils">{{unseen}}</span>
			{{/if}}
		</a>
		</li>
		{{/each}}
	</ul>
</script>
<script id="mail-messages-template" type="text/x-handlebars-template">
	{{#each this}}
	<div id="mail-message-summary-{{id}}" class="mail_message_summary {{#if flags.unseen}}unseen{{/if}}" data-message-id="{{id}}">
		<div class="mail-message-header">
			<div class="sender-image">
				{{#if senderImage}}
				<img src="{{senderImage}}" width="32px" height="32px"/>
				{{else}}
				<div class="avatar" data-user="{{from}}" data-size="32"></div>
				{{/if}}
			</div>
			<div class="mail_message_summary_from">{{from}}</div>
			<div class="mail_message_summary_subject">{{subject}}</div>
			<div class="date">
					<span class="modified"
						  title="{{formatDate dateInt}}"
						  style="color:{{colorOfDate dateInt}}">{{relativeModifiedDate dateInt}}</span>
			</div>
			<div class="icon-delete action delete"></div>
		</div>
		<div class="mail_message_loading icon-loading"></div>
		<div class="mail_message"></div>
	</div>
	{{/each}}
</script>
<script id="mail-message-template" type="text/x-handlebars-template">
	<div class="mail-message-body">
		<div id="mail-content">
			{{{body}}}
		</div>
		{{#if signature}}
		<div class="mail-signature">
			{{{signature}}}
		</div>
		{{/if}}

		<div class="mail-message-attachments">
			{{#if attachment}}
			<ul>
				<li class="mail-message-attachment mail-message-attachment-single" data-attachment-id="{{attachment.id}}" data-attachment-mime="{{attachment.mime}}">
					<img class="attachment-icon" src="{{attachment.mimeUrl}}" />
					{{attachment.fileName}} <span class="attachment-size">({{humanFileSize attachment.size}})</span><br/>
					<a class="button icon-download attachment-download" href="{{attachment.downloadUrl}}"><?php p($l->t('Download attachment')); ?></a>
					<button class="icon-upload attachment-save-to-cloud"><?php p($l->t('Save to Files')); ?></button>
				</li>
			</ul>
			{{/if}}
			{{#if attachments}}
			<ul>
				{{#each attachments}}
				<li class="mail-message-attachment" data-attachment-id="{{id}}" data-attachment-mime="{{mime}}">
					<a class="button icon-download attachment-download" href="{{downloadUrl}}" title="<?php p($l->t('Download attachment')); ?>"></a>
					<button class="icon-upload attachment-save-to-cloud" title="<?php p($l->t('Save to Files')); ?>"></button>
					<img class="attachment-icon" src="{{mimeUrl}}" />
					{{fileName}} <span class="attachment-size">({{humanFileSize size}})</span>
				</li>
				{{/each}}
			</ul>
			<p>
				<button class="icon-upload attachments-save-to-cloud"><?php p($l->t('Save all to Files')); ?></button>
			</p>
			{{/if}}
		</div>

		<div class="reply-message-fields">
			<input type="text" name="to" id="to"
					placeholder="<?php p($l->t('Recipient')); ?>" />

			<a href="#" id="reply-message-cc-bcc-toggle"
					class="transparency">+ cc/bcc</a>
			<div id="reply-message-cc-bcc">
				<input type="text" name="cc" id="cc"
					placeholder="<?php p($l->t('cc')); ?>" />
				<input type="text" name="bcc" id="bcc"
					placeholder="<?php p($l->t('bcc')); ?>" />
			</div>

			<textarea name="body" class="reply-message-body"
				placeholder="<?php p($l->t('Reply')); ?> …"></textarea>
			<input class="reply-message-send" type="submit" value="<?php p($l->t('Reply')) ?>">
		</div>
		<div class="reply-message-more">
			<a href="#" class="reply-message-forward transparency"><?php p($l->t('Forward')) ?></a>
			<!-- TODO: add attachment picker -->
		</div>
	</div>
</script>

<div id="app">
	<div id="app-navigation" class="icon-loading"></div>
	<div id="app-content"  class="icon-loading">
		<form id="new-message">
			<input type="button" id="mail_new_message" value="<?php p($l->t('New Message')); ?>" style="display: none">

			<div id="new-message-fields" style="display: none">
				<input type="text" name="to" id="to"
					placeholder="<?php p($l->t('Recipient')); ?>" />
				<a href="#" id="new-message-cc-bcc-toggle"
					class="transparency">+ cc/bcc</a>
				<div id="new-message-cc-bcc">
					<input type="text" name="cc" id="cc"
						placeholder="<?php p($l->t('cc')); ?>" />
					<input type="text" name="bcc" id="bcc"
						placeholder="<?php p($l->t('bcc')); ?>" />
				</div>
				<input type="text" name="subject" id="subject"
					placeholder="<?php p($l->t('Subject')); ?>" />
				<textarea name="body" id="new-message-body"
					placeholder="<?php p($l->t('Message')); ?> …"></textarea>
				<input id="new-message-send" class="send" type="submit"
					value="<?php p($l->t('Send')) ?>">
			</div>
			<!-- TODO: add attachment picker -->
		</form>

		<div id="mail_messages"></div>
	</div>
</div>
