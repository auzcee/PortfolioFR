// lib/data/models/contact_model.dart
// Table: contacts  (many-to-one with users)
// Stores external social/contact links per user.
// ─────────────────────────────────────────────────────────────────────────────

class ContactModel {
  final int? id;
  final int userId;
  final String platform; // e.g. "LinkedIn", "GitHub", "Twitter"
  final String url;
  final String? displayLabel;
  final int sortOrder;
  final String createdAt;
  final String updatedAt;

  const ContactModel({
    this.id,
    required this.userId,
    required this.platform,
    required this.url,
    this.displayLabel,
    this.sortOrder = 0,
    required this.createdAt,
    required this.updatedAt,
  });

  factory ContactModel.fromMap(Map<String, dynamic> map) => ContactModel(
    id: map['id'] as int?,
    userId: map['user_id'] as int,
    platform: map['platform'] as String,
    url: map['url'] as String,
    displayLabel: map['display_label'] as String?,
    sortOrder: map['sort_order'] as int? ?? 0,
    createdAt: map['created_at'] as String,
    updatedAt: map['updated_at'] as String,
  );

  Map<String, dynamic> toMap() => {
    if (id != null) 'id': id,
    'user_id': userId,
    'platform': platform,
    'url': url,
    'display_label': displayLabel,
    'sort_order': sortOrder,
    'created_at': createdAt,
    'updated_at': updatedAt,
  };

  ContactModel copyWith({
    int? id,
    int? userId,
    String? platform,
    String? url,
    String? displayLabel,
    int? sortOrder,
    String? createdAt,
    String? updatedAt,
  }) => ContactModel(
    id: id ?? this.id,
    userId: userId ?? this.userId,
    platform: platform ?? this.platform,
    url: url ?? this.url,
    displayLabel: displayLabel ?? this.displayLabel,
    sortOrder: sortOrder ?? this.sortOrder,
    createdAt: createdAt ?? this.createdAt,
    updatedAt: updatedAt ?? this.updatedAt,
  );

  @override
  String toString() =>
      'ContactModel(id: $id, userId: $userId, platform: $platform)';
}
