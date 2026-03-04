// lib/data/models/portfolio_model.dart
// Table: portfolios  (one-to-one with users)
// ─────────────────────────────────────────────────────────────────────────────

class PortfolioModel {
  final int? id;
  final int userId;
  final String title;
  final String? summary;
  final String? templateId;
  final bool isPublic;
  final String? customUrl;
  final String createdAt;
  final String updatedAt;

  const PortfolioModel({
    this.id,
    required this.userId,
    required this.title,
    this.summary,
    this.templateId,
    this.isPublic = false,
    this.customUrl,
    required this.createdAt,
    required this.updatedAt,
  });

  factory PortfolioModel.fromMap(Map<String, dynamic> map) => PortfolioModel(
    id: map['id'] as int?,
    userId: map['user_id'] as int,
    title: map['title'] as String,
    summary: map['summary'] as String?,
    templateId: map['template_id'] as String?,
    isPublic: (map['is_public'] as int? ?? 0) == 1,
    customUrl: map['custom_url'] as String?,
    createdAt: map['created_at'] as String,
    updatedAt: map['updated_at'] as String,
  );

  Map<String, dynamic> toMap() => {
    if (id != null) 'id': id,
    'user_id': userId,
    'title': title,
    'summary': summary,
    'template_id': templateId,
    'is_public': isPublic ? 1 : 0,
    'custom_url': customUrl,
    'created_at': createdAt,
    'updated_at': updatedAt,
  };

  PortfolioModel copyWith({
    int? id,
    int? userId,
    String? title,
    String? summary,
    String? templateId,
    bool? isPublic,
    String? customUrl,
    String? createdAt,
    String? updatedAt,
  }) => PortfolioModel(
    id: id ?? this.id,
    userId: userId ?? this.userId,
    title: title ?? this.title,
    summary: summary ?? this.summary,
    templateId: templateId ?? this.templateId,
    isPublic: isPublic ?? this.isPublic,
    customUrl: customUrl ?? this.customUrl,
    createdAt: createdAt ?? this.createdAt,
    updatedAt: updatedAt ?? this.updatedAt,
  );

  @override
  String toString() =>
      'PortfolioModel(id: $id, userId: $userId, title: $title)';
}
