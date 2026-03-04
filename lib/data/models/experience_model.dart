// lib/data/models/experience_model.dart
// Table: work_experience  (many-to-one with users)
// ─────────────────────────────────────────────────────────────────────────────

class ExperienceModel {
  final int? id;
  final int userId;
  final String company;
  final String jobTitle;
  final String? employmentType; // "Full-time", "Part-time", "Freelance", etc.
  final String? location;
  final String? description;
  final String? startDate;
  final String? endDate;
  final bool isCurrent;
  final int sortOrder;
  final String createdAt;
  final String updatedAt;

  const ExperienceModel({
    this.id,
    required this.userId,
    required this.company,
    required this.jobTitle,
    this.employmentType,
    this.location,
    this.description,
    this.startDate,
    this.endDate,
    this.isCurrent = false,
    this.sortOrder = 0,
    required this.createdAt,
    required this.updatedAt,
  });

  factory ExperienceModel.fromMap(Map<String, dynamic> map) => ExperienceModel(
    id: map['id'] as int?,
    userId: map['user_id'] as int,
    company: map['company'] as String,
    jobTitle: map['job_title'] as String,
    employmentType: map['employment_type'] as String?,
    location: map['location'] as String?,
    description: map['description'] as String?,
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
    'company': company,
    'job_title': jobTitle,
    'employment_type': employmentType,
    'location': location,
    'description': description,
    'start_date': startDate,
    'end_date': endDate,
    'is_current': isCurrent ? 1 : 0,
    'sort_order': sortOrder,
    'created_at': createdAt,
    'updated_at': updatedAt,
  };

  ExperienceModel copyWith({
    int? id,
    int? userId,
    String? company,
    String? jobTitle,
    String? employmentType,
    String? location,
    String? description,
    String? startDate,
    String? endDate,
    bool? isCurrent,
    int? sortOrder,
    String? createdAt,
    String? updatedAt,
  }) => ExperienceModel(
    id: id ?? this.id,
    userId: userId ?? this.userId,
    company: company ?? this.company,
    jobTitle: jobTitle ?? this.jobTitle,
    employmentType: employmentType ?? this.employmentType,
    location: location ?? this.location,
    description: description ?? this.description,
    startDate: startDate ?? this.startDate,
    endDate: endDate ?? this.endDate,
    isCurrent: isCurrent ?? this.isCurrent,
    sortOrder: sortOrder ?? this.sortOrder,
    createdAt: createdAt ?? this.createdAt,
    updatedAt: updatedAt ?? this.updatedAt,
  );

  @override
  String toString() =>
      'ExperienceModel(id: $id, company: $company, jobTitle: $jobTitle)';
}
