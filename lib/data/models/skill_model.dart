// lib/data/models/skill_model.dart
// Table: skills  (many-to-one with users)
// ─────────────────────────────────────────────────────────────────────────────

/// Skill proficiency levels used throughout the app.
enum SkillLevel { beginner, elementary, intermediate, advanced, expert }

extension SkillLevelExtension on SkillLevel {
  String get label => name[0].toUpperCase() + name.substring(1);

  static SkillLevel fromString(String value) => SkillLevel.values.firstWhere(
    (e) => e.name == value.toLowerCase(),
    orElse: () => SkillLevel.intermediate,
  );
}

class SkillModel {
  final int? id;
  final int userId;
  final String name;
  final String category; // e.g. "Frontend", "Backend", "Mobile"
  final SkillLevel level;
  final int yearsOfExperience;
  final int sortOrder;
  final String createdAt;
  final String updatedAt;

  const SkillModel({
    this.id,
    required this.userId,
    required this.name,
    required this.category,
    this.level = SkillLevel.intermediate,
    this.yearsOfExperience = 0,
    this.sortOrder = 0,
    required this.createdAt,
    required this.updatedAt,
  });

  factory SkillModel.fromMap(Map<String, dynamic> map) => SkillModel(
    id: map['id'] as int?,
    userId: map['user_id'] as int,
    name: map['name'] as String,
    category: map['category'] as String,
    level: SkillLevelExtension.fromString(map['level'] as String? ?? ''),
    yearsOfExperience: map['years_of_experience'] as int? ?? 0,
    sortOrder: map['sort_order'] as int? ?? 0,
    createdAt: map['created_at'] as String,
    updatedAt: map['updated_at'] as String,
  );

  Map<String, dynamic> toMap() => {
    if (id != null) 'id': id,
    'user_id': userId,
    'name': name,
    'category': category,
    'level': level.name,
    'years_of_experience': yearsOfExperience,
    'sort_order': sortOrder,
    'created_at': createdAt,
    'updated_at': updatedAt,
  };

  SkillModel copyWith({
    int? id,
    int? userId,
    String? name,
    String? category,
    SkillLevel? level,
    int? yearsOfExperience,
    int? sortOrder,
    String? createdAt,
    String? updatedAt,
  }) => SkillModel(
    id: id ?? this.id,
    userId: userId ?? this.userId,
    name: name ?? this.name,
    category: category ?? this.category,
    level: level ?? this.level,
    yearsOfExperience: yearsOfExperience ?? this.yearsOfExperience,
    sortOrder: sortOrder ?? this.sortOrder,
    createdAt: createdAt ?? this.createdAt,
    updatedAt: updatedAt ?? this.updatedAt,
  );

  @override
  String toString() =>
      'SkillModel(id: $id, userId: $userId, name: $name, level: ${level.name})';
}
