# KarmaKids
A simple cool xenforo callback interface for our karma system

## Example usage:
Via Xenforo's message_user_info template:

``
				<xen:if is="{xen:helper ismemberof, $user, 7} OR {xen:helper ismemberof, $user, 10}">
	                            <dl class="pairsJustified">
	                                <dt class="Tooltip" title="Karma shows how much a player has contributed to Wynncraft content">Creator Karma:</dt>
	                                <dd><xen:callback class="Wynncraft_KarmaKids_index" method="render" params="{$user.customFields.minecraft}"></xen:callback></dd>
	                            </dl>
	                        </xen:if>
``
