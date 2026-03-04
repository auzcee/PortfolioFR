// lib/data/models/certification_model.dart
// Table: certifications  (many-to-one with users)
// ─────────────────────────────────────────────────────────────────────────────

class CertificationModel {
  final int? id;
  final int userId;
  final String name;
  final String issuingOrganization;
  final String? credentialId;
  final String? credentialUrl;
  final String? issueDate;
  final String? expiryDate;
  final bool doesExpire;
  final String? imagePath;
  final int sortOrder;
  final String createdAt;
  final String updatedAt;

  const CertificationModel({
    this.id,
    required this.userId,
    required this.name,
    required this.issuingOrganization,
    this.credentialId,
    this.credentialUrl,
    this.issueDate,
    this.expiryDate,
    this.doesExpire = true,
    this.imagePath,
    this.sortOrder = 0,
    required this.createdAt,
    required this.updatedAt,
  });

  factory CertificationModel.fromMap(Map<String, dynamic> map) =>
      CertificationModel(
        id: map['id'] as int?,
        userId: map['user_id'] as int,
        name: map['name'] as String,
        issuingOrganization: map['issuing_organization'] as String,
        credentialId: map['credential_id'] as String?,
        credentialUrl: map['credential_url'] as String?,
        issueDate: map['issue_date'] as String?,
        expiryDate: map['expiry_date'] as String?,
        doesExpire: (map['does_expire'] as int? ?? 1) == 1,
        imagePath: map['image_path'] as String?,
        sortOrder: map['sort_order'] as int? ?? 0,
        createdAt: map['created_at'] as String,
        updatedAt: map['updated_at'] as String,
      );

  Map<String, dynamic> toMap() => {
    if (id != null) 'id': id,
    'user_id': userId,
    'name': name,
    'issuing_organization': issuingOrganization,
    'credential_id': credentialId,
    'credential_url': credentialUrl,
    'issue_date': issueDate,
    'expiry_date': expiryDate,
    'does_expire': doesExpire ? 1 : 0,
    'image_path': imagePath,
    'sort_order': sortOrder,
    'created_at': createdAt,
    'updated_at': updatedAt,
  };

  CertificationModel copyWith({
    int? id,
    int? userId,
    String? name,
    String? issuingOrganization,
    String? credentialId,
    String? credentialUrl,
    String? issueDate,
    String? expiryDate,
    bool? doesExpire,
    String? imagePath,
    int? sortOrder,
    String? createdAt,
    String? updatedAt,
  }) => CertificationModel(
    id: id ?? this.id,
    userId: userId ?? this.userId,
    name: name ?? this.name,
    issuingOrganization: issuingOrganization ?? this.issuingOrganization,
    credentialId: credentialId ?? this.credentialId,
    credentialUrl: credentialUrl ?? this.credentialUrl,
    issueDate: issueDate ?? this.issueDate,
    expiryDate: expiryDate ?? this.expiryDate,
    doesExpire: doesExpire ?? this.doesExpire,
    imagePath: imagePath ?? this.imagePath,
    sortOrder: sortOrder ?? this.sortOrder,
    createdAt: createdAt ?? this.createdAt,
    updatedAt: updatedAt ?? this.updatedAt,
  );

  @override
  String toString() =>
      'CertificationModel(id: $id, name: $name, org: $issuingOrganization)';
}
