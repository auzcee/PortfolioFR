// lib/data/models/app_setting_model.dart
// Table: app_settings  (generic key-value store per user)
// Flexible row-per-setting design for future extensibility.
// ─────────────────────────────────────────────────────────────────────────────

class AppSettingModel {
  final int? id;
  final int userId;
  final String settingKey;
  final String settingValue;
  final String updatedAt;

  const AppSettingModel({
    this.id,
    required this.userId,
    required this.settingKey,
    required this.settingValue,
    required this.updatedAt,
  });

  factory AppSettingModel.fromMap(Map<String, dynamic> map) => AppSettingModel(
    id: map['id'] as int?,
    userId: map['user_id'] as int,
    settingKey: map['setting_key'] as String,
    settingValue: map['setting_value'] as String,
    updatedAt: map['updated_at'] as String,
  );

  Map<String, dynamic> toMap() => {
    if (id != null) 'id': id,
    'user_id': userId,
    'setting_key': settingKey,
    'setting_value': settingValue,
    'updated_at': updatedAt,
  };

  AppSettingModel copyWith({
    int? id,
    int? userId,
    String? settingKey,
    String? settingValue,
    String? updatedAt,
  }) => AppSettingModel(
    id: id ?? this.id,
    userId: userId ?? this.userId,
    settingKey: settingKey ?? this.settingKey,
    settingValue: settingValue ?? this.settingValue,
    updatedAt: updatedAt ?? this.updatedAt,
  );

  @override
  String toString() =>
      'AppSettingModel(userId: $userId, key: $settingKey, value: $settingValue)';
}
