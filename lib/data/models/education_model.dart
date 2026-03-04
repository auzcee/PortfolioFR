// lib/data/models/education_model.dart
// Table: education  (many-to-one with users)
// ─────────────────────────────────────────────────────────────────────────────

class EducationModel {
  final int? id;
  final int userId;
  final String institution;
  final String degree; // e.g. "Bachelor of Science"
  final String fieldOfStudy;
  final String? description;
  final String? grade;
  final String? startDate;
  final String? endDate;
  final bool isCurrent;
  final int sortOrder;
  final String createdAt;
  final String updatedAt;

  const EducationModel({
    this.id,
    required this.userId,
    required this.institution,
    required this.degree,
    required this.fieldOfStudy,
    this.description,
    this.grade,
    this.startDate,
    this.endDate,
    this.isCurrent = false,
    this.sortOrder = 0,
    required this.createdAt,
    required this.updatedAt,
  });

  factory EducationModel.fromMap(Map<String, dynamic> map) => EducationModel(
    id: map['id'] as int?,
    userId: map['user_id'] as int,
    institution: map['institution'] as String,
    degree: map['degree'] as String,
    fieldOfStudy: map['field_of_study'] as String,
    description: map['description'] as String?,
    grade: map['grade'] as String?,
    startDate: map['start_date'] as String?,
    endDate: map['end_date'] as String?,
    isCurrent: (map['is_current'] as int? ?? 0) == 1,
    sortOrder: map['sort_order'] as int? ?? 0,
    createdAt: map['created_at'] as String,
    updatedAt: map['updated_at'] as String,
  );

  Map<String, dynamic> toMap() => {
    if (id != null) 'id': id,
    'user_id': userId,
    'institution': institution,
    'degree': degree,
    'field_of_study': fieldOfStudy,
    'description': description,
    'grade': grade,
    'start_date': startDate,
    'end_date': endDate,
    'is_current': isCurrent ? 1 : 0,
    'sort_order': sortOrder,
    'created_at': createdAt,
    'updated_at': updatedAt,
  };

  EducationModel copyWith({
    int? id,
    int? userId,
    String? institution,
    String? degree,
    String? fieldOfStudy,
    String? description,
    String? grade,
    String? startDate,
    String? endDate,
    bool? isCurrent,
    int? sortOrder,
    String? createdAt,
    String? updatedAt,
  }) => EducationModel(
    id: id ?? this.id,
    userId: userId ?? this.userId,
    institution: institution ?? this.institution,
    degree: degree ?? this.degree,
    fieldOfStudy: fieldOfStudy ?? this.fieldOfStudy,
    description: description ?? this.description,
    grade: grade ?? this.grade,
    startDate: startDate ?? this.startDate,
    endDate: endDate ?? this.endDate,
    isCurrent: isCurrent ?? this.isCurrent,
    sortOrder: sortOrder ?? this.sortOrder,
    createdAt: createdAt ?? this.createdAt,
    updatedAt: updatedAt ?? this.updatedAt,
  );

  @override
  String toString() =>
      'EducationModel(id: $id, institution: $institution, degree: $degree)';
}
